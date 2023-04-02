<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
include_once $filepath . "\classes\product.php";
$product = new Product();
?>


<div class="card">
  <div class="card-header">
    <h3>Sales List</h3>
    <button>
      Add sale <span class="las la-plus"></span>
    </button>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table width="100%">
        <thead>
          <tr>
            <td>ID</td>
            <td>Sale Name</td>
            <td>Create Date</td>
            <td>Start Date</td>
            <td>End Date</td>
            <td>Percent sale</td>
            <td>Status</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Không áp dụng</td>
            <td>16/03/2023</td>
            <td>18/03/2023</td>
            <td>20/03/2023</td>
            <td>0</td>
            <td>1</td>
            <td><a href="">Edit</a> | <a href="">Delete</a>
            <td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>