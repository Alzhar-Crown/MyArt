@extends('layout.form')
@section('form')
    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        </script> 
    @endif
    <form class="act" action="{{ route('profil.store') }}" method="POST">
        @csrf
        <div class="l">

            <label for="">First Name</label>
            <input type="text" placeholder="ex : Alzhar" name="nama_depan" value="{{ old('nama_depan') }}" required>
            <label for="">Last Name</label>
            <input type="text" placeholder="ex:Chandraditya " name="nama_belakang" value="{{ old('nama_belakang') }}" required>
            <div class="cta&bckn">
                <div class="cta">
                    <span>Sure?</span>
                    <button type="submit">Next</button>
                </div>
                <div class="prev">
                    <a href="{{ route('user.reacnt') }}" style="font-size: 26px;">
                        < </a>
                           
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
                <img src="{{ asset('images/progres1.png') }}" alt="MyArtLogo">

            </div>
            <div class="pin">
                <div class="box1"></div>
                <div class="box2" style="background-color: rgba(86, 91, 41, 1);"></div>
                <div class="box3"></div>
            </div>
        </div> --}}
    </form>
    {{-- <h1>Welcome, {{ session('user_data')['id'] ?? 'Guest' }}</h1>
    <h1>Welcome, {{ session('user_data')['username'] ?? 'Guest' }}</h1>
    <h1>Welcome, {{ session('user_data')['password'] ?? 'Guest' }}</h1>  --}}
@endsection
