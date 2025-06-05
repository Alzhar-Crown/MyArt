@extends('layout.navbar')
@section('main')
    <div class="h-fit">
        <div class="3D Ilus">
            <div class="flex flex-row justify-between">
                <h2 class="text text-black font-bold ml-6 mt-10 mb-3">2D Illustration</h2>
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
                            <a href="{{ route('catalog.show', ['catalog' => $item->id]) }}"  class="w-full h-full hover-rotate-y-180 block transition-transform duration-500 preserve-3d"><img
                                    class=" p-4 h-[250px] w-[250px] rounded-full shadow-lg object-cover"
                                    src="{{ asset('catalog/preview/' . $item->preview) }}"></img></a>
                        @endforeach
                    @else
                        <h2 class="text-black">Not Found</h2>
                    @endif
                </div>
            </div>

        </div>
        <div class="3D Ilus">
            <div class="flex flex-row justify-between">
                <h2 class="text text-black font-bold ml-6 mt-10 mb-3">Real Picture</h2>
                <form class="text text-black font-bold mr-6 mb-3 mt-10"
                    action="{{ route('scatal', ['kategori' => 'realpic']) }}" method="POST">
                    @csrf
                    <button type="submit">Show more</button>
                </form>
            </div>
            <div class="overflow-x-auto scrollbar-hide  w-[96.5%] ml-6">
                <div class="grid grid-flow-col auto-cols-[calc(100%/6)]  perspective-1000">
                    @if (!empty($categorized['realpic']))
                        @foreach ($categorized['realpic'] as $item)
                            <a href="{{ route('catalog.show', ['catalog' => $item->id]) }} "  class="w-full h-fullhover-rotate-y-180 block transition-transform duration-500 preserve-3d"><img
                                    class=" p-4  w-[250px] h-[250px] rounded-full transition-transform duration-500  shadow-lg object-cover "
                                    src="{{ asset('catalog/preview/' . $item->preview) }}"></img></a>
                        @endforeach
                    @else
                        <h2 class="text-black">Not Found</h2>
                    @endif
                </div>
            </div>

        </div>
        <div class="3D Ilus">
            <div class="flex flex-row justify-between">
                <h2 class="text text-black font-bold ml-6 mt-10 mb-3">3D Illustration</h2>
                <form class="text text-black font-bold mr-6 mb-3 mt-10"
                    action="{{ route('scatal', ['kategori' => '3d illustration']) }}" method="POST">
                    @csrf
                    <button type="submit">Show more</button>
                </form>
            </div>
            <div class="overflow-x-auto scrollbar-hide  w-[96.5%] ml-6">
                <div class="grid grid-flow-col auto-cols-[calc(100%/6)]  perspective-1000 ">
                    @if (!empty($categorized['3d']))
                        @foreach ($categorized['3d'] as $item)
                            <a href="{{ route('catalog.show', ['catalog' => $item->id]) }}"  class="w-full h-full hover-rotate-y-180 block transition-transform duration-500 preserve-3d"><img
                                    class=" p-4  w-[250px] rounded-full shadow-lg transition-transform duration-500  object-cover h-[250px]"
                                    src="{{ asset('catalog/preview/' . $item->preview) }}"></img></a>
                        @endforeach
                    @else
                        <h2 class="text-black">Not Found</h2>
                    @endif

                </div>
            </div>

        </div>
        <div class="3D Ilus">
            <div class="flex flex-row justify-between">
                <h2 class="text text-black font-bold ml-6 mt-10 mb-3">UI/UX Design</h2>
                <form class="text text-black font-bold mr-6 mb-3 mt-10"
                    action="{{ route('scatal', ['kategori' => 'uiux']) }}" method="POST">
                    @csrf
                    <button type="submit">Show more</button>
                </form>
            </div>
            <div class="overflow-x-auto scrollbar-hide  w-[96.5%] ml-6">
                <div class="grid grid-flow-col auto-cols-[calc(100%/6)]  perspective-1000 ">
                    @if (!empty($categorized['uiux']))
                        @foreach ($categorized['uiux'] as $item)
                            <a href="{{ route('catalog.show', ['catalog' => $item->id]) }}"  class="w-full h-full hover-rotate-y-180 block transition-transform duration-500 preserve-3d"><img
                                    class=" p-4  w-[250px] rounded-full shadow-lg transition-transform duration-500  object-cover h-[250px]"
                                    src="{{ asset('catalog/preview/' . $item->preview) }}"></img></a>
                        @endforeach
                    @else
                        <h2 class="text-black">Not Found</h2>
                    @endif

                </div>
            </div>

        </div>

    </div>
@endsection
