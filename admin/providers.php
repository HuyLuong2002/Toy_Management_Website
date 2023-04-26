<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/controller/providersController.php";
include_once $filepath . "/helpers/pagination.php";
include_once $filepath . "/controller/provider_addController.php";

$providerController = new ProviderController();
$provider_addController = new ProductAddController();
$pag = new Pagination();

if (isset($_POST["input"])) {
  $input = $_POST["input"];
  $show_provider_live_search = $providerController->show_provider_live_search($input);
}

if (isset($_GET["id"])) {
  $id = $_GET["id"];
}

if (isset($_GET["page"])) {
  $page_id = $_GET["page"];
  $pagination_id = $page_id;
}

if (isset($_GET["deleteid"])) {
  $delete_id = $_GET["deleteid"];
  $delete_provider = $providerController->delete_provider($delete_id);
}

if(isset($_GET["detailid"])){
  include "orders_detail.php";
}

/*
Tính giá trị của phân trang
10 sản phẩm trên 1 trang
*/
$result_pagination = $providerController->show_provider_for_pagination();

/*
Tính giá trị của phân trang
10 sản phẩm trên 1 trang
*/
// Tổng số sản phẩm
$provider_total = mysqli_num_rows($result_pagination);
//số sản phẩm trên 1 trang
$num_product_on_page = 10;
$page_total = ceil($provider_total / $num_product_on_page);
//Trang hiện tại
if (isset($page_id))
  $current_page = $page_id;
// vị trí hiện tại
if (isset($current_page))
  $current_position = ($current_page - 1) * $num_product_on_page;
if (isset($current_position))
  $result_pagination = $providerController->show_provider_by_panigation_admin($current_position, $num_product_on_page);
?>


<div class="card" id="searchresultprovider">
  <div class="card-header">
    <h3>Providers List</h3>
    <?php

    if (isset($delete_provider)) {
      echo $delete_provider;
    }
    ?>
    <button>
      <a href="provider_add.php">
        Add provider <span class="las la-plus"></span>
      </a>
    </button>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table width="100%">
        <thead>
          <tr>
            <td>ID</td>
            <td>Provider Name</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          <?php if (isset($show_provider_live_search)) {
            if ($show_provider_live_search) { ?>
              <?php while (
                $result = $show_provider_live_search->fetch_array()
              ) { ?>
                <tr>
                  <td>
                    <?php echo $result[0]; ?>
                  </td>
                  <td>
                    <?php echo $result[1]; ?>
                  </td>
                  <td>
                    <a href="provider_edit.php?id=<?php echo $result[0]; ?>">Edit</a>
                    <a href="?id=7&deleteid=<?php echo $result[0]; ?>">Delete</a>
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
        <tbody id="provider-data">
          <?php
          if ($result_pagination) {
            while ($result = $result_pagination->fetch_array()) { ?>
              <tr>
              <td>
                <?php echo $result[0]; ?>
              </td>
              <td>
                <?php echo $result[1]; ?>
              </td>
              <td>
                <a href="provider_edit.php?id=<?php echo $result[0]; ?>">Edit <i class="fa-solid fa-pen-to-square" style="color: #0600ff;"></i></a>
                <a href="?id=<?php echo $id; ?>&page=<?php echo $page_id;?>&deleteid=<?php echo $result[0]; ?>" class="delete">Delete <i class="fa-solid fa-trash" style="color: #ff0000;"></i></a>
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
            <?php if ($pagination_id > 1) { ?>
              <li class="item prev-page">
                <a href="index.php?id=<?php echo $id; ?>&page=<?php echo $pagination_id - 1; ?>">
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
              }
            ?>
              <li class="item <?php echo $current?>" id="<?php echo $pagination[$i]; ?>">
                <a href="index.php?id=<?php echo $id; ?>&page=<?php echo $pagination[$i]; ?>">
                  <?php echo $pagination[$i]; ?>
                </a>
              </li>
            <?php } }?>
            <?php if ($page_total - 1 > $pagination_id + 1) { ?>
              <li class="item next-page">
                <a href="index.php?id=<?php echo $id; ?>&page=<?php echo $pagination_id + 1; ?>">
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

<!-- ajax to pagination for provider -->
<script type="text/javascript">
  $(document).ready(function() {
    function loadProduct(page) {
      $.ajax({
        url: "providers.php",
        type: "POST",
        data: {
          page_no: page
        },
        success: function(data) {
          $('#provider-data').html(data);
        }

      });
    }

    // Pagination code
    $(document).on("click", "#pagination a", function(e) {

      var page = $(this).attr("id");
      loadProduct(page);
    });

  });
</script>