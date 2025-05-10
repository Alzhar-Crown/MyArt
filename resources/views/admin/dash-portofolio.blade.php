@extends('layout.base')
@section('main')
    <div class="card-body" style="height:70vh;overflow-x:auto; overflow-y: auto">
        <table id="example1" class="table table-bordered table-striped ">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id</th>
                    <th>User Id</th>
                    <th>First Name</th>
                    <th>Preview</th>
                    <th>Deskripsi</th>
                    <th>Headline</th>
                    <th>Jumlah_like</th>
                    <th>Jumlah_simpan</th>
                    <th>Kategori_desain</th>
                    <th>Peringkat</th>
                    <th>Tanggal Upload</th>
                    {{-- <th>Password</th> --}}

                </tr>
            </thead>
            <tbody>
                @foreach ($daftar_porto as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }} </td>
                        <td>{{ $item->id ?? 'empty'}}</td>
                        <td>{{ $item->user_id ?? 'empty'}}</td>
                        <td>{{ $item->nama_depan ?? 'empty'}}</td>
                        <td>{{ $item->preview ?? 'empty'}}</td>
                        <td>{{ $item->deskripsi ?? 'empty'}}</td>
                        <td>{{ $item->headline ?? 'empty'}}</td>
                        <td>{{ $item->jumlah_like ?? 'empty'}}</td>
                        <td>{{ $item->jumlah_simpan ?? 'empty'}}</td>
                        <td>{{ $item->kategori_desain ?? 'empty'}}</td>
                        <td>{{ $item->peringkat ?? 'empty'}}</td>
                        <td>{{ $item->created_at ?? 'empty'}}</td>
                        <td>
                            <form action="{{ route('destroy.porto', $item->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $item->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $item->id }})" >Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan dihapus dan tidak dapat dipulihkan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika user klik "Hapus", submit form
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>