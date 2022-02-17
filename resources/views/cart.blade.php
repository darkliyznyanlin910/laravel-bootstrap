@extends('layouts.app')

@section('content')
<h1 class="d-flex justify-content-center"><b>Cart</b></h1>
<div class="d-flex justify-content-center">
<div class="container-sm row">
    @if(session('success'))
        <div class="alert alert-success d-flex justify-content-center"><b>{{session('success')}}</b></div>
    @endif

    @if($check == 0)
        <h3 class="d-flex justify-content-center p-3"><b>Your cart is empty.</b></h3>
        <div class="d-flex justify-content-center">
            <p><a class="btn btn-primary" href="/"><b>{{ __('Home') }}</b></a></p>
        </div>
    @else
    <div class="col-sm-7">

        <?php $items = $cart; 
            foreach($items as $item){
        ?>
        
            <div class="row justify-content-start border">
                <div class="col-md-3 p-3">
                    <h4 class="d-flex justify-content-center"><b>{{ $item['item_name'] }}</b></h4>
                    <p><img class="w-100" src="{{ $item['img'] }}"></p>
                </div>
                <div class="col-md-9 p-3">
                    @if($item['quantity'] > 0)
                        <p>Quantity - {{ $item['quantity'] }} | Price - ${{ $item['price'] - $item['saved']}}</p>
                        <?php
                            $left = $item['stock'] - $item['quantity'];
                        ?>
                        <p><?php if($item['discount'] > 0){?><span class="rounded bg-success p-1 text-white">Discount: {{ $item['discount'] }}% | Saved: ${{ $item['saved'] * $item['quantity'] }}<?php }?></span></p>
                        <p>Total - ${{ $item['item_total'] }}</p>

                        <form method="POST" action="/add">
                        @csrf
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">Add: </span>
                                <input class="d-none" name="id" value="{{ $item['id'] }}">
                                <input class="form-control" type="number" name="quantity" value="1" min="0" max="{{ $left }}">
                                <input class="btn btn-secondary" type="submit" value="Add">
                            </div>
                        </form>

                        <form class="pt-2" method="POST" action="/remove">
                        @csrf
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">Remove: </span>
                                <input class="d-none" name="id" value="{{ $item['id'] }}">
                                <input class="form-control" type="number" name="quantity" value="1" min="0" max="{{ $item['quantity'] }}">
                                <input class="btn btn-secondary" type="submit" value="Remove">
                            </div>
                        </form>
                    @endif
                </div>
            </div>
            <?php } ?>
    </div>
            <div class="col-sm-5 border pt-3">
                <?php if($saved > 0){?><p>Total Saved - ${{ $saved }}</p><?php }?>
                <!-- Discount Module -->
                <p>Total Payable - ${{ $total }}</p>
                <p><a class="d-flex justify-content-center btn btn-primary" href="/checkout"><b>{{ __('Check Out') }}</b></a></p>
                <p><a class="d-flex justify-content-center btn btn-" href="/"><b>{{ __('Home') }}</b></a></p>
            </div>
    @endif
</div>
</div>
@endsection
