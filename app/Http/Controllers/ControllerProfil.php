<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\progress;

class ControllerProfil extends Controller
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
        if (session('progress')) {
            $user_data= session('user_data');
            return view('p1',compact('user_data'));
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
        $id= session('user_data')['id'];

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
