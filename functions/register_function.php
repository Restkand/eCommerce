<?php

include('../includes/connect.php');


function registrasi($data){
    global $con;
  
    $username = strtolower(stripslashes($data["username"]));
    // strislashes menghapus underscore, strtolower membuat jadi huruf kecil semua
    $password = mysqli_real_escape_string($con, $data["password"]);
    $confirm_password = mysqli_real_escape_string($con, $data["confirm_password"]);
    
    // Cek Username 
    $select_query_username = "SELECT admin_username FROM user_admin WHERE admin_username = '$username'";
    $result_query_username = mysqli_query($con, $select_query_username);
    if (mysqli_fetch_assoc($result_query_username)){
        echo "<script> 
            alert('Username sudah terdaftar');
            </script>";
        return false;
    }
  
    if( $password !== $confirm_password){
      echo "<script>
            alert('konfirmasi password tidak sesuai!');
            </script>";
  
            return false;
    } else {
        
        // enskripsi Password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Tambah kan ke database
        $insert_query = "INSERT INTO user_admin (admin_username,admin_password) VALUES ('$username','$password')";
        $result_query = mysqli_query($con,$insert_query);

        if($result_query){
            return 1;
        }
    } 
  }
?>