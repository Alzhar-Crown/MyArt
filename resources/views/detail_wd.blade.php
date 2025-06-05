@extends('layout.navbar')
@section('main')



    <div class="container mx-auto w-fit flex flex-col h-[80vh] gap-10 p-6 border ">
        <h1 class="font-ptsans text-green-700 text-4xl ml-[200px]">MyTeam</h1>
        <div class="w-[12%] ml-[13%] mt-[6%] absolute h-fit">
            <h2 class="text-md text-red-600 font-semibold">
                Balance Withdrawal Policy
            </h2>
            <p class="text-sm text-black  text-justify">
                1. Each balance withdrawal must be worth Rp100.000 or more.<br>
                2. An operational fee of 5% is charged for each withdrawal.
            </p>
        </div>
        <div class="flex flex-row mx-auto h-fit gap-5">
            <div class="pilihan bg-black hover:border-black hover:border transition-all duration-300 hover:bg-white hover:text-black text-white w-fit p-4 rounded-2xl"
                data-nominal="10000">Rp10.000</div>
            <div class="pilihan bg-black hover:border-black hover:border transition-all duration-300 hover:bg-white hover:text-black text-white w-fit p-4 rounded-2xl"
                data-nominal="20000">Rp20.000</div>
            <div class="pilihan bg-black hover:border-black hover:border transition-all duration-300 hover:bg-white hover:text-black text-white w-fit p-4 rounded-2xl"
                data-nominal="50000">Rp50.000</div>
        </div>
        <div class="flex flex-row mx-auto gap-5">

            <div class="pilihan bg-black hover:border-black hover:border transition-all duration-300 hover:bg-white hover:text-black text-white w-fit p-4 rounded-2xl"
                data-nominal="75000">Rp75.000</div>
            <div class="pilihan bg-black hover:border-black hover:border transition-all duration-300 hover:bg-white hover:text-black text-white w-fit p-4 rounded-2xl"
                data-nominal="100000">Rp100.000</div>
            <div class="pilihan bg-black hover:border-black hover:border transition-all duration-300 hover:bg-white hover:text-black text-white w-fit p-4 rounded-2xl"
                data-nominal="120000">Rp120.000</div>
        </div>

        <div class="mx-auto ">
            <form class="flex flex-col gap-[50px]" id="act" action="{{ route('wd') }}" method="post" novalidate>
                @csrf
                <div class="row">
                    <div class="flex flex-row gap-5 mb-3">
                        <label for="firstName">Nominal Withdraw</label>
                        <input type="number" class="rounded-lg border text-center border-black border-1 py-2"
                        name='nominal' id="nominal" placeholder="" value="" required>   
                        
                    </div>
                    <span class="text-sm text-black ">Your total balance :Rp
                        {{ number_format($saldo->saldo ?? 0, 0, ',', '.') }}</span>
                        <button class="!bg-blue-400  w-full py-2 rounded-md text-white" type="submit">Continue to
                            Withdraw</button>
                        </form>
                    </div>
                    @if ($errors->any())
                        <div class ="alert alert-danger mt-5">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li style="color:red; font-size:15px">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('act').addEventListener('submit', function(e) {
            e.preventDefault(); // Mencegah formulir submit langsung

            Swal.fire({
                title: 'Are you sure?',
                text: "You cannot cancel once it has been withdrawn!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, kirim!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna klik Ya, kirim formulir
                    document.getElementById('act').submit();
                }
            });
        });
    </script>
    <script>
        @if (isset($success))
            Swal.fire({
                title: "Withdraw Success!",
                icon: "success",
                draggable: true
            });
        @endif
    </script>
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
