<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        
        return view('roles.index', compact('roles', 'permissions'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'array'
        ]);
        
        $role = Role::create(['name' => $request->name]);
        
        if ($request->permissions) {
            $role->givePermissionTo($request->permissions);
        }
        
        return back()->with('status', 'role-created');
    }
    
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'permissions' => 'array'
        ]);
        
        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions ?? []);
        
        return back()->with('status', 'role-updated');
    }
    
    public function destroy(Role $role)
    {
        // Prevent deletion of admin role
        if ($role->name === 'admin') {
            return back()->with('error', 'Cannot delete admin role');
        }
        
        $role->delete();
        
        return back()->with('status', 'role-deleted');
    }
    
    public function createPermission(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name'
        ]);
        
        Permission::create(['name' => $request->name]);
        
        return back()->with('status', 'permission-created');
    }
    
    public function deletePermission(Permission $permission)
    {
        $permission->delete();
        
        return back()->with('status', 'permission-deleted');
    }
}
