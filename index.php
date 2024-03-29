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
    <link rel="stylesheet" href="assets/CSS/main.css">
    <link rel="icon" href="assets/favicon/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <title>meonthrift - Toko Fashion Preloved Terbaik dengan Harga Terjangkau </title>
    <meta name="description" content="Cari gaya unik dan eksklusif? Meonthrift adalah jawabannya. Sajikan penampilan yang stylish tanpa harus menguras dompet Anda.">
    <meta name="keywords" content="meonthrift, fashion preloved, gaya unik, eksklusif, stylish, harga terjangkau">
    <meta name="author" content="Meonthrift">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="J5UMjEkj7sgsRJCsXa1n456RY1hUh9j4EWQGrCK1Iao" />
    <style>
    .carousel-item img {
      object-fit: contain;
      height: auto;
      max-height: 480px; /* Adjust the desired height here */
      max-width: 100%;
    }
    
    .card-img-top {
    width: 90%;
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
                  <a href="products.php" class="link">PRODUK</a>
                  <a  href="cek_pesanan.php" class="activeNav">CEK PESANAN</a>
                  <a href="return_product.php">RETURN</a>
                  <a href="about_us.php">TENTANG KAMI</a>
              </div>
          </div>
      </div>
  </div>

  <!-- Slide Carousel -->
  <div class="carousel">
      <div id="carouselExampleFade" class="carousel carousel-dark slide carousel-fade " data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="assets/img/Banner1_meonthrift.png" class="d-block w-100" alt="Banner">
            </div>
            <div class="carousel-item">
              <img src="assets/img/Banner2_meonthrift.png" class="d-block w-100" alt="Banner2">
            </div>
            <!-- <div class="carousel-item">
              <img src="assets/img/Banner3.png" class="d-block w-100" alt="Banner3">
            </div> -->
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
        <div class="col-md-12 text-center">
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
        <div class="col-md-12 text-center">
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