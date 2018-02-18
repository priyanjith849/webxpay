@extends('adminlte::page')

@section('title', 'Ads Manager')

@section('content_header')
    <h1>Advertisment Manager</h1>
    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
@stop

@section('content')
    {{  Form::open(array('url'=>'admin/ads/update/'.$ads->id, 'method' => 'post')) }}
    <div class="form-group">
        <label for="name">Title</label>
        <input type="text" name="name" class="form-control"  placeholder="Title" value="{{ Input::old('name', isset($ads) ? $ads->name : null) }}">
        @if ( $errors->has('name') )
            <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea type="text" name="description" class="form-control"  placeholder="Description">{{ Input::old('description', isset($ads) ? $ads->description : null) }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    {{ Form::close() }}

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop