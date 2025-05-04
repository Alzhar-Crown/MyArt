<?php

namespace App\Events;

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;

class ControllerKelas extends Controller
{
    /**
     * Display a listing of the resource.   
     */
    public function index()
    {
        //
    //     $daftarUser = User::all();
    //     return view('admin.dashboard',['daftar_user' => $daftarUser]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('newKelas');

        
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data_baru= new User();
        $data_baru->username = $request['username'];
        $data_baru->password = $request['password'];

        $data_baru->save();

        // $request->session()->invalidate();

        //redirect ke success biar sesi dihapus dan buat token baru setelah itu baru ke index   
        return redirect()->route('kelas.succes');

        

    }

    public function success(Request $request){
        session()->regenerate();
        $request->session()->regenerateToken();

        return $this->index();

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
            $daftarUser = User::findorFail($id);
            return view('editKelas', ['user' => $daftarUser]);
            
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = user::find($id);
        $user->username = $request['username'];
        $user->password = $request['password'];
        $user->save();

        return redirect()->route('kelas.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        User::destroy($id);
        return redirect()->route('kelas.index');
        //
    }
}
