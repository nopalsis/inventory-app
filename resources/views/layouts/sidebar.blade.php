<div class="sidebar bg-dark text-white p-3 " style="width:250px;">
    
    <div class="mb-4">
        <h5 class="fw-bold">Inventory Admin</h5>
    </div>

    <ul class="nav nav-pills flex-column gap-1">

        <li class="nav-item">
            <a href="/dashboard"
               class="nav-link text-white d-flex align-items-center {{ Request::is('dashboard*') ? 'active bg-primary' : '' }}">
                <i class="fas fa-home me-2"></i>
                Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="/user"
               class="nav-link text-white d-flex align-items-center {{ Request::is('user*') ? 'active bg-primary' : '' }}">
                <i class="fas fa-users me-2"></i>
                Users
            </a>
        </li>

    </ul>
</div>