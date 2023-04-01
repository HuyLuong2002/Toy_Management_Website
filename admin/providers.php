<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
include_once $filepath . "\classes\product.php";
$product = new Product();
?>


<div class="card">
  <div class="card-header">
    <h3>Providers List</h3>
    <button onclick="window.location.href='provider_add.php'">
      Add provider <span class="las la-plus"></span>
    </button>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table width="100%">
        <thead>
          <tr>
            <td>ID</td>
            <td>Provider Name</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Provider 1</td>
            <td><a href="">Edit</a> | <a href="">Delete</a>
            <td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>