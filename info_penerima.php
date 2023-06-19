<?php
include('includes/connect.php');
include('includes/footer.php');
include('functions/common_function.php');
require_once 'functions/ongkir_function.php';

$data = new RajaOngkir();

$kota = $data->get_city();
$kota_array = json_decode($kota, true);



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Mendapatkan data produk
    global $con;
    $total_price_product = 0;
    $get_ip_add = getIPAddress();
    $cart_query = "SELECT cart_details.*, products.product_price, products.product_title, products.product_image1 FROM cart_details
                  JOIN products ON cart_details.product_id = products.product_id
                  WHERE cart_details.ip_address = '$get_ip_add'";
    $result_query = mysqli_query($con, $cart_query);
    $product_sub_id = '';
    while ($row = mysqli_fetch_array($result_query)) {
      $product_sub_id = $row['sub_order_id'];
      $product_quantity = $row['quantity'];
      $product_values = $row['product_price'] * $product_quantity;
      $total_price_product += $product_values;
    }

    // Mendapatkan data dari form
    $nama_penerima = $_POST['inputNama'];
    $telepon_penerima = $_POST['inputTelepon'];
    $email_penerima = $_POST['inputEmail'];
    $kota_pengirim = '154';
    $kota_penerima = $_POST['kota_tujuan'];
    $alamat_penerima = $_POST['inputAlamat'];
    $weight = '1000';
    $total_price_product;

    // Mendapatkan ongkos kirim menggunakan API RajaOngkir
    $cost = $data->get_cost($kota_pengirim, $kota_penerima, $weight,$total_price_product);

    // Menyimpan data ke dalam tabel MySQL
    if ($cost['rajaongkir']['status']['code'] === 200) {
        global $con;
        $chosen_cost = $cost['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'];
        $all_total_price = $chosen_cost + $total_price_product;

        $sql = "INSERT INTO info_penerima (sub_order_id,ip_address,nama_penerima, email_penerima, telepon_penerima, id_kota_pengirim, id_kota_penerima, alamat_penerima, berat, ongkos_kirim,harga_product,total_harga) 
                VALUES ('$product_sub_id','$get_ip_add','$nama_penerima', '$email_penerima', '$telepon_penerima', '$kota_pengirim', '$kota_penerima', '$alamat_penerima', '$weight', '$chosen_cost', '$total_price_product','$all_total_price')";
        $result = mysqli_query($con, $sql);
    } 
    $checkout_id = urlencode($product_sub_id);
    header("Location: checkout.php?checkout_id=$checkout_id");
    exit;
}

// Menampilkan data ongkos kirim yang tersimpan
// $sql = "SELECT * FROM ongkos_kirim";
// $result = mysqli_query($conn, $sql);

// // Tampilkan data dalam tabel
// echo "<table>";
// echo "<tr><th>ID</th><th>Origin</th><th>Destination</th><th>Weight</th><th>Cost</th></tr>";
// while ($row = mysqli_fetch_assoc($result)) {
//     echo "<tr>";
//     echo "<td>" . $row['id'] . "</td>";
//     echo "<td>" . $row['origin'] . "</td>";
//     echo "<td>" . $row['destination'] . "</td>";
//     echo "<td>" . $row['weight'] . "</td>";
//     echo "<td>" . $row['cost'] . "</td>";
//     echo "</tr>";
// }
// echo "</table>";

// // Tutup koneksi MySQL
// mysqli_close($conn);
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
    <title>Info Penerima | Logo</title>
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
                  <a href="about_us.php">TENTANG KAMI</a>
              </div>
          </div>
      </div>
  </div>

    <hr>

    <div class="container">
      <div class="row">
        
          <div class="col-md-8">
          <form id="form-cek-ongkir" method="POST">
            <!-- Formulir informasi pengiriman -->     
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Informasi Penerima</h5>
                  <div class="mb-3">
                    <label for="inputNama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="inputNama" name="inputNama" placeholder="Masukkan Nama">
                  </div>
                  <div class="mb-3">
                    <label for="inputTelepon" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" id="inputTelepon" name="inputTelepon" placeholder="Masukkan Nomor Telepon">
                  </div>
                  <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Masukkan Email">
                  </div>
                  <!-- Pengisian Alamat Dan Cek Ongkir -->
                  <div class="mb-3">
                    <label for="kota_tujuan" class="form-label">Kota Tujuan</label>
                    <select name="kota_tujuan" id="kota_tujuan" class="form-control">
                      <option value="">Masukan kota tujuan</option>
                      <?php foreach($kota_array['rajaongkir']['results'] as $key => $value): ?>
                        <option value="<?= $value['city_id']; ?>"><?= $value['city_name'];?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <!-- Akhiran Alamat -->
                  <div class="mb-3">
                    <label for="inputAlamat" class="form-label">Alamat Lengkap</label>
                    <input type="text" class="form-control" id="inputAlamat" name="inputAlamat" placeholder="Masukkan Alamat Penerima">
                  </div>
                    <input type="submit" value="Bayar" class="btn btn-primary" id="btn-periksa-ongkir">
              </div>
            </div>
            </form>
            <!-- Bagian formulir -->
          </div>
          <div class="col-md-4">
            <!-- Informasi barang yang ingin dibeli -->
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Informasi Barang</h5>
                <!-- Show Items -->
                <?php 
                global $con;
                $total_price = 0;
                $get_ip_add = getIPAddress();
                $cart_query = "SELECT cart_details.*, products.product_price, products.product_title, products.product_image1 FROM cart_details
                              JOIN products ON cart_details.product_id = products.product_id
                              WHERE cart_details.ip_address = '$get_ip_add'";
                $result_query = mysqli_query($con, $cart_query);
                $num_of_rows = mysqli_num_rows($result_query);
                ?>
                <div class="cart-items">
                  <?php mysqli_data_seek($result_query, 0); // Reset the result pointer ?>
                  <?php while ($row = mysqli_fetch_array($result_query)) {
                      $product_id = $row['product_id'];
                      $formatted_price = number_format($row['product_price'], 0, '.', '.');
                      $product_title = $row['product_title'];
                      $product_image1 = $row['product_image1'];
                      $product_quantity = $row['quantity'];
                      $product_values = $row['product_price'] * $product_quantity;
                      $total_price += $product_values;
                      $formatted_total_price = number_format($total_price, 0, '.', '.');
                      ?>
                      <!-- Item -->
                      <hr>
                      <div class="cart-item">
                          <img src="assets/img/product_images/<?php echo $product_image1 ?>" alt="<?php echo $product_title ?>" class="item-image">
                          <div class="item-details">
                              <h6 class="item-name"><?php echo $product_title ?> : Rp <?php echo $formatted_price ?></h6>                         
                              <p class="item-quantity">Total Item: <?php echo $product_quantity; ?></p>
                              <p class="item-price">Price Product : Rp <?php echo number_format($product_values, 0, '.', '.'); ?></p>
                          </div>
                      </div>
                  <?php } ?>
                  <p class="item-price">Total Price : Rp <?php echo $formatted_total_price ?></p>
                  <!-- Add more items here -->
                </div>
              </div>
            </div>
          </div>
    </div>
  </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>
</html>
