<?php
session_start();


if(!isset($_SESSION["login"])){
    header("Location: login_admin.php");
    exit;
}

include('../includes/connect.php');
require_once('../PDF/vendor/autoload.php');


global $con;
?>

<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="icon" href="../assets/favicon/favicon.ico" type="image/x-icon">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <style>
    .container {
      margin-top: 50px;
    }
    .table {
      margin-top: 20px;
    }
    .form-group {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>



<div class="d-flex justify-content-center mt-5">
  <div class="text-center">
    <h1>Jurnal Penjualan</h1>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-6">
      <form method="POST" action="">
        <div class="form-row">
          <div class="col">
            <label for="start_date">Tanggal Mulai:</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
          </div>
          <div class="col">
            <label for="end_date">Tanggal Akhir:</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
          </div>
        </div>
        <button type="submit" name="submit" class="btn btn-primary mt-2">Tampilkan</button>
      </form>
    </div>
  </div>

  <?php
  // Cek apakah form dikirimkan
  if(isset($_POST['submit'])) {
    // Ambil tanggal dari form
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Query SQL dengan tanggal yang dipilih
    $sql = "SELECT p.product_id, p.product_title, p.product_price, cd.date_checkout
            FROM products AS p
            INNER JOIN checkout_details AS cd ON p.product_id = cd.product_id
            WHERE cd.status_checkout = 'Pesanan di Terima' AND cd.date_checkout BETWEEN '$start_date' AND '$end_date'
            GROUP BY p.product_id, p.product_title, p.product_price
            ORDER BY cd.date_checkout";

    // Eksekusi query
    $result = mysqli_query($con, $sql);
  }
  ?>

  <!-- Tabel hasil rekapitulasi data -->
  <?php if(isset($result) && mysqli_num_rows($result) > 0): ?>
    <div class="row">
      <div class="col-md-12">
        <table class="table">
          <thead>
            <tr>
              <th>Tanggal</th>
              <th>Product ID</th>
              <th>Product Title</th>
              <th>Harga</th>
            </tr>
          </thead>
          <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
              <tr>
                <?php
                 $date_checkout = $row['date_checkout'];
                 $date_checkout = date('d/m/Y', strtotime($date_checkout));
                 ?>
                <td><?php echo $date_checkout; ?></td>
                <td><?php echo $row['product_id']; ?></td>
                <td><?php echo $row['product_title']; ?></td>
                <td><?php echo $row['product_price']; ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3" style="text-align: right;"><strong>Total Penjualan:</strong></td>
              <td>
                <?php
                mysqli_data_seek($result, 0);
                $total_product_price = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                  $total_product_price += $row['product_price'];
                }
                echo $total_product_price;
                ?>
              </td>
            </tr>
          </tfoot>
        </table>
        <form method="POST" action="jurnalMasukan_pdf.php">
          <input type="hidden" name="start_date" value="<?php echo $start_date; ?>">
          <input type="hidden" name="end_date" value="<?php echo $end_date; ?>">
          <button type="submit" name="generate_pdf" class="btn btn-primary">Export to PDF</button>
        </form>
      </div>
    </div>
  <?php else: ?>
    <div class="row">
      <div class="col-md-12">
        <p>Tidak ada data yang tersedia.</p>
      </div>
    </div>
  <?php endif; ?>
  <a href="index.php" class="btn btn-secondary justify-content-start mt-3">Back</a> 
</div>
</body>
</html>