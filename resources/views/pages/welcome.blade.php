@extends('layouts.app')
@section('content')
         <div class="jumbotron text-center">
            <h1>Welcome To Larapost</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam totam esse deleniti ab expedita sit eligendi velit provident a, perferendis numquam vitae optio ducimus molestiae doloribus nesciunt sint repudiandae error!</p>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repudiandae quae accusamus consectetur tempore voluptatibus, alias facere error explicabo minima delectus aperiam magni corporis qui numquam, iste maxime suscipit asperiores, voluptatem optio debitis sed non nemo? Quo veniam laboriosam quae id sequi earum ipsam cupiditate quasi! Quidem accusamus reprehenderit facere eos.</p>
            
               @if(Auth::guest())
               <p><a class="btn btn-primary btn-md mr-1" href="/login" role="button">Login</a>  <a class="btn btn-success btn-md ml-1" href="/register" role="button">Register</a></p>
               @else
               <a class="btn btn-primary btn-md" href="/dashboard" role="button">View Dashboard</a>
            @endif
            
         </div>
@endsection