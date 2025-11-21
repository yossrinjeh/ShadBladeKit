@props([
    'name' => 'content',
    'value' => '',
    'placeholder' => 'Start writing...',
    'height' => 'h-64'
])

<div x-data="richEditor()" class="border rounded-md overflow-hidden">
    <!-- Toolbar -->
    <div class="border-b bg-muted/30 p-2 flex flex-wrap items-center gap-1">
        <!-- Format Buttons -->
        <button type="button" @click="execCommand('bold')" class="p-2 rounded hover:bg-accent" title="Bold">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4h8a4 4 0 014 4 4 4 0 01-4 4H6z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h9a4 4 0 014 4 4 4 0 01-4 4H6z" />
            </svg>
        </button>
        
        <button type="button" @click="execCommand('italic')" class="p-2 rounded hover:bg-accent" title="Italic">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 4l4 16m-4-8h8" />
            </svg>
        </button>
        
        <button type="button" @click="execCommand('underline')" class="p-2 rounded hover:bg-accent" title="Underline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19h14M7 7a4 4 0 018 0v8a4 4 0 01-8 0V7z" />
            </svg>
        </button>
        
        <div class="w-px h-6 bg-border mx-1"></div>
        
        <!-- Heading Dropdown -->
        <select @change="execCommand('formatBlock', $event.target.value)" class="text-sm border-0 bg-transparent">
            <option value="">Normal</option>
            <option value="<h1>">Heading 1</option>
            <option value="<h2>">Heading 2</option>
            <option value="<h3>">Heading 3</option>
        </select>
        
        <div class="w-px h-6 bg-border mx-1"></div>
        
        <!-- List Buttons -->
        <button type="button" @click="execCommand('insertUnorderedList')" class="p-2 rounded hover:bg-accent" title="Bullet List">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        
        <button type="button" @click="execCommand('insertOrderedList')" class="p-2 rounded hover:bg-accent" title="Numbered List">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
        
        <div class="w-px h-6 bg-border mx-1"></div>
        
        <!-- Link Button -->
        <button type="button" @click="insertLink()" class="p-2 rounded hover:bg-accent" title="Insert Link">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
            </svg>
        </button>
        
        <!-- Image Button -->
        <button type="button" @click="insertImage()" class="p-2 rounded hover:bg-accent" title="Insert Image">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
        </button>
    </div>
    
    <!-- Editor Content -->
    <div 
        x-ref="editor"
        contenteditable="true"
        class="p-4 {{ $height }} overflow-y-auto focus:outline-none"
        @input="updateContent()"
        @paste="handlePaste($event)"
        :data-placeholder="'{{ $placeholder }}'"
    ></div>
    
    <!-- Hidden Input -->
    <input type="hidden" name="{{ $name }}" x-model="content" />
</div>



<style>
[contenteditable].empty:before {
    content: attr(data-placeholder);
    color: rgb(156 163 175);
    pointer-events: none;
}

[contenteditable] h1 { font-size: 2em; font-weight: bold; margin: 0.5em 0; }
[contenteditable] h2 { font-size: 1.5em; font-weight: bold; margin: 0.5em 0; }
[contenteditable] h3 { font-size: 1.2em; font-weight: bold; margin: 0.5em 0; }
[contenteditable] ul, [contenteditable] ol { margin: 0.5em 0; padding-left: 2em; }
[contenteditable] a { color: rgb(59 130 246); text-decoration: underline; }
[contenteditable] img { max-width: 100%; height: auto; }
</style>