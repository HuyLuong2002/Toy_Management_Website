<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
include_once $filepath . "\controller\categoryController.php";

$categoryController = new CategoryController();


if (isset($_POST["input"])) {
    $input = $_POST["input"];
    $show_category_live_search = $categoryController->show_category_live_search($input);
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}

if (isset($_GET["category_id"])) {
    $show_category = $categoryController->show_category_by_id($_GET["category_id"]);
    if (mysqli_num_rows($show_category) == 1) {
        $sale = mysqli_fetch_array($show_category);

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
    $deleteCategory = $categoryController->delete_category($delete_id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add-btn"])) {
    $insertCategory = $categoryController->insert_category($_POST);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit-btn"])) {
    $edit_id = $_POST["edit_id"];
    $updateCategory = $categoryController->update_category($_POST, $edit_id);
}
?>

<div class="card" id="searchresultcategory">
    <div class="card-header">
        <div class="bg-modal-box">
        </div>
        <h3>Category List</h3>
        <div class="notification">
            <?php
            if (isset($deleteCategory)) {
                echo $deleteCategory;
            }
            if (isset($insertCategory)) {
                echo $insertCategory;
            }
            if (isset($updateCategory)) {
                echo $updateCategory;
            }
            ?>
        </div>

        <button type="button" class="modal-btn-add" onclick="AddActive()">
            <p>
                Add Category <span class="las la-plus"></span>
            </p>
        </button>
    </div>

    <div class="card-body">
        <div class="table-responsive" id="card-category">
            <table width="100%">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Category Name</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($show_category_live_search)) {
                        if ($show_category_live_search) { ?>
                            <?php while (
                                $result = $show_category_live_search->fetch_array()
                            ) { ?>
                                <tr>
                                    <td>
                                        <?php echo $result[0]; ?>
                                    </td>
                                    <td>
                                        <?php echo $result[1]; ?>
                                    </td>
                                    <td>
                                        <div class="action-btn-group">
                                            <div class="action-btn-edit" id="action-btn-edit-<?php echo $result[0] ?>">
                                                <a class="modal-btn-edit" data-id="<?php echo $result[0] ?>" onclick="EditActive(<?php echo $result[0] ?>)">
                                                    Edit <i class="fa-solid fa-pen-to-square" style="color: #0600ff;"></i>
                                                </a>
                                            </div>
                                            <div class="action-btn-delete" id="action-btn-delete-<?php echo $result[0] ?>">
                                                <a class="modal-btn-delete" data-id="<?php echo $result[0] ?>" onclick="DeleteActive(<?php echo $result[0] ?>)">
                                                    Delete <i class="fa-solid fa-trash" style="color: #ff0000;"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                        <?php }
                        } else {
                            echo "<span class='error'>No Data Found</span>";
                        } ?>
                </tbody>
            </table>
        <?php
                    } else {
        ?>
            <tbody>
                <?php
                        $show_category = $categoryController->show_category();
                        if ($show_category) {
                            while ($result = $show_category->fetch_array()) { ?>
                        <tr>
                            <td>
                                <?php echo $result[0]; ?>
                            </td>
                            <td>
                                <?php echo $result[1]; ?>
                            </td>
                            <td>
                                <div class="action-btn-group">
                                    <div class="action-btn-edit" id="action-btn-edit-<?php echo $result[0] ?>">
                                        <a class="modal-btn-edit" data-id="<?php echo $result[0] ?>" onclick="EditActive(<?php echo $result[0] ?>)">
                                            Edit <i class="fa-solid fa-pen-to-square" style="color: #0600ff;"></i>
                                        </a>
                                    </div>
                                    <div class="action-btn-delete" id="action-btn-delete-<?php echo $result[0] ?>">
                                        <a class="modal-btn-delete" data-id="<?php echo $result[0] ?>" onclick="DeleteActive(<?php echo $result[0] ?>)">
                                            Delete <i class="fa-solid fa-trash" style="color: #ff0000;"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
            <?php }
                        }
                    } ?>
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
                <div id="name_edit_result"></div>
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
                <label for="name">Name</label>
                <input type="text" id="name_add" name="name_add" required value="">
                <div id="name_add_result"></div>
            </div>
        </div>

        <input onclick="" class="modal-add-btn" id="add-btn" name="add-btn" type="submit" value="Save">
    </form>
    <!-- modal add end -->
</div>

<script src="./js/modal.js"></script>

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
            url: 'category.php?category_id=' + edit_id,
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

<script src="./js/validate_input.js"></script>

<!-- coding check input value function -->
<script type="text/javascript">
    $(document).ready(function() {
        $("#name_add").keyup(function() {
            var input = $(this).val();
            if (checkProductName(input) == false) {
                $("#name_add_result").html("<span class='error'>Category name must < 25 characters and don't contain special characters</span>");
                $("#add-btn").prop("disabled", true);
                $("#add-btn").css("background-color", "red");
                $("#name_add_result").css("display", "block");
                $("#name_add_result").css("margin-top", "1rem");
            } else {
                $("#name_add_result").css("display", "none");
                $("#add-btn").prop("disabled", false);
                $("#add-btn").css("background-color", "#0be881");
            }
        });

        $("#name_edit").keyup(function() {
            var input = $(this).val();
            if (checkProductName(input) == false) {
                $("#name_edit_result").html("<span class='error'>Category name must < 25 characters and don't contain special characters</span>");
                $("#edit-btn").prop("disabled", true);
                $("#edit-btn").css("background-color", "red");
                $("#name_edit_result").css("display", "block");
                $("#name_edit_result").css("margin-top", "1rem");
            } else {
                $("#name_edit_result").css("display", "none");
                $("#edit-btn").prop("disabled", false);
                $("#edit-btn").css("background-color", "#ffa800");
            }
        });
    });
</script>

<!-- <script>
  // ShowcategoryDetail
  const handleShowCart = () => {
    const layout = document.getElementById("category-details");
    layout.style.display = "flex";

    // Handle Out Of Area Click
    const screen = document.getElementById("category-details");
    screen.addEventListener('click', (event) => {
      const box = document.getElementsByClassName('modal-container')[0];
      if (!box.contains(event.target)) {
        handleClose();
      }
    });
  }

  // ClosecategoryDetail
  const handleClose = () => {
    const layout = document.getElementById("category-details")
    layout.style.display = "none";
  }
</script> -->