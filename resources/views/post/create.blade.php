@extends('layouts.app')

@section('content')  
<h1>Create Post</h1>
<form method="POST" action="{{route('post.store')}}">
    <div class="form-group">
        Title: <input type="text" name="post_title" value="{{old('post_title')}}" placeholder="Title" class="form-control">
    </div>
    <div class="form-group">
        Body: <textarea id="summernote" name="post_body"  value="{{old('post_body')}}" placeholder="Body Text" class="form-control"></textarea>
    </div>    
        @csrf
        <button type="submit" class="btn btn-outline-secondary">ADD</button>
 </form>
 <script>
    $(document).ready(function() {
       $('#summernote').summernote();
     });
</script>
@endsection