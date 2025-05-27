@extends('layout.navbar')
@vite('resources/css/app.css')

@section('main')
    <div class="h-[100vh] w-fit mt-3 justify-between mx-auto">

        <div id="container" class="cont w-[90%] mx-auto  h-[80%]  gap-2   flex flex-row   p-2 ">
            <div class="w-[100%] h-[100%] overflow-x-hidden overflow-y-scroll ">
                <img id="previewImage" class="h-fit  w-fit object-fit" src="{{ asset('catalog/preview/' . $catal->preview) }}">
            </div>

            <div class="bg-white flex flex-col justify-between">
                <div>
                    <div class="flex flex-col justify-beetwen gap-2">
                        <h2 class="text-black text-[30px] font-bold uppercase font-mono">{{ $catal->headline }}</h2>
                        <h2
                            class="text-black text-[25px] border border-black w-fit !h-fit p-1 rounded-md  font-semiBold uppercase font-righteous">
                            Rp{{ $catal->harga }}</h2>

                        <a href="{{ route('shows', ['id' => $catal->user_id]) }}"
                            class="text-white font-medium bg-black w-fit text-sm p-1 mt-2  rounded-xl">@
                            {{ $catal->nama_depan }}</a>

                    </div>

                    <p class="text-black text-[14px] mt-5  leading-relaxed">
                        {{ $catal->deskripsi }} <br> <span class="text-black font-semibold">Diunggah Pada :
                            {{ $catal->created_at }}</span>
                    </p>
                    @if ($errors->any())
                        <div class =" bg-white" style="">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li
                                        style="color:red; background-color:white; font-medium uppercase w-fit font-size:17px">
                                        {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="flex flex-row justify-between gap-4">
                   

                    <div class="w-fit h-[20px]  mt-4  flex flex-row justify-center items-center">
                        <form class="border p-1 rounded-sm" method="POST" action="{{ route('store.cart') }}">
                            @csrf
                            <input type="hidden" name='id' value={{ $catal->id }}></input>
                            <button type='submit'><span class="material-symbols-outlined  text-black">add_shopping_cart
                                </span></button>
                        </form>
                        <form class="bg-green-400 py-1 px-4 rounded-sm border " action="{{ route('cart.buy') }}"
                            method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $catal->id }}">
                            <button type="submit"><span class=" text-white font-semibold font-ptsans ">Buy
                                </span></button>
                        </form>



                    </div>
                </div>
            </div>
            <a class="text text-black " href="{{ route('catal.index') }}"><span class="material-symbols-outlined"> close
                </span></a>
        </div>
        <script>
            window.addEventListener('load', function() {
                const img = document.getElementById('previewImage');
                const container = document.getElementById('container');

                // Dapatkan rasio lebar gambar terhadap lebar parent
                const imgRatio = img.naturalWidth / img.naturalHeight;

                // if (img.naturalWidth < 800) {
                //     // Misalnya, jika gambar kurang dari 400px, perkecil parent container
                //     container.style.width = '80%';
                // } else {
                //     container.style.width = '80%'; // default
                // }
            });
        </script>
    @endsection
