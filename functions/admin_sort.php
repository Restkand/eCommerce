<?php

include('../includes/connect.php');

function select_date(){
    global $con;
    $sort_options = array(
        'all' => 'Semua Tanggal',
        'week' => '1 Minggu Terakhir',
        'month' => '1 Bulan Terakhir',
        '3months' => '3 Bulan Terakhir'
    );

    // Get the selected sort option from the query string
    $selected_sort = isset($_GET['sort']) ? $_GET['sort'] : 'all';

    echo "<select name='order_date' class='form-control order_date'>";
    foreach ($sort_options as $value => $label) {
        $selected = $selected_sort == $value ? 'selected' : '';
        echo "<option value='$value' $selected>$label</option>";
    }
    echo "</select>";

    echo "<script>
        // Redirect to the selected sort option's URL when the selection changes
        document.querySelector('.order_date').addEventListener('change', function() {
            var sort_value = this.value;
            var current_url = window.location.href;
            
            // Check if the URL already contains 'sort' parameter
            if (current_url.indexOf('?') > -1) {
                current_url = current_url.replace(/(\?|&)sort=[^&]*(&|$)/, '$1');
            }
            
            // Append the selected sort option to the URL
            if (sort_value !== 'all') {
                current_url += (current_url.indexOf('?') > -1 ? '&' : '?') + 'sort=' + encodeURIComponent(sort_value);
            }
            
            window.location.href = current_url;
        });
    </script>";
}

function select_soldout(){
    global $con;
    $sort_options = array(
        'all' => 'Semua Products',
        'ready_stock' => 'Ready Stock',
        'sold_out' => 'Sold Out',
    );

    // Get the selected sort option from the query string
    $selected_sort = isset($_GET['sort']) ? $_GET['sort'] : 'all';

    echo "<select name='order_date' class='form-control order_date'>";
    foreach ($sort_options as $value => $label) {
        $selected = $selected_sort == $value ? 'selected' : '';
        echo "<option value='$value' $selected>$label</option>";
    }
    echo "</select>";

    echo "<script>
        // Redirect to the selected sort option's URL when the selection changes
        document.querySelector('.order_date').addEventListener('change', function() {
            var sort_value = this.value;
            var current_url = window.location.href;
            
            // Check if the URL already contains 'sort' parameter
            if (current_url.indexOf('?') > -1) {
                current_url = current_url.replace(/(\?|&)sort=[^&]*(&|$)/, '$1');
            }
            
            // Append the selected sort option to the URL
            if (sort_value !== 'all') {
                current_url += (current_url.indexOf('?') > -1 ? '&' : '?') + 'sort=' + encodeURIComponent(sort_value);
            }
            
            window.location.href = current_url;
        });
    </script>";
}
?>