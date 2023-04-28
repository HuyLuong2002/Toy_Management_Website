<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\controller\permissionController.php";
include_once $filepath . "/helpers/pagination.php";

$permissionController = new PermissionController();
$pag = new Pagination();

if (isset($_POST["input"])) {
  $input = $_POST["input"];
  $show_permission_live_search = $permissionController->show_permission_live_search($input);
}

if (isset($_GET["id"])) {
  $id = $_GET["id"];
}

if (isset($_GET["deleteid"])) {
  $delete_id = $_GET["deleteid"];
  $delete_permission = $permissionController->delete_permission($delete_id);
}

if (isset($_GET["page"])) {
  $page_id = $_GET["page"];
  $pagination_id = $page_id;
}
/*
Tính giá trị của phân trang, 10 sale trên 1 trang
*/
$result_pagination = $permissionController->show_permission();
$permission_total = mysqli_num_rows($result_pagination);

// Số sản phẩm trên 1 trang
$page_per = 10;
$page_total = ceil($permission_total / $page_per);

// trang hiện tại
if (isset($page_id)) {
  $current_page = $page_id;
}
// Vị trí hiện tại
if (isset($current_page)) {
  $current_position = ($current_page - 1) * $page_per;
}
if (isset($current_position)) {
  $result_pagination = $permissionController->show_permission_by_pagination(
    $current_position,
    $page_per
  );
}
?>


<div class="card" id="searchresultpermission">
  <div class="card-header">
    <h3>Permission List</h3>
    <?php if (isset($delete_permission)) {
      echo $delete_permission;
    } ?>
    <button>
      <a href="permission_add.php">
        Add permission <span class="las la-plus"></span>
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
          if (isset($result_pagination)) {
            while ($result = $result_pagination->fetch_assoc()) {
          ?>
              <tr>
                <td><?php echo $result["id"]; ?></td>
                <td><?php echo $result["name"]; ?></td>
                <td>
                  <a href="permission_edit.php?id=<?php echo $result["id"]; ?>" class="edit">Edit <i class="fa-solid fa-pen-to-square" style="color: #0600ff;"></i></a>
                  <a href="?id=6&deleteid=<?php echo $result["id"]; ?>" class="delete">Delete <i class="fa-solid fa-trash" style="color: #ff0000;"></i></a>
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