@props([
    'headers' => [],
    'rows' => [],
    'searchable' => true,
    'filterable' => false,
    'exportable' => false,
    'bulkActions' => false
])

<div class="space-y-4">
    @if($searchable || $filterable || $exportable)
    <!-- Table Controls -->
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div class="flex items-center space-x-4">
            @if($searchable)
            <div class="relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <x-ui.input type="text" placeholder="Search..." class="pl-10" />
            </div>
            @endif
            
            @if($filterable)
            <select class="rounded-md border border-input bg-background px-3 py-2 text-sm">
                <option>All Items</option>
            </select>
            @endif
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
            <x-ui.button variant="destructive" size="sm" id="bulk-actions" style="display: none;">
                Delete Selected
            </x-ui.button>
            @endif
        </div>
    </div>
    @endif

    <!-- Table -->
    <div class="rounded-md border">
        <table class="w-full">
            <thead class="bg-muted/50">
                <tr>
                    @if($bulkActions)
                    <th class="w-12 px-4 py-3">
                        <input type="checkbox" id="select-all" class="rounded border-input">
                    </th>
                    @endif
                    
                    @foreach($headers as $header)
                    <th class="px-4 py-3 text-left text-sm font-medium">
                        {{ $header }}
                    </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="divide-y">
                {{ $slot }}
            </tbody>
        </table>
    </div>
    
    <!-- Table Footer -->
    <div class="flex items-center justify-between text-sm text-muted-foreground">
        <div>
            Showing {{ $rows->firstItem() ?? 0 }} to {{ $rows->lastItem() ?? 0 }} of {{ $rows->total() ?? 0 }} results
        </div>
        @if(method_exists($rows, 'links'))
        <div>
            {{ $rows->links() }}
        </div>
        @endif
    </div>
</div>

@if($bulkActions)
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAll = document.getElementById('select-all');
    const checkboxes = document.querySelectorAll('.row-checkbox');
    const bulkActions = document.getElementById('bulk-actions');
    
    selectAll?.addEventListener('change', function() {
        checkboxes.forEach(cb => cb.checked = this.checked);
        toggleBulkActions();
    });
    
    checkboxes.forEach(cb => {
        cb.addEventListener('change', toggleBulkActions);
    });
    
    function toggleBulkActions() {
        const selected = document.querySelectorAll('.row-checkbox:checked').length;
        if (bulkActions) {
            bulkActions.style.display = selected > 0 ? 'block' : 'none';
        }
    }
});
</script>
@endif