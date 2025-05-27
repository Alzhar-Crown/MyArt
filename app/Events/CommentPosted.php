<?php

namespace App\Events;

use App\Models\Comment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Support\Facades\Broadcast;

class CommentPosted implements ShouldBroadcastNow{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $comment;
    public $broadcastToEveryone = true;


    public function __construct(Comment $comment)
    {
        logger('CommentPosted event constructed.');

        $this->comment = $comment->load('user');
    }

    public function broadcastOn()
    {
        logger('Broadcasting on thread.' . $this->comment->thread_id);

        return new PrivateChannel('thread.' . $this->comment->thread_id);
    }

    public function broadcastWith()
    {
        return [
            'body' => $this->comment->body,
            'user' => $this->comment->user->profil->nama_depan,
            'created_at' => $this->comment->created_at->diffForHumans(),
        ];
    }
}
