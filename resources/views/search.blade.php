@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="d-flex justify-content-center pb-3"><b>Welcome to Johnny's Playground</b></h1>
    <h3 class="d-flex justify-content-center pb-3">Items Available today</h3>
    <div class="row justify-content-center">

    @if(session('success'))
        <div class="alert alert-success d-flex justify-content-center"><b>{{session('success')}}</b></div>
    @endif

    <form class="row form-inline d-flex justify-content-center pb-3" method="POST" action="/search">
    @csrf
        <div class="col-6 d-flex justify-content-center">
            <div class="input-group">
                <input class="form-control" name="search" type="text" placeholder="Search" aria-label="Search">
                <button class="input-group-text btn btn-outline-success" type="submit">Search</button>
                <a href="/" class="input-group-text btn btn-outline-success">View All Items</a>
            </div>
        </div>
    </form>

    @foreach($items as $item)

        <div class="col-md-3 p-3 border">
            <h4 class="d-flex justify-content-center"><b>{{ $item->item_name }}</b></h4>
            <p><img class="w-100" src="{{ $item->img }}"></p>
            @if($item->stock == 0)
                <h4 class="text-danger d-flex justify-content-center">Out of stock</h4>
            @elseif($item->stock > 0)
                <p>Price - ${{ $item->price }}</p>
                <p>In stock - {{ $item->stock }}</p>
                <form method="POST" action="/add">
                @csrf
                    <div class="row pe-3">
                        <span class="col-sm">Quantity:</span>
                        <input class="d-none" name="item_name" value="{{ $item->item_name }}">
                        <input class="col-sm form-control" type="number" name="quantity" value="1" min="1" max="{{ $item->stock }}">
                    </div>
                    <div class="pt-1">
                        <input class="form-control btn btn-primary" type="submit" value="Add to cart">
                    </div>
                </form>
            @endif
        </div>

    @endforeach

    </div>
</div>
@endsection
