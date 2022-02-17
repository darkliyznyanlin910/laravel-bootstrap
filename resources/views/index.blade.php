@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="d-flex justify-content-center pb-3"><b>Welcome to Johnny's Playground</b></h1>
    <div class="row justify-content-center">

    @if(session('success'))
        <div class="alert alert-success d-flex justify-content-center"><b>{{session('success')}}</b></div>
    @endif

    <div id="demo" class="carousel slide" data-bs-ride="carousel">

        <!-- Indicators/dots -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
        </div>

        <!-- The slideshow/carousel -->
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="images/slide1.png" class="d-block w-100">
            </div>
            <div class="carousel-item">
            <img src="images/slide2.png" class="d-block w-100">
            </div>
            <div class="carousel-item">
            <img src="images/slide3.png" class="d-block w-100">
            </div>
        </div>

        <!-- Left and right controls/icons -->
        <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <h3 class="d-flex justify-content-center pt-3"><b>Items Available today</b></h3>

    <form class="row form-inline d-flex justify-content-center pb-3" method="POST" action="/search">
    @csrf
        <div class="col-6 d-flex justify-content-center">
            <div class="input-group">
                <input class="form-control" name="search" type="text" placeholder="Search" aria-label="Search">
                <button class="input-group-text btn btn-outline-success" type="submit">Search</button>
            </div>
        </div>
    </form>

    @foreach($items as $item)

        <div class="col-md-3 p-3 border">
            <h4 class="d-flex justify-content-center"><b>{{ $item->item_name }}</b></h4>
            <div class="pb-3"><img class="w-100" src="{{ $item->img }}"></div>
            @if($item->stock == 0)
                <h4 class="text-danger d-flex justify-content-center">Out of stock</h4>
            @elseif($item->stock > 0)
                <?php 
                    $price = $item->price * (1 - ($item->discount / 100)); 
                    $price = round($price, 2, PHP_ROUND_HALF_UP);
                ?>
                <?php if($item->discount == 0){?><p>Price: ${{ $item->price }}</p><?php } ?>
                <?php if($item->discount > 0){?><p>Price: <del>${{ $item->price }}</del> ${{ $price }} <span class="rounded bg-success p-1 text-white">Discount: {{ $item->discount }}%</span></p>
                <?php }?>
                <p>In stock: {{ $item->stock }}</p>
                <form method="POST" action="/add">
                @csrf
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">Quantity</span>
                        <input class="d-none" name="id" value="{{ $item->id }}">
                        <input class="form-control" type="number" name="quantity" value="1" min="1" max="{{ $item->stock }}">
                        <input class="btn btn-primary" type="submit" value="Add to cart">
                    </div>
                </form>
            @endif
        </div>

    @endforeach

    <div class="d-flex justify-content-center pt-3">
        {!! $items->links() !!}
    </div>

    </div>
</div>
@endsection
