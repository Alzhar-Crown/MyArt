<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use function Laravel\Prompts\progress;

class ControllerProfil extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $daftarProfil = Profil::all();
        return view('profil', ['daftar_user' => $daftarProfil]);
        //
    }

    public function myProfil()
    {
        $daftarProfil = Profil::all();
        return view('profil', ['daftar_user' => $daftarProfil]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        if (session('progress')) {
            $user_data = session('user_data');
            return view('p1', compact('user_data'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Auth::user()->profil()->create();
        $request->validate([
            'nama_depan' => 'required|unique:profils,nama_depan|max:10',
            'nama_belakang' => 'required|min:5|max:50'
        ]);
        $id = session('user_data')['id'];

        $newProfil = new Profil();
        $newProfil->nama_depan = $request['nama_depan'];
        $newProfil->nama_belakang = $request['nama_belakang'];
        $newProfil->user_id = $id;
        $newProfil->save();
        // $id = $this->show($newProfil->username);

        // $request->session()->put('user_data', [
        //     'id' => $id['id'],
        //     'username' =>  $newProfil->username,
        //     'password' => $newProfil->password

        // ]);

        return view('formLogn');

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
    public function edit()
    {
        //
        return view('formProfil');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'foto_profil' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'deskripsi' => 'min:50|max:200'
        ]);
        $profil = Profil::where('user_id', $id)->firstOrFail();;
        if (isset($request['foto_profil'])) {
            $file = $request->file('foto_profil');
            $namaFile = time() . '_' . $file->getClientOriginalName(); // Nama unik
            if ($profil['foto_profil'] != $file) {
                $file->move(public_path('client'), $namaFile);
            }
            $profil->foto_profil = $namaFile;
        }
        
        $profil->nama_depan = $request['nama_depan'];
        $profil->nama_belakang = $request['nama_belakang'];
        $profil->headline = $request['headline'];
        $profil->deskripsi = $request['deskripsi'];
        $profil->save();


        return redirect()->route('clear');
    }

    public function ClearSession()
    {
        $profil = Profil::where('user_id', session('dataProfil')['user_id'])->firstOrFail();
        session()->flush();
        session()->regenerateToken();
        session()->put('dataProfil', [
            'user_id' => $profil['user_id'],
            'nama_depan' => $profil['nama_depan'],
            'nama_belakang' => $profil['nama_belakang'],
            'headline' => $profil['headline'],
            'deskripsi' => $profil['deskripsi'],
            'foto_profil' => $profil['foto_profil'] ?? 'empty'

        ]);
        return view('profil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
