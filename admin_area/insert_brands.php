<?php 
include('../includes/connect.php');

if(isset($_POST['insert_brnd'])){
    $brand_title=$_POST['brnd_title'];
    $insert_query="INSERT INTO brands (brand_title) values ('$brand_title')";
    $result = mysqli_query($con, $insert_query);
    if($result){
        echo "<script>alert('Brand has been inserted successfully')</script>";
    }

}

?>

<h2>Insert Brand</h2>

<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1">
            <i class="fa-solid fa-receipt"></i>
        </span>
        <input type="text" class="form-control" name="brnd_title" placeholder="Insert Brands" aria-label="Brands" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2">
        <input type="submit" class="bg-info border-0 p-2 my-3" name="insert_brnd" value="Insert Brand" aria-label="Username" aria-describedby="basic-addon1">
        <!-- <button class="bg-info p-2 my-3 border-0">Insert Brands</button> -->
    </div>
</form>