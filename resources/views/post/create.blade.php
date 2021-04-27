@extends('layouts.app')

@section('content')
<form method="POST" action="{{route('post.store')}}">
    Title: <input type="text" name="post_title">
    Body: <input type="text" name="post_body">
    @csrf
    <button type="submit">ADD</button>
 </form>
 @endsection