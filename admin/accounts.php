<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
include_once $filepath . "\classes\product.php";
$product = new Product();
?>

<div class="card">
  <div class="card-header">
    <h3>Account List</h3>

    <button>
      Add account <span class="las la-plus"></span>
    </button>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table width="100%">
        <thead>
          <tr>
            <td>ID</td>
            <td>First Name</td>
            <td>Last Name</td>
            <td>Gender</td>
            <td>Date of birth</td>
            <td>Place of Birth</td>
            <td>Create Date</td>
            <td>Permission</td>
            <td>Status</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>abc</td>
            <td>cbd</td>
            <td>Nam</td>
            <td>18/02/2023</td>
            <td>TPHCM</td>
            <td>15/03/2023</td>
            <td>1</td>
            <td>1</td>
            <td><a href="">Edit</a> | <a href="">Delete</a>
            <td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>