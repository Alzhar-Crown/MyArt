@extends('layout.navbar')
@section('main')
    <div class="swiper w-[96.5%]" style="height: 75vh">
        <div class="swiper-wrapper">

            <div class="swiper-slide relative">
                <img src="{{ asset('images/dummy-1 1.png') }}" class="w-full h-full object-cover" />
                <div class="flex flex-col">
                    <div class="flex flex-row">
                        <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-40 text-white p-3 text-[20px]">
                            Mobile App Design
                        </div>
                        <div
                            class="absolute bottom-0 ml-52 mb-[17px] tracking-wide bg-black bg-opacity-100 text-white text-[12px]">
                            Portofolio
                        </div>
                        <div><a href="#"
                                class="text-left  absolute bottom-0   ml-3  bg-opacity-100 text-white text-[12px] ">@Chandra</a>
                        </div>

                    </div>
                </div>

            </div>

            <div class="swiper-slide">
                <img src="{{ asset('images/dummy-3 1.png') }}" class="w-full h-full object-cover" />
                <div class="flex flex-col">
                    <div class="flex flex-row">
                        <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-40 text-white p-3 text-[20px]">
                            E-Commers Design
                        </div>
                        <div
                            class="absolute bottom-0 ml-52 mb-[17px] tracking-wide bg-black bg-opacity-100 text-white text-[12px]">
                            Portofolio
                        </div>
                        <div><a href="#"
                                class="text-left  absolute bottom-0   ml-3  bg-opacity-100 text-white text-[12px] ">@Chandra</a>
                        </div>

                    </div>
                </div>
            </div>

            <div class="swiper-slide">
                <img src="{{ asset('images/dummy-4 1.png') }}" class="w-full h-full object-cover" />
                <div class="flex flex-col">
                    <div class="flex flex-row">
                        <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-40 text-white p-3 text-[20px]">
                            3D Illustration
                        </div>
                        <div
                            class="absolute bottom-0 ml-44 mb-[17px] tracking-wide bg-black bg-opacity-100 text-white text-[12px]">
                            Portofolio
                        </div>
                        <div><a href="#"
                                class="text-left  absolute bottom-0   ml-3  bg-opacity-100 text-white text-[12px] ">@Chandra</a>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="h-[15%] w-[96.5%]   ml-6 mt-3 bg-transparent flex flex-row gap-10 justify-center">
        <div class="flex flex-col bg- h-fit w-fit py-2 px-4  mt-3 ">
            <a href="{{ route('clearProfil') }}"class="mx-auto"><span
                    class="material-symbols-outlined text-[rgba(115,159,99,1)] " style="font-size:30px;">person </span></a>
            <span class=" text-black text-sm ">My Profile </span>
        </div>
        <div class="flex flex-col bg- h-fit w-fit py-2 px-4 mt-3 ">
            <a href="{{ route('wallet.index') }}"class="mx-auto"><span
                    class="material-symbols-outlined text-[rgba(115,159,99,1)] "
                    style="font-size:30px;">account_balance_wallet</span></a>
            <span class=" text-black text-sm ">Wallet</span>
        </div>
        <div class="flex flex-col bg- h-fit w-fit py-2 px-4  mt-3 ">
            <a href="{{ route('selling') }}"class="mx-auto"><span
                    class="material-symbols-outlined text-[rgba(115,159,99,1)] " style="font-size:30px;">sell </span></a>
            <span class=" text-black text-sm ">Selling </span>
        </div>
        <div class="flex flex-col bg- h-fit w-fit py-2 px-4  mt-3 ">
            <a href="{{ route('ordered.index') }}"class="mx-auto"><span
                    class="material-symbols-outlined text-[rgba(115,159,99,1)] " style="font-size:30px;">orders</span></a>
            <span class=" text-black text-sm ">Orders </span>
        </div>

    </div>

    <div class="Portofolio">
        <div class="flex flex-row justify-between mt-0">
            <h2 class="text text-black font-bold ml-6 mb-3">Categorized</h2>
        </div>
        <div id="autoScrollContainer" class="overflow-x-auto scrollbar-hide w-[96.5%]   ml-6">
            <div class="grid grid-flow-col auto-cols-[calc(100%/4)] gap-4">
                <div class=" p-4 h-[150px] bg-cover bg-center rounded-sm text-center"
                    style="background-image: url('{{ asset('images/uiux-1.webp') }}'); ">
                    <a href="">
                        <h3 class="text-black mt-[21%] mx-auto bg-white border w-fit px-2 rounded-lg font-righteous">UI/UX
                        </h3>
                    </a>
                </div>
                <div class="bg-blue-200 p-4 h-[150px] bg-cover bg-center rounded-sm text-center"
                    style="background-image: url('{{ asset('images/typ-1.webp') }}'); ">
                    <a href="">
                        <h3 class="text-black mt-[20%] mx-auto bg-white border w-fit px-2 rounded-lg font-righteous">
                            TYPHOGRAPHI</h3>
                    </a>
                </div>
                <div class="bg-green-200 p-4 h-[150px] bg-cover bg-center rounded-sm"
                    style="background-image: url('{{ asset('images/real-1.jpg') }}'); ">
                    <a href="">
                        <h3 class="text-black mt-[20%] mx-auto bg-white border w-fit px-2 rounded-lg font-righteous">REAL
                            PICT</h3>
                    </a>
                </div>
                <div class="bg-yellow-200 p-4 h-[150px] bg-cover bg-center rounded-sm"
                    style="background-image: url('{{ asset('images/post-1.webp') }}'); ">
                    <a href="">
                        <h3 class="text-black mt-[20%] mx-auto bg-white border w-fit px-2 rounded-lg font-righteous">POSTER
                        </h3>
                    </a>
                </div>
                <div class="bg-purple-200 p-4 h-[150px] bg-cover bg-center rounded-sm"
                    style="background-image: url('{{ asset('images/2ilus-1.webp') }}'); ">
                    <a href="">
                        <h3 class="text-black mt-[20%] mx-auto bg-white border w-fit px-2 rounded-lg font-righteous">2D</h3>
                    </a>
                </div>
                <div class="bg-pink-200 p-4 h-[150px] bg-cover bg-center rounded-sm"
                    style="background-image: url('{{ asset('images/3ilus-1.webp') }}'); ">
                    <a href="">
                        <h3 class="text-black mt-[20%] mx-auto bg-white border w-fit px-2 rounded-lg font-righteous">3D</h3>
                    </a>
                </div>
            </div>
        </div>

    </div>
    <div class="trending">
        <div class="flex flex-row justify-between">
            <h2 class="text text-black font-bold ml-6 mt-10 mb-3">Trending Portofolio</h2>
            <form class="text text-black font-bold mr-6 mb-3 mt-10"
                action="{{ route('scatal', ['kategori' => '3d illustration']) }}" method="POST">
                @csrf
            </form>
        </div>
        <div class="overflow-x-auto scrollbar-hide w-[96.5%] ml-6">
            <div class="grid grid-flow-col auto-cols-[calc(100%/6)] gap-4">
                @foreach ($portofolios as $item)
                    <a href="{{ route('portofolios.show', ['portofolio' => $item->id]) }}" class="w-full h-full "><img
                            class=" p-4  w-[250px] rounded-full shadow-lg object-cover h-[250px]"
                            src="{{ asset('portofolio/' . $item->preview) }}"></img>
                    </a>
                @endforeach
                {{-- <img class=" h-[250px] object-cover p-4" src="{{ asset('portofolio/'.$portofolios[0]->preview) }}">
                <img class=" h-[250px] object-cover p-4" src="{{ asset('portofolio/'.$portofolios[1]->preview) }}">
                <img class=" h-[250px] object-cover p-4" src="{{ asset('portofolio/'.$portofolios[2]->preview) }}">
                <img class=" h-[250px] object-cover p-4" src="{{ asset('portofolio/'.$portofolios[3]->preview) }}">
                <img class=" h-[250px] object-cover p-4" src="{{ asset('portofolio/'.$portofolios[4]->preview) }}"> --}}

            </div>
        </div>

    </div>
    <div class="3D Ilus">
        <div class="flex flex-row justify-between">
            <h2 class="text text-black font-bold ml-6 mt-10 mb-3">3D Illustration || Sale Product</h2>
            <form class="text text-black font-bold mr-6 mb-3 mt-10"
                action="{{ route('scatal', ['kategori' => '3d illustration']) }}" method="POST">
                @csrf
                <button type="submit">Show more</button>
            </form>
        </div>
        <div class="overflow-x-auto scrollbar-hide  w-[96.5%] ml-6">
            <div class="grid grid-flow-col auto-cols-[calc(100%/6)]  ">
                @if (!empty($categorized['3d']))
                    @foreach ($categorized['3d'] as $item)
                        <a href="{{ route('catalog.show', ['catalog' => $item->id]) }}"><img
                                class=" p-4  w-[250px] rounded-full object-cover h-[250px]"
                                src="{{ asset('catalog/preview/' . $item->preview) }}"></img></a>
                    @endforeach
                @else
                    <h2 class="text-black">Not Found</h2>
                @endif

            </div>
        </div>


    </div>
    <div class="2D Ilus">
        <div class="flex flex-row justify-between">
            <h2 class="text text-black font-bold ml-6 mt-10 mb-3">2D Illustration || Sale Product</h2>
            <form class="text text-black font-bold mr-6 mb-3 mt-10"
                action="{{ route('scatal', ['kategori' => '2d illustration']) }}" method="POST">
                @csrf
                <button type="submit">Show more</button>
            </form>
        </div>
        <div class="overflow-x-auto scrollbar-hide  w-[96.5%] ml-6">
            <div class="grid grid-flow-col auto-cols-[calc(100%/6)]  ">
                @if (!empty($categorized['2d']))
                    @foreach ($categorized['2d'] as $item)
                        <a href="{{ route('catalog.show', ['catalog' => $item->id]) }}"><img
                                class=" p-4 h-[250px] w-[250px] rounded-full object-cover"
                                src="{{ asset('catalog/preview/' . $item->preview) }}"></img></a>
                    @endforeach
                @else
                    <h2 class="text-black">Not Found</h2>
                @endif
            </div>
        </div>

    </div>
    <div class="UIUX">
        <div class="flex flex-row justify-between">
            <h2 class="text text-black font-bold ml-6 mt-10 mb-3">UI UX Design || Sale Product</h2>
            <form class="text text-black font-bold mr-6 mb-3 mt-10"
                action="{{ route('scatal', ['kategori' => 'uiux']) }}" method="POST">
                @csrf
                <button type="submit">Show more</button>
            </form>
        </div>
        <div class="grid grid-flow-col auto-cols-[calc(100%/6)]  ">
            @if (!empty($categorized['uiux']))
                @foreach ($categorized['uiux'] as $item)
                    <a href="{{ route('catalog.show', ['catalog' => $item->id]) }}"><img
                            class=" p-4  w-[250px] rounded-full object-cover h-[250px]"
                            src="{{ asset('catalog/preview/' . $item->preview) }}"></img></a>
                @endforeach
            @else
                <h2 class="text-black ml-5">Not Found</h2>
            @endif

        </div>

    </div>
@endsection
