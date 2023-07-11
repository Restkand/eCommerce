<?php 
include('includes/connect.php');
include('includes/footer.php');
include('functions/common_function.php');

$viewport_width = "<script>document.write(window.innerWidth || document.documentElement.clientWidth);</script>";
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
    <link rel="stylesheet" href="assets/CSS/about_us.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <title>Cek Pesanan | meonthrift</title>
    <style>
            @media (max-width: 990px) {
        #slideshow {
            display: none;
        }
    }

    .iframe-container {
    width: 80%;
    padding-bottom: 40%; /* Mengatur tinggi sesuai rasio lebar-ke-tinggi yang diinginkan */
    position: relative;
    overflow: hidden;
    }

    .iframe-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
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
                  <a  href="cek_pesanan.php" >CEK PESANAN</a>
                  <a href="about_us.php" class="activeNav">TENTANG KAMI</a>
              </div>
          </div>
      </div>
  </div>

    <!-- cart Function -->
    <?php 
    cart();
    ?>

  <hr>
    <div class="secondPages">
        <div class="container">
            <div class="row">
                <div class="offset-lg-1 col-lg-5 col-md-12">
                    <h1>At meonthrift<br><br>Our mission is to create a platform that connects individuals who want to buy and sell pre-loved items in a safe and convenient way.<br><br>We believe in promoting sustainability by giving items a second chance and reducing waste.</h1>
                </div>
                <?php if ($viewport_width > 768){ ?>
                <div class="col-md-6 slideAu" id="slideshow">
                    <img src="assets/img/about_us1.jpg" alt="Slide AU 1">
                    <img src="assets/img/about_us2.jpg" alt="Slide AU 2">
                    <img src="assets/img/about_us3.jpg" alt="Slide AU 3">
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="fifthPages">
        <div class="container">
            <div class="row">
                <div class="offset-1 col-xl-12">
                    <div class="iframe-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d247.90449225328788!2d106.95172667665295!3d-6.201310024886833!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698b70ec0707cb%3A0x623e17abd7b248b2!2sJl.%20PG%20Indah%20Blok%20J12%20No.25%2C%20RT.8%2FRW.6%2C%20Pulo%20Gebang%2C%20Kec.%20Cakung%2C%20Kota%20Jakarta%20Timur%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2013950!5e0!3m2!1sen!2sid!4v1686833032847!5m2!1sen!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>        
                </div>
            </div>
            <div class="row">
                <div class="offset-lg-1 col-xxl-5 col-xl-12 visitus">
                    <br>
                    <h1>Our Place</h1>
                    <p>Jl. PG Indah Blok J12 No.25, RT.8/RW.6, Pulo Gebang, Kec. Cakung, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13950</p>
                    <p>You can see us too from our<br> Social Media <a href="https://www.instagram.com/meonthrift/" target="_blank">meontrhift</a></p>
                </div>
            </div>
        </div>
    </div>
  
    <!-- Footer -->
    <?php 
        footer()
    ?>

    <script>
    var currentSlide = 0;
    var currentSlideCoffe = 0;
    var slideIndex = 0;
    // SlideShow PagesSecondImage
    var slides = document.querySelectorAll("#slideshow img");
    var slideCount = slides.length;
    // SlideShow PagesThirdImage
    var slidesCoffee = document.querySelectorAll("#slideshowCoffee img");
    var slideCountCoffee = slidesCoffee.length;



    function gantiSlideAbout_Us() {
        slides[currentSlide].style.opacity = 0;
        currentSlide = (currentSlide + 1) % slideCount;
        slides[currentSlide].style.opacity = 1;
    }

    function gantiSlideCoffee() {
        slidesCoffee[currentSlideCoffe].style.opacity = 0;
        currentSlideCoffe = (currentSlideCoffe + 1) % slideCountCoffee;
        slidesCoffee[currentSlideCoffe].style.opacity = 1;
    }


    setInterval(gantiSlideAbout_Us, 7000);
    setInterval(gantiSlideCoffee, 5500);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
