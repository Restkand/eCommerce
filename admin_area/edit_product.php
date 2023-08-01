<?php

    session_start();


    if(!isset($_SESSION["login"])){
        header("Location: login_admin.php");
        exit;
    }

    include('../includes/connect.php');

    if (isset($_GET['edit_product'])){
        global $con;

        $product_id = $_GET['edit_product'];
        $select_query = "SELECT * FROM products where product_id = $product_id";
        $result_query = mysqli_query($con, $select_query);
        while($row = mysqli_fetch_array($result_query)){
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_desc = $row['product_desc'];
            $image = $row['product_image1'];
            $sold = $row['sold_out'];
        }

        if(isset($_POST['insert_product'])){
            // Mendapatkan data dari form
            $product_title =$_POST['product_title'];
            $product_desc =$_POST['product_desc'];
            $product_keyw =$_POST['product_keyw'];
            $product_categories =$_POST['product_categories'];
            $product_brands =$_POST['product_brands'];
            $product_genders =$_POST['product_genders'];
            $product_price =$_POST['product_price'];
            $product_soldout=$_POST['product_soldout'];

            if($product_soldout == "true"){
                $product_soldout = true;
            }
            else{
                $product_soldout = false;
            }
    
        
            // Access Images
            $product_image1 = $_FILES['product_image1']['name'];
            $product_image2 = $_FILES['product_image2']['name'];
            $product_image3 = $_FILES['product_image3']['name'];
        
            // Access image tmp name
            $temp_image1 = $_FILES['product_image1']['tmp_name'];
            $temp_image2 = $_FILES['product_image2']['tmp_name'];
            $temp_image3 = $_FILES['product_image3']['tmp_name'];

            move_uploaded_file($temp_image1, "../assets/img/product_images/$product_image1");
            move_uploaded_file($temp_image2, "../assets/img/product_images/$product_image2");
            move_uploaded_file($temp_image3, "../assets/img/product_images/$product_image3");

            // Membuat query untuk update data
            $sql = "UPDATE products SET ";
            if (!empty($product_title)) {
                $sql .= "product_title = '$product_title', ";
            }
            if (!empty($product_desc)) {
                $sql .= "product_desc = '$product_desc', ";
            }
            if (!empty($product_keyw)) {
                $sql .= "product_keywords = '$product_keyw', ";
            }
            if (!empty($product_categories)) {
                $sql .= "category_id = '$product_categories', ";
            }
            if (!empty($product_brands)) {
                $sql .= "brand_id = '$product_brabds', ";
            }
            if (!empty($product_genders)) {
                $sql .= "gender_id = '$product_genders', ";
            }
            if (!empty($product_price)) {
                $sql .= "product_price = '$product_price', ";
            }
            if (!empty($product_image1)) {
                $sql .= "product_image1 = '$product_image1', ";
            }
            if (!empty($product_image2)) {
                $sql .= "product_image2 = '$product_image2', ";
            }
            if (!empty($product_image3)) {
                $sql .= "product_image3 = '$product_image3', ";
            }
            if (!empty($product_soldout)) {
                $sql .= "sold_out = '$product_soldout', ";
            }
            $sql = rtrim($sql, ', '); // Menghapus koma terakhir dari query

            $sql .= " WHERE product_id = '$product_id'";
            // Menjalankan query
            $result = mysqli_query($con, $sql);
            if ($result) {
                echo "<script>alert('product berhasil di edit')</script>";
            }
        }
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="icon" href="../assets/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 40px;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-control-file {
            overflow: hidden;
            position: relative;
            cursor: pointer;
        }

        .form-control-file input[type="file"] {
            display: block;
            width: 100%;
            height: 100%;
            opacity: 0;
            position: absolute;
            top: 0;
            right: 0;
            cursor: pointer;
        }

        .form-control-file .custom-file-control {
            padding: 6px 12px;
            color: #495057;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="index.php?view_product" class="btn btn-secondary">View Products</a>    
        <h2>Edit Product</h2>  
        </div>
        <form action="" enctype="multipart/form-data" method="POST">
            <div class="form-group">
                <label for="product_name">Product Name : <?php echo "$product_title" ?></label>
                <input type="text" class="form-control" id="product_title" name="product_title">
            </div>
            <div class="form-group">
                <label for="product_desc">Product Description </label>
                <textarea type="text" class="form-control" id="product_desc" name="product_desc" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="product_keywords">Product Keywords </label>
                <input type="text" class="form-control" id="product_keyw" name="product_keyw">
            </div>

            <!-- Category -->
            <div class="form-group">
            <label for="product_categories">Product Categories : </label>
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
            
            <!-- Brand -->
            <div class="form-group">
            <label for="product_brands">Product Brands : </label>
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

            <!-- Genders -->
            <div class="form-group">
            <label for="product_genders">Product Genders : </label>
                <select name="product_genders" id="" class="product_gender">
                    <option value="">Select a Genders</option>
                    <?php 
                        $select_query = "SELECT * FROM genders";
                        $result_query = mysqli_query($con,$select_query);
                        while($row = mysqli_fetch_assoc($result_query)){
                            $gender_product = $row['gender_product'];
                            $gender_id = $row['gender_id'];
                            echo "<option value='$gender_id'>$gender_product</option>";
                        }
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="product_image">Product Image 1</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" accept="image/*" name="product_image1" id="product_image1">
                        <label class="custom-file-label" for="product_image">Choose file</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="product_image">Product Image 2</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" accept="image/*" name="product_image2" id="product_image2">
                        <label class="custom-file-label" for="product_image">Choose file</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="product_image">Product Image 3</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" accept="image/*" name="product_image3" id="product_image3">
                        <label class="custom-file-label" for="product_image">Choose file</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="product_price">Product Price</label>
                <input class="form-control" id="product_price" name="product_price"
            </div>

            <div class="form-group">
            <label for="product_genders">Product Terjual : </label>
                <select name="product_soldout" id="" class="product_soldout">
                <option value="false">Belum Terjual</option>
                <option value="true">Terjual</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="insert_product"  value="Insert Products">Update Product</button>
            </div>


        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
<?php }?>