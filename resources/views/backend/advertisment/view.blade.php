@extends('adminlte::page')

@section('title', 'Product Manager')

@section('content_header')
    <h1>Category Manager</h1>
    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
@stop

@section('content')
    <div class="form-group">
        <label for="title">Title</label>
        <p for="title">{{ isset($category) ? $category->title : "-" }}</p>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <p for="title">{{  isset($category) ? $category->description : "-" }}</p>
    </div>
    <a href="/admin/categories">
        <button type="button" class="btn btn-info">Back</button>
    </a>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop