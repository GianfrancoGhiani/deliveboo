@extends('layouts.admin')

@section('content')
    {{-- 
@if (session()->has('message'))
<div class="alert alert-danger mb-3 mt-3">
    {{ session()->get('message') }}
</div>
@endif --}}


    <form action="{{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data" class="p-4">
        @csrf

        <div class="row bg-dark-light">
            <h1>Create a new Resturant</h1>

            <div class="col-12">

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <div class="d-flex gap-2">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name">

                    </div>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

                <div class="col-12">

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <div class="d-flex gap-2">
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                                name="address">

                        </div>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">

                    <div class="mb-3">
                        <label for="piva" class="form-label">Vat Number</label>
                        <div class="d-flex gap-2">
                            <input type="text" class="form-control @error('piva') is-invalid @enderror" id="piva"
                                name="piva">

                        </div>
                        @error('piva')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">

                    <div class="mb-3">
                        <label for="opening_time" class="form-label">Opening</label>
                        <div class="d-flex gap-2">
                            <input type="time" class="form-control @error('opening_time') is-invalid @enderror" id="opening_time"
                                name="opening_time">

                        </div>
                        @error('opening_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">

                    <div class="mb-3">
                        <label for="closing_time" class="form-label">Closing</label>
                        <div class="d-flex gap-2">
                            <input type="time" class="form-control @error('closing_time') is-invalid @enderror" id="closing_time"
                                name="closing_time">

                        </div>
                        @error('closing_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">

                    <div class="mb-3">
                        <label for="tel_num" class="form-label">Phone Number</label>
                        <div class="d-flex gap-2">
                            <input type="text" class="form-control @error('tel_num') is-invalid @enderror" id="tel_num"
                                name="tel_num">

                        </div>
                        @error('tel_num')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <img id="uploadPreview" width="100" src="https://via.placeholder.com/300x200">
                    <label for="image_url" class="form-label">Image</label>
                    <input type="file" name="image_url" id="image_url" class="form-control mt-3 @error('image_url') is-invalid @enderror">

                    @error('image_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">

                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <div class="d-flex gap-2">
                            @foreach ($types as $type)
                                <label for="types{{$type->id}}" class="form-check-label">{{$type->name}}</label>
                                <input type="checkbox" class="form-check-input @error('types') is-invalid @enderror" id="types{{$type->id}}"
                                    name="types[]" value="{{$type->id}}">
                            @endforeach
                           
                        </div>
                        @error('types')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
        </div>
    </form>
@endsection
