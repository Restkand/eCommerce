<?php

// Including Connect File
include('./includes/connect.php');


// Displaying Images when View More the Product
function generateProductViewer(){
    $productImages = array(
      'image1.jpg',
      'image2.jpg',
      'image3.jpg',
      // Add more image filenames here
  );
  
  if (isset($_GET['image'])) {
      $selectedImage = $_GET['image'];
      if (in_array($selectedImage, $productImages)) {
          echo '<img src="' . $selectedImage . '" alt="Product Image" class="product-image active">';
      } else {
          echo 'Invalid image selection.';
      }
  } else {
      foreach ($productImages as $image) {
          echo '<a href="?image=' . $image . '">';
          echo '<img src="' . $image . '" alt="Product Image" class="product-image">';
          echo '</a>';
      }
  }
  
  echo '<script>
          const productImages = document.querySelectorAll(".product-image");
          productImages.forEach(image => {
              image.addEventListener("click", function() {
                  productImages.forEach(img => img.classList.remove("active"));
                  this.classList.add("active");
              });
          });
      </script>';
  }
  
  
  
  function detailsProduct(){
    global $con;
  
    // Condition if Isset or Not
    if(isset($_GET['product_id'])){
      if(!isset($_GET['brand'])){
        if(!isset($_GET['gender'])){
          $product_id = $_GET['product_id'];
          $select_query = "SELECT * FROM products where product_id=$product_id";;
          $result_query = mysqli_query($con, $select_query);
          // $row = mysqli_fetch_assoc($result_query);
          // echo $row['product_title'];

          $select_detailsQuery = "SELECT * FROM detail_products where product_id=$product_id";;
          $result_detailsQuery = mysqli_query($con, $select_detailsQuery);
          while($row = mysqli_fetch_assoc($result_detailsQuery)){
            $product_size = $row['size'];
            $product_lebar = $row['lebar'];
            $product_panjang = $row['panjang'];
            $product_kondisi = $row['product_condition'];
          }

          while($row = mysqli_fetch_assoc($result_query)){
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_kode = $row['kode_produk'];
            $product_desc = $row['product_desc'];
            $product_image1 = $row['product_image1'];
            $product_image2 = $row['product_image2'];
            $product_image3 = $row['product_image3'];
            $product_price = $row['product_price'];
            $formatted_price = number_format($product_price, 0, ',','.');
            $brand_id = $row['brand_id'];
            $gender_id = $row['gender_id'];
            $sold_out = $row['sold_out'];

            $select_brandQuery = "SELECT * FROM brands where brand_id=$brand_id";;
            $result_brandQuery = mysqli_query($con, $select_brandQuery);
            while($row = mysqli_fetch_assoc($result_brandQuery)){
                $brand_title = $row['brand_title'];
            }

            $select_genderQuery = "SELECT * FROM genders where gender_id=$gender_id";;
            $result_genderQuery = mysqli_query($con, $select_genderQuery);
            while($row = mysqli_fetch_assoc($result_genderQuery)){
                $product_gender = $row['gender_product'];
            }


            if($sold_out == false){
                // Output the HTML and JavaScript code using echo
                echo '<div class="container">
                <div class="row">
                    <div class="col-lg-12 col-xl-4 offset-xl-2">
                        <img src="assets/img/product_images/'.$product_image1.'" alt="Product Image" class="product-image" id="mainImage">
                    </div>
                    <div class="col-lg-12 col-xl-6">
                        <h2 class="mb-3">'.$product_title.'</h2>
                        <p class="mb-2">Deskripsi Produk:</p>
                        <p class="" style="margin-bottom:0;">Kode Produk : '. $product_kode .'</p>
                        <p class="" style="margin-bottom:0;">Gender : '. $product_gender .'</p>
                        <p class="" style="margin-bottom:0;">Brand : '. $brand_title .'</p>
                        <p class="" style="margin-bottom:0;">Size : '. $product_size .'</p>
                        <p class="" style="margin-bottom:0;">Lebar : '. $product_lebar .'cm</p>
                        <p class="" style="margin-bottom:0;">Panjang : '. $product_panjang .'cm</p>
                        <p class="mb-3">Kondisi : '. $product_kondisi .'</p>
                        
                        <p class="mb-3">'.$product_desc.'</p>
                        <p class="mb-3">RP '.$formatted_price.'</p>
                        <a href="products.php?add_to_cart='.$product_id.'"><button class="btn btn-secondary add-to-cart-button">Masukan Ke Keranjang</button></a>
                    </div>
                </div>';

                if (!empty($product_image2) && !empty($product_image3)) {
                    echo '<div class="row mt-4">
                        <div class="col-lg-12 col-xl-4 offset-2">
                            <div class="d-flex flex-wrap">
                                <img src="assets/img/product_images/'.$product_image1.'" alt="Product Image" class="thumbnail-image active" onclick="changeImage(\'assets/img/product_images/'.$product_image1.'\')">
                                <img src="assets/img/product_images/'.$product_image2.'" alt="Product Image" class="thumbnail-image" onclick="changeImage(\'assets/img/product_images/'.$product_image2.'\')">
                                <img src="assets/img/product_images/'.$product_image3.'" alt="Product Image" class="thumbnail-image" onclick="changeImage(\'assets/img/product_images/'.$product_image3.'\')">
                            </div>
                        </div>
                    </div>';
                } elseif (!empty($product_image2)) {
                    echo '<div class="row mt-4">
                        <div class="col-lg-12 col-xl-4 offset-2">
                            <div class="d-flex flex-wrap">
                                <img src="assets/img/product_images/'.$product_image1.'" alt="Product Image" class="thumbnail-image active" onclick="changeImage(\'assets/img/product_images/'.$product_image1.'\')">
                                <img src="assets/img/product_images/'.$product_image2.'" alt="Product Image" class="thumbnail-image" onclick="changeImage(\'assets/img/product_images/'.$product_image2.'\')">
                            </div>
                        </div>
                    </div>';
                } elseif (!empty($product_image3)) {
                    echo '<div class="row mt-4">
                        <div class="col-xl-4 offset-2">
                            <div class="d-flex flex-wrap">
                                <img src="assets/img/product_images/'.$product_image1.'" alt="Product Image" class="thumbnail-image active" onclick="changeImage(\'assets/img/product_images/'.$product_image1.'\')">
                                <img src="assets/img/product_images/'.$product_image3.'" alt="Product Image" class="thumbnail-image" onclick="changeImage(\'assets/img/product_images/'.$product_image3.'\')">
                            </div>
                        </div>
                    </div>';
                } else {
                    echo '<div class="row mt-4">
                        <div class="col-xl-4 offset-2">
                            <div class="d-flex flex-wrap">
                                <img src="assets/img/product_images/'.$product_image1.'" alt="Product Image" class="thumbnail-image active" onclick="changeImage(\'assets/img/product_images/'.$product_image1.'\')">
                            </div>
                        </div>
                    </div>';
                }
            }

            else{
                echo '<div class="container">
                <div class="row">
                <div class="col-lg-4 offset-2">
                <img src="assets/img/product_images/'.$product_image1.'" alt="Product Image" class="product-image" id="mainImage">
                </div>
                <div class="col-md-6 d-flex align-items-center justify-content-center">
                    <h2 class="mb-3">Sorry, Product SOLD OUT!</h2>
                </div>
                </div>';
            }

          echo '<script>
          window.addEventListener(\'DOMContentLoaded\', function() {
              var mainImage = document.getElementById(\'mainImage\');
              mainImage.style.width = "370px";
              mainImage.style.height = "370px";
          });

          function changeImage(imageUrl) {
              var mainImage = document.getElementById(\'mainImage\');
              mainImage.src = imageUrl;
              mainImage.style.width = "370px";
              mainImage.style.height = "370px";

              var thumbnailImages = document.getElementsByClassName(\'thumbnail-image\');
              for (var i = 0; i < thumbnailImages.length; i++) {
                  thumbnailImages[i].classList.remove(\'active\');
              }
              this.classList.add(\'active\');
          }
          </script>';
          }
        }
      }
    }
  }
  
?>