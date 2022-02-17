@extends('layouts.footer_fixed')

@section('content')
    <div class="container">
        <div class="alert alert-success text-center">
            <p>Transaction completed.</p>
            <p>Thank You for Shopping on Our Website.</p>
        </div>
        <div class="d-flex justify-content-center">
            <a class="btn btn-primary" href="/"><b>{{ __('Home') }}</b></a>
        </div>
    </div>
@endsection

