<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use Gate;



class PostsController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(5);
        return view('posts.index',compact('posts'))->with('post', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this -> validate($request, [
            'title' => 'required', 
            'body' => 'required', 
            'uploads' => 'image|nullable|max:1999'
        ]);

        if($request -> hasFile('uploads')){

            //get filename with extension
            $filenamewithextension = $request->file('uploads')->getClientOriginalName();
      
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
      
            //get file extension
            $extension = $request->file('uploads')->getClientOriginalExtension();
      
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
      
            //Upload File
            $path = $request->file('uploads')->storeAs('public/uploads', $filenametostore);
 
        } else {
            $filenametostore = 'noimage.jpg';
        }

        //Create Post
        $post = new Post;        
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->uploads = $filenametostore;
        $post->save();
        
        return redirect('/posts') -> with ('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if($post){
            return view('posts.show') -> with ('post', $post);
        } else {
            return redirect('/posts') -> with ('error', 'No Posts Found!');
        } 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        // check for correct user
        // if(auth()->user()->id !== $post->user_id){
        //     return redirect('/posts') -> with ('error', 'Unauthorized Page');
        // }
        if($post){
            return view('posts.edit') -> with ('post', $post);
        } else {
            return redirect('/posts') -> with ('error', 'No Posts Found!');
        }   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validation of inputs
        $this -> validate($request, 
        ['title' => 'required', 'body' => 'required']);

        // Handle File Upload
        if($request -> hasFile('uploads')){

            //get filename with extension
            $filenamewithextension = $request->file('uploads')->getClientOriginalName();
      
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
      
            //get file extension
            $extension = $request->file('uploads')->getClientOriginalExtension();
      
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
      
            //Upload File
            $path = $request->file('uploads')->storeAs('public/uploads', $filenametostore);
        } 
        
        //Create Post
        
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request -> hasFile('uploads')){
            $post->uploads = $filenametostore;
        }
        $post->save();
       
        return redirect('/posts') -> with ('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        
        $post = Post::find($id);

        // check for correct user
        // if(auth()->user()->id !== $post->user_id){
        //     return redirect('/posts') -> with ('error', 'Unauthorized Page');
        // }
        
        if($post->uploads != 'noimage.jpg'){
            // Delete Image
            Storage::delete('public/uploads/'.$post->uploads);
        }

        $post -> delete();
        return redirect('/posts') -> with ('success', 'Post removed successfully');
    }

}
 

