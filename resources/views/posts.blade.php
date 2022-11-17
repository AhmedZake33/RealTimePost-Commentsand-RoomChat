@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       Posts
    </div>

    {{-- <div>
        <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('createPost')}}">
        @csrf
        <div class="form-group">
          <label for="exampleInputEmail1">Post</label>
          <textarea name="content" class="form-control" required=""></textarea>
        </div><br />
        <button type="submit" class="btn btn-primary">Add Post</button>
      </form>
    </div>
    <div>
        @foreach ($posts as $post)
            <div style="margin:10px;border:1px solid black;padding:5px">
                <strong>{{$post->content}}</strong><br>
                <span style="color:gray;margin-left:7px">{{$post->created_at->diffForHumans([
                    
                ])}}</span>
                <span style="color:gray;margin-left:7px">Created By {{$post->user->name}}</span>
                <br />
                <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('createComment')}}">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="comment" class="form-control small" required="">
                    </div><br />
                    <input type="hidden" value="{{$post->id}}" name="post_id" class="form-control small" required="">
                    <input type="hidden" value="{{$user->id}}" name="user_id" class="form-control small" required="">
                    <button type="submit" class="btn btn-primary">Add Comment</button>
                </form>
                
                @if(count($post->comments) > 0)
                <h6 style="text-decoration:underline">Comments</h6>
                    @foreach ($post->comments as $comment)
                        <strong>{{$comment->comment}}</strong>
                        <span>Created By {{$comment->user->name}}</span>
                        <br>
                    @endforeach

                @endif
                  
            </div>
        @endforeach 
    </div> --}}

    <post-component :user="{{$user}}"></post-compoent>
</div>
@endsection
