<?php

require_once '../functions/ongkir_function.php';

function daily_sales(){
    global $con;
 
    $today = date("Y-m-d");
    $dateRangeStart = date('Y-m-d', strtotime('-7 days', strtotime($today)));
    $todayDateTime = date('Y-m-d H:i:s');
   
    $sql = "SELECT DATE(c.date_checkout) AS tanggal, COALESCE(SUM(ip.harga_product), 0) AS total_harga
    FROM checkout_details AS c
    LEFT JOIN info_penerima AS ip ON c.order_id = ip.order_id
    INNER JOIN bukti_pembayaran AS bp ON c.sub_order_id = bp.sub_order_id
    WHERE bp.status_pembayaran = 'Terkonfirmasi' AND c.date_checkout >= '$dateRangeStart' AND c.date_checkout <= '$todayDateTime'
    GROUP BY tanggal
    ORDER BY tanggal";
   
    $result = mysqli_query($con, $sql);
   
    // Membuat array datapoints
    $datapoints = array();
    $startDate = new DateTime($dateRangeStart);
    $endDate = new DateTime($today);
   
    $dateRange = new DatePeriod($startDate, new DateInterval('P1D'), $endDate);
   
    foreach ($dateRange as $date) {
        $tanggal = $date->format('Y-m-d');
        $found = false;
   
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['tanggal'] == $tanggal) {
                $totalHarga = $row['total_harga'];
                $found = true;
                break;
            }
        }
   
        if (!$found) {
            $totalHarga = 0;
        }
   
        $datapoints[] = array("label" => $tanggal, "y" => $totalHarga);
   
        mysqli_data_seek($result, 0);
    }

    return $datapoints;
}

function category_sales(){
    global $con;
 
    $today = date("Y-m-d");
    $dateRangeStart = date('Y-m-d', strtotime('-30 days', strtotime($today)));
    $todayDateTime = date('Y-m-d H:i:s');
   
    $sql = "SELECT p.category_id, c.category_title, COUNT(*) as jumlah_terjual
    FROM checkout_details AS cd
    LEFT JOIN products AS p ON cd.product_id = p.product_id
    INNER JOIN bukti_pembayaran AS bp ON cd.sub_order_id = bp.sub_order_id
    INNER JOIN categories AS c ON p.category_id = c.category_id
    WHERE bp.status_pembayaran = 'Terkonfirmasi' AND cd.date_checkout >= '$dateRangeStart' AND cd.date_checkout <= '$todayDateTime'
    GROUP BY p.category_id
    ORDER BY jumlah_terjual DESC";
   
    $result = mysqli_query($con, $sql);
   
    // Membuat array datapoints
    $datapoints = array();
    $total_terjual = 0;
   
    while ($row = mysqli_fetch_assoc($result)) {
        $total_terjual += $row['jumlah_terjual'];
    }

    // Menghitung persentase terjual untuk setiap kategori
    mysqli_data_seek($result, 0);

    while ($row = mysqli_fetch_assoc($result)) {
        $category_id = $row['category_id'];
        $category_title = $row['category_title'];
        $jumlah_terjual = $row['jumlah_terjual'];
        $percentage = ($jumlah_terjual / $total_terjual) * 100;
   
        $datapoints[] = array("label" => $category_title, "y" => $percentage);
    }

    return $datapoints;
}

function location_sales(){
    global $con;
    $data = new RajaOngkir();

    $kota = $data->get_city();

    $today = date("Y-m-d");
    $dateRangeStart = date('Y-m-d', strtotime('-30 days', strtotime($today)));
    $todayDateTime = date('Y-m-d H:i:s');
   
    $sql = "SELECT ip.id_kota_penerima, COUNT(*) as jumlah_terjual
    FROM checkout_details AS c
    LEFT JOIN info_penerima AS ip ON c.order_id = ip.order_id
    INNER JOIN bukti_pembayaran AS bp ON c.sub_order_id = bp.sub_order_id
    WHERE bp.status_pembayaran = 'Terkonfirmasi' AND c.date_checkout >= '$dateRangeStart' AND c.date_checkout <= '$todayDateTime'
    GROUP BY ip.id_kota_penerima
    ORDER BY jumlah_terjual DESC
    LIMIT 7";
   
    $result = mysqli_query($con, $sql);
   
    // Membuat array datapoints
    $datapoints = array();
    $total_terjual = 0;
   
    while ($row = mysqli_fetch_assoc($result)) {
        $total_terjual += $row['jumlah_terjual'];
    }

    // Menghitung persentase terjual untuk setiap lokasi
    mysqli_data_seek($result, 0);

    while ($row = mysqli_fetch_assoc($result)) {
        $id_kota_penerima = $row['id_kota_penerima'];
        // Menggunakan API Raja Ongkir untuk mendapatkan nama kota berdasarkan id_kota_penerima
        $kota = $data->get_city_name($id_kota_penerima);

        $jumlah_terjual = $row['jumlah_terjual'];
        $percentage = ($jumlah_terjual / $total_terjual) * 100;
   
        $datapoints[] = array("label" => $kota, "y" => $percentage);
    }

    return $datapoints;
}


?>
