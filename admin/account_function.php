<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/database/connectDB.php";
include_once $filepath . "/controller/account_functionController.php";
$account_functionController = new AccountFunctionController();

if (isset($_GET["deleteid"])) {
  $delete_id = $_GET["deleteid"];
  $delete_account_function = $account_functionController->delete_account_function($delete_id);
}
?>

<div class="card">
  <div class="card-header">
    <h3>Account Function List</h3>
    <?php
        if(isset($delete_account_function))
        {
            echo $delete_account_function;
        }
    ?>
    <button>
      <a href="account_function_add.php">
        Add account function <span class="las la-plus"></span>
      </a>
    </button>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table width="100%">
        <thead>
          <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          <?php
            $show_account_function = $account_functionController->show_account_function();
            if($show_account_function)
            {
              while($result = $show_account_function->fetch_array()){

          ?>
          <tr>
            <td><?php echo $result["id"]; ?></td>
            <td><?php echo $result["name"]; ?></td>
            <td>
              <a href="account_function_edit.php?id=<?php echo $result[0]; ?>" class="edit">Edit <i class="fa-solid fa-pen-to-square" style="color: #0600ff;"></i></a>
              <a href="?id=12&deleteid=<?php echo $result[0]; ?>" class="delete">Delete <i class="fa-solid fa-trash" style="color: #ff0000;"></i></a>
            <td>
          </tr>
          <?php
              }
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>