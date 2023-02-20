@extends('layouts.admin')

@section('content')
<div id="dashboard" class="container">
    <div class="row justify-content-center align-items-center dashboard">
        <div class="col-lg-8 col-md-12">
            <div class="card bg-dark-light">
                <div class="card-header py-4 d-flex justify-content-around">
                    <img src="{{asset('storage/'.$restaurant->image_url)}}" alt="Image"/>
                    <div>
                        <h1 class="orange">{{$restaurant->name}}</h1>
                        <div>Address: <span>{{$restaurant->address}}, New York</span></div>

                        <div>VAT Number: <span>{{$restaurant->piva}}</span></div>
                        <div>Tel: <span>{{$restaurant->tel_num}}</span></div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status')}}
                    </div>
                    @endif
                    <p>Welcome <span class="text-capitalize">{{ Auth::user()->name }}, </span>you have successfully logged in, now you are ready to manage your "{{$restaurant->name}}"</p>
                </div>
            <div>
            <ul class="flex-column dashboard-list">
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'admin.products.index' ? '' : '' }}" href="{{route('admin.products.index')}}">
                        <i class="fa-solid fa-newspaper fa-lg fa-fw"></i> Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'admin.orders.index' ? '' : '' }}" href="{{route('admin.orders.index')}}">
                        <i class="fa-solid fa-newspaper fa-lg fa-fw"></i> Orders
                    </a>
                </li>
            </ul>
            </div>
        </div>
    </div>
    </div>
</div>

@endsection