<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/classes/product.php";
include_once $filepath . "/helpers/format.php";
$fm = new Format();
$product = new Product();

if (isset($_POST["input"])) {
  $input = $_POST["input"];
  $show_product_live_search = $product->show_product_live_search($input);
}

if (isset($_GET["id"])) {
  $id = $_GET["id"];
}

if (isset($_GET["deleteid"])) {
  $product = new Product();
  $delete_id = $_GET["deleteid"];
  $delete_product = $product->delete_product($delete_id);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0" />
  <title>Product List Management</title>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<div class="card" id="searchresult">
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

  <div class="card-body" >
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
                  <tr>

                    <td><?php echo $result[0]; ?></td>
                    <td><?php echo $result[1]; ?></td>
                    <td>
                      <img src="<?php echo "uploads/" .
                        $result[2]; ?>" alt="" width="100px" />
                    </td>
                    <td><?php echo $result[3]; ?></td>
                    <td><?php echo $fm->textShorten($result[4], 50); ?></td>
                    <td><?php echo $result[5]; ?></td>
                    <td>
                      <label class="switch">
                        <input type="checkbox" />
                        <span class="slider round"></span>
                      </label>
                    </td>
                    <td><?php echo $result[7]; ?></td>
                    <td><?php echo $result[8]; ?></td>
                    <td><?php echo $result[9]; ?></td>
                    <td><?php echo $result[10]; ?></td>
                    <td><a href="product_edit.php?id=<?php echo $result[0]; ?>">Edit</a> | <a href="?id=2&deleteid=<?php echo $result[0]; ?>">Delete</a> | <a href="product_detail.php?id=<?php echo $result[0]; ?>">Details</a>
                    <td>

                  </tr>
            <?php }} else {echo "<span class='error'>No Data Found</span>";} ?>
        </tbody>
      </table>
    <?php
          } else {
             ?>
      <tbody>
        <?php
        $show_product = $product->show_product_user();
        if ($show_product) {
          while ($result = $show_product->fetch_array()) { ?>
            <tr>

              <td><?php echo $result[0]; ?></td>
              <td><?php echo $result[1]; ?></td>
              <td>
                <img src="<?php echo "uploads/" .
                  $result[2]; ?>" alt="" width="100px" />
              </td>
              <td><?php echo $result[3]; ?></td>
              <td><?php echo $fm->textShorten($result[4], 50); ?></td>
              <td><?php echo $result[5]; ?></td>
              <td>
                <label class="switch">
                  <?php if ($result[6] == "1") {
                    $check_status = "checked";
                    $slider_style = "background-color: #2196f3;";
                  } else {
                    $check_status = "";
                    $slider_style = "";
                  } ?>
                  <input type="checkbox" <?php echo $check_status; ?> id="<?php echo $result[0]; ?>" value="<?php echo $result[6]; ?>"/>
                  <span class="slider round" style="<?php echo $slider_style; ?>" name="<?php echo $result[0]; ?>" id="span-<?php echo $result[0]; ?>" onclick="handleClick(<?php echo $result[0]; ?>)"></span>
                </label>
              </td>
              <td><?php echo $result[7]; ?></td>
              <td><?php echo $result[8]; ?></td>
              <td><?php echo $result[9]; ?></td>
              <td><?php echo $result[10]; ?></td>
              <td><a href="product_edit.php?id=<?php echo $result[0]; ?>">Edit</a> | <a href="?id=<?php echo $id; ?>&deleteid=<?php echo $result[0]; ?>">Delete</a> | <a href="product_detail.php?id=<?php echo $result[0]; ?>">Details</a>
              <td>

            </tr>
      <?php }
        }

          } ?>
      </tbody>
      </table>
    </div>
  </div>
</div>
<script>

</script>