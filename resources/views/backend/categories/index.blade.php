@extends('adminlte::page')

@section('title', 'Category Manager')

@section('content_header')
    <h1>Category Manager</h1>
    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <div class="pull-right">
                <a href="/admin/categories/create"><button type="button" class="btn btn-primary">Create</button></a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <table id="user-list" class="display responsive nowrap" width="100%">
                        <thead>
                        <tr >
                            <th class="col-md-3">Title</th>
                            <th class="col-md-3">Description</th>
                            <th class="col-md-3">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr style="height:60px;">
                                <td  data-th="Title">{{ $category->title }}</td>
                                <td class="col-md-3" data-th="Description">{{ $category->description }}</td>
                                <td class="col-md-3" data-th="Actions">
                                    <div class="btn-group">
                                        <a href="/admin/categories/show/{{ $category->id }}">
                                            <button type="button" class="btn btn-primary">Show</button>
                                        </a>
                                        <a href="/admin/categories/edit/{{ $category->id }}">
                                            <button type="button" class="btn btn-info">Update</button>
                                        </a>
                                        <a href="/admin/categories/delete/{{ $category->id }}">
                                            <button type="button" class="btn btn-danger">Remove</button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    @stop

@section('js')
    <script>
        $(document).ready(function() {

            $('#user-list').DataTable();
        } );

    </script>
@stop