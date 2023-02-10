<header id="header" class="container-md-fluid">
    <nav class="navbar navbar-expand navbar-dark bg-dark align-items-center">
        <div class="collapse navbar-collapse justify-content-end align-items-center pe-5" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown me-3">
                <a class="dropdown-toggle text-capitalize d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <i class="fa-brands fa-github me-2"></i>
                <div>{{ Auth::user()->name }}</div>
                </a>

                <div class="dropdown-menu bg-dark-light" aria-labelledby="dropdownMenu2">
                    <a class="dropdown-item" href="{{ url('admin') }}">Dashboard</a>
                    <a class="dropdown-item" href="{{ url('admin/products') }}">Products</a>
                    <a class="dropdown-item" href="{{ url('admin/orders') }}">Orders</a>

                </div>
            </li>
            <li class="nav-item">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
                </form>
            </li>
          </ul>
        </div>
      </nav>
</header>
