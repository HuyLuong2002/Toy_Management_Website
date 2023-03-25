<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
include_once $filepath . "\classes\product.php";
$product = new Product();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Orders Management</title>
    <link
      rel="stylesheet"
      href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css"
    />
    <link rel="stylesheet" href="./css/index.css" />
    <link rel="stylesheet" href="./css/table-list.css" />
  </head>

  <body>
    <?php
    $filepath_order = realpath(dirname(__DIR__));
    include_once $filepath_order . "\admin\components\header.php";
    include_once $filepath_order . "\admin\components\slidebar.php";
    ?>

    <div class="card">
      <div class="card-header">
        <h3>Orders List</h3>
        <button>
        Add order <span class="las la-plus"></span>
        </button>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table width="100%">
            <thead>
              <tr>
                <td>ID</td>
                <td>Customer</td>
                <td>Quantity</td>
                <td>Date</td>
                <td>Total Price</td>
                <td>Payment Method</td>
                <td>Action</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>abc</td>
                <td>2</td>
                <td>18/02/2023</td>
                <td>3000</td>
                <td>Cash</td>
                <td><a href="">Edit</a> | <a href="">Delete</a><td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <script src="./js/paginate.js"></script>
  </body>
</html>
