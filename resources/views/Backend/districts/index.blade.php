@extends('layouts.Backend.base')

@section('title', 'Địa chỉ nhà xe:')
{{--@extends('layouts.Backend.function')--}}
@section('content')



    <!-- Right side column. Contains the navbar and content of the page -->

        <!-- Content Header (Page header) -->
    @include('layouts.Backend.header')
    <section>
        <table id="example" class="display" style="width:100%">
            <thead>
            <tr>
                <th>Id</th>
                <th>District</th>
                <th>City</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Location</th>
                <th>Create at</th>
                <th>Update at</th>
                <th scope="col"><a href="{{route('district.create')}}" class="label label-primary">Add
                        new</a></th>
                <th scope="col"><a href="{{route('district.index')}}" class="label label-default">View
                        all</a></th>
            </tr>
            </thead>
            <tbody>

            @foreach($all_district as $district)
                <tr>
                    <td>{{$district->id}}</td>
                    <td>{{$district->name}}</td>
                    <td>{{$district->product->name}}</td>
                    <td>{{$district->slug}}</td>
                    <td>{{$district->status}}</td>
                    <td>{{$district->location}}</td>
                    <td>{{$district->created_at}}</td>
                    <td>{{$district->updated_at}}</td>
                    <td><a class="label label-primary"
                           href="{{route('district.edit',$district->id)}}">Edit</a></td>

                    <td>

                        <a class="label label-danger"
                           onclick="return confirm('Bạn có chắc chắn sẽ xóa?')"
                           href="{{route('district.delete',$district->id)}}">Delete</a>
                    </td>
                </tr>
            @endforeach

            </tbody>

        </table>
    </section>
@endsection

@section('addjs')
    <script>
        jQuery(document).ready(function () {
            jQuery('#example').DataTable();
        });
    </script>
@endsection
