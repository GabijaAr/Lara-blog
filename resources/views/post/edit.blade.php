@extends('layouts.app')

@section('content')
<p>Hello </p>

{{-- <form method="POST" action="{{route('post.update',[$post->id])}}">
    Title: <input type="text" name="post_title" value="{{$post->title}}">
    Body: <input type="text" name="post_body" value="{{$post->body}}">
    @csrf
    <button type="submit">EDIT</button>
 </form> --}}
 @endsection