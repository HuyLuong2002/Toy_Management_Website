<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/controller/chartController.php";
$chartController = new ChartController();
if(isset($_GET["current_year"]))
{
  $listYear = $_GET["current_year"];
}
else {
  $listYear = [];
  $listYear[0] = getdate()["year"];
}
//Solve chart 1
$result_statistic_revenue = $chartController->show_revenue_quarter($listYear[0]);
$data_quarter_1 = 0;
$data_quarter_2 = 0;
$data_quarter_3 = 0;
$data_quarter_4 = 0;
if (isset($result_statistic_revenue)) {
  while ($result = $result_statistic_revenue->fetch_assoc()) {
    if ($result["Quy"] == 1) {
      $data_quarter_1 = $result["DoanhThu"];
    }
    if ($result["Quy"] == 2) {
      $data_quarter_2 = $result["DoanhThu"];
    }
    if ($result["Quy"] == 3) {
      $data_quarter_3 = $result["DoanhThu"];
    }
    if ($result["Quy"] == 4) {
      $data_quarter_4 = $result["DoanhThu"];
    }
  }
}
// Solve chart 2
$result_statistic_order = $chartController->show_statistic_order();
$result_statistic_2 = [0, 0, 0];
if (isset($result_statistic_order)) {
  while ($result = $result_statistic_order->fetch_assoc()) {
    $result_statistic_2[$result["TinhTrangDonHang"]] = $result["SoLuongHoaDon"];
  }
}
//Solve chart 3
$result_statistic_revenue_month = $chartController->show_statistic_revenue_by_month(
  2022,
  2023
);
$result_statistic_3_year1 = [];
$result_statistic_3_year2 = [];
if (isset($result_statistic_revenue_month)) {
  while ($result = $result_statistic_revenue_month->fetch_assoc()) {
    if ($result["Nam"] == 2022) {
      for ($j = 1; $j <= 12; $j++) {
        if ($j == $result["Thang"]) {
          $tmp = [$j, $result["DoanhThu"]];
          array_push($result_statistic_3_year1, $tmp);
        } else {
          $tmp = [$j, 0];
          array_push($result_statistic_3_year1, $tmp);
        }
      }
    }

    if ($result["Nam"] == 2023) {
      for ($j = 1; $j <= 12; $j++) {
        if ($j == $result["Thang"]) {
          $tmp = [$j, $result["DoanhThu"]];
          array_push($result_statistic_3_year2, $tmp);
        } else {
          $tmp = [$j, 0];
          array_push($result_statistic_3_year2, $tmp);
        }
      }
    }
  }
}
?>
<div class="wrapper">

  <div class="wrap-char chart-1">
    <h2>Statistical Revenue</h2>

    <select name="selectYear-1" id="selectYear-1" class="selectYear-1" onchange="handleUpdateCurrent()" value="2023">
      <script>
        var d = new Date();
        var year = d.getFullYear();
        // Đặt giá trị min và max cho phạm vi năm của combobox
        var minYear = year - 2;
        var maxYear = 2030;
        // Sử dụng vòng lặp for để hiển thị các năm
        for (var i = minYear; i <= maxYear; i++) {
          var option = document.createElement("option");
          option.text = i;
          option.value = i;
          var select = document.getElementById("selectYear-1");
          if (i === 2023) {
            option.setAttribute("selected", "selected");
          }
          select.appendChild(option);
        }
      </script>
    </select>

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

  <div class="wrap-char chart-2">
    <h2>Statistical Orders</h2>

    <div class="chart-Pie">
      <canvas id="pieChart" width="500" height="500"></canvas>

      <script>
        // JavaScript code for creating and configuring the pie chart
        var ctxPie = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(ctxPie, {
          type: 'pie',
          data: {
            labels: ['Đang giao hàng', 'Đã giao', 'Chờ xử lý'],
            datasets: [{
              data: [<?php echo $result_statistic_2[0]; ?>, <?php echo $result_statistic_2[1]; ?>, <?php echo $result_statistic_2[2]; ?>],
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

  <div class="wrap-char chart-3">
    <h2>Statistical Revenue</h2>

    <select name="selectYear-3" id="selectYear-3" class="selectYear-3" onchange="handleUpdateCurrent()" value="2023">
      <script>
        var d = new Date();
        var year = d.getFullYear();
        // Đặt giá trị min và max cho phạm vi năm của combobox
        var minYear = year - 2;
        var maxYear = 2030;
        // Sử dụng vòng lặp for để hiển thị các năm
        for (var i = minYear; i <= maxYear; i++) {
          var option = document.createElement("option");
          option.text = i;
          option.value = i;
          var select = document.getElementById("selectYear-3");
          if (i === 2023) {
            option.setAttribute("selected", "selected");
          }
          select.appendChild(option);
        }
      </script>
    </select>

    <div class="chart-line">
      <canvas id="lineChart" width="200" height="400"></canvas>

      <script>
        // JavaScript code for creating and configuring the line chart
        var ctxLine = document.getElementById('lineChart').getContext('2d');
        var lineChart = new Chart(ctxLine, {
          type: 'line', // Set type to line
          data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
              label: '2022', // Label for the dataset
              data: [
                <?php echo $result_statistic_3_year1[0][1]; ?>,
                <?php echo $result_statistic_3_year1[1][1]; ?>,
                <?php echo $result_statistic_3_year1[2][1]; ?>,
                <?php echo $result_statistic_3_year1[3][1]; ?>,
                <?php echo $result_statistic_3_year1[4][1]; ?>,
                <?php echo $result_statistic_3_year1[5][1]; ?>,
                <?php echo $result_statistic_3_year1[6][1]; ?>,
                <?php echo $result_statistic_3_year1[7][1]; ?>,
                <?php echo $result_statistic_3_year1[8][1]; ?>,
                <?php echo $result_statistic_3_year1[9][1]; ?>,
                <?php echo $result_statistic_3_year1[10][1]; ?>,
                <?php echo $result_statistic_3_year1[11][1]; ?>
              ], // Data points
              fill: false, // Set fill to false to draw only lines, not filled areas
              borderColor: 'rgba(75, 192, 192, 1)', // Border color of the line
              backgroundColor: 'rgba(75, 192, 192, 0.2)', // Background color of the filled area
              borderWidth: 1 // Border width of the line
            }, {
              label: '2023', // Label for the dataset
              data: [
                <?php echo $result_statistic_3_year2[0][1]; ?>,
                <?php echo $result_statistic_3_year2[1][1]; ?>,
                <?php echo $result_statistic_3_year2[2][1]; ?>,
                <?php echo $result_statistic_3_year2[3][1]; ?>,
                <?php echo $result_statistic_3_year2[4][1]; ?>,
                <?php echo $result_statistic_3_year2[5][1]; ?>,
                <?php echo $result_statistic_3_year2[6][1]; ?>,
                <?php echo $result_statistic_3_year2[7][1]; ?>,
                <?php echo $result_statistic_3_year2[8][1]; ?>,
                <?php echo $result_statistic_3_year2[9][1]; ?>,
                <?php echo $result_statistic_3_year2[10][1]; ?>,
                <?php echo $result_statistic_3_year2[11][1]; ?>
              ], // Data points
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

<script src="./js/chart.js"></script>