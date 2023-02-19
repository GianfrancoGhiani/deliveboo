@extends('layouts.admin')

@section('content')

<section id="indexOrder" class="card bg-dark-light">
    
    {{-- <div class="text-end py-2">
            <a class="btn btn-success border border-1 " href="{{route('admin.products.create')}}">Add a Product</a>
    </div> --}}
        @if(session()->has('message'))
        <div class="alert alert-success mb-3 mt-3">
            {{ session()->get('message') }}
        </div>
        @endif
        <div class="card-header">
            <h1 class="">Orders</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.orders.index') }}" method="GET" class="d-flex">
                <h4>Choose the date: </h4>
                <div class="ms-5">
                    <input class="rounded-2" type="date" name="dateSelect" id="dateSelect" value="{{date("Y-m-d")}}">
                    <button type="submit" class="btn btn-outline-light rounded-2">Find</button>
                    <a href="{{route('admin.orders.index')}}" class="rounded-2 btn  btn-outline-light">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                </div>
            </form>
          
            <table class="table bg-dark-light">
                <thead>
                <tr class="text-center">
                    <th scope="col"></th>
                    <th scope="col" class="text-capitalize text-center">
                        <div class="d-flex justify-content-center align-items-center ">
                            <span>date</span>
                            <span class="d-flex ms-1">
                                <form action="{{ route('admin.orders.index') }}" method="GET">
                                    <input type="text" hidden name="dateOrder" id="dateOrder" value="ASC">
                                    <button class="btn order" type="submit"><i class="fas fa-arrow-down"></i></button>
                                </form>
                                <form action="{{ route('admin.orders.index') }}" method="GET">
                                    <input type="text" hidden name="dateOrder" id="dateOrder" value="DESC">
                                    <button class="btn order" type="submit"><i class="fas fa-arrow-up"></i></button>
                                </form>
                            </span>
                        </div>
                    </th>
                    <th scope="col" class="text-capitalize text-center">time</th>
                    <th scope="col" class="text-capitalize">firstname</th>
                    <th scope="col" class="text-capitalize">lastname</th>
                    <th scope="col" class="text-capitalize">email</th>
                    <th scope="col" class="text-capitalize text-center">paid</th>
                    <th scope="col" class="text-capitalize" class="text-center ">tel</th>
                    <th scope="col" class="text-capitalize">price</th>
                    <th scope="col" class="text-capitalize">description</th>
                </tr>
                </thead>
                <tbody class="text-white">
                @foreach($orders as $order)
                        <tr>
                            <a href="{{route('admin.orders.show', $order->id)}}">
                            {{-- # --}}
                            <th scope="row"><a href="{{route('admin.orders.show', $order->id)}}">View</a></th>
                            {{-- date --}}
                            <td style="width: 15rem" class="text-center">
                                {{date('F d, Y', strtotime($order->updated_at)) }}
                            </td>
                            {{-- hour --}}
                            <td style="width: 15rem" class="text-center">
                                {{date('h:i A', strtotime($order->updated_at)) }}
                            </td>
                            {{-- firstname --}}
                            <td style="width: 13rem">
                                {{-- <a href="{{route('admin.orders.show', $order->id)}}" class="text-white text-decoration-none" title="View Product"> --}}
                                {{$order->customer_firstname}}
                                {{-- </a> --}}
                            </td>
                            {{-- lastname --}}
                            <td style="width: 13rem">{{$order->customer_lastname}}</td>
                            {{-- email --}}
                            <td>
                                {{$order->customer_email}}
                                {{-- <img src="{{asset('storage/' . $product->image_url)}}" alt="" class="w-100"> --}}
                            </td>
                            {{-- paid --}}
                            <td style="width: 10rem" class="text-center ">
                                {{$order->paid ? 'paid' : 'not paid'}}
                            </td>
                            {{-- price --}}
                            <td class="text-end">
                                {{$order->customer_tel}}
                            </td>
                            {{-- edit --}}
                            <td>
                                {{$order->price}}
                                {{-- <a class="btn btn-info" href="{{route('admin.products.edit', $product->slug)}}" title="Edit Product"><i class="fa-solid fa-pen-ruler"></i></a> --}}
                            </td>
                            {{-- descrizione tagliata a 50 caratteri --}}
                            <td style="width: 25rem">
                                {{(strlen($order->description) > 13) ? substr($order->description,0,50).'...' : $order->description;}}
                            </td>
                            </a>
                        </tr>
                        @endforeach
                </tbody>
            </table>
            {{-- {{ $orders->links('vendor.pagination.bootstrap-5') }} --}}
        </div>  
    
</section>

@endsection