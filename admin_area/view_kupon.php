<?php
    include('../includes/connect.php');
?>

<div class="container">
    <h1 class="text-center mb-3">All Kupon</h1>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Kupon</th>
          <th>Jumlah Kupon</th>
          <th>Diskon Kupon</th>
          <th>Expired Kupon</th>
          <th>Status Kupon</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <!-- Looping untuk menampilkan data produk -->
        <?php
        // Menghubungkan dengan database
        global $con;

        // Query untuk mendapatkan data produk
        $select_query = "SELECT * FROM kupon_diskon";
        $select_result = mysqli_query($con, $select_query);

        // Looping untuk menampilkan data produk
        while ($row = mysqli_fetch_assoc($select_result)) {
            $kupon_id = $row['kupon_id'];
            $nama_kupon = $row['nama_kupon'];
            $jumlah_kupon = $row['jumlah_kupon'];
            $diskon_kupon = $row['diskon_kupon'];
            $expired_kupon = $row['date_kupon'];
            $status_kupon = $row['status_kupon'];
            $diskon_format = number_format($diskon_kupon, 0, '.', '.');

            echo "<tr>";
            echo "<td>$nama_kupon</td>";
            echo "<td>$jumlah_kupon</td>";
            echo "<td>Rp.$diskon_format</td>";
            echo "<td>$expired_kupon</td>";
            echo "<td>$status_kupon</td>";
            echo "<td>";
            echo "<a href='edit_kupon.php?edit_kupon=$kupon_id' class='btn btn-primary'>Edit</a> ";
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