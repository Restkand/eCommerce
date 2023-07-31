<?php
    include('../includes/connect.php');
    if(isset($_POST['insert_kupon'])){

        $nama_kupon =$_POST['nama_kupon'];
        $jumlah_kupon =$_POST['jumlah_kupon'];
        $diskon_kupon =$_POST['diskon_kupon'];
        $date_kupon =$_POST['date_kupon'];
        $status_kupon ="Active";

        // Checking Empty Condition
        if($nama_kupon == '' or $jumlah_kupon == '' or  $diskon_kupon =='' or  $date_kupon ==''){
            echo "<script>alert('Please fill all the empty')</script>";
        }
        else {
            //  insert query
            $insert_kupon = "INSERT INTO kupon_diskon (nama_kupon,jumlah_kupon,diskon_kupon,date_kupon,status_kupon) 
            VALUES ('$nama_kupon','$jumlah_kupon','$diskon_kupon','$date_kupon','$status_kupon')";
            $result_query = mysqli_query($con,$insert_kupon);
            if($result_query){
                echo "<script>alert('kupon baru berhasil di tambahkan')</script>";
            }
        }
    }
?>
    

    <h1 class="text-center">Tambah Kupon Baru</h1>
    <!-- form -->
    <form action="" method="post" enctype="multipart/form-data">
        <!--Nama Kupon-->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product-title" class="from-label"> Nama Kupon</label>
            <input type="text" name="nama_kupon" id="nama_kupon" class="form-control" placeholder="Tambahkan Nama Kupon" autocomplete="off" required="required">
        </div>
        
        <!-- Jumlah Kupon -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product-keyw" class="from-label"> Jumlah Kupon</label>
            <input type="number" name="jumlah_kupon" id="jumlah_kupon" class="form-control" placeholder="Tambahkan Jumlah Kupon" autocomplete="off" required="required">
        </div> 
        
        <!-- Diskon Kupon -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product-keyw" class="from-label"> Diskon Kupon</label>
            <input type="number" name="diskon_kupon" id="diskon_kupon" class="form-control" placeholder="Harga Diskon Kupon" autocomplete="off" required="required">
        </div> 

        <!-- Expired Kupon -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product-keyw" class="from-label">Tanggal Kedaluwarsa</label>
            <input type="date" name="date_kupon" id="date_kupon" class="form-control" required="required">
        </div> 

        <!-- SUBMIT BUTTON -->
        <div class="form-outline mb-4 w-50 m-auto">
            <input type="submit" name="insert_kupon" class="btn btn-info mb-3 px-3" value="Insert Kupon">
        </div>
    </form>