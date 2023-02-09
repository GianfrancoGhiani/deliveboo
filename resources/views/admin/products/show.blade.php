@extends('layouts.admin')

@section('content')
    <section id="showProduct">
        <div class="row ">
            <div class="card row col-8 offset-2 bg-dark-light p-5 flex-row">
                <div class="col-8 ">
                    <div class="row col-12">
                        <div class="row">
                            <div class="col-12 ">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h1 class="mb-2">{{$product->name}}</h1><a class="btn btn-primary back" href="{{route('admin.products.index')}}" title="Go back to Products"><i class="fa-solid fa-rotate-left"></i></a>
                                </div>
                                <div class="mb-2 d-flex align-items-baseline">
                                    @if ($product->discount)
                                        <h4>Price:</h4>
                                        <h5 class="bolding"><span class="text-decoration-line-through price-through ms-2"> $ {{$product->price}} </span><span class="price-through ms-1">-{{$product->discount}}%</span><span class=" ms-2">$ {{$product->price - (round((($product->price/100)*$product->discount), 2))}}</span></h5>
                                    @else
                                        <h4>Price:</h4>
                                        <h5 class="bolding"><span class="ms-2"> $ {{$product->price}}</span></h5>
                                    @endif
                                </div>
                                <div class="mt-5">
                                    <h4 class="bolding">Ingredients: <hr></h4>
                                    <div class="mt-2 text-capitalize">
                                        {{$product->ingredients}}
                                    </div>
                                </div>
                                <div class="edit d-flex justify-content-end pt-3">
                                    <form action="{{route('admin.products.edit', $product->slug)}}" method="get">
                                        @csrf
                                        <button type="submit" class="btn btn-primary mx-3">Edit</button>
                                    </form>
                                    <form action="{{route('admin.products.destroy',['product'=>$product->slug])}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-secondary dng delete-button">DELETE</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    @if($product->image_url)
                        <img class="w-100 shadow rounded-2" src="{{asset('storage/'.$product->image_url)}}" alt="{{ $product->name }}">
                    @else
                        <img class="w-100 shadow rounded-2" src="https://dummyimage.com/1200x840/000/fff" alt="C/O https://dummyimage.com/">
                    @endif
                </div>
            
            </div>
        </div>
        
    </section>
@endsection
