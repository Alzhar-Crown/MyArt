<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Catalog;
use App\Models\Ordered;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ControllerCart extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cart = Cart::with('catalog')->where('user_id', Auth::id())->latest()->get()->unique('catalog_id')->filter(fn($item) => $item->catalog !== null)
->values();
        $totalCart = $cart->count();

        $total = $cart->sum('harga');
        session()->put('total', $total);


        return view('cart', compact('cart', 'totalCart'));
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


        $id = $request['id'];
        $catalog = Catalog::where('id', $id)->first();
        $cartv = Cart::where('catalog_id', $id)->first();

        if ($catalog->user_id == Auth::id()) {
            return redirect()->back()->withErrors(['kepemilikan' => "Cannot enter own product"]);
        }
        if (!empty($cartv)) {
            return redirect()->back()->withErrors(['duplikat' => "Product is Already in Cart"]);
        }

        $cart = new Cart();
        $cart->user_id = Auth::id();
        $cart->catalog_id = $id;
        $cart->preview = $catalog->preview;
        $cart->file_desain = $catalog->file_desain;
        $cart->harga = $catalog->harga;
        $cart->headline = $catalog->headline;
        $cart->save();


        return redirect()->route('cart.index');
        //

    }
    public function buy(Request $request)
    {


        $id = $request['id'];
        $catalog = Catalog::where('id', $id)->first();
        $cartv = Cart::where('catalog_id', $id)->first();
        if ($catalog->user_id == Auth::id()) {
            return redirect()->back()->withErrors(['kepemilikan' => "Cannot enter own product"]);
        }
        if (!empty($cartv)) {
            return redirect()->route('cart.co1', ['co1' => $id]);
        }

        $cart = new Cart();
        $cart->user_id = Auth::id();
        $cart->catalog_id = $id;
        $cart->preview = $catalog->preview;
        $cart->file_desain = $catalog->file_desain;
        $cart->harga = $catalog->harga;
        $cart->headline = $catalog->headline;
        $cart->save();

        return redirect()->route('cart.co1', ['co1' => $id]);


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

    public function checkoutOne($id)
    {
        // dd($id);

        DB::beginTransaction();

        try {
            $buyerwallet = Wallet::firstOrCreate(
                ['user_id' => Auth::id()],
                ['saldo' => 0, 'spending' => 0]
            );
            // 1. Ambil saldo pembeli
            // $saldo = Wallet::where('user_id', Auth::id())->firstOrFail();

            // 2. Kurangi saldo & tambah spending
            // $total = session('total', 0); // pastikan session('total') sudah ada
            // $saldo->saldo     -= $total;
            // $saldo->spending  += $total;
            // $saldo->save();

            // 3. Ambil item cart tunggal
            $item = Cart::with('catalog')
                ->where('user_id', Auth::id())
                ->where('catalog_id', $id)
                ->first();

            // 4. Siapkan data order
            $now = now();
            if ($item->harga > $buyerwallet->saldo) {
                return redirect()->back()->withErrors(['checkout' => 'Saldo tidak cukup untuk melakukan checkout.']);
            }

            $orderData = [
                'user_id'         => $item->user_id,
                'catalog_id'      => $item->catalog_id,
                'headline'        => $item->headline,
                'harga'           => $item->harga,
                'preview'         => $item->preview,
                'file_desain'     => $item->file_desain,
                'kategori_desain' => $item->catalog->kategori_desain,
                'created_at'      => $now,
                'updated_at'      => $now,
            ];

            // 5. Tambah saldo penjual
            $sellerId = $item->catalog->user_id;
            $sellerWallet = Wallet::firstOrCreate(
                ['user_id' => $sellerId],
                ['saldo' => 0, 'spending' => 0]
            );
            $sellerWallet->save();




            $buyerwallet->saldo -= $item->harga;
            $buyerwallet->spending += $item->harga;
            $buyerwallet->save();

            // 6. Simpan order
            Ordered::create($orderData);

            // 7. Update status katalog & hapus cart
            Catalog::where('id', $item->catalog_id)->update(['status' => 'sold']);
            $item->delete();

            // 8. Clear session dan commit
            session()->forget('total');
            DB::commit();

            return redirect()->route('ordered.index')
                ->with('success', 'Checkout berhasil.');
        } catch (\Throwable $e) {
            DB::rollBack();
            if ($e instanceof \Illuminate\Database\QueryException && str_contains($e->getMessage(), 'Field \'saldo\' doesn\'t have a default value')) {
                return redirect()->back()->withErrors(['checkout' => 'Insufficient wallet balance']);
            }
            return redirect()->back()
                ->withErrors(['checkout' => 'Checkout gagal: ' . $e->getMessage()]);
        }
    }


    public function checkout(Request $request)
    {
        //
        $saldo = Wallet::where('user_id', Auth::id())->first();
        $total = session('total');

        if ( !$saldo||$saldo->saldo < $total  ) {
            return redirect()->back()->withErrors(['checkout' => 'Insufficient wallet balance']);
        }
        $wallet = $saldo->saldo;
        $spend = $saldo->spending;

        $wallet -= session('total');
        $spend += session('total');
        $saldo->saldo = $wallet;
        $saldo->spending = $spend;
        $saldo->save();





        $cartItems = Cart::with('catalog')
            ->where('user_id', Auth::id())
            ->whereIn('catalog_id', $request['catalog_ids'])
            ->get();

        $now = now();
        $ordersData = [];



        foreach ($cartItems as $item) {
            // 3a. Siapkan data order
            $ordersData[] = [
                'user_id'         => $item->user_id,
                'catalog_id'      => $item->catalog_id,
                'headline'        => $item->headline,
                'harga'           => $item->harga,
                'preview'         => $item->preview,
                'file_desain'     => $item->file_desain,
                'kategori_desain' => $item->catalog->kategori_desain,
                'created_at'      => $now,
                'updated_at'      => $now,
            ];

            // 3b. Tambah saldo penjual
            $sellerId = $item->catalog->user_id;
            $sellerWallet = Wallet::firstOrCreate(
                ['user_id' => $sellerId],
                ['saldo' => 0, 'spending' => 0]
            );
            $sellerWallet->saldo += $item->harga;
            $sellerWallet->save();
        }




        // 4. Simpan semua order sekaligus
        Ordered::insert($ordersData);

        Catalog::whereIn('id', $request['catalog_ids'])
            ->update(['status' => 'sold']);

        Cart::where('user_id', Auth::id())->delete();

        session()->forget('total');

        return redirect()->route('ordered.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Cart::destroy($id);
        return redirect()->route('cart.index');
    }
}
