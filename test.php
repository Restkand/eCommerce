<!DOCTYPE html>
<html>
<head>
  <title>Tombol Input File Custom</title>
  <style>
    .custom-file-upload {
      position: relative;
      display: inline-block;
      padding: 6px 12px;
      background-color: #f5f5f5;
      color: #6c757d;
      border: 1px solid #ccc;
      border-radius: 5px;
      overflow: hidden;
      cursor: pointer;
    }
    .custom-file-upload input[type="file"] {
      position: absolute;
      font-size: 100px;
      opacity: 0;
      right: 0;
      top: 0;
    }
    .custom-file-upload input[type="file"] + label::before {
      content: 'Pilih File';
    }
    .custom-file-upload input[type="file"]:focus + label::before {
      outline: 1px dotted #000;
      outline: -webkit-focus-ring-color auto 5px;
    }
    .custom-file-upload input[type="file"]:valid + label::before {
      content: attr(data-file-name);
      background-color: #28a745;
      color: #fff;
    }
  </style>
  <script>
    function displayFileName(event) {
      var input = event.target;
      var fileName = input.files[0].name;
      var label = input.nextElementSibling;
      label.setAttribute("data-file-name", fileName);
    }
  </script>
</head>
<body>
  <label for="bukti">Pilih File Bukti Pembayaran:</label>
  <label class="custom-file-upload">
    <input type="file" name="bukti" id="bukti" accept=".jpg, .jpeg, .png" required onchange="displayFileName(event)">
    <label></label>
  </label>
</body>
</html>
