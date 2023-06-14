<?php
require_once('../PDF/vendor/autoload.php');

use Dompdf\Dompdf;

// Inisialisasi Dompdf
$dompdf = new Dompdf();

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
            height: 80mm;
            border: 2px solid #000;
            border-radius: 10px;
            padding: 20px;
        }

        h2 {
            text-align: center;
            text-transform: uppercase;
            color: #000;
        }

        .label-info {
            margin-top: 20px;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        p {
            margin: 0;
            color: #000;
        }

        .label-info p {
            margin-bottom: 2px;
        }

        .label-info .alamat-info {
            color: red;
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
        <h2>Shipping Label</h2>
        <div class="label-info">
            <p style="font-weight:bold;">To:</p>
            <p>Nama : John Doe</p>
            <p>No. HP: 08123456789</p>
            <p class="alamat-info">Alamat: 123 Main St</p>
        </div>
        <div class="logo">JNE</div>
    </div>
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
?>
