@extends('layouts.app')

@section('title', 'Ads')


@section('content')
    <div class="row">
        @foreach($allAds as $ads)
            <div class="col-sm-4 col-md-2">
                <div class="thumbnail">
                    <div class="caption">
                        <h3>{{ $ads->name }}</h3>
                        <p>{{ $ads->description }}</p>
                        <div class="clearfix">
                            
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@stop

@section('css')
@stop

@section('js')

@stop