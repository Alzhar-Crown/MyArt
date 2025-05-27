@extends('layout.navbar')
@section('main')
    <div class="w-[80%] h-[100vh] overflow-y-scroll mx-auto flex flex-col gap-8 ">
        @if (!empty($ordered))
            <div class="flex flex-row gap-3">
                <div
                    class="text-black font-semibold text-xl  rounded-md bg-none hover:bg-yellow-400 hover:translate-y-1 transition-all duration-300  shadow-md  w-fit h-fit p-4">
                    Total
                    Asset {{ $total ?? 0 }}</div>
                <div
                    class="text-black font-semibold text-xl   rounded-md bg-none hover:bg-yellow-400 hover:translate-y-1 transition-all duration-300 shadow-md  w-fit h-fit p-4">
                    Nilai Asset Rp{{ number_format($nom ?? 0, 0, ',', '.') }}</div>
            </div>
            @foreach ($ordered as $key => $item)
                <div
                    class="flex transition-all duration-300  flex-row justify-between border text-start text-sm hover:translate-y-2 w-[100%] h-fit hover:bg-gray-300 bg-none py-4 px-6  text-black">
                    {{-- no --}}

                    {{-- gambar --}}
                    <div class=" bg-cover w-[50px] h-[50px] -mt-2 "
                        style="background-image: url('{{ asset('catalog/preview/' . $item->preview) }}')">
                    </div>

                    {{-- headline --}}
                    <div class=" w-[200px] h-[30px] mt-2  ">{{ $item->headline }}</div>

                    {{-- kategori --}}
                    <div class=" w-[90px] h-[30px] mt-3 ">{{ $item->kategori_desain }}</div>

                    {{-- harga --}}
                    <div class=" w-[30px] h-[30px] mt-3 ">{{ $item->harga }}</div>

                    {{-- waktu --}}
                    <div class=" w-[140px] h-[30px] mt-3 ">{{ $item->created_at }}</div>



                    <form action="{{ route('download', ['download' => $item->file_desain]) }} "
                        class=" bg-green-500 text-white h-fit p-1 rounded-md" method='POST'>
                        @csrf
                        <button><span class="material-symbols-outlined">
                                download
                            </span></button>
                    </form>
                </div>
            @endforeach
        @else
            <div class="flex flex-row gap-3">
                <div
                    class="text-black font-semibold text-xl  rounded-md bg-none hover:bg-yellow-400 hover:translate-y-1 transition-all duration-300  shadow-md  w-fit h-fit p-4">
                    Total
                    Asset {{ $total ?? 0 }}</div>
                <div
                    class="text-black font-semibold text-xl   rounded-md bg-none hover:bg-yellow-400 hover:translate-y-1 transition-all duration-300 shadow-md  w-fit h-fit p-4">
                    Nilai Asset Rp{{ number_format($nom ?? 0, 0, ',', '.') }}</div>
            </div>
            <div class="mx-auto">
                <div class="text-black text-5xl ">Empty</div>
            </div>
        @endif
    </div>
@endsection
