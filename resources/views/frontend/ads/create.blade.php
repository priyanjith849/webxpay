@extends('layouts.app')

@section('title', 'Ads Manager')

@section('content_header')
    <h1>Ads Manager</h1>
    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
@stop

@section('content')
    {{  Form::open(array('url'=>'/ads/store', 'method' => 'post', 'enctype' => 'multipart/form-data')) }}
    <div class="container">
        <div class="row">
        <h2>Add Your Advertisment</h2>
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
            <div class="form-group col-6">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name">
                @if ( $errors->has('name') )
                    <span class="text-danger">{{{ $errors->first('name') }}}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea type="text" name="description" class="form-control" placeholder="Description"></textarea>
            </div>

            <div class="form-group">
                <label for="title">Category</label>
                {!! Form::select('category_id',$allCategories, old('category_id'), ['class'=>'form-control', 'placeholder'=>'Select Category']) !!}
                @if ( $errors->has('category_id') )
                    <span class="text-danger">{{{ $errors->first('category_id') }}}</span>
                @endif
            </div>

            <div class="form-group col-6">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control" placeholder="Email">
                @if ( $errors->has('email') )
                    <span class="text-danger">{{{ $errors->first('email') }}}</span>
                @endif
            </div>
            <div class="form-group col-6">
                <label for="name">Phone</label>
                <input type="text" name="phone" class="form-control" placeholder="Phone">
                @if ( $errors->has('phone') )
                    <span class="text-danger">{{{ $errors->first('phone') }}}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    {{ Form::close() }}

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop