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
                <th>Name</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Craete at</th>
                <th>Update at</th>
                <th scope="col"><a href="{{route('brand.create')}}" class="label label-primary">Add
                        new</a></th>
                <th scope="col"><a href="{{route('brand.index')}}" class="label label-default">View
                        all</a></th>
            </tr>
            </thead>
            <tbody>

            @foreach($all_brand as $brand)
                <tr>
                    <td>{{$brand->id}}</td>
                    <td>{{$brand->name}}</td>
                    <td>{{$brand->slug}}</td>
                    <td>{{$brand->status}}</td>
                    <td>{{$brand->created_at}}</td>
                    <td>{{$brand->updated_at}}</td>
                    <td></td>

                    <td>
                        <a class="label label-primary"
                           href="{{route('brand.edit',$brand->id)}}">Edit</a>
                        <a class="label label-danger"
                           onclick="return confirm('Bạn có chắc chắn sẽ xóa?')"
                           href="{{route('brand.delete',$brand->id)}}">Delete</a>
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
            jQuery('#example').DataTable({
                "order": [[3, "desc"]]
            });

        });
    </script>
@endsection
