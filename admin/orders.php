<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
include_once $filepath . "\classes\product.php";
$product = new Product();
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
            <td>Status</td>
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
            <td>Đang giao hàng</td>
            <td><a href="">Edit</a> | <a href="">Delete</a>
            <td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>