@extends('layouts.footer_fixed')

@section('content')
<div class="container">
    <h3 class="d-flex justify-content-start pb-3">Manage categories</h3>
    
        @if(session('success'))
        <div class="alert alert-success d-flex justify-content-center"><b>{{session('success')}}</b></div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger d-flex justify-content-center"><b>{{session('error')}}</b></div>
        @endif

    <div class="row justify-content-center">
        <form class="col border" action="/add_new_category_process" method="POST">
        @csrf
            <div class="col input-group pt-3 pb-3">
                <span class="input-group-text" id="basic-addon1">Category to be Added</span>
                <input type="text" class="form-control" name="category" required>
                <input type="submit" class="btn btn-primary" name="upload" value="Add">
            </div>
        </form>
        <form class="col border" action="/remove_category_process" method="POST">
        @csrf
            <div class="col input-group pt-3 pb-3">
                <span class="input-group-text" id="basic-addon1">Category to be Removed</span>
                <select name="category" class="form-select" onchange="selection()" id="select1">
                    <?php $i = 1;
                        foreach($categories as $category){ ?>
                        <option value="{{ $i }}">{{ $category->category_name }}</option>
                    <?php $i++; } ?>
                </select>
                <input type="submit" class="btn btn-primary" name="upload" value="Remove">
            </div>
    </div>
    <div class="d-flex justify-content-center pt-3">
        <a href="/manage_items" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection

