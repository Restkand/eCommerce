<?php 
include('includes/connect.php');
include('functions/common_function.php');
include('functions/details_product_function.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=`, initial-scale=1.0">
    <link rel="stylesheet" href="assets/CSS/menuBelanja.css">
    <link rel="stylesheet" href="assets/CSS/details_product.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <title>Produk | LOGO</title>
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
                  <a href="#" class="shop-icon" >
                      <img src="assets/img/fluent-mdl2_shop.png" alt="shop logo">
                  </a>
              </div>
          </div>
          <div class="row">
              <div class="col nav-item text-center">
                  <a href="products.php" class="activeNav">PRODUK</a>
                  <a href="#">PRELOVED</a>
                  <a  href="#">CARI LOKASI TOKO</a>
                  <a href="#">TENTANG KAMI</a>
              </div>
          </div>
      </div>
  </div>

  <hr>

  <!-- All content inside in the middle -->
  <div class="content">
    <?php
      detailsProduct()
    ?>
  </div>
  
  <footer>
    <div class="foot-info">
      <div class="container">
        <div class="row py-auto">
          <div class="col-6 offset-2">
            <h1>LOGO</h1>
          </div>
          <div class="col-4">
            <h1>Social Media</h1>
          </div>
        </div>
      </div>
    </div>
  </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>