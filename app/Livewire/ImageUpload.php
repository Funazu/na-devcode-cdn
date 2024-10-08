<?php

namespace App\Livewire;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImageUpload extends Component
{
    use WithFileUploads;

    public $files = [];

    public function save()
    {
        info("njayyyy");
        $this->validate([
            'files.*' => 'file|max:51200', // Validasi setiap file adalah gambar dan maksimal 1MB
        ]);

        foreach ($this->files as $file) {
            info($file->getClientOriginalName());
            info(json_encode($file));
            $name = $file->getClientOriginalName();
            $path = $file->store('images'); // Simpan file ke storage
            $cekImage = Image::create([
                'path' => $path,
                'name' => $name, // Simpan nama file di database
            ]); // Simpan informasi file ke database
        }

        session()->flash('message', 'Images uploaded successfully.');

        // Reset files setelah upload
        $this->files = [];
    }

    public function render()
    {
        $images = Image::latest()->get();
        return view('livewire.image-upload', [
            'images' => $images
        ])->layout('layouts.app');  // Pastikan layout sesuai dengan yang digunakan
    }


    public function deleteImage($id)
    {
        $image = Image::find($id);

        // Hapus file dari storage
        if (Storage::disk('public')->exists($image->path)) {
            Storage::disk('public')->delete($image->path);
        }

        // Hapus data dari database
        $image->delete();

        session()->flash('message', 'Image deleted successfully.');
    }

    // public function mount()
    // {
    //     $this->file = Image::all();
    // }
}
