@extends('layout.base')
@section('main')
    <div class="card-body" style="height:70vh;overflow-x:hidden; overflow-y: auto">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id</th>
                    <th>User Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Profil Picture</th>
                    <th>Headline</th>
                    <th>Desc</th>
                    <th>Action</th>
                    {{-- <th>Password</th> --}}

                </tr>
            </thead>
            <tbody>
                @foreach ($daftar_profil as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }} </td>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->user_id }}</td>
                        <td>{{ $item->nama_depan }}</td>
                        <td>{{ $item->nama_belakang }}</td>
                        <td>{{ $item->foto_profil ?? 'empty'}}</td>
                        <td>{{ $item->headline ?? 'empty'}}</td>
                        <td>{{ $item->deskripsi ?? 'empty'}}</td>
                        <td>
                            <form action="{{ route('destroy.profil', $item->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $item->id }}">
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