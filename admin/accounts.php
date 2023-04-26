<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/database/connectDB.php";
include_once $filepath . "/controller/accountController.php";
$accountController = new AccountController();

if (isset($_GET["deleteid"])) {
  $delete_id = $_GET["deleteid"];
  $delete_account = $accountController->delete_account($delete_id);
}
?>

<div class="card">
  <div class="card-header">
    <h3>Account List</h3>

    <button>
      <a href="account_permission.php">
        Add account permission <span class="las la-plus"></span>
      </a>
    </button>

    <button>
      <a href="account_add.php">
        Add account <span class="las la-plus"></span>
      </a>
    </button>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table width="100%">
        <thead>
          <tr>
            <td>ID</td>
            <td>Username</td>
            <td>Password</td>
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
          <?php
            $show_account = $accountController->show_account();
            if($show_account)
            {
              while($result = $show_account->fetch_array()){

          ?>
          <tr>
            <td><?php echo $result[0]; ?></td>
            <td><?php echo $result["username"]; ?></td>
            <td><?php echo $result["password"]; ?></td>
            <td><?php echo $result["firstname"]; ?></td>
            <td><?php echo $result["lastname"]; ?></td>
            <td><?php echo $result["gender"]; ?></td>
            <td><?php echo $result["date_birth"]; ?></td>
            <td><?php echo $result["place_of_birth"]; ?></td>
            <td><?php echo $result["create_date"]; ?></td>
            <td><?php echo $result["name"]; ?></td>
            <?php
              if($result["status"] == 1)
              {
                $status = "Đang hoạt động";
              }
              else $status = "Ngừng hoạt động";
            ?>
            <td><?php echo $status; ?></td>
            <td>
              <a href="account_edit.php?id=<?php echo $result[0]; ?>" class="edit">Edit <i class="fa-solid fa-pen-to-square" style="color: #0600ff;"></i></a>
              <a href="?id=5&deleteid=<?php echo $result[0]; ?>" class="delete">Delete <i class="fa-solid fa-trash" style="color: #ff0000;"></i></a>
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