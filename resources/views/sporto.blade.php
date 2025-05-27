@extends('layout.navbar')
@section('main')
    <div class="item mt-4">
        <div class="overflow-x-auto scrollbar-hide w-[96.5%] ml-6">
            <div class="flex flex-wrap  gap-4 ">
                @if (!empty($porto))
                    @foreach ($porto as $item)
                        <a href="{{ route('portofolios.show', ['portofolio' => $item->id]) }}"
                            class=" p-4 h-fit object-center text-black overflow-y-hidden object-cover w-[calc(100%/3-1rem)] mt-10"><img
                                src="{{ asset('portofolio/' . $item->preview) }}"></img></a>
                    @endforeach
                @else
                    <span class="text-black text-[15px] mx-auto">No item found</item>
                        {{-- <a href="" class="bg-gray-600 p-4 h-[250px] w-[calc(100%/3-1rem)] text-white text-center">No Item Found<img></img></a>
                    <a href="" class="bg-gray-600 p-4 h-[250px] w-[calc(100%/3-1rem)] text-white text-center">No Item Found<img></img></a>
                    <a href="" class="bg-gray-600 p-4 h-[250px] w-[calc(100%/3-1rem)] text-white text-center">No Item Found<img></img></a> --}}
                @endif
                {{-- @auth
                    <p>Halo, {{ auth()->id() }}</p>
                @endauth --}}



            </div>
        </div>
    @endsection
