<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Files') }}
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

                <form wire:submit.prevent="save">
                    <div class="mb-4">
                        <label for="file" class="block text-gray-700 text-sm font-bold mb-2">Select Files:</label>
                        <input type="file" id="file" wire:model="fileuploads" class="block mt-1 w-full" multiple> <!-- Multiple file input -->

                        @error('fileuploads.*')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="bg-blue-500 text-white p-2 rounded">Upload Files</button>
                </form>
            </div>

            <!-- Tabel File -->
            <div class="mt-8">
                <h3 class="font-semibold text-xl text-gray-800 leading-tight mb-4">Uploaded Files</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Size</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($files as $file)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $file->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ number_format($file->size / 1024, 2) }} KB</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex space-x-2">
                                            <a href="{{ Storage::url($file->path) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded" download>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4-4m0 0l4-4m-4 4v12m0 0h12m0 0V8m0 8l4-4m0 0L8 8m0 8h12"/>
                                                </svg>
                                            </a>
                                            <button wire:click="deleteFile({{ $file->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
