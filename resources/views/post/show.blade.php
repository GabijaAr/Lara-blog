@extends('layouts.app')

@section('content')
    <div>
        <a href="/posts" class="btn btn-outline-secondary">Go Back</a>
        <a href="/posts" class="btn btn-outline-success float-right">Delete</a>
        <a href="/posts/{{$post->id}}/edit" class="btn btn-outline-secondary float-right mr-3">Edit</a>
        <h1>{{$post->title}}</h1>
        <small>Written on {{$post->created_at}}</small>
        <hr>
            <div>
                {!!$post->body!!}
            </div>
    </div>


@endsection