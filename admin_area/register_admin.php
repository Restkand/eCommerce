<?php

include('../includes/connect.php');
include('../functions/register_function.php');

if(isset($_POST["register"])){

    if(registrasi($_POST) > 0){
        echo "<script>alert('User Admin baru, berhasil di tambahkan')</script>";
    } else {
        echo mysqli_error($con);
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Admin</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/css/bootstrap.min.css">
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

  </style>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="login-form">
          <h1 class="text-center mb-4">Admin Register</h1>
          <form action="" method="POST">
            <div class="mb-3">
              <label for="username" class="form-label">Username : </label>
              <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password : </label>
              <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="confirm_password" class="form-label">Konfirmasi Password : </label>
              <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
            </div>
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-primary" name="register">Login</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
