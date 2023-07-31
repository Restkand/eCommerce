<?php
    include('../includes/connect.php');
    if(isset($_POST['insert_product'])){

        $product_title =$_POST['product_title'];
        $kode_produk =$_POST['kode_produk'];
        $product_desc =$_POST['product_desc'];
        $product_keyw =$_POST['product_keyw'];
        $product_categories =$_POST['product_categories'];
        $product_brands =$_POST['product_brands'];
        $product_genders =$_POST['product_genders'];
        $product_price =$_POST['product_price'];
        $product_soldout="false";
        
        $product_size =$_POST['size'];
        $lebar_produk =$_POST['lebar'];
        $panjang_produk =$_POST['panjang'];
        $product_condition =$_POST['condition'];

        // Access Images
        $product_image1 = $_FILES['product_image1']['name'];
        $product_image2 = $_FILES['product_image2']['name'];
        $product_image3 = $_FILES['product_image3']['name'];
    
        // Access image tmp name
        $temp_image1 = $_FILES['product_image1']['tmp_name'];
        $temp_image2 = $_FILES['product_image2']['tmp_name'];
        $temp_image3 = $_FILES['product_image3']['tmp_name'];

        // Checking Empty Condition
        if($product_title == '' or $product_desc == '' or  $product_keyw =='' or $product_categories =='' or $product_brands =='' or $product_genders =='' or $product_price =='' or $product_image1 ==''){
            echo "<script>alert('Please fill all the empty')</script>";
        }
        else {
            move_uploaded_file($temp_image1, "../assets/img/product_images/$product_image1");
            move_uploaded_file($temp_image2, "../assets/img/product_images/$product_image2");
            move_uploaded_file($temp_image3, "../assets/img/product_images/$product_image3");
        
            //  insert query
            $insert_products = "INSERT INTO products (product_title,kode_produk,product_desc,product_keywords,category_id,brand_id,gender_id,product_image1,product_image2,product_image3,product_price,sold_out,date) 
            VALUES ('$product_title','$kode_produk','$product_desc', '$product_keyw', '$product_categories', '$product_brands','$product_genders', '$product_image1', '$product_image2', '$product_image3', '$product_price','$product_soldout', NOW())";
            $result_query = mysqli_query($con,$insert_products);
            if($result_query){
                
                $sub_kodeProduk_query=" SELECT * FROM products WHERE kode_produk = '$kode_produk'";
                $result_kodeProduk_query = mysqli_query($con, $sub_kodeProduk_query);
                while ($row = mysqli_fetch_array($result_kodeProduk_query )) {
                    $product_id = $row['product_id'];
                }

                $insert_detailProducts = "INSERT INTO detail_products (product_id,size,lebar,panjang,product_condition) 
                VALUES('$product_id','$product_size','$lebar_produk','$panjang_produk','$product_condition')";
                $result_detailQuery = mysqli_query($con,$insert_detailProducts);
                if($result_detailQuery){
                    echo "<script>alert('products has been inserted successfully')</script>";
                }
            }
        }
    }
?>
    

    <h1 class="text-center">Insert Products</h1>
    <!-- form -->
    <form action="" method="post" enctype="multipart/form-data">
        <!-- Title Product -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product-title" class="from-label"> Product Title</label>
            <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" autocomplete="off" required="required">
        </div>
        
        <!-- Keywords Product -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product-keyw" class="from-label"> Kode Produk</label>
            <input type="text" name="kode_produk" id="kode_product" class="form-control" placeholder="Enter product code" autocomplete="off" required="required">
        </div> 

        <!-- Description Product -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product-desc" class="from-label"> Product Description</label>
            <textarea type="text" name="product_desc" id="product_desc" class="form-control" placeholder="Enter product description" autocomplete="off" rows="3" required="required"></textarea>
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

        <!-- Genders -->
        <div class="form-outline mb-4 w-50 m-auto">
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
        
        <!-- Product Size -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product-price" class="from-label"> Product Size</label>
            <input type="text" name="size" id="size" class="form-control" placeholder="Enter product size" autocomplete="off" required="required">
        </div>

        <!-- Product Lebar -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product-price" class="from-label"> Lebar Produk</label>
            <input type="text" name="lebar" id="lebar" class="form-control" placeholder="Enter lebar produk (cm)" autocomplete="off" required="required">
        </div>

        <!-- Product Panjang -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product-price" class="from-label"> Panjang Produk</label>
            <input type="text" name="panjang" id="panjang" class="form-control" placeholder="Enter panjak produk (cm)" autocomplete="off" required="required">
        </div>

        <!-- Product Condition -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product-price" class="from-label"> Product Condition</label>
            <input type="text" name="condition" id="condition" class="form-control" placeholder="Enter product condition" autocomplete="off" required="required">
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