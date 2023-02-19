<nav id="sidebarMenu">
    <a href="{{route('admin.dashboard')}}" class="nav-link text-white" >
        <h2 class="p-2" style="height: 4.5rem"><img src="{{asset('/Deliveboo-logo-white.png')}}" alt="" class="h-100"></h2>
    </a>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.dashboard' ? 'active-item' : '' }}" href="{{route('admin.dashboard')}}">
            <i class="fa-solid fa-tachometer-alt fa-lg fa-fw"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'admin.products.index' ? 'active-item' : '' }}" href="{{route('admin.products.index')}}">
                <i class="fa-solid fa-newspaper fa-lg fa-fw"></i> Products
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'admin.orders.index' ? 'active-item' : '' }}" href="{{route('admin.orders.index')}}">
                <i class="fa-solid fa-newspaper fa-lg fa-fw"></i> Orders
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'admin.stats' ? 'active-item' : '' }}" href="{{route('admin.stats')}}">
                <i class="fa-solid fa-newspaper fa-lg fa-fw"></i> Stats
            </a>
        </li>

    </ul>
</nav>