<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\Order;
use App\Models\Ordered;
use Carbon\Carbon;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Xendit\Invoice\CreateInvoiceRequest;
use Xendit\Xendit;


class ControllerPayment extends Controller
{
    //
    public function __construct()
    {
        Configuration::setXenditKey("xnd_development_n9uXJzdIOsU7ZniNVLvvIHkplJNdaAQN7SXrPuxOkxSrPrmG5uqH9uZbEzANj");
    }
    public function payment(Request $request)
    {
        session()->forget('ex_id');
        $request->validate([
            'nominal' => 'required|integer',
        ]);

        $uuid = (string) Str::uuid();
        session()->put('ex_id', [
            'id' => $uuid,
            'saldo' => $request->nominal
        ]);



        //call Xendit
        $apiInstance = new InvoiceApi();
        $createInvoiceRequest = new CreateInvoiceRequest([
            'external_id' => $uuid,
            'description' => 'Top Up Wallet MyTeam',
            'amount' => $request->nominal,
            'invoice_duration' => 172800,
            'currency' => 'IDR',
            "customer" => array(
                "given_names" => "Alzhar"
            ),
            "success_redirect_url" => " http://localhost:8000/notification",
            "failure_redirect_url" => " http://localhost:8000/home"

        ]);

        try {
            $result = $apiInstance->createInvoice($createInvoiceRequest);
            //insert to table

            $order = new Order();
            $order->user_id = Auth::id();
            $order->checkout_link = $result['invoice_url'];
            $order->external_id = $uuid;
            $order->harga = $request->nominal;
            $order->status = "pending";
            $order->save();

            return redirect($result['invoice_url']);
        } catch (\Xendit\XenditSdkException $e) {
        }
    }
    public function detailP()
    {
        return view('detail_payment');
    }
    // public function notification()
    // {
    //     $apiInstance = new InvoiceApi();
    //     $result = $apiInstance->getInvoices(null, session('ex_id')['id']);

    //     $order = Order::where('external_id', session('ex_id')['id'])->firstOrFail();

    //     if ($order->status == 'settled') {
    //         $wallet = Wallet::firstOrCreate(
    //             ['user_id' => Auth::id()],
    //             ['saldo' => 0]
    //         );
    //         $wallet->increment('saldo', session('ex_id')['saldo']);
    //         return response()->json('Payment Anda Telah Berhasil Diproses');
    //     }

    //     $order->status = $result[0]['status'];
    //     $invoiceId = $result[0]['id'];
    //     $invoice = $apiInstance->getInvoiceById($invoiceId);
    //     $order->via_transaksi = $invoice['payment_method'] ?? 'unknow';
    //     $order->save();



    //     $saldo = Wallet::where('user_id', Auth::id())->first();
    //     if (empty($saldo)) {

    //         $wallet = Wallet::where('user_id', Auth::id())->first();

    //         $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'];
    //         $total = [0, 0, 30000, 0, 0, 0];

    //         // Buat chart
    //         $chart = new Chart;
    //         $chart->labels($bulan);
    //         $chart->dataset('Total Pengeluaran', 'bar', $total)
    //             ->backgroundColor('yellow')
    //             ->color('yellow');
    //         return view('wallet', compact('wallet', 'chart'));
    //     } else {

    //         $wallet = Wallet::where('user_id', Auth::id())->first();

    //         $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'];
    //         $total = [0, 0, 30000, 0, 0, 0];

    //         // Buat chart
    //         $chart = new Chart;
    //         $chart->labels($bulan);
    //         $chart->dataset('Total Pengeluaran', 'bar', $total)
    //             ->backgroundColor('yellow')
    //             ->color('yellow');
    //         return view('wallet', compact('wallet', 'chart'));
    //     }
    // }
    public function notification()
    {
        // dd(session('ex_id'));

        // 1) Ambil external ID & API
        $externalId = session('ex_id')['id'];
        $api        = new InvoiceApi();

        // 2) Ambil invoice & status terbaru
        $invoices = $api->getInvoices(null, $externalId);
        $invoice  = $invoices[0] ?? null;
        if (! $invoice) {
            abort(404, 'Invoice tidak ditemukan');
        }
        $newStatus = strtolower($invoice['status']); // misal "pending", "settled", dll

        // 3) Ambil order
        $order = Order::where('external_id', $externalId)->firstOrFail();
        $oldStatus = strtolower($order->status);

        // 4) Jika baru berubah jadi "settled", lakukan top‑up ONCE
        if ($oldStatus !== 'paid' && $newStatus === 'paid') {
            // a) Top‑up wallet pembeli
            $wallet = Wallet::firstOrCreate(
                ['user_id' => Auth::id()],
                ['saldo'   => 0, 'spending' => 0]
            );
            $wallet->saldo = $wallet->saldo + session('ex_id')['saldo'];
            $wallet->save();

            // b) (Optional) bersihkan session
            session()->forget('ex_id');
        }

        // 5) Update order (status + via_transaksi) kalau berubah
        if ($oldStatus !== $newStatus) {
            $order->status        = $newStatus;
            $order->via_transaksi = $invoice['payment_method'] ?? 'unknown';
            $order->save();
        }

        // 6) Tampilkan view wallet sekali saja
        $wallet = Wallet::where('user_id', Auth::id())->first();
        $chart  = $this->makeWalletChart();

        $data = Ordered::where('user_id', Auth::id())->get();
        $ordered = Ordered::where('user_id', Auth::id())->get();
        $topup = Order::where('user_id', Auth::id())->get();
        $wallet = Wallet::where('user_id', Auth::id())->first();

        $spending = $data->sum('harga');



        return view('wallet', compact('wallet','topup','ordered','spending', 'chart'));
    }

    // contoh helper untuk chart
    protected function makeWalletChart(): Chart
    {
        $data = Ordered::where('user_id', Auth::id())->get();
        $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $aem = array_fill(0, 12, 0);

        foreach ($data as $item) {
            $bulanStr = Carbon::parse($item->created_at)->format('M');
            $index = array_search($bulanStr, $bulan);
            if ($index !== false) {
                $aem[$index] += $item->harga;
            }
        }
        // Buat chart
        $chart = new Chart;
        $chart->labels($bulan);
        $chart->dataset('Total Pengeluaran', 'bar', $aem)
            ->backgroundColor('yellow')
            ->color('yellow');

        return $chart;
    }
}
