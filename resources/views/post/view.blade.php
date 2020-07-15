@extends('layouts.app')

@section('title', 'Categories')



@section('content')


<h1>Post</h1>



<a href="/categories/view/{{$post->category_id}}/" type="button" class="btn btn-primary">Back</a>



<div class="cnt">
    <h2>{{$post->name}}</h2>
    <div class="post-content">{{$post->content}}</div>
    <div>
        <h6>File</h6>
        <a download href="{{$file}}">{{$post->file}}</a>
    </div>

    <div class="row cnt2">
        <div class="col-md-12">
            <h2>Comments</h2>
            <div id="comments">
                @foreach ($post->comments as $comment)
                    <div class='comment'>
                        <div class='author-name'>{{$comment->author}}</div>
                        <div class='comment-content'>{{$comment->content}}</div>
                    </div>
                @endforeach

            </div>
            <div id="comment-status"></div>
            <form id="addComment">
                @csrf
                <input type="hidden" name="post_id" value="{{$post->id}}">
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

    </div>
</div>


@endsection
