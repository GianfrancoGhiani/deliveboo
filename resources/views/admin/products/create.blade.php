@extends('layouts.admin')

@section('content')
@if(session()->has('message'))
<div class="alert alert-danger pb-3 mt-3">
    {{ session()->get('message') }}
</div>
@endif

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-4">
        @csrf

            <div class="row bg-dark-light card">
                <div class="card-header">
                    <h1>Create a new Product</h1>
                </div>

                <div class="col-12 row row-cols-2 card-body">

                    <div class="col">
                        <div class="pb-3">
                            <label for="name" class="form-label">Product Name<sup title="This field is required">*</sup></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" oninvalid="this.setCustomValidity('This field is required')" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="pb-3">
                            <label for="price" class="form-label">Price<sup title="This field is required">*</sup></label>
                            <input type="number" step="0.01" min="0" max="99,99" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="0" oninvalid="this.setCustomValidity('This field is required')" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="pb-3">
                            <label for="discount" class="form-label">Discount<sup title="This field is required">*</sup></label>
                            <input type="number" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" placeholder="0" oninvalid="this.setCustomValidity('This field is required')" required>
                            @error('discount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="pb-3">
                            <label for="ingredients" class="form-label">Ingredients<sup title="This field is required">*</sup></label>
                            <textarea name="ingredients" id="ingredients" rows="5" class="form-control @error('ingredients') is-invalid @enderror"oninvalid="this.setCustomValidity('This field is required')" required></textarea>
                            @error('ingredients')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col">
                         <div class="pb-3">
                            <label for="available" class="form-label">Available<sup title="This field is required">*</sup></label>
                            <input type="radio" name="available" value="1" checked id="available-yes">
                            <label for="available-yes" class="text-capitalize">yes</label>
                            <input type="radio" name="available" value="0" id="available-no">
                            <label for="available-no" class="text-capitalize" >no</label>
                            @error('available')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="pb-3">
                            <div for="image_url" class="form-label">Image<sup title="This field is required">*</sup></div>
                        
                        
                            <input type="file" name="image_url" id="input_file_img" class="form-control my-3 @error('image_url') is-invalid @enderror">
                            <img id="uploadPreview" width="300" src="https://via.placeholder.com/300x200">
                            @error('image_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Create</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </div>
                    
                </div>
            </div>

            
        </form>

@endsection
