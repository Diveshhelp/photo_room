<?php

namespace App\Livewire;

use App\Models\Video;
use Livewire\Component;

class VideoAlbumShow extends Component
{
    public $album;

    public function mount($id)
    {
        // Eager load attachments to prevent N+1 query issues
        $this->album = Video::with('attachments')->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.video-album-show')->layout('layouts.guest');
    }
}