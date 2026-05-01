<?php

namespace App\Livewire;

use App\Models\Photo;
use Livewire\Component;

class AlbumShow extends Component
{
    public $album;

    public function mount($id)
    {
        // Eager load attachments to prevent N+1 query issues
        $this->album = Photo::with('attachments')->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.album-show')->layout('layouts.guest');
    }
}