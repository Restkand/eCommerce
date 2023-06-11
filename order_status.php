<?php
include('includes/connect.php');
include('includes/footer.php');
include('functions/common_function.php');
require_once 'functions/ongkir_function.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=`, initial-scale=1.0">
    <link rel="stylesheet" href="assets/CSS/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <title>Produk | LOGO</title>
    <style>
    .order_contain {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
    }
    .order-details {
      background-color: #fff;
      padding: 30px;
      border: 1px solid #e2e2e2;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .order-details h2 {
      margin-bottom: 20px;
      font-size: 24px;
      font-weight: bold;
      color: #333;
    }
    .customer-info h3, .product-info h3, .total-info h3, .order-status h3 {
      margin-top: 30px;
      margin-bottom: 15px;
      font-size: 18px;
      font-weight: bold;
      color: #333;
    }
    .customer-info p {
      margin-bottom: 8px;
      font-size: 14px;
      color: #555;
    }
    .product-table th, .product-table td {
      padding: 12px;
      vertical-align: middle;
      font-size: 14px;
      color: #555;
    }
    .product-table th {
      background-color: #f8f9fa;
      font-weight: bold;
    }
    .invoice-number {
      font-size: 20px;
      font-weight: bold;
      color: #333;
    }
    .total-amount {
      font-size: 24px;
      font-weight: bold;
      color: #333;
    }
    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }
    .btn-primary:hover {
      background-color: #0069d9;
      border-color: #0062cc;
    }
    </style>
</head>
<body>

  <!-- NAVBAR -->
  <div class="nav">
      <div class="container">
          <!-- Logo -->
          <div class="row">
              <div class="col-10 offset-1 text-center">
                      <h1><a class="navbar-brand" href="index.php">LOGO</a></h1>
              </div>
              <div class="col-1">
                <?php 
                  cart_item();
                ?>
              </div>
          </div>
          <div class="row">
              <div class="col nav-item text-center">
                  <a href="products.php">PRODUK</a>
                  <a href="#">PRELOVED</a>
                  <a  href="#">CARI LOKASI TOKO</a>
                  <a href="#">TENTANG KAMI</a>
              </div>
          </div>
      </div>
  </div>

    <hr>
    <h2 class="card-title text-center mb-3">Status Pesanan</h2>
    <div class="container order_contain">
        <div class="order-details">
        <h2>Invoice: <span class="invoice-number">INV-210517-12345</span></h2>
        <div class="customer-info">
            <h3>Informasi Penerima</h3>
            <p><strong>Nama:</strong> John Doe</p>
            <p><strong>Telepon:</strong> 081234567890</p>
            <p><strong>Alamat:</strong> Jl. Contoh Alamat No. 123</p>
        </div>
        <div class="product-info">
            <h3>Produk yang Dibeli</h3>
            <table class="table product-table">
            <thead>
                <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>Product A</td>
                <td>Rp 100.000</td>
                </tr>
                <tr>
                <td>Product B</td>
                <td>Rp 200.000</td>
                </tr>
            </tbody>
            </table>
        </div>
        <div class="total-info">
            <h3>Total Pembayaran</h3>
            <p class="total-amount">Rp 300.000</p>
        </div>
        <div class="order-status">
            <h3>Status Pesanan : Not Payment</h3>
        </div>
        <div class="text-center">
            <button class="btn btn-primary">Lacak Pesanan</button>
        </div>
        </div>
  </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>
</html>