@extends('layouts.app')

@section('content')
    <div>
        <div>
        <a href="/posts" class="btn btn-outline-secondary float-left">Go Back</a>
        <form method="POST" action="{{route('post.destroy', [$post])}}">
            @csrf
            <button type="submit" class="btn btn-outline-success float-right">Delete</button>
        </form>         
        <a href="/posts/{{$post->id}}/edit" class="btn btn-outline-secondary float-right mr-3">Edit</a>
    </div>
        <h1 class="mt-5">{{$post->title}}</h1>
        <small>Written on {{$post->created_at}}</small>
        <hr>
            <div>
                {!!$post->body!!}
            </div>
    </div>


@endsection