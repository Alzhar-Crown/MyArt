@extends('layout.navbar')
@vite('resources/css/app.css')

@section('main')
    <div class="h-[100vh] w-fit justify-between mx-auto">

        <div id="container" class="cont w-[90%] mx-auto  h-[80%]    flex flex-row gap-3  p-2 ">
            <div class="overflow-x-hidden overflow-y-scroll w-[100%] h-[100%]">
                <img id="previewImage" class="h-fit overflow-hidden  w-fit object-fit"
                    src="{{ asset('portofolio/' . $porto->preview) }}">
            </div>

            <div class="bg-white flex flex-col justify-between">
                <div>
                    <div class="flex flex-row justify-beetwen gap-8">
                        <h2 class="text-black text-[30px] font-bold uppercase font-mono">{{ $porto->headline }}</h2>
                        @if (empty($porto->peringkat))
                            <div class="p-2 w-fit h-fit bg-yellow-300 font-bold text-lg">0</div>
                        @else
                            <div class="p-2 w-fit h-fit bg-yellow-300 font-bold text-lg">{{ $porto->peringkat }}</div>
                        @endif
                    </div>
                    <a href="{{ route('shows', ['id' => $porto->user_id]) }}"
                        class="text-white font-medium bg-black w-fit text-sm p-1 mt-1 rounded-xl">@
                        {{ $porto->nama_depan }}</a>
                    <p class="text-black text-[20px] mt-5  leading-relaxed">
                        {{ $porto->deskripsi }}
                    </p>
                </div>

                <div class="flex flex-row justify-between">
                    <div class="flex flex-row gap-2">
                        <div class='flex flex-row gap-1 '>
                            @if (session('indicator') != $porto->id)
                                <button> <span class="material-symbols-filled text-red-400">
                                        favorite </span>
                                </button>

                                <span class="text-black font-light text-[13px]"></span>
                            @else
                                <form action="{{ route('love') }}" method="POST">
                                    @csrf
                                    <button type="submit"> <span class="material-symbols-outlined text-black">
                                            favorite </span>
                                    </button>
                                </form>
                                <span class="text-black font-light text-[13px]">{{$porto->jumlah_like ?? 0}}</span>
                            @endif
                        </div>

                    </div>
                    <span class="text-black font-semibold">Diunggah Pada : {{ $porto->created_at }}</span>

                </div>
            </div>
            <a class="text text-black " href="{{ route('clearProfil') }}"><span class="material-symbols-outlined"> close
                </span></a>
        </div>


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
