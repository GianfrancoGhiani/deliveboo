@extends('layouts.admin')

@section('content')

<h1 class="">Orders</h1>
{{-- <div class="text-end py-2">
        <a class="btn btn-success border border-1 " href="{{route('admin.products.create')}}">Add a Product</a>
</div> --}}
    @if(session()->has('message'))
    <div class="alert alert-success mb-3 mt-3">
        {{ session()->get('message') }}
    </div>
    @endif
    <table class="table bg-dark-light">
        <thead>
        <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">firstname</th>
            <th scope="col">lastname</th>
            <th scope="col">email</th>
            <th scope="col">paid</th>
            <th scope="col">tel</th>
            <th scope="col">price</th>
            <th scope="col">description</th>
        </tr>
        </thead>
        <tbody class="text-white">
        @foreach($orders as $order)
                <tr>
                    {{-- # --}}
                    <th scope="row">{{$order->id}}</th>

                    {{-- prodotto --}}
                    <td>
                        <a href="{{route('admin.orders.show', $order->id)}}" class="text-white text-decoration-none" title="View Product">
                        {{$order->customer_firstname}}
                        </a>
                    </td>

                    {{-- ingredienti --}}
                    <td style="width: 30rem">{{$order->customer_lastname}}</td>

                    {{-- preview --}}
                    <td style="width: 5rem">
                        {{$order->customer_email}}
                        {{-- <img src="{{asset('storage/' . $product->image_url)}}" alt="" class="w-100"> --}}
                    </td>

                    {{-- category --}}
                    <td class="text-end">
                        {{$order->paid}}
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

                    {{-- delete --}}
                    <td> 
                        {{$order->description}}
                        {{-- <form action="{{route('admin.products.destroy', $product->slug)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button btn btn-danger" data-item-title="{{$product->name}}"><i class="fa-solid fa-trash-can"></i></button>
                        </form> --}}
                    </td>

                </tr>
                @endforeach

        </tbody>
    </table>
    
    

@endsection