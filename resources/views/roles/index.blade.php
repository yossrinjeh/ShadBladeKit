<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl leading-tight">
                Roles & Permissions Management
            </h2>
            <div class="flex space-x-2">
                <x-ui.button onclick="openCreateRoleModal()">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Create Role
                </x-ui.button>
                <x-ui.button variant="outline" onclick="openCreatePermissionModal()">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    Create Permission
                </x-ui.button>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Toast Notifications -->
        @if (session('status') === 'role-created')
            <x-ui.toast type="success" title="Success" message="Role created successfully!" />
        @elseif (session('status') === 'role-updated')
            <x-ui.toast type="success" title="Success" message="Role updated successfully!" />
        @elseif (session('status') === 'role-deleted')
            <x-ui.toast type="success" title="Success" message="Role deleted successfully!" />
        @elseif (session('status') === 'permission-created')
            <x-ui.toast type="success" title="Success" message="Permission created successfully!" />
        @elseif (session('status') === 'permission-deleted')
            <x-ui.toast type="success" title="Success" message="Permission deleted successfully!" />
        @elseif (session('error'))
            <x-ui.toast type="error" title="Error" message="{{ session('error') }}" />
        @endif

        <!-- Roles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($roles as $role)
            <x-ui.card>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="font-semibold text-lg">{{ ucfirst($role->name) }}</h3>
                            <p class="text-sm text-muted-foreground">{{ $role->permissions->count() }} permissions</p>
                        </div>
                        <x-dropdown align="right">
                            <x-slot name="trigger">
                                <button class="p-2 hover:bg-accent rounded-md">
                                    <span class="text-lg">⋮</span>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link href="#" onclick="editRole({{ $role->id }}, '{{ $role->name }}', {{ $role->permissions->pluck('id') }})">
                                    Edit Role
                                </x-dropdown-link>
                                @if($role->name !== 'admin')
                                <x-dropdown-link href="#" onclick="deleteRole({{ $role->id }})" class="text-destructive">
                                    Delete Role
                                </x-dropdown-link>
                                @endif
                            </x-slot>
                        </x-dropdown>
                    </div>
                    
                    <div class="space-y-2">
                        <h4 class="text-sm font-medium">Permissions:</h4>
                        <div class="flex flex-wrap gap-1">
                            @forelse($role->permissions as $permission)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-primary/10 text-primary">
                                    {{ $permission->name }}
                                </span>
                            @empty
                                <span class="text-xs text-muted-foreground">No permissions assigned</span>
                            @endforelse
                        </div>
                    </div>
                    
                    <div class="mt-4 pt-4 border-t">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-muted-foreground">Users with this role:</span>
                            <span class="font-medium">{{ $role->users->count() }}</span>
                        </div>
                    </div>
                </div>
            </x-ui.card>
            @endforeach
        </div>

        <!-- Permissions List -->
        <x-ui.card>
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">All Permissions</h3>
                @php
                    $groupedPermissions = $permissions->groupBy(function($permission) {
                        $parts = explode(' ', $permission->name);
                        return count($parts) > 1 ? $parts[1] : 'general';
                    });
                @endphp
                
                <div class="space-y-6">
                    @foreach($groupedPermissions as $module => $modulePermissions)
                    <div class="border rounded-lg p-4">
                        <h4 class="text-md font-semibold mb-3 capitalize flex items-center">
                            <svg class="w-5 h-5 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            {{ $module }} Module
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                            @foreach($modulePermissions as $permission)
                            <div class="flex items-center justify-between p-3 bg-muted/30 rounded-md">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1721 9z"/>
                                    </svg>
                                    <span class="text-sm font-medium">{{ $permission->name }}</span>
                                </div>
                                <button onclick="deletePermission({{ $permission->id }})" class="text-destructive hover:text-destructive/80">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </x-ui.card>
    </div>

    <!-- Create Role Modal -->
    <div id="create-role-modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-background rounded-lg p-6 w-full max-w-4xl mx-4">
            <h3 class="text-lg font-semibold mb-4">Create New Role</h3>
            <form method="POST" action="{{ route('roles.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium mb-1">Role Name</label>
                    <x-ui.input type="text" name="name" required />
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Permissions</label>
                    <div class="max-h-96 overflow-y-auto">
                        @php
                            $groupedPermissions = $permissions->groupBy(function($permission) {
                                $parts = explode(' ', $permission->name);
                                return count($parts) > 1 ? $parts[1] : 'general';
                            });
                        @endphp
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach($groupedPermissions as $module => $modulePermissions)
                            <div class="border rounded-lg p-3">
                                <div class="flex items-center space-x-2 mb-2">
                                    <input type="checkbox" class="module-checkbox rounded border-input" data-module="{{ $module }}" onchange="toggleModule('{{ $module }}')"> 
                                    <span class="text-sm font-semibold capitalize">{{ $module }}</span>
                                </div>
                                <div class="space-y-1">
                                    @foreach($modulePermissions as $permission)
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="rounded border-input permission-checkbox" data-module="{{ $module }}">
                                        <span class="text-xs">{{ $permission->name }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="flex justify-end space-x-2 pt-4">
                    <x-ui.button type="button" variant="outline" onclick="closeCreateRoleModal()">Cancel</x-ui.button>
                    <x-ui.button type="submit">Create Role</x-ui.button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Role Modal -->
    <div id="edit-role-modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-background rounded-lg p-6 w-full max-w-4xl mx-4">
            <h3 class="text-lg font-semibold mb-4">Edit Role</h3>
            <form id="edit-role-form" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-medium mb-1">Role Name</label>
                    <x-ui.input type="text" name="name" id="edit-role-name" required />
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Permissions</label>
                    <div class="max-h-96 overflow-y-auto" id="edit-permissions">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach($groupedPermissions as $module => $modulePermissions)
                            <div class="border rounded-lg p-3">
                                <div class="flex items-center space-x-2 mb-2">
                                    <input type="checkbox" class="edit-module-checkbox rounded border-input" data-module="{{ $module }}" onchange="toggleEditModule('{{ $module }}')"> 
                                    <span class="text-sm font-semibold capitalize">{{ $module }}</span>
                                </div>
                                <div class="space-y-1">
                                    @foreach($modulePermissions as $permission)
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="rounded border-input edit-permission" data-permission="{{ $permission->id }}" data-module="{{ $module }}">
                                        <span class="text-xs">{{ $permission->name }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="flex justify-end space-x-2 pt-4">
                    <x-ui.button type="button" variant="outline" onclick="closeEditRoleModal()">Cancel</x-ui.button>
                    <x-ui.button type="submit">Update Role</x-ui.button>
                </div>
            </form>
        </div>
    </div>

    <!-- Create Permission Modal -->
    <div id="create-permission-modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-background rounded-lg p-6 w-full max-w-md mx-4">
            <h3 class="text-lg font-semibold mb-4">Create New Permission</h3>
            <form method="POST" action="{{ route('permissions.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium mb-1">Permission Name</label>
                    <x-ui.input type="text" name="name" placeholder="e.g., manage posts" required />
                    <p class="text-xs text-muted-foreground mt-1">Use lowercase with spaces (e.g., "view users", "edit posts")</p>
                </div>
                <div class="flex justify-end space-x-2 pt-4">
                    <x-ui.button type="button" variant="outline" onclick="closeCreatePermissionModal()">Cancel</x-ui.button>
                    <x-ui.button type="submit">Create Permission</x-ui.button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openCreateRoleModal() {
            document.getElementById('create-role-modal').classList.remove('hidden');
            document.getElementById('create-role-modal').classList.add('flex');
        }

        function closeCreateRoleModal() {
            document.getElementById('create-role-modal').classList.add('hidden');
            document.getElementById('create-role-modal').classList.remove('flex');
        }

        function openCreatePermissionModal() {
            document.getElementById('create-permission-modal').classList.remove('hidden');
            document.getElementById('create-permission-modal').classList.add('flex');
        }

        function closeCreatePermissionModal() {
            document.getElementById('create-permission-modal').classList.add('hidden');
            document.getElementById('create-permission-modal').classList.remove('flex');
        }

        function editRole(id, name, permissions) {
            document.getElementById('edit-role-name').value = name;
            document.getElementById('edit-role-form').action = `/roles/${id}`;
            
            // Clear all checkboxes
            document.querySelectorAll('.edit-permission').forEach(cb => cb.checked = false);
            document.querySelectorAll('.edit-module-checkbox').forEach(cb => {
                cb.checked = false;
                cb.indeterminate = false;
            });
            
            // Check permissions for this role
            permissions.forEach(permissionId => {
                const checkbox = document.querySelector(`[data-permission="${permissionId}"]`);
                if (checkbox) checkbox.checked = true;
            });
            
            // Update module checkbox states
            updateEditModuleStates();
            
            document.getElementById('edit-role-modal').classList.remove('hidden');
            document.getElementById('edit-role-modal').classList.add('flex');
        }

        function closeEditRoleModal() {
            document.getElementById('edit-role-modal').classList.add('hidden');
            document.getElementById('edit-role-modal').classList.remove('flex');
        }

        function deleteRole(id) {
            if (confirm('Are you sure you want to delete this role?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/roles/${id}`;
                form.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;
                document.body.appendChild(form);
                form.submit();
            }
        }

        function deletePermission(id) {
            if (confirm('Are you sure you want to delete this permission?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/permissions/${id}`;
                form.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;
                document.body.appendChild(form);
                form.submit();
            }
        }

        function toggleModule(module) {
            const moduleCheckbox = document.querySelector(`[data-module="${module}"].module-checkbox`);
            const permissionCheckboxes = document.querySelectorAll(`[data-module="${module}"].permission-checkbox`);
            
            permissionCheckboxes.forEach(checkbox => {
                checkbox.checked = moduleCheckbox.checked;
            });
        }

        function toggleEditModule(module) {
            const moduleCheckbox = document.querySelector(`[data-module="${module}"].edit-module-checkbox`);
            const permissionCheckboxes = document.querySelectorAll(`[data-module="${module}"].edit-permission`);
            
            permissionCheckboxes.forEach(checkbox => {
                checkbox.checked = moduleCheckbox.checked;
            });
        }

        // Update module checkbox state when individual permissions change
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('permission-checkbox')) {
                const module = e.target.dataset.module;
                const moduleCheckbox = document.querySelector(`[data-module="${module}"].module-checkbox`);
                const permissionCheckboxes = document.querySelectorAll(`[data-module="${module}"].permission-checkbox`);
                const checkedCount = Array.from(permissionCheckboxes).filter(cb => cb.checked).length;
                
                if (checkedCount === 0) {
                    moduleCheckbox.checked = false;
                    moduleCheckbox.indeterminate = false;
                } else if (checkedCount === permissionCheckboxes.length) {
                    moduleCheckbox.checked = true;
                    moduleCheckbox.indeterminate = false;
                } else {
                    moduleCheckbox.checked = false;
                    moduleCheckbox.indeterminate = true;
                }
            }
            
            if (e.target.classList.contains('edit-permission')) {
                const module = e.target.dataset.module;
                const moduleCheckbox = document.querySelector(`[data-module="${module}"].edit-module-checkbox`);
                const permissionCheckboxes = document.querySelectorAll(`[data-module="${module}"].edit-permission`);
                const checkedCount = Array.from(permissionCheckboxes).filter(cb => cb.checked).length;
                
                if (checkedCount === 0) {
                    moduleCheckbox.checked = false;
                    moduleCheckbox.indeterminate = false;
                } else if (checkedCount === permissionCheckboxes.length) {
                    moduleCheckbox.checked = true;
                    moduleCheckbox.indeterminate = false;
                } else {
                    moduleCheckbox.checked = false;
                    moduleCheckbox.indeterminate = true;
                }
            }
        });

        function updateEditModuleStates() {
            // Update module checkbox states when edit modal opens
            document.querySelectorAll('.edit-module-checkbox').forEach(moduleCheckbox => {
                const module = moduleCheckbox.dataset.module;
                const permissionCheckboxes = document.querySelectorAll(`[data-module="${module}"].edit-permission`);
                const checkedCount = Array.from(permissionCheckboxes).filter(cb => cb.checked).length;
                
                if (checkedCount === 0) {
                    moduleCheckbox.checked = false;
                    moduleCheckbox.indeterminate = false;
                } else if (checkedCount === permissionCheckboxes.length) {
                    moduleCheckbox.checked = true;
                    moduleCheckbox.indeterminate = false;
                } else {
                    moduleCheckbox.checked = false;
                    moduleCheckbox.indeterminate = true;
                }
            });
        }
    </script>
</x-app-layout>