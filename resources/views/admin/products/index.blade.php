@extends('layouts.admin')

@section('content')

<h1>products</h1>
<div class="text-end">
        <a class="btn btn-success" href="{{route('admin.products.create')}}">Crea nuovo progetto</a>
</div>
    @if(session()->has('message'))
    <div class="alert alert-success mb-3 mt-3">
        {{ session()->get('message') }}
    </div>
    @endif
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Content</th>
            <th scope="col">Category</th>
            <th scope="col">Tags</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
                <tr>
                    <th scope="row">{{$project->id}}</th>
                    <td><a href="{{route('admin.products.show', $project->slug)}}" title="View Project">{{$project->title}}</a></td>
                    <td>{{Str::limit($project->content,100)}}</td>
                    <td>{{$project->category ? $project->category->name : 'Senza categoria'}}</td>
                    <td>{{$project->tags ? $project->tags : 0}}</td>
                    <td><a class="link-secondary" href="{{route('admin.products.edit', $project->slug)}}" title="Edit Project"><i class="fa-solid fa-pen"></i></a></td>
                    <td> <form action="{{route('admin.products.destroy', $project->slug)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button btn btn-danger ms-3" data-item-title="{{$project->title}}"><i class="fa-solid fa-trash-can"></i></button>
                     </form>
                    </td>
                </tr>
                @endforeach

        </tbody>
    </table>
    
    @include('partials.admin.modal-delete')

@endsection