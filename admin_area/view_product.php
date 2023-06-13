<?php
    include('../includes/connect.php');
?>

<div class="container">
    <h1 class="text-center mb-3">Products View</h1>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama Produk</th>
          <th>Gambar Produk</th>
          <th>Sold Out</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <!-- Looping untuk menampilkan data produk -->
        <?php
        // Menghubungkan dengan database
        global $con;

        // Query untuk mendapatkan data produk
        $select_query = "SELECT * FROM products";
        $select_result = mysqli_query($con, $select_query);

        // Looping untuk menampilkan data produk
        while ($row = mysqli_fetch_assoc($select_result)) {
          $product_id = $row['product_id'];
          $product_title = $row['product_title'];
          $image = $row['product_image1'];
          $sold = $row['sold_out'];

          echo "<tr>";
          echo "<td>$product_id</td>";
          echo "<td>$product_title</td>";
          echo "<td><img src='../assets/img/product_images/$image' class='product-image'></td>";
            if ($sold == 0){
                echo "<td>Belum Terjual</td>";
            }
            else {
                echo "<td>Terjual</td>";
            }
          echo "<td>";
          echo "<a href='edit_product.php?edit_product=$product_id' class='btn btn-primary'>Edit</a> ";
        //   echo "<a href='delete_product.php?id=$product_id' class='btn btn-danger'>Hapus</a>";
          echo "</td>";
          echo "</tr>";
        }

        // Menutup koneksi database
        mysqli_close($con);
        ?>
      </tbody>
    </table>
  </div>