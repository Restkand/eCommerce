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
    <link rel="icon" href="assets/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/CSS/main.css">
    <link rel="stylesheet" href="assets/CSS/menuBelanja.css">
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
                  <a href="products.php" class="activeNav">PRODUK</a>
                  <a  href="cek_pesanan.php" class="activeNav">CEK PESANAN</a>
                  <a href="about_us.php">TENTANG KAMI</a>
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
            select_brands();
          ?>
        </div>
        <div class="col-sm-4 mb-4">
          <!-- <label for="option2">Brand :</label> -->
            <?php
              select_gender();
            ?>
          </select>
        </div>
        <div class="col-sm-4 mb-4">
          <!-- <label for="option3">Label 3:</label> -->
          <div class="input-group">
            <form class="d-flex" action="" method="get">
            <input type="text" id="option3" class="form-control" placeholder="Search" name="search_data">
            <button class="btn btn-outline-secondary" type="submit" value="Search" name="search_data_product">
              <i class="fas fa-search"></i>
            </button>
            </form>
          </div>
        </div>
        <hr>
      </div>

        <!-- Cardbox Group 1 -->
      <div class="row justify-content-center card-row">
      <!-- Fetching Products -->
      <?php 
        search_retail_product();
        get_uniqe_retail_brands();
        get_uniqe_retail_genders();
      ?>

  </div>
  
    <!-- Footer -->
    <?php 
        footer()
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>