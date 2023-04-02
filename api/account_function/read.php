<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    include_once "../database/db.php";
    include_once "../model/account_function.php";

    $db = new DB();
    $connect = $db->connect();
    $account_function = new AccountFunction($connect);
    $read = $account_function->read();

    $num = $read->rowCount();
    if ($num > 0) {
        $account_function_array = array();
        $account_function_array['account_function'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $account_function_item = array(
                'id' => $id,
                'name' => $name
            );
            //đẩy dữ liệu của mảng question_item vào mảng mới là category_array['data]
            array_push($account_function_array['account_function'], $account_function_item);
        }
        echo json_encode($account_function_array);
    }


?>