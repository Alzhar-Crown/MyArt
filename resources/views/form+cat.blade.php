@extends('layout.navbar')
@section('main')
    <div class=" h-fit w-full">
        <form class="aws mt-7 border w-fit flex flex-col gap-5  mx-auto p-5" action="{{ route('store.catal') }}"
            enctype="multipart/form-data" method="POST">
            @csrf
            <img id="preview" alt="Preview" class="w-fit h-[250px]  object-cover border-nonr mx-auto mt-2 border-black" />

            <div class="flex flex-col gap-3 mt-5 w-fit">

                <div class="flex flex-row gap-4">
                    <label class="text-black">Preview :</label>
                    <div class="flex flex-col ">
                        <input class="rounded-sm border-none shadow-md bg-white border border-black text-black"
                            type="file" name="preview" accept="image/*" onchange="previewImage(event)" required>
                        <label for="fileInput" class="text-[9px]">Files must be in jpeg, png, jpg, gif, webp format and a
                            maximum size of 2000kb</label>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-3 mt-5 w-fit">

                <div class="flex flex-row gap-4">
                    <label class="text-black">File Design:</label>
                    <div class="flex flex-col ">
                        <input class="rounded-sm border-none shadow-md bg-white border border-black text-black"
                            type="file" name="file_desain" accept="image/*" required>
                        <label for="fileInput" class="text-[9px]">Files must be in jpeg, png, jpg, gif, webp format and a
                            maximum size of 50000kb</label>
                    </div>

                </div>
            </div>


            <div class="flex flex-row gap-3  w-fit">
                <div>
                    <label class="text-black">Headline :</label>
                    <input class= "rounded-sm border-none bg-white border ml-7 shadow-md border-black text-black px-3"
                        name="headline" required>
                </div>

            </div>
            <div class="flex flex-row gap-3  w-fit">
                <div>
                    <label class="text-black ">Description :</label>
                    <div class="flex flex-col ">
                        <textarea class="rounded-sm border-none bg-white border ml-7 shadow-md border-black text-black px-3" type="textarea"
                            name="deskripsi" required></textarea>

                        <label for="fileInput" class="file-input text-[9px] ml-7">
                            Maximum character 200</label>
                    </div>

                </div>

            </div>
            <div class="flex flex-row gap-3  w-fit">
                <div>
                    <label class="text-black ">Price :</label>
                    <input class="rounded-sm border-none bg-white border ml-7 shadow-md border-black text-black px-3"
                        type="text" name="harga" required></input>
                </div>

            </div>
            <div class="flex flex-row gap-3  w-fit">
                <div>
                    <label class="text-black ">Category Design :</label>
                    <select id="kategori" name="kategori_desain"
                        class="w-full px-4 bg-white text-black py-2 border rounded" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="uiux">Ui/Ux Design</option>
                        <option value="realpic">Real Picture</option>
                        <option value="2d illustration">2D Illustration</option>
                        <option value="3d illustration">3D Illustration</option>
                    </select>

                </div>

            </div>

            {{-- @if ($errors->has('catalog_image'))
                <div class ="alert alert-danger">
                    <li style="color:black; font-size:17px">{{ $errors->first('catalog_image') }}</li>

                </div>
            @endif --}}
            @if ($errors->any())
                <div class =" bg-white" style="">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li style="color:red; background-color:white; font-medium uppercase w-fit font-size:17px">
                                {{ $error }}</li>
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
