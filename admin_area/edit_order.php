<?php

    session_start();


    if(!isset($_SESSION["login"])){
        header("Location: login_admin.php");
        exit;
    }

    include('../includes/connect.php');

    if (isset($_GET['edit_order'])){
        global $con;

        $order_subid = $_GET['edit_order'];
        $select_query = "SELECT * FROM info_penerima where sub_order_id = $order_subid ";
        $result_query = mysqli_query($con, $select_query);
        
        while($row = mysqli_fetch_array($result_query)){
            $nama_penerima = $row['nama_penerima'];
            $telepon_penerima = $row['telepon_penerima'];
            $alamat_penerima = $row['alamat_penerima'];
            $ongkir = $row['ongkos_kirim'];
            $ongkir_format = number_format($ongkir, 0, '.', '.');
        }

        // Menampilkan Checkout_details
        $select_query_inv = "SELECT * FROM checkout_details where sub_order_id = $order_subid";
        $result_query_inv = mysqli_query($con, $select_query_inv);
        while($row_inv = mysqli_fetch_array($result_query_inv)){
            $status_checkout = $row_inv['status_checkout'];
            $invoice_number = $row_inv['invoice_number'];
            $no_resi = $row_inv['no_resi'];
        }

        if(isset($_POST['insert_order'])){
            // Mendapatkan data dari form
            $nama_penerima =$_POST['nama_penerima'];
            $telepon_penerima =$_POST['telepon_penerima'];
            $alamat_penerima =$_POST['alamat_penerima'];
            $email_penerima =$_POST['email_penerima'];
            $ongkir =$_POST['ongkir'];
            $status_checkout =$_POST['status_checkout'];
            $no_resi =$_POST['no_resi'];

            // Membuat query untuk update data
            $sql = "UPDATE checkout_details SET ";
            $updatedFields = array();

            if (!empty($nama_penerima)) {
                $sql .= "nama_penerima = '$nama_penerima', ";
                $updatedFields[] = "nama_penerima";
            }
            if (!empty($telepon_penerima)) {
                $sql .= "telepon_penerima = '$telepon_penerima', ";
                $updatedFields[] = "telepon_penerima";
            }
            if (!empty($email_penerima)) {
                $sql .= "email_penerima = '$email_penerima', ";
                $updatedFields[] = "email_penerima";
            }
            if (!empty($alamat_penerima)) {
                $sql .= "alamat_penerima = '$alamat_penerima', ";
                $updatedFields[] = "alamat_penerima";
            }
            if (!empty($ongkir)) {
                $sql .= "ongkir = '$ongkir', ";
                $updatedFields[] = "ongkir";
            }
            if (!empty($status_checkout)) {
                $sql .= "status_checkout = '$status_checkout', ";
                $updatedFields[] = "status_checkout";
            }
            if (!empty($no_resi)) {
                $sql .= "no_resi = '$no_resi', ";
                $updatedFields[] = "no_resi";
            }

            // Menghapus koma terakhir dari query
            $sql = rtrim($sql, ', ');

            if (!empty($updatedFields)) {
                $sql .= " WHERE sub_order_id = $order_subid";
                // Menjalankan query
                $result = mysqli_query($con, $sql);
                if ($result) {
                    echo "<script>alert('Order berhasil di edit')</script>";
                } else {
                    echo "<script>alert('Gagal melakukan update data')</script>";
                }
            } else {
                echo "<script>alert('Tidak ada data yang dirubah')</script>";
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
        <a href="index.php?all_order" class="btn btn-secondary">View Orders</a>    
        <h2>Edit Order</h2>  
        </div>
        <h5><?php echo $invoice_number ?></h5>
        <form action="" enctype="multipart/form-data" method="POST">
            <div class="form-group">
                <label for="nama_penerima">Nama Penerima : <?php echo "$nama_penerima" ?></label>
                <input type="text" class="form-control" id="nama_penerima" name="nama_penerima">
            </div>
            <div class="form-group">
                <label for="telepon_penerima">Telepon Penerima </label>
                <input type="text" class="form-control" id="telepon_penerima" name="telepon_penerima" >
            </div>
            <div class="form-group">
                <label for="email_penerima">Email Penerima </label>
                <input type="email" class="form-control" id="email_penerima" name="email_penerima" >
            </div>
            <div class="form-group">
                <label for="alamat_penerima">Alamat Penerima </label>
                <textarea type="text" class="form-control" id="alamat_penerima" name="alamat_penerima" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="ongkir">Ongkir </label>
                <input type="text" class="form-control" id="ongkir" name="ongkir">
            </div>
            
            <!-- Brand -->
            <div class="form-group">
            <label for="status_checkout">Status Checkout : </label>
                <select name="status_checkout" id="" class="product_brand">
                    <option value="">Status</option>
                    <option value="Menunggu Pembayaran">Menunggu Pembayaran</option>
                    <option value="Konfirmasi Pembayaran">Konfirmasi Pembayarn</option>
                    <option value="Sedang di Packing">Sedang di Packing</option>
                    <option value="Sedang di Kirim">Sedang di Kirim</option>
                    <option value="Pesanan di Terima">Pesanan di Terima</option>
                    <option value="Return">Return</option>
                    <option value="Cancel">Cancel</option>
                </select>
            </div>

            <div class="form-group">
                <label for="no_resi">Nomor Resi</label>
                <input type="text" class="form-control" id="no_resi" name="no_resi">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="insert_order"  value="Insert Order">Update Order</button>
            </div>


        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
<?php }?>