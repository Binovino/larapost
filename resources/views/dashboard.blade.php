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
                    <a href="/posts/create" class="mb-3 btn btn-primary">Create Post</a>
        
                    <h3>Your Blog Posts</h3>
                    @if(count($posts) > 0)
                        <table class="table">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->title}}</td>
                                    <td></td>
                                    <td>
                                        {!!Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                        {!!Form::close()!!}

                                        <a href="/posts/{{$post->id}}/edit" class="btn btn-secondary float-right mr-2">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else 
                        <p>You have no posts</p>
                    @endif
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
