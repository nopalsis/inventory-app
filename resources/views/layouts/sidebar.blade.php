<div class="col-md-2 sidebar p-3">
    <h5 class="text-white">MENU</h5>
    <hr class="text-white">

    <ul class="nav flex-column">
        <li class="nav-item mb-2">
            <a href="/dashboard" class="nav-link {{ Request::is('dashboard*') ? 'active' : ''}}">Dashboard</a>
        </li>
        <li class="nav-item mb-2 ">
            <a href="/user" class="nav-link {{ Request::is('user*') ? 'active' : ''}}">Users</a>
        </li>
    </ul>
</div>
