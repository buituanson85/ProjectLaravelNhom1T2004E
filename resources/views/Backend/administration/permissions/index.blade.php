@extends('layouts.Backend.base')
@section('title', 'Permissions')
@section('content')
    <div id="right-panel" class="right-panel">

        <!-- Header-->
    @include('layouts.Backend.header')
    <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title" style="margin-top: 10px">
                        <span style="float: left">Dashboard</span>
                        <span style="float: left;margin: 0 5px">/</span>
                        <span style="float: left"><a href="{{ route('permissions.index') }}">Permissions</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div class="pt-5">
                <div class="col-md-10 offset-md-1">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-4">
                                    <h3 class="card-title">Permission Table</h3>

                                    <div class="card-tools">
                                        <a href="{{ route('permissions.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create new permission</a>
                                    </div>
                                </div>
                                <div class="col-md-8 mt-4">
                                    <form action="{{ route('permissions.index') }}" class="form-horizontal">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                <input type="text" name="name" id="name" value="" placeholder="Permission Name" class="form-control input-md">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <button type="submit" class="btn btn-primary">Search</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">

                            @include('partials.alert')
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>URL</th>
                                    <th>Parent</th>
                                    <th>Date Posted</th>
                                    <th>Edit</th>
                                    <th>Destroy</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $index = $permissions->perPage()*($permissions->currentPage() - 1);
                                @endphp
                                @forelse ($permissions as $permission)
                                    <tr>
                                        <td>
                                            @php
                                                $index++;
                                            @endphp
                                            {{ $index }}
                                        </td>
                                        <td>{{ $permission->name }}</td>
                                        <td>{{ $permission->slug }}</td>
                                        <td>{{ $permission->url }}</td>
                                        <td>
                                            @if($permission->parent == 0)
                                                <span class="badge badge-danger">Parent</span>
                                            @else
                                                <span class="badge badge-success">Child</span>
                                            @endif
                                        </td>
                                        <td>{{ $permission->created_at }}</td>
                                        <td>
                                            <a href="{{ route('permissions.edit', $permission->id) }}"><span class="btn btn-sm btn-warning"><i class="fa fa-edit"></i>&nbsp;Edit</span></a>
                                        </td>
                                        <td>
                                            <form action="{{ route('permissions.destroy', $permission->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>No Result Found</tr>
                                @endforelse
                                </tbody>
                            </table>
                            {!!   $permissions -> render('pagination::bootstrap-4') !!}
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>


    </div><!-- /#right-panel -->

@endsection

