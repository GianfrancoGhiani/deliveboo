@extends('layouts.admin')

@section('content')
    <section  id="showOrder">
        <div class="container-fluid my-5">
            <div class="row ">
                <div class="col-8 offset-2 bg-dark-light p-3">
                    <h1 class="mb-2">{{$order->name}}</h1>
                    <div class="mb-2">
            
                        <div>
                            <h3>Customer Data</h3>
                            <div>Date: {{explode(" ",$order->created_at)[0]}} </div>
                            <div>Time: {{explode(" ",$order->created_at)[1]}} </div>
                            <div>Name: {{$order->customer_firstname}} </div>
                            <div>Surname: {{$order->customer_lastname}} </div>
                            <div>Email: {{$order->customer_email}} </div>
                            <div>Phone: {{$order->customer_tel}} </div>
                            <div>Address: {{$order->customer_address}} </div>
                            <div>Total Price: ${{$order->price}} </div>
                            <div>Status: <span>{{ $order->paid ? 'Completed' : 'Failed'}}</span> </div>
                            <div>Description: {{$order->description}} </div>
                        </div>
                        <hr>
                        <div>
                            <h3>Product List:</h3>
            
                            @foreach ($order->products as $key=>$value)
                                <div>Product {{$key + 1}}: {{$value->name}} quantity: {{$value->pivot->quantity}}</div>
                            @endforeach
                        </div>
                        <hr>
                        <div>
                            <a class="btn btn-primary" href="{{route('admin.orders.index')}}">Go to the Orders List</a>
                        </div>
                    </div>
                </div>
            
            
            
            </div>
        </div>
        
    </section>
@endsection
