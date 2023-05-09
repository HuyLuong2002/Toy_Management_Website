<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
include_once $filepath . "\controller\dashboardController.php";
include_once $filepath . "\controller\productsController.php";
include_once $filepath . "\controller\accountController.php";
include_once $filepath . "\helpers\\format.php";

$fm = new Format();
$dashboardController = new DashboardController();
$productsController = new ProductsController();
$accountController = new AccountController();
$count_product = $dashboardController->show_statistic_product();
$count_order = $dashboardController->show_statistic_order();
$count_customers = $dashboardController->show_statistic_customer();
$income = $dashboardController->show_statistic_income();

?>
<div>
  <div class="admin-cards">
    <div class="admin-card-single">
      <div>
      <?php if(isset($count_customers)) { 
        ?>
        <h1><?php echo $count_customers->fetch_array()[0]; ?></h1>
        <?php
        }
        ?>
        <span>Customers</span>
      </div>

      <div>
        <span class="las la-users"> </span>
      </div>
    </div>

    <div class="admin-card-single">
      <div>
        <?php if(isset($count_product)) { 
        ?>
        <h1><?php echo $count_product->fetch_array()[0]; ?></h1>
        <?php
        }
        ?>
        <span>Products</span>
      </div>

      <div>
        <span class="las la-clipboard-list"> </span>
      </div>
    </div>

    <div class="admin-card-single">
      <div>
        <?php
          if(isset($count_order)) {
        ?>
        <h1><?php echo $count_order->fetch_array()[0]; ?></h1>
        <?php
        }
        ?>
        <span>Orders</span>
      </div>


      <div>
        <span class="las la-shopping-cart"> </span>
      </div>
    </div>

    <div class="admin-card-single">
      <div>
      <?php
          if(isset($income)) {
        ?>
        <h1><?php echo $fm->formatPriceDecimal($income); ?></h1>
        <?php
        }
        ?>
        <span>Income</span>
      </div>

      <div>
        <span class="lab la-google-wallet"> </span>
      </div>
    </div>
  </div>

  <div class="recent-grid">
    <div class="projects">
      <div class="card">
        <div class="card-header">
          <h3>Recent Products</h3>
          <button>
            See all <span class="las la-arrow-right"></span>
          </button>
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <table width="100%">
              <thead>
                <tr>
                  <td>Product Name</td>
                  <td>Image</td>
                  <td>Price</td>
                  <td>Quantity</td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php
                  $show_product = $productsController->show_product();
                  if ($show_product) {
                    while ($result_product = $show_product->fetch_array()) { ?>
                      <td><?php echo $result_product[1]; ?></td>
                      <td>
                        <img src="<?php echo "uploads/" .
                          $result_product[2]; ?>" alt="" width="100px">
                      </td>
                      <td>
                        <?php echo $result_product[3]; ?>
                      </td>
                      <td>
                        <?php echo $result_product[10]; ?>
                      </td>
                </tr>
            <?php }
                  }
                  ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="customers">
      <div class="card">
        <div class="card-header">
          <h3>New customer</h3>
          <button>
            See all <span class="las la-arrow-right"></span>
          </button>
        </div>

        <div class="card-body">
          <?php
            $show_account = $accountController->show_account_user();
            if($show_account)
            {
              while($result = $show_account->fetch_assoc()) {
          ?>
          <div class="customer">
            <div class="info">

              <img src="assets/images/pic-1.png" width="40px" height="40px" alt="" />
              <div>
                <h4><?php echo $result["firstname"] . " " . $result["lastname"]; ?></h4>
              </div>

            </div>

            <div class="contact">
              <span class="las la-user-circle"> </span>
              <span class="las la-comment"> </span>
              <span class="las la-phone"> </span>
            </div>
          </div>
          <?php
                  }
                }
              ?>
        </div>
      </div>
    </div>
  </div>
</div>