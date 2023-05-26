<?php 
include('../includes/connect.php');

if(isset($_POST['insert_gndr'])){
    $gender_product=$_POST['gndr_product'];
    $insert_query="INSERT INTO genders (gender_product) values ('$gender_product')";
    $result = mysqli_query($con, $insert_query);
    if($result){
        echo "<script>alert('Gender has been inserted successfully')</script>";
    }

}

?>

<h2>Insert Gender</h2>

<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1">
            <i class="fa-solid fa-receipt"></i>
        </span>
        <input type="text" class="form-control" name="gndr_product" placeholder="Insert Genders" aria-label="Genders" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2">
        <input type="submit" class="bg-info border-0 p-2 my-3" name="insert_gndr" value="Insert Gender" aria-label="Username" aria-describedby="basic-addon1">
        <!-- <button class="bg-info p-2 my-3 border-0">Insert Genders</button> -->
    </div>
</form>