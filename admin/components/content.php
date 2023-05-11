<div class="admin-main-content" id="admin-main-content">
  <div class="content" id="content">
    <?php if (isset($_GET["id"])) {
      $id = $_GET["id"];
      switch ($id) {
        case "1":
          include "dashboard.php";
          break;
        case "2":
          include "products.php";
          break;
        case "3":
          include "orders.php";
          break;
        case "4":
          include "inventory.php";
          break;
        case "5":
          include "accounts.php";
          break;
        case "6":
          include "permission.php";
          break;
        case "7":
          include "providers.php";
          break;
        case "8":
          include "sale.php";
          break;
        case "9":
          include "chart.php";
          break;
        case "10":
          include "category.php";
          break;
        case "11":
          include "inventory_detail.php";
          break;
        case "12":
          include "account_function.php";
          break;
        default:
          include "dashboard.php";
          break;
      }
    } ?>
  </div>
</div>