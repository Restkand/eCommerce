<?php

// Including Connect File
include('./includes/connect.php');

// getting products 
function get_products(){
        global $con;

        // Condition if Isset or Not
        if(!isset($_GET['category'])){
          if(!isset($_GET['gender'])){
            $select_query = "SELECT * FROM products ORDER BY product_id DESC LIMIT 6";
            $result_query = mysqli_query($con, $select_query);
            // $row = mysqli_fetch_assoc($result_query);
            // echo $row['product_title'];
            while($row = mysqli_fetch_assoc($result_query)){
              $product_id = $row['product_id'];
              $product_title = $row['product_title'];
              $product_desc = $row['product_desc'];
              $product_image1 = $row['product_image1'];
              $product_price = $row['product_price'];
              $formatted_price = number_format($product_price, 0, ',','.');
              $category_id = $row['category_id'];
              $gender_id = $row['gender_id'];
              echo 
              "
                  <div class='col-md-3'>
                    <div class='cardbox-group'>
                      <div class='card border-0' style='width: 18rem;'>
                      <a href='#'>
                        <img src='assets/img/product_images/$product_image1' class='card-img-top' alt='...'>
                        <div class='card-body'>
                          <h5 class='card-title'>$product_title</h5>
                          <p>$formatted_price</p>
                        </div>
                      </a>
                      </div>
                    </div>
                  </div>  
              ";
            }
          }
        }
    }

function get_uniqe_categories(){
  if(isset($_GET['category'])){
    $category_id = $_GET['category'];

    global $con;
    $select_query = "SELECT * FROM products where category_id = $category_id";
    $result_query = mysqli_query($con, $select_query);
    // $row = mysqli_fetch_assoc($result_query);
    // echo $row['product_title'];
    while($row = mysqli_fetch_assoc($result_query)){
      $product_id = $row['product_id'];
      $product_title = $row['product_title'];
      $product_desc = $row['product_desc'];
      $product_image1 = $row['product_image1'];
      $product_price = $row['product_price'];
      $formatted_price = number_format($product_price, 0, ',','.');
      $category_id = $row['category_id'];
      $gender_id = $row['gender_id'];
      echo 
      "
          <div class='col-md-3'>
            <div class='cardbox-group'>
              <div class='card border-0' style='width: 18rem;'>
              <a href='#'>
                <img src='assets/img/product_images/$product_image1' class='card-img-top' alt='...'>
                <div class='card-body'>
                  <h5 class='card-title'>$product_title</h5>
                  <p>$formatted_price</p>
                </div>
              </a>
              </div>
            </div>
          </div>  
      ";
    }
  }
}



// Select for the Sort Things in menuBelanja
function select_category(){
  global $con;
  echo "<select name='product_categories' id='' class='form-control product_category'>";
  $select_query = "SELECT * FROM categories";
  $result_query = mysqli_query($con, $select_query);
  echo "<option value='0'>Semua Kategori</option>";
  while ($row = mysqli_fetch_assoc($result_query)) {
      $category_title = $row['category_title'];
      $category_id = $row['category_id'];
      $selected = isset($_GET['category']) && $_GET['category'] == $category_id ? 'selected' : '';
      echo "<option value='$category_id' $selected>$category_title</option>";
  }
  echo "</select>";
  
  echo "<script>
      // Redirect to the selected category's URL when the selection changes
      document.querySelector('.product_category').addEventListener('change', function() {
          var category_id = this.value;
          if (category_id !== '0') {
              window.location.href = 'products.php?category=' + encodeURIComponent(category_id);
          } else {
              window.location.href = 'products.php'; // Redirect to the default URL when 'Semua Kategori' is selected
          }
      });
  </script>";  
}


function select_gender(){
  global $con;
  echo "<select name='product_genders' id='' class='form-control product_gender'>";
  $select_query = "SELECT * FROM genders";
  $result_query = mysqli_query($con, $select_query);
  echo "<option value='0'>Semua Gender</option>";
  while ($row = mysqli_fetch_assoc($result_query)) {
      $gender_product = $row['gender_product'];
      $gender_id = $row['gender_id'];
      echo "<option value='$gender_id'>$gender_product</option>";
  }
  echo "</select>";
}
?>