<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/controller/chartController.php";
$chartController = new ChartController();

if (
  isset($_POST["year1"]) &&
  isset($_POST["year2"]) &&
  isset($_POST["year3"])
) {
  $year1 = $_POST["year1"];
  $year2 = $_POST["year2"];
  $year3 = $year2 - 1;
} else {
  $year1 = getdate()["year"];
  $year2 = getdate()["year"];
  $year3 = $year2 - 1;
}

//Solve chart 1
$result_statistic_revenue = $chartController->show_revenue_quarter($year1);
$data_quarter_1 = 0;
$data_quarter_2 = 0;
$data_quarter_3 = 0;
$data_quarter_4 = 0;
if (isset($result_statistic_revenue)) {
  if (isset($result_statistic_revenue->num_rows)) {
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
  $year2,
  $year3
);
$result_statistic_3_year1 = [];
$result_statistic_3_year2 = [];
for ($j = 1; $j <= 12; $j++) {
  $tmp = [$j, 0];
  array_push($result_statistic_3_year1, $tmp);
}

for ($j = 1; $j <= 12; $j++) {
  $tmp = [$j, 0];
  array_push($result_statistic_3_year2, $tmp);
}
if (isset($result_statistic_revenue_month)) {
  if (isset($result_statistic_revenue_month->num_rows)) {
    while ($result = $result_statistic_revenue_month->fetch_assoc()) {
      if ($result["Nam"] == $year2) {
        for ($j = 1; $j <= 12; $j++) {
          if ($j == $result["Thang"]) {
            $result_statistic_3_year1[$j][1] = $result["DoanhThu"];
          } else {
            $result_statistic_3_year1[$j][1] = 0;
          }
        }
      }

      if ($result["Nam"] == $year3) {
        for ($j = 1; $j <= 12; $j++) {
          if ($j == $result["Thang"]) {
            $result_statistic_3_year2[$j][1] = $result["DoanhThu"];
          } else {
            $result_statistic_3_year2[$j][1] = 0;
          }
        }
      }
    }
  }
}
?>

<div class="wrapper" id="wrapper">
  <div class="wrap-head-table">
    <h2>List of best-selling products</h2>

    <div class="wrap-date-choose">
      <div class="data-choose">
        <h4>Tìm khoảng thời gian</h4>
        <form>
          <div class="wrap-date">
            <div class="start-date">
              <label for="start_date">Ngày bắt đầu:</label>
              <input type="date" id="start_date" name="start_date" required dateFormat="yyyy-mm-dd">
            </div>

            <div class="end-date">
              <label for="end_date">Ngày kết thúc:</label>
              <input type="date" id="end_date" name="end_date" required dateFormat="yyyy-mm-dd">
            </div>
          </div>

          <button type="submit" class="search-date" onclick="validateDateInputs(event)">Tìm</button>
        </form>
      </div>
    </div>

    <div class="check-date" id="check-fail">
      <span>&times;</span> add review failed
    </div>
  </div>

  <div class="table-featured-product">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Sell Quantity</th>
        </tr>
      </thead>
      <tbody id="body_orders">
        <tr>
          <td>CC</td>
          <td>ok let me talk</td>
          <td>CC</td>
        </tr>
        <tr>
          <td>CC</td>
          <td>CC</td>
          <td>CC</td>
        </tr>
        <tr>
          <td>CC</td>
          <td>CC</td>
          <td>CC</td>
        </tr>
        <tr>
          <td>CC</td>
          <td>CC</td>
          <td>CC</td>
        </tr>
        <tr>
          <td>CC</td>
          <td>CC</td>
          <td>CC</td>
        </tr>
      </tbody>
    </table>
  </div>


  <div class="wrap-char chart-1">
    <h2>Statistical Revenue</h2>

    <select name="selectYear-1" id="selectYear-1" class="selectYear-1" onchange="handleUpdateCurrent()" value="2023">
      <script>
        var d = new Date();
        var year = d.getFullYear();
        var minYear = year - 2;
        var maxYear = 2030;
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
      <canvas id="myChart" width="300" height="450"></canvas>
      <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: ['Quarter 1', 'Quarter 2', 'Quarter 3', 'Quarter 4'],
            datasets: [{
              label: 'Quarterly Revenue',
              data: [<?php echo $data_quarter_1; ?>, <?php echo $data_quarter_2; ?>, <?php echo $data_quarter_3; ?>, <?php echo $data_quarter_4; ?>],
              backgroundColor: 'rgba(75, 192, 192, 0.2)',
              borderColor: 'rgba(75, 192, 192, 1)',
              borderWidth: 1
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            title: {
              display: true,
              text: 'My Chart Title',
              fontSize: 16,
              fontStyle: 'bold',
              padding: 20
            },
            legend: {
              display: true,
              position: 'mid',
              labels: {
                fontColor: 'black',
                fontSize: 14
              }
            },
            scales: {
              x: {
                beginAtZero: true
              },
              y: {
                beginAtZero: true
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
              padding: 20
            },
            responsive: true,
            maintainAspectRatio: false,
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
        var minYear = year - 2;
        var maxYear = 2030;
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
        var ctxLine = document.getElementById('lineChart').getContext('2d');
        var lineChart = new Chart(ctxLine, {
          type: 'line',
          data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
              label: '<?php echo $year2; ?>',
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
              ],
              fill: false,
              borderColor: 'rgba(75, 192, 192, 1)',
              backgroundColor: 'rgba(75, 192, 192, 0.2)',
              borderWidth: 1
            }, {
              label: '<?php echo $year3; ?>',
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
              ],
              fill: false,
              borderColor: 'rgba(255, 99, 132, 1)',
              backgroundColor: 'rgba(255, 99, 132, 0.2)',
              borderWidth: 1
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
            responsive: true,
            maintainAspectRatio: false,
          }
        });
      </script>

      <script src="./js/chart.js"></script>
    </div>
  </div>
</div>



