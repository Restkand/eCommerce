<?php
require_once('../PDF/vendor/autoload.php');
include('../includes/connect.php');

global $con;

use Dompdf\Dompdf;

if (isset($_POST['generate_pdf'])) {
    // Ambil tanggal dari form
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Format tanggal
    $formatted_start_date = date('d/m/Y', strtotime($start_date));
    $formatted_end_date = date('d/m/Y', strtotime($end_date));

    // Query SQL dengan tanggal yang dipilih
    $sql = "SELECT p.product_id, p.product_title, p.product_price, p.date
          FROM products AS p
          INNER JOIN checkout_details AS cd ON p.product_id = cd.product_id
          WHERE  p.date BETWEEN '$start_date' AND '$end_date'
          GROUP BY p.product_id, p.product_title, p.product_price";

    // Eksekusi query
    $result = mysqli_query($con, $sql);

    // Membuat tabel dalam HTML
    $html = '<h1 style="text-align: center;">Jurnal Pembelian Produk</h1>';
    $html .= '<p style="text-align: center;">' . $formatted_start_date . ' - ' . $formatted_end_date . '</p>';
    $html .= '<table style="border-collapse: collapse; width: 100%; border: 1px solid black;">';
    $html .= '<thead><tr><th style="border: 1px solid black; padding: 8px;">Tanggal</th><th style="border: 1px solid black; padding: 8px;">Product ID</th><th style="border: 1px solid black; padding: 8px;">Product Title</th><th style="border: 1px solid black; padding: 8px;">Product Price</th></tr></thead>';
    $html .= '<tbody>';
    while ($row = mysqli_fetch_assoc($result)) {
        $html .= '<tr>';
        $date_checkout = $row['date'];
        $date_checkout = date('d/m/Y', strtotime($date_checkout));
        $html .= '<td style="border: 1px solid black; padding: 8px;">' . $date_checkout . '</td>';
        $html .= '<td style="border: 1px solid black; padding: 8px;">' . $row['product_id'] . '</td>';
        $html .= '<td style="border: 1px solid black; padding: 8px;">' . $row['product_title'] . '</td>';
        $product_price = $row['product_price'];
        $html .= '<td style="border: 1px solid black; padding: 8px;">Rp ' . $product_price = number_format($product_price, 0, ',','.') . '</td>';
        $html .= '</tr>';
    }
    $html .= '</tbody>';
    mysqli_data_seek($result, 0);
    $total_product_price = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $total_product_price += $row['product_price'];
    }
    $total_product_price = number_format($total_product_price, 0, ',','.');
    $html .= '<tfoot>';
    $html .= '<tr>';
    $html .= '<td colspan="3" style="text-align: right; border: 1px solid black; padding: 8px;"><strong>Total Terjual:</strong></td>';
    $html .= '<td style="border: 1px solid black; padding: 8px;">Rp ' . $total_product_price . '</td>';
    $html .= '</tr>';
    $html .= '</tfoot>';
    $html .= '</table>';
    $html .= '<br><br><hr>';

    // Buat halaman baru untuk jurnal product terjual
    $html .= '<pagebreak />';
    $html .= '<h1 style="text-align: center;">Rekapitulasi Pembelian Produk</h1>';
    $html .= '<p style="text-align: center;">' . $formatted_start_date . ' - ' . $formatted_end_date . '</p>';
    $html .= '<table style="border-collapse: collapse; width: 100%; border: 1px solid black;">';
    $html .= '<thead><tr><th style="border: 1px solid black; padding: 8px;">Keterangan</th><th style="border: 1px solid black; padding: 8px; border-bottom: 2px solid black;">Debit</th><th style="border: 1px solid black; padding: 8px; border-bottom: 2px solid black;">Kredit</th></tr></thead>';
    $html .= '<tbody>';
    // body
    $html .= '<tr>';
    $html .= '<td style="border: 1px solid black; padding: 8px;">' . 'Pembelian' . '</td>';
    $html .= '<td style="border: 1px solid black; padding: 8px;">Rp ' . $total_product_price . '</td>';
    $html .= '<td style="border: 1px solid black; padding: 8px;">' . '' . '</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td style="border: 1px solid black; padding: 8px;">' . 'Utang Dagang' . '</td>';
    $html .= '<td style="border: 1px solid black; padding: 8px;">' . '' . '</td>';
    $html .= '<td style="border: 1px solid black; padding: 8px;">Rp ' . $total_product_price . '</td>';
    $html .= '</tr>';
    // endbody
    $html .= '</tbody>';
    $html .= '<tfoot>';
    $html .= '<tr>';
    $html .= '<td style="border: 1px solid black; padding: 8px;">' . '' . '</td>';
    $html .= '<td style="border: 1px solid black; padding: 8px;">Rp ' . $total_product_price . '</td>';
    $html .= '<td style="border: 1px solid black; padding: 8px;">Rp ' . $total_product_price . '</td>';
    $html .= '</tr>';
    $html .= '</tfoot>';
    $html .= '</table>';

    // Buat objek Dompdf
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);

    // Konfigurasi ukuran dan orientasi halaman
    $dompdf->setPaper('A4', 'portrait');

    // Render HTML ke PDF
    $dompdf->render();

    // Menghasilkan file PDF
    $dompdf->stream('rekapitulasi_penjualan.pdf', array('Attachment' => 0));
}
?>
