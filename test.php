<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shipping Label</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .shipping-label {
      width: 400px;
      padding: 20px;
      border: 2px solid #000;
      border-radius: 10px;
      margin: 20px auto;
      background-color: #fff;
    }

    .shipping-label h2 {
      margin-top: 0;
      font-size: 24px;
      text-align: center;
      text-transform: uppercase;
      color: #000;
      margin-bottom: 20px;
    }

    .shipping-label .label-info {
      margin-top: 20px;
      padding: 10px;
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .shipping-label .label-info .info-title {
      font-weight: bold;
      margin-bottom: 5px;
      color: #000;
    }

    .shipping-label .label-info .info-details {
      margin-bottom: 10px;
      color: #000;
    }

    .shipping-label .label-info .info-details:last-child {
      margin-bottom: 0;
    }

  </style>
</head>

<body>
  <div class="shipping-label">
    <h2>Shipping Label</h2>
    <div class="label-info">
      <p class="info-title">Nama Penerima:</p>
      <p class="info-details">John Doe</p>
      <p class="info-title">Alamat Penerima:</p>
      <p class="info-details">123 Main St</p>
      <p class="info-title">Nomor Telepon Penerima:</p>
      <p class="info-details">08123456789</p>
    </div>
  </div>
</body>

</html>
