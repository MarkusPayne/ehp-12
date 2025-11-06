@props([
    'error' => false,
])
<div class="p-4 border-2 border-dashed rounded-lg">
    <div x-data="{ isDragging: false, isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
         x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
         x-on:livewire-upload-progress="progress = $event.detail.progress" x-on:dragover.prevent="isDragging = true"
         x-on:dragleave="isDragging = false"
         x-on:drop.prevent="
        isDragging = false;
        if (event.dataTransfer.files.length > 0) {
            const files = event.dataTransfer.files;
            @this.uploadMultiple('newUploads', files,
                (uploadedFilename) => {}, () => {}, (event) => {}
            )
        }
        "
         class="relative flex items-center justify-center h-40 transition-colors duration-300 bg-gray-100 border-2 border-gray-300 rounded-lg w-ful grow"
         :class="isDragging ? 'border-blue-500 bg-blue-100' : ''">
        <div class="text-center">
            <p class="mb-2 text-gray-600">Drag and drop your file here</p>
            <p class="text-sm text-gray-500">Or</p>
            
            <x-button.primary @click="$refs.fileInput.click()" class="mx-auto">Browse</x-button.primary>
            <div x-show="isUploading">
                <progress max="100" x-bind:value="progress"></progress>
            </div>
            <input type="file" id="fileInput" x-ref="fileInput" class="sr-only"
                   hidden {{ $attributes->merge(['class' => 'sr-only ']) }} >
            <x-input.error :error="$error" />
        </div>
    </div>
</div>

