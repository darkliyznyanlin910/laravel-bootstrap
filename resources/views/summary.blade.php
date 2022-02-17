@extends('layouts.footer_fixed')

@section('content')
<div class="container">
    <h3 class="d-flex justify-content-start pb-3">Summary</h3>
    <div class="row justify-content-center">
        <div class='col-sm-3 border'>
            <div class="pt-2">
                <h4>Total</h4>
                <p>Sale total : $<?php echo $sale_total; ?></p>
                <p>Total Orders : <?php echo $order_no; ?></p>
            
                <h4>Custom Range</h4>
                
                <p>Sale in 15 days : $<?php echo $sale_in_15_days; ?></p>
                <p>Orders in 15 days : <?php echo $order_no_in_15_days; ?></p>
            </div>
        </div>
        <div class='col-sm-9 border'>
            <div class="pt-2">
                <h4>Items Ranking based on Sales</h4>
                <script>
                    function sortTable(n) {
                        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
                        table = document.getElementById("myTable2");
                        switching = true;
                        // Set the sorting direction to ascending:
                        dir = "asc";
                        /* Make a loop that will continue until
                        no switching has been done: */
                        while (switching) {
                            // Start by saying: no switching is done:
                            switching = false;
                            rows = table.rows;
                            /* Loop through all table rows (except the
                            first, which contains table headers): */
                            for (i = 1; i < (rows.length - 1); i++) {
                                // Start by saying there should be no switching:
                                shouldSwitch = false;
                                /* Get the two elements you want to compare,
                                one from current row and one from the next: */
                                x = rows[i].getElementsByTagName("TD")[n];
                                y = rows[i + 1].getElementsByTagName("TD")[n];
                                /* Check if the two rows should switch place,
                                based on the direction, asc or desc: */
                                if (dir == "asc") {
                                    if (Number(x.innerHTML) > Number(y.innerHTML)) {
                                        shouldSwitch = true;
                                        break;
                                    }
                                } else if (dir == "desc") {
                                    if (Number(x.innerHTML) < Number(y.innerHTML)) {
                                        shouldSwitch = true;
                                        break;
                                    }
                                }
                            }
                            if (shouldSwitch) {
                                /* If a switch has been marked, make the switch
                                and mark that a switch has been done: */
                                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                                switching = true;
                                // Each time a switch is done, increase this count by 1:
                                switchcount ++;
                            } else {
                                /* If no switching has been done AND the direction is "asc",
                                set the direction to "desc" and run the while loop again. */
                                if (switchcount == 0 && dir == "asc") {
                                    dir = "desc";
                                    switching = true;
                                }
                            }
                        }
                    }
                </script>
                <table id="myTable2" class='table table-striped table-bordered'>
                    <thead>
                        <tr>
                            <th><span class="text-center" onclick="sortTable(0)">Item</span></th>
                            <th><span class="text-center" onclick="sortTable(1)">Total Sales</span></th>
                            <th><span class="text-center" onclick="sortTable(2)">Total Visit</span></th>
                            <th><span class="text-center" onclick="sortTable(3)">Conversion Rate (%)</span></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($items as $item) {
                            if ($item->sale != 0){
                                    echo "<tr>";
                                    echo "<td>". $item->item_name . "</td>";
                                    echo "<td>" . $item->sale . "</td>";
                                    echo "<td>" . $item->visit . "</td>";
                                    echo "<td>" . $item->rate . "</td>";
                                    echo "</tr>";
                            }
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection