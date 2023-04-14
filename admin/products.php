<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/controller/productsController.php";
include_once $filepath . "/helpers/pagination.php";
include_once $filepath . "/helpers/format.php";

$pag = new Pagination();
$fm = new Format();
$productsController = new ProductsController();

if (isset($_POST["input"])) {
  $input = $_POST["input"];
  $show_product_live_search = $productsController->show_product_live_search($input);
}

if (isset($_GET["id"])) {
  $id = $_GET["id"];
}

if (isset($_GET["deleteid"])) {
  $delete_id = $_GET["deleteid"];
  $delete_product = $productsController->delete_product($delete_id);
}

if (isset($_GET["page"])) {
  $page_id = $_GET["page"];
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
if (isset($page_id))
  $current_page = $page_id;
// vị trí hiện tại
if (isset($current_page))
  $current_position = ($current_page - 1) * $num_product_on_page;
if (isset($current_position))
  $result_pagination = $productsController->show_product_by_panigation_admin($current_position, $num_product_on_page);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<div class="card" id="searchresultproduct">
  <div class="card-header">
    <h3>Product List</h3>
    <?php if (isset($delete_product)) {
      echo $delete_product;
    } ?>
    <button>
      <a href="product_add.php">
        Add product <span class="las la-plus"></span>
      </a>
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
                <tr id="switch-<?php echo $result[0]; ?>">

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
                      <input type="checkbox" />
                      <span class="slider round" onclick="<?php echo 'handleGetId(' . $result[0] . ')'; ?>"></span>
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
                  <td><a href="product_edit.php?id=<?php echo $result[0]; ?>">Edit</a> | <a href="?id=2&deleteid=<?php echo $result[0]; ?>">Delete</a> | <a href="product_detail.php?id=<?php echo $result[0]; ?>">Details</a>
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
      <tbody id="product-data">
        <?php
            if ($result_pagination) {
              while ($result = $result_pagination->fetch_array()) { ?>
            <tr id="switch-<?php echo $result[0]; ?>" class="<?php echo $result[6] == 1 ? 'activeBg' : '' ?>">

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
                  <?php
                  if ($result[6] == 1) {
                    $checked  = "checked";
                  } else {
                    $checked = "";
                  }
                  ?>
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
              <td>
                <a href="product_edit.php?id=<?php echo $result[0]; ?>" class="Edit">Edit <i class="fa-solid fa-pen-to-square" style="color: #0600ff;"></i></a>
                <a href="?id=<?php echo $id; ?>&deleteid=<?php echo $result[0]; ?>" class="Delete">Delete <i class="fa-solid fa-trash" style="color: #ff0000;"></i></a>
                <a href="product_detail.php?id=<?php echo $result[0]; ?>" class="Detail">Details <i class="fa-solid fa-circle-info" style="color: #03a945;"></i></a>
              <td>

            </tr>
      <?php }
            }
          } ?>
      </tbody>
      </table>
      <?php
      if (empty($_POST["input"])) {
      ?>
        <div class="bottom-pagination" id="pagination">
          <ul class="pagination">
            <?php if ($page_id > 1) { ?>
              <li class="item prev-page">
                <a href="index.php?id=<?php echo $id; ?>&page=<?php echo $page_id - 1; ?>">
                  <i class="fa-solid fa-chevron-left"></i>
                </a>
              </li>
            <?php } ?>
            <?php 
            $pagination = $pag->pageNumber($page_total, 4, $page_id);
            $length = count($pagination);
            for ($i = 1; $i <= $length; $i++) {
              if ($pagination[$i] == $page_id) {
                $current = "current";
              } else {
                $current = "";
              }
            ?>
              <li class="item <?php echo $current?>" id="<?php echo $pagination[$i]; ?>">
                <a href="index.php?id=<?php echo $id; ?>&page=<?php echo $pagination[$i]; ?>">
                  <?php echo $pagination[$i]; ?>
                </a>
              </li>
            <?php } ?>
            <?php if ($page_total - 1 > $page_id + 1) { ?>
              <li class="item next-page">
                <a href="index.php?id=<?php echo $id; ?>&page=<?php echo $page_id + 1; ?>">
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
  </div>
</div>

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
    sw.classList.toggle('activeBg')
  }
</script>

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
      loadProduct();
    });

  });
</script>