@extends('layouts.app')
@section('content')
    <h5>Manajemen User</h5>
    <div class="row mb-3">
        <div class="col-md-6">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa-solid fa-plus"></i> Tambah
            </button>
        </div>

        <div class="col-md-6 text-md-end">
            <form class="d-inline-flex" method="GET" action="">
                <input class="form-control me-2" type="search" name="search" placeholder="Search"
                    value="{{ request('search') }}" />
                <button class="btn btn-success" type="submit">
                    Search
                </button>
            </form>
        </div>

    </div>


    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <tr>
                    <td>no</td>
                    <td>Username</td>
                    <td>email</td>
                    <td>status</td>
                    <td>dibuat pada</td>
                    <td>action</td>
                </tr>

                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->is_active)
                                <i class="fa-solid fa-circle text-success"></i>
                            @else
                                <i class="fa-solid fa-circle text-danger"></i>
                            @endif
                        </td>

                        <td>{{ $user->created_at }}</td>

                        <td class="d-flex gap-2">
                            <button class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $user->id }}"><i class="fas fa-pencil"></i></button>

                            <form action="/user/{{ $user->id }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $user->id }}"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>

                    </tr>

                    {{-- EDIT MODAL --}}

                    <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1">

                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5>Edit User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">

                                    <form action="/user/{{ $user->id }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label><b>Username</b></label>
                                            <input type="text" name="username"
                                                class="form-control @error('username') is-invalid @enderror"
                                                value="{{ isset($user) ? $user->username : old('username') }}"
                                                placeholder="Username...">
                                            @error('username')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label><b>Email</b></label>
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ isset($user) ? $user->email : old('email') }}" placeholder="">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label><b>Password Baru</b></label>
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="(kosongkan jika tidak mengubah password)">
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label><b>Konfirmasi Password</b></label>
                                            <input type="password" name="password_confirmation"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                value=""
                                                placeholder="****">
                                            @error('password_confirmation')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>


                                        <button type="submit" class="btn btn-primary mt-3">
                                            Update
                                        </button>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- END EDIT MODAL --}}

                    {{-- DELETE MODAL --}}
                    <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus user
                                    <strong>{{ $user->username }}</strong> ?
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                                    <form action="/user/{{ $user->id }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">
                                            Ya, Hapus
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- END DELETE MODAL --}}
                @endforeach

            </table>
        </div>
    </div>
    <div class="mt-4 d-flex justify-content-end">
        {{ $users->links() }}
    </div>




    <!-- Modal POPUP CREATE -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="/user" method="POST">
                        @csrf
                        <div class="form-group">

                            <label for=""><b>Username</b></label>
                            <input type="text" name="username"
                                class="form-control @error('username') is-invalid @enderror"
                                value="{{ old('username') }}" placeholder="">
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror


                            <label for=""><b>Email</b></label>
                            <input type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                placeholder="">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror


                            <label for=""><b>Password</b></label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                value="{{ old('password') }}" placeholder="">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror


                            <label for=""><b>Masukkan Ulang Password</b></label>
                            <input type="password" name="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                value="{{ old('password_confirmation') }}" placeholder="">
                            @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                </div>

                </form>
            </div>
        </div>
    </div>

    {{-- AUTO OPEN EDIT MODAL IF ERROR --}}
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                let editId = "{{ old('edit_id') }}";

                if (editId) {
                    // Jika error dari EDIT
                    var editModal = new bootstrap.Modal(
                        document.getElementById('editModal' + editId)
                    );
                    editModal.show();
                } else {
                    // Jika error dari CREATE
                    var createModal = new bootstrap.Modal(
                        document.getElementById('exampleModal')
                    );
                    createModal.show();
                }

            });
        </script>
    @endif
@endsection
