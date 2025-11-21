// Alpine.js component functions
window.richEditor = function() {
    return {
        content: '',
        placeholder: 'Start writing...',
        
        init() {
            this.content = this.$refs.editor.innerHTML;
            if (!this.content) {
                this.$refs.editor.classList.add('empty');
            }
        },
        
        execCommand(command, value = null) {
            document.execCommand(command, false, value);
            this.updateContent();
            this.$refs.editor.focus();
        },
        
        updateContent() {
            this.content = this.$refs.editor.innerHTML;
            
            if (this.$refs.editor.textContent.trim() === '') {
                this.$refs.editor.classList.add('empty');
            } else {
                this.$refs.editor.classList.remove('empty');
            }
        },
        
        insertLink() {
            const url = prompt('Enter URL:');
            if (url) {
                this.execCommand('createLink', url);
            }
        },
        
        insertImage() {
            const url = prompt('Enter image URL:');
            if (url) {
                this.execCommand('insertImage', url);
            }
        },
        
        handlePaste(event) {
            event.preventDefault();
            const text = event.clipboardData.getData('text/plain');
            this.execCommand('insertText', text);
        }
    }
};

window.advancedTable = function() {
    return {
        search: '',
        itemsPerPage: 10,
        currentPage: 1,
        selectedItems: [],
        sortColumn: '',
        sortDirection: 'asc',
        data: [],
        
        get filteredData() {
            let filtered = this.data;
            
            if (this.search) {
                filtered = filtered.filter(item => 
                    Object.values(item).some(value => 
                        String(value).toLowerCase().includes(this.search.toLowerCase())
                    )
                );
            }
            
            if (this.sortColumn) {
                filtered.sort((a, b) => {
                    let aVal = a[this.sortColumn];
                    let bVal = b[this.sortColumn];
                    
                    if (this.sortDirection === 'asc') {
                        return aVal > bVal ? 1 : -1;
                    } else {
                        return aVal < bVal ? 1 : -1;
                    }
                });
            }
            
            return filtered;
        },
        
        get paginatedData() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = start + this.itemsPerPage;
            return this.filteredData.slice(start, end);
        },
        
        get totalPages() {
            return Math.ceil(this.filteredData.length / this.itemsPerPage);
        },
        
        sort(column) {
            if (this.sortColumn === column) {
                this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                this.sortColumn = column;
                this.sortDirection = 'asc';
            }
        },
        
        toggleSelection(id) {
            const index = this.selectedItems.indexOf(id);
            if (index > -1) {
                this.selectedItems.splice(index, 1);
            } else {
                this.selectedItems.push(id);
            }
        },
        
        selectAll() {
            if (this.selectedItems.length === this.paginatedData.length) {
                this.selectedItems = [];
            } else {
                this.selectedItems = this.paginatedData.map(item => item.id);
            }
        },
        
        deleteSelected() {
            if (confirm('Are you sure you want to delete selected items?')) {
                this.data = this.data.filter(item => !this.selectedItems.includes(item.id));
                this.selectedItems = [];
            }
        }
    }
};

window.dataTable = function() {
    return {
        search: '',
        selectedItems: [],
        
        toggleSelection(id) {
            const index = this.selectedItems.indexOf(id);
            if (index > -1) {
                this.selectedItems.splice(index, 1);
            } else {
                this.selectedItems.push(id);
            }
        },
        
        selectAll() {
            const checkboxes = document.querySelectorAll('.row-checkbox');
            const allChecked = Array.from(checkboxes).every(cb => cb.checked);
            
            checkboxes.forEach(cb => {
                cb.checked = !allChecked;
            });
            
            this.selectedItems = allChecked ? [] : Array.from(checkboxes).map(cb => cb.value);
        }
    }
};

window.fileUpload = function() {
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
};