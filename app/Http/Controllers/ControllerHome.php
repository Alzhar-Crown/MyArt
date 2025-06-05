<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Like;
use App\Models\Portofolio;
use Illuminate\Http\Request;

class ControllerHome extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // session()->forget('indicator');
        $allPorto = Portofolio::all();

        foreach ($allPorto as $porto) {
            $likeCount = Like::where('portofolio_id', $porto->id)->count();
            $porto->jumlah_like = $likeCount;
            $porto->save();
        }
        $portofolios = Portofolio::orderBy('jumlah_like', 'desc')->take(6)->get();

        $rank = 1;
        foreach ($portofolios as $porto) {
            $porto->peringkat = $rank;
            $porto->save();
            $rank++;
        }

        $catal = Catalog::where('status', '<>', 'sold')->get();

        $categorized = [
            'uiux' => [],
            'realpic' => [],
            '2d' => [],
            '3d' => [],
        ];

        foreach ($catal as $item) {
            switch ($item->kategori_desain) {
                case 'uiux':
                    $categorized['uiux'][] = $item;
                    break;
                case 'realpic':
                    $categorized['realpic'][] = $item;
                    break;
                case '2d illustration':
                    $categorized['2d'][] = $item;
                    break;
                case '3d illustration':
                    $categorized['3d'][] = $item;
                    break;
            }
        }
        //
        return view('home', compact('categorized', 'portofolios'));
    }

    public function back(){
        return redirect(session('previous_url', '/'));
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
