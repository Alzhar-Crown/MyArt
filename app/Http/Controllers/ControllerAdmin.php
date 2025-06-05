<?php

namespace App\Http\Controllers;

use App\Models\AdminWallet;
use App\Models\Catalog;
use App\Models\Ordered;
use App\Models\Portofolio;
use App\Models\Profil;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerAdmin extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function homeAdmin()
    {
        if (!session('adminlogin')) {
            return view('admin.login');
        }
        $catalog = Catalog::where('status', '<>', 'sold')->get();
        $adminWallet = AdminWallet::latest()->first();
        $portofolio = Portofolio::All();
        $user = User::All()->count();
        $ordered = Ordered::WhereDate('created_at',Carbon::today())->get();
        $transaksi = $ordered->count();



        $categorizedCatalog = [
            'UI/UX' => 0,
            'Real Pict' => 0,
            '2d Illustration' => 0,
            '3d Illustration' => 0,
        ];
        $categorizedPortofolio = [
            'UI/UX' => 0,
            'Poster' => 0,
            '2d Illustration' => 0,
            '3d Illustration' => 0,
            'Typhografi'=> 0,
        ];

        foreach ($catalog as $item) {
            switch ($item->kategori_desain) {
                case 'uiux':
                    $categorizedCatalog['UI/UX']++;
                    break;
                case 'realpic':
                    $categorizedCatalog['Real Pict']++;
                    break;
                case '2d illustration':
                    $categorizedCatalog['2d Illustration']++;
                    break;
                case '3d illustration':
                    $categorizedCatalog['3d Illustration']++;
                    break;
            }
        }
        foreach ($portofolio as $item) {
            switch ($item->kategori_desain) {
                case 'uiux':
                    $categorizedPortofolio['UI/UX']++;
                    break;
                case 'poster':
                    $categorizedPortofolio['Poster']++;
                    break;
                case '2d illustration': 
                    $categorizedPortofolio['2d Illustration']++;
                    break;
                case '3d illustration':
                    $categorizedPortofolio['3d Illustration']++;
                    break;
                case 'typhografi':
                    $categorizedPortofolio['Typhografi']++;
                    break;
            }
        }
        return view('admin.home-admin', [
            'labelsCatalog' => array_keys($categorizedCatalog),
            'dataCatalog' => array_values($categorizedCatalog),
            'labelsPortofolio' => array_keys($categorizedPortofolio),
            'dataPortofolio' => array_values($categorizedPortofolio),
            
        ],compact('user','transaksi','adminWallet'));
    }
    public function index()
    {
        //
        if (!session('adminlogin')) {
            return view('admin.login');
        }

        $daftarUser = User::with('profil')->get();
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

        return redirect()->route('home.admin');
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
        $user = User::find(Auth::id());
        $user->username = $request['username'];
        $user->password = $request['password'];
        $user->save();
        return redirect()->back()->with('success', 'Data diubah');
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
