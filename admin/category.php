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

if (isset($_GET["deleteid"])) {
    $delete_id = $_GET["deleteid"];
    $delete_category = $categoryController->delete_category($delete_id);
}
?>

<div class="card" id="searchresultcategory">
    <div class="card-header">
        <h3>Category List</h3>
        <?php

        if (isset($delete_category)) {
            echo $delete_category;
        }
        ?>
        <button>
            <a href="category_add.php">
                Add category <span class="las la-plus"></span>
            </a>
        </button>
    </div>

    <div class="card-body">
        <div class="table-responsive">
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
                                        <a href="category_edit.php?id=<?php echo $result[0]; ?>">Edit</a> |
                                        <a href="?id=10&deleteid=<?php echo $result[0]; ?>">Delete</a>
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
                                    <a href="category_edit.php?id=<?php echo $result[0]; ?>">Edit</a> |
                                    <a href="?id=10&deleteid=<?php echo $result[0]; ?>">Delete</a>
                                </td>
                            </tr>
                        <?php }
                    }
                    } ?>
            </tbody>
            </table>
        </div>
    </div>
</div>

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