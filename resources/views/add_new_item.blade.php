@extends('layouts.footer_fixed')

@section('content')
<div class="container">
    <h3 class="d-flex justify-content-start pb-3">Add New Item</h3>
    <div class="row justify-content-center">
    
        @if(session('success'))
        <div class="alert alert-success d-flex justify-content-center"><b>{{session('success')}}</b></div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger d-flex justify-content-center"><b>{{session('error')}}</b></div>
        @endif

        <form enctype="multipart/form-data" action="/add_new_item_process" method="post">
        @csrf
            <div class="row pt-2">
                <div class="col input-group">
                    <span class="input-group-text" id="basic-addon1">SKU</span>
                    <input type="text" class="form-control" name="sku" required>
                </div>
                <div class="col input-group">
                    <span class="input-group-text" id="basic-addon1">Item Name</span>
                    <input type="text" class="form-control" name="item_name" required>
                </div>
            </div>
            
            <div class="row pt-2">
                <div class="col input-group">
                    <span class="input-group-text" id="basic-addon1">Price</span>
                    <input type="text" class="form-control" name="price" required>
                </div>
                <div class="col input-group">
                    <span class="input-group-text" id="basic-addon1">Stock</span>
                    <input type="number" class="form-control" name="stock" required>
                </div>
            </div>

            <div class="row pt-2">
                <div class="col input-group">
                    <script>
                        function selection(){
                            var selected=document.getElementById("select1").value;
                            if(selected==0){
                                document.getElementById("input1").hidden = false;
                            }else{
                                document.getElementById("input1").hidden = true;
                            }
                        }
                    </script>
                    <span class="input-group-text" id="basic-addon1">Category</span>
                    <input id="input1" hidden="hidden" type="text" class="form-control" name="new_category" placeholder="New Category" required>
                    <select name="category" class="form-select" onchange="selection()" id="select1">
                        <option value="-1"></option>
                        <option value="0">--Create New Category--</option>
                        <?php foreach($categories as $category){ ?>
                            <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col input-group">
                    <span class="input-group-text" id="basic-addon1">State</span>
                    <select class="form-select" name="state" aria-label="Default select example">
                        <option selected value="active">active</option>
                        <option value="inactive">inactive</option>
                    </select>
                </div>
            </div>
            <div class="row pt-2">
                <div class="col input-group">
                    <input type="file" class="form-control" name="file">
                </div>
            </div>
            <div class="pt-2 d-flex justify-content-center">
                <div class="pe-2">
                    <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancel</a>
                </div>
                <input type="submit" class="btn btn-primary" name="upload" value="Add">
            </div>
        </form>

    </div>
</div>
@endsection