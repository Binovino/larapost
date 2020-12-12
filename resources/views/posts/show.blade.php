@extends('layouts.app')
@section('content')
        <a href="/posts" class="btn btn-primary mb-3">Go Back</a>
        <h2> {{$post->title}} </h2>
        <img style="width:100%" src="/storage/uploads/{{$post->uploads}}">
        <br>
        <br>
    
    <div>
        {{-- {{$post->body}} --}}
        {{-- Use to scrape html tags in viewing the post/also known as Parsing Html  --}}
        {!!$post->body!!}
    </div>
    <hr>
    {{-- <small>Written on {{$post->created_at}} by {{$post->user['name']}}</small> --}}
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <hr>
    {{-- @if(!Auth::guest()) --}}
   
        {{-- @if(Auth::user()->id == $post->user_id) --}}
        @can('manage-posts')
            <a href="/posts/{{$post->id}}/edit" class="btn btn-secondary">Edit</a>
            
            {!!Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endcan
        {{-- @endif --}}
        
        
    {{-- @endif --}}
    
@endsection