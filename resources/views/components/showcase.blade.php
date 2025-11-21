<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl leading-tight">
                Advanced UI Components Library
            </h2>
            <div class="text-sm text-muted-foreground">
                Press <kbd class="px-2 py-1 bg-muted rounded text-xs">Ctrl+K</kbd> to open command palette
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        <!-- File Upload Component -->
        <x-ui.card>
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">File Upload Component</h3>
                <p class="text-sm text-muted-foreground mb-4">Drag & drop file upload with preview and progress tracking</p>
                
                <form method="POST" action="{{ route('components.file-upload') }}" enctype="multipart/form-data">
                    @csrf
                    <x-ui.file-upload name="files[]" accept="image/*,.pdf,.doc,.docx" multiple="true" />
                    <div class="mt-4">
                        <x-ui.button type="submit">Upload Files</x-ui.button>
                    </div>
                </form>
                
                @if(session('uploaded_files'))
                    <div class="mt-4 p-4 bg-green-50 dark:bg-green-900/20 rounded-md">
                        <h4 class="font-medium text-green-800 dark:text-green-200">Files uploaded successfully:</h4>
                        <ul class="mt-2 text-sm text-green-700 dark:text-green-300">
                            @foreach(session('uploaded_files') as $file)
                                <li>{{ $file['name'] }} ({{ number_format($file['size'] / 1024, 2) }} KB)</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </x-ui.card>

        <!-- Rich Text Editor -->
        <x-ui.card>
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">Rich Text Editor</h3>
                <p class="text-sm text-muted-foreground mb-4">WYSIWYG editor with formatting toolbar and media support</p>
                
                <form method="POST" action="{{ route('components.rich-content') }}">
                    @csrf
                    <x-ui.rich-editor 
                        name="content" 
                        placeholder="Start writing your content here..."
                        value="{{ old('content', '<h2>Welcome to the Rich Editor</h2><p>This is a <strong>powerful</strong> and <em>flexible</em> rich text editor component.</p><ul><li>Format text with toolbar</li><li>Insert links and images</li><li>Create lists and headings</li></ul>') }}"
                    />
                    <div class="mt-4">
                        <x-ui.button type="submit">Save Content</x-ui.button>
                    </div>
                </form>
                
                @if(session('saved_content'))
                    <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-md">
                        <h4 class="font-medium text-blue-800 dark:text-blue-200">Saved Content Preview:</h4>
                        <div class="mt-2 prose prose-sm max-w-none">
                            {!! session('saved_content') !!}
                        </div>
                    </div>
                @endif
            </div>
        </x-ui.card>

        <!-- Advanced Data Table -->
        <x-ui.card>
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">Advanced Data Table</h3>
                <p class="text-sm text-muted-foreground mb-4">Feature-rich table with search, sort, pagination, and export</p>
                
                <div x-data="advancedTable()" x-init="data = [
                        { id: 1, name: 'John Doe', email: 'john@example.com', role: 'Admin', status: 'Active', created: '2024-01-15' },
                        { id: 2, name: 'Jane Smith', email: 'jane@example.com', role: 'User', status: 'Active', created: '2024-01-20' },
                        { id: 3, name: 'Bob Johnson', email: 'bob@example.com', role: 'User', status: 'Inactive', created: '2024-02-01' },
                        { id: 4, name: 'Alice Brown', email: 'alice@example.com', role: 'Editor', status: 'Active', created: '2024-02-15' },
                        { id: 5, name: 'Charlie Wilson', email: 'charlie@example.com', role: 'User', status: 'Active', created: '2024-02-15' }
                    ]">
                    <x-ui.advanced-table 
                        :headers="['name' => 'Name', 'email' => 'Email', 'role' => 'Role', 'status' => 'Status', 'created' => 'Created']"
                        :searchable="true"
                        :sortable="true"
                        :exportable="true"
                        :bulk-actions="true"
                    >
                        <template x-for="item in paginatedData" :key="item.id">
                            <tr>
                                <td class="px-4 py-3">
                                    <input type="checkbox" class="rounded border-input" :value="item.id" @change="toggleSelection(item.id)">
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="h-8 w-8 rounded-full bg-primary flex items-center justify-center">
                                            <span class="text-sm font-medium text-primary-foreground" x-text="item.name.charAt(0)"></span>
                                        </div>
                                        <span class="font-medium" x-text="item.name"></span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm text-muted-foreground" x-text="item.email"></td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/10 text-primary" x-text="item.role"></span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" 
                                          :class="item.status === 'Active' ? 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400' : 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400'"
                                          x-text="item.status"></span>
                                </td>
                                <td class="px-4 py-3 text-sm text-muted-foreground" x-text="item.created"></td>
                            </tr>
                        </template>
                    </x-ui.advanced-table>
                </div>
            </div>
        </x-ui.card>

        <!-- Component Features Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <x-ui.card>
                <div class="p-6">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="p-2 bg-blue-100 dark:bg-blue-900/20 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="#3b82f6" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                        </div>
                        <h4 class="font-semibold">File Upload</h4>
                    </div>
                    <p class="text-sm text-muted-foreground">Drag & drop, multiple files, progress tracking, file type validation</p>
                </div>
            </x-ui.card>

            <x-ui.card>
                <div class="p-6">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="p-2 bg-green-100 dark:bg-green-900/20 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="#16a34a" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <h4 class="font-semibold">Rich Editor</h4>
                    </div>
                    <p class="text-sm text-muted-foreground">WYSIWYG editing, formatting toolbar, link & image insertion</p>
                </div>
            </x-ui.card>

            <x-ui.card>
                <div class="p-6">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="p-2 bg-purple-100 dark:bg-purple-900/20 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="#9333ea" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z" />
                            </svg>
                        </div>
                        <h4 class="font-semibold">Data Tables</h4>
                    </div>
                    <p class="text-sm text-muted-foreground">Search, sort, pagination, bulk actions, export functionality</p>
                </div>
            </x-ui.card>

            <x-ui.card>
                <div class="p-6">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="p-2 bg-orange-100 dark:bg-orange-900/20 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="#ea580c" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <h4 class="font-semibold">Command Palette</h4>
                    </div>
                    <p class="text-sm text-muted-foreground">Spotlight-style search, keyboard shortcuts, quick actions</p>
                </div>
            </x-ui.card>

            <x-ui.card>
                <div class="p-6">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="p-2 bg-red-100 dark:bg-red-900/20 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="#dc2626" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h4 class="font-semibold">Interactive Forms</h4>
                    </div>
                    <p class="text-sm text-muted-foreground">Dynamic validation, conditional fields, multi-step wizards</p>
                </div>
            </x-ui.card>

            <x-ui.card>
                <div class="p-6">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="p-2 bg-indigo-100 dark:bg-indigo-900/20 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="#4f46e5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <h4 class="font-semibold">Charts & Analytics</h4>
                    </div>
                    <p class="text-sm text-muted-foreground">Interactive charts, real-time data, export capabilities</p>
                </div>
            </x-ui.card>
        </div>
    </div>

    <!-- Command Palette -->
    <x-ui.command-palette />
</x-app-layout>