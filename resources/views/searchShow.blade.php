@extends('layout.navbar')
@section('main')
    <div class="item mt-4">
        <div class="overflow-x-auto scrollbar-hide w-[96.5%] ml-6">
            <div class="flex flex-wrap  gap-4 ">
                @if (!empty($data)|| !empty($portofolios))
                    @foreach ($data as $item)
                        <a href="{{ route('catalog.show', ['catalog' => $item->id]) }}"
                            class=" p-4 h-fit object-center text-black overflow-y-hidden object-cover w-[calc(100%/3-1rem)] mt-10"><img
                                src="{{ asset('catalog/preview/' . $item->preview) }}"></img></a>
                    @endforeach
                    @foreach ($portofolios as $porto)
                        <a href="{{ route('portofolios.show', ['portofolio' => $porto->id]) }}"
                            class=" p-4 h-fit object-center text-black overflow-y-hidden object-cover w-[calc(100%/3-1rem)] mt-10"><img
                                src="{{ asset('portofolio/' . $porto->preview) }}"></img></a>
                    @endforeach
                @else
                    <span class="text-black text-[15px] mx-auto">No item found</span>
                @endif
                {{-- @auth
                    <p>Halo, {{ auth()->id() }}</p>
                @endauth --}}



            </div>
        </div>
    @endsection
        