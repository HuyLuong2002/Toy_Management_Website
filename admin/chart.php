<?php
    $filepath = realpath(dirname(__DIR__));
    include_once $filepath . "/controller/chartController.php";
    $chartController = new ChartController();
    $result_statistic = $chartController->show_revenue_quarter(2023);
    $data_quarter_1 = 0;
    $data_quarter_2 = 0;
    $data_quarter_3 = 0;
    $data_quarter_4 = 0;
    if(isset($result_statistic))
    {
        while($result = $result_statistic->fetch_assoc())
        {
            if($result["Quy"] == 1)
            {
                $data_quarter_1 = $result["DoanhThu"];
            }
            if($result["Quy"] == 2)
            {
                $data_quarter_2 = $result["DoanhThu"];
            }
            if($result["Quy"] == 3)
            {
                $data_quarter_3 = $result["DoanhThu"];
            }
            if($result["Quy"] == 4)
            {
                $data_quarter_4 = $result["DoanhThu"];
            }
        }
    }
?>
<div class="wrapper">

    <div class="wrap-char">
        <h2>Statistical Revenue</h2>

        <div class="chart-bar">
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <!-- Chart will be rendered here -->
            <canvas id="myChart" width="300" height="450"></canvas>
            <script>
                // JavaScript code for creating and configuring the chart
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Quarter 1', 'Quarter 2', 'Quarter 3', 'Quarter 4'],
                        datasets: [{
                            label: 'Quarterly Revenue',
                            data: [<?php echo $data_quarter_1; ?>, <?php echo $data_quarter_2; ?>, <?php echo $data_quarter_3; ?>, <?php echo $data_quarter_4; ?>],
                            backgroundColor: 'rgba(75, 192, 192, 0.2)', // specify chart color
                            borderColor: 'rgba(75, 192, 192, 1)', // specify border color
                            borderWidth: 1 // specify border width
                        }]
                    },
                    options: {
                        responsive: true, // make the chart responsive
                        maintainAspectRatio: false, // allow chart to not maintain aspect ratio
                        title: {
                            display: true,
                            text: 'My Chart Title',
                            fontSize: 16,
                            fontStyle: 'bold',
                            padding: 20
                        },
                        legend: {
                            display: true,
                            position: 'mid', // specify legend position (top, bottom, left, right)
                            labels: {
                                fontColor: 'black', // specify font color for legend labels
                                fontSize: 14 // specify font size for legend labels
                            }
                        },
                        scales: {
                            x: {
                                beginAtZero: true // start x-axis from zero
                            },
                            y: {
                                beginAtZero: true // start y-axis from zero
                            }
                        }
                    }
                });
            </script>
        </div>
    </div>

    <div class="wrap-char">
        <h2>Statistical Product</h2>

        <div class="chart-Pie">
            <canvas id="pieChart" width="500" height="500"></canvas>

            <script>
                // JavaScript code for creating and configuring the pie chart
                var ctxPie = document.getElementById('pieChart').getContext('2d');
                var pieChart = new Chart(ctxPie, {
                    type: 'pie',
                    data: {
                        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                        datasets: [{
                            data: [12, 19, 3, 5, 2, 3],
                            backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'],
                            borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: 'My Pie Chart Title',
                            fontSize: 16,
                            fontStyle: 'bold',
                            padding: 20 // add padding around the title
                        },
                        responsive: true, // Set responsive to false
                        maintainAspectRatio: false,
                        // other options for the pie chart can be added here
                        // ...
                    }
                });
            </script>
        </div>
    </div>

    <div class="wrap-char">
        <h2>Statistical Revenue</h2>

        <div class="chart-line">
            <canvas id="lineChart" width="200" height="400"></canvas>

            <script>
                // JavaScript code for creating and configuring the line chart
                var ctxLine = document.getElementById('lineChart').getContext('2d');
                var lineChart = new Chart(ctxLine, {
                    type: 'line', // Set type to line
                    data: {
                        labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                        datasets: [{
                            label: 'Dataset 1', // Label for the dataset
                            data: [65, 59, 80, 81, 56, 55], // Data points
                            fill: false, // Set fill to false to draw only lines, not filled areas
                            borderColor: 'rgba(75, 192, 192, 1)', // Border color of the line
                            backgroundColor: 'rgba(75, 192, 192, 0.2)', // Background color of the filled area
                            borderWidth: 1 // Border width of the line
                        }, {
                            label: 'Dataset 2', // Label for the dataset
                            data: [28, 48, 40, 19, 86, 27], // Data points
                            fill: false, // Set fill to false to draw only lines, not filled areas
                            borderColor: 'rgba(255, 99, 132, 1)', // Border color of the line
                            backgroundColor: 'rgba(255, 99, 132, 0.2)', // Background color of the filled area
                            borderWidth: 1 // Border width of the line
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: 'My Line Chart Title',
                            fontSize: 16,
                            fontStyle: 'bold',
                            padding: 20
                        },
                        responsive: true, // Set responsive to false
                        maintainAspectRatio: false,
                    }
                });
            </script>
        </div>
    </div>

</div>