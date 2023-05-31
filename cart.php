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
    <link rel="stylesheet" href="assets/CSS/main.css">
    <link rel="stylesheet" href="assets/CSS/menuBelanja.css">
    <link rel="stylesheet" href="assets/CSS/cart.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <title>Keranjang Belanja | LOGO</title>
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
                <?php 
                  cart_item();
                ?>
              </div>
          </div>
          <div class="row">
              <div class="col nav-item text-center">
                  <a href="products.php">PRODUK</a>
                  <a href="#">PRELOVED</a>
                  <a  href="#">CARI LOKASI TOKO</a>
                  <a href="#">TENTANG KAMI</a>
              </div>
          </div>
      </div>
  </div>

    <!-- cart Function -->
    <?php 
    cart();
    ?>

    <hr>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-4">
            <h3>Keranjang Belanja</h3>
            </div>
        </div>
    </div>

<!-- Cart Data -->
<?php 
$get_ip_add = getIPAddress();
$total_price = 0;
$cart_query = "SELECT cart_details.*, products.product_price, products.product_title, products.product_image1 FROM cart_details
              JOIN products ON cart_details.product_id = products.product_id
              WHERE cart_details.ip_address = '$get_ip_add'";
$result_query = mysqli_query($con, $cart_query);
$num_of_rows = mysqli_num_rows($result_query);

$updatedQuantities = array(); // Initialize as an empty array

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_cart'])) {
        $quantities = $_POST['qty'];
        while ($row = mysqli_fetch_array($result_query)) {
            $product_id = $row['product_id'];
            $submittedQuantity = (int)$quantities[$product_id];
            $storedQuantity = (int)$row['quantity'];
            $submittedQuantity = max(0, $submittedQuantity); // Prevent negative quantities
            
            if ($submittedQuantity !== $storedQuantity) {
                $update_cart = "UPDATE cart_details SET quantity=$submittedQuantity WHERE ip_address='$get_ip_add' AND product_id=$product_id";
                $result_products_quantity = mysqli_query($con, $update_cart);
            }
            $updatedQuantities[$product_id] = $submittedQuantity;
        }
    }
}
?>

<!-- Cart Data -->
<?php 
$get_ip_add = getIPAddress();
$total_price = 0;
$cart_query = "SELECT cart_details.*, products.product_price, products.product_title, products.product_image1 FROM cart_details
              JOIN products ON cart_details.product_id = products.product_id
              WHERE cart_details.ip_address = '$get_ip_add'";
$result_query = mysqli_query($con, $cart_query);
$num_of_rows = mysqli_num_rows($result_query);

$updatedQuantities = array(); // Initialize as an empty array

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_cart'])) {
        $quantities = $_POST['qty'];
        while ($row = mysqli_fetch_array($result_query)) {
            $product_id = $row['product_id'];
            $submittedQuantity = (int)$quantities[$product_id];
            $storedQuantity = (int)$row['quantity'];
            $submittedQuantity = max(0, $submittedQuantity); // Prevent negative quantities
            
            if ($submittedQuantity !== $storedQuantity) {
                $update_cart = "UPDATE cart_details SET quantity=$submittedQuantity WHERE ip_address='$get_ip_add' AND product_id=$product_id";
                $result_products_quantity = mysqli_query($con, $update_cart);
            }
            $updatedQuantities[$product_id] = $submittedQuantity;
        }
    }
}

// Get the quantities from the database and assign them to $updatedQuantities
mysqli_data_seek($result_query, 0); // Reset the result pointer
while ($row = mysqli_fetch_array($result_query)) {
    $product_id = $row['product_id'];
    $updatedQuantities[$product_id] = (int)$row['quantity'];
}

?>

