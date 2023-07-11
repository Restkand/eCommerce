<?php 

include('../includes/connect.php');
$dataPoints_category = category_sales();
?>

<div class="d-flex justify-content-center mt-5"> 
  <div id="chartContainer_categorySale" style="height: 300px; width: 60%;" class="mx-auto text-center">
  <script>
  {
    
    
    var chart = new CanvasJS.Chart("chartContainer_categorySale", {
        theme: "light2",
        animationEnabled: true,
        title: {
            text: "Category Terlaku Satu Bulan Terakhir"
        },
        data: [{
            type: "pie",
            indexLabel: "{y}",
            yValueFormatString: "#,##0.00\"%\"",
            indexLabelPlacement: "inside",
            indexLabelFontColor: "#36454F",
            indexLabelFontSize: 18,
            indexLabelFontWeight: "bolder",
            showInLegend: true,
            legendText: "{label}",
            dataPoints: <?php echo json_encode($dataPoints_category, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();
    
    }
    </script>
  </div>
</div>