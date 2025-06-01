@extends('layout.navbar')
@section('main')

    <div class="w-[100%] h-[100vh] ">
        
        <div class="w-fit mx-auto mt-20 py-10 px-4 rounded-md shadow-lg">
            <form action="{{ route('forum.store') }}" class="flex flex-col gap-2" method="POST">
                @csrf
                <div class="flex flex-col">
                    <span>Judul Forum</span>
                    <input type="text" class="border border-green-500 rounded-md text-center p-4 focus focus:outline-green-500 " name="title"></input>
                </div>
                <div class="flex flex-col"> 
                    <span>Deskripsi Forum</span>
                    <input type="text" class="border border-green-500 rounded-md text-center p-4  focus focus:outline-green-500 " name="body"></input>
                </div>
                <button class="w-fit h-fit p-2 !bg-green-600 rounded-lg text-white" type="submit">Create</button>
                
            </form>
        </div>
    </div>
@endsection
    