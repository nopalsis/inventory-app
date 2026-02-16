@extends('layouts.app')
@section('content')
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
            class="fa-solid fa-plus"></i>Tambah</button>

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
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>

                    </tr>

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

                                        <label>Username</label>
                                        <input type="text" name="username" class="form-control"
                                            value="{{ old('username', $user->username) }}">

                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email', $user->email) }}">

                                        <button type="submit" class="btn btn-primary mt-3">
                                            Update
                                        </button>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </table>
        </div>
    </div>




    <!-- Modal POPUP TAMBAH -->
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
                            <input type="text" name="username" class="form-control" placeholder="Username">
                            <label for=""><b>Email</b></label>
                            <input type="email" name="email" class="form-control" placeholder="example@gmail.com">
                            <label for=""><b>Password</b></label>
                            <input type="password" name="password" class="form-control" placeholder="****">
                            <label for=""><b>Masukkan Ulang Password</b></label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="****">
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
@endsection
