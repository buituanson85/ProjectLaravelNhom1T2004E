@extends('layouts.Backend.base')

@section('title', 'Thành phố hoạt động:')
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
                <th>City</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Create at</th>
                <th>Update at</th>
                <th scope="col"><a href="{{route('city.create')}}" class="label label-primary">Add
                        new</a></th>
                <th scope="col"><a href="{{route('city.index')}}" class="label label-default">View
                        all</a></th>
            </tr>
            </thead>
            <tbody>

            @foreach($all_city as $city)
                <tr>
                    <td>{{$city->id}}</td>
                    <td>{{$city->name}}</td>

                    <td>{{$city->slug}}</td>
                    <td>{{$city->status}}</td>

                    <td>{{$city->created_at}}</td>
                    <td>{{$city->updated_at}}</td>
                    <td><a class="label label-primary"
                           href="{{route('city.edit',$city->id)}}">Edit</a></td>

                    <td>

                        <a class="label label-danger"
                           onclick="return confirm('Bạn có chắc chắn sẽ xóa?')"
                           href="{{route('city.delete',$city->id)}}">Delete</a>
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
