<?php

namespace App\Http\Controllers;

use App\Events\CommentPosted;
use App\Models\Thread;
use App\Models\ThreadUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerThread extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $thread = Thread::with('user')->with('members')->get(); // optional: ambil user pembuat thread & urut terbaru

        // $thread->members->user_id == Auth::id();
        return view('thread.showforum', compact('thread'));
    }

    public function joinForum($id)
    {
        $thread = Thread::find($id);
        if (empty($thread)) {
            return redirect()->route('forum.index')->withErrors($id . 'Thread tidak ditemukan.');
        }

        $thread->members()->syncWithoutDetaching([Auth::id()]);

        return redirect()->route('forum.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('thread.forum+');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:130',
            'body' => 'required|string',
        ]);

        $thread = Auth::user()->threads()->create([
            'title' => $request->title,
            'body' => $request->body,
        ]);
        $thread->members()->attach(Auth::id());


        // $comment = Auth::user()->comments()->create([
        //     'thread_id' => $request->thread_id,
        //     'body' => $request->body,
        // ]);


        // CommentPosted::dispatch($comment);
        session()->flash('succes+', true);

        return redirect()->route('forum.index');        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
