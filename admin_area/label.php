<?php

include('../includes/connect.php');
require_once('../PDF/vendor/autoload.php');

use Dompdf\Dompdf;

    // Inisialisasi Dompdf
    $dompdf = new Dompdf();

    if (isset($_GET['checkout_id'])){
        global $con;
        $checkout_subid = $_GET['checkout_id'];
    

        $select_query = "SELECT * FROM info_penerima where sub_order_id = $checkout_subid  ORDER BY order_id DESC LIMIT 1";
        $result_query = mysqli_query($con, $select_query);
        while($row = mysqli_fetch_array($result_query)){
            $nama_penerima = $row['nama_penerima'];
            $telepon_penerima = $row['telepon_penerima'];
            $alamat_penerima = $row['alamat_penerima'];
            $ongkir = $row['ongkos_kirim'];
            $subtotal = $row['harga_product'];
            $subtotal_format = number_format($subtotal, 0, '.', '.'); 
            $ongkir = $row['ongkos_kirim'];
            $ongkir_format = number_format($ongkir, 0, '.', '.');
            $total_harga = $row['total_harga'];
            $total_harga_format = number_format($total_harga, 0, '.', '.');
        }
        
        // Menampilkan Checkout_details
        $select_query_inv = "SELECT * FROM checkout_details where sub_order_id = $checkout_subid  ORDER BY order_id DESC LIMIT 1";
        $result_query_inv = mysqli_query($con, $select_query_inv);
        while($row_inv = mysqli_fetch_array($result_query_inv)){
            $invoice_number = $row_inv['invoice_number'];
            $status_checkout = $row_inv['status_checkout'];
        }

        // Menampilkan Product
        $product_query = "SELECT checkout_details.*, products.product_price, products.product_title, products.product_image1 FROM checkout_details
        JOIN products ON checkout_details.product_id = products.product_id
        WHERE checkout_details.sub_order_id = '$checkout_subid'";
        $result_product_query = mysqli_query($con, $product_query);

    // Konten HTML
    $html = '
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Shipping Label</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 80mm;
                max-height: 80mm;
                border: 1px solid #000;            
                padding: 20px;
            }

            .container-product {
                width: 80mm;
                max-height: 30mm;
                border: 0.8px dashed #000;
                padding: 8px 20px;
            }

            h2 {
                text-align: center;
                text-transform: uppercase;
                color: #000;
                margin-top: 30px;
            }

            h5 {
                text-align: center;
            }

            .label-info {
                padding: 10px;
                background-color: #fff;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            .container-product p {
                font-size: 12px;
            }

            p {
                margin: 0;
                color: #000;
            }

            .label-info p {
                font-size : 14px;
                margin-bottom: 2px;
            }

            .label-info .alamat-info {
                margin-top: 15px
            }

            .logo {
                position: absolute;
                top: 10px;
                left: 10px;
                font-size: 14px;
                font-weight: bold;
                background-color: #fff;
                padding: 5px;
                border-radius: 3px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h2>meonthrift</h2>
            <div class="label-info">
                <p style="font-weight:bold;">To:</p>
                <p>Nama : '. $nama_penerima .'</p>
                <p>No. HP: '. $telepon_penerima .'</p>
                <p class="alamat-info">'. $alamat_penerima .'</p>
            </div>
            <div class="logo">JNE / '. $invoice_number .' </div>
        </div>
        <div class = "container-product">';
    
        while ($row = mysqli_fetch_array($result_product_query)) {
            $product_title = $row['product_title'];
            $product_quantity = $row['quantity'];
    
            $html .= "<p> $product_quantity - $product_title </p>";
        }
    
    $html .=
        '</div>
    </body>

    </html>';
    // Menambahkan konten HTML ke Dompdf
    $dompdf->loadHtml($html);

    // Mengubah ukuran dan orientasi kertas
    $dompdf->setPaper('A4', 'portrait');

    // Render HTML ke PDF
    $dompdf->render();

    // Outputkan PDF
    $dompdf->stream('shipping_label.pdf', ['Attachment' => false]);
        }
?>
