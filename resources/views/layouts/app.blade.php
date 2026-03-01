@include('layouts.head')

<body>

    <div class="d-flex">

        {{-- Sidebar --}}
        @include('layouts.sidebar')

        <div class="flex-grow-1 d-flex flex-column min-vh-100">

            {{-- Navbar --}}
            @include('layouts.navbar')

            {{-- Content --}}
            <main class="p-4 bg-light flex-grow-1">
                @yield('content')
            </main>

            {{-- Footer --}}
            @include('layouts.footer')

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
    
    <script>
        function previewImage(event, id) {
            let reader = new FileReader();

            reader.onload = function() {
                let output = document.getElementById('preview' + id);
                output.src = reader.result;
            }

            reader.readAsDataURL(event.target.files[0]);
        }
    </script>


    @include('sweetalert::alert')
</body>

</html>
