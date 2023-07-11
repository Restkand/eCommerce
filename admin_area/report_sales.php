<?php 

include('../includes/connect.php');
$datapoints_sales = daily_sales();
?>
<div class="d-flex justify-content-center">
  <div class="text-center">
    <h2>Laporan Penjualan</h2>
  </div>
</div>

<div class="d-flex justify-content-center mt-3"> 
  <div id="chartContainer_sales" style="height: 300px; width: 60%;" class="mx-auto text-center">
    <script>
      window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer_sales", {
          title: {
            text: "Penjualan 7 Hari Terakhir"
          },
          axisY: {
            title: "Total Harga"
          },
          data: [{
            type: "line",
            dataPoints: <?php echo json_encode($datapoints_sales, JSON_NUMERIC_CHECK); ?>
          }]
        });

        chart.render();
      }
    </script>
  </div>
</div>
