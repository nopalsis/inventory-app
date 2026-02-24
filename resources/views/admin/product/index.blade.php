@extends('layouts.app')
@section('content')
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
            <table class="table table-hover align-middle text-center">
                <tr>
                    <td>No</td>
                    <td>Gambar</td>
                    <td>Nama Barang</td>
                    <td>SKU</td>
                    <td>Kategori</td>
                    <td>Stok</td>
                    <td>Harga Cash</td>
                    <td>Harga Kredit</td>
                    <td>Action</td>
                </tr>

                @foreach ($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ asset('storage/' . $product->gambar) }}" width="100"></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->sku }}</td>
                        <td>{{ $product->category->name ?? '-' }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->cash_price }}</td>
                        <td>{{ $product->credit_price }}</td>

                        <td class="text-center">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <button class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $product->id }}"><i class="fas fa-pencil"></i></button>

                                <form action="/product/{{ $product->id }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $product->id }}"><i
                                            class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>

                    </tr>

                    <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1">

                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5>Edit product</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">

                                    <form action="/product/{{ $product->id }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <label>name</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', $product->name) }}">

                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email', $product->email) }}">

                                        <button type="submit" class="btn btn-primary mt-3">
                                            Update
                                        </button>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus product
                                    <strong>{{ $product->name }}</strong> ?
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                                    <form action="/product/{{ $product->id }}" method="POST">
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
        {{ $products->links() }}
    </div>




    <!-- Modal POPUP TAMBAH -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="/product" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for=""><b>Nama Barang</b></label>
                            <input type="text" name="name" class="form-control" placeholder="Nama Barang...">

                            <label for=""><b>SKU</b></label>
                            <input type="text" name="sku" class="form-control" placeholder="ZNV-xxx">

                            <label for=""><b>Gambar</b></label>
                            <input type="file" name="gambar" class="form-control" placeholder="">

                            <label for=""><b>stok</b></label>
                            <input type="number" name="stock" class="form-control" placeholder="">

                            <label><b>Kategori</b></label>
                            <select name="category_id" class="form-control">
                                <option value="">--KATEGORI--</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ isset($product) && $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            <label for=""><b>Harga Cash</b></label>
                            <input type="text" name="cash_price" class="form-control" placeholder="Rp.xxx">

                            <label for=""><b>Harga Kredit</b></label>
                            <input type="text" name="credit_price" class="form-control" placeholder="Rp.xxx">
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
