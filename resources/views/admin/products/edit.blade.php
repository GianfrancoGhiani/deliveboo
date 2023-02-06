@extends('layouts.admin')

@section('content')

@include('partials.admin.error-session')

        <h1>Edit Product: {{ $product->name }}</h1>
        @section('content')
            <form action="{{ route('admin.products.update', $product->slug) }}" method="POST" enctype="multipart/form-data" class="p-4">
            @csrf
            @method('PUT')
                <div class="row bg-dark-light">
    
                    <div class="col-6">
    
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome Prodotto</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name', $product->name)}}">
    
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
    
                        <div class="mb-3">
                            <label for="price" class="form-label">Prezzo</label>
                            <input type="number" step="0.01" min="0" max="99,99" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{old('price', $product->price)}}">
    
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
    
                        <div class="mb-3">
                            <label for="discount" class="form-label">Sconto</label>
                            <input type="number" step="0.01" max="90" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" placeholder="0" value="{{old('discount', $product->discount)}}">
    
                            @error('discount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
    
                        <div class="mb-3">
                            <label for="ingredients" class="form-label">Ingredienti</label>
                            <input type="text" class="form-control @error('ingredients') is-invalid @enderror" id="ingredients" name="ingredients" value="{{old('ingredients', $product->ingredients)}}">
    
                            @error('ingredients')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
    
                        <div class="mb-3">
                            <label for="available" class="form-label">Disponibilità</label>
                            <input type="radio" name="available" value="1" {{old('available', $product->available) == 1 ? 'checked' : ''}}>
                            <span class="text-capitalize">si</span>
                            <input type="radio" name="available" value="0" {{old('available', $product->available) == 0 ? 'checked' : ''}}>
                            <span class="text-capitalize">no</span>
                            @error('available')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                       
                        <div class="mb-3">
                            <img id="uploadPreview" width="100" src=" {{ $product->image_url ? asset('storage/'.old('image_url', $product->image_url)) : 'https://via.placeholder.com/300x200'}}">
                            <label for="image_url" class="form-label">Immagine</label>
                      
                            <input type="file" name="image_url" id="create_cover_image" class="form-control mt-3 @error('image_url') is-invalid @enderror" >
    
                            @error('image_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
    
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
    
                
            </form>

@endsection
