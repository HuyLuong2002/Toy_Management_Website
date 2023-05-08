<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/database/connectDB.php";
include_once $filepath . "/controller/accountController.php";
include_once $filepath . "/helpers/pagination.php";

$accountController = new AccountController();
$pag = new Pagination();

if (isset($_GET["deleteid"])) {
  $delete_id = $_GET["deleteid"];
  $delete_account = $accountController->delete_account($delete_id);
}

if (isset($_GET["id"])) {
  $id = $_GET["id"];
}

if (isset($_GET["page"])) {
  $page_id = $_GET["page"];
  $pagination_id = $page_id;
}

/*
Tính giá trị của phân trang, 10 sale trên 1 trang
*/
$result_pagination = $accountController->show_account();
$account_total = mysqli_num_rows($result_pagination);

// Số sản phẩm trên 1 trang
$page_total = ceil($account_total / 10);

// trang hiện tại
if (isset($page_id)) {
  $current_page = $page_id;
}
// Vị trí hiện tại
if (isset($current_page)) {
  $current_position = ($current_page - 1) * 10;
}
if (isset($current_position)) {
  $result_pagination = $accountController->show_account_by_pagination(
    $current_position,
    10
  );
}
?>

<div class="card">
  <div class="card-header">
    <h3>Account List</h3>

    <button>
      <a href="account_permission.php">
        Add account permission and function <span class="las la-plus"></span>
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
            if($result_pagination)
            {
              while($result = $result_pagination->fetch_array()){
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
              <a href="?id=5&page=<?php echo $page_id?>&deleteid=<?php echo $result[0]; ?>" class="delete">Delete <i class="fa-solid fa-trash" style="color: #ff0000;"></i></a>
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
  <?php if (empty($_POST["input"])) { ?>
        <div class="bottom-pagination" id="pagination">
          <ul class="pagination">
            <?php if ($pagination_id > 1) { ?>
              <li class="item prev-page">
                <a href="index.php?id=<?php echo $id; ?>&page=<?php echo $pagination_id -
                                                                1; ?>">
                  <i class="fa-solid fa-chevron-left"></i>
                </a>
              </li>
            <?php } ?>
            <?php
            $pagination = $pag->pageNumber($page_total, 4, $pagination_id);
            $length = count($pagination);
            for ($i = 1; $i <= $length; $i++) {
              if ($pagination[$i] > 0) {
                if ($pagination[$i] == $pagination_id) {
                  $current = "current";
                } else {
                  $current = "";
                } ?>
                <li class="item <?php echo $current; ?>" id="<?php echo $pagination[$i]; ?>">
                  <a href="index.php?id=<?php echo $id; ?>&page=<?php echo $pagination[$i]; ?>">
                    <?php echo $pagination[$i]; ?>
                  </a>
                </li>
            <?php
              }
            }
            ?>
            <?php if ($page_total - 1 > $pagination_id + 1) { ?>
              <li class="item next-page">
                <a href="index.php?id=<?php echo $id; ?>&page=<?php echo $pagination_id +
                                                                1; ?>">
                  <i class="fa-solid fa-chevron-right"></i>
                </a>
              </li>
            <?php } ?>
          </ul>
        </div>
      <?php
      }
      ?>
</div>