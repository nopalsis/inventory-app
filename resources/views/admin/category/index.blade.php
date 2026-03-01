@extends('layouts.app')
@section('content')
    <h5>Manajemen Kategori</h5>

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
                    <td>Nama Kategori</td>
                    <td>dibuat pada</td>
                    <td>action</td>
                </tr>

                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td class="d-flex gap-2">
                            <button class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $category->id }}"><i class="fas fa-pencil"></i></button>

                            <form action="/category/{{ $category->id }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $category->id }}"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>

                    </tr>

                    <div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <form action="/category/{{ $category->id }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="modal-header">
                                        <h5>Edit Kategori</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">

                                        <label>Nama Kategori</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', $category->name) }}">

                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>

                                        <button type="submit" class="btn btn-primary">
                                            Update
                                        </button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus kategori
                    <strong>{{ $category->name }}</strong> ?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                    <form action="/category/{{ $category->id }}" method="POST">
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
    @endforeach

    </table>
    </div>
    </div>
    <div class="mt-4 d-flex justify-content-end">
        {{ $categories->links() }}
    </div>




    <!-- Modal POPUP TAMBAH -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Katgeori</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="/category" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for=""><b>Nama Kategori</b></label>
                            <input type="text" name="name" class="form-control" placeholder="kategori....">
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
