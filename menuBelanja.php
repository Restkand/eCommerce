<?php 
include('includes/connect.php');
include('functions/common_function.php')

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=`, initial-scale=1.0">
    <link rel="stylesheet" href="assets/CSS/menuBelanja.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
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
                  <a href="menuBelanja.php" class="activeNav">BELANJA</a>
                  <a href="#">HUBUNGI KAMI</a>
                  <a  href="#">CARI LOKASI TOKO</a>
                  <a href="#">TENTANG KAMI</a>
              </div>
          </div>
      </div>
  </div>

  <hr>

  <!-- All content inside in the middle -->
  <div class="content">
    <div class="container">
        <!-- Title Produk -->
      <div class="row">
        <div class="col-12 text-center">
          <h3>Produk</h3>
        </div>
      </div>
      
      <!-- Sort for Produk -->
      <div class="row">
        <hr>
        <div class="col-sm-4 mb-4">
          <!-- <label for="option1">Kategori : </label> -->
          <?php
            select_category();
          ?>
        </div>
        <div class="col-sm-4 mb-4">
          <!-- <label for="option2">Brand :</label> -->
            <?php
            select_brand();
            ?>
          </select>
        </div>
        <div class="col-sm-4 mb-4">
          <!-- <label for="option3">Label 3:</label> -->
          <select id="option3" class="form-control">
            <option value="option3">Option 3</option>
            <!-- Add more options here -->
          </select>
        </div>
        <hr>
      </div>

        <!-- Cardbox Group 1 -->
      <div class="row justify-content-center card-row">
      <!-- Fetching Products -->
      <?php 
        get_products();
        get_uniqe_categories()
      ?>

      
      <!-- Cardbox Group 2 -->
      <div class="row justify-content-center card-row">
        <div class="col-md-3">
          <div class="cardbox-group">
            <div class="card" style="width: 18rem;">
              <img src="..." class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
          </div>
        </div>
      <div class="col-md-3">
        <div class="cardbox-group">
          <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="cardbox-group">
          <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
        </div>
      </div>
      </div>
      <div class="row btn-selengkapnya">
        <div class="col-12 text-center">
          <button type="button" class="btn btn-secondary"><a href="menuBelanja.php">Lihat Semua</a></button>
        </div>
      </div>
    </div>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
