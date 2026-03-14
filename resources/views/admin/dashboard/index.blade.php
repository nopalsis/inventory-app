@extends('layouts.app')
@section('content')
    
<div class="row">
    <div class="col-md-10">
        <div class="card shadow">
            <div class="card-body bg-primary">
                Selamat Datang <b>{{ auth()->user()->username }}</b> di Halaman Admin ! 😁
            </div>
        </div>
    </div>
</div>

<div class="col-md-10 content p-4">

    <h2 class="mb-4">Dashboard</h2>

    <div class="row">

        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5>Total Barang</h5>
                    <h3>120</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5>Barang Keluar Hari ini</h5>
                    <h3>15</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5>Barang Masuk Hari Ini</h5>
                    <h3>8</h3>
                </div>
            </div>
        </div>

    </div>

    <div class="card mt-4 shadow">
        <div class="card-body">
            <h5>Activity Log</h5>
            <p>Belum ada aktivitas terbaru...</p>
        </div>
    </div>

</div>

@endsection