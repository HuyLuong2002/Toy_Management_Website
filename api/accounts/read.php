<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    include_once "../database/db.php";
    include_once "../model/account.php";

    $db = new DB();
    $connect = $db->connect();
    $account = new Account($connect);
    $read = $account->read();

    $num = $read->rowCount();
    if ($num > 0) {
        $account_array = array();
        $account_array['account'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $account_item = array(
                'id' => $id,
                'username' => $username,
                'password' => $password,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'gender' => $gender,
                'date_birth' => $date_birth,
                'place_of_birth' => $place_of_birth,
                'create_date' => $create_date,
                'permission_id' => $permission_id,
                'status' => $status
            );
            //đẩy dữ liệu của mảng question_item vào mảng mới là account_array['data]
            array_push($account_array['account'], $account_item);
        }
        echo json_encode($account_array);
    }


?>