@extends('layout.base')
@section('main')
    <div class="card-body" style="height:70vh;overflow-x:auto; overflow-y: auto">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>No</th>
                    <th>Id</th>
                    <th>User Id</th>
                    <th>First Name</th>
                    <th>Preview</th>
                    <th>File Design</th>
                    <th>Headline</th>
                    <th>Desc</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Category</th>
                    <th>Title</th>
                    <th>Created at</th>
                    {{-- <th>Password</th> --}}

                </tr>
            </thead>
            <tbody class="w-fit">
                @foreach ($daftar_catalog as $key => $item)
                    <tr>
                        <td>
                            <form action="{{ route('destroy.catalog', $item->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $item->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $item->id }})" >Hapus</button>
                            </form>
                        </td>
                        <td>{{ $key + 1 }} </td>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->user_id }}</td>
                        <td>{{ $item->nama_depan }}</td>
                        <td>{{ $item->preview}}</td>
                        <td>{{ $item->file_desain }}</td>
                        <td>{{ $item->headline }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>{{ $item->harga }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->kategori_desain }}</td>
                        <td>{{ $item->gelar ?? "empty"}} </td>
                        <td>{{ $item->created_at }}</td>
                        
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