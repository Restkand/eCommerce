<?php
    include('../includes/connect.php');
    if(isset($_POST['insert_product'])){

        $product_title =$_POST['product_title'];
        $product_desc =$_POST['product_desc'];
        $product_keyw =$_POST['product_keyw'];
        $product_categories =$_POST['product_categories'];
        $product_brands =$_POST['product_brands'];
        $product_price =$_POST['product_price'];
        $product_status="true";
    
        // Access Images
        $product_image1 = $_FILES['product_image1']['name'];
        $product_image2 = $_FILES['product_image2']['name'];
        $product_image3 = $_FILES['product_image3']['name'];
    
        // Access image tmp name
        $temp_image1 = $_FILES['product_image1']['tmp_name'];
        $temp_image2 = $_FILES['product_image2']['tmp_name'];
        $temp_image3 = $_FILES['product_image3']['tmp_name'];

        // Checking Empty Condition
        if($product_title == '' or $product_desc == '' or  $product_keyw =='' or $product_categories =='' or $product_brands =='' or $product_price =='' or $product_image1 ==''){
            echo "<script>alert('Please fill all the empty')</script>";
        }
        else {
            move_uploaded_file($temp_image1, "../assets/img/product_images/$product_image1");
            move_uploaded_file($temp_image2, "../assets/img/product_images/$product_image2");
            move_uploaded_file($temp_image3, "../assets/img/product_images/$product_image3");
        
            //  insert query
            $insert_products = "INSERT INTO products (product_title,product_desc,product_keywords,category_id,brand_id,product_image1,product_image2,product_image3,product_price,date,status) values ('$product_title','$product_desc', '$product_keyw', '$product_categories', '$product_brands', '$product_image1', '$product_image2', '$product_image3', '$product_price', NOW(),'$product_status')";
            $result_query = mysqli_query($con,$insert_products);
            if($result_query){
                echo "<script>alert('products has been inserted successfully')</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Insert Products-Admin Dashboard</title>
</head>
<body class="bg-light">
    
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>
        <!-- form -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Title Product -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product-title" class="from-label"> Product Title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" autocomplete="off" required="required">
            </div>

            <!-- Description Product -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product-desc" class="from-label"> Product Description</label>
                <input type="text" name="product_desc" id="product_desc" class="form-control" placeholder="Enter product description" autocomplete="off" required="required">
            </div> 
            
            <!-- Keywords Product -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product-keyw" class="from-label"> Product Keywords</label>
                <input type="text" name="product_keyw" id="product_keyw" class="form-control" placeholder="Enter product keywords" autocomplete="off" required="required">
            </div> 

            <!-- Category -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_categories" id="" class="product_category">
                    <option value="">Select a Category</option>
                    <?php 
                        $select_query = "SELECT * FROM categories";
                        $result_query = mysqli_query($con,$select_query);
                        while($row = mysqli_fetch_assoc($result_query)){
                            $category_title = $row['category_title'];
                            $category_id = $row['category_id'];
                            echo "<option value='$category_id'>$category_title</option>";
                        }
                    ?>
                </select>
            </div>

            <!-- Brands -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_brands" id="" class="product_brand">
                    <option value="">Select a Brands</option>
                    <?php 
                        $select_query = "SELECT * FROM brands";
                        $result_query = mysqli_query($con,$select_query);
                        while($row = mysqli_fetch_assoc($result_query)){
                            $brand_title = $row['brand_title'];
                            $brand_id = $row['brand_id'];
                            echo "<option value='$brand_id'>$brand_title</option>";
                        }
                    ?>
                </select>
            </div>

            <!-- Product Image -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product-image1" class="from-label"> Product Image 1</label>
                <input type="file" accept="image/*" name="product_image1" id="product_image1" class="form-control" required="required">
            </div> 

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product-image2" class="from-label"> Product Image 2</label>
                <input type="file" accept="image/*"  name="product_image2" id="product_image2" class="form-control">
            </div> 

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product-image3" class="from-label"> Product Image 3</label>
                <input type="file"  accept="image/*" name="product_image3" id="product_image3" class="form-control">
            </div> 

            <!-- Product Price -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product-price" class="from-label"> Product Price</label>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" autocomplete="off" required="required">
            </div>
            
            <!-- SUBMIT BUTTON -->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" class="btn btn-info mb-3 px-3" value="Insert Products">
            </div>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>