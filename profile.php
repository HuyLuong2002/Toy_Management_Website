<?php
$filepath = realpath(dirname(__DIR__));
include_once($filepath . "\Toy_Management_Website\classes\account.php");

$account = new Account();
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
    <div class="profile-container">
        <?php
        $show_account = $account->show_account_by_id($_GET["id"]);
        if ($show_account) {
            while ($result_account = $show_account->fetch_array()) {
                ?>
                <div class="profile-left">
                    <div class="profile-img">
                        <img src="./assets/images/pic-1.png" alt="">
                    </div>
                    <div class="profile-username"><?php echo $result_account[1]?></div>
                </div>
                <div class="profile-right">
                    <div class="profile-header">Information</div>
                    <div class="profile-info">Firstname</div>
                    <div class="profile-firstname"><?php echo $result_account[3]?></div>
                    <div class="profile-info">Lastname</div>
                    <div class="profile-lastname"><?php echo $result_account[4]?></div>
                    <div class="profile-info">Gender</div>
                    <div class="profile-gender"><?php echo $result_account[5]?></div>
                    <div class="profile-info">Date of Birth</div>
                    <div class="profile-dob"><?php echo $result_account[6]?></div>
                    <div class="profile-info">Place of Birth</div>
                    <div class="profile-pob"><?php echo $result_account[7]?></div>
                    <div class="profile-info">Create Date</div>
                    <div class="profile-createDate"><?php echo $result_account[8]?></div>
                </div>
                <?php
            }
        }
        ?>
    </div>