@extends('layouts.Backend.base')
    @section('title', 'Sửa nhân viên')
@section('content')
    <section style="padding: 30px 0;">
        <div class="container-fluid">
            <div class="row">
                <ul class="float-left">
                    <li style="float: left;list-style: none"><a class="longin-a" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li style="float: left; margin: 0 10px;list-style: none">/</li>
                    <li style="float: left;list-style: none"><a class="longin-a" href="{{ route('users.index') }}">Sửa nhân niên</a></li>
                </ul>
            </div>
            <hr>
            <div class="row pt-5">
                <div class="col-md-10 offset-md-1">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thêm mới nhân viên</h3>
                            <div class="card-tools">
                                <a href="{{ route('users.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> Danh sách nhân viên</a>
                            </div>
                        </div>
                        <form class="form-group pt-3" method="POST" action="{{ route('users.update', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" readonly required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="role" class="col-md-4 col-form-label text-md-right">Roles</label>
                                    <div class="col-md-6">
                                        @foreach ($roles as $role)

                                            <div class="checkbox">
                                                <label>
                                                    {{ ucfirst($role->name) }}
                                                </label>
                                                @if($role->name === "Admin")

                                                @else
                                                <input type="checkbox"
                                                       @foreach($user->roles as $key)
                                                            @if($key->name == $role->name)
                                                                checked="checked"
                                                            @else

                                                            @endif
                                                       @endforeach
                                                       name="roles[]" value="{{ $role->id }}">
                                                @endif
                                                <br>
                                            </div>
                                        @endforeach
                                    </div>
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





