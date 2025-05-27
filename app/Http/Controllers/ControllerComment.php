<?php

namespace App\Http\Controllers;

use App\Events\CommentPosted;
use App\Models\Comment;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerComment extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //



    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'thread_id' => 'required|exists:threads,id',
            'body' => 'required|string|max:1000',
        ]);

        $comment = Comment::with('user')->create([
            'thread_id' => $request->thread_id,
            'body' => $request->body,
            'user_id' => Auth::id(), // <= ini penting!
        ]);

        // $comment->load('user'); // pastikan ini setelah comment dibuat
        // logger('Dispatching CommentPosted');

        // CommentPosted::dispatch($comment);

        // return response()->json([
        //     'message' => 'Komentar berhasil ditambahkan',
        //     'body' => $comment->body,
        //     'user' => $comment->user->profil->nama_depan,
        //     'created_at' => $comment->created_at->diffForHumans(),
        // ]);
        // //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comment = Comment::where('thread_id', $id);
        $thread = Thread::find($id);
        return view('thread.showchat', compact('comment', 'thread'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
