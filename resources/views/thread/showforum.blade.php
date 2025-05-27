@extends('layout.navbar')
{{-- @section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (isset($thread))
        <meta name="thread-id" content="{{ $thread->id }}">
    @endif
@endsection --}}
@section('main')
    <div class="w-[100%] h-[100vh] relative ">
        <div class="flex h-[90vh]  overflow-y-auto mx-auto p-4 gap-2 w-fit mt-5 flex-col">
            @if ($thread->count() > 0)
                @foreach ($thread as $key => $item)
                    @if ($item->user_id == Auth::id() || $item->members->contains('id', Auth::id()))
                        <a href="{{ route('chat.show', ['chat' => $item->id]) }}"
                            class="flex transition-all duration-300 gap-4  flex-row justify-between border text-start items-center   hover:translate-y-2 w-[550px]  h-FIT hover:bg-gray-300 bg-none py-4 px-6  text-black">
                            {{-- no --}}
                        @else
                            <a href=""
                                class="flex transition-all duration-300 gap-4  flex-row justify-between border text-start items-center   hover:translate-y-2 w-[550px]  h-FIT hover:bg-gray-300 bg-none py-4 px-6  text-black">
                    @endif
                    {{-- gambar --}}

                    {{-- headline --}}
                    @if ($item->user_id == Auth::id() || $item->members->contains('id', Auth::id()))
                        <div class="  h-fit w-[30%] font-bold  text-[14px] uppercase">{{ $item->title }}</div>
                    @else
                        <div class="  h-fit w-[30%] font-bold  text-[14px] uppercase">{{ $item->title }}
                            <form class="-ml-2" action="{{ route('join', ['thread' => $item->id]) }}" method="POST">
                                @csrf<button type="submit"
                                    class="py-1 px-2 border transition-all duration-300  hover:bg-yellow-400 rounded-full">Gabung</button>
                            </form>
                        </div>
                    @endif
                    <div class="  h-fit w-[30%] text-[12px]">{{ $item->body }}</div>
                    <div class="  h-fit w-[20%] text-[14px]">
                        {{ $item->user->profil->nama_depan . $item->user->profil->nama_belakang }}</div>
                    <img class="  h-fit object-cover w-[20%] font-bold text-[10px] rounded-full"
                        src="{{ asset('client/' . $item->user->profil->foto_profil) }} "></img>

                    </a>
                @endforeach
            @else
                <div
                    class="flex transition-all duration-300  flex-row justify-between text-start  w-fit h-fit hover:bg-gray-300 bg-none py-4 px-6  text-black">
                    {{-- no --}}

                    {{-- gambar --}}

                    {{-- headline --}}
                    <div class="  h-fit w-fit text-[30px]    ">No forums found</div>



                </div>
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
        <div class="sticky -mt-[20%] ml-[80%]">

            <a href="{{ route('forum.create') }}"
                class="material-symbols-outlined w-fit h-fit bg-yellow-400 px-2 py-1 items-center rounded-full">
                add

            </a>
        </div>
    </div>
    @if (session()->has('succes+'))
        <script>
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Forum added successfully",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
@endsection
