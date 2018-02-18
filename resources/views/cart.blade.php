@extends('layouts.app')

@section('title', 'Cart')


@section('content')
    @if(session::has('cart'))
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Cart Detail</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <th class="col-xs-3">Name</th>
                            <th class="col-xs-3">Quantity</th>
                            <th class="col-xs-3">Price</th>
                            <th class="col-xs-3"></th>

                            @foreach($products as $key => $product)
                                <tr>
                                    <td><strong>{{ $product['product']['name'] }}</strong></td>
                                    <td><span class="badge">{{ $product['qty'] }}</span></td>
                                    <td><span class="lable ">{{ $product['price'] }}</span></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('removeFromCart', ['id' => $key]) }}"  class="btn btn-danger btn-xs" ><span>Remove</span></a>
                                        </div>
                                    </td>
                                </tr>;
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
            <strong>Total: {{ $totalPrice }}</strong>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
            <button type="button" class="btn btn-success">Checkout</button>
        </div>
    </div>
    @else
        <div class="row">
            <div class="col-sm-6">
                <h2>No item in cart</h2>
            </div>
        </div>
    @endif
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop