@extends('adminlte::page')

@section('title', 'Product Manager')

@section('content_header')
    <h1>Product Manager</h1>
    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <div class="pull-right">
                <a href="/admin/products/create"><button type="button" class="btn btn-primary">Create</button></a>
            </div>
        </div>
        <div class="box-body">
            <table id="user-list" class="display responsive nowrap" width="100%">
                <thead>
                <tr>
                    <th class="col-md-3">Name</th>
                    <th class="col-md-3">Description</th>
                    <th class="col-md-3">Code</th>
                    <th class="col-md-3">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr style="height:60px;">
                        <td data-th="Name">{{ $product->name }}</td>
                        <td data-th="Description">{{ $product->description }}</td>
                        <td data-th="Code">{{ $product->code }}</td>
                        <td data-th="Actions">
                            <div class="btn-group">
                                <a href="/admin/products/show/{{ $product->id }}">
                                    <button type="button" class="btn btn-primary">Show</button>
                                </a>
                                <a href="/admin/products/edit/{{ $product->id }}">
                                    <button type="button" class="btn btn-info">Update</button>
                                </a>
                                <a href="/admin/products/delete/{{ $product->id }}">
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