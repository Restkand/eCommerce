<?php
include('includes/connect.php');
include('includes/footer.php');
include('functions/common_function.php');
require_once 'functions/ongkir_function.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  global $con;
  if (isset($_GET['checkout_id'])){
    $checkout_id = $_GET['checkout_id'];
    // Query untuk gabungan tabel
    $query = "SELECT cd.product_id, ip.order_id, cd.sub_order_id, cd.quantity
    FROM cart_details cd
    INNER JOIN info_penerima ip ON cd.sub_order_id = ip.sub_order_id WHERE cd.sub_order_id = '$checkout_id'";
    $result = mysqli_query($con, $query);

    // Array untuk menyimpan baris yang telah dipisahkan
    $separatedRows = array();
    
    while ($row = mysqli_fetch_assoc($result)) {
      $product_id = $row['product_id'];
      $sub_order_id = $row['sub_order_id'];
      $quantity = $row['quantity'];
      
      // Periksa apakah sub_order_id sudah ada dalam array $separatedRows
      if (isset($separatedRows[$sub_order_id][$product_id])) {
          // Jika sudah ada, lanjutkan ke baris berikutnya
          continue;
      } else {
          // Jika belum ada, tambahkan baris baru
          $separatedRows[$sub_order_id][$product_id] = $row;
      }

      $soldout_query = "UPDATE products SET sold_out= 1 WHERE product_id = $product_id";
      mysqli_query($con, $soldout_query);
    }
    
    foreach ($separatedRows as $sub_order_id => $products) {
      foreach ($products as $product_id => $row) {
        $order_id=$row['order_id'];
        $sub_order_id = $row['sub_order_id'];
        $date = date('dmY');
        $invoice_number = 'INV-' . $date . $order_id;
        $status_checkout = 'Menunggu Pembayaran';
        $insertQuery = "INSERT INTO checkout_details (product_id, order_id, sub_order_id, quantity, invoice_number, status_checkout) VALUES ('$product_id', '$order_id','$sub_order_id','$quantity', '$invoice_number', '$status_checkout')";
        mysqli_query($con, $insertQuery);
      }
    }

    $delete_cart = "DELETE FROM cart_details WHERE sub_order_id = $checkout_id";
    mysqli_query($con, $delete_cart);

    sendNotificationEmailtoCustomer($nama_penerima, $email_penerima, $invoice_number);
    sendNotificationEmailtoAdmin($nama_penerima, $email_penerima, $invoice_number);

    $checkout_id = urlencode($checkout_id);
    header("Location: payment.php?checkout_id=$checkout_id");
    exit;
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=`, initial-scale=1.0">
    <link rel="icon" href="assets/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/CSS/main.css">
    <link rel="stylesheet" href="assets/CSS/menuBelanja.css">
    <link rel="stylesheet" href="assets/CSS/info_penerima.css">
    <link rel="stylesheet" href="assets/CSS/cart.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <title>Checkout | meonthrift</title>
</head>
<body>

  <!-- NAVBAR -->
  <div class="nav">
      <div class="container">
          <!-- Logo -->
          <div class="row">
              <div class="col-10 offset-1 text-center">
              <a class="navbar-brand" href="index.php"><img src="assets/img/Logo_meonthrif.png" alt="LOGO"></a>
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
                  <a  href="cek_pesanan.php">CEK PESANAN</a>
                  <a href="about_us.php">TENTANG KAMI</a>
              </div>
          </div>
      </div>
  </div>

    <hr>
    <h2 class="card-title text-center mb-3">Konfirmasi Pesanan</h2>
    <div class="container">
      <div class="row">
        <div class="col-md-8"> 
          <?php 
          info_checkout();
          ?>
        </div>
          <div class="col-md-4">
            <!-- Informasi barang yang ingin dibeli -->
            <?php 
            info_product_checkout();
            ?>
          </div>
      </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>
</html>
