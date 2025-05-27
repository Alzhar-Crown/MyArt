<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerInteraksi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $like = Like::where('user_id', Auth::id())->get();
    }
    public function love($id)
    {
       
        logger('User ID:', [Auth::id()]);
        logger('Portofolio ID:', [$id]);
        $porto = Portofolio::where('id', $id)->first();
        $liked = session()->get('indicator', []);

        $hasLiked = Like::where('user_id', Auth::id())
            ->where('portofolio_id', $id)
            ->exists();

        if ($hasLiked) {
            // Jika sudah like, langsung redirect balik tanpa tambah like
            return redirect()->back();
        }

        $porto->jumlah_like += 1;
        $porto->save();



        $like = new Like();
        $like->user_id = Auth::id();
        $like->portofolio_id = $id;
        $like->preview = $porto->preview;
        $like->headline = $porto->headline;
        $like->deskripsi = $porto->deskripsi;
        $like->save();

        if (!is_array($liked)) {
            $liked = [$liked];
        }
        // Tambahkan ID baru kalau belum ada
        if (!in_array($porto->id, $liked)) {
            $liked[] = $porto->id;
            session()->put('indicator', $liked);
        }
        return redirect()->back();

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
        //
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
