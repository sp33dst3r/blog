@extends('layouts.app')

@section('title', 'Post')

<h1>Post</h1>
<a href="/categories/view/{{$category_id}}" type="button" class="btn btn-primary">Back</a>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="" enctype="multipart/form-data" method="post">
    @csrf
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name"  name="name" value="{{@$post->name}}" placeholder="Name">
    </div>
    <div class="form-group">
        <label for="desc">Content</label>
        <textarea name="content" class="form-control" id="desc" placeholder="Description" >{{@$post->content}}</textarea>
    </div>
    @if (isset($file))
       <a href="{{$file}}">{{$post->file}}</a>

    @endif
    <div class="form-group">
        <label for="desc">File</label>
        <input type="file" class="form-control" name="file" />
    </div>


    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

@section('content')



@endsection
