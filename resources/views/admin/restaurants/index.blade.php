@extends('layouts.admin')

@section('content')

<h1 class="">Products</h1>
<div class="text-end py-2">
        <a class="btn btn-success border border-1 " href="{{route('admin.products.create')}}">Add a Product</a>
</div>
    @if(session()->has('message'))
    <div class="alert alert-success mb-3 mt-3">
        {{ session()->get('message') }}
    </div>
    @endif
    <table class="table bg-dark-light">
        <thead>
        <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">Product</th>
            <th scope="col">Ingredients</th>
            <th scope="col">Preview</th>
            <th scope="col">Category</th>
            <th scope="col">Price</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody class="text-white">
        @foreach($products as $product)
                <tr>
                    {{-- # --}}
                    <th scope="row">{{$product->id}}</th>

                    {{-- prodotto --}}
                    <td><a href="{{route('admin.products.show', $product->slug)}}" class="text-white text-decoration-none" title="View Product">{{$product->name}}</a></td>

                    {{-- ingredienti --}}
                    <td style="width: 30rem">{{$product->ingredients}}</td>

                    {{-- preview --}}
                    <td style="width: 5rem"><img src="{{asset('storage/' . $product->image_url)}}" alt="" class="w-100"></td>

                    {{-- category --}}
                    <td class="text-end">{{$product->category ? $product->category->name : 'Without category'}}</td>

                    {{-- price --}}
                    <td class="text-end">€ {{$product?->price}}</td>

                    {{-- edit --}}
                    <td>
                        <a class="btn btn-info" href="{{route('admin.products.edit', $product->slug)}}" title="Edit Product"><i class="fa-solid fa-pen-ruler"></i></a>
                    </td>

                    {{-- delete --}}
                    <td> 
                        <form action="{{route('admin.products.destroy', $product->slug)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button btn btn-danger" data-item-title="{{$product->name}}"><i class="fa-solid fa-trash-can"></i></button>
                        </form>
                    </td>

                </tr>
                @endforeach

        </tbody>
    </table>
    
    @include('partials.admin.modal-delete')

@endsection