<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/database/connectDB.php";
include_once $filepath . "/controller/account_functionController.php";
$account_functionController = new AccountFunctionController();

if (isset($_GET["account_function_id"])) {
  $show_account_function = $account_functionController->show_account_function_by_id($_GET["account_function_id"]);
  if (mysqli_num_rows($show_account_function) == 1) {
    $sale = mysqli_fetch_array($show_account_function);

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
  $delete_account_function = $account_functionController->delete_account_function($delete_id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add-btn"])) {
  $insert_account_function = $account_functionController->insert_account_function($_POST);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit-btn"])) {
  $edit_id = $_POST["edit_id"];
  $update_account_function = $account_functionController->update_account_function($_POST, $edit_id);
}
?>

<div class="card">
  <div class="card-header">
    <div class="bg-modal-box"></div>
    <h3>Account Function List</h3>
    <div class="notification">
      <?php

      if (isset($delete_account_function)) {
        echo $delete_account_function;
      }
      if (isset($insert_account_function)) {
        echo $insert_account_function;
      }
      if (isset($update_account_function)) {
        echo $update_account_function;
      }
      ?>
    </div>

    <button type="button" class="modal-btn-add" onclick="AddActive()">
      <p>
        Add Account function <span class="las la-plus"></span>
      </p>
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
          if ($show_account_function) {
            while ($result = $show_account_function->fetch_array()) {

          ?>
              <tr>
                <td><?php echo $result["id"]; ?></td>
                <td><?php echo $result["name"]; ?></td>
                <td>
                  <!-- <a href="account_function_edit.php?id=<?php echo $result[0]; ?>" class="edit">Edit <i class="fa-solid fa-pen-to-square" style="color: #0600ff;"></i></a>
                  <a href="?id=12&deleteid=<?php echo $result[0]; ?>" class="delete">Delete <i class="fa-solid fa-trash" style="color: #ff0000;"></i></a> -->
                  <div class="action-btn-group">
                    <div class="action-btn-edit" id="action-btn-edit-<?php echo $result[0] ?>">
                      <button class="modal-btn-edit" type="button" value="<?php echo $result[0] ?>" onclick="EditActive(<?php echo $result[0] ?>)">
                        Edit <i class="fa-solid fa-pen-to-square" style="color: #0600ff;"></i>
                      </button>
                    </div>
                    <div class="action-btn-delete" id="action-btn-delete-<?php echo $result[0] ?>">
                      <button class="modal-btn-delete" type="button" value="<?php echo $result[0] ?>" onclick="DeleteActive(<?php echo $result[0] ?>)">
                        Delete <i class="fa-solid fa-trash" style="color: #ff0000;"></i>
                      </button>
                    </div>
                  </div>
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
        <label for="name">Name</label>
        <input type="text" id="name_edit" name="name_edit" required value="">
      </div>
    </div>

    <input class="modal-edit-btn" name="edit-btn" type="submit" value="Save">
  </form>
  <!-- modal edit end -->

  <!-- modal add -->
  <form class="modal-container-add" id="modal-container-add" method="post" enctype="multipart/form-data">
    <div class="modal-container-add-close" onclick="closeCurdAddModal()"><span><i class="fa-solid fa-circle-xmark"></i></span></div>
    <div class="modal-add-info">
      <div class="modal-add-info-item">
        <label for="name">Name</label>
        <input type="text" id="name_add" name="name_add" required value="">
      </div>
    </div>

    <input onclick="" class="modal-add-btn" name="add-btn" type="submit" value="Save">
  </form>
  <!-- modal add end -->
</div>

<script>
  $(document).ready(function() {
    $('.modal-btn-delete').click(function(e) {
      e.preventDefault();
      var delete_id = $(this).val();
      $('.delete_id').val(delete_id);
    });
  });

  $(document).on('click', '.modal-btn-edit', function() {
    var edit_id = $(this).val();

    $.ajax({
      type: "GET",
      url: 'account_function.php?account_function_id=' + edit_id,
      success: function(response) {
        var res = jQuery.parseJSON(response);
        if (res.status == 404) {
          alert(res.message);
        } else if (res.status == 200) {

          $('#edit_id').val(res.data.id);
          $('#name_edit').val(res.data.name);
        }
      }
    })
  });
</script>