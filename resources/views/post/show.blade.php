@extends('layouts.app')

@section('content')
    <div>
        <div>
        <a href="/posts" class="btn btn-outline-secondary float-left">Go Back</a>
        @if(!Auth::guest())
            @if(Auth::user()->id == $post->user_id)
                <form method="POST" action="{{route('post.destroy', [$post])}}">
                    @csrf
                    <button type="submit" class="btn btn-outline-success float-right">Delete</button>
                </form>         
                <a href="/posts/{{$post->id}}/edit" class="btn btn-outline-secondary float-right mr-3">Edit</a>
            @endif
        @endif
    </div>
        <h1 class="mt-5">{{$post->title}}</h1>
        <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
        <img style="width:100%" src="/storage/images/{{$post->image}}" alt="#">
        <hr>
        <br> <br>

            <div>
                {!!$post->body!!}
            </div>
    </div>


@endsection