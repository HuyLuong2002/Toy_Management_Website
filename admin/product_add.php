<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "/controller/productsController.php";
include_once $filepath . "/controller/categoryController.php";
include_once $filepath . "/controller/saleController.php";

$product_addController = new ProductsController();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
  $insertProduct = $product_addController->insert_product($_POST, $_FILES);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/add.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <title>Add product</title>
</head>

<body>
  <div class="form-container">
    <div class="back">
      <a href="index.php?id=2&page=1">Back</a>
    </div>

    <form action="product_add.php" method="post" enctype="multipart/form-data" class="product-add-form">
      <?php if (isset($insertProduct)) {
        echo $insertProduct;
      } ?>

      <div class="form-left-info">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" id="name" name="name_add" class="name">
          <div id="name_add_result"></div>
        </div>

        <div class="form-group">
          <label for="price">Price</label>
          <input type="text" id="price" name="price_add" class="price" required>
          <div id="price_add_result"></div>
        </div>

        <div class="form-group">
          <label for="category">Category</label>
          <select id="category" name="category_add" class="category" required>
            <option value="">Select category</option>
            <?php
            $categoryController = new CategoryController();
            $show_cat = $categoryController->show_category();
            if ($show_cat) {
              $i = 0;
              while ($result = $show_cat->fetch_assoc()) {
                $i++; ?>
                <option value="<?php echo $result["id"]; ?>"><?php echo $result["name"]; ?></option>
            <?php
              }
            }
            ?>
          </select>
        </div>

        <div class="form-group">
          <label for="sale">Sale</label>
          <select id="sale" name="sale_add" class="sale" required>
            <option value="">Select sale</option>
            <?php
            $saleController = new SaleController();
            $show_sale = $saleController->show_sale();
            if ($show_sale) {
              $i = 0;
              while ($result = $show_sale->fetch_assoc()) {
                $i++; ?>
                <option value="<?php echo $result["id"]; ?>"><?php echo $result["name"]; ?></option>
            <?php
              }
            }
            ?>
          </select>
        </div>

        <div class="form-group">
          <label for="quantity">Quantity</label>
          <input type="number" id="quantity" name="quantity_add" class="quantity" required>
          <div id="quantity_add_result"></div>
        </div>

        <div class="form-group">
          <label for="uploadfile">Upload File</label>
          <input type="file" id="uploadfile" name="uploadfile_add" class="uploadfile" required>
        </div>

        <input type="submit" name="submit" id="add-btn" class="submit" Value="Save" />

      </div>

      <div class="form-right-info">
        <div class="form-group">
          <label for="description">Description</label>
          <textarea id="description" name="description_add" class="tinymce"></textarea>
        </div>
      </div>

    </form>
  </div>
</body>
<script src="https://cdn.tiny.cloud/1/a4yip95kil5x5nn5y60qcu7jeg755ii26thhre1j0rxwg6ae/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
  tinymce.init({
    selector: '.tinymce',

    width: "100%",
    height: "480",
  });
</script>

<script src="./js/validate_input.js"></script>

<!-- coding check input value function -->
<script type="text/javascript">
  $(document).ready(function() {
    $("#name").keyup(function() {
      var input = $(this).val();
      if (checkAddAndEdit(input) == false) {
        $("#name_add_result").html("<span class='error'>Product Name Not Valid</span>");
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

    $("#price").keyup(function() {
      var input = $(this).val();
      if (checkAddAndEditPrice(input) == false) {
        $("#price_add_result").html("<span class='error'>Product Price Not Valid</span>");
        $("#add-btn").prop("disabled", true);
        $("#add-btn").css("background-color", "red");
        $("#price_add_result").css("display", "block");
        $("#price_add_result").css("margin-top", "1rem");
      } else {
        $("#price_add_result").css("display", "none");
        $("#add-btn").prop("disabled", false);
        $("#add-btn").css("background-color", "#0be881");
      }
    });

    $("#quantity").keyup(function() {
      var input = $(this).val();
      if (checkAddAndEditQuantity(input) == false) {
        $("#quantity_add_result").html("<span class='error'>Product Quantity Not Valid</span>");
        $("#add-btn").prop("disabled", true);
        $("#add-btn").css("background-color", "red");
        $("#quantity_add_result").css("display", "block");
        $("#quantity_add_result").css("margin-top", "1rem");
      } else {
        $("#quantity_add_result").css("display", "none");
        $("#add-btn").prop("disabled", false);
        $("#add-btn").css("background-color", "#0be881");
      }
    });


  });
</script>

</html>