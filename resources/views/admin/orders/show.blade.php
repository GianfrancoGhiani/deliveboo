@extends('layouts.admin')

@section('content')
    <section class="container my-5" id="showOrder">
        <div class="row bg-dark-light p-3">
            <div class="col-8 position-relative">
                <div class="row col-12">
                    <div class="row">
                        <div class="col-12 ">
                            <h1 class="mb-2">{{$order->name}}</h1>
                            <div class="mb-2 d-flex align-items-baseline">
                                
                                <div>
                                    <h3>Customer Data</h3>
                                    {{$order->customer_firstname}} <br>
                                    {{$order->customer_lastname}} <br>
                                    {{$order->customer_email}} <br>
                                    {{$order->customer_tel}} <br>
                                    {{$order->customer_address}} <br>
                                    {{$order->customer_lastname}} <br>
                                    {{$order->price}} <br>
                                    {{$order->paid}} <br>
                                    {{$order->description}} <br>
                                </div>
                                <hr>
                                <div>
                                    <h3>Product List:</h3>
                                    @foreach ($order->products as $product)
                                        {{$product->name}} <br>
                                    @endforeach
                                </div>


                            </div>
                            {{-- <div class="mt-5">
                                <h4 class="bolding">Ingredients: <hr></h4>
                                <div class="mt-2 text-capitalize">
                                    {{$product->ingredients}}
                                </div>
                            </div>
                            <div class="edit d-flex justify-content-end">
                                <form action="{{route('admin.products.edit', $product->slug)}}" method="get">
                                    @csrf
                                    <button type="submit" class="btn btn-primary mx-3">Edit</button>
                                </form>
                                <form action="{{route('admin.products.destroy',['product'=>$product->slug])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-secondary dng delete-button">DELETE</button>
                                </form>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                {{-- @if($product->image_url)
                    <img class="w-100 shadow rounded-2" src="{{asset('storage/'.$product->image_url)}}" alt="{{ $product->name }}">
                @else
                    <img class="w-100 shadow rounded-2" src="https://dummyimage.com/1200x840/000/fff" alt="C/O https://dummyimage.com/">
                @endif --}}
            </div>
            
        </div>
        
    </section>
@endsection
