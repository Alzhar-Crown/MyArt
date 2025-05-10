@extends('layout.navbar')
@section('main')
    <div class="h-fit">
        <div class="3D Ilus">
            <div class="flex flex-row justify-between">
                <h2 class="text text-black font-bold ml-6 mt-10 mb-3">2D Illustration || Sale Product</h2>
                <a href="#" class="text text-black font-bold mr-6 mb-3 mt-10">Show more</a>
            </div>
            <div class="overflow-x-auto scrollbar-hide  w-[96.5%] ml-6">
                <div class="grid grid-flow-col auto-cols-[calc(100%/3)] ">
                    @if (isset($categorized['2d']))
                        @foreach ($categorized['2d'] as $item)
                            <img class=" p-4 h-[250px]" src="{{ asset('portofolio/' . $item->preview) }}"></img>
                        @endforeach
                    @else
                        <h2 class="text-black">Not Found<h2>
                    @endif
                </div>
            </div>

        </div>
        <div class="3D Ilus">
            <div class="flex flex-row justify-between">
                <h2 class="text text-black font-bold ml-6 mt-10 mb-3">2D Illustration || Sale Product</h2>
                <a href="#" class="text text-black font-bold mr-6 mb-3 mt-10">Show more</a>
            </div>
            <div class="overflow-x-auto scrollbar-hide  w-[96.5%] ml-6">
                <div class="grid grid-flow-col auto-cols-[calc(100%/3)]
                    @if (isset($categorized['poster']))
                        @foreach ($categorized['poster'] as $item)
                            <img class=" p-4 h-[250px]" src="{{ asset('portofolio/' . $item->preview) }}"></img>
                        @endforeach
                    @else
                        <h2 class="text-black">Not Found<h2>
                    @endif
                </div>
            </div>

        </div>
        <div class="3D Ilus">
            <div class="flex flex-row justify-between">
                <h2 class="text text-black font-bold ml-6 mt-10 mb-3">3D Illustration || Sale Product</h2>
                <a href="#" class="text text-black font-bold mr-6 mb-3 mt-10">Show more</a>
            </div>
            <div class="overflow-x-auto scrollbar-hide  w-[96.5%] ml-6">
                <div class="grid grid-flow-col auto-cols-[calc(100%/3)] ">
                    @if (isset($categorized['3d']))
                        @foreach ($categorized['3d'] as $item)
                            <img class=" p-4 h-[250px]" src="{{ asset('portofolio/' . $item->preview) }}"></img>
                        @endforeach
                    @else
                        <h2 class="text-black">Not Found<h2>    
                    @endif  

                </div>
            </div>

        </div>
    </div>
@endsection
