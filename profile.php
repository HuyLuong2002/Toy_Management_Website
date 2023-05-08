<?php
$filepath = realpath(dirname(__DIR__));
include_once($filepath . "\Toy_Management_Website\controller\accountController.php");
include_once $filepath . "/helpers/format.php";

$accountController = new AccountController();
$fm = new Format();

if (empty($_GET["id"])) {
    header("Location: login.php");
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $updateAccount = $accountController->update_account_user($_POST, $id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="./assets/css/profile.css">
</head>

<body>
    <a href="index.php" class="return-btn">
        <i class="fa-solid fa-arrow-left"></i>
    </a>
    <div class="notification">
        <?php
        if (isset($updateAccount)) {
            echo $updateAccount;
        }
        ?>
    </div>
    <div class="container">
        <?php
        $show_account = $accountController->show_account_by_id($_GET["id"]);
        if ($show_account) {
            while ($result_account = $show_account->fetch_array()) {
        ?>
                <div class="leftbox">
                    <div class="avatar">
                        <img src="./assets/images/pic-1.png" alt="">
                    </div>
                    <div class="username">
                        <?php echo $result_account[1] ?>
                    </div>
                </div>
                <div class="rightbox">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="profile">
                            <h1>Personal Info</h1>
                            <div class="form-group">
                                <h2>First Name</h2>
                                <input type="text" class="firstname" name="firstname" id="firstname" value="<?php echo $result_account[3] ?>">
                            </div>

                            <div class="form-group">
                                <h2>Lastname</h2>
                                <input type="text" class="lastname" name="lastname" id="lastname" value="<?php echo $result_account[4] ?>">
                            </div>

                            <div class="form-group">
                                <h2>Gender</h2>
                                <select name="gender" id="gender" class="gender">
                                    <?php
                                    if ($result_account[5] == "Nam") {
                                        $gender_Name = "selected";
                                        $gender_Nu = "";
                                    } else {
                                        $gender_Name = "";
                                        $gender_Nu = "selected";
                                    }
                                    ?>
                                    <option value="Nam" <?php echo $gender_Name ?>>Nam</option>
                                    <option value="Nữ" <?php echo $gender_Nu ?>>Nữ</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <h2>Date of Birth</h2>
                                <input type="date" class="date_birth" name="date_birth" value="<?php echo $fm->formatDateReverse($result_account[6]); ?>">
                            </div>

                            <div class="form-group">
                                <h2>Place of Birth </h2>
                                <input type="text" class="place_of_birth" name="place_of_birth" value="<?php echo $result_account[7] ?>">
                            </div>

                            <div class="form-group">
                                <h2>Password </h2>
                                <input type="password" class="password" name="password" id="password" value="<?php echo $result_account[2] ?>">
                            </div>
                            <input type="submit" name="submit" class="btn" value="Update">

                        </div>
                        <!-- <button class="btn">update</button> -->
                    </form>
                </div>
        <?php
            }
        }
        ?>
    </div>

    <script src="https://kit.fontawesome.com/1b6e53cabd.js" crossorigin="anonymous"></script>