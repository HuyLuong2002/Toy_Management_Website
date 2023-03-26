<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    include_once "../database/db.php";
    include_once "../model/product.php";

    $db = new DB();
    $connect = $db->connect();
    $product = new Product($connect);
    $read = $product->read();

    $num = $read->rowCount();
    if ($num > 0) {
        $product_array = array();
        $product_array['product'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $product_item = array(
                'id' => $id,
                'name' => $name,
                'image' => $image,
                'price' => $price,
                'create_date' => $create_date,
                'highlight' => $highlight,
                'category_id' => $category_id,
                'sale_id' => $sale_id,
                'review' => $review,
                'quantity' => $quantity
            );
            //đẩy dữ liệu của mảng question_item vào mảng mới là category_array['data]
            array_push($product_array['product'], $product_item);
        }
        echo json_encode($product_array);
    }


?>