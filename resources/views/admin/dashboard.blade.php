@extends('layouts.admin')

@section('content')
<div id="dashboard" class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark-light">
            <div class="text-center pt-4">
                <img src="{{asset('storage/'.$restaurant->image_url)}}" alt="Image" width="200px" />
            <h1 class="orange">{{$restaurant->name}}</h1>
            </div>
                <div class="card-header">
                    
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
            {{-- <li class="nav-item shade-1">
                <a class="nav-link {{ Route::currentRouteName() == 'admin.dashboard' ? '' : '' }}" href="{{route('admin.dashboard')}}">
                <i class="fa-solid fa-tachometer-alt fa-lg fa-fw"></i> Dashboard
                </a>
            </li> --}}
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