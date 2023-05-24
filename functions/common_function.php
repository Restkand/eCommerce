<?php

// Including Connect File
include('./includes/connect.php');

// getting products 
function get_products(){
        global $con;
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
          $brand_id = $row['brand_id'];
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



?>