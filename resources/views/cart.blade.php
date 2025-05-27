@extends('layout.navbar')
@section('main')
    <div class="w-[850px] mx-auto h-[800px] p-4  gap-2 flex flex-col">
        <div class="flex flex-col gap-12 border-b-2 border-green-100">
            <h1 class=" text-black font-md text-4xl">Your Cart</h1>
            <div class="flex flex-row justify-between">
                <span class="text-gray-400 text-sm font-semibold">Continue Shopping</span>
                <span class="text-black  text-md font-semibold">{{ $totalCart ?? 0 }} items</span>
                <span>Continue Shopping</span>
            </div>

        </div>
        <div class="w-[100%] flex flex-row gap-1">
            <div class="w-[100%] flex h-[57%] overflow-y-scroll flex-col gap-1 ">
                @if (empty($cart) && $cart->catalog->status == 'sold')
                    <div class="w-[100%] h-[100px] p-2 border ">

                        <div class="flex flex-col">
                            <h2 class="text-black">Not found</h2>
                        </div>
                        <div></div>

                    </div>
                @else
                    @foreach ($cart as $item)
                        <div class="w-[100%] h-[100px] p-2 border bg-none hover:bg-gray-200  transition-all duration-100">
                            <div class="flex flex-col">
                                <h2 class="text-black text-sm font-semibold ">{{ $item->headline }}</h2>
                                <div class="flex flex-row mt-3 gap-16">
                                    <div class="w-[50px] h-[50px] bg-cover"
                                        style="background-image: url('{{ asset('catalog/preview/' . $item->preview) }}')">
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <div class="text-black text-sm w-fit font-semibold">ID{{ $item->catalog_id }}</div>
                                        <div class="text-black text-sm">Stock {{ $item->catalog->status }}</div>

                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <div class="text-black text-sm font-semibold">Price</div>

                                        <div class="text-black text-sm">Rp{{ $item->harga }}</div>

                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <div class="text-black text-sm font-semibold">Quantity</div>

                                        <div class="text-black text-sm">1</div>

                                    </div>
                                    <div class="h-fit text-md py-1 px-2 bg-red-800 rounded-md w-fit">
                                        <form action="{{ route('cart.destroy', ['cart' => $item->id]) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin ingin hapus item ini?')"
                                                class="h-fit text-md py-1 px-2 bg-red-800 rounded-md w-fit text-white">
                                                X
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                @endif
                @if ($errors->any())
                    <div class =" bg-white" style="">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li style="color:red; background-color:white; font-medium uppercase w-fit font-size:17px">
                                    {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="w-[30%] h-[400px] flex flex-col border p-2 gap-4 ">
                <div class="text-black text-lg font-semibold">Ordered</div>
                @php
                    $total = 0;
                    // $idCat=[];
                @endphp
                @foreach ($cart as $item)
                    <div class="flex flex-row justify-between">
                        <div class="text-black text-[10px]">{{ $item->headline }}</div>
                        <div class="text-black text-[10px] font-medium">Rp{{ $item->harga }}</div>
                    </div>
                    @php
                        // $catal =  $item->catalog->id;
                    @endphp
                    @php
                        // if(!in_array($catal,$idCat))
                        $total += $item->harga;
                    @endphp
                @endforeach
                <div class="flex flex-row justify-between">
                    <div class="text-black text-lg font-semibold">Total</div>
                    <div class="text-black text-lg font-semibold">Rp{{ number_format($total, 0, ',', '.') }}</div>
                </div>
                <div></div>
                <div class="w-full h-fit p-2 bg-orange-300 text-center ">
                    <form action="{{ route('cart.co') }}" method="POST">
                        @csrf
                        @php
                            $catalogIds = [];
                        @endphp
                        @foreach ($cart as $item)
                            @php
                                $currentCatalogId = $item->catalog->id;

                            @endphp

                            @if (!in_array($currentCatalogId, $catalogIds))
                                @php $catalogIds[] = $currentCatalogId; @endphp
                                <input type="hidden" name="catalog_ids[]" value="{{ $currentCatalogId }}">
                            @endif
                        @endforeach

                        <div class="w-full h-fit p-2 bg-orange-300 text-center ">
                            <button type="submit"
                                class="text-center text-black font-ptsans font-semibold text-md">CHECKOUT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
