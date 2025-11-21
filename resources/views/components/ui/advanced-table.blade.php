@props([
    'headers' => [],
    'searchable' => true,
    'sortable' => true,
    'exportable' => true,
    'bulkActions' => false,
    'perPage' => [10, 25, 50, 100]
])

<div class="space-y-4">
    <!-- Table Controls -->
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div class="flex items-center space-x-4">
            @if($searchable)
            <div class="relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <x-ui.input 
                    type="text" 
                    placeholder="Search..." 
                    class="pl-10 w-64" 
                    x-model="search"
                />
            </div>
            @endif
            
            <!-- Per Page Selector -->
            <select x-model="itemsPerPage" class="rounded-md border border-input bg-background px-3 py-2 text-sm">
                @foreach($perPage as $size)
                    <option value="{{ $size }}">{{ $size }} per page</option>
                @endforeach
            </select>
        </div>
        
        <div class="flex items-center space-x-2">
            @if($exportable)
            <x-dropdown align="right">
                <x-slot name="trigger">
                    <x-ui.button variant="outline" size="sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Export
                    </x-ui.button>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown-link href="#">Export as CSV</x-dropdown-link>
                    <x-dropdown-link href="#">Export as Excel</x-dropdown-link>
                    <x-dropdown-link href="#">Export as PDF</x-dropdown-link>
                </x-slot>
            </x-dropdown>
            @endif
            
            @if($bulkActions)
            <x-ui.button variant="destructive" size="sm" x-show="selectedItems.length > 0" @click="deleteSelected()">
                Delete Selected
            </x-ui.button>
            @endif
        </div>
    </div>

    <!-- Table -->
    <div class="rounded-md border overflow-hidden">
        <table class="w-full">
            <thead class="bg-muted/50">
                <tr>
                    @if($bulkActions)
                    <th class="w-12 px-4 py-3">
                        <input type="checkbox" class="rounded border-input" @change="selectAll()">
                    </th>
                    @endif
                    
                    @foreach($headers as $key => $header)
                    <th class="px-4 py-3 text-left text-sm font-medium cursor-pointer" @click="sort('{{ $key }}')">
                        {{ $header }}
                        <span x-show="sortColumn === '{{ $key }}'" x-text="sortDirection === 'asc' ? '↑' : '↓'"></span>
                    </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="divide-y">
                {{ $slot }}
            </tbody>
        </table>
        
        <!-- Empty State -->
        <div x-show="paginatedData.length === 0" class="text-center py-8 text-muted-foreground">
            <p>No data found</p>
        </div>
    </div>
    
    <!-- Pagination -->
    <div class="flex items-center justify-between text-sm text-muted-foreground">
        <div>
            Showing <span x-text="(currentPage - 1) * itemsPerPage + 1"></span> to 
            <span x-text="Math.min(currentPage * itemsPerPage, filteredData.length)"></span> of 
            <span x-text="filteredData.length"></span> results
        </div>
        <div class="flex items-center space-x-2">
            <button @click="currentPage = Math.max(1, currentPage - 1)" :disabled="currentPage === 1" class="px-3 py-1 rounded border disabled:opacity-50">
                Previous
            </button>
            <span x-text="currentPage + ' of ' + totalPages"></span>
            <button @click="currentPage = Math.min(totalPages, currentPage + 1)" :disabled="currentPage === totalPages" class="px-3 py-1 rounded border disabled:opacity-50">
                Next
            </button>
        </div>
    </div>
</div>