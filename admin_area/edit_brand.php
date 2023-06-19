<?php
    session_start();


    if(!isset($_SESSION["login"])){
        header("Location: login_admin.php");
        exit;
    }


    include('../includes/connect.php');

    if (isset($_GET['edit_brand'])){
        global $con;

        $brand_id = $_GET['edit_brand'];
        $select_query = "SELECT * FROM brands where brand_id = $brand_id";
        $result_query = mysqli_query($con, $select_query);
        while($row = mysqli_fetch_array($result_query)){
            $brand_id = $row['brand_id'];
            $brand_title = $row['brand_title'];
            
        }

        if(isset($_POST['insert_brand'])){
            // Mendapatkan data dari form
            $brand_title =$_POST['brand_title'];
           
            // Membuat query untuk update data
            $sql = "UPDATE brands SET ";
            if (!empty($brand_title)) {
                $sql .= "brand_title = '$brand_title', ";
            }
            $sql = rtrim($sql, ', '); // Menghapus koma terakhir dari query

            $sql .= " WHERE brand_id = '$brand_id'";
            // Menjalankan query
            $result = mysqli_query($con, $sql);
            if ($result) {
                echo "<script>alert('brand berhasil di edit')</script>";
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
    <link rel="icon" href="assets/favicon/favicon.ico" type="image/x-icon">
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

    </style>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="index.php?view_brand" class="btn btn-secondary">View brands</a>    
        <h2>Edit brand</h2>  
        </div>
        <form action="" enctype="multipart/form-data" method="POST">
            <div class="form-group">
                <label for="brand_name">Brand Title : <?php echo "$brand_title" ?></label>
                <input type="text" class="form-control" id="brand_title" name="brand_title">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="insert_brand"  value="Insert Brands">Update Brands</button>
            </div>


        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
<?php }?>