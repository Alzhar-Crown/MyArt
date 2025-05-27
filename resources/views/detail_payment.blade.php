@extends('layout.navbar')
@section('main')



    <div class="container mx-auto w-fit flex flex-col h-[80vh] gap-10 p-6 border ">
        <h1 class="font-ptsans text-green-700 text-4xl ml-[200px]">MyTeam</h1>

        <div class="flex flex-row mx-auto gap-5">

            <div class="pilihan bg-black hover:border-black hover:border transition-all duration-300 hover:bg-white hover:text-black text-white w-fit p-4 rounded-2xl" data-nominal="10000">Rp10.000</div>
            <div class="pilihan bg-black hover:border-black hover:border transition-all duration-300 hover:bg-white hover:text-black text-white w-fit p-4 rounded-2xl" data-nominal="20000">Rp20.000</div>
            <div class="pilihan bg-black hover:border-black hover:border transition-all duration-300 hover:bg-white hover:text-black text-white w-fit p-4 rounded-2xl" data-nominal="50000">Rp50.000</div>
        </div>
        <div class="flex flex-row mx-auto gap-5">

            <div class="pilihan bg-black hover:border-black hover:border transition-all duration-300 hover:bg-white hover:text-black text-white w-fit p-4 rounded-2xl" data-nominal="75000">Rp75.000</div>
            <div class="pilihan bg-black hover:border-black hover:border transition-all duration-300 hover:bg-white hover:text-black text-white w-fit p-4 rounded-2xl" data-nominal="100000">Rp100.000</div>
            <div class="pilihan bg-black hover:border-black hover:border transition-all duration-300 hover:bg-white hover:text-black text-white w-fit p-4 rounded-2xl" data-nominal="120000">Rp120.000</div>
        </div>

        <div class="mx-auto ">
            <form class="flex flex-col gap-[50px]" action="{{ route('payment') }}" method="post" novalidate>
                @csrf
                <div class="row">
                    <div class="flex flex-row gap-5 mb-3">
                        <label for="firstName">Nominal Top Up</label>
                        <input type="number" class="rounded-lg border text-center border-black border-1 py-2"
                            name='nominal' id="nominal" placeholder="" value="" required>

                    </div>
                    <button class="!bg-blue-400  w-full py-2 rounded-md text-white" type="submit">Continue to
                        checkout</button>
            </form>
        </div>
        @if ($errors->any())
            <div class ="alert alert-danger mt-5">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="color:white; font-size:17px">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const pilihanEls = document.querySelectorAll('.pilihan');
            const inputNominal = document.getElementById('nominal');

            pilihanEls.forEach(el => {
                el.addEventListener('click', () => {
                    const isActive = el.classList.contains('active');

                    // Hapus semua status aktif
                    pilihanEls.forEach(item => item.classList.remove('active'));

                    if (!isActive) {
                        // Aktifkan elemen ini
                        el.classList.add('active');
                        inputNominal.value = el.dataset.nominal;
                    } else {
                        // Klik ke-2 = batalkan pilihan
                        inputNominal.value = '';
                    }
                });
            });
        });
    </script>


@endsection
