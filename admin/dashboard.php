<?php
$filepath = realpath(dirname(__DIR__));
include_once($filepath . "\database\connectDB.php");
include_once($filepath . "\classes\product.php");
$product = new Product();
?>
<div>
  <div class="admin-cards">
    <div class="admin-card-single">
      <div>
        <h1>54</h1>
        <span>Customers</span>
      </div>

      <div>
        <span class="las la-users"> </span>
      </div>
    </div>

    <div class="admin-card-single">
      <div>
        <h1>79</h1>
        <span>Products</span>
      </div>

      <div>
        <span class="las la-clipboard-list"> </span>
      </div>
    </div>

    <div class="admin-card-single">
      <div>
        <h1>124</h1>
        <span>Orders</span>
      </div>


      <div>
        <span class="las la-shopping-cart"> </span>
      </div>
    </div>

    <div class="admin-card-single">
      <div>
        <h1>$6k</h1>
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
                  $show_product = $product->show_product();
                  if ($show_product) {
                    while (
                      $result_product = $show_product->fetch_array()
                    ) { ?>
                      <td><?php echo $result_product[1]; ?></td>
                      <td>
                        <img src="<?php echo "uploads/" . $result_product[2]; ?>" alt="" width="100px">
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
          <div class="customer">
            <div class="info">
              <img src="assets/images/pic-1.png" width="40px" height="40px" alt="" />
              <div>
                <h4>Lewis S. Cunningham</h4>
                <small>CEO Excerpt</small>
              </div>
            </div>

            <div class="contact">
              <span class="las la-user-circle"> </span>
              <span class="las la-comment"> </span>
              <span class="las la-phone"> </span>
            </div>
          </div>

          <div class="customer">
            <div class="info">
              <img src="assets/images/pic-1.png" width="40px" height="40px" alt="" />
              <div>
                <h4>Lewis S. Cunningham</h4>
                <small>CEO Excerpt</small>
              </div>
            </div>

            <div class="contact">
              <span class="las la-user-circle"> </span>
              <span class="las la-comment"> </span>
              <span class="las la-phone"> </span>
            </div>
          </div>

          <div class="customer">
            <div class="info">
              <img src="assets/images/pic-1.png" width="40px" height="40px" alt="" />
              <div>
                <h4>Lewis S. Cunningham</h4>
                <small>CEO Excerpt</small>
              </div>
            </div>

            <div class="contact">
              <span class="las la-user-circle"> </span>
              <span class="las la-comment"> </span>
              <span class="las la-phone"> </span>
            </div>
          </div>

          <div class="customer">
            <div class="info">
              <img src="assets/images/pic-1.png" width="40px" height="40px" alt="" />
              <div>
                <h4>Lewis S. Cunningham</h4>
                <small>CEO Excerpt</small>
              </div>
            </div>

            <div class="contact">
              <span class="las la-user-circle"> </span>
              <span class="las la-comment"> </span>
              <span class="las la-phone"> </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>