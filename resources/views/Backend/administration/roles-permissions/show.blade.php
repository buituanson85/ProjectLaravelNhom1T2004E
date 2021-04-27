@extends('layouts.Backend.base')
@section('title', 'Thêm permissions vào role')
@section('content')


    <section style="padding: 30px 0;">
        <div class="container-fluid">
            <div class="row">
                <ul class="float-left">
                    <li style="float: left;list-style: none"><a class="longin-a" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li style="float: left; margin: 0 10px;list-style: none">/</li>
                    <li style="float: left;list-style: none"><a class="longin-a" href="{{ route('roles-permissions.create') }}">Thêm permissions vào role</a></li>
                </ul>
            </div>
            <hr>
            <div class="row pt-5">
                <div class="col-md-10 offset-md-1">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thêm permission</h3>
                            <div class="card-tools">
                                <a href="{{ route('roles-permissions.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> Danh sách role với permissions</a>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('roles-permissions.store') }}">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ $role->id }}">

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Tên role</label>
                                    <input type="text" name="name"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $role->name }}" readonly required>
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
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Thêm permission</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection




