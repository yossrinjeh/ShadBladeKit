<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('ui.users_management') }}
            </h2>
            @can('create users')
            <x-ui.button onclick="openCreateModal()" class="text-white">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                {{ __('ui.add_user') }}
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
                            placeholder="{{ __('ui.search_users') }}" 
                            value="{{ request('search') }}"
                            class="w-full"
                        />
                    </div>
                    <div class="min-w-32">
                        <select name="role" class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm">
                            <option value="">{{ __('ui.all_roles') }}</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ request('role') === $role->name ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <x-ui.button type="submit" variant="outline">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        {{ __('ui.search') }}
                    </x-ui.button>
                    @if(request()->hasAny(['search', 'role']))
                        <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-muted-foreground hover:text-foreground">
                            {{ __('ui.clear') }}
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
                        {{ __('ui.delete_selected') }}
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
                                <th class="text-left py-3 px-4">{{ __('ui.user') }}</th>
                                <th class="text-left py-3 px-4">{{ __('ui.role') }}</th>
                                <th class="text-left py-3 px-4">{{ __('ui.joined') }}</th>
                                <th class="text-left py-3 px-4">{{ __('ui.actions') }}</th>
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
                                        <button onclick="editUser({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->roles->first()?->name ?? '' }}')" 
                                                class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-blue-700 bg-blue-100 hover:bg-blue-200 rounded-lg transition-colors border border-blue-200 dark:text-blue-300 dark:bg-blue-900/30 dark:hover:bg-blue-900/50 dark:border-blue-800">
                                            <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            {{ __('ui.edit') }}
                                        </button>
                                        @endcan
                                        @can('delete users')
                                        @if($user->id !== auth()->id())
                                        <button onclick="deleteUser({{ $user->id }})" 
                                                class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-red-700 bg-red-100 hover:bg-red-200 rounded-lg transition-colors border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:hover:bg-red-900/50 dark:border-red-800">
                                            <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            {{ __('ui.delete') }}
                                        </button>
                                        @endif
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-muted-foreground">
                                    {{ __('ui.no_users_found') }}
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
            <h3 class="text-lg font-semibold mb-4">{{ __('ui.create_new_user') }}</h3>
            <form method="POST" action="{{ route('users.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium mb-1">{{ __('ui.name') }}</label>
                    <x-ui.input type="text" name="name" required />
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">{{ __('ui.email') }}</label>
                    <x-ui.input type="email" name="email" required />
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">{{ __('ui.password') }}</label>
                    <x-ui.input type="password" name="password" required />
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">{{ __('ui.confirm_password') }}</label>
                    <x-ui.input type="password" name="password_confirmation" required />
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">{{ __('ui.role') }}</label>
                    <select name="role" class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end space-x-2 pt-4">
                    <x-ui.button type="button" variant="outline" onclick="closeCreateModal()">{{ __('ui.cancel') }}</x-ui.button>
                    <x-ui.button type="submit">{{ __('ui.create_user') }}</x-ui.button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div id="edit-modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-background rounded-lg p-6 w-full max-w-md mx-4">
            <h3 class="text-lg font-semibold mb-4">{{ __('ui.edit_user') }}</h3>
            <form id="edit-form" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-medium mb-1">{{ __('ui.name') }}</label>
                    <x-ui.input type="text" name="name" id="edit-name" required />
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">{{ __('ui.email') }}</label>
                    <x-ui.input type="email" name="email" id="edit-email" required />
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">{{ __('ui.role') }}</label>
                    <select name="role" id="edit-role" class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end space-x-2 pt-4">
                    <x-ui.button type="button" variant="outline" onclick="closeEditModal()">{{ __('ui.cancel') }}</x-ui.button>
                    <x-ui.button type="submit">{{ __('ui.update_user') }}</x-ui.button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-background rounded-lg p-6 w-full max-w-md mx-4">
            <div class="flex items-center mb-4">
                <div class="flex-shrink-0 w-10 h-10 mx-auto bg-red-100 rounded-full flex items-center justify-center dark:bg-red-900/30">
                    <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
            </div>
            <h3 class="text-lg font-semibold text-center mb-2">{{ __('ui.delete_user') }}</h3>
            <p class="text-sm text-muted-foreground text-center mb-6">{{ __('ui.delete_user_confirm') }}</p>
            <div class="flex justify-end space-x-2">
                <x-ui.button type="button" variant="outline" onclick="closeDeleteModal()">{{ __('ui.cancel') }}</x-ui.button>
                <x-ui.button type="button" variant="destructive" onclick="confirmDelete()">{{ __('ui.delete') }}</x-ui.button>
            </div>
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

        let deleteUserId = null;

        function deleteUser(userId) {
            deleteUserId = userId;
            document.getElementById('delete-modal').classList.remove('hidden');
            document.getElementById('delete-modal').classList.add('flex');
        }

        function closeDeleteModal() {
            deleteUserId = null;
            document.getElementById('delete-modal').classList.add('hidden');
            document.getElementById('delete-modal').classList.remove('flex');
        }

        function confirmDelete() {
            if (deleteUserId) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/users/${deleteUserId}`;
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

        function editUser(userId, name, email, role) {
            document.getElementById('edit-form').action = `/users/${userId}`;
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-email').value = email;
            document.getElementById('edit-role').value = role;
            
            document.getElementById('edit-modal').classList.remove('hidden');
            document.getElementById('edit-modal').classList.add('flex');
        }

        function closeEditModal() {
            document.getElementById('edit-modal').classList.add('hidden');
            document.getElementById('edit-modal').classList.remove('flex');
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