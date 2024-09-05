<?php

namespace App\Livewire;

use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class FileUpload extends Component
{
    use WithFileUploads;

    public $fileuploads = []; // Array untuk menyimpan multiple file

    public function save()
    {
        $this->validate([
            'fileuploads.*' => 'required|file|max:51200', // Validasi file multiple
        ]);

        foreach ($this->fileuploads as $file) {
            $path = $file->store('files', 'public');

            File::create([
                'name' => $file->getClientOriginalName(), // Menggunakan getClientOriginalName() untuk nama file
                'path' => $path,
                'size' => $file->getSize(), // Ukuran file dalam byte
            ]);
        }

        session()->flash('message', 'Files uploaded successfully.');
        $this->reset('fileuploads'); // Reset input file setelah upload
    }


    public function render()
    {
        $files = File::latest()->get();
        return view('livewire.file-upload', [
            'files' => $files
        ])->layout('layouts.app');
    }

    public function deleteFile($id)
    {
        $file = File::find($id);

        if (Storage::disk('public')->exists($file->path)) {
            Storage::disk('public')->delete($file->path);
        }

        $file->delete();

        session()->flash('message', 'File deleted successfully.');
    }
}
