<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('roles');
        
        // Search functionality
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }
        
        // Role filter
        if ($request->filled('role')) {
            $query->whereHas('roles', function($q) use ($request) {
                $q->where('name', $request->role);
            });
        }
        
        $users = $query->latest()->paginate(10);
        $roles = Role::all();
        
        return view('users.index', compact('users', 'roles'));
    }
    
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,name'
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        $user->assignRole($request->role);
        
        activity()
            ->causedBy(auth()->user())
            ->performedOn($user)
            ->withProperties([
                'role' => $request->role,
                'ip_address' => request()->ip()
            ])
            ->log('User created');
        
        return redirect()->route('users.index')->with('status', 'user-created');
    }
    
    public function show(User $user)
    {
        $user->load('roles');
        return view('users.show', compact('user'));
    }
    
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }
    
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|exists:roles,name'
        ]);
        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        
        $oldRoles = $user->roles->pluck('name')->toArray();
        $user->syncRoles([$request->role]);
        
        activity()
            ->causedBy(auth()->user())
            ->performedOn($user)
            ->withProperties([
                'old_roles' => $oldRoles,
                'new_role' => $request->role,
                'ip_address' => request()->ip()
            ])
            ->log('User updated');
        
        return redirect()->route('users.index')->with('status', 'user-updated');
    }
    
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Cannot delete your own account');
        }
        
        activity()
            ->causedBy(auth()->user())
            ->withProperties([
                'deleted_user' => [
                    'name' => $user->name,
                    'email' => $user->email
                ],
                'ip_address' => request()->ip()
            ])
            ->log('User deleted');
            
        $user->delete();
        
        return redirect()->route('users.index')->with('status', 'user-deleted');
    }
    
    public function bulkDelete(Request $request)
    {
        $userIds = $request->input('user_ids', []);
        $currentUserId = auth()->id();
        
        // Remove current user from deletion list
        $userIds = array_filter($userIds, fn($id) => $id != $currentUserId);
        
        $deletedUsers = User::whereIn('id', $userIds)->get(['name', 'email']);
        
        activity()
            ->causedBy(auth()->user())
            ->withProperties([
                'deleted_users' => $deletedUsers->toArray(),
                'count' => $deletedUsers->count(),
                'ip_address' => request()->ip()
            ])
            ->log('Bulk user deletion');
            
        User::whereIn('id', $userIds)->delete();
        
        return back()->with('status', 'users-bulk-deleted');
    }
}
