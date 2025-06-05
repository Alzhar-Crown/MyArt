@extends('layout.base')
@section('main')
    <div class="card-body" style="height:70vh;width:100%;overflow-x:auto; overflow-y: auto">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Action</th>
                    <th>Id</th>
                    <th>User Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Profil Picture</th>
                    <th>Headline</th>
                    <th>Desc</th>
                    {{-- <th>Password</th> --}}

                </tr>
            </thead>
            <tbody>
                @foreach ($daftar_profil as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }} </td>
                        <td style=" white-space: normal; word-wrap: break-word;">
                            <form action="{{ route('destroy.profil', $item->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $item->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $item->id }})" >Hapus</button>
                            </form>
                        </td>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->user_id }}</td>
                        <td>{{ $item->nama_depan }}</td>
                        <td>{{ $item->nama_belakang }}</td>
                        <td style=" white-space: normal; word-wrap: break-word;">{{ $item->foto_profil ?? 'empty'}}</td>
                        <td style=" white-space: normal; word-wrap: break-word;">{{ $item->headline ?? 'empty'}}</td>
                        <td style=" white-space: normal; word-wrap: break-word;">{{ $item->deskripsi ?? 'empty'}}</td>
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