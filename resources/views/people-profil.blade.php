{{-- @if (!isset($profil))
<h3 class="font-righteous mt-3 text-[#70ad5a] font-medium">gaada bos</h3>
@else
<h3 class="font-righteous mx-auto mt-5 text-[#70ad5a] font-medium">{{ $profil->nama_depan }}</h3>
@endif --}}

@extends('layout.navbar')
@section('main')

    <div class="flex flex-col   w-full h-fit  mt-5">
        @if (session('dataProfil'))
            <h2 class="text-black font-semibold text-[25px] font-ptsans mx-auto"> {{ $profil->nama_depan }}
                {{ $profil->nama_belakang }}</h2>
        @else
            <h2>Guest</h2>
        @endif
        <div class="mt-5">
            @if (!isset($profil->foto_profil))
                <img class="w-[170px] h-[170px] rounded-full mx-auto  border object-cover"
                    src="{{ asset('images/avatar-1.webp') }}"></img>
            @else
                <img class="w-[170px] h-[170px] rounded-full mx-auto  border object-cover"
                    src="{{ asset('client/' . $profil->foto_profil) }}"></img>
            @endif
        </div>





        @if (!isset($profil->headline))
            <h3 class="font-righteous mx-auto mt-5 text-[#70ad5a] font-medium">Not Setting</h3>
        @else
            <h3 class="font-righteous mx-auto mt-5 text-[#70ad5a] font-medium">{{ $profil->headline }}</h3>
        @endif
        @if (!isset($profil->headline))
            <div class="text-xl font-mono mx-auto mt-5  text-black whitespace-normal overflow-hidden  text-center border-black w-[400px] h-fit "
                id="notyp">Not setting</div>
        @else
            <div class="text-md font-mono  mt-5  text-black whitespace-normal overflow-hidden pr-2 border-r-2 text-center mx-auto border-black w-[600px] h-fit animate-typing"
                id="typingText"></div>
        @endif

        <div class=" flex flex-row mt-5  justify-around">
            <div class="flex flex- gap-4 row justify-center items-center">
                @if (session('dataPortofolio'))
                    <a class="text-yellow-400 font-ptsans font-semibold " href="{{ route('searchProfil') }}">Portofolio</a>
                @else
                    @if (session('dataCatalog'))
                        <a class="text-black font-ptsans font-semibold" href="{{ route('searchProfil') }}">Portofolio</a>
                    @else
                        <a class="text-black font-ptsans font-semibold">Portofolio</a>
                    @endif
                @endif
            </div>
            <div class="flex flex-row gap-4  justify-center items-center">
                @if (session('dataCatalog'))
                    <a class="text-yellow-400 font-ptsans font-semibold " href="{{ route('searchCatalog') }}">Catalog</a>
                @else
                    @if (session('dataPortofolio'))
                        <a class="text-black font-ptsans font-semibold" href="{{ route('searchCatalog') }}">Catalog</a>
                    @else
                        <a class="text-black font-ptsans font-semibold">Catalog</a>
                    @endif
                @endif
            </div>


        </div>

    </div>
    <div class="item mt-4">
        <div class="overflow-x-auto scrollbar-hide w-[96.5%] ml-6">
            <div class="flex flex-wrap  gap-4 ">
                @if (session()->has('dataPortofolio') && !empty($portofolio))
                    @foreach ($portofolio as $item)
                        <a href=""
                            class=" p-4 h-[250px] object-center  overflow-y-hidden object-cover w-[calc(100%/3-1rem)] mt-10"><img
                                src="{{ asset('portofolio/' . $item->preview) }}"></a>
                        kk
                    @endforeach
                @elseif (session()->has('dataCatalog') && !empty($catalog))
                    @foreach ($catalog as $item)
                        <a href=""
                            class=" p-4 h-[250px] object-center  overflow-y-hidden object-cover w-[calc(100%/3-1rem)] mt-10"><img
                                src="{{ asset('catalog/' . $item->preview) }}"></a>
                    @endforeach
                @else
                    <span class="text-black text-[15px] mx-auto">No item found</item>
                @endif




            </div>
        </div>

    </div>
    <script>
        const text = @json($profil->deskripsi ?? 'Saya adalah salah satu designer ui/ux yang sudah berpengalaman selama 30 tahun');

        let i = 0;
        const speed = 50;
        const target = document.getElementById("typingText");

        function type() {
            if (i < text.length) {
                target.textContent += text.charAt(i);
                i++;
                setTimeout(type, speed);
            }
        }

        type();
    </script>

@endsection
