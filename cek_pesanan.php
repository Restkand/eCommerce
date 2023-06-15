<?php 
include('includes/connect.php');
include('includes/footer.php');
include('functions/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=`, initial-scale=1.0">
    <link rel="stylesheet" href="assets/CSS/main.css">
    <link rel="stylesheet" href="assets/CSS/menuBelanja.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <title>Cek Pesanan | meonthrift</title>
    <style>
    .container-searcher {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      height: 80%;
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .btn-primary {
      width: 100%;
    }

    #searchResults {
      margin-top: 30px;
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
                  <a  href="cek_pesanan.php" class="activeNav">CEK PESANAN</a>
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

  <div class="container container-searcher">
    <h1>Pencarian Pesanan</h1>
    <form action="" method="get">
      <div class="form-group">
        <label for="invoiceNumber">Invoice Number:</label>
        <input type="text" id="search_order" class="form-control" placeholder="INV-123456789" name="search_order" required>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary" value="Search" name="search_data_order">Cari Pesanan</button>
      </div>
    </form>
    <?php 
      search_invoice_order();
    ?>
  </div>
  
    <!-- Footer -->
    <?php 
        footer()
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
