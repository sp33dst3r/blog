@extends('layouts.app')

@section('title', 'Categories')



@section('content')






@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif



<div class="cnt">
    <h1>{{$category->name}}</h1>
    <h6>{{$category->description}}</h6>
    <a href="/categories" type="button" class="btn btn-primary">Back</a>
    <div class="row cnt2">
        <div class="col-md-6">
            <h2>Comments</h2>
            <div id="comments">
                @foreach ($category->comments as $comment)
                    <div class='comment'>
                        <div class='author-name'>{{$comment->author}}</div>
                        <div class='comment-content'>{{$comment->content}}</div>
                    </div>
                @endforeach

            </div>
            <div id="comment-status"></div>
            <form id="addComment">
                @csrf
                <input type="hidden" name="category_id" value="{{$category->id}}">
                <div class="form-group">
                  <label for="name">Author</label>
                  <input type="text" class="form-control" id="name"  name="name" placeholder="Author">
                  <span>example: Michael Jackson</span>
                </div>
                <div class="form-group">
                    <label for="desc">Content</label>
                    <textarea name="content" class="form-control" id="content" placeholder="Description" ></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
        <div class="col-md-6">
            <h1>Posts</h1>
            <a href="/categories/{{$category->id}}/posts/create" type="button" class="btn btn-primary">Create Post</a>
            @forelse ($category->posts as $post)
            <div>
                <a class="entity-name" href="/categories/{{$category->id}}/posts/view/{{$post->id}}">{{ $post->name }}</a>
                <a href="/categories/{{$category->id}}/posts/edit/{{$post->id}}">-Edit-</a>
                <a class="delete" href="/categories/{{$category->id}}/posts/{{$post->id}}/delete">-Delete-</a>
            </div>
            @empty
                <p>No Posts</p>
            @endforelse
        </div>
    </div>
</div>


@endsection
