<?php 
session_start();


if(!isset($_SESSION["login"])){
    header("Location: login_admin.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Dashboard Admin</title>
    <style>
    .container {
      margin-top: 50px;
    }

    table {
      width: 100%;
    }

    th {
      text-align: center;
    }

    .btn {
      padding: 5px 10px;
    }

    .product-image {
      width: 100px;
    }

    td {
    text-align: center; /* Mengatur posisi teks di tengah */
    vertical-align: middle; /* Mengatur posisi vertikal di tengah */
    }
  </style>
</head>
<body>
    
    <!-- Navbar Admin -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">LOGO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar Items -->
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <!-- DropDown Brands -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Orders
                        </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="index.php?unpaid_order">Unpaid Orders</a></li>
                        <li><a class="dropdown-item" href="index.php?packing_order">Packing Orders</a></li>
                        <li><a class="dropdown-item" href="index.php?sent_order">Sent Orders</a></li>
                        <li><a class="dropdown-item" href="index.php?all_order">All Orders</a></li>
                    </ul>
                    </li>
                    <!-- Close DropDown Brands -->
                    <!-- DropDown Products -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Products
                        </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="index.php?insert_product">Insert Products</a></li>
                        <li><a class="dropdown-item" href="index.php?view_product">View Products</a></li>
                    </ul>
                    </li>
                    <!-- Close DropDown Navbar -->
                    <!-- DropDown Categories -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="index.php?insert_category">Insert Categories</a></li>
                        <li><a class="dropdown-item" href="index.php?view_category">View Categories</a></li>
                    </ul>
                    </li>
                    <!-- Close DropDown Categories -->
                    <!-- DropDown Brands -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Brands
                        </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="index.php?insert_brand">Insert Brands</a></li>
                        <li><a class="dropdown-item" href="index.php?view_brand">View Brands</a></li>
                    </ul>
                    </li>
                    <!-- Close DropDown Brands -->
                    <!-- Optional Navbar -->
                    <!-- <li class="nav-item">
                        <a class="nav-link"href="#">All Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"href="#">All Payments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"href="#">List Users</a>
                    </li> -->
                    <!-- Close Optional Navbar -->
                </ul>    
                    <!-- LOGOUT -->
                    <ul class="d-flex navbar-nav mb-2 mb-lg-0 ms-auto">
                        <li class="nav-item">
                            <a href="logout_admin.php" class="nav-link">Log Out!</a>
                        </li>
                    </ul>
            </div>
        </div>
    </nav>
    <!-- Close Navbar Admin -->

    <!-- Main Content -->
    <div class="container my-3">
        <?php
        if(isset($_GET['insert_category'])){
            include('insert_categories.php');
        }
        if(isset($_GET['insert_brand'])){
            include('insert_brands.php');
        }
        if(isset($_GET['insert_product'])){
            include('insert_product.php');
        }
        if(isset($_GET['view_product'])){
            include('view_product.php');
        }
        if(isset($_GET['view_category'])){
            include('view_category.php');
        }
        if(isset($_GET['view_brand'])){
            include('view_brand.php');
        }
        if(isset($_GET['all_order'])){
            include('all_order.php');
        }
        if(isset($_GET['unpaid_order'])){
            include('unpaid_order.php');
        }
        if(isset($_GET['packing_order'])){
            include('packing_order.php');
        }
        if(isset($_GET['sent_order'])){
            include('sent_order.php');
        }
        ?>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>