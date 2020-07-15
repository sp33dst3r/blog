@extends('layouts.app')

@section('title', 'Categories')



@section('content')






@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<a href="/categories/create" type="button" class="btn btn-primary">Create</a>

<div class="cnt">
    @forelse ($categories as $category)
        <div>
            <a class="entity-name" href="/categories/view/{{$category->id}}">{{ $category->name }}</a>
            <a href="/categories/edit/{{$category->id}}">-Edit-</a>
            <a class="delete" href="/categories/delete/{{$category->id}}">-delete-</a>
        </div>
    @empty
        <p>No categories</p>
    @endforelse
</div>

@endsection
