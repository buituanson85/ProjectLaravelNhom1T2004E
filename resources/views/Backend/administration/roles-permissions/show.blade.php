@extends('layouts.Backend.base')
@section('title', 'Create Role')
@section('content')


    <section style="padding: 30px 0;">
        <div class="container-fluid">
            <div class="row">
                <ul class="float-left">
                    <li style="float: left;list-style: none"><a class="longin-a" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li style="float: left; margin: 0 10px;list-style: none">/</li>
                    <li style="float: left;list-style: none"><a class="longin-a" href="{{ route('roles-permissions.index') }}">Roles</a></li>
                    <li style="float: left; margin: 0 10px;list-style: none">/</li>
                    <li style="float: left;list-style: none"><a class="longin-a" href="{{ route('roles-permissions.create') }}">Add Roles</a></li>
                </ul>
            </div>
            <hr>
            <div class="row pt-5">
                <div class="col-md-10 offset-md-1">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create new Roles</h3>
                            <div class="card-tools">
                                <a href="{{ route('roles-permissions.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> See all Add Roles</a>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('roles-permissions.store') }}">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ $role->id }}">

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Roles Name</label>
                                    <input type="text" name="name"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $role->name }}" readonly required placeholder="Roles Name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    @foreach ($permissions as $permission)

                                        <div class="checkbox">
                                            <label>
                                                {{ ucfirst($permission->name) }}
                                            </label>
                                            <input
                                                @foreach($role->permissions as $key)
                                                @if($key->name == $permission->name)
                                                checked="checked"
                                                @else

                                                @endif
                                                @endforeach
                                                type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                                            <br>
                                        </div>

                                    @endforeach
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Add Role</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection




