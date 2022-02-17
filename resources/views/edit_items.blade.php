@extends('layouts.footer_fixed')

@section('content')
<div class="container">
    <h3 class="d-flex justify-content-start pb-3">Edit {{ $items->item_name }}</h3>
    <div class="row justify-content-center">
        <form class="row" enctype="multipart/form-data" action="/edit_items_process" method="post">
        @csrf
            <input type="text" class="d-none" name="id" value="{{ $items->id }}" required>
            <div class="col-3 w-25">
                <p><img class="w-100" src="{{ $items->img }}"></p>
                <p class="text-center">Current Thumbnail</p>
            </div>
            <div class="col-9">
                <div class="row pt-2">
                    <div class="col input-group">
                        <span class="input-group-text" id="basic-addon1">SKU</span>
                        <input type="text" class="form-control" name="sku" value="{{ $items->sku }}" required>
                    </div>
                    <div class="col input-group">
                        <span class="input-group-text" id="basic-addon1">Item Name</span>
                        <input type="text" class="form-control" name="item_name" value="{{ $items->item_name }}" required>
                    </div>
                </div>
                
                <div class="row pt-2">
                    <div class="col input-group">
                        <span class="input-group-text" id="basic-addon1">Price</span>
                        <input type="text" class="form-control" name="price" value="{{ $items->price }}" required>
                    </div>
                    <div class="col input-group">
                        <span class="input-group-text" id="basic-addon1">Stock</span>
                        <input type="number" class="form-control" name="stock" value="{{ $items->stock }}" required>
                    </div>
                </div>
                <div class="row pt-2">
                    <div class="col input-group">
                        <span class="input-group-text" id="basic-addon1">Category</span>
                        <select name="category" class="form-select" onchange="selection()" id="select1">
                            <option value="{{ $items->category }}">{{ $items->category }}</option>
                            <?php $i = 1;
                                foreach($categories as $category){ ?>
                                <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                            <?php $i++; } ?>
                        </select>
                    </div>
                    <div class="col input-group">
                        <span class="input-group-text" id="basic-addon1">State</span>
                        <select class="form-select" name="state" aria-label="Default select example">
                            <option selected value="{{ $items->state }}">{{ $items->state }}</option>
                            <option value="{{ $state }}">{{ $state }}</option>
                        </select>
                    </div>
                </div>
                <div class="pt-2">
                    <input type="file" class="form-control" name="file">
                </div>
                <div class="row pt-3">
                    <p class="text-center"><b>Discount Settings</b> | Current Effective Discount: {{ $items->discount }}%</p>
                    <div class="col input-group">
                        <span class="input-group-text" id="basic-addon1">Discount Set</span>
                        <input type="number" class="form-control" min="0" max="100" name="discount" value="{{ $items->discount_setting }}" required>
                        <span class="input-group-text" id="basic-addon1">%</span>
                    </div>
                    <script type="text/javascript">
                        $(function() {
                            $('#datepicker1').datepicker({
                                format: "yyyy-mm-dd",
                            });
                            $('#datepicker2').datepicker({
                                format: "yyyy-mm-dd",
                            });
                        });
                    </script>
                    <div class="col input-group date" id="datepicker1">
                        <span class="input-group-text" id="basic-addon1">Start Date</span>
                        <input type="text" name='start_date' value="{{ $items->start_date }}" class="form-control">
                        <span class="input-group-append">
                            <span class="input-group-text bg-white d-block">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </span>
                    </div>
                    <div class="col input-group date" id="datepicker2">
                        <span class="input-group-text" id="basic-addon1">End Date</span>
                        <input type="text" name='end_date' value="{{ $items->end_date }}" class="form-control">
                        <span class="input-group-append">
                            <span class="input-group-text bg-white d-block">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </span>
                    </div>
                </div>
                <div class="pt-2 d-flex justify-content-center">
                    <div class="pe-2">
                        <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancel</a>
                    </div>
                    <input type="submit" class="btn btn-primary" name="upload" value="Save">
                </div>
            </div>
        </form>

    </div>
</div>
@endsection