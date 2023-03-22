<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0" />
    <title>Toy Shop Admin</title>

    <link
      rel="stylesheet"
      href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css"
    />
    <link rel="stylesheet" href="./css/index.css" />
  </head>
  <body>
    <?php include_once "./components/slidebar.php"; ?>

    <div class="admin-main-content">
      <?php include_once "./components/header.php";
            include_once "dashboard.php" ?>
    </div>
  <script src="./paginate.js"></script>
  </body>
</html>
