<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\Thread;
use Illuminate\Support\Facades\Auth;

class CommentSection extends Component
{
    public $thread;
    public $body;

    public function mount($thread)
    {
        $this->thread = $thread;
    }

    public function postComment()
    {
        $this->validate(['body' => 'required|string|max:1000']);

        $comment = Comment::create([
            'thread_id' => $this->thread->id,
            'body' => $this->body,
            'user_id' => Auth::id(),
        ]);

        $this->body = ''; // reset textarea
    }

    public function render()
    {
        return view('livewire.comment-section', [
            'comments' => $this->thread->comments()->latest()->get(),
            'thread'=>$this->thread
        ]);
    }
}

