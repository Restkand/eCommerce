<?php 
include('../includes/connect.php');

if(isset($_POST['insert_cat'])){
    $category_title=$_POST['cat_title'];
    $insert_query="INSERT INTO categories (category_title) values ('$category_title')";
    $result = mysqli_query($con, $insert_query);
    if($result){
        echo "<script>alert('Category has been inserted successfully')</script>";
    }

}

?>

<h2>Insert Categories</h2>

<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1">
            <i class="fa-solid fa-receipt"></i>
        </span>
        <input type="text" class="form-control" name="cat_title" placeholder="Insert categories" aria-label="Categories" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2">
        <input type="submit" class="bg-info border-0 p-2 my-3" name="insert_cat" value="Insert Categories" aria-label="Username" aria-describedby="basic-addon1">
        <!-- <button class="bg-info p-2 my-3 border-0">Insert Categories</button> -->
    </div>
</form>