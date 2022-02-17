@extends('layouts.app')

@section('content')
<h1 class="d-flex justify-content-center"><b>Checkout</b></h1>
<div class="d-flex justify-content-center">
<div class="container-sm row">
    @if($check == 0)
        <h3 class="d-flex justify-content-center p-3"><b>Order Successful</b></h3>
        <div class="d-flex justify-content-center">
            <p><a class="btn btn-primary" href="/"><b>{{ __('Home') }}</b></a></p>
        </div>
    @else
    <div class="col-sm-7">

        <?php $items = $cart; 
            foreach($items as $item){
        ?>
        
            <div class="row justify-content-start border">
                <div class="col-md-4 pt-3 d-flex justify-content-center">
                    <h4 class="d-flex align-items-center"><b>{{ $item['item_name'] }}</b></h4>
                </div>
                <div class="col-md-2 pt-3">
                    <p><img class="w-100" src="{{ $item['img'] }}"></p>
                </div>
                <div class="col-md-6 pt-3 d-flex align-items-center">
                    <div class="box">
                        @if($item['quantity'] > 0)
                            <p>Quantity - {{ $item['quantity'] }} | Price - ${{ $item['price'] - $item['saved']}}</p>
                            <p><?php if($item['discount'] > 0){?><span class="rounded bg-success p-1 text-white">Discount: {{ $item['discount'] }}% | Saved: ${{ $item['saved'] * $item['quantity'] }}<?php }?></span></p>
                            <p>Price - ${{ $item['item_total'] }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <?php } ?>
    </div>
            <div class="col-sm-5 border pt-3">
                <p>Saved: ${{ $saved }}</p>
                <p>Total Payable: ${{ $total }}</p>
                <p><b>Enter your delivery address</b></p>
                @if(\Session::has('address'))
                    <form method="POST" action="/confirm">
                    @csrf
                        <div class="row mb-3">
                            <div class="col-md">
                                <input id="name" type="text" class="form-control" name="street" 
                                value='{{ \Session::get("address")["street"] }}'
                                placeholder="Street" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md">
                                <input type="text" class="form-control" name="block" 
                                value='{{ \Session::get("address")["block"] }}'
                                placeholder="Block" required>
                            </div>
                            <div class="col-md">
                                <input type="text" class="form-control" name="unit" 
                                value='{{ \Session::get("address")["unit"] }}'
                                placeholder="Unit-No." required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md">
                                <input type="text" class="form-control" name="postal_code" 
                                value='{{ \Session::get("address")["postal_code"] }}'
                                placeholder="Postal Code" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md">
                                <input type="submit" class="form-control btn btn-primary" placeholder="Pay" value="Confirm">
                            </div>
                        </div>
                        
                    </form>
                @else
                    <form method="POST" action="/confirm">
                    @csrf
                        <div class="row mb-3">
                            <div class="col-md">
                                <input id="name" type="text" class="form-control" name="street" placeholder="Street" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md">
                                <input type="text" class="form-control" name="block" placeholder="Block" required>
                            </div>
                            <div class="col-md">
                                <input type="text" class="form-control" name="unit" placeholder="Unit-No." required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md">
                                <input type="text" class="form-control" name="postal_code" placeholder="Postal Code" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md">
                                <input type="submit" class="form-control btn btn-primary" placeholder="Pay" value="Confirm">
                            </div>
                        </div>
                        
                    </form>
                @endif
                <p><a class="d-flex justify-content-center btn" href="/cart"><b>Back to {{ __('Cart') }}</b></a></p>
                <p><a class="d-flex justify-content-center btn" href="/"><b>{{ __('Home') }}</b></a></p>
            </div>
    @endif
</div>
</div>
@endsection
