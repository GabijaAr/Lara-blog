@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/posts/create" class="btn btn-outline-secondary mb-2">Create Post</a>
                    <h3>Your Blog Posts</h3>
                    @if($posts->count() > 0)
                    <table class="table table-striped">
                        <tr>
                            <th>Title</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$post->title}}</td>
                                <td><a href="/posts/{{$post->id}}/edit" class="btn btn-outline-secondary">Edit</a></td>
                                <td>
                                    <form method="POST" action="{{route('post.destroy', [$post])}}">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-success float-right">Delete</button>
                                    </form> 
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    @else
                    <p> You have no posts yet <p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
