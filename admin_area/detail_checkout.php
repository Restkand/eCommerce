<?php
    session_start();


    if(!isset($_SESSION["login"])){
        header("Location: login_admin.php");
        exit;
    }

    include('../includes/connect.php');
    include('../functions/pay_notif.php');

    if (isset($_GET['detail_checkout'])){
        global $con;

        $checkout_subid = $_GET['detail_checkout'];
        // Menampilkan Info Penerima 
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

        if(isset($_POST['notif_payment'])){
            notif_email_payment();
        }

        if(isset($_POST['print_label'])){
            header("Location:  label.php?checkout_id=$checkout_subid");
            exit;
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=`, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/CSS/order_status.css">
    <link rel="stylesheet" href="../assets/CSS/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <title>Produk | LOGO</title>
    <style>
    .container-outside {
            max-width: 790px;
            margin: 0 auto;
        }    
    </style>

</head>
<body>

    <div class="container order_contain">
    <div class="d-flex justify-content-between align-items-center mt-3 container-outside">
        <a href="index.php?all_order" class="btn btn-secondary">View Orders</a>    
        <h2>Detail Order</h2>  
    </div>
        <div class="order-details">
        <h2>Invoice: <span class="invoice-number"><?php echo "$invoice_number"?></span></h2>
        <div class="customer-info">
            <h3>Informasi Penerima</h3>
            <p><strong>Nama:</strong> <?php echo "$nama_penerima"?></p>
            <p><strong>Telepon:</strong> <?php echo "$telepon_penerima"?></p>
            <p><strong>Alamat:</strong> <?php echo "$alamat_penerima"?></p>
        </div>
        <div class="product-info">
            <h3>Produk yang Dibeli</h3>
            <?php while ($row = mysqli_fetch_array($result_product_query)) {
              $product_id = $row['product_id'];
              $formatted_price = number_format($row['product_price'], 0, '.', '.');
              $product_title = $row['product_title'];
              $product_image1 = $row['product_image1'];
              $product_quantity = $row['quantity'];
              $product_values = $row['product_price'] * $product_quantity;
              ?>
              <!-- Item -->
              
              <div class="cart-item">
                  <img src="../assets/img/product_images/<?php echo $product_image1 ?>" alt="<?php echo $product_title ?>" class="item-image">
                  <div class="item-details">
                      <h6 class="item-name"><?php echo $product_title ?> : Rp <?php echo $formatted_price ?></h6>                         
                      <p class="item-quantity">Total Item: <?php echo $product_quantity; ?></p>
                      <p class="item-price">Price Product : Rp <?php echo number_format($product_values, 0, '.', '.'); ?></p>
                  </div>
              </div>
              <hr>
              <?php } ?>
        </div>
        <div class="total-info">
          <p class="item-name"><strong>SubTotal</strong> : Rp <?php echo "$subtotal_format"?></p>
          <p class="item-name"><strong>Ongkos Kirim</strong> : Rp <?php echo "$ongkir_format"?> </p>
          <h3>Total Pembayaran</h3>
          <p class="total-amount">Rp <?php echo "$total_harga_format"?></p>
       </div>
        <div class="order-status">
            <h3>Status Pesanan : <?php echo "$status_checkout"?></h3>
        </div>
        <?php if($status_checkout == "Menunggu Pembayaran") {?>
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="text-center">
            <button class="btn btn-primary" type="submit" name="notif_payment" id="notif_payment">Kirim Notifikasi Pembayaran</button>
          </div>
        </form>
        <?php } ?>
        <?php if($status_checkout == "Sedang di Packing") {?>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="text-center">
                <button class="btn btn-primary" type="submit" name="print_label" id="print_label">Print Label</button>
            </div>
        </form>
        <?php } ?>
        <?php if($status_checkout == "Sedang di Kirim") {?>
        <div class="text-center">
         <button class="btn btn-primary">Lacak Pesanan</button>
        </div>
        <?php } ?>
        <?php if($status_checkout == "Pesanan di Terima") {?>
        <div class="text-center">
            <!-- <h3>Pesanan Di Terima</h3> -->
        </div>
        <?php } ?>
        <?php if($status_checkout == "Cancel") {?>
        <div class="text-center">
            <!-- <h3>Pesanan Di Terima</h3> -->
        </div>
        <?php } ?>
        </div>
  </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>
</html>

<?php } ?>