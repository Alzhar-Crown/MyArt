<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerPortofolio extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //  
        $porto = Portofolio::All();
        $categorized = [
            'uiux' => [],
            'typhografi' => [],
            'poster' => [],
            '2d' => [],
            '3d' => [],
        ];
        foreach ($porto as $item) {
            switch ($item->kategori_desain) {
                case 'ui/ux':
                    $categorized['uiux'][] = $item;
                    break;
                case 'typhografi':
                    $categorized['typhografi'][] = $item;
                    break;
                case 'poster':
                    $categorized['poster'][] = $item;
                    break;
                case '2d illustration':
                    $categorized['2d'][] = $item;
                    break;
                case '3d illustration':
                    $categorized['3d'][] = $item;
                    break;
            }
        }
        return view('portofolio', compact('categorized'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('form+por');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'preview' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10000',
            'deskripsi' => 'max:200'
        ]);
        $portofolio = new Portofolio();
        $file = $request->file('preview');
        $namaFile = time() . '_' . $file->getClientOriginalName(); // Nama unik
        if ($portofolio['preview'] != $file) {
            $file->move(public_path('portofolio'), $namaFile);
        }
        $portofolio->user_id = session('dataProfil')['user_id'];
        $portofolio->nama_depan = session('dataProfil')['nama_depan'];
        $portofolio->deskripsi = $request['deskripsi'];
        $portofolio->headline = $request['headline'];
        $portofolio->kategori_desain = $request['kategori_desain'];
        $portofolio->preview = $namaFile;
        $portofolio->save();
        return redirect()->route('clearProfil');
    }

    public function ClearProfil()
    {
        session()->forget('dataCatalog');
        $portofolio = Portofolio::where('user_id', Auth::id())->get();
        session()->put('dataPortofolio', [
            'user_id' => Auth::id(),
        ]);

        return view('profil', compact('portofolio'));
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
