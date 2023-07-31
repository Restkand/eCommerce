<?php
    include('../includes/connect.php');
?>

<div class="container">
    <h1 class="text-center mb-3">All Order</h1>
          
    <!-- Sort for Produk -->
    <div class="row">
      <hr>
      <div class="col-sm-4 mb-4">
        <!-- <label for="option1">Kategori : </label> -->
        <?php
          select_date();
        ?>
      </div>
      <div class="col-sm-4 mb-4">
        <!-- <label for="option2">Brand :</label> -->
          <?php
            // select_brands();
          ?>
        </select>
      </div>
      <div class="col-sm-4 mb-4">
        <!-- <label for="option3">Label 3:</label> -->
        <div class="input-group">
          <form class="d-flex" action="" method="POST">
          <input type="text" id="option3" class="form-control" placeholder="INV-12345678" name="search_data">
          <button class="btn btn-outline-secondary" type="submit" value="Search" name="search_data_order">
            <i class="fas fa-search"></i>
          </button>
          </form>
        </div>
      </div>
      <hr>
    </div>

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

        // Menampilkan 1 Week atau Seminggu
        if (isset($_GET['sort']) && $_GET['sort'] === 'week') {
          // Tindakan yang ingin Anda lakukan ketika parameter 'sort' bernilai 'week'
          $select_query = "SELECT * FROM checkout_details WHERE date_checkout >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK) ORDER BY date_checkout DESC";
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
          }

        // Menampilkan 1 month atau Sebulan
        else if (isset($_GET['sort']) && $_GET['sort'] === 'month') {
          // Tindakan yang ingin Anda lakukan ketika parameter 'sort' bernilai 'week'
          $select_query = "SELECT * FROM checkout_details WHERE date_checkout >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) ORDER BY date_checkout DESC";
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
          }

        // Menampilkan 3 month atau Sebulan
        else if (isset($_GET['sort']) && $_GET['sort'] === '3months') {
          // Tindakan yang ingin Anda lakukan ketika parameter 'sort' bernilai 'week'
          $select_query = "SELECT * FROM checkout_details WHERE date_checkout >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH) ORDER BY date_checkout DESC";
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
          }

        // menampilkan seluruh yang ada di Order
        else {
        // Query untuk mendapatkan data checkout
        $select_query = "SELECT * FROM checkout_details ORDER BY date_checkout DESC";
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
          
          $select_query_cv = "SELECT * FROM report_return WHERE invoice_number = '$invoice_number'";
          $result_query_cv = mysqli_query($con, $select_query_cv);
          while($row = mysqli_fetch_array($result_query_cv)){
              $resi_return = $row['resi_return'];
          }
        
          if ($status_checkout == "Return"){
            echo "<tr>";
            echo "<td>$invoice_number</td>";
            echo "<td>$resi_return</td>";
            echo "<td>$status_checkout</td>";
            echo "<td>";
            echo "<a href='detail_checkout.php?detail_checkout=$checkout_id' class='btn btn-primary'>Detail Order</a> ";
            echo "<a href='edit_order.php?edit_order=$checkout_id' class='btn btn-danger'>Edit Order</a>";
            echo "</td>";
            echo "</tr>";
          }

          else {
          echo "<tr>";
          echo "<td>$invoice_number</td>";
          echo "<td>$no_resi</td>";
          echo "<td>$status_checkout</td>";
          echo "<td>";
          echo "<a href='detail_checkout.php?detail_checkout=$checkout_id' class='btn btn-primary'>Detail Order</a> ";
          echo "<a href='edit_order.php?edit_order=$checkout_id' class='btn btn-danger'>Edit Order</a>";
          echo "</td>";
          echo "</tr>";
          }
          $previous_checkout_id = $checkout_id;
        }
      }
        // Menutup koneksi database
        mysqli_close($con);
        ?>
      </tbody>
    </table>
  </div>