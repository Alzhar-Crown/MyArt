@extends('layout.navbar')
@section('main')
    <div class="h-[98vh] w-full py-6 ">
        <form id="act" class="mx-auto w-[50%] p-4 flex flex-col h-[90%] border gap-4 items-center "
            action ="{{ route('user.update', ['user' => Auth::id()]) }}" method="POST">
            @method('PUT')
            @csrf

            <strong
                class="text-[40px] text-transparent bg-clip-text bg-gradient-to-r font-light from-purple-400 via-pink-500 to-yellow-500">Account
            </strong>
            <div class=" px-4 py-6 flex flex-row text-lg justify-center items-center gap-4 w-[80%] h-[10%] font-light   ">
                <label class=" text-white w-fit h-fit p-2 bg-black border ">Username</label>
                <input name="username" class="px-2 py-4 h-full w-[70%] focus:outline-none focus:shadow-md first-line:"
                    placeholder="Must be " value="{{ $user->username }}">
            </div>
            <div class=" px-4 py-6 flex flex-row text-lg justify-center items-center gap-4 w-[80%] h-[10%] font-light   ">
                <label class=" text-white w-fit h-fit p-2 bg-red-600     rounded-md border ">Password</label>
                <input name="password" class="px-2 py-4 h-full w-[70%] focus:outline-none focus:shadow-md first-line:"
                    placeholder="Must be " value="{{ $user->password }}">
            </div>
            @if ($errors->any())
                <div class ="alert alert-danger" style="margin-left:-23px">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li style="color:red; font-size:17px">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class=" px-4 py-6 flex flex-row text-lg justify-center items-center gap-4 w-[80%] h-[10%] font-light   ">
                <button type="submit"
                    class=" text-white w-fit h-fit p-2 !bg-black text-sm rounded-lg hover:text-transparent hover:bg-clip-text transition-all duration-400 hover:translate-y-1 hover:bg-gradient-to-r font-light from-purple-400 via-pink-500 to-yellow-500 ">Save</button>
                <a href="/home"
                    class=" text-white w-fit h-fit p-2 bg-black text-sm rounded-lg hover:text-transparent hover:bg-clip-text transition-all duration-400 hover:translate-y-1 hover:bg-gradient-to-r font-light from-purple-400 via-pink-500 to-yellow-500 ">Back</a>
            </div>
        </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('act').addEventListener('submit', function(e) {
            e.preventDefault(); // Mencegah formulir submit langsung

            Swal.fire({
                title: 'Are you sure?',
                text: "You will change your account data",
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
        @if (session('success'))
            let timerInterval;
            Swal.fire({
                title: "Uploading Data!",
                html: "I will close in <b></b> milliseconds.",
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log("I was closed by the timer");
                }
            });
        @endif
    </script>
@endsection
