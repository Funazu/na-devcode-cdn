<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Image') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if (session()->has('message'))
                <div class="bg-green-500 text-white p-2 rounded mb-4">
                    {{ session('message') }}
                </div>
                @endif

                <!-- Form Upload -->
                <form wire:submit.prevent="save">
                    <div class="mb-4">
                        <label for="files" class="block text-gray-700 text-sm font-bold mb-2">Files:</label>
                        <input type="file" id="files" wire:model="files" class="block mt-1 w-full" multiple required>

                        @error('files.*')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="bg-blue-500 text-white p-2 rounded">Upload</button>
                </form>

            </div>

            <!-- Gallery Grid -->
            <div class="mt-8">
                <h3 class="font-semibold text-xl text-gray-800 leading-tight mb-4">Gallery</h3>
                <!-- Refresh Button -->
                {{-- <button onclick="refreshGrid()" class="text-gray-500 hover:text-gray-700">
                    <!-- Ikon Reload -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 7v4h4M4 7a7 7 0 0114 0h4a11 11 0 00-11-11V4M4 17a7 7 0 0014 0h4a11 11 0 01-11 11V17" />
                    </svg>
                </button> --}}
                <div class="masonry-grid">
                    @foreach($images as $image)
                    <div class="masonry-item">
                        <div class="image-wrapper">
                            <!-- Image -->
                            <img src="{{ asset('storage/' . $image->path) }}" alt="Uploaded Image">

                            <!-- Floating Icons -->
                            <div class="image-actions">
                                <!-- Copy Link Button -->
                                <button onclick="copyToClipboard('{{ asset('storage/' . $image->path) }}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 12h8m-4-4v8m4-8a4 4 0 00-8 0v8a4 4 0 008 0v-8a4 4 0 00-8 0v8a4 4 0 008 0v-8a4 4 0 00-8 0v8a4 4 0 008 0v-8a4 4 0 00-8 0v8" />
                                    </svg>
                                </button>

                                <!-- Delete Button -->
                                <button wire:click="deleteImage({{ $image->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>

                                <!-- Download Button -->
                                <button onclick="window.location.href='{{ asset('storage/' . $image->path) }}'"
                                    download="{{ $image->name }}" class="action-button">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 3v9m0 0l-3-3m3 3l3-3m-3 3v9" />
                                    </svg>
                                </button>
                            </div>

                            <div class="image-name">{{ $image->name }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <script>
        function refreshGrid() {
        // Jika menggunakan Livewire, kamu bisa memanggil metode atau melakukan refresh data
            Livewire.emit('refreshGallery');

            // Jika menggunakan Masonry.js
            var elem = document.querySelector('.masonry-grid');
            var msnry = Masonry.data(elem); // Ambil instance Masonry yang ada
            if (msnry) {
                msnry.layout(); // Perbarui layout Masonry
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            var elem = document.querySelector('.masonry-grid');
            var msnry = new Masonry(elem, {
                itemSelector: '.masonry-item',
                columnWidth: '.masonry-item',
                percentPosition: true
            });

            // Memperbarui layout dengan requestAnimationFrame
            function updateLayout() {
                msnry.layout();
                requestAnimationFrame(updateLayout);
            }
            updateLayout();
        });


    
        function copyToClipboard(link) {
            navigator.clipboard.writeText(link).then(function() {
                alert('Link copied to clipboard');
            }, function(err) {
                alert('Failed to copy link');
            });
        }
    </script>

</div>