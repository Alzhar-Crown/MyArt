<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('thread.{threadId}', function ($user, $threadId) {
    // Cek apakah user anggota thread/forum ini
    // Contoh fungsi cek: user punya akses thread
    return $user->threads()->where('id', $threadId)->exists();
});
