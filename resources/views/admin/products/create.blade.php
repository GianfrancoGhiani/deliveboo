@extends('layouts.admin')

@section('content')
@if(session()->has('message'))
<div class="alert alert-danger mb-3 mt-3">
    {{ session()->get('message') }}
</div>
@endif
    <h1>Creazione prodotto</h1>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-4">
        @csrf

            <div class="row bg-dark-light">
                <h1>Create a new Product</h1>

                <div class="col-6">

                    <div class="mb-3">
                        <label for="name" class="form-label">New Product</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name">

                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" step="0.01" min="0" max="99,99" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="0">

                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="discount" class="form-label">Discount</label>
                        <input type="number" step="0.01" max="90" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" placeholder="0">

                        @error('discount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="ingredients" class="form-label">Ingredients</label>
                        <input type="text" class="form-control @error('ingredients') is-invalid @enderror" id="ingredients" name="ingredients">

                        @error('ingredients')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="available" class="form-label">Available</label>
                        <input type="radio" name="available" value="1" checked id="available-yes">
                        <label for="available-yes" class="text-capitalize">yes</label>
                        <input type="radio" name="available" value="0" id="available-no">
                        <label for="available-no" class="text-capitalize" >no</label>
                        @error('available')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                   
                    <div class="mb-3">
                        <img id="uploadPreview" width="100" src="https://via.placeholder.com/300x200">
                        <label for="image_url" class="form-label">Image</label>
                        <input type="file" name="image_url" id="input_file_img" class="form-control mt-3 @error('image_url') is-invalid @enderror">

                        @error('image_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Create</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>

@endsection
