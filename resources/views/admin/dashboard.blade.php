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
            </div>
        </div>
    </div>
    </div>
</div>

@endsection