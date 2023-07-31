<?php 
include('includes/connect.php');
include('includes/footer.php');
include('functions/common_function.php');

if (isset($_POST['insert_unboxing'])) {
    $invoice_number = $_POST['invoice_number'];
    $note_return = $_POST['note_return'];

    // Access Video Unboxing
    $vid_unboxing = $_FILES['vid_unboxing']['name'];

    // Access image tmp name
    $temp_unboxing = $_FILES['vid_unboxing']['tmp_name'];

    // Checking Empty Condition
    if ($invoice_number == '' or $note_return == '' or $vid_unboxing == '' or $temp_unboxing == '') {
        echo "<script>alert('Please fill all the empty')</script>";
    } else {
        // Check if invoice number exists in checkout_details table
        $query = "SELECT * FROM checkout_details WHERE invoice_number = '$invoice_number'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
            // Invoice number found, proceed with the INSERT query
            move_uploaded_file($temp_unboxing, "assets/vid/product_return/$vid_unboxing");

            // Insert query
            $return_product = "INSERT INTO report_return (invoice_number, note_return, vid_unboxing) 
                VALUES ('$invoice_number','$note_return', '$vid_unboxing')";
            $result_query = mysqli_query($con, $return_product);
            if ($result_query) {
              // Update status_checkout to "Return" in checkout_details table
              $update_checkout = "UPDATE checkout_details SET status_checkout = 'Return' WHERE invoice_number = '$invoice_number'";
              mysqli_query($con, $update_checkout);

              echo "<script>alert('Laporan return telah kami terima')</script>";
            }
        } else {
            // Invoice number not found, display alert
            echo "<script>alert('Kode pesanan tersebut tidak ditemukan')</script>";
        }
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
    <link rel="stylesheet" href="assets/CSS/payment.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <title>Return Pesanan | meonthrift</title>
    <style>
      ol {
        list-style-type: disc; 
      }

      a{
        color: black;
        text-decoration:none
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
                  <a href="return_product.php" class="activeNav">RETURN</a>
                  <a href="about_us.php">TENTANG KAMI</a>
              </div>
          </div>
      </div>
  </div>

    <!-- cart Function -->
    <?php 
    cart();
    ?>

  <hr>

  <h1 class="card-title text-center">Return Produk</h1>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="payment-row">
          <h2>Kebijakan Pengembalian Produk</h2>
          <ol>
            <li>Kami menerima pengembalian produk jika terdapat kesalahan pengiriman, produk rusak, atau tidak sesuai dengan deskripsi yang diberikan.</li>
            <li>Pengembalian produk hanya dapat dilakukan dalam waktu maksimal 7 hari setelah tanggal penerimaan produk.</li>
            <li>Produk yang dikembalikan harus dalam kondisi yang sama seperti saat diterima, lengkap dengan kemasan asli.</li>
            <li>Produk yang telah digunakan, rusak karena kesalahan penggunaan, atau mengalami kerusakan karena kelalaian pengguna tidak dapat dikembalikan.</li>
          </ol>

          <h2>Prosedur Pengembalian Produk</h2>
          <ol>
            <li>Jika pelanggan ingin mengembalikan produk, pelanggan dapat menghubungi melalui pesan <a href="https://www.instagram.com/meonthrift/">Direct Message Instagram </a> kami, atau bisa dengan mengupload bukti video unboxing ke halaman website return kami.</li>
            <li>Dalam proses pengembalian produk, kami mewajibkan Anda untuk menyertakan bukti video unboxing sebagai bagian dari proses verifikasi.</li>
            <li>Setelah permohonan pengembalian disetujui, kami akan menghubungi pelanggan untuk memberikan instruksi mengenai pengemasan dan pengiriman produk yang harus dikembalikan.</li>
            <li>Pastikan untuk mengemas produk dengan baik dan menggunakan layanan pengiriman yang dapat dilacak untuk mengembalikan produk.</li>
            <li>Biaya pengiriman untuk pengembalian produk menjadi tanggung jawab pelanggan, kecuali jika kesalahan pengiriman atau kerusakan produk adalah kesalahan kami.</li>
            <li>Setelah kami menerima produk yang dikembalikan dan memverifikasi kondisinya, kami akan memproses pengembalian dana sesuai dengan kebijakan pengembalian kami.</li>
          </ol>

          <h2>Bukti Video Unboxing</h2>
          <ol>
          <li>Video unboxing yang dikirimkan harus memiliki kualitas yang baik, dengan gambar yang jelas dan tidak terpotong.</li>
            <li>Mulailah dengan menunjukkan paket yang diterima dalam kondisi aslinya dan jangan membukanya terlebih dahulu.</li>
            <li>Lakukan pengambilan video yang jelas saat membuka paket dan menunjukkan isi paket secara detail.</li>
            <li>Perlihatkan secara jelas jika terdapat kerusakan atau ketidaksesuaian produk dengan deskripsi yang diberikan.</li>
            <li>Pastikan video unboxing menunjukkan secara jelas nomor pesanan produk.</li>
          </ol>
          <p> Permohonan pengembalian yang tidak disertai dengan bukti video unboxing yang memenuhi persyaratan tidak akan diproses.</p>
          </div>
        </div>
      </div>

      <div class="row justify-content-center">
          <div class="col-lg-8">
              <div class="upload-row">
                  <h4>Unggah Bukti Unboxing</h4>
                  <form action="" method="POST" enctype="multipart/form-data">
                  <div class="form-outline mb-4 w-50">
                      <label for="product-title" class="from-label">Nomor Pesanan</label>
                      <input type="text" name="invoice_number" id="invoice_number" class="form-control" placeholder="INV-123456789" autocomplete="off" required="required">
                  </div>
                  <div class="form-outline mb-4 w-50">
                      <label for="product-desc" class="from-label">Catatan / Penyebab Return</label>
                      <textarea type="text" name="note_return" id="note_return" class="form-control" placeholder="" autocomplete="off" rows="3" required="required"></textarea>
                  </div> 
                  <div class="form-outline mb-4 w-50">
                      <label for="product-image1" class="from-label">Video Unboxing</label>
                      <input type="file" accept="video/*" name="vid_unboxing" id="vid_unboxing" class="form-control" required="required">
                  </div> 
                      <div class="form-outline mb-4 w-50">
                        <input type="submit" name="insert_unboxing" class="btn btn-info mb-3 px-2" style="color:white;" value="Unggah Video">
                      </div>
                  </form>
              </div>
          </div>
      </div>
    </div>
  
    <!-- Footer -->
    <?php 
        footer()
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>