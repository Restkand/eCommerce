<?php
session_start();

if(isset($_SESSION["login"])){
    header("Location: index.php");
    exit;
}

include('../includes/connect.php');


if(isset($_POST["login"])){
    
    $username = $_POST["username"];
    $password = $_POST["password"];

    $select_query_login = "SELECT * FROM user_admin WHERE admin_username = '$username'";
    $result_query_login = mysqli_query($con, $select_query_login);

    if(mysqli_num_rows($result_query_login) === 1){

        // Cek Password
        $row = mysqli_fetch_assoc($result_query_login);
        if(password_verify($password, $row["admin_password"])){
            // Set Session
            $_SESSION["login"] = true;
            
            header("Location: index.php");
            exit;
        }
        else{
            echo "<script>
            alert('Gagal untuk Login');
            </script>";
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/css/bootstrap.min.css">
  <link rel="icon" href="../assets/favicon/favicon.ico" type="image/x-icon">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .login-form {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      border: 1px solid #dee2e6;
      border-radius: 5px;
      margin-top: 100px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .login-form h1 {
      font-size: 24px;
      font-weight: 700;
      margin-bottom: 30px;
    }

    .login-form .form-control {
        margin-bottom: 10px;
      padding: 8px;
      font-size: 14px;
      border-radius: 4px;
      border: 1px solid #dee2e6;
    }

    .login-form .form-control:focus {
      border-color: #007bff;
      box-shadow: none;
    }

    .login-form .btn {
      background-color: #007bff;
      border-color: #007bff;
      color: #fff;
      font-size: 14px;
      font-weight: 600;
      padding: 6px 10px;
      border-radius: 4px;
      transition: background-color 0.3s ease;
    }

    .login-form .btn:hover {
      background-color: #0069d9;
      border-color: #0062cc;
    }

    /* .login-form .form-check-label {
      font-size: 13px;
      margin-bottom: 10px;
    }

    .login-form .footer-link {
      font-size: 13px;
      margin-top: 15px;
      text-align: center;
    }

    .login-form .footer-link a {
      color: #6c757d;
      text-decoration: none;
    }

    .login-form .footer-link a:hover {
      color: #6c757d;
      text-decoration: underline;
    } */
  </style>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="login-form">
          <h1 class="text-center mb-4">Admin Login</h1>
          <form action="" method="POST">
            <div class="mb-3">
              <label for="username" class="form-label">Username : </label>
              <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password : </label>
              <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-primary" name="login">Login</button>
            </div>
          </form>
          <!-- <div class="footer-link mt-3 text-center">
            <p>Don't have an account? <a href="signup.html">Sign Up</a></p>
          </div> -->
        </div>
      </div>
    </div>
  </div>
</body>

</html>
