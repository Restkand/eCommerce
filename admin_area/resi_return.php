<?php 
session_start();


if(!isset($_SESSION["login"])){
    header("Location: login_admin.php");
    exit;
}

include('../includes/connect.php');

if (isset($_GET['checkout_id'])){
    global $con;
    $checkout_subid = $_GET['checkout_id'];


    $select_query = "SELECT * FROM info_penerima where sub_order_id = $checkout_subid  ORDER BY order_id DESC LIMIT 1";
    $result_query = mysqli_query($con, $select_query);
    while($row = mysqli_fetch_array($result_query)){
        $nama_penerima = $row['nama_penerima'];
        $telepon_penerima = $row['telepon_penerima'];
        $alamat_penerima = $row['alamat_penerima'];
        $ongkir = $row['ongkos_kirim'];
        $ongkir_format = number_format($ongkir, 0, '.', '.');
    }

    $select_query_inv = "SELECT * FROM checkout_details where sub_order_id = $checkout_subid  ORDER BY order_id DESC LIMIT 1";
    $result_query_inv = mysqli_query($con, $select_query_inv);
    while($row = mysqli_fetch_array($result_query_inv)){
        $invoice_number = $row['invoice_number'];
    }


    if(isset($_POST['insert_resi'])){
        $resi_number =$_POST['resi_number'];

        $update_resi = "UPDATE report_return SET resi_return = '$resi_number' WHERE invoice_number = '$invoice_number'";
        mysqli_query($con, $update_resi);

        $checkout_subid = urlencode($checkout_subid);
        header("Location: detail_checkout.php?detail_checkout=$checkout_subid");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=`, initial-scale=1.0">
    <link rel="stylesheet" href="assets/CSS/main.css">
    <link rel="stylesheet" href="assets/CSS/menuBelanja.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <title>Insert Resi | LOGO</title>
    <style>
    .container-searcher {
      max-width: 400px;
      margin: 10px auto;
      padding: 20px;
      height: 80%;
    }

    .resi_detail {
        background-color: #fff;
        padding: 30px;
        border: 1px solid #e2e2e2;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .btn-primary {
      width: 100%;
    }

    #searchResults {
      margin-top: 30px;
    }
    </style>
</head>
<body>
    <div class="container container-searcher">
            <div class="d-flex justify-content-between align-items-center mt-3 container-outside">
                <a class="btn btn-secondary" href="javascript:void(0);" onclick="history.back();">Back</a>    
                <h2>Resi Return</h2>  
            </div>
        <div class="resi_detail">
            <p><strong>Nama:</strong> <?php echo "$nama_penerima"?></p>
            <p><strong>Telepon:</strong> <?php echo "$telepon_penerima"?></p>
            <p><strong>Alamat:</strong> <?php echo "$alamat_penerima"?></p>
            <br>
            <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="invoiceNumber">Masukan Nomor Resi:</label>
                <input type="text" id="search_order" class="form-control" placeholder="Resi Return" name="resi_number" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" value="Insert Resi" name="insert_resi">Resi Return</button>
            </div>
            </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>