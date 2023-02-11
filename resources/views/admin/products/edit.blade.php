@extends('layouts.admin')

@section('content')

@include('partials.admin.error-session')

       
@section('content')
    <section id="editProduct" class="container-fluid">
        <form action="{{ route('admin.products.update', $product->slug) }}" method="POST" enctype="multipart/form-data" >
        @csrf
        @method('PUT')
            <div class="row justify-content-sm-center justify-content-md-start">
                <div class="col-lg-8 col-md-10 row offset-lg-2 offset-md-1 bg-dark-light card p-3 ">
                    <div class="col-12 row py-3 align-items-center">
                        <h1>Editing: {{ $product->name }}</h1>
                    </div>
                    <div class="col-12 row row-cols-lg-2 row-cols-sm-1">
                        <div class="col">

                            {{-- product name --}}
                            <div class="pb-3">
                                <label for="name" class="form-label">Product Name<sup title="This field is required">*</sup></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name', $product->name)}}" oninvalid="this.setCustomValidity('This field is required')" required >
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- price --}}
                            <div class="pb-3">
                                <label for="price" class="form-label">Price<sup title="This field is required">*</sup></label>
                                <input type="number" step="0.01" min="0" max="99,99" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{old('price', $product->price)}}" oninvalid="this.setCustomValidity('This field is required')" required  >
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- discount --}}
                            <div class="pb-3">
                                <label for="discount" class="form-label">Discount</label>
                                <input type="number" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" placeholder="0" value="{{old('discount', $product->discount)}}" oninvalid="this.setCustomValidity('This field is required')" >
                                @error('discount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- ingredients --}}
                            <div class="pb-3">
                                <label for="ingredients" class="form-label">Ingredients<sup title="This field is required">*</sup></label>
                                <textarea name="ingredients" id="ingredients" rows="5" class="form-control @error('ingredients') is-invalid @enderror"oninvalid="this.setCustomValidity('This field is required')">{{old('ingredients', $product->ingredients)}}</textarea>
                                @error('ingredients')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">

                            {{-- available --}}
                            <div class="pb-3">
                                <label for="available" class="form-label">Available<sup title="This field is required">*</sup></label>
                                <input id="available-yes" type="radio" name="available" value="1" {{old('available', $product->available) == 1 ? 'checked' : ''}}>
                                <label for="available-yes" class="text-capitalize">yes</label>
                                <input id="available-no" type="radio" name="available" value="0" {{old('available', $product->available) == 0 ? 'checked' : ''}}>
                                <label for="available-no" class="text-capitalize">no</label>
                                @error('available')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- image --}}
                            <div class="pb-3">
                                <div for="image_url" class="form-label">Image<sup title="This field is required">*</sup></div>
                    
                    
                                <input type="file" name="image_url" id="input_file_img" class="form-control my-3 @error('image_url') is-invalid @enderror">
                                <img id="uploadPreview" class="col-12" data-image="{{$product->image_url}}" src="{{ $product->image_url ? asset('storage/'.old('image_url', $product->image_url)) : 'https://via.placeholder.com/300x200'}}">
                                @error('image_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- buttons submit and reset --}}
                    <div class="d-flex gap-1 justify-content-end">
                        <a class="btn btn-primary back" href="{{route('admin.products.index')}}" title="Go back to Products"><i class="fa-solid fa-rotate-left"></i></a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button id="reset_button" type="reset" class="btn btn-secondary" >Reset</button>
                    </div>
                </div>
            </div>
        </form>
    </section>

@endsection
