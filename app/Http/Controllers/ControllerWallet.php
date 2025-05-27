<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Ordered;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerWallet extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data= Ordered::where('user_id',Auth::id())->get();
        //\ // Dummy data bulan dan total pengeluaran
        $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $aem = array_fill(0, 12, 0);
        $ordered = Ordered::where('user_id',Auth::id())->get();
        $topup = Order::where('user_id',Auth::id())->get();
        
        foreach ($data as $item) {
            $bulanStr = Carbon::parse($item->created_at)->format('M');
            $index = array_search($bulanStr, $bulan);
            if ($index !== false) {
                $aem[$index] += $item->harga;
            }
        }
        $spending = $data->sum('harga');
        // Buat chart
        $chart = new Chart;
        $chart->labels($bulan);
        $chart->dataset('Total Pengeluaran', 'bar', $aem)
            ->backgroundColor('yellow')
            ->color('yellow');

        $wallet = Wallet::where('user_id', Auth::id())->first();

        return view('wallet', compact('wallet','ordered', 'chart','topup','spending'));
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
