@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Please select one of our items:</h3>
            <select onchange="location = this.options[this.selectedIndex].value;">
                @foreach ($products as $product)
                    <option value="{{ route('catalogue.show', ['product' => $product->id]) }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        @foreach ($products->chunk(3) as $chunk)
            <div class="row">
                <hr>
                @foreach ($chunk as $product)
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <a href="{{ route('catalogue.show', ['product' => $product->id]) }}"><img style="width:300px;height:200px;" src="/img/{{ $product->image }}" alt=""/></a>
                                <h4><a href="{{ route('catalogue.show', ['product' => $product->id]) }}">{{ $product->name }}</a></h4>
                                <h4>${{ $product->price }}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@stop