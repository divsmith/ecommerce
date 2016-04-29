@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <img style="width:200px;height:200px;" src="/img/{{ $product->image }}" alt=""/>
            </div>

            <div class="col-md-6">
                <h1>{{ $product->name }}</h1>
                <hr/>
                <p>{{ $product->description }}</p>
            </div>

            <div class="col-md-3">
                <div class="well">
                    <h2 class="text-center">${{ $product->price }}</h2>
                    <hr/>

                    <form action="{{ route('cart.store', ['product' => $product->id]) }}" class="form-horizontal" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <button type="submit" class="btn btn-primary btn-lg">Add to Cart</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop