<?php
    include('../includes/connect.php');
?>

<div class="container">
    <h1 class="text-center mb-3">Brands View</h1>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Brand</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <!-- Looping untuk menampilkan data produk -->
        <?php
        // Menghubungkan dengan database
        global $con;

        // Query untuk mendapatkan data produk
        $select_query = "SELECT * FROM brands";
        $select_result = mysqli_query($con, $select_query);

        // Looping untuk menampilkan data produk
        while ($row = mysqli_fetch_assoc($select_result)) {
          $brand_id = $row['brand_id'];
          $brand_title = $row['brand_title'];

          echo "<tr>";
          echo "<td>$brand_id</td>";
          echo "<td>$brand_title</td>";
          echo "<td>";
          echo "<a href='edit_brand.php?edit_brand=$brand_id' class='btn btn-primary'>Edit</a> ";
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