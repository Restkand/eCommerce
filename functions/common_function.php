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
                      <a href='product_details.php?product_id=$product_id'>
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

function get_product_retail(){
  global $con;

    // Condition if Isset or Not
    if(!isset($_GET['brand'])){
      if(!isset($_GET['gender'])){
        $select_query = "SELECT * FROM products where category_id = 5";;
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
          $brand_id = $row['brand_id'];
          $gender_id = $row['gender_id'];
          echo 
          "
              <div class='col-md-3'>
                <div class='cardbox-group'>
                  <div class='card border-0' style='width: 18rem;'>
                  <a href='product_details.php?product_id=$product_id'>
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
              <a href='product_details.php?product_id=$product_id'>
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

function get_uniqe_retail_brands(){
  if(isset($_GET['brand'])){
    $brand_id = $_GET['brand'];

    global $con;
    $select_query = "SELECT * FROM products where category_id = 5 AND brand_id = $brand_id";
    $result_query = mysqli_query($con, $select_query);
    $num_of_rows=mysqli_num_rows($result_query);
    if($num_of_rows == 0){
      echo "<h2 class='text-center mt-3'>No Stock For This Brand</h2>";
    }
    
    // $row = mysqli_fetch_assoc($result_query);
    // echo $row['product_title'];
    while($row = mysqli_fetch_assoc($result_query)){
      $product_id = $row['product_id'];
      $product_title = $row['product_title'];
      $product_desc = $row['product_desc'];
      $product_image1 = $row['product_image1'];
      $product_price = $row['product_price'];
      $formatted_price = number_format($product_price, 0, ',','.');
      $brand_id = $row['brand_id'];
      $gender_id = $row['gender_id'];
      echo 
      "
          <div class='col-md-3'>
            <div class='cardbox-group'>
              <div class='card border-0' style='width: 18rem;'>
              <a href='product_details.php?product_id=$product_id'>
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

function get_uniqe_retail_genders(){
  if(isset($_GET['gender'])){
    $gender_id = $_GET['gender'];

    global $con;
    $select_query = "SELECT * FROM products where category_id = 5 AND gender_id = $gender_id";
    $result_query = mysqli_query($con, $select_query);
    $num_of_rows=mysqli_num_rows($result_query);
    if($num_of_rows == 0){
      echo "<h2 class='text-center mt-3'>No Stock For This Gender</h2>";
    }
    // $row = mysqli_fetch_assoc($result_query);
    // echo $row['product_title'];
    while($row = mysqli_fetch_assoc($result_query)){
      $product_id = $row['product_id'];
      $product_title = $row['product_title'];
      $product_desc = $row['product_desc'];
      $product_image1 = $row['product_image1'];
      $product_price = $row['product_price'];
      $formatted_price = number_format($product_price, 0, ',','.');
      $brand_id = $row['brand_id'];
      $gender_id = $row['gender_id'];
      echo 
      "
          <div class='col-md-3'>
            <div class='cardbox-group'>
              <div class='card border-0' style='width: 18rem;'>
              <a href='product_details.php?product_id=$product_id'>
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
  echo "<select name='product_gender' id='' class='form-control product_gender'>";
  $select_query = "SELECT * FROM genders";
  $result_query = mysqli_query($con, $select_query);
  echo "<option value='0'>Semua Produk (Gender)</option>";
  while ($row = mysqli_fetch_assoc($result_query)) {
      $gender_title = $row['gender_product'];
      $gender_id = $row['gender_id'];
      $selected = isset($_GET['gender']) && $_GET['gender'] == $gender_id ? 'selected' : '';
      echo "<option value='$gender_id' $selected>$gender_title</option>";
  }
  echo "</select>";
  
  echo "<script>
      // Redirect to the selected gender's URL when the selection changes
      document.querySelector('.product_gender').addEventListener('change', function() {
          var gender_id = this.value;
          if (gender_id !== '0') {
              window.location.href = 'products.php?gender=' + encodeURIComponent(gender_id);
          } else {
              window.location.href = 'products.php'; // Redirect to the default URL when 'Semua Gender' is selected
          }
      });
  </script>";  
}


function select_brands(){
  global $con;
  echo "<select name='product_brand' id='' class='form-control product_brand'>";
  $select_query = "SELECT * FROM brands";
  $result_query = mysqli_query($con, $select_query);
  echo "<option value='0'>Semua Brands</option>";
  while ($row = mysqli_fetch_assoc($result_query)) {
      $brand_title = $row['brand_title'];
      $brand_id = $row['brand_id'];
      $selected = isset($_GET['brand']) && $_GET['brand'] == $brand_id ? 'selected' : '';
      echo "<option value='$brand_id' $selected>$brand_title</option>";
  }
  echo "</select>";
  
  echo "<script>
      // Redirect to the selected brand's URL when the selection changes
      document.querySelector('.product_brand').addEventListener('change', function() {
          var brand_id = this.value;
          if (brand_id !== '0') {
              window.location.href = 'products.php?brand=' + encodeURIComponent(brand_id);
          } else {
              window.location.href = 'products.php'; // Redirect to the default URL when 'Semua Brand' is selected
          }
      });
  </script>";  
}

// Search Function
function search_retail_product(){
  global $con;

    // Condition if Isset or Not
        if(isset($_GET['search_data_product'])){
        $search_data_value = $_GET['search_data'];
        $select_query = "SELECT * FROM products where category_id = 5 AND product_keywords LIKE '%$search_data_value%' OR product_title LIKE '%$search_data_value%'";;
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows=mysqli_num_rows($result_query);
        if($num_of_rows == 0){
          echo "<h2 class='text-center mt-3'>No Results Match</h2>";
        }
        // $row = mysqli_fetch_assoc($result_query);
        // echo $row['product_title'];
        while($row = mysqli_fetch_assoc($result_query)){
          $product_id = $row['product_id'];
          $product_title = $row['product_title'];
          $product_desc = $row['product_desc'];
          $product_image1 = $row['product_image1'];
          $product_price = $row['product_price'];
          $formatted_price = number_format($product_price, 0, ',','.');
          $brand_id = $row['brand_id'];
          $gender_id = $row['gender_id'];
          echo 
          "
              <div class='col-md-3'>
                <div class='cardbox-group'>
                  <div class='card border-0' style='width: 18rem;'>
                  <a href='product_details.php?product_id=$product_id'>
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

// PHP Function get IP Address
function getIPAddress() {
  // Check for shared internet/ISP IP
  if (!empty($_SERVER['HTTP_CLIENT_IP']) && filter_var($_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
      return $_SERVER['HTTP_CLIENT_IP'];
  }
  
  // Check for a proxy IP
  if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']) && filter_var($_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
      return $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  
  // Check for a remote IP
  if (!empty($_SERVER['REMOTE_ADDR']) && filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) {
      return $_SERVER['REMOTE_ADDR'];
  }
  // Return the default IP
  return 'Unknown';
}
// Usage example
// $ipAddress = getIPAddress();
// echo "Your IP address is: " . $ipAddress;


// Function for the Cart
function cart(){
  if(isset($_GET['add_to_cart'])){
    global $con;
    $get_ip_add = getIPAddress();
    $get_product_id= $_GET['add_to_cart'];
    $select_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_add' AND product_id=$get_product_id";
    $result_query = mysqli_query($con,$select_query);
    $num_of_rows=mysqli_num_rows($result_query);
    if($num_of_rows > 0){
      echo "<script>alert('Produk sudah ada di dalam keranjang')</script>";
      echo "<script>window.open('products.php','_self')</script>";
    }
    else {
      $insert_query="INSERT INTO cart_details (product_id, ip_address, quantity) VALUES ($get_product_id, '$get_ip_add', 1)";
      $result_query = mysqli_query($con,$insert_query);
      echo "<script>alert('Produk berhasil dimasukan ke dalam keranjang')</script>";
      echo "<script>window.open('products.php','_self')</script>";
    }
  }
}

function cart_item()
{
  if(isset($_GET['add_to_cart']))
  {
    global $con;
    $get_ip_add = getIPAddress();
    $select_query = "SELECT * FROM cart_details WHERE ip_address = '$get_ip_add'";
    $result_query = mysqli_query($con,$select_query);
    $count_cart_items = mysqli_num_rows($result_query);
  }
  else{
    global $con;
    $get_ip_add = getIPAddress();
    $select_query = "SELECT * FROM cart_details WHERE ip_address = '$get_ip_add'";
    $result_query = mysqli_query($con,$select_query);
    $count_cart_items = mysqli_num_rows($result_query);
  }
  if($count_cart_items > 0){
  echo '              
    <a href="cart.php" class="shop-icon cart-icon" >
        <img src="assets/img/fluent-mdl2_shop.png" alt="shop logo">
        <span class="badge">'.$count_cart_items.'</span>
    </a>';
  }
  else {
    echo '
    <a href="cart.php" class="shop-icon cart-icon" >
    <img src="assets/img/fluent-mdl2_shop.png" alt="shop logo">
    </a>';
  }
}

function total_cart_price() {
  global $con;
  $get_ip_add = getIPAddress();
  $total_price = 0;
  $cart_query="SELECT * FROM cart_details WHERE ip_address = '$get_ip_add'";
  $result_query = mysqli_query($con, $cart_query);
  while($row = mysqli_fetch_array($result_query)){
    $product_id = $row['product_id'];
    $select_products = "SELECT * FROM products WHERE product_id =$product_id";
    $result_products = mysqli_query($con, $select_products);
    while($row_product_price = mysqli_fetch_array($result_products)){
      $product_price = array($row_product_price['product_price']);
      $product_values = array_sum($product_price);
      $total_price += $product_values;
    }
  }
  echo $total_price;
}

// function Cart Item
function sub_CheckOut(){
  if(isset($_GET['sub_checkout'])){
    global $con;
    $get_ip_add = getIPAddress();

    // Insert into sub_checkout table
    $insert_query="INSERT INTO sub_checkout (ip_address) VALUES ('$get_ip_add')";
    $result_query = mysqli_query($con,$insert_query);
    if ($result_query) { 
      
      $sub_orderId_query=" SELECT sub_order_id FROM sub_checkout WHERE ip_address = '$get_ip_add' ORDER BY date_sub_order DESC LIMIT 1";
      $result_subOrderId = mysqli_query($con, $sub_orderId_query);

      if ($result_subOrderId && mysqli_num_rows($result_subOrderId) > 0) {
        $row = mysqli_fetch_assoc($result_subOrderId);
        $sub_orderId = $row['sub_order_id'];
        $sub_orderId_string = strval($sub_orderId);
        
        // Insert the sub_order_id into cart_details table
        $update_sub_orderId = "UPDATE cart_details SET sub_order_id = '$sub_orderId_string' WHERE ip_address = '$get_ip_add'";
        $result_update_sub_orderId = mysqli_query($con, $update_sub_orderId);
      }
    }
    echo "<script>window.location.href = 'info_penerima.php';</script>";
    exit;
  }
}

?>



