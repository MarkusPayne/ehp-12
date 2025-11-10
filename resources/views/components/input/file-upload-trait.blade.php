@props([
    'error' => false,
])
<div class="rounded-lg border-2 border-dashed p-4">
    <div
        x-data="{ isDragging: false, isUploading: false, progress: 0 }"
        x-on:livewire-upload-start="isUploading = true"
        x-on:livewire-upload-finish="isUploading = false"
        x-on:livewire-upload-error="isUploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress"
        x-on:dragover.prevent="isDragging = true"
        x-on:dragleave="isDragging = false"
        x-on:drop.prevent="
        isDragging = false;
        if (event.dataTransfer.files.length > 0) {
            const files = event.dataTransfer.files;
            @this.uploadMultiple('uploads', files,
                (uploadedFilename) => {}, () => {}, (event) => {}
            )
        }
        "
        class="relative flex h-40 w-100 grow items-center justify-center rounded-lg border-2 border-gray-300 bg-gray-100 transition-colors duration-300"
        :class="isDragging ? 'border-primary-500 bg-blue-100' : ''">
        <div class="text-center">
            <p class="mb-2 text-gray-600">Drag and drop your files here</p>
            <p class="text-sm text-gray-500">Or</p>

            <x-buttons.primary @click="$refs.fileInput.click()">Browse</x-buttons.primary>

            <div x-show="isUploading">
                <progress max="100" x-bind:value="progress"></progress>
            </div>
            <input type="file" id="fileInput" x-ref="fileInput" class="sr-only" multiple hidden wire:model.live="uploads" />
            <x-input.error :error="$error" />
        </div>
    </div>
</div>
