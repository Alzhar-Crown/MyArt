<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerCatalog extends Controller
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
        return view('form+cat');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'preview' =>'required|image|mimes:jpeg,png,jpg,gif,webp|max:2000',
            'file_desain' =>'required|image|mimes:jpeg,png,jpg,gif,webp|max:50000',
            'deskripsi'=> 'max:200'
        ]);
        $catalog = new Catalog();
        $preview = $request->file('preview');
        $file = $request->file('file_desain');
        $namaFile = time() . '_' . $file->getClientOriginalName(); // Nama unik
        $namaPreview = time() . '_' . $preview->getClientOriginalName(); // Nama unik
        if ($catalog['preview'] != $file) {
            $file->move(public_path('catalog'), $namaFile);
            $preview->move(public_path('catalog'), $namaPreview);
        }
        $catalog->user_id = session('dataProfil')['user_id'];
        $catalog->nama_depan = session('dataProfil')['nama_depan'];
        $catalog->deskripsi = $request['deskripsi'];
        $catalog->headline = $request['headline'];
        $catalog->harga = $request['harga'];
        $catalog->kategori_desain = $request['kategori_desain'];
        $catalog->preview = $namaPreview;
        $catalog->file_desain= $namaFile;
        $catalog->save();
        return redirect()->route('clearCatalog');
        //
    }

    
   
    public function ClearCatalog()
    {
        session()->forget('dataPortofolio');
        $catalog = Catalog::where('user_id',Auth::id())->get();
        session()->put('dataCatalog', [
            'user_id' => Auth::id(),
        ]);
        
        return view('profil',compact('catalog'));
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
