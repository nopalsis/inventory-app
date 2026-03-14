<nav class="navbar navbar-expand-lg bg-white shadow-sm px-4">

    <div class="container-fluid">

        <span class="fw-semibold fs-5">
            Inventory App
        </span>

        <div class="d-flex align-items-center gap-3">

            <div class="dropdown">
                <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#"
                    data-bs-toggle="dropdown">

                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                        style="width:35px;height:35px;">
                        <i class="fas fa-user"></i>
                    </div>

                    <span class="ms-2 fw-medium">{{ auth()->user()->username }}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                Logout
                            </button>
                        </form>

                    </li>
                </ul>
            </div>

        </div>

    </div>
</nav>
