<?php
    include('../includes/connect.php');
?>

<div class="container">
    <h1 class="text-center mb-3">Categories View</h1>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Category</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <!-- Looping untuk menampilkan data produk -->
        <?php
        // Menghubungkan dengan database
        global $con;

        // Query untuk mendapatkan data produk
        $select_query = "SELECT * FROM categories";
        $select_result = mysqli_query($con, $select_query);

        // Looping untuk menampilkan data produk
        while ($row = mysqli_fetch_assoc($select_result)) {
          $category_id = $row['category_id'];
          $category_title = $row['category_title'];

          echo "<tr>";
          echo "<td>$category_id</td>";
          echo "<td>$category_title</td>";
          echo "<td>";
          echo "<a href='edit_category.php?edit_category=$category_id' class='btn btn-primary'>Edit</a> ";
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