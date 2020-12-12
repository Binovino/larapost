@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-3">
                <div class="pull-left">
                    <h2>Edit User Info</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('admin.users.index') }}"> Back</a>
                </div>
            </div>
        </div>
        {!! Form::model($user, ['method' => 'PATCH','route' => ['admin.users.update', $user->id]]) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Email:</strong>
                        {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="roles"><strong>Role:</strong></label>
                        
                            <div class="form-control">
                                @foreach($roles as $role)
                                <input type="checkbox" name="roles[]" value="{{ $role->id }}" 
                                @if($user->hasRole($role->name)) checked @endif>
                                <label>{{ $role->name }}</label>
                                @endforeach
                            </div>
                        {{-- @endforeach --}}
                        {{-- {!! Form::select('roles[]', $roles, '' , array('class' => 'form-control','multiple')) !!} --}}
                        {{-- {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!} --}}
                        {{-- @foreach($roles as $role)
                        {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
                        @endforeach --}}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection