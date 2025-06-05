@extends('layout.navbar')
@section('main')
    <div class="h-[97vh] overflow-y-hidden w-full">
        <video autoplay muted loop class="video-bg">
            <source src="{{ asset('video/bg-wl.mp4') }}" type="video/mp4">
            {{-- Your browser does not support HTML5 video. --}}
        </video>
        <div class="flex flex-col justify-center items-center gap-4 -translate-y-[700px] transition-all duration-1000">



            <div class=" flex flex-row gap-2">
                <div
                    class="flex flex-col w-fit h-fit p-4 justify-center items-center gap-2   rounded-lg bg-none hover:bg-white shadow-lg hover:-translate-y-[10px] ">
                    <div class=" text-black uppercase text-xl font-semibold ">Total Income</div>
                    <div class="text-green-300 font-semibold text-xl ">Rp {{ number_format($omset ?? 0, 0, ',', '.') }}
                    </div>

                </div>
                <div
                    class="flex flex-col w-fit h-fit p-4 justify-center gap-2 items-center   rounded-lg bg-none hover:bg-white shadow-lg hover:-translate-y-[10px] ">
                    <div class=" text-black uppercase text-xl font-semibold ">products sold</div>
                    <div class="text-red-400 font-semibold text-xl "> {{ $total ?? 0 }} </div>

                </div>
                <div
                    class="flex flex-col w-fit h-fit p-4 justify-center gap-2 items-center   rounded-lg bg-none hover:bg-white shadow-lg hover:-translate-y-[10px] ">
                    <div class=" text-black uppercase text-xl font-semibold ">products uploaded</div>
                    <div class="text-blue-500 font-semibold text-xl "> {{ $all ?? 0 }} </div>

                </div>

            </div>
           
            <div class="text-black flex !flex-row gap-10">
                <div class="text-black">
                    <div>
                        <canvas id="productChart" class="h-[300px]"></canvas>
                    </div>
                </div>
                <div class="text-black">
                        <canvas id="omsetChart" class="h-[300px]"></canvas>
                </div>

            </div>
        </div>

    </div>
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('productChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($bulan),
                datasets: [{
                    label: 'Product Sold',
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
    <script>
        const cty = document.getElementById('omsetChart');

        new Chart(cty, {
            type: 'bar',
            data: {
                labels: @json($bulan),
                datasets: [{
                    label: 'Omset every Month',
                    data: @json($omsetPerMonth),
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
