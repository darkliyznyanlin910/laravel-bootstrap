@extends('layouts.app')

@section('content')
<h1 class="d-flex justify-content-center"><b>Confirm</b></h1>
<div class="d-flex justify-content-center">
<div class="container-sm row">
    @if(\Session::has('error'))
        <div class="alert alert-danger">{{ \Session::get('error') }}</div>
        {{ \Session::forget('error') }}
    @endif
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
            <p><b>Delivery Address</b></p>
            <p>{{ $address['street'] }}</p>
            <p>Block: {{ $address['block'] }} | Unit: {{ $address['unit'] }}</p>
            <p>Postal Code: {{ $address['postal_code'] }}</p>
            <p><b>Please use Sandbox account for paying</b></p>
            <p>Email - sb-5f7wg13507851@personal.example.com</p>
            <p>Password - I_YCP0hW</p>
            <p><a class="d-flex justify-content-center btn btn-primary" href="{{ route('processTransaction') }}">Pay</a></p>
            <p><a class="d-flex justify-content-center btn" href="/checkout"><b>Back to {{ __('Checkout') }}</b></a></p>
            <p><a class="d-flex justify-content-center btn" href="/"><b>{{ __('Home') }}</b></a></p>
        </div>
</div>
</div>
@endsection
