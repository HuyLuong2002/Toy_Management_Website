<?php
$filepath = realpath(dirname(__DIR__));
include_once $filepath . "\database\connectDB.php";
include_once $filepath . "\classes\provider.php";
$provider = new Provider();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
  $insertProvider = $provider->insert_provider($_POST, $_FILES);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet"
    href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />
  <link rel="stylesheet" href="./css/index.css" />
  <link rel="stylesheet" href="./css/table-list.css" />
  <link rel="stylesheet" href="./css/newProduct.css" />
  <title>Add provider</title>

</head>

<body>
  <div class="form-container">
    <?php if (isset($insertprovider)) {
      echo $insertprovider;
    } ?>
    <form action="provider_add.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required>
      </div>

      <input type="submit" name="submit" Value="Save" />
    </form>
  </div>
</body>

</html>