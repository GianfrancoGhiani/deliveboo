@extends('layouts.admin')

@section('content')
@if(session()->has('message'))
<div class="alert alert-danger pb-3 mt-3">
    {{ session()->get('message') }}
</div>
@endif
        <section id="createProduct"  class="container-fluid">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" >
            @csrf
                <div class="row justify-content-sm-center justify-content-md-start">
                    <div class="col-lg-8 col-md-10 col-sm-12 row offset-lg-2 offset-md-1 bg-dark-light card p-3 ">

                        {{-- title --}}
                        <div class="card-header col-sm-12">
                            <h1>Create a new Product</h1>
                        </div>
                        <div class="card-body col-sm-12 row row-cols-lg-2 row-cols-sm-1">
                            <div class="col">

                                {{-- product name --}}
                                <div class="pb-3">
                                    <label for="name" class="form-label">Product Name<sup title="This field is required">*</sup></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- price --}}
                                <div class="pb-3">
                                    <label for="price" class="form-label">Price<sup title="This field is required">*</sup></label>
                                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="0">
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- discount --}}
                                <div class="pb-3">
                                    <label for="discount" class="form-label">Discount</label>
                                    <input type="number" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" placeholder="0">
                                    @error('discount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- ingredients --}}
                                <div class="pb-3">
                                    <label for="ingredients" class="form-label">Ingredients<sup title="This field is required">*</sup></label>
                                    <textarea name="ingredients" id="ingredients" rows="5" class="form-control @error('ingredients') is-invalid @enderror"></textarea>
                                    @error('ingredients')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">

                                {{-- available --}}
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
                                
                                {{-- image --}}
                                <div class="pb-3">
                                    <div for="input_file_img" class="form-label">Image<sup title="This field is required">*</sup></div>
            
            
                                    <input type="file"  name="image_url" id="input_file_img" class="form-control my-3 @error('image_url') is-invalid @enderror">
                                    <img id="uploadPreview" class="col-12" src="https://via.placeholder.com/300x200">
                                    @error('image_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
            
                            </div>
            
                        </div>
                        
                        
                        
                        {{-- <div class="my-dropzone h-25 border border-1 border-light rounded"> Choose sto cazzo di file</div>
                        
                        <script>
                            // Dropzone has been added as a global variable.
                            const dropzone = new Dropzone("div.my-dropzone", { url: "/file/post" });
                        </script> --}}
                        
                        <div class="text-end">
                            <a class="btn btn-primary back" href="{{route('admin.products.index')}}" title="Go back to Products"><i class="fa-solid fa-rotate-left"></i></a>
                            <button type="submit" class="btn btn-primary">Create</button>
                            <button id="reset_button" type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </div>
                </div>
            
            </form>
        </section>

@endsection
