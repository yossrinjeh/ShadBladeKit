<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('ui.users') }} Management
            </h2>
            @can('create users')
            <x-ui.button onclick="openCreateModal()">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add User
            </x-ui.button>
            @endcan
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Toast Notifications -->
        @if (session('status') === 'user-created')
            <x-ui.toast type="success" title="Success" message="User created successfully!" />
        @elseif (session('status') === 'user-updated')
            <x-ui.toast type="success" title="Success" message="User updated successfully!" />
        @elseif (session('status') === 'user-deleted')
            <x-ui.toast type="success" title="Success" message="User deleted successfully!" />
        @elseif (session('status') === 'users-bulk-deleted')
            <x-ui.toast type="success" title="Success" message="Selected users deleted successfully!" />
        @endif

        <!-- Filters & Search -->
        <x-ui.card>
            <div class="p-6">
                <form method="GET" class="flex flex-wrap gap-4">
                    <div class="flex-1 min-w-64">
                        <x-ui.input 
                            type="text" 
                            name="search" 
                            placeholder="Search users..." 
                            value="{{ request('search') }}"
                            class="w-full"
                        />
                    </div>
                    <div class="min-w-32">
                        <select name="role" class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm">
                            <option value="">All Roles</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ request('role') === $role->name ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <x-ui.button type="submit" variant="outline">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Search
                    </x-ui.button>
                    @if(request()->hasAny(['search', 'role']))
                        <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-muted-foreground hover:text-foreground">
                            Clear
                        </a>
                    @endif
                </form>
            </div>
        </x-ui.card>

        <!-- Users Table -->
        <x-ui.card>
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">Users ({{ $users->total() }})</h3>
                    @can('delete users')
                    <x-ui.button variant="destructive" size="sm" onclick="bulkDelete()" id="bulk-delete-btn" style="display: none;">
                        Delete Selected
                    </x-ui.button>
                    @endcan
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b">
                                @can('delete users')
                                <th class="text-left py-3 px-4">
                                    <input type="checkbox" id="select-all" class="rounded border-input">
                                </th>
                                @endcan
                                <th class="text-left py-3 px-4">User</th>
                                <th class="text-left py-3 px-4">Role</th>
                                <th class="text-left py-3 px-4">Joined</th>
                                <th class="text-left py-3 px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr class="border-b hover:bg-accent/50">
                                @can('delete users')
                                <td class="py-3 px-4">
                                    <input type="checkbox" class="user-checkbox rounded border-input" value="{{ $user->id }}" {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                                </td>
                                @endcan
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="h-8 w-8 rounded-full bg-primary flex items-center justify-center">
                                            <span class="text-sm font-medium text-primary-foreground">
                                                {{ substr($user->name, 0, 1) }}
                                            </span>
                                        </div>
                                        <div>
                                            <p class="font-medium">{{ $user->name }}</p>
                                            <p class="text-sm text-muted-foreground">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    @foreach($user->roles as $role)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/10 text-primary">
                                            {{ ucfirst($role->name) }}
                                        </span>
                                    @endforeach
                                </td>
                                <td class="py-3 px-4 text-sm text-muted-foreground">
                                    {{ $user->created_at->format('M j, Y') }}
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-2">
                                        @can('edit users')
                                        <button onclick="editUser({{ $user->id }})" class="text-sm text-primary hover:underline">
                                            Edit
                                        </button>
                                        @endcan
                                        @can('delete users')
                                        @if($user->id !== auth()->id())
                                        <button onclick="deleteUser({{ $user->id }})" class="text-sm text-destructive hover:underline">
                                            Delete
                                        </button>
                                        @endif
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-muted-foreground">
                                    No users found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $users->links() }}
                </div>
            </div>
        </x-ui.card>
    </div>

    <!-- Create User Modal -->
    <div id="create-modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-background rounded-lg p-6 w-full max-w-md mx-4">
            <h3 class="text-lg font-semibold mb-4">Create New User</h3>
            <form method="POST" action="{{ route('users.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium mb-1">Name</label>
                    <x-ui.input type="text" name="name" required />
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <x-ui.input type="email" name="email" required />
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Password</label>
                    <x-ui.input type="password" name="password" required />
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Confirm Password</label>
                    <x-ui.input type="password" name="password_confirmation" required />
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Role</label>
                    <select name="role" class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end space-x-2 pt-4">
                    <x-ui.button type="button" variant="outline" onclick="closeCreateModal()">Cancel</x-ui.button>
                    <x-ui.button type="submit">Create User</x-ui.button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openCreateModal() {
            document.getElementById('create-modal').classList.remove('hidden');
            document.getElementById('create-modal').classList.add('flex');
        }

        function closeCreateModal() {
            document.getElementById('create-modal').classList.add('hidden');
            document.getElementById('create-modal').classList.remove('flex');
        }

        function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/users/${userId}`;
                form.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;
                document.body.appendChild(form);
                form.submit();
            }
        }

        // Bulk selection
        document.getElementById('select-all')?.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.user-checkbox:not([disabled])');
            checkboxes.forEach(cb => cb.checked = this.checked);
            toggleBulkActions();
        });

        document.querySelectorAll('.user-checkbox').forEach(cb => {
            cb.addEventListener('change', toggleBulkActions);
        });

        function toggleBulkActions() {
            const selected = document.querySelectorAll('.user-checkbox:checked').length;
            const bulkBtn = document.getElementById('bulk-delete-btn');
            if (bulkBtn) {
                bulkBtn.style.display = selected > 0 ? 'block' : 'none';
            }
        }

        function bulkDelete() {
            const selected = Array.from(document.querySelectorAll('.user-checkbox:checked')).map(cb => cb.value);
            if (selected.length === 0) return;
            
            if (confirm(`Delete ${selected.length} selected users?`)) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("users.bulk-delete") }}';
                form.innerHTML = `
                    @csrf
                    ${selected.map(id => `<input type="hidden" name="user_ids[]" value="${id}">`).join('')}
                `;
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</x-app-layout>