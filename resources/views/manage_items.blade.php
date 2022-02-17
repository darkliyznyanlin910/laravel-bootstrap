@extends('layouts.app')

@section('content')
<div class="container">
     <script>
        function SearchSKU() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("SKU");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
        function SearchName() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("NAME");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
    <style>

        #myTable {
        border-collapse: collapse; /* Collapse borders */
        width: 100%; /* Full-width */
        border: 1px solid #ddd; /* Add a grey border */
        font-size: 18px; /* Increase font-size */
        }

        #myTable th, #myTable td {
        text-align: left; /* Left-align text */
        padding: 12px; /* Add padding */
        }

        #myTable tr {
        /* Add a bottom border to all table rows */
        border-bottom: 1px solid #ddd;
        }

        #myTable tr.header, #myTable tr:hover {
        /* Add a grey background color to the table header and on hover */
        background-color: #f1f1f1;
        }
    </style>
    <div class="d-flex justify-content-between pb-2">
        <h3>Manage Items</h3>
        <div>
            <a class="btn btn-primary" href="/manage_category">{{ __('Manage Categories') }}</a>
            <a class="btn btn-primary" href="/add_new_item">{{ __('Add New Item') }}</a>
            <a class="btn btn-primary" href="/update_discount_process">{{ __('Update Discount') }}</a>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success d-flex justify-content-center"><b>{{session('success')}}</b></div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger d-flex justify-content-center"><b>{{session('error')}}</b></div>
    @endif
    <div class="justify-content-center">
        <div class="input-group d-flex justify-content-center pb-3">
            <input type="text" class="rounded" id="SKU" onkeyup="SearchSKU()" placeholder="Search Items by SKU">
            <input type="text" class="rounded" id="NAME" onkeyup="SearchName()" placeholder="Search Items by Name">
        </div>
        <table id="myTable" class='table table-bordered'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>SKU</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>State</th>
                    <th>Discount</th>
                    <th>Thumbnail</th>
                    <th>Price</th>
                    <th>Current Stock</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
        <?php
        
        foreach($items as $item) {
            
            echo "<tr>";
            echo "<td>" . $item->id . "</td>";
            echo "<td>" . $item->sku . "</td>";
            echo "<td>" . $item->item_name . "</td>";
            echo "<td>" . $item->category . "</td>";
            if($item->state == 'inactive'){
                echo "<td class='table-danger'>";
            }else{
                echo "<td>";
            }
            echo $item->state . "</td>";
            if($item->discount > 0){
                echo "<td class='table-success'>";
            }else{
                echo "<td>";
            }
            echo $item->discount . "%</td>";
            echo "<td><img width='100' src=".$item->img."></td>";
            if($item->discount == 0){
                echo "<td>$" . $item->price . "</td>";
            }else{
                $saved = $item->price * $item->discount / 100;
                $discounted = $item->price - $saved;
                $discounted = round($discounted, 2, PHP_ROUND_HALF_UP);
                echo "<td><del>$" . $item->price . "</del>";
                echo "<p><span class='rounded bg-success p-1 text-white'>$" . $discounted . "</span></p></td>";
            }
                echo "<td>" . $item->stock . "</td>";
                echo "<td>";?>
            
            <form class="form-inline d-flex justify-content-center" method="POST" action="/stock_update_process">
            @csrf
                <div class="input-group">
                    <input class="form-control" type="number" name="quantity" value="1" min="1">
                    <input class="d-none" name="id" type="text" value="{{ $item->id }}">
                    <button class="input-group-text btn btn-secondary" type="submit">Add to stock</button>
                </div>
            </form>

            <form class="form-inline d-flex justify-content-center pt-2" method="POST" action="/stock_remove_process">
            @csrf
                <div class="input-group">
                    <input class="form-control" type="number" name="quantity" value="1" min="1" max="{{ $item->stock }}">
                    <input class="d-none" name="id" type="text" value="{{ $item->id }}">
                    <button class="input-group-text btn btn-secondary" type="submit">Remove from stock</button>
                </div>
            </form>

            <div class="d-flex justify-content-between pt-2">
                <form method="POST" action="/edit_items">
                @csrf
                    <input class="d-none" name="id" type="text" value="{{ $item->id }}">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-pencil"></i> Edit</button>
                </form>
                <?php if($item->state == 'inactive'){ ?>
                <a class="btn btn-success" onclick="return confirm('Are you sure you want to ACTIVATE {{$item->item_name}}?')" href="{{ route('activate_items', $item->id) }}">
                    <i class="fa fa-eye"></i> Activate
                </a>
                <?php }else{ ?>
                <a class="btn btn-warning" onclick="return confirm('Are you sure you want to DEACTIVATE {{$item->item_name}}?')" href="{{ route('deactivate_items', $item->id) }}">
                    <i class="fa fa-eye-slash"></i> Deactivate
                </a>
                <?php } ?>
                <a class="btn btn-danger" onclick="return confirm('Are you sure you want to DELETE {{$item->item_name}}?')" href="{{ route('delete_items', $item->id) }}">
                    <i class="fa fa-trash"></i> Delete
                </a>
            </div>
            
            <?php 
            echo "</td>";
            echo "</tr>";
        }   echo "</tbody>";
        echo "</table>"; ?>

    </div>
</div>
@endsection