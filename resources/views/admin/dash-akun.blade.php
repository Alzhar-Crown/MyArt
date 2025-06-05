@extends('layout.base')
@section('main')
    <div class = "" style="height:70vh; width:100%;display:flex;flex-direction:column;">

        <div class="card" style="width:100%;overflow:auto; height:130px;padding:10px">
            <span style="font-weight:bold">Profils</span>
            <div class="card-body " style="display:flex;flex-direction:row;gap:4px;width:100%;overflow:auto;">
                @if (!empty($daftar_user))
                    @foreach ($daftar_user as $item)
                        @if ($item->profil)
                            <a href=""
                                style="width:50px;height:50px;background-size:cover;border-radius:100%;background-image:url('{{ asset('client/' . $item->profil->foto_profil) }}')">
                            </a>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>


        <div class="card-body" style=";overflow-x:hidden; overflow-y: auto">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Action</th>
                        {{-- <th>Password</th> --}}

                    </tr>
                </thead>
                <tbody>
                    @foreach ($daftar_user as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }} </td>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->password }}</td>
                            <td>
                                <form action="{{ route('admin.destroy', $item->id) }}" method="POST"
                                    style="display:inline;" id="delete-form-{{ $item->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="confirmDelete({{ $item->id }})">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
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
