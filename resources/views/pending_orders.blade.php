@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="d-flex justify-content-start pb-3">Pending Orders</h3>
    <div class="justify-content-center">

    @if(session('success'))
        <div class="alert alert-success d-flex justify-content-center"><b>{{session('success')}}</b></div>
    @endif
        
        <?php
            if (count($orders) > 0) {

                ?>
                    <table class='table table-bordered'>
                        <thead class="thead-dark">
                            <tr>
                                <th>Customer Info</th>
                                <th>Items</th>
                                <th>Details</th>
                                <th>Update Status</th>
                            </tr>
                        </thead>
                        <tbody>
                <?php
                $today = date("Y-m-d");
                $today_plus_2 = date('Y-m-d', strtotime($today . " + 2 day"));
                foreach($orders as $order) {

                    if($order->receive_date < $today){
                        echo "<tr class='table-danger'>";
                    }elseif($order->receive_date >= $today && $order->receive_date <= $today_plus_2){
                        echo "<tr class='table-warning'>";
                    }else{
                        echo "<tr>";
                    }
                    $items_array = unserialize($order->order_items);
                    $address_array = unserialize($order->address);


                    echo "<td>";
                    echo "<p><b>Order ID - " . $order->id . "</b></p>";
                    echo "<p>User ID - " . $order->user_email . "</p>";
                    echo "<p><b>Delivery Address</b></p>"; 
                    echo "<p>" . $address_array['street'] . "</p>";
                    echo "<p>Block - " . $address_array['block'] ." | Unit - ". $address_array['unit'] . "</p>";
                    echo "<p>Postal Code - " . $address_array['postal_code'] . "</p>";
                    echo "</td>";


                    echo "<td><b>Items</b>";
                    for ($i = 0; $i < count($items_array); $i++) {
                        echo "<p>Item name - " . $items_array[$i]['item_name'] . " | ";
                        echo "Quantity - " . $items_array[$i]['quantity'] . "</p>";
                    }
                    echo "</td>";
                    echo "<td>";
                    echo "<p>Total - $" . $order->order_total . "</p>";
                    echo "<p>Order Date - " . $order->order_date . "</p>";
                    echo "<p>Estimate delivery date - " . $order->receive_date . "</p>";
                    echo "<p>Order Status - " . $order->order_status . "</p></td>";
                    echo "<td>";
                    ?>
                    <div class="dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown">Update Status</button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="admin_order_update/<?php echo $order->id;?>/<?php echo "Out for Delivery";?>">Out for Delivery</a></li>
                            <li><a class="dropdown-item" href="admin_order_update/<?php echo $order->id;?>/<?php echo "Delivered";?>">Delivered</a></li>
                        </ul>
                    </div>
                    <?php echo "</td>"; 
                    echo "</tr>"; } echo "</table>";
            }else{
                ?>
                    <p class="d-flex justify-content-center">All orders have been processed.</p>
                    
                <?php
            }
        ?>

    </div>
</div>
@endsection