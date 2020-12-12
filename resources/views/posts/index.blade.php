@extends('layouts.app')
@section('content')
        <h1> Posts </h1>
        @if (count($posts) > 0)
            @foreach ($posts as $post)
                <div class="card card-body mb-2">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <img style="width:100%" src="/storage/uploads/{{$post->uploads}}">
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                            {{-- <small>Written on {{$post->created_at}} by {{$post->user->name}}</small> --}}
                            <small>Written on {{$post->created_at}} by {{ !empty($post->user) ? $post->user->name : ''}}</small>
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- this is connected to pagination//optional argument because i already set it in the AppServiceProvider --}}
            {{$posts->links('pagination::bootstrap-4')}}
        @else 
            <p> Sorry, no posts available. </p>
        @endif
@endsection