<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <title>Inventory Barang</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        {{-- Bootstrap 5 --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
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
    @include('layouts.navbar')
    
    <div class="container-fluid">
        <div class="row">
            
            <!-- SIDEBAR -->
            @include('layouts.sidebar')
            
            <!-- CONTENT -->
            <div class="col-md-10 p-4">
                
                @yield('content')
                
            </div>
            
            
        </div>
    </div>
    
    <!-- FOOTER -->
    @include('layouts.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

@include('sweetalert::alert')
</body>

</html>
