function renderChart(dataPoints) {
    var chart = new CanvasJS.Chart("chartContainer", {
        axisY: {
            title: "Number of Push-ups"
        },
        data: [{
            type: "line",
            dataPoints: dataPoints
        }]
    });
    chart.render();
}