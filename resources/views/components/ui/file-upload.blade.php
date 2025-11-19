@props([
    'name' => 'file',
    'accept' => '*',
    'multiple' => false,
    'maxSize' => '10MB',
    'preview' => true
])

<div x-data="fileUpload()" class="w-full">
    <div 
        class="border-2 border-dashed border-muted-foreground/25 rounded-lg p-6 text-center hover:border-primary/50 transition-colors"
        @dragover.prevent="dragover = true"
        @dragleave.prevent="dragover = false"
        @drop.prevent="handleDrop($event)"
        :class="{ 'border-primary bg-primary/5': dragover }"
    >
        <input 
            type="file" 
            name="{{ $name }}" 
            {{ $multiple ? 'multiple' : '' }}
            accept="{{ $accept }}"
            class="hidden"
            x-ref="fileInput"
            @change="handleFiles($event.target.files)"
        />
        
        <div x-show="!files.length">
            <svg class="mx-auto h-12 w-12 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
            </svg>
            <p class="mt-2 text-sm text-muted-foreground">
                <button type="button" @click="$refs.fileInput.click()" class="font-medium text-primary hover:underline">
                    Click to upload
                </button>
                or drag and drop
            </p>
            <p class="text-xs text-muted-foreground">{{ $accept }} up to {{ $maxSize }}</p>
        </div>
        
        <!-- File Preview -->
        <div x-show="files.length" class="space-y-2">
            <template x-for="(file, index) in files" :key="index">
                <div class="flex items-center justify-between p-2 bg-muted rounded">
                    <div class="flex items-center space-x-2">
                        <svg class="h-4 w-4 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="text-sm" x-text="file.name"></span>
                        <span class="text-xs text-muted-foreground" x-text="formatFileSize(file.size)"></span>
                    </div>
                    <button type="button" @click="removeFile(index)" class="text-destructive hover:text-destructive/80">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </template>
            
            <button type="button" @click="$refs.fileInput.click()" class="text-sm text-primary hover:underline">
                Add more files
            </button>
        </div>
    </div>
</div>

<script>
function fileUpload() {
    return {
        files: [],
        dragover: false,
        
        handleFiles(fileList) {
            this.files = Array.from(fileList);
        },
        
        handleDrop(e) {
            this.dragover = false;
            this.handleFiles(e.dataTransfer.files);
        },
        
        removeFile(index) {
            this.files.splice(index, 1);
        },
        
        formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
    }
}
</script>