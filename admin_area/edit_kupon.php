<?php
    session_start();


    if(!isset($_SESSION["login"])){
        header("Location: login_admin.php");
        exit;
    }
    
    include('../includes/connect.php');

    if (isset($_GET['edit_kupon'])){
        global $con;

        $kupon_id = $_GET['edit_kupon'];
        $select_query = "SELECT * FROM kupon_diskon WHERE kupon_id = $kupon_id";
        $result_query = mysqli_query($con, $select_query);
        while($row = mysqli_fetch_array($result_query)){
            $nama_kupon = $row['nama_kupon'];
            $jumlah_kupon = $row['jumlah_kupon'];
            $diskon_kupon = $row['diskon_kupon'];
            $expired_kupon = $row['date_kupon'];
            $status_kupon = $row['status_kupon'];
        }

        if(isset($_POST['insert_edit_kupon'])){
            // Mendapatkan data dari form
            $nama_kupon =$_POST['nama_kupon'];
            $jumlah_kupon =$_POST['jumlah_kupon'];
            $diskon_kupon =$_POST['diskon_kupon'];
            $date_kupon =$_POST['date_kupon'];
            $status_kupon =$_POST['status_kupon'];

            // Membuat query untuk update data
            $sql = "UPDATE kupon_diskon SET ";
            if (!empty($nama_kupon)) {
                $sql .= "nama_kupon = '$nama_kupon', ";
            }
            else if (!empty($jumlah_kupon)) {
                $sql .= "jumlah_kupon = '$jumlah_kupon', ";
            }
            else if (!empty($diskon_kupon)) {
                $sql .= "diskon_kupon = '$diskon_kupon', ";
            }
            else if (!empty($date_kupon)) {
                $sql .= "date_kupon = '$date_kupon', ";
            }
            else if (!empty($status_kupon)) {
                $sql .= "status_kupon = '$status_kupon', ";
            }
            $sql = rtrim($sql, ', '); // Menghapus koma terakhir dari query

            $sql .= " WHERE kupon_id = '$kupon_id'";
            // Menjalankan query
            $result = mysqli_query($con, $sql);
            if ($result) {
                echo "<script>alert('Kupon berhasil di edit')</script>";
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

    </style>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="index.php?view_kupon" class="btn btn-secondary">View Kupon</a>    
        <h2>Edit Kupon</h2>  
        </div>
        <form action="" enctype="multipart/form-data" method="POST">
            <div class="form-group">
                <label for="category_name">Nama Kupon : <?php echo "$nama_kupon" ?></label>
                <input type="text" class="form-control" id="nama_kupon" name="nama_kupon">
            </div>
            
            <!-- Jumlah Kupon -->
            <div class="form-group mb-4">
                <label for="product-keyw" class="from-label"> Jumlah Kupon</label>
                <input type="number" name="jumlah_kupon" id="jumlah_kupon" class="form-control" placeholder="Tambahkan Jumlah Kupon" autocomplete="off" required="required">
            </div> 
            
            <!-- Diskon Kupon -->
            <div class="form-group mb-4">
                <label for="product-keyw" class="from-label"> Diskon Kupon</label>
                <input type="number" name="diskon_kupon" id="diskon_kupon" class="form-control" placeholder="Harga Diskon Kupon" autocomplete="off" required="required">
            </div> 

            <!-- Expired Kupon -->
            <div class="form-group mb-4">
                <label for="product-keyw" class="from-label">Tanggal Kedaluwarsa</label>
                <input type="date" name="date_kupon" id="date_kupon" class="form-control" required="required">
            </div> 

            <div class="form-group">
            <label for="product_genders">Status Kupon : </label>
                <select name="status_kupon" id="" class="product_soldout">
                 <option value="Active">Active</option>
                 <option value="Not Active">Not Active</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="insert_edit_kupon"  value="Edit Kupon">Edit Kupon</button>
            </div>


        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
<?php }?>