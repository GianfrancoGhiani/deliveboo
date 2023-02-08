<nav id="sidebarMenu">
    <a href="/" class="nav-link text-white" >
        <h2 class="p-2"><i class="fa-solid fa-square-rss"></i>Deliveboo</h2>
    </a>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-secondary' : '' }}" href="{{route('admin.dashboard')}}">
            <i class="fa-solid fa-tachometer-alt fa-lg fa-fw"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'admin.products.index' ? 'bg-secondary' : '' }}" href="{{route('admin.products.index')}}">
                <i class="fa-solid fa-newspaper fa-lg fa-fw"></i> Products
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'admin.orders.index' ? '' : '' }}" href="#">
                <i class="fa-solid fa-newspaper fa-lg fa-fw"></i> Orders
            </a>
        </li>

    </ul>
</nav>