<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Portofolio;
use App\Models\Profil;
use App\Models\User;
use Illuminate\Http\Request;

class ControllerAdmin extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (!session('adminlogin')) {
            return view('admin.login');
        }

        $daftarUser = User::all();
        return view('admin.dash-akun', ['daftar_user' => $daftarUser]);
    }
    public function indexProfil()
    {
        //
        if (!session('adminlogin')) {
            return view('admin.login');
        }

        $daftarProfil = Profil::all();
        return view('admin.dash-profil', ['daftar_profil' => $daftarProfil]);
    }
    public function indexPortofolio()
    {
        //
        if (!session('adminlogin')) {
            return view('admin.login');
        }

        $daftarPorto = Portofolio::all();
        return view('admin.dash-portofolio', ['daftar_porto' => $daftarPorto]);
    }
    public function indexCatalog()
    {
        //
        if (!session('adminlogin')) {
            return view('admin.login');
        }

        $daftarCatalog = Catalog::all();
        return view('admin.dash-catalog', ['daftar_catalog' => $daftarCatalog]);
    }
    public function showLoginForm()
    {
        return view('admin.login');
    }
    public function login(Request $request)
    {
        session()->forget(['adminlogin']);
        $email = $request->email;

        //
        if ($request->email != 'alzhar@gmail.com' || $request->password != 'myart2025') {
            return back()->withErrors(['login' => 'Email atau password salah']);
        }
        session()->put('adminlogin', true);
        session()->put('email', $email);

        return redirect()->route('admin.index');
    }

    public function logOut()
    {
        //
        session()->forget(['adminlogin']);
        return redirect()->route('admin.fl');
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
        User::destroy($id);
        return redirect()->route('admin.index');
        //
    }
    public function destroyProfil(string $id)
    {
        Profil::destroy($id);
        return redirect()->route('admin.index');
        //
    }
    public function destroyPorto(string $id)
    {
        Portofolio::destroy($id);
        return redirect()->route('admin.index');
        //
    }
    public function destroyCatal(string $id)    
    {
        Catalog::destroy($id);
        return redirect()->route('admin.index');
        //
    }
}
    

