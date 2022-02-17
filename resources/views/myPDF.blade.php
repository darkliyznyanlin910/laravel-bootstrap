@extends('layouts.app')

@section('content')
    <div class="container p-5">
        <header class="d-flex justify-content-between">
            <div>
                <img class="w-25" src="images/gg.png">
            </div>
            <div>
                <h2 class="text-end">Johnny's Playground</h2>
                <div class="text-end">admin@test.com</div>
            </div>
        </header>
        <hr>
        <main>
            <div class="d-flex justify-content-between">
                <div>
                    <div class="text-gray-light">INVOICE TO:</div>
                    <h2>{{ $name }}</h2>
                    <div><?php $order_address = unserialize($order_address_array); ?>
                    <p>{{ $order_address['street']}}
                    Block {{ $order_address['block']}}, Unit  {{ $order_address['unit']}},
                    Postal Code: {{ $order_address['postal_code']}}</p>
                    </div>
                    <div class="email">Email: {{ $user_email }}</div>
                </div>
                <div>
                    <h1>INVOICE ID: {{ $order_id }}</h1>
                    <div>Date of Purchase: {{ $order_date }}</div>
                    <div>Date of Invoice: {{ $order_date }}</div>
                </div>
            </div>
            <hr>
            <table class='table table-striped'>
                <thead>
                    <tr class="table-primary">
                        <th>#</th>
                        <th>ITEMS</th>
                        <th>PRICE</th>
                        <th>QUANTITY</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i = 1;
                    $order_items = unserialize($order_items_array);
                    foreach($order_items as $item)
                    {
                        $price = $item['price'];
                        $quantity = $item['quantity'];
                        $total = $price * $quantity;
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td>
                            <h3><?php echo $item['item_name']; ?></h3></td>
                        <td>$<?php echo $item['price']; ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>$<?php echo $total; ?></td>
                    </tr>
                <?php
                    $i++;
                    }
                ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">Thank You for Purchasing on Our Website</td>
                        <td>TOTAL</td>
                        <td>${{ $order_total }}</td>
                    </tr>
                </tfoot>
            </table>
        </main>
        <hr>
        <footer class="text-center">Invoice was created on a computer and is valid without the signature and seal.</footer>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
@endsection

