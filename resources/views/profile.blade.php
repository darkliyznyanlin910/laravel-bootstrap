@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="d-flex justify-content-start pb-3">Your Previous Orders</h3>
    <div class="justify-content-center">
        
        <?php
            if (count($orders) > 0) {

                ?>
                    <table class='table table-striped table-bordered'>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Est Delivery Date</th>
                                <th>Status</th>
                                <th>Invoice</th>
                            </tr>
                        </thead>
                        <tbody>
                <?php
                
                foreach($orders as $order) {
                    echo "<tr>";
                    $items_array = unserialize($order->order_items);
                    echo "<td>" . $order->id . "</td>";
                    echo "<td>" . $order->order_date . "</td>";
                    echo "<td><b>Items</b>";
                    for ($i = 0; $i < count($items_array); $i++) {
                        echo "<p>Item name - " . $items_array[$i]['item_name'] . " | ";
                        echo "Quantity - " . $items_array[$i]['quantity'] . "</p>";
                    }
                    echo "</td>";
                    echo "<td>$" . $order->order_total . "</td>";
                    echo "<td>" . $order->receive_date. "</td>";
                    echo "<td>" . $order->order_status . "</td>";
                    ?>
                    <td>
                        <form method="POST" action="/invoice">
                        @csrf
                            <input class="d-none" type="text" name="order_id" value="{{ $order->id }}">
                            <input class="btn btn-primary" type="submit" value="View Invoice">
                        </form>
                    </td>
                    <?php
                    echo "</tr>";
                }   echo "</tbody>";
                echo "</table>";
            }else{
                ?>
                    <p class="d-flex justify-content-center">No Orders Yet.</p>
                    
                <?php
            }
        ?>

    </div>
</div>
@endsection
