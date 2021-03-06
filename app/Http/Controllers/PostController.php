<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class PostController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(5);
       return view('post.index', ['posts' => $posts]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'post_title' => ['required', 'min:3', 'max:64'],
            'post_body' => ['required', 'min:3', 'max:200'],
            'image' => 'image|nullable|max:1999', 
        ],
        [
            'post_title.required' => 'Title is required',
            'post_title.min' => 'The title cannot be shorter than 3 characters',
            'post_title.max' => 'The title cannot be longer than 64 characters',
            'post_body.required' => 'Body text is required',
            'post_body.min' => 'Body text cannot be shorter than 3 characters',
            'post_body.max' => 'Body text cannot be longer than 200 characters'
        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        // Handle File Upload
        if($request->hasFile('image')){
            // Get fileName with extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just fileName
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
        } else{
            $fileNameToStore = 'noimage.jpg';
        }

        $post = new Post;
        $post->title = $request->post_title;
        $post->body = $request->post_body;
        $post->user_id = auth()->user()->id;
        $post->image = $fileNameToStore;
        $post->save();
        return redirect('/posts')->with('success', 'Post Created');        
        
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $posts = Post::all();
        return view('post.show', ['post' => $post, 'posts' => $posts]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $posts = Post::all();
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        return view('post.edit', ['post' => $post, 'posts' => $posts]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(),
        [
            'post_title' => ['required', 'min:3', 'max:64'],
            'post_body' => ['required', 'min:3', 'max:200'],
            'image' => 'image|nullable|max:1999', 
        ],
        [
            'post_title.required' => 'Title is required',
            'post_title.min' => 'The title cannot be shorter than 3 characters',
            'post_title.max' => 'The title cannot be longer than 64 characters',
            'post_body.required' => 'Body text is required',
            'post_body.min' => 'Body text cannot be shorter than 3 characters',
            'post_body.max' => 'Body text cannot be longer than 200 characters'
        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        // Handle File Upload
        if($request->hasFile('image')){
            // Get fileName with extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just fileName
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
        }

        $post->title = $request->post_title;
        $post->body = $request->post_body;
        if($request->hasFile('image')){
            $post->image = $fileNameToStore;
        }
        $post->save();
        return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $posts = Post::all();
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');   
        }

        if($post->image != 'noimage.jpg'){
            // delete image
            Storage::delete('public/images/'.$post->image);
        }
        $post->delete();
        return redirect('/posts')->with('success', 'Post Deleted');   
    }
}
