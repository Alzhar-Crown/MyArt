@extends('layout.navbar')
@section('main')
    <div class=" h-[100vh] w-full">
        <form class="aws mt-7 border w-fit flex flex-col gap-5  mx-auto p-5"
            action="{{ route('profil.update', ['profil' => session('dataProfil')['user_id']]) }}"
            enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <img id="preview" src="{{ asset('client/' . session('dataProfil')['foto_profil']) }}" alt="Preview Foto Profil"
                class="w-32 h-32 rounded-full object-cover border mx-auto mt-2 border-black" />

            <div class="flex flex-col gap-3 mt-5 w-fit">

                <div class="flex flex-row gap-4">
                    <label class="text-black">Foto Profile :</label>
                    <input class="rounded-sm border-none shadow-md bg-white border border-black text-black" type="file"
                        id="profile_picture" name="foto_profil" accept="image/*" onchange="previewImage(event)"
                        value="{{ asset('client/' . session('dataProfil')['foto_profil']) }}">
                </div>
            </div>

            <div class="flex flex-row gap-3  w-fit">
                <div>
                    <label class="text-black">First Name :</label>
                    <input class="rounded-sm border-none bg-white shadow-md border ml-4 border-black text-black px-3"
                        value="{{ session('dataProfil')['nama_depan'] }}" name="nama_depan">
                </div>
                <div>
                    <label class="text-black">Last Name :</label>
                    <input class="rounded-sm border-none bg-white border shadow-md ml-4 border-black text-black px-3"
                        value="{{ session('dataProfil')['nama_belakang'] }}" name="nama_belakang">
                </div>
            </div>
            <div class="flex flex-row gap-3  w-fit">
                <div>
                    <label class="text-black">Headline :</label>
                    <input class= "rounded-sm border-none bg-white border ml-7 shadow-md border-black text-black px-3"
                        name="headline" value="{{ session('dataProfil')['headline'] }}">
                </div>

            </div>
            <div class="flex flex-row gap-3  w-fit">
                <div>
                    <label class="text-black ">Deskripsi :</label>
                    <textarea class="rounded-sm border-none bg-white border ml-7 shadow-md border-black text-black px-3" type="textarea"
                        name="deskripsi">{{ session('dataProfil')['deskripsi'] }}</textarea>
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
            <div class="flex flex-row ml-[550px]">
                <a class=" !appearance-none !text-white font-bold w-fit h-fit px-2 rounded-lg   border !bg-red-700 font-ptsans"
                    href="{{ route('clearProfil') }}">Cancel</a>
                <button
                    class=" !appearance-none !text-white font-bold w-fit h-fit px-2 rounded-lg  border !bg-green-700  font-ptsans"
                    type="submit">Save</button>

            </div>



        </form>
    </div>
    <script>
        function previewImage(event) {
            const image = document.getElementById('preview');
            const file = event.target.files[0];

            if (file) {
                image.src = URL.createObjectURL(file);
            }

        }
    </script>
@endsection
