@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Users Management</h2>
                </div>
                <div class="pull-right">
                    @can('create-users')
                    <a class="btn btn-success" href="{{ route('admin.users.create') }}"> Create New User</a>
                    @endcan
                </div>
            </div>
        </div>
        <table class="table table-bordered">

            <tr>
                <th scope="col">No.</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Roles</th>
                <th scope="col">Actions</th>
            </tr>
            {{-- <tbody> --}}
                @foreach($users as $user)
                    <tr>
                        <td scope="row">{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            
                            {{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}
                            {{-- @foreach($role as $roles)
                            <label class="badge badge-success">{{ $roles }}</label>
                            @endforeach --}}
                        </td>
                        <td>
                            @can('edit-users')
                                <a class="btn btn-info float-left" href="{{ route('admin.users.edit', $user->id) }}">Edit</a>
                            @endcan
                            @can('delete-users')
                                <form action=" {{ route('admin.users.destroy', $user) }} " method="POST" class="ml-1 float-left">
                                    @csrf 
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                
            {{-- </tbody> --}}
           
                   
        </table>
    </div>
@endsection