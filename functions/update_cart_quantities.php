<?php
include('includes/connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productIds = $_POST['productId'];
    $quantities = $_POST['quantity'];
    $actions = $_POST['action'];
  
    for ($i = 0; $i < count($productIds); $i++) {
      $productId = $productIds[$i];
      $quantity = $quantities[$i];
      $action = $actions[$i];
  
      if ($action === 'increase') {
        // Update the quantity in the cart
        $updateQuery = "UPDATE cart_details SET quantity = $quantity WHERE product_id = $productId";
        mysqli_query($con, $updateQuery);
      } elseif ($action === 'decrease') {
        // Check if the updated quantity is 0 and remove the item from the cart
        if ($quantity == 0) {
          $deleteQuery = "DELETE FROM cart_details WHERE product_id = $productId";
          mysqli_query($con, $deleteQuery);
        } else {
          // Update the quantity in the cart
          $updateQuery = "UPDATE cart_details SET quantity = $quantity WHERE product_id = $productId";
          mysqli_query($con, $updateQuery);
        }
      }
  
      // Perform any other necessary operations with the updated quantity
      // ...
    }
  
    echo "Quantity updated successfully.";
  }
?>
