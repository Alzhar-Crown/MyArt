<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Models\User;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

class ControllerUser extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function clearAllSession()
    {
        // Menghapus sesi tertentu
        session()->forget(['user_data', 'progress']);

        return view('awal');
    }
    public function awal(){
         // View Composer untuk home dan semua view profil.*
        //  View::composer(['home','profil.*'], function($view) {
        //     if (Auth::check()) {
        //         $profil = Profil::where('user_id', Auth::id())->first();
        //         $view->with('dataProfil', [
        //             'nama_depan'    => $profil->nama_depan,
        //             'nama_belakang' => $profil->nama_belakang,
        //         ]);
        //     }
        // });
    
        if (Auth::check()) {
            $profil = Profil::where('id', 1)->firstOrFail();
            session()->put('dataProfil', [
                'nama_depan' => $profil->nama_depan,
                'nama_belakang' => $profil->nama_belakang
            ]);

            return $this->home();

        }
        return view('awal');

    }

    public function home(){
        return redirect('/home');

    }

    public function index()
    {
        $listUser = User::all();
        return $listUser;
        //
    }
    public function showlogin()
    {
        if (Auth::check()) {
            return redirect('/home');
        }

        return view('formLogn');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        session()->forget(['user_data', 'progress']);

        return view('form+');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'username' => 'required|unique:_user,username|max:25',
            'password' => 'required|min:5|max:10'
        ]);

        $newUser = new User();
        $newUser->username = $request['username'];
        $newUser->password = Hash::make($request['password']);

        $newUser->save();
        $id = $this->show($newUser->username);

        $request->session()->put('user_data', [
            'id' => $id['id'],
            'username' =>  $newUser->username,
            'password' => $newUser->password

        ]);

        return redirect()->route('user.success1');
    }
    public function success1(Request $request)
    {
        $data = session('user_data');
        session()->regenerate();
        $request->session()->regenerateToken();
        session()->put('user_data', $data);
        session(['progress' => true]);
        // session()->reflash();


        return redirect()->route('profil.create');
    }

    public function autentikasi(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // prevent session fixation
            $profil = Profil::where('id', 1)->firstOrFail();
            session()->put('dataProfil', [
                'nama_depan' => $profil->nama_depan,
                'nama_belakang' => $profil->nama_belakang
            ]);
            return redirect()->intended('/home');
        }
        $BaseData = User::where('username', $request['username'])->first();
        if (!$BaseData) {
            return back()->with('error', 'The username you entered is not registered');
        }
        return back()->with('error', 'The password you entered is incorrect');


        // Auth::login($this->show($request['username']));
        // return view('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $username)
    {

        if (is_numeric($username)) {
            $user1 = User::where('id', $username)->firstorFail();
            return $user1;
        } else {
            $user = User::where('username', $username)->firstorFail();
            return $user;
        }

        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
    public function editFirst()
    {
        if (! session()->has('user_data')) {
            return redirect()->route('user.create')
                ->with('error', 'Data tidak ditemukan, silakan ulangi registrasi.');
        }

        $user_data = session('user_data');
        return view('form+', compact('user_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'username' => 'required|unique:_user,username|max:25',
            'password' => 'required|min:5|max:10'
        ]);
        if (session('user_data')) {
            $reId = session('user_data')['id'];
            $user = user::find($reId);
            $request->session()->put('user_data', [
                'id' => $reId,
                'username' => $request['username'],
                'password' => $request['password']

            ]);

            $user->username = $request['username'];
            $user->password = Hash::make($request['password']);
            $user->save();
            session()->flash('success', 'Data has been updated successfully!');

            return redirect()->route('profil.create');
        } else {
            $user = user::find($id);
            $user->username = $request['username'];
            $user->password = $request['password'];
            $user->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);
        //
    }
}
