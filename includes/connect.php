<?php

// $server = "localhost";
// $username = "n1579292_meonthrift";
// $password = "130700ah";
// $database = "n1579292_ecommerce";

$server = "localhost";
$username = "root";
$password = "";
$database = "ecommerce";

$con = mysqli_connect($server,$username,$password,$database);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

?>