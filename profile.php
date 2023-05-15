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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
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
                                <div id="firstname_result"></div>
                            </div>

                            <div class="form-group">
                                <h2>Lastname</h2>
                                <input type="text" class="lastname" name="lastname" id="lastname" value="<?php echo $result_account[4] ?>">
                                <div id="lastname_result"></div>
                            </div>

                            <div class="form-group">
                                <h2>Gender</h2>
                                <select name="gender" id="gender" class="gender" <?php echo $fm->CheckGender($result_account[5]) ?>>
                                    <?php
                                    if ($fm->CheckGender($result_account[5]) == "nam") {
                                        $gender_Name = "selected";
                                        $gender_Nu = "";
                                        $gender = "";
                                    }
                                    if ($fm->CheckGender($result_account[5]) == "nữ") {
                                        $gender_Name = "";
                                        $gender_Nu = "selected";
                                        $gender = "";
                                    }
                                    if ($fm->CheckGender($result_account[5]) == "") {
                                        $gender_Name = "";
                                        $gender_Nu = "";
                                        $gender = "selected";
                                    }
                                    ?>
                                    <option value="" <?php echo $gender ?>>Select Gender</option>
                                    <option value="Nam" <?php echo $gender_Name ?>>Male</option>
                                    <option value="Nữ" <?php echo $gender_Nu ?>>Female</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <h2>Date of Birth</h2>
                                <input type="date" class="date_birth" name="date_birth" id="date_birth" value="<?php echo $fm->formatDateReverse($result_account[6]) ?>">
                            </div>

                            <div class="form-group">
                                <h2>Place of Birth </h2>
                                <input type="text" class="place_of_birth" id="place_of_birth" name="place_of_birth" value="<?php echo $result_account[7] ?>">
                                <div id="place_birth_result"></div>
                            </div>

                            <div class="form-group">
                                <h2>Password </h2>
                                <input type="password" class="password" name="password" id="password" value="<?php echo $result_account[2] ?>">
                                <div id="password_result"></div>
                            </div>
                            <button type="submit" id="update-btn" name="submit" class="btn">Update</button>
                        </div>
                    </form>
                </div>
        <?php
            }
        }
        ?>
    </div>


    <script src="https://kit.fontawesome.com/1b6e53cabd.js" crossorigin="anonymous"></script>

    <script src="/js/validate_input.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#firstname').keyup(function() {
                var input = $(this).val();
                if (checkName(input) == false) {
                    $("#firstname_result").html("<span class='error'>First Name Not Valid</span>");
                    $("#firstname_result").css("display", "block");
                    $("#firstname_result").css("margin-top", "5px");
                    $("#update-btn").prop("disabled", true);
                    $("#update-btn").css("background-color", "red");
                } else {
                    $("#firstname_result").css("display", "none");
                    $("#update-btn").prop("disabled", false);
                    $("#update-btn").css("background-color", "#3FB6A8");
                }
            });

            $('#lastname').keyup(function() {
                var input = $(this).val();
                if (checkName(input) == false) {
                    $("#lastname_result").html("<span class='error'>Last Name Not Valid</span>");
                    $("#lastname_result").css("display", "block");
                    $("#lastname_result").css("margin-top", "5px");
                    $("#update-btn").prop("disabled", true);
                    $("#update-btn").css("background-color", "red");
                } else {
                    $("#lastname_result").css("display", "none");
                    $("#update-btn").prop("disabled", false);
                    $("#update-btn").css("background-color", "#3FB6A8");
                }
            });

            $('#place_of_birth').keyup(function() {
                var input = $(this).val();
                if (checkAddAndEdit(input) == false) {
                    $("#place_birth_result").html("<span class='error'>Place of birth Not Valid</span>");
                    $("#place_birth_result").css("display", "block");
                    $("#place_birth_result").css("margin-top", "5px");
                    $("#update-btn").prop("disabled", true);
                    $("#update-btn").css("background-color", "red");
                } else {
                    $("#place_birth_result").css("display", "none");
                    $("#update-btn").prop("disabled", false);
                    $("#update-btn").css("background-color", "#3FB6A8");
                }
            });

            $("#password").keyup(function() {
                var input = $(this).val();
                if (checkPassword(input) == 0) {
                    $("#password_result").html("<span class='error'>Password not valid</span>");
                    $("#password_result").css("display", "block");
                    // $("#password_result").css("margin-bottom", "1rem");
                    $("#update-btn").prop("disabled", true);
                    $("#update-btn").css("background-color", "red");
                } else if (checkPassword(input) == 1) {
                    $("#password_result").html("<span class='error'>Password  must be between 6 and 20 characters</span>");
                    $("#password_result").css("display", "block");
                    // $("#password_result").css("margin-bottom", "1rem");
                    $("#update-btn").prop("disabled", true);
                    $("#update-btn").css("background-color", "red");
                } else if (checkPassword(input) == 2) {
                    $("#password_result").html("<span class='error'>Password must contain lowercase, uppercase and special characters</span>");
                    $("#password_result").css("display", "block");
                    $("#password_result").css("margin-bottom", "0.5rem");
                    $("#update-btn").prop("disabled", true);
                    $("#update-btn").css("background-color", "red");
                } else {
                    $("#password_result").css("display", "none");
                    $("#update-btn").prop("disabled", false);
                    $("#update-btn").css("background-color", "#3FB6A8");
                }
            });
        });
    </script>