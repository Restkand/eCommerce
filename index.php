<?php 
include('includes/connect.php');
include('includes/footer.php');
include('functions/common_function.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=`, initial-scale=1.0">
    <link rel="stylesheet" href="assets/CSS/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <title>Trial Three</title>
</head>
<body>

  <!-- NAVBAR -->
  <div class="nav">
      <div class="container">
          <!-- Logo -->
          <div class="row">
              <div class="col-10 offset-1 text-center">
                      <h1><a class="navbar-brand" href="#">LOGO</a></h1>
              </div>
              <div class="col-1">
                <?php 
                  cart_item();
                ?>
              </div>
          </div>
          <div class="row">
              <div class="col nav-item text-center">
                  <a href="products.php" class="link">PRODUK</a>
                  <a href="#">PRELOVED</a>
                  <a  href="#">CARI LOKASI TOKO</a>
                  <a href="#">TENTANG KAMI</a>
              </div>
          </div>
      </div>
  </div>

  <!-- Slide Carousel -->
  <div class="carousel">
      <div id="carouselExampleFade" class="carousel carousel-dark slide carousel-fade " data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="assets/img/Banner.png" class="d-block w-100" alt="Banner">
            </div>
            <div class="carousel-item">
              <img src="assets/img/Banner2.png" class="d-block w-100" alt="Banner2">
            </div>
            <div class="carousel-item">
              <img src="assets/img/Banner3.png" class="d-block w-100" alt="Banner3">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
  </div>

  <!-- All content inside in the middle -->
  <div class="content">
    <div class="container">
        <!-- Title New Arrivals -->
      <div class="row">
        <div class="col-12 text-center">
          <h1>NEW ARRIVALS!!</h1>
        </div>
      </div>
        <!-- Cardbox Group 1 -->
      <div class="row justify-content-center card-row">
        <!-- Fetching Products -->
        <?php 
          get_products();
          get_uniqe_categories();
        ?>
      </div>
      <div class="row btn-selengkapnya">
        <div class="col-12 text-center">
          <button type="button" class="btn btn-secondary"><a href="products.php" class="link">Lihat Semua</a></button>
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