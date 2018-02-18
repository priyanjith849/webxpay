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
    {{  Form::open(array('url'=>'admin/categories/update/'.$category->id, 'method' => 'post')) }}
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control"  placeholder="Title" value="{{ Input::old('name', isset($category) ? $category->title : null) }}">
        @if ( $errors->has('title') )
            <span class="text-danger">{{ $errors->first('title') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea type="text" name="description" class="form-control"  placeholder="Description">{{ Input::old('description', isset($category) ? $category->description : null) }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    {{ Form::close() }}

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop