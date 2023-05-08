<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/controller/productsController.php";
include_once $filepath . "/controller/categoryController.php";
include_once $filepath . "/controller/saleController.php";
include_once $filepath . "/helpers/pagination.php";
include_once $filepath . "/helpers/format.php";

$pag = new Pagination();
$fm = new Format();
$productsController = new ProductsController();

if (isset($_POST["input"])) {
  $input = $_POST["input"];
  $show_product_live_search = $productsController->show_product_live_search(
    $input
  );
}

if (isset($_GET["id"])) {
  $id = $_GET["id"];
}

if (isset($_GET["product_id"])) {
  $show_product = $productsController->get_product_by_id($_GET["product_id"]);
  if (mysqli_num_rows($show_product) == 1) {
    $sale = mysqli_fetch_array($show_product);

    $res = [
      "status" => 200,
      "message" => "product fetch successful by id",
      "data" => $sale,
    ];
    echo json_encode($res);
    return;
  } else {
    $res = [
      "status" => 404,
      "message" => "prodcut Id Not Found",
    ];
    echo json_encode($res);
    return;
  }
}

if (isset($_POST["delete-btn"])) {
  $delete_id = $_POST["delete_id"];
  $deleteProduct = $productsController->delete_product($delete_id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add-btn"])) {
  $insertProduct = $productsController->insert_product($_POST);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit-btn"])) {
  $edit_id = $_POST["edit_id"];
  $updateProduct = $productsController->update_product($_POST, $edit_id);
}

if (isset($_GET["page"])) {
  $page_id = $_GET["page"];
  $pagination_id = $page_id;
}

/*
Tính giá trị của phân trang
10 sản phẩm trên 1 trang
*/
$result_pagination = $productsController->show_product_for_pagination();

/*
Tính giá trị của phân trang
10 sản phẩm trên 1 trang
*/
// Tổng số sản phẩm
$product_total = mysqli_num_rows($result_pagination);
//số sản phẩm trên 1 trang
$num_product_on_page = 10;
$page_total = ceil($product_total / $num_product_on_page);
//Trang hiện tại
if (isset($page_id)) {
  $current_page = $page_id;
}
// vị trí hiện tại
if (isset($current_page)) {
  $current_position = ($current_page - 1) * $num_product_on_page;
}
if (isset($current_position)) {
  $result_pagination = $productsController->show_product_by_panigation_admin(
    $current_position,
    $num_product_on_page
  );
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  
  <script src="https://cdn.tiny.cloud/1/a4yip95kil5x5nn5y60qcu7jeg755ii26thhre1j0rxwg6ae/tinymce/6/tinymce.min.js" referrerpolicy="origin">
    tinymce.init({
    // Select the element(s) to add TinyMCE to using any valid CSS selector
    selector: "#description_add"
    });
  </script>
</head>
<div class="card" id="searchresultproduct">
  <div class="card-header">
    <div class="bg-modal-box"></div>
    <h3>Product List</h3>
    <?php
    if (isset($deleteProduct)) {
      echo $deleteProduct;
    }
    if (isset($insertProduct)) {
      echo $insertProduct;
    }
    if (isset($updateProduct)) {
      echo $updateProduct;
    }
    ?>
    <button type="button" class="modal-btn-add" onclick="AddActive()">
      <p>
        Add product <span class="las la-plus"></span>
      </p>
    </button>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table width="100%">
        <thead>
          <tr>
            <td>ID</td>
            <td>Product Name</td>
            <td>Image</td>
            <td>Price</td>
            <td>Description</td>
            <td>Create date</td>
            <td>Highlight</td>
            <td>Category</td>
            <td>Sale</td>
            <td>Review</td>
            <td>Quantity</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          <?php if (isset($show_product_live_search)) {
            if ($show_product_live_search) { ?>
              <?php while (
                $result = $show_product_live_search->fetch_array()
              ) { ?>
            <tr id="switch-<?php echo $result[0]; ?>" class="<?php echo $result[6] ==
1
  ? "activeBg"
  : ""; ?>">

                  <td>
                    <?php echo $result[0]; ?>
                  </td>
                  <td>
                    <?php echo $result[1]; ?>
                  </td>
                  <td>
                    <img src="<?php echo "uploads/" .
                      $result[2]; ?>" alt="" width="100px" />
                  </td>
                  <td>
                    <?php echo $result[3]; ?>
                  </td>
                  <td>
                    <?php echo $fm->textShorten($result[4], 50); ?>
                  </td>
                  <td>
                    <?php echo $result[5]; ?>
                  </td>
                  <td>
                    <label class="switch">
                    <?php if ($result[6] == 1) {
                      $checked = "checked";
                    } else {
                      $checked = "";
                    } ?>
                    <input type="checkbox" <?php echo $checked; ?> id="check-<?php echo $result[0]; ?>" />
                    <span class="slider round" id="slider-<?php echo $result[0]; ?>" onclick="handleGetId(<?php echo $result[0]; ?>, <?php echo $result[6]; ?>)"></span>
                  </label>
                  </td>
                  <td>
                    <?php echo $result[13]; ?>
                  </td>
                  <td>
                    <?php echo $result[16]; ?>
                  </td>
                  <td>
                    <?php echo $result[9]; ?>
                  </td>
                  <td>
                    <?php echo $result[10]; ?>
                  </td>
                  <td style="background-color: #fff;">
                    <div class="action-btn-group">
                      <div class="action-btn-edit" id="action-btn-edit-<?php echo $result[0]; ?>">
                        <button class="modal-btn-edit" type="button" value="<?php echo $result[0]; ?>" onclick="EditActive(<?php echo $result[0]; ?>)">
                          Edit<i class="fa-solid fa-pen-to-square" style="color: #0600ff;"></i>
                        </button>
                      </div>
                      <div class="action-btn-delete" id="action-btn-delete-<?php echo $result[0]; ?>">
                        <button class="modal-btn-delete" type="button" value="<?php echo $result[0]; ?>" onclick="DeleteActive(<?php echo $result[0]; ?>)">
                          Delete<i class="fa-solid fa-trash" style="color: #ff0000;"></i>
                        </button>
                      </div>
                    </div>
                    <a href="product_detail.php?id=<?php echo $result[0]; ?>" class="Detail">Details <i class="fa-solid fa-circle-info" style="color: #03a945;"></i></a>
                  </td>

                </tr>
            <?php }} else {echo "<span class='error'>No Data Found</span>";} ?>
        </tbody>
      </table>
    <?php
          } else {
             ?>
      <tbody id="product-data">
        <?php if ($result_pagination) {
          while ($result = $result_pagination->fetch_array()) { ?>
            <tr id="switch-<?php echo $result[0]; ?>" class="<?php echo $result[6] ==
1
  ? "activeBg"
  : ""; ?>">

              <td>
                <?php echo $result[0]; ?>
              </td>
              <td>
                <?php echo $result[1]; ?>
              </td>
              <td>
                <img src="<?php echo "uploads/" .
                  $result[2]; ?>" alt="" width="100px" />
              </td>
              <td>
                <?php echo $result[3]; ?>
              </td>
              <td>
                <?php echo $fm->textShorten($result[4], 50); ?>
              </td>
              <td>
                <?php echo $result[5]; ?>
              </td>
              <td>
                <label class="switch">
                  <?php if ($result[6] == 1) {
                    $checked = "checked";
                  } else {
                    $checked = "";
                  } ?>
                  <input type="checkbox" <?php echo $checked; ?> id="check-<?php echo $result[0]; ?>" />
                  <span class="slider round" id="slider-<?php echo $result[0]; ?>" onclick="handleGetId(<?php echo $result[0]; ?>, <?php echo $result[6]; ?>)"></span>
                </label>
              </td>
              <td>
                <?php echo $result[13]; ?>
              </td>
              <td>
                <?php echo $result[16]; ?>
              </td>
              <td>
                <?php echo $result[9]; ?>
              </td>
              <td>
                <?php echo $result[10]; ?>
              </td>
              <td style="background-color: #fff;">
                <div class="action-btn-group">
                  <div class="action-btn-edit" id="action-btn-edit-<?php echo $result[0]; ?>">
                    <button class="modal-btn-edit" type="button" value="<?php echo $result[0]; ?>" onclick="EditActive(<?php echo $result[0]; ?>)">
                      Edit<i class="fa-solid fa-pen-to-square" style="color: #0600ff;"></i>
                    </button>
                  </div>
                  <div class="action-btn-delete" id="action-btn-delete-<?php echo $result[0]; ?>">
                    <button class="modal-btn-delete" type="button" value="<?php echo $result[0]; ?>" onclick="DeleteActive(<?php echo $result[0]; ?>)">
                      Delete<i class="fa-solid fa-trash" style="color: #ff0000;"></i>
                    </button>
                  </div>
                </div>
                <a href="product_detail.php?id=<?php echo $result[0]; ?>" class="Detail">Details <i class="fa-solid fa-circle-info" style="color: #03a945;"></i></a>
              <td>

            </tr>
      <?php }
        }
          } ?>
      </tbody>
      </table>
      <?php if (empty($_POST["input"])) {
        if (isset($_POST["input"])) {
          if ($_POST["input"] !== "0") { ?>
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
              if ($pagination[$i] == $pagination_id) {
                $current = "current";
              } else {
                $current = "";
              } ?>
              <li class="item <?php echo $current; ?>" id="<?php echo $pagination[
  $i
]; ?>">
                <a href="index.php?id=<?php echo $id; ?>&page=<?php echo $pagination[
  $i
]; ?>">
                  <?php echo $pagination[$i]; ?>
                </a>
              </li>
            <?php
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
      <?php }
        }
      } ?>
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

      <div class="modal-edit-info-item">
        <label for="price">Price</label>
        <input type="text" id="price_edit" name="price_edit" required>
      </div>

      <div class="modal-edit-info-item">
        <label for="description">Description</label>
        <textarea rows="4" cols="4" id="description_edit" name="description_edit" class="tinymce"></textarea>
      </div>

      <div class="modal-edit-info-item">
        <label for="status">Category</label>
        <select class="modal-add-input-select" id="category_edit" name="category_edit" required>
          <option value="">Select category</option>
          <?php
          $categoryController = new CategoryController();
          $show_cat = $categoryController->show_category();
          if ($show_cat) {
            $i = 0;
            while ($result = $show_cat->fetch_assoc()) {
              $i++; ?>
              <option value="<?php echo $result["id"]; ?>"><?php echo $result[
  "name"
]; ?></option>
          <?php
            }
          }
          ?>
        </select>
      </div>

      <div class="modal-edit-info-item">
        <label for="sale">Sale</label>
        <select class="modal-edit-input-select" id="sale_edit" name="sale_edit" required>
          <option value="">Select sale</option>
          <?php
          $saleController = new SaleController();
          $show_sale = $saleController->show_sale();
          if ($show_sale) {
            $i = 0;
            while ($result = $show_sale->fetch_assoc()) {
              $i++; ?>
              <option value="<?php echo $result["id"]; ?>"><?php echo $result[
  "name"
]; ?></option>
          <?php
            }
          }
          ?>
        </select>
      </div>

      <div class="modal-edit-info-item">
        <label for="quantity">Quantity</label>
        <input type="number" id="quantity_edit" name="quantity_edit" required>
      </div>

      <div class="modal-edit-info-item">
        <label for="uploadfile">Upload File</label>
        <div style="display:flex; justify-content:center; border: 1px solid #0000ff29;border-radius: 5px;">
          <img id="imageUrl" src="" alt="" style="width:25%;height:25%;">
        </div>
        <input type="file" id="uploadfile_edit" name="uploadfile_edit">
      </div>
    </div>

    <input class="modal-edit-btn" name="edit-btn" type="submit" value="Save">
  </form>
  <!-- modal edit end -->

  <!-- modal add  -->
  <form class="modal-container-add" id="modal-container-add" method="post" enctype="multipart/form-data">
    <div class="modal-container-add-close" onclick="closeCurdAddModal()"><span><i class="fa-solid fa-circle-xmark"></i></span></div>
    <div class="modal-add-info">
      <div class="modal-add-info">
        <div class="modal-add-info-item">
          <label for="name">Name</label>
          <input type="text" id="name_add" name="name_add" required value="">
        </div>

        <div class="modal-add-info-item">
          <label for="price">Price</label>
          <input type="text" id="price_add" name="price_add" required>
        </div>

        <div class="modal-add-info-item">
          <label for="description">Description</label>
          <textarea id="description_add" name="description_add" class="tinymce"></textarea>
        </div>

        <div class="modal-add-info-item">
          <label for="status">Category</label>
          <select class="modal-add-input-select" id="category_add" name="category_add" required>
            <option value="">Select category</option>
            <?php
            $categoryController = new CategoryController();
            $show_cat = $categoryController->show_category();
            if ($show_cat) {
              $i = 0;
              while ($result = $show_cat->fetch_assoc()) {
                $i++; ?>
                <option value="<?php echo $result["id"]; ?>"><?php echo $result[
  "name"
]; ?></option>
            <?php
              }
            }
            ?>
          </select>
        </div>

        <div class="modal-add-info-item">
          <label for="sale">Sale</label>
          <select class="modal-add-input-select" id="sale_add" name="sale_add" required>
            <option value="">Select sale</option>
            <?php
            $saleController = new SaleController();
            $show_sale = $saleController->show_sale();
            if ($show_sale) {
              $i = 0;
              while ($result = $show_sale->fetch_assoc()) {
                $i++; ?>
                <option value="<?php echo $result["id"]; ?>"><?php echo $result[
  "name"
]; ?></option>
            <?php
              }
            }
            ?>
          </select>
        </div>

        <div class="modal-add-info-item">
          <label for="quantity">Quantity</label>
          <input type="number" id="quantity_add" name="quantity_add" required>
        </div>

        <div class="modal-add-info-item">
          <label for="uploadfile">Upload File</label>
          <input type="file" id="uploadfile_add" name="uploadfile_add">
        </div>
      </div>
    </div>

    <input onclick="" class="modal-add-btn" name="add-btn" type="submit" value="Save">
  </form>
  <!-- modal add end -->
</div>

<!-- javascript to check hight product -->
<script>
  let NewState;
  const handleGetId = (id, st) => {
    let inputCheck = document.getElementById(`check-${id}`)
    if (!inputCheck.checked) {
      NewState = 1
      TransformBg(id)
    } else {
      TransformBg(id)
      NewState = 0
    }
    console.log(NewState);
    $.ajax({
      url: "./update_product_highlight.php", // your_api_endpoint_here
      method: "POST",
      data: {
        id: id,
        state: NewState
      },
      success: async function(response) {
        const myData = await response.id;
        const myState = await response.state;
        // Xử lý dữ liệu trong biến myData ở đây

      }
    });
  }

  const TransformBg = (id) => {
    let sw = document.getElementById(`switch-${id}`)
    console.log(sw);
    sw.classList.toggle('activeBg')
  }
</script>
<!-- ajax to pagination for product -->
<script type="text/javascript">
  $(document).ready(function() {
    function loadProduct(page) {
      $.ajax({
        url: "products.php",
        type: "POST",
        data: {
          page_no: page
        },
        success: function(data) {
          $('#product-data').html(data);
        }

      });
    }

    // Pagination code
    $(document).on("click", "#pagination a", function(e) {

      var page = $(this).attr("id");
      loadProduct(page);
    });
  });

  $(document).ready(function() {
    $('.modal-btn-delete').click(function(e) {
      e.preventDefault();
      var delete_id = $(this).val();
      $('.delete_id').val(delete_id);
    });
  });

  $(document).on('click', '.modal-btn-edit', function(e) {
    e.preventDefault();
    var edit_id = $(this).val();

    $.ajax({
      type: "GET",
      url: 'products.php?product_id=' + edit_id,
      success: function(response) {
        var res = jQuery.parseJSON(response);
        if (res.status == 404) {
          alert(res.message);
        } else if (res.status == 200) {
          $('#edit_id').val(res.data.id);
          $('#name_edit').val(res.data.name);
          $('#price_edit').val(res.data.price);
          $('#description_edit').val(res.data.description);
          $('#category_edit').val(res.data.category_id);
          $('#sale_edit').val(res.data.sale_id);
          $('#quantity_edit').val(res.data.quantity);
          $('#imageUrl').attr('src', 'uploads/' + res.data.image);
        }
      }
    })
  });
</script>
