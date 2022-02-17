@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="d-flex justify-content-start pb-3">Stock Update</h3>
    <div class="justify-content-center">
        
        <table class='table table-striped table-bordered'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Thumbnail</th>
                    <th>Price</th>
                    <th>Current Stock</th>
                    <th>Add to Stock</th>
                </tr>
            </thead>
            <tbody>
        <?php
        
        foreach($items as $item) {
            echo "<tr>";
            echo "<td>" . $item->id . "</td>";
            echo "<td>" . $item->item_name . "</td>";
            echo "<td><img width='100' src=".$item->img."></td>";
            echo "<td>$" . $item->price . "</td>";
            echo "<td>" . $item->stock . "</td>";
            echo "<td>"; ?>
            
            <form method="POST" action="/stock_update_process">
                @csrf
                <input class="d-none" type="text" name="item_name" value="{{ $item->item_name }}">
                <input class="rounded" type="number" name="quantity" value="1" min="1">
                <input class="input-group-text btn btn-primary" type="submit" value="Add">
                
            </form>
            
            <?php 
            echo "</td>";
            echo "</tr>";
        }   echo "</tbody>";
        echo "</table>"; ?>

    </div>
</div>
@endsection