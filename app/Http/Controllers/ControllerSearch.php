<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Portofolio;
use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ControllerSearch extends Controller
{
    //
    public function search(Request $request)
    {
        if (Str::contains($request['search_input'], '@')) {
            session()->forget('dataCatalog');
            session()->forget('dataPortofolio');

            $input = ltrim($request['search_input'], '@');
            $profil = Profil::where('nama_depan', $input)->first();
            $portofolio = Portofolio::where('nama_depan', $input)->get();
            // dd($portofolio);
            if ($portofolio->isNotEmpty()) {
                session()->put('dataPortofolio', [
                    'user_id' => Auth::id(),
                ]);
                session()->put('nd', [
                    'nama_depan' => $input,
                ]);
                return view('people-profil', compact('profil', 'portofolio'));
            } else {
                return view('people-profil', compact('profil'));
            }
        } else {
            return redirect()->back();
        }
    }
    public function ClearProfil()
    {
        $profil = Profil::where('nama_depan', session('nd')['nama_depan'])->first();
        session()->forget('dataCatalog');
        $portofolio = Portofolio::where('nama_depan', session('nd')['nama_depan'])->get();
        if ($portofolio->isNotEmpty()) {
            session()->put('dataPortofolio', [
                'user_id' => Auth::id(),
            ]);


            return view('people-profil', compact('portofolio', 'profil'));
        } else {
            return view('people-profil', compact('profil'));
        }
    }
    public function ClearCatalog()
    {
        $profil = Profil::where('nama_depan', session('nd')['nama_depan'])->first();
        // $portofolio = Portofolio::where('id', session('idProfil')['id'])->get();
        session()->forget('dataPortofolio');
        $catalog = Catalog::where('nama_depan', session('nd')['nama_depan'])->get();
        if ($catalog->isNotEmpty()) {
            session()->put('dataCatalog', [
                'user_id' => Auth::id(),
            ]);

            return view('people-profil', compact('catalog', 'profil'));
        } else {
            return view('people-profil', compact('profil'));
        }
    }
}
