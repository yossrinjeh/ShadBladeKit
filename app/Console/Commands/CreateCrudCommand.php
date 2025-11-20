<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CreateCrudCommand extends Command
{
    protected $signature = 'create:crud {name}';
    protected $description = 'Generate complete CRUD with design system, permissions and sidebar integration';

    public function handle()
    {
        $name = $this->argument('name');
        $modelName = Str::studly($name);
        $tableName = Str::snake(Str::plural($name));
        $routeName = Str::kebab(Str::plural($name));
        
        $this->info("Creating CRUD for: {$modelName}");
        
        $this->createMigration($modelName, $tableName);
        $this->createModel($modelName);
        $this->createController($modelName, $routeName);
        $this->createViews($modelName, $routeName);
        $this->createRequest($modelName);
        $this->updateRoutes($modelName, $routeName);
        $this->updateSidebar($modelName, $routeName);
        $this->createPermissionSeeder($modelName, $routeName);
        $this->updateTranslations($modelName);
        
        // Auto-run migration and seeder
        $this->call('migrate');
        $this->call('db:seed', ['--class' => "{$modelName}PermissionSeeder"]);
        
        $this->info("✅ CRUD for {$modelName} created successfully!");
        $this->info("✅ Migration executed");
        $this->info("✅ Permissions created");
    }

    private function createMigration($modelName, $tableName)
    {
        $timestamp = date('Y_m_d_His');
        $migrationName = "create_{$tableName}_table";
        $migrationPath = database_path("migrations/{$timestamp}_{$migrationName}.php");
        
        $stub = "<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('{$tableName}', function (Blueprint \$table) {
            \$table->id();
            \$table->string('title');
            \$table->text('description')->nullable();
            \$table->boolean('is_active')->default(true);
            \$table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('{$tableName}');
    }
};";
        
        File::put($migrationPath, $stub);
        $this->info("Created migration: {$migrationName}");
    }

    private function createModel($modelName)
    {
        $modelPath = app_path("Models/{$modelName}.php");
        $stub = "<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class {$modelName} extends Model
{
    use HasFactory, LogsActivity;

    protected \$fillable = [
        'title',
        'description',
        'is_active',
    ];

    protected \$casts = [
        'is_active' => 'boolean',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'description', 'is_active'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}";
        
        File::put($modelPath, $stub);
        $this->info("Created model: {$modelName}");
    }

    private function createController($modelName, $routeName)
    {
        $controllerPath = app_path("Http/Controllers/{$modelName}Controller.php");
        $variable = Str::camel($modelName);
        
        $stub = "<?php

namespace App\Http\Controllers;

use App\Models\\{$modelName};
use App\Http\Requests\\{$modelName}Request;
use Illuminate\Http\Request;

class {$modelName}Controller extends Controller
{
    public function index(Request \$request)
    {
        \$query = {$modelName}::query();

        if (\$request->filled('search')) {
            \$query->where('title', 'like', '%' . \$request->search . '%');
        }

        \$items = \$query->latest()->paginate(10);

        return view('{$routeName}.index', compact('items'));
    }

    public function create()
    {
        return view('{$routeName}.create');
    }

    public function store({$modelName}Request \$request)
    {
        {$modelName}::create(\$request->validated());

        activity()
            ->causedBy(auth()->user())
            ->log('{$modelName} created');

        return redirect()->route('{$routeName}.index')->with('success', '{$modelName} created successfully.');
    }

    public function show({$modelName} \${$variable})
    {
        return view('{$routeName}.show', compact('{$variable}'));
    }

    public function edit({$modelName} \${$variable})
    {
        return view('{$routeName}.edit', compact('{$variable}'));
    }

    public function update({$modelName}Request \$request, {$modelName} \${$variable})
    {
        \${$variable}->update(\$request->validated());

        activity()
            ->causedBy(auth()->user())
            ->performedOn(\${$variable})
            ->log('{$modelName} updated');

        return redirect()->route('{$routeName}.index')->with('success', '{$modelName} updated successfully.');
    }

    public function destroy({$modelName} \${$variable})
    {
        \${$variable}->delete();

        activity()
            ->causedBy(auth()->user())
            ->log('{$modelName} deleted');

        return redirect()->route('{$routeName}.index')->with('success', '{$modelName} deleted successfully.');
    }

    public function bulkDelete(Request \$request)
    {
        \$ids = \$request->input('ids', []);
        {$modelName}::whereIn('id', \$ids)->delete();

        activity()
            ->causedBy(auth()->user())
            ->withProperties(['deleted_count' => count(\$ids)])
            ->log('Bulk {$modelName} deletion');

        return response()->json(['success' => true, 'message' => count(\$ids) . ' items deleted successfully.']);
    }
}";
        
        File::put($controllerPath, $stub);
        $this->info("Created controller: {$modelName}Controller");
    }

    private function createRequest($modelName)
    {
        $requestPath = app_path("Http/Requests/{$modelName}Request.php");
        $stub = "<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class {$modelName}Request extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ];
    }
}";
        
        File::put($requestPath, $stub);
        $this->info("Created request: {$modelName}Request");
    }

    private function createViews($modelName, $routeName)
    {
        $viewDir = resource_path("views/{$routeName}");
        File::makeDirectory($viewDir, 0755, true);
        
        $this->createIndexView($modelName, $routeName, $viewDir);
        $this->createCreateView($modelName, $routeName, $viewDir);
        $this->createEditView($modelName, $routeName, $viewDir);
        $this->createShowView($modelName, $routeName, $viewDir);
        
        $this->info("Created views in: {$routeName}/");
    }

    private function createIndexView($modelName, $routeName, $viewDir)
    {
        $plural = Str::plural($modelName);
        $variable = Str::camel($modelName);
        $stub = "<x-app-layout>
    <x-slot name=\"header\">
        <div class=\"flex items-center justify-between\">
            <h2 class=\"font-semibold text-xl leading-tight\">
                {{ __('{$plural}') }} Management
            </h2>
            @can('create {$routeName}')
            <x-ui.button onclick=\"openCreateModal()\">
                <svg class=\"w-4 h-4 mr-2\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 6v6m0 0v6m0-6h6m-6 0H6\"></path>
                </svg>
                Add {$modelName}
            </x-ui.button>
            @endcan
        </div>
    </x-slot>

    <div class=\"space-y-6\">
        <!-- Filters & Search -->
        <x-ui.card>
            <div class=\"p-6\">
                <form method=\"GET\" class=\"flex flex-wrap gap-4\">
                    <div class=\"flex-1 min-w-64\">
                        <x-ui.input 
                            type=\"text\" 
                            name=\"search\" 
                            placeholder=\"Search {$plural}...\" 
                            value=\"{{ request('search') }}\"
                            class=\"w-full\"
                        />
                    </div>
                    <x-ui.button type=\"submit\" variant=\"outline\">
                        <svg class=\"w-4 h-4 mr-2\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                            <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z\"></path>
                        </svg>
                        Search
                    </x-ui.button>
                    @if(request('search'))
                        <a href=\"{{ route('{$routeName}.index') }}\" class=\"inline-flex items-center px-4 py-2 text-sm font-medium text-muted-foreground hover:text-foreground\">
                            Clear
                        </a>
                    @endif
                </form>
            </div>
        </x-ui.card>

        <!-- {$plural} Table -->
        <x-ui.card>
            <div class=\"p-6\">
                <div class=\"flex items-center justify-between mb-4\">
                    <h3 class=\"text-lg font-semibold\">{$plural} ({{ \$items->total() }})</h3>
                    @can('delete {$routeName}')
                    <x-ui.button variant=\"destructive\" size=\"sm\" onclick=\"bulkDelete()\" id=\"bulk-delete-btn\" style=\"display: none;\">
                        Delete Selected
                    </x-ui.button>
                    @endcan
                </div>

                <div class=\"overflow-x-auto\">
                    <table class=\"w-full\">
                        <thead>
                            <tr class=\"border-b\">
                                @can('delete {$routeName}')
                                <th class=\"text-left py-3 px-4\">
                                    <input type=\"checkbox\" id=\"select-all\" class=\"rounded border-input\">
                                </th>
                                @endcan
                                <th class=\"text-left py-3 px-4\">Title</th>
                                <th class=\"text-left py-3 px-4\">Description</th>
                                <th class=\"text-left py-3 px-4\">Status</th>
                                <th class=\"text-left py-3 px-4\">Created</th>
                                <th class=\"text-left py-3 px-4\">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(\$items as \$item)
                            <tr class=\"border-b hover:bg-accent/50\">
                                @can('delete {$routeName}')
                                <td class=\"py-3 px-4\">
                                    <input type=\"checkbox\" class=\"item-checkbox rounded border-input\" value=\"{{ \$item->id }}\">
                                </td>
                                @endcan
                                <td class=\"py-3 px-4 font-medium\">{{ \$item->title }}</td>
                                <td class=\"py-3 px-4 text-muted-foreground\">{{ Str::limit(\$item->description, 50) }}</td>
                                <td class=\"py-3 px-4\">
                                    <span class=\"inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ \$item->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}\">
                                        {{ \$item->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class=\"py-3 px-4 text-sm text-muted-foreground\">{{ \$item->created_at->format('M j, Y') }}</td>
                                <td class=\"py-3 px-4\">
                                    <div class=\"flex items-center space-x-2\">
                                        @can('edit {$routeName}')
                                        <button onclick=\"edit{$modelName}({{ \$item->id }}, '{{ \$item->title }}', '{{ \$item->description }}', {{ \$item->is_active ? 'true' : 'false' }})\" 
                                                class=\"inline-flex items-center px-3 py-1.5 text-xs font-medium text-blue-700 bg-blue-100 hover:bg-blue-200 rounded-lg transition-colors border border-blue-200\">
                                            <svg class=\"w-3 h-3 mr-1.5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z\"></path>
                                            </svg>
                                            Edit
                                        </button>
                                        @endcan
                                        @can('delete {$routeName}')
                                        <button onclick=\"delete{$modelName}({{ \$item->id }})\" 
                                                class=\"inline-flex items-center px-3 py-1.5 text-xs font-medium text-red-700 bg-red-100 hover:bg-red-200 rounded-lg transition-colors border border-red-200\">
                                            <svg class=\"w-3 h-3 mr-1.5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                                                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16\"></path>
                                            </svg>
                                            Delete
                                        </button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan=\"6\" class=\"py-8 text-center text-muted-foreground\">
                                    No {$plural} found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class=\"mt-6\">
                    {{ \$items->links() }}
                </div>
            </div>
        </x-ui.card>
    </div>

    <!-- Create Modal -->
    <div id=\"create-modal\" class=\"fixed inset-0 bg-black/50 hidden items-center justify-center z-50\">
        <div class=\"bg-background rounded-lg p-6 w-full max-w-md mx-4\">
            <h3 class=\"text-lg font-semibold mb-4\">Create New {$modelName}</h3>
            <form method=\"POST\" action=\"{{ route('{$routeName}.store') }}\" class=\"space-y-4\">
                @csrf
                <div>
                    <label class=\"block text-sm font-medium mb-1\">Title</label>
                    <x-ui.input type=\"text\" name=\"title\" required />
                </div>
                <div>
                    <label class=\"block text-sm font-medium mb-1\">Description</label>
                    <textarea name=\"description\" rows=\"3\" class=\"w-full rounded-md border border-input bg-background px-3 py-2 text-sm\"></textarea>
                </div>
                <div class=\"flex items-center\">
                    <input type=\"checkbox\" name=\"is_active\" value=\"1\" checked class=\"rounded border-input\">
                    <label class=\"ml-2 text-sm font-medium\">Active</label>
                </div>
                <div class=\"flex justify-end space-x-2 pt-4\">
                    <x-ui.button type=\"button\" variant=\"outline\" onclick=\"closeCreateModal()\">Cancel</x-ui.button>
                    <x-ui.button type=\"submit\">Create {$modelName}</x-ui.button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id=\"edit-modal\" class=\"fixed inset-0 bg-black/50 hidden items-center justify-center z-50\">
        <div class=\"bg-background rounded-lg p-6 w-full max-w-md mx-4\">
            <h3 class=\"text-lg font-semibold mb-4\">Edit {$modelName}</h3>
            <form id=\"edit-form\" method=\"POST\" class=\"space-y-4\">
                @csrf
                @method('PUT')
                <div>
                    <label class=\"block text-sm font-medium mb-1\">Title</label>
                    <x-ui.input type=\"text\" name=\"title\" id=\"edit-title\" required />
                </div>
                <div>
                    <label class=\"block text-sm font-medium mb-1\">Description</label>
                    <textarea name=\"description\" id=\"edit-description\" rows=\"3\" class=\"w-full rounded-md border border-input bg-background px-3 py-2 text-sm\"></textarea>
                </div>
                <div class=\"flex items-center\">
                    <input type=\"checkbox\" name=\"is_active\" id=\"edit-is-active\" value=\"1\" class=\"rounded border-input\">
                    <label class=\"ml-2 text-sm font-medium\">Active</label>
                </div>
                <div class=\"flex justify-end space-x-2 pt-4\">
                    <x-ui.button type=\"button\" variant=\"outline\" onclick=\"closeEditModal()\">Cancel</x-ui.button>
                    <x-ui.button type=\"submit\">Update {$modelName}</x-ui.button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id=\"delete-modal\" class=\"fixed inset-0 bg-black/50 hidden items-center justify-center z-50\">
        <div class=\"bg-background rounded-lg p-6 w-full max-w-md mx-4\">
            <div class=\"flex items-center mb-4\">
                <div class=\"flex-shrink-0 w-10 h-10 mx-auto bg-red-100 rounded-full flex items-center justify-center\">
                    <svg class=\"w-6 h-6 text-red-600\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                        <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z\"></path>
                    </svg>
                </div>
            </div>
            <h3 class=\"text-lg font-semibold text-center mb-2\">Delete {$modelName}</h3>
            <p class=\"text-sm text-muted-foreground text-center mb-6\">Are you sure you want to delete this {$variable}? This action cannot be undone.</p>
            <div class=\"flex justify-end space-x-2\">
                <x-ui.button type=\"button\" variant=\"outline\" onclick=\"closeDeleteModal()\">Cancel</x-ui.button>
                <x-ui.button type=\"button\" variant=\"destructive\" onclick=\"confirmDelete()\">Delete</x-ui.button>
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

        let deleteItemId = null;

        function delete{$modelName}(itemId) {
            deleteItemId = itemId;
            document.getElementById('delete-modal').classList.remove('hidden');
            document.getElementById('delete-modal').classList.add('flex');
        }

        function closeDeleteModal() {
            deleteItemId = null;
            document.getElementById('delete-modal').classList.add('hidden');
            document.getElementById('delete-modal').classList.remove('flex');
        }

        function confirmDelete() {
            if (deleteItemId) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/{$routeName}/\${deleteItemId}`;
                form.innerHTML = `@csrf @method('DELETE')`;
                document.body.appendChild(form);
                form.submit();
            }
        }

        function edit{$modelName}(itemId, title, description, isActive) {
            document.getElementById('edit-form').action = `/{$routeName}/\${itemId}`;
            document.getElementById('edit-title').value = title;
            document.getElementById('edit-description').value = description;
            document.getElementById('edit-is-active').checked = isActive;
            
            document.getElementById('edit-modal').classList.remove('hidden');
            document.getElementById('edit-modal').classList.add('flex');
        }

        function closeEditModal() {
            document.getElementById('edit-modal').classList.add('hidden');
            document.getElementById('edit-modal').classList.remove('flex');
        }

        // Bulk selection
        document.getElementById('select-all')?.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.item-checkbox');
            checkboxes.forEach(cb => cb.checked = this.checked);
            toggleBulkActions();
        });

        document.querySelectorAll('.item-checkbox').forEach(cb => {
            cb.addEventListener('change', toggleBulkActions);
        });

        function toggleBulkActions() {
            const selected = document.querySelectorAll('.item-checkbox:checked').length;
            const bulkBtn = document.getElementById('bulk-delete-btn');
            if (bulkBtn) {
                bulkBtn.style.display = selected > 0 ? 'block' : 'none';
            }
        }

        function bulkDelete() {
            const selected = Array.from(document.querySelectorAll('.item-checkbox:checked')).map(cb => cb.value);
            if (selected.length === 0) return;
            
            if (confirm(`Delete \${selected.length} selected {$plural}?`)) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route(\"{$routeName}.bulk-delete\") }}';
                form.innerHTML = `@csrf \${selected.map(id => `<input type=\"hidden\" name=\"ids[]\" value=\"\${id}\">`).join('')}`;
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</x-app-layout>";
        
        File::put("{$viewDir}/index.blade.php", $stub);
    }

    private function createCreateView($modelName, $routeName, $viewDir)
    {
        $stub = "<x-app-layout>
    <x-slot name=\"header\">
        <h2 class=\"font-semibold text-xl leading-tight\">
            {{ __('Create {$modelName}') }}
        </h2>
    </x-slot>

    <div class=\"py-12\">
        <div class=\"max-w-2xl mx-auto sm:px-6 lg:px-8\">
            <x-ui.card>
                <form method=\"POST\" action=\"{{ route('{$routeName}.store') }}\" class=\"space-y-6\">
                    @csrf

                    <div>
                        <x-input-label for=\"title\" :value=\"__('Title')\" />
                        <x-ui.input id=\"title\" name=\"title\" type=\"text\" :value=\"old('title')\" required />
                        <x-input-error :messages=\"\$errors->get('title')\" class=\"mt-2\" />
                    </div>

                    <div>
                        <x-input-label for=\"description\" :value=\"__('Description')\" />
                        <textarea id=\"description\" name=\"description\" rows=\"4\" class=\"mt-1 block w-full border-gray-300 rounded-md shadow-sm\">{{ old('description') }}</textarea>
                        <x-input-error :messages=\"\$errors->get('description')\" class=\"mt-2\" />
                    </div>

                    <div class=\"flex items-center\">
                        <input id=\"is_active\" name=\"is_active\" type=\"checkbox\" value=\"1\" {{ old('is_active', true) ? 'checked' : '' }} class=\"rounded border-gray-300\">
                        <x-input-label for=\"is_active\" :value=\"__('Active')\" class=\"ml-2\" />
                    </div>

                    <div class=\"flex items-center gap-4\">
                        <x-ui.button type=\"submit\">{{ __('Create') }}</x-ui.button>
                        <x-ui.button href=\"{{ route('{$routeName}.index') }}\" variant=\"secondary\">{{ __('Cancel') }}</x-ui.button>
                    </div>
                </form>
            </x-ui.card>
        </div>
    </div>
</x-app-layout>";
        
        File::put("{$viewDir}/create.blade.php", $stub);
    }

    private function createEditView($modelName, $routeName, $viewDir)
    {
        $variable = Str::camel($modelName);
        $stub = "<x-app-layout>
    <x-slot name=\"header\">
        <h2 class=\"font-semibold text-xl leading-tight\">
            {{ __('Edit {$modelName}') }}
        </h2>
    </x-slot>

    <div class=\"py-12\">
        <div class=\"max-w-2xl mx-auto sm:px-6 lg:px-8\">
            <x-ui.card>
                <form method=\"POST\" action=\"{{ route('{$routeName}.update', \${$variable}) }}\" class=\"space-y-6\">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for=\"title\" :value=\"__('Title')\" />
                        <x-ui.input id=\"title\" name=\"title\" type=\"text\" :value=\"old('title', \${$variable}->title)\" required />
                        <x-input-error :messages=\"\$errors->get('title')\" class=\"mt-2\" />
                    </div>

                    <div>
                        <x-input-label for=\"description\" :value=\"__('Description')\" />
                        <textarea id=\"description\" name=\"description\" rows=\"4\" class=\"mt-1 block w-full border-gray-300 rounded-md shadow-sm\">{{ old('description', \${$variable}->description) }}</textarea>
                        <x-input-error :messages=\"\$errors->get('description')\" class=\"mt-2\" />
                    </div>

                    <div class=\"flex items-center\">
                        <input id=\"is_active\" name=\"is_active\" type=\"checkbox\" value=\"1\" {{ old('is_active', \${$variable}->is_active) ? 'checked' : '' }} class=\"rounded border-gray-300\">
                        <x-input-label for=\"is_active\" :value=\"__('Active')\" class=\"ml-2\" />
                    </div>

                    <div class=\"flex items-center gap-4\">
                        <x-ui.button type=\"submit\">{{ __('Update') }}</x-ui.button>
                        <x-ui.button href=\"{{ route('{$routeName}.index') }}\" variant=\"secondary\">{{ __('Cancel') }}</x-ui.button>
                    </div>
                </form>
            </x-ui.card>
        </div>
    </div>
</x-app-layout>";
        
        File::put("{$viewDir}/edit.blade.php", $stub);
    }

    private function createShowView($modelName, $routeName, $viewDir)
    {
        $variable = Str::camel($modelName);
        $stub = "<x-app-layout>
    <x-slot name=\"header\">
        <div class=\"flex justify-between items-center\">
            <h2 class=\"font-semibold text-xl leading-tight\">
                {{ \${$variable}->title }}
            </h2>
            <div class=\"flex gap-2\">
                @can('edit {$routeName}')
                <x-ui.button href=\"{{ route('{$routeName}.edit', \${$variable}) }}\">{{ __('Edit') }}</x-ui.button>
                @endcan
                <x-ui.button href=\"{{ route('{$routeName}.index') }}\" variant=\"secondary\">{{ __('Back') }}</x-ui.button>
            </div>
        </div>
    </x-slot>

    <div class=\"py-12\">
        <div class=\"max-w-4xl mx-auto sm:px-6 lg:px-8\">
            <x-ui.card>
                <div class=\"space-y-6\">
                    <div>
                        <h3 class=\"text-lg font-medium\">{{ __('Title') }}</h3>
                        <p class=\"mt-1\">{{ \${$variable}->title }}</p>
                    </div>

                    @if(\${$variable}->description)
                    <div>
                        <h3 class=\"text-lg font-medium\">{{ __('Description') }}</h3>
                        <p class=\"mt-1\">{{ \${$variable}->description }}</p>
                    </div>
                    @endif

                    <div>
                        <h3 class=\"text-lg font-medium\">{{ __('Status') }}</h3>
                        <span class=\"mt-1 inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ \${$variable}->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}\">
                            {{ \${$variable}->is_active ? __('Active') : __('Inactive') }}
                        </span>
                    </div>

                    <div>
                        <h3 class=\"text-lg font-medium\">{{ __('Created') }}</h3>
                        <p class=\"mt-1\">{{ \${$variable}->created_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
            </x-ui.card>
        </div>
    </div>
</x-app-layout>";
        
        File::put("{$viewDir}/show.blade.php", $stub);
    }

    private function updateRoutes($modelName, $routeName)
    {
        $routesPath = base_path('routes/web.php');
        $content = File::get($routesPath);
        
        // Check if routes already exist
        if (strpos($content, "Route::resource('{$routeName}'") !== false) {
            $this->info("Routes already exist for {$modelName}");
            return;
        }
        
        $newRoute = "\n    // {$modelName} Management Routes\n    Route::middleware(['can:view {$routeName}'])->group(function () {\n        Route::resource('{$routeName}', App\\Http\\Controllers\\{$modelName}Controller::class);\n        Route::post('/{$routeName}/bulk-delete', [App\\Http\\Controllers\\{$modelName}Controller::class, 'bulkDelete'])->name('{$routeName}.bulk-delete')->middleware('can:delete {$routeName}');\n    });";
        
        // Insert before the closing auth middleware group
        $searchFor = "});\n\nrequire __DIR__.'/auth.php';";
        $replaceWith = $newRoute . "\n});\n\nrequire __DIR__.'/auth.php';";
        $content = str_replace($searchFor, $replaceWith, $content);
        
        File::put($routesPath, $content);
        $this->info("Updated routes");
    }

    private function updateSidebar($modelName, $routeName)
    {
        $sidebarPath = resource_path('views/components/ui/sidebar.blade.php');
        $content = File::get($sidebarPath);
        
        $icon = '<svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>';
        
        $sidebarItem = "\n                        @can('view {$routeName}')\n                        <a href=\"{{ route('{$routeName}.index') }}\" class=\"group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('{$routeName}.*') ? 'bg-primary text-primary-foreground' : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground' }}\">\n                            {$icon}\n                            {{ __('" . Str::plural($modelName) . "') }}\n                        </a>\n                        @endcan";
        
        $content = str_replace('{{-- Add more navigation items here --}}', $sidebarItem . "\n                {{-- Add more navigation items here --}}", $content);
        File::put($sidebarPath, $content);
        $this->info("Updated sidebar");
    }

    private function createPermissionSeeder($modelName, $routeName)
    {
        $seederPath = database_path("seeders/{$modelName}PermissionSeeder.php");
        
        $stub = "<?php

namespace Database\\Seeders;

use Illuminate\\Database\\Seeder;
use Spatie\\Permission\\Models\\Role;
use Spatie\\Permission\\Models\\Permission;

class {$modelName}PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Create {$modelName} permissions
        Permission::firstOrCreate(['name' => 'view {$routeName}']);
        Permission::firstOrCreate(['name' => 'create {$routeName}']);
        Permission::firstOrCreate(['name' => 'edit {$routeName}']);
        Permission::firstOrCreate(['name' => 'delete {$routeName}']);
        
        // Assign permissions to admin role
        \$adminRole = Role::where('name', 'admin')->first();
        if (\$adminRole) {
            \$adminRole->givePermissionTo([
                'view {$routeName}',
                'create {$routeName}',
                'edit {$routeName}',
                'delete {$routeName}'
            ]);
        }
    }
}";
        
        File::put($seederPath, $stub);
        $this->info("Created permission seeder: {$modelName}PermissionSeeder");
    }

    private function updateTranslations($modelName)
    {
        $languages = ['en', 'fr', 'es', 'ar'];
        foreach ($languages as $lang) {
            $translationPath = resource_path("lang/{$lang}/navigation.php");
            if (File::exists($translationPath)) {
                $content = File::get($translationPath);
                $content = str_replace('];', "    '" . Str::plural($modelName) . "' => '" . Str::plural($modelName) . "',\n];", $content);
                File::put($translationPath, $content);
            }
        }
        $this->info("Updated translations");
    }
}