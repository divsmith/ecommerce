@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h3>Shopping Cart</h3>

            <div class="panel panel-default">
                <div class="panel-body">

                    @if ($products)
                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <strong>Name</strong>
                            </div>
                            <div class="col-md-2">
                                <strong>Quantity</strong>
                            </div>
                            <div class="col-md-2 text-center">
                                <strong>Unit Price</strong>
                            </div>
                            <div class="col-md-1">
                                <strong>Subtotal</strong>
                            </div>
                        </div>

                        @foreach ($products as $product)
                            <hr>
                            <div class="row-item">
                                <div class="row text-align-center">
                                    <div class="col-md-5 col-md-offset-1">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <img style="width:50px;height:50px;" src="/img/{{ $product['image'] }}" alt=""/>
                                            </div>
                                            <div class="col-md-10">
                                                <a href="{{ route('catalogue.show', ['product' => $product['id']]) }}">{{ $product['name'] }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p>{{ $product['count'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        ${{ $product['price'] }}
                                    </div>
                                    <div class="col-md-1">
                                        ${{ $product['price'] * $product['count'] }}
                                    </div>
                                    <div class="col-md-1">
                                        <form action="{{ route('cart.remove', ['product' => $product['id']]) }}" class="form-horizontal" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <hr/>

                        <div class="row">
                            <div class="col-md-1 col-md-offset-1">
                                <form action="{{ route('cart.destroy') }}" class="form-horizontal" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger">Empty Cart <span class="glyphicon glyphicon-trash"></span></button>
                                </form>
                            </div>
                            <div class="col-md-4 col-md-offset-5 text-right">
                                <h4>Grand Total: ${{ $total }}</h4>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <h3 class="text-center">No Products in Cart</h3>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    </div>
@stop