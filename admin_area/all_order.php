<?php
    include('../includes/connect.php');
?>

<div class="container">
    <h1 class="text-center mb-3">All Order</h1>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Inovice Number</th>
          <th>Resi Pengiriman</th>
          <th>Status Pesanan</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <!-- Looping untuk menampilkan data produk -->
        <?php
        // Menghubungkan dengan database
        global $con;

        // Query untuk mendapatkan data checkout
        $select_query = "SELECT * FROM checkout_details";
        $select_result = mysqli_query($con, $select_query);

        $previous_checkout_id = null;

        // Looping untuk menampilkan data produk
        while ($row = mysqli_fetch_assoc($select_result)) {
          $checkout_id = $row['sub_order_id'];

            // Memeriksa apakah $checkout_id sama dengan $previous_checkout_id
            if ($checkout_id == $previous_checkout_id) {
            continue; // Melanjutkan iterasi berikutnya dalam loop
            }

          $invoice_number = $row['invoice_number'];
          $no_resi = $row['no_resi'];
          $status_checkout = $row['status_checkout'];

          echo "<tr>";
          echo "<td>$invoice_number</td>";
          echo "<td>$no_resi</td>";
          echo "<td>$status_checkout</td>";
          echo "<td>";
          echo "<a href='detail_checkout.php?detail_checkout=$checkout_id' class='btn btn-primary'>Detail Order</a> ";
          echo "<a href='edit_order.php?edit_order=$checkout_id' class='btn btn-danger'>Edit Order</a>";
          echo "</td>";
          echo "</tr>";

          $previous_checkout_id = $checkout_id;
        }

        // Menutup koneksi database
        mysqli_close($con);
        ?>
      </tbody>
    </table>
  </div>