<?php if ($num_of_rows > 0) { ?>
<!-- if the Cart is not empty -->
<div class="container">
    <form method="post">
        <div class="row mt-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <!-- Cart items -->
                        <div class="cart-items">
                            <?php mysqli_data_seek($result_query, 0); // Reset the result pointer ?>
                            <?php while ($row = mysqli_fetch_array($result_query)) {
                                $product_id = $row['product_id'];
                                $formatted_price = number_format($row['product_price'], 0, '.', '.');
                                $product_title = $row['product_title'];
                                $product_image1 = $row['product_image1'];
                                $product_values = $row['product_price'] * $updatedQuantities[$product_id];
                                $total_price += $product_values;
                                $formatted_total_price = number_format($total_price, 0, '.', '.');
                                ?>
                                <!-- Item -->
                                <hr>
                                <div class="cart-item">
                                    <img src="assets/img/product_images/<?php echo $product_image1 ?>" alt="<?php echo $product_title ?>" class="item-image">
                                    <div class="item-details">
                                        <h6 class="item-name"><?php echo $product_title ?> : Rp <?php echo $formatted_price ?></h6>
                                        <div class="item-quantity">
                                            <input type="number" class="form-control quantity-input" name="qty[<?php echo $product_id ?>]" value="<?php echo $updatedQuantities[$product_id]; ?>">
                                        </div>
                                        
                                        <p class="item-price">Total : Rp <?php echo number_format($product_values, 0, '.', '.'); ?></p>
                                        <button class="btn btn-danger btn-remove mt-1" name="remove_cart" value="<?php echo $product_id ?>">Remove Cart</button>
                                    </div>
                                </div>
                            <?php } ?>
                            <!-- Add more items here -->
                        </div>
                    </div>
                </div>
            </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Order Summary</h5>
                            <div class="order-details">
                                <div class="row">
                                    <div class="col-7"><strong>Subtotal:</strong></div>
                                    <div class="col-5"><strong>RP <?php echo $formatted_total_price ?></strong></div>
                                </div>
                                <button class="btn btn-primary btn-checkout">Checkout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <input type="submit" value="Update Cart" class="btn btn-danger btn-remove mt-3" name="update_cart">
    </form>
</div>
<?php } ?>
<!-- if the cart is Empty -->
<?php if ($num_of_rows == 0) { ?>

    <div class="container">
        <div class="row">
            <div class="col-12 text-center mt-4">
            <h2>Maaf, Keranjang belanja anda kosong</h2>
            </div>
        </div>
    </div>

<?php } ?>


<!-- Footer -->
    <?php 
        footer()
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['remove_cart'])) {
            $remove_product_id = $_POST['remove_cart'];
            
            // Delete the product from the cart_details table
            $delete_cart = "DELETE FROM cart_details WHERE ip_address='$get_ip_add' AND product_id=$remove_product_id";
            $result_delete_cart = mysqli_query($con, $delete_cart);
            
            // Optionally, you can also remove the product from the updatedQuantities array
            unset($updatedQuantities[$remove_product_id]);
            
            if ($result_delete_cart) {
                // Cart item successfully removed, redirect to the same page
                echo '
                <script>
                    window.location.href = window.location.href;
                </script>';
                exit; // Stop executing further PHP code
            }
        }
    }
?>
<!-- Script Update quantities
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('.quantity-input').on('change', function() {
      var inputElement = $(this); // Store the reference to $(this)

      var productId = inputElement.data('product-id');
      var prevQuantity = inputElement.data('prev-quantity') || 1; // Default to 1 if previous quantity is undefined
      var quantity = inputElement.val();

      // Check if the quantity is valid (greater than or equal to 1)
      if (quantity < 1) {
        quantity = 1; // Reset to 1 if the entered quantity is less than 1
        inputElement.val(quantity); // Update the input value
      }

      // Check if the quantity is increased or decreased
      var action = '';
      if (quantity > prevQuantity) {
        action = 'increase';
      } else if (quantity < prevQuantity) {
        action = 'decrease';
      }

      // Update the previous quantity data attribute
      inputElement.data('prev-quantity', quantity);

      // Send AJAX request to update the quantity
      $.ajax({
        url: 'functions/update_cart_quantities.php',
        method: 'POST',
        data: {
          productId: productId,
          quantity: quantity,
          action: action
        },
        success: function(response) {
          // Handle the response if needed
          console.log(response);
          // Update the total price in the item-details
          var price = parseFloat(inputElement.closest('.cart-item').find('.item-price').text().replace('Rp ', ''));
          var totalPrice = price * quantity;
          inputElement.closest('.cart-item').find('.item-details .item-price').text('Rp ' + totalPrice.toFixed(2));
        },
        error: function(xhr, status, error) {
          // Handle error if needed
          console.log(error);
        }
      });
    }); -->
  });
</script>
</body>
</html>