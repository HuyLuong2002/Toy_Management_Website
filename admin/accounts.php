<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/database/connectDB.php";
include_once $filepath . "/controller/accountController.php";
include_once $filepath . "/helpers/pagination.php";
include_once $filepath . "/controller/permissionController.php";

$accountController = new AccountController();
$permissionController = new PermissionController();
$pag = new Pagination();

if (isset($_POST["input"])) {
  $input = $_POST["input"];
  $show_accounts_live_search = $accountController->show_accounts_live_search($input);
}

if (isset($_GET["accounts_id"])) {
  $show_account = $accountController->show_account_by_id($_GET["accounts_id"]);
  if (mysqli_num_rows($show_account) == 1) {
    $sale = mysqli_fetch_array($show_account);

    $res = [
      'status' => 200,
      'message' => 'sale fetch successful by id',
      'data' => $sale
    ];
    echo json_encode($res);
    return;
  } else {
    $res = [
      'status' => 404,
      'message' => 'sale Id Not Found'
    ];
    echo json_encode($res);
    return;
  }
}

if (isset($_POST["delete-btn"])) {
  $delete_id = $_POST["delete_id"];
  $deleteAccount = $accountController->delete_account($delete_id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add-btn"])) {
  $insertAccount = $accountController->insert_account_admin($_POST);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit-btn"])) {
  $edit_id = $_POST["edit_id"];
  $updateAccount = $accountController->update_account($_POST, $edit_id);
}

if (isset($_GET["id"])) {
  $id = $_GET["id"];
}

if (isset($_GET["page"])) {
  $page_id = $_GET["page"];
}

/*
Tính giá trị của phân trang, 10 sale trên 1 trang
*/
$result_pagination = $accountController->show_account();
if ($result_pagination) {
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
}

?>

<div class="card" id="searchresultaccount">


  <div class="card-header">
    <h3>Account List</h3>
    <div class="bg-modal-box"></div>
    <div class="notification">
      <?php
      if (isset($deleteAccount)) {
        echo $deleteAccount;
      }
      if (isset($insertAccount)) {
        echo $insertAccount;
      }
      if (isset($updateAccount)) {
        echo $updateAccount;
      }
      ?>
    </div>

    <button type="button" class="modal-btn-add" onclick="AddActive()">
      <p>
        Add account <span class="las la-plus"></span>
      </p>
    </button>
  </div>

  <div class="card-body">
    <div class="table-responsive" id="card-account">
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
        <?php
        if (isset($show_accounts_live_search)) {
          if ($show_accounts_live_search) {
            while ($result = $show_accounts_live_search->fetch_array()) {
        ?>
              <tbody>
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
                  if ($result["status"] == 1) {
                    $status = "Đang hoạt động";
                  } else $status = "Ngừng hoạt động";
                  ?>
                  <td><?php echo $status; ?></td>
                  <td>
                    <div class="action-btn-group">
                      <div class="action-btn-edit" id="action-btn-edit-<?php echo $result[0] ?>">
                        <a class="modal-btn-edit" data-id="<?php echo $result[0] ?>" onclick="EditActive(<?php echo $result[0] ?>)">
                          Edit<i class="fa-solid fa-pen-to-square" style="color: #0600ff;"></i>
                        </a>
                      </div>
                      <div class="action-btn-delete" id="action-btn-delete-<?php echo $result[0] ?>">
                        <a class="modal-btn-delete" data-id="<?php echo $result[0] ?>" onclick="DeleteActive(<?php echo $result[0] ?>)">
                          Delete<i class="fa-solid fa-trash" style="color: #ff0000;"></i>
                        </a>
                      </div>
                    </div>
                  <td>
                </tr>
            <?php }
          } else {
            echo "<span class='error'>No Data Found</span>";
          } ?>
              </tbody>
      </table>
    <?php
        } else if ($result_pagination) {
    ?>
      <tbody>
        <?php
          if ($result_pagination) {
            while ($result = $result_pagination->fetch_array()) {
        ?>
            <tr>
              <td><?php echo $result[0]; ?></td>
              <td><?php echo $result["username"]; ?></td>
              <td><?php echo md5($result["password"]); ?></td>
              <td><?php echo $result["firstname"]; ?></td>
              <td><?php echo $result["lastname"]; ?></td>
              <td><?php echo $result["gender"]; ?></td>
              <td><?php echo $result["date_birth"]; ?></td>
              <td><?php echo $result["place_of_birth"]; ?></td>
              <td><?php echo $result["create_date"]; ?></td>
              <td><?php echo $result["name"]; ?></td>
              <?php
              if ($result["status"] == "1") {
                $status = "Đang hoạt động";
              } else $status = "Ngừng hoạt động";
              ?>
              <td><?php echo $status; ?></td>
              <td>
                <div class="action-btn-group">
                  <div class="action-btn-edit" id="action-btn-edit-<?php echo $result[0] ?>">
                    <a class="modal-btn-edit" data-id="<?php echo $result[0] ?>" onclick="EditActive(<?php echo $result[0] ?>)">
                      Edit<i class="fa-solid fa-pen-to-square" style="color: #0600ff;"></i>
                    </a>
                  </div>
                  <div class="action-btn-delete" id="action-btn-delete-<?php echo $result[0] ?>">
                    <a class="modal-btn-delete" data-id="<?php echo $result[0] ?>" onclick="DeleteActive(<?php echo $result[0] ?>)">
                      Delete<i class="fa-solid fa-trash" style="color: #ff0000;"></i>
                    </a>
                  </div>
                </div>
              <td>
            </tr>
      <?php
            }
          }
        } ?>
      </tbody>
      </table>
    </div>
  </div>
  <?php if (empty($_POST["input"]) && isset($page_total) && $page_total > 1) { ?>
    <div class="bottom-pagination" id="pagination">
      <ul class="pagination">
        <?php if ($current_page > 3) {
          $first_page = 1;
        ?>
          <li class="item first-page">
            <a href="index.php?id=<?php echo $id; ?>&page=<?php echo $first_page ?>">
              First
            </a>
          </li>
        <?php } ?>

        <?php if ($current_page > 3) { ?>
          <li class="item prev-page">
            <a href="index.php?id=<?php echo $id; ?>&page=<?php echo $current_page -
                                                            1; ?>">
              <i class="fa-solid fa-chevron-left"></i>
            </a>
          </li>
        <?php } ?>

        <?php
        for ($num = 1; $num <= $page_total; $num++) {
          if ($num != $current_page) {
            if ($num > $current_page - 3 && $num < $current_page + 3) {
        ?>
              <li class="item" id="<?php echo $num; ?>">
                <a href="index.php?id=<?php echo $id; ?>&page=<?php echo $num ?>">
                  <?php echo $num; ?>
                </a>
              </li>
            <?php
            }
          } else {
            ?>
            <li class="item <?php echo "current" ?>" id="<?php echo $num; ?>">
              <a href="index.php?id=<?php echo $id; ?>&page=<?php echo $num; ?>">
                <?php echo $num; ?>
              </a>
            </li>
        <?php
          }
        }
        ?>

        <?php if ($current_page <= $page_total - 3) { ?>
          <li class="item next-page">
            <a href="index.php?id=<?php echo $id; ?>&page=<?php echo $current_page +
                                                            1; ?>">
              <i class="fa-solid fa-chevron-right"></i>
            </a>
          </li>
        <?php } ?>

        <?php if ($current_page <= $page_total - 3) {
          $lastpage = $page_total;
        ?>
          <li class="item last-page">
            <a href="index.php?id=<?php echo $id; ?>&page=<?php echo $lastpage ?>">
              Last
            </a>
          </li>
        <?php } ?>
      </ul>
    </div>
  <?php
  }
  ?>

  <!-- Modal delete -->
  <form class="modal-container-delete" id="modal-container-delete" method="post" enctype="multipart/form-data">
    <input type="hidden" name="delete_id" class="delete_id">
    <div class="modal-delete-title">
      Are you sure want to delete?
    </div>
    <div class="modal-delete-btn-group">
      <button class="modal-delete-btn delete-btn" name="delete-btn">Delete</button>
      <button type="button" class="modal-delete-btn delete-btn-cancel" id="delete-btn-cancel" onclick="cancelDeleteModal()">
        <span>Cancel</span>
      </button>
    </div>
  </form>
  <!-- modal delete end -->

  <!-- modal edit  -->
  <form class="modal-container-edit" id="modal-container-edit" method="post" enctype="multipart/form-data">
    <div class="modal-container-edit-close" onclick="closeCurdEditModal()"><span><i class="fa-solid fa-circle-xmark"></i></span></div>
    <input type="hidden" id="edit_id" name="edit_id" class="edit_id">
    <div class="modal-edit-info">
      <div class="modal-edit-info-item">
        <label for="username">Username</label>
        <input type="text" id="username_edit" name="username_edit" required>
        <div id="username_edit_result" class="username_edit_result"></div>
      </div>

      <div class="modal-edit-info-item">
        <label for="password">Password</label>
        <input type="password" id="password_edit" name="password_edit" required>
        <div id="password_edit_result"></div>
      </div>

      <div class="modal-edit-info-item">
        <label for="firstname">First name</label>
        <input type="text" id="firstname_edit" name="firstname_edit" required>
        <div id="firstname_edit_result"></div>
      </div>

      <div class="modal-edit-info-item">
        <label for="lastname">Last name</label>
        <input type="text" id="lastname_edit" name="lastname_edit" required>
        <div id="lastname_edit_result"></div>
      </div>

      <div class="modal-edit-info-item">
        <label for="gender">Gender</label>
        <select class="modal-edit-input-select" id="gender_edit" name="gender_edit" required>
          <option value="">Select gender</option>
          <option value="Nam">Nam</option>
          <option value="Nữ">Nữ</option>
        </select>
      </div>

      <div class="modal-edit-info-item">
        <label for="date-of-birth">Date of Birth</label>
        <input type="date" id="dateofbirth_edit" name="dateofbirth_edit" required>

      </div>

      <div class="modal-edit-info-item">
        <label for="place-of-birth">Place of Birth</label>
        <input type="text" id="placeofbirth_edit" name="placeofbirth_edit" required>
        <div id="placeofbirth_edit_result"></div>
      </div>

      <div class="modal-edit-info-item">
        <label for="gender">Permission</label>
        <select class="modal-edit-input-select" id="permission_edit" name="permission_edit" required>
          <option value="">Select permission</option>
          <?php
          $show_permission = $permissionController->show_permission();
          if ($show_permission) {
            while ($result = $show_permission->fetch_assoc()) {
          ?>
              <option value="<?php echo $result["id"]; ?>"><?php echo $result["name"] ?></option>
          <?php
            }
          }
          ?>
        </select>
      </div>

      <div class="modal-edit-info-item">
        <label for="status">Status</label>
        <select class="modal-edit-input-select" id="status_edit" name="status_edit" required>
          <option value="">Select status</option>
          <option value="1">Đang hoạt động</option>
          <option value="0">Ngừng hoạt động</option>
        </select>
      </div>
    </div>

    <input class="modal-edit-btn" id="edit-btn" name="edit-btn" type="submit" value="Save">
  </form>
  <!-- modal edit end -->

  <!-- modal add  -->
  <form class="modal-container-add" id="modal-container-add" method="post" enctype="multipart/form-data">
    <div class="modal-container-add-close" onclick="closeCurdAddModal()"><span><i class="fa-solid fa-circle-xmark"></i></span></div>
    <div class="modal-add-info">
      <div class="modal-add-info-item">
        <label for="username">Username</label>
        <input type="text" id="username_add" name="username_add" required>
        <div id="username_add_result" class="username_add_result"></div>
      </div>

      <div class="modal-add-info-item">
        <label for="password">Password</label>
        <input type="password" id="password_add" name="password_add" required>
        <div id="password_add_result"></div>
      </div>

      <div class="modal-add-info-item">
        <label for="firstname">First name</label>
        <input type="text" id="firstname_add" name="firstname_add" required>
        <div id="firstname_add_result"></div>
      </div>

      <div class="modal-add-info-item">
        <label for="lastname">Last name</label>
        <input type="text" id="lastname_add" name="lastname_add" required>
        <div id="lastname_add_result"></div>
      </div>

      <div class="modal-add-info-item">
        <label for="gender">Gender</label>
        <select class="modal-add-input-select" id="gender_add" name="gender_add" required>
          <option value="">Select gender</option>
          <option value="Nam">Nam</option>
          <option value="Nữ">Nữ</option>
        </select>
      </div>

      <div class="modal-add-info-item">
        <label for="date-of-birth">Date of Birth</label>
        <input type="date" id="dateofbirth_add" name="dateofbirth_add" required>
      </div>

      <div class="modal-add-info-item">
        <label for="place-of-birth">Place of Birth</label>
        <input type="text" id="placeofbirth_add" name="placeofbirth_add" required>
        <div id="placeofbirth_add_result"></div>
      </div>

      <div class="modal-add-info-item">
        <label for="gender">Permission</label>
        <select class="modal-add-input-select" id="permission_add" name="permission_add" required>
          <option value="">Select permission</option>
          <?php
          $show_permission = $permissionController->show_permission();
          if ($show_permission) {
            while ($result = $show_permission->fetch_assoc()) {
          ?>
              <option value="<?php echo $result["id"]; ?>"><?php echo $result["name"] ?></option>
          <?php
            }
          }
          ?>
        </select>
      </div>

      <div class="modal-add-info-item">
        <label for="status">Status</label>
        <select class="modal-add-input-select" id="status_add" name="status_add" required>
          <option value="">Select status</option>
          <option value="1">Đang hoạt động</option>
          <option value="0">Ngừng hoạt động</option>
        </select>
      </div>
    </div>

    <input class="modal-add-btn" id="add-btn" name="add-btn" type="submit" value="Save">
  </form>
  <!-- modal add end -->
</div>

<script>
  $(document).ready(function() {
    $('.modal-btn-delete').click(function(e) {
      e.preventDefault();
      var delete_id = $(this).data('id');
      $('.delete_id').val(delete_id);
    });
  });

  $(document).on('click', '.modal-btn-edit', function() {
    var edit_id = $(this).data('id');

    $.ajax({
      type: "GET",
      url: 'accounts.php?accounts_id=' + edit_id,
      success: function(response) {
        var res = jQuery.parseJSON(response);
        if (res.status == 404) {
          alert(res.message);
        } else if (res.status == 200) {

          var dateParts = res.data.date_birth.split("/");
          var newDateBirth = dateParts[2] + "-" + dateParts[1].padStart(2, "0") + "-" + dateParts[0].padStart(2, "0");

          $('#edit_id').val(res.data.id);
          $('#username_edit').val(res.data.username);
          $('#password_edit').val(res.data.password);
          $('#firstname_edit').val(res.data.firstname);
          $('#lastname_edit').val(res.data.lastname);
          $('#gender_edit').val(res.data.gender);
          $('#dateofbirth_edit').val(newDateBirth);
          $('#placeofbirth_edit').val(res.data.place_of_birth);
          $('#permission_edit').val(res.data.permission_id);
          $('#status_edit').val(res.data.status);

        }
      }
    })
  });
</script>

<script src="./js/validate_input.js"></script>

<!-- coding check input value function -->
<script type="text/javascript">
  $(document).ready(function() {
    $("#username_add").keyup(function() {
      var input = $(this).val();
      if (checkAddAndEdit(input) == false) {
        $("#username_add_result").html("<span class='error'>Account Name Not Valid</span>");
        $("#add-btn").prop("disabled", true);
        $("#add-btn").css("background-color", "red");
        $("#username_add_result").css("display", "block");
        // $("#username_add_result").css("margin-top", "0.5rem");
      } else {
        $("#username_add_result").css("display", "none");
        $("#add-btn").prop("disabled", false);
        $("#add-btn").css("background-color", "#0be881");

        $.ajax({
          url: "../check_login.php",
          data: 'nome=' + $("#username-add").val(),
          type: "POST",
          success: function(data) {
            if (data == 1) {
              $("#username_add_result").html("<span class='success'>Username is valid</span>");
              $("#add-btn").prop("disabled", false);
              $("#add-btn").css("background-color", "#0be881");
              $("#username_add_result").css("display", "block");
            } else {
              $("#username_add_result").html("<span class='error'>Username is used</span>");
              $("#add-btn").prop("disabled", true);
              $("#add-btn").css("background-color", "red");
              $("#username_add_result").css("display", "block");
            }
          },
          error: function() {}
        });
      }


    });

    $("#firstname_add").keyup(function() {
      var input = $(this).val();
      if (checkName(input) == false) {
        $("#firstname_add_result").html("<span class='error'>Account First name Not Valid</span>");
        $("#add-btn").prop("disabled", true);
        $("#add-btn").css("background-color", "red");
        $("#firstname_add_result").css("display", "block");
        // $("#firstname_add_result").css("margin-top", "1rem");
      } else {
        $("#firstname_add_result").css("display", "none");
        $("#add-btn").prop("disabled", false);
        $("#add-btn").css("background-color", "#0be881");
      }
    });

    $("#lastname_add").keyup(function() {
      var input = $(this).val();
      if (checkName(input) == false) {
        $("#lastname_add_result").html("<span class='error'>Account Last name Not Valid</span>");
        $("#add-btn").prop("disabled", true);
        $("#add-btn").css("background-color", "red");
        $("#lastname_add_result").css("display", "block");
        // $("#lastname_add_result").css("margin-top", "1rem");
      } else {
        $("#lastname_add_result").css("display", "none");
        $("#add-btn").prop("disabled", false);
        $("#add-btn").css("background-color", "#0be881");
      }
    });

    $("#placeofbirth_add").keyup(function() {
      var input = $(this).val();
      if (checkAddAndEdit(input) == false) {
        $("#placeofbirth_add_result").html("<span class='error'>Account Place of Birth Not Valid</span>");
        $("#add-btn").prop("disabled", true);
        $("#add-btn").css("background-color", "red");
        $("#placeofbirth_add_result").css("display", "block");
        // $("#placeofbirth_add_result").css("margin-top", "1rem");
      } else {
        $("#placeofbirth_add_result").css("display", "none");
        $("#add-btn").prop("disabled", false);
        $("#add-btn").css("background-color", "#0be881");
      }
    });

    $("#password_add").keyup(function() {
      var input = $(this).val();
      if (checkPassword(input) == 0) {
        $("#password_add_result").html("<span class='error'>Password not valid</span>");
        $("#password_add_result").css("display", "block");
        // $("#password_add_result").css("margin-bottom", "1rem");
        $("#add-btn").prop("disabled", true);
        $("#add-btn").css("background-color", "#de5959");
      } else if (checkPassword(input) == 1) {
        $("#password_add_result").html("<span class='error'>Password  must be between 6 and 20 characters</span>");
        $("#password_add_result").css("display", "block");
        // $("#password_add_result").css("margin-bottom", "1rem");
        $("#add-btn").prop("disabled", true);
        $("#add-btn").css("background-color", "#de5959");
      } else if (checkPassword(input) == 2) {
        $("#password_add_result").html("<span class='error'>Password must contain lowercase, uppercase and special characters</span>");
        $("#password_add_result").css("display", "block");
        $("#password_add_result").css("margin-bottom", "0.5rem");
        $("#add-btn").prop("disabled", true);
        $("#add-btn").css("background-color", "#de5959");
      } else {
        $("#password_add_result").css("display", "none");
        $("#add-btn").prop("disabled", false);
        $("#add-btn").css("background-color", "#0be881");
      }
    });

    //edit
    $("#username_edit").keyup(function() {
      var input = $(this).val();
      if (checkAddAndEdit(input) == false) {
        $("#username_edit_result").html("<span class='error'>Account Name Not Valid</span>");
        $("#edit-btn").prop("disabled", true);
        $("#edit-btn").css("background-color", "red");
        $("#username_edit_result").css("display", "block");
        // $("#username_edit_result").css("margin-top", "1rem");
      } else {
        $("#username_edit_result").css("display", "none");
        $("#edit-btn").prop("disabled", false);
        $("#edit-btn").css("background-color", "#ffa800");
      }
    });

    $("#firstname_edit").keyup(function() {
      var input = $(this).val();
      if (checkName(input) == false) {
        $("#firstname_edit_result").html("<span class='error'>Account First name Not Valid</span>");
        $("#edit-btn").prop("disabled", true);
        $("#edit-btn").css("background-color", "red");
        $("#firstname_edit_result").css("display", "block");
        // $("#firstname_edit_result").css("margin-top", "1rem");
      } else {
        $("#firstname_edit_result").css("display", "none");
        $("#edit-btn").prop("disabled", false);
        $("#edit-btn").css("background-color", "#ffa800");
      }
    });

    $("#lastname_edit").keyup(function() {
      var input = $(this).val();
      if (checkName(input) == false) {
        $("#lastname_edit_result").html("<span class='error'>Account Last name Not Valid</span>");
        $("#edit-btn").prop("disabled", true);
        $("#edit-btn").css("background-color", "red");
        $("#lastname_edit_result").css("display", "block");
        // $("#lastname_edit_result").css("margin-top", "1rem");
      } else {
        $("#lastname_edit_result").css("display", "none");
        $("#edit-btn").prop("disabled", false);
        $("#edit-btn").css("background-color", "#ffa800");
      }
    });

    $("#placeofbirth_edit").keyup(function() {
      var input = $(this).val();
      if (checkAddAndEdit(input) == false) {
        $("#placeofbirth_edit_result").html("<span class='error'>Account Place of birth Not Valid</span>");
        $("#edit-btn").prop("disabled", true);
        $("#edit-btn").css("background-color", "red");
        $("#placeofbirth_edit_result").css("display", "block");
        // $("#placeofbirth_edit_result").css("margin-top", "1rem");
      } else {
        $("#placeofbirth_edit_result").css("display", "none");
        $("#edit-btn").prop("disabled", false);
        $("#edit-btn").css("background-color", "#ffa800");
      }
    });

    $("#password_edit").keyup(function() {
      var input = $(this).val();
      if (checkPassword(input) == 0) {
        $("#password_edit_result").html("<span class='error'>Password not valid</span>");
        $("#password_edit_result").css("display", "block");
        // $("#password_edit_result").css("margin-bottom", "1rem");
        $("#edit-btn").prop("disabled", true);
        $("#edit-btn").css("background-color", "#de5959");
      } else if (checkPassword(input) == 1) {
        $("#password_edit_result").html("<span class='error'>Password  must be between 6 and 20 characters</span>");
        $("#password_edit_result").css("display", "block");
        // $("#password_edit_result").css("margin-bottom", "1rem");
        $("#edit-btn").prop("disabled", true);
        $("#edit-btn").css("background-color", "#de5959");
      } else if (checkPassword(input) == 2) {
        $("#password_edit_result").html("<span class='error'>Password must contain lowercase, uppercase and special characters</span>");
        $("#password_edit_result").css("display", "block");
        $("#password_edit_result").css("margin-bottom", "0.5rem");
        $("#edit-btn").prop("disabled", true);
        $("#edit-btn").css("background-color", "#de5959");
      } else {
        $("#password_edit_result").css("display", "none");
        $("#edit-btn").prop("disabled", false);
        $("#edit-btn").css("background-color", "#0be881");
      }
    });
  });
</script>