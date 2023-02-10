@extends('layouts.admin')

@section('content')
    <section  id="showOrder"  class="container-fluid">
        {{-- <div class="my-5"> --}}
            <div class="row justify-content-sm-center justify-content-md-start my-5">
                <div class="col-lg-8 col-sm-12 col-md-10 offset-lg-2 offset-md-1 bg-dark-light card p-sm-2 p-md-4 flex-row row ">
                    <div class="mb-2">
                        <div>
                            <h2>Customer Data</h2>
                            <div><span  class="subtitle" >Date: </span><span class="important">{{date('F d, Y', strtotime($order->updated_at)) }}</span> </div>
                            <div><span  class="subtitle" >Time:</span> {{date('h:i A', strtotime($order->updated_at)) }} </div>
                            <div><span  class="subtitle" >Name:</span> <span>{{$order->customer_firstname}}</span> </div>
                            <div><span  class="subtitle" >Surname:</span> {{$order->customer_lastname}} </div>
                            <div><span  class="subtitle" >Email:</span> <span class="important">{{$order->customer_email}}</span> </div>
                            <div><span  class="subtitle" >Phone:</span> <span class="important">{{$order->customer_tel}}</span> </div>
                            <div><span  class="subtitle" >Address:</span> {{$order->customer_address}} </div>
                            <div><span  class="subtitle" >Total Price:</span> ${{$order->price}} </div>
                            <div><span  class="subtitle" >Status:</span> <span class="important">{{ $order->paid ? 'Completed' : 'Failed'}}</span> </div>
                            <div><span  class="subtitle" >Description:</span> {{$order->description}} </div>
                        </div>
                        <hr>
                        <div>
                            <h2>Product List:</h2>
            
                            @foreach ($order->products as $key=>$value)
                                <div class="subtitle">Product Num {{$key + 1}} x {{$value->pivot->quantity}}: <span class="important">{{$value->name}}</span> </div>
                            @endforeach
                        </div>
                        <hr>
                        <div>
                            <a class="btn btn-primary" href="{{route('admin.orders.index')}}">Go to the Orders List</a>
                        </div>
                    </div>
                </div>
            
            
            
            </div>
        {{-- </div> --}}
        
    </section>
@endsection
