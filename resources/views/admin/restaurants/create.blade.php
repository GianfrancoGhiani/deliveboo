@extends('layouts.admin')

@section('content')

{{-- 
@if(session()->has('message'))
<div class="alert alert-danger mb-3 mt-3">
    {{ session()->get('message') }}
</div>
@endif --}}


        <form action="{{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data" class="p-4">
        @csrf

            <div class="row bg-dark-light">
                <h1>Create a new Resturant</h1>

                <div class="col-6">

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <div class="d-flex gap-2">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                            
                            <button type="submit" class="btn btn-primary">Create</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            
                        </div>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </form>

@endsection
