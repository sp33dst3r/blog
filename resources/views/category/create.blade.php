@extends('layouts.app')

@section('title', 'Categories')

<h1>Create category</h1>
<a href="/categories" type="button" class="btn btn-primary">Back</a>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="cnt">
<form class="mt" action="" method="post">
    @csrf
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name"  name="name" value="{{@$category->name}}" placeholder="Name">
    </div>
    <div class="form-group">
        <label for="desc">Description</label>
        <input type="text" class="form-control" id="desc" name="description" value="{{@$category->description}}" placeholder="Description">
    </div>


    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

</div>
@section('content')



@endsection
