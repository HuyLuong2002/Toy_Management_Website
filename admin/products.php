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
?>
<div class="card" id="searchresult">
  <div class="card-header">
    <h3>Product List</h3>
    <button>
      Add product <span class="las la-plus"></span>
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
              <?php while ($result = $show_product_live_search->fetch_array()) { ?>
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
                    <td><a href="">Edit</a> | <a href="">Delete</a> | <a href="productDetail.php?id=<?php echo $result[0]; ?>">Details</a>
                    <td>

                  </tr>
            <?php }
            } else {
              echo "No Data Found";
            } ?>
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
                  <input type="checkbox" />
                  <span class="slider round"></span>
                </label>
              </td>
              <td><?php echo $result[7]; ?></td>
              <td><?php echo $result[8]; ?></td>
              <td><?php echo $result[9]; ?></td>
              <td><?php echo $result[10]; ?></td>
              <td><a href="">Edit</a> | <a href="">Delete</a> | <a href="productDetail.php?id=<?php echo $result[0]; ?>">Details</a>
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