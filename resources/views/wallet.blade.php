@extends('layout.navbar')
@section('main')
    <div class="w-full h-[100vh] overflow-y-hidden overflow-x-hidden  ">

        <video autoplay muted loop class="video-bg">
            <source src="{{ asset('video/bg-wl.mp4') }}" type="video/mp4">
            {{-- Your browser does not support HTML5 video. --}}
        </video>
        <div class="flex flex-col justify-center items-center -translate-y-[800px]  gap-6 h-[100vh] p-4">
            <div class=" flex flex-row gap-3">
                <h2 class="text-black font-bold text-lg mt-4">Balance</h2>
                <div
                    class ="text-black w-[200px] h-fit border border-green-500 rounded-md shadow-md p-4 text-center text-[20px] ">
                    Rp {{ number_format($wallet->saldo ?? 0, 0, ',', '.') }}
                </div>
                <h2 class="text-black font-bold text-lg mt-4">Spending</h2>
                <div
                    class ="text-black w-[200px] h-fit border border-green-500 rounded-md shadow-md p-4 text-center text-[20px] ">
                    Rp {{ number_format($spending ?? 0, 0, ',', '.') }}
                </div>
                <div></div>

                <div class=" gap-1">
                    <a href="{{ route('detailPayment') }}"
                        class="text-white rounded-md shadow-md font-ptsans font-semibold bg-green-400 p-2 ">TopUp</a>
                    <a href="{{ route('getwd') }}"
                        class="text-white rounded-md shadow-md font-ptsans font-semibold bg-yellow-400 p-2 ">Withdraw</a>
                </div>
            </div>

            <div class=" flex flex-row mx-auto gap-2  w-fit">
                <div class="flex h-[50vh] overflow-y-auto  w-fit flex-col scrollbar-hide">
                    <h2 class="text-black font-bold">Outflow Spending</h2>
                        
                    @if (!empty($outflow) || count($outflow['spending']) > 0)
                        @foreach ($outflow as $type => $items)
                            @foreach ($items as $item)
                                <div
                                    class="flex transition-all duration-300  flex-row justify-between border text-start text-sm hover:translate-y-2 w-[100%] h-[40%] hover:bg-gray-300 bg-none py-4 px-6  text-black">
                                    {{-- no --}}

                                    {{-- gambar --}}

                                    {{-- headline --}}
                                    <div class=" w-[200px] h-[30px] mt-3  "> {{ $item->headline ?? 'Withdraw' ?? 'empty' }}</div>

                                    {{-- kategori --}}

                                    {{-- harga --}}
                                    <div class=" w-[20%] h-[30px] mt-3 text-red-600"> - {{ $item->harga ?? $item->nominal }}</div>

                                    {{-- waktu --}}
                                    <div class=" w-[140px] h-[30px] ml-2 mt-3 ">{{ $item->created_at }}</div>

                                    
                                </div>
                            @endforeach
                        @endforeach
                    @else
                        <div
                            class="flex transition-all duration-300   flex-row justify-between  text-start text-sm hover:translate-y-2 w-fit h-fit hover:bg-gray-300 bg-none py-4 px-6  text-black">
                            {{-- no --}}

                            {{-- gambar --}}

                            {{-- headline --}}
                            <div class=" w-[33%] h-fit mt-3  ">empty</div>

                            {{-- kategori --}}

                            {{-- harga --}}



                        </div>
                    @endif
                </div>

                <div>
                    <canvas id="myChart" class="h-[200px]"></canvas>
                </div>

                <div class="flex h-[50vh]  overflow-y-scroll max-w-full  scrollbar-hide p-4 -mt-5 flex-col">
                    <h2 class="text-black font-bold"> Balance entry flow </h2>
                    @if ($topup->count() > 0)
                        @foreach ($topup as $key => $item)
                            <div
                                class="flex transition-all duration-300  flex-row justify-between border text-start  hover:translate-y-2 max-w-full h-[40%] hover:bg-gray-300 bg-none py-4 px-6  text-black">
                                {{-- no --}}

                                {{-- gambar --}}

                                {{-- headline --}}
                                <div class="  h-fit w-[15.6%] text-[10px]    ">Top Up</div>
                                <div class="  h-fit w-[17%] text-[8px]    "> {{ $item->via_transaksi }}</div>

                                {{-- kategori --}}

                                {{-- harga --}}
                                @if ($item->status == 'pending')
                                    <div class=" h-fit w-[15.6%] text-[15px]  text-green-600"> {{ $item->harga }}</div>
                                @else
                                    <div class=" h-fit w-[15.6%] text-[15px]  text-green-600"> + {{ $item->harga }}</div>
                                @endif

                                {{-- waktu --}}
                                <div class="  h-fit w-[15.6%] text-[10px]   ">{{ $item->created_at }}</div>


                            </div>
                        @endforeach
                    @else
                        <div
                            class="flex transition-all duration-300  flex-row justify-between text-start  hover:translate-y-2 w-fit h-fit hover:bg-gray-300 bg-none py-4 px-6  text-black">
                            {{-- no --}}

                            {{-- gambar --}}

                            {{-- headline --}}
                            <div class="  h-fit w-[16.6%] text-[10px]    ">empty</div>



                        </div>
                    @endif
                </div>


            </div>

        </div>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($bulan),
                datasets: [{
                    label: 'Spending',
                    data: @json($aem),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>


@endsection
