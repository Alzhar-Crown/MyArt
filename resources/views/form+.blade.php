@extends('layout.form')
@section('form')
    @if (!session('progress') || !session('user_data'))


        <form class="act" id="act" action="{{ route('user.store') }}" method="POST">
            @csrf
            <div class="l">

                <label for="">Username</label>
                @if (session('progress'))
                    <input type="text" placeholder="ex : Alzhar" name="username" id="username"
                        value="{{ session('user_data.username') }}" required>
                @else
                    <input type="text" placeholder="ex : Alzhar" name="username" id="username"
                        value="{{ old('username') }}" required>
                @endif
                <label for="">Password</label>
                @if (session('progress'))
                    <input type="password" id="password" placeholder="MIN 5 CHR !0 in front, ex :23456" name="password"
                        value="{{ session('user_data.password') }}" required>
                    <button type="button" id="toggle-password" style="cursor: pointer;"><span
                            class="material-symbols-outlined" id="password-icon">lock</span></button>
                @else
                    <input type="password" id="password" placeholder="MIN 5 CHR !0 in front, ex :23456" name="password"
                        value="{{ old('password') }}" required>
                    <button type="button" id="toggle-password" style="cursor: pointer;"><span
                            class="material-symbols-outlined" id="password-icon">lock</span></button>
                @endif
                <a href="{{ url('/Login') }}">Already Have an Account?</a>
                <div class="cta&bckn">
                    <div class="cta">
                        <span>Sure?</span>
                        <button type="submit">Next</button>
                    </div>
                    <div class="prev">
                        <a href="{{ route('user.clearSession') }}" style="font-size: 26px;">
                            < </a>
                                @if (session('progress'))
                                    <a href="{{ url('/pf-1') }}" style="font-size: 26px;">></a>
                                @else
                                    <a href=""> ></a>
                                @endif
                    </div>
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

            </div>
            {{-- <div class="p">
                <div class="pi">
                    <img src="" alt="MyArtLogo">

                </div>
                <div class="pin">
                    <div class="box1"></div>
                    <div class="box2" style="background-color: rgba(121, 124, 98, 1);"></div>
                    <div class="box3"></div>
                </div>
            </div> --}}
        </form>
    @else
        <form class="act" id="act" action="{{ route('user.update', ['user' => session('user_data')['id']]) }}"
            method="POST">
            @csrf
            @method('PUT')
            <div class="l">

                <label for="">Username</label>
                @if (session('progress'))
                    <input type="text" placeholder="ex : Alzhar" name="username" id="username"
                        value="{{ session('user_data')['username'] }}" required>
                @else
                    <input type="text" placeholder="ex : Alzhar" name="username" id="username"
                        value="{{ old('username') }}" required>
                @endif
                <label for="">Password</label>
                @if (session('progress'))
                    <input type="password" id="password" placeholder="MIN 5 CHR !0 in front, ex :23456" name="password"
                        value="{{ session('user_data')['password'] }}" required>
                    <button type="button" id="toggle-password" style="cursor: pointer;"><span
                            class="material-symbols-outlined" id="password-icon"> lock</span></button>
                @else
                    <input type="password" id="password" placeholder="MIN 5 CHR !0 in front, ex :23456" name="password"
                        value="{{ old('password') }}" required>
                    <button type="button" id="toggle-password" style="cursor: pointer;"><span
                            class="material-symbols-outlined" id="password-icon">lock</span></button>
                @endif

                <a href="{{ url('/Login') }}">Already Have an Account?</a>
                <div class="cta&bckn">
                    <div class="cta">
                        <span>Sure?</span>
                        <button type="submit">Next</button>
                    </div>
                    <div class="prev">
                        <a href="{{ route('user.clearSession') }}" style="font-size: 26px;">
                            < </a>
                                @if (session('progress'))
                                    <a href="{{ url('/pf-1') }}" style="font-size: 26px;">></a>
                                @else
                                    <a href=""> ></a>
                                @endif
                    </div>
                </div>
                @if ($errors->any())
                    <div class ="alert alert-danger" style="margin-left:-23px">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li style="color:white; font-size:17px">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


            </div>
            {{-- <div class="p">
                <div class="pi">
                    <img src="" alt="MyArtLogo">

                </div>
                <div class="pin">
                    <div class="box1"></div>
                    <div class="box2" style="background-color: rgba(121, 124, 98, 1);"></div>
                    <div class="box3"></div>
                </div>
            </div> --}}
        </form>

    @endif
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('toggle-password').addEventListener('click', function() {
            var passwordField = document.getElementById('password');
            var passwordType = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = passwordType;

            // Optional: Change icon when toggling
            var icon = document.getElementById('password-icon');
            if (passwordType === 'password') {
                icon.innerHTML = 'lock'; // Ikon lock
            } else {
                icon.innerHTML = 'lock_open'; // Ikon lock_open
            }
        });
    </script>
    <script>
        document.getElementById('act').addEventListener('submit', function(e) {
            e.preventDefault(); // Mencegah formulir submit langsung

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak bisa mengubah data setelah dikirim.",
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

@endsection
