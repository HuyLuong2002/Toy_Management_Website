<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    include_once "../database/db.php";
    include_once "../model/category.php";

    $db = new DB();
    $connect = $db->connect();
    $category = new Category($connect);
    $read = $category->read();

    $num = $read->rowCount();
    if ($num > 0) {
        $category_array = array();
        $category_array['category'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $category_item = array(
                'id' => $id,
                'name' => $name
            );
            //đẩy dữ liệu của mảng question_item vào mảng mới là category_array['data]
            array_push($category_array['category'], $category_item);
        }
        echo json_encode($category_array);
    }


?>