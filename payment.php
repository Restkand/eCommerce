<?php
include('includes/connect.php');
include('includes/footer.php');
include('functions/common_function.php');
require_once 'functions/ongkir_function.php';
if (isset($_GET['checkout_id'])){
    $checkout_subid = $_GET['checkout_id'];
    $select_query = "SELECT * FROM info_penerima where sub_order_id = $checkout_subid  ORDER BY order_id DESC LIMIT 1";
    $result_query = mysqli_query($con, $select_query);
    while($row = mysqli_fetch_array($result_query)){
        $total_harga = $row['total_harga'];
        $harga_format = number_format($total_harga, 0, '.', '.');
    }
    
    $select_query_inv = "SELECT * FROM checkout_details where sub_order_id = $checkout_subid  ORDER BY order_id DESC LIMIT 1";
    $result_query_inv = mysqli_query($con, $select_query_inv);
    while($row_inv = mysqli_fetch_array($result_query_inv)){
        $invoice_number = $row_inv['invoice_number'];
    }

    if(isset($_POST['insert_bukti'])){
        $bukti_image = $_FILES['bukti']['name'];
        
        // Access image tmp name
        $temp_bukti_image = $_FILES['bukti']['tmp_name'];

        move_uploaded_file($temp_bukti_image, "assets/img/bukti_pembayaran/$bukti_image");

        $insert_bukti = "INSERT INTO bukti_pembayaran(sub_order_id,invoice_number,bukti_image) 
                         VALUES ('$checkout_subid','$invoice_number','$bukti_image')";
        $result_query = mysqli_query($con,$insert_bukti);
        
        $update_status = "UPDATE checkout_details SET status_checkout = 'Konfirmasi Pembayaran' WHERE sub_order_id = '$checkout_subid'";
        mysqli_query($con,$update_status);

        $checkout_subid = urlencode($checkout_subid);
        header("Location: order_status.php?checkout_id=$checkout_subid");
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
    <link rel="stylesheet" href="assets/CSS/payment.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script>
    function displayFileName(event) {
      var input = event.target;
      var fileName = input.files[0].name;
      var span = input.nextElementSibling;
      span.setAttribute("data-file-name", fileName);
    }
  </script>
    <title>Payment | meonthrift</title>
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
                  <a  href="cek_pesanan.php" class="activeNav">CEK PESANAN</a>
                  <a href="return_product.php">RETURN</a>
                  <a href="about_us.php">TENTANG KAMI</a>
              </div>
          </div>
      </div>
  </div>

    <hr>
    <h2 class="card-title text-center mb-3">Konfirmasi Pembayaran</h2>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="payment-row">
              <h4>Transfer Pembayaran</h4>
              <p>Silakan melakukan transfer pembayaran ke rekening berikut:</p>
              <ul>
                  <li>Nama Bank: Bank BCA</li>
                  <li>Nomor Rekening: 1234567890</li>
                  <li>Nama Penerima: John Doe</li>
              </ul>
              <p>Jumlah pembayaran: Rp <?php echo "$harga_format"; ?></p>
              <p>Mohon segera lakukan pembayaran dalam waktu 1 x 24 jam untuk pesanan <b><?php echo "$invoice_number"?></b></p>
              <p>Pesan</p>
          </div>
        </div>
      </div>

      <div class="row justify-content-center">
          <div class="col-lg-8">
              <div class="upload-row">
                  <h4>Unggah Bukti Pembayaran</h4>
                  <form action="" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="bukti">Pilih File Bukti Pembayaran:</label>
                          <label class="custom-file-upload">
                              <input type="file" name="bukti" id="bukti" accept=".jpg, .jpeg, .png" required>
                              Pilih File
                          </label>
                      </div>
                      <button type="submit" class="btn btn-primary" name="insert_bukti">Unggah</button>
                  </form>
              </div>
          </div>
      </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>
</html>