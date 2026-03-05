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
                    <td>Barang Keluar/Masuk</td>
                    <td>Action</td>
                </tr>

                @foreach ($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ asset('storage/' . $product->gambar) }}" width="150"></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->sku }}</td>
                        <td>{{ $product->category->name ?? '-' }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->cash_price }}</td>
                        <td>{{ $product->credit_price }}</td>
                        <td>
                            <div class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <form action="{{ route('product.updateStock') }}" method="POST" class="d-flex gap-1">
                                        @csrf

                                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                                        <input type="number" name="amount" class="form-control form-control-sm"
                                            style="width:70px">

                                        <select name="type" class="form-control form-control-sm" style="width:60px">
                                            <option value="in"><b>Masuk</b></option>
                                            <option value="out"><b>keluar</b></option>
                                        </select>

                                        <button class="btn btn-success btn-sm">OK</button>

                                    </form>
                                </div>
                            </div>
                        </td>
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

                    {{-- EDITMODAL --}}

                    <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1">

                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5>Edit product</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">

                                    <form action="/product/{{ $product->id }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <input type="hidden" name="edit_id" value="{{ $product->id }}">

                                        <div class="form-group">
                                            <label for=""><b>Nama Barang</b></label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Nama Barang..." value="">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for=""><b>SKU</b></label>
                                            <input type="text" name="sku"
                                                class="form-control @error('sku') is-invalid @enderror"
                                                placeholder="ZNV-xxx"
                                                value="{{ isset($product) ? $product->sku : old('sku') }}">
                                            @error('sku')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label><b>Gambar</b></label>

                                            <input type="file" name="gambar"
                                                class="form-control @error('gambar') is-invalid @enderror"
                                                onchange="previewImage(event, {{ $product->id }})">

                                            @error('gambar')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <img id="preview{{ $product->id }}"
                                                src="{{ asset('storage/' . $product->gambar) }}" width="50%"
                                                class="mt-4">
                                        </div>

                                        <div class="form-group">

                                            <label for=""><b>stok</b></label>
                                            <input type="number" name="stock"
                                                class="form-control @error('stock') is-invalid @enderror" placeholder=""
                                                value="{{ isset($product) ? $product->stock : old('stock') }}">
                                            @error('stock')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label><b>Kategori</b></label>
                                            <select name="category_id"
                                                class="form-control @error('category_id') is-invalid @enderror">
                                                <option value="">--KATEGORI--</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ isset($product) && $product->category_id == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">

                                            <label for=""><b>Harga Cash</b></label>
                                            <input type="text" name="cash_price"
                                                class="form-control @error('cash_price') is-invalid @enderror"
                                                placeholder="Rp.xxx"
                                                value="{{ isset($product) ? $product->cash_price : old('cash_price') }}">
                                            @error('cash_price')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for=""><b>Harga Kredit</b></label>
                                            <input type="text" name="credit_price"
                                                class="form-control @error('credit_price') is-invalid @enderror"
                                                placeholder="Rp.xxx"
                                                value="{{ isset($product) ? $product->credit_price : old('credit_price') }}">
                                            @error('credit_price')
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

                    {{-- END EDITMODAL --}}

                    {{-- DELETE MODAL --}}
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
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>

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
                    {{-- END DELETE MODAL --}}
                @endforeach

            </table>
        </div>
    </div>
    <div class="mt-4 d-flex justify-content-end">
        {{ $products->links() }}
    </div>




    <!-- Modal POPUP Create -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/product" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Produk</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for=""><b>Nama Barang</b></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" placeholder="Nama Barang...">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for=""><b>SKU</b></label>
                            <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror"
                                value="{{ old('sku') }}" placeholder="ZNV-xxx">
                            @error('sku')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for=""><b>Gambar</b></label>
                            <input type="file" name="gambar"
                                class="form-control @error('gambar') is-invalid @enderror"
                                onchange="previewImage(event, 'create')">
                            <img id="previewcreate" width="50%" class="mt-4">
                            @error('gambar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for=""><b>stok</b></label>
                            <input type="number" name="stock"
                                class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock') }}"
                                placeholder="">
                            @error('stock')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <label><b>Kategori</b></label>
                            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror"
                                value="{{ old('category_id') }}">
                                <option value="">--KATEGORI--</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ isset($product) && $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for=""><b>Harga Cash</b></label>
                            <input type="text" name="cash_price"
                                class="form-control @error('cash_price') is-invalid @enderror"
                                value="{{ old('cash_price') }}" placeholder="Rp.xxx">
                            @error('cash_price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for=""><b>Harga Kredit</b></label>
                            <input type="text" name="credit_price"
                                class="form-control @error('credit_price') is-invalid @enderror"
                                value="{{ old('credit_price') }}" placeholder="Rp.xxx">
                            @error('credit_price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
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
