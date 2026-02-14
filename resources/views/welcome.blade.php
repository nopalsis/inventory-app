<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory Barang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            overflow-x: hidden;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
        }

        .sidebar .nav-link {
            color: #ffffff;
        }

        .sidebar .nav-link:hover {
            background-color: #495057;
        }

        .sidebar .active {
            background-color: #0d6efd;
        }

        .content {
            min-height: 100vh;
        }

        footer {
            background-color: #212529;
            color: white;
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Inventory App</a>

            <div class="d-flex">
                <span class="text-white me-3">Admin</span>
                <a href="#" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">

            <!-- SIDEBAR -->
            <div class="col-md-2 sidebar p-3">
                <h5 class="text-white">MENU</h5>
                <hr class="text-white">

                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link active">Dashboard</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link">Users</a>
                    </li>
                </ul>
            </div>

            <!-- CONTENT -->
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
                                <h5>Total Supplier</h5>
                                <h3>15</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5>Transaksi Hari Ini</h5>
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

        </div>
    </div>

    <!-- FOOTER -->
    <footer class="text-center py-3">
        <small>© {{ date('Y') }} Inventory Barang - All Rights Reserved</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
