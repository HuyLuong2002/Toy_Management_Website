<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    include_once "../database/db.php";
    include_once "../model/provider.php";

    $db = new DB();
    $connect = $db->connect();
    $provider = new Provider($connect);
    $read = $provider->read();

    $num = $read->rowCount();
    if ($num > 0) {
        $provider_array = array();
        $provider_array['provider'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $provider_item = array(
                'id' => $id,
                'name' => $name
            );
            //đẩy dữ liệu của mảng question_item vào mảng mới là category_array['data]
            array_push($provider_array['provider'], $provider_item);
        }
        echo json_encode($provider_array);
    }


?>