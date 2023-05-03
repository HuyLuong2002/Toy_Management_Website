<?php
$filepath = realpath(dirname(__DIR__));
include_once($filepath . "\Toy_Management_Website\controller\accountController.php");

$accountController = new AccountController();

if (empty($_GET["id"])) {
    header("Location: login.php");

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
                    <?php echo $result_account[1] ?>
                </div>
                <div class="rightbox">
                    <div class="profile">
                        <h1>Personal Info</h1>
                        <h2>First Name</h2>
                        <p>
                            <?php echo $result_account[3] ?>
                        </p>

                        <h2>Lastname</h2>
                        <p>
                            <?php echo $result_account[4] ?>
                        </p>
                        <h2>Gender</h2>
                        <p>
                            <?php echo $result_account[5] ?>
                        </p>
                        <h2>Date of Birth</h2>
                        <p>
                            <?php echo $result_account[6] ?>
                        </p>
                        <h2>Place of Birth </h2>
                        <p>
                            <?php echo $result_account[7] ?>
                        </p>
                        <h2>Create Date </h2>
                        <p>
                            <?php echo $result_account[8] ?>
                        </p>
                    </div>

                </div>
                <?php
            }
        }
        ?>
    </div>