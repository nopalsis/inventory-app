@extends('layouts.app')
@section('content')

<h4>Histori Mutasi Stok</h4>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered text-center align-middle">
            <tr>
                <th>Tanggal</th>
                <th>Produk</th>
                <th>Tipe</th>
                <th>Jumlah</th>
                <th>Note</th>
            </tr>

            @foreach($statements as $statement)
            <tr>
                <td>{{ $statement->created_at }}</td>
                <td>{{ $statement->product->name }}</td>
                <td>
                    @if($statement->type == 'in')
                        <span class="badge bg-success">Masuk</span>
                    @else
                        <span class="badge bg-danger">Keluar</span>
                    @endif
                </td>
                <td>{{ $statement->amount }}</td>
                <td>{{ $statement->note }}</td>
            </tr>
            @endforeach

        </table>

        <div class="mt-3 d-flex justify-content-end">
            {{ $statements->links() }}
        </div>
    </div>
</div>


<form action="{{ route('product-statements.store') }}" method="POST">
    @csrf

    <div>
        <label>Product</label>
        <select name="product_id" required>
            @foreach ($products as $product)
                <option value="{{ $product->id }}">
                    {{ $product->name }} (Stock: {{ $product->stock }})
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Type</label>
        <select name="type" required>
            <option value="in">Stock In</option>
            <option value="out">Stock Out</option>
        </select>
    </div>

    <div>
        <label>Amount</label>
        <input type="number" name="amount" required>
    </div>

    <div>
        <label>Note</label>
        <input type="text" name="note">
    </div>

    <button type="submit">Submit</button>
</form>
@endsection