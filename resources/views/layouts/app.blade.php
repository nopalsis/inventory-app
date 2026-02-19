@include('layouts.head')

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
