<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\controller\providersController.php";
$providerController = new ProviderController();

if (isset($_POST["input"])) {
  $input = $_POST["input"];
  $show_provider_live_search = $providerController->show_provider_live_search($input);
}

if (isset($_GET["id"])) {
  $id = $_GET["id"];
}

if (isset($_GET["deleteid"])) {
  $delete_id = $_GET["deleteid"];
  $delete_provider = $providerController->delete_provider($delete_id);
}
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
        <tbody>
          <?php
          $show_provider = $providerController->show_provider_user();
          if ($show_provider) {
            while ($result = $show_provider->fetch_array()) { ?>
              <tr>

              <td>
                <?php echo $result[0]; ?>
              </td>
              <td>
                <?php echo $result[1]; ?>
              </td>
              <td>
                <a href="provider_edit.php?id=<?php echo $result[0]; ?>">Edit <i class="fa-solid fa-pen-to-square" style="color: #0600ff;"></i></a>
                <a href="?id=<?php echo $id; ?>&deleteid=<?php echo $result[0]; ?>" class="delete">Delete <i class="fa-solid fa-trash" style="color: #ff0000;"></i></a>
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