@extends('layouts.app')

 @section('content')  
<div>
<a href="/posts" class="btn btn-outline-secondary float-left">Go Back</a>
<form method="POST" action="{{route('post.destroy', [$post])}}">
    @csrf
    <button type="submit" class="btn btn-outline-success float-right">Delete</button>
</div>
</form>
<h1 class="mt-2">Edit Post</h1>
<div>
<form method="POST" action="{{route('post.update',[$post->id])}}">
    <div class="form-group">
        Title: <input type="text" name="post_title" value="{{old('post_title', $post->title)}}" placeholder="Title" class="form-control">
    </div>
    <div class="form-group">
        Body: <textarea id="summernote" name="post_body"  placeholder="Body Text" class="form-control"> {{old('post_body', $post->body)}} </textarea>
    </div>    
        @csrf
        <button type="submit" class="btn btn-outline-secondary float-right">EDIT</button>
 </form>
 <script>
    $(document).ready(function() {
       $('#summernote').summernote();
     });
</script>
</div>
@endsection