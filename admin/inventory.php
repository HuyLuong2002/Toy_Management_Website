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
    <title>Inventory Management</title>
    <link
      rel="stylesheet"
      href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css"
    />
    <link rel="stylesheet" href="./css/index.css" />
    <link rel="stylesheet" href="./css/table-list.css" />
  </head>

  <body>
    <?php
    $filepath_inventory = realpath(dirname(__DIR__));
    include_once $filepath_inventory . "\admin\components\header.php";
    include_once $filepath_inventory . "\admin\components\slidebar.php";
    ?>

    <div class="card">
      <div class="card-header">
        <h3>Receipt List</h3>
        <button>
        Add receipt <span class="las la-plus"></span>
        </button>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table width="100%">
            <thead>
              <tr>
                <td>ID</td>
                <td>Enter Date</td>
                <td>Total Quantity</td>
                <td>Total Price</td>
                <td>Provider</td>
                <td>Enter Employee</td>
                <td>Status</td>
                <td>Create Date</td>
                <td>Action</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>18/02/2023</td>
                <td>10</td>
                <td>3000</td>
                <td>1</td>
                <td>1</td>
                <td>Đang xử lý</td>
                <td>25/03/2023</td>
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
