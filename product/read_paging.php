<?php
      //required headers
      header("Access-Control-Allow-Origin: *");
      header("Content-Type: application/json; charset=UTF-8");

      //include database and object files
      include_once '../shared/helpers.php';
      include_once '../config/core.php';
      include_once '../config/database.php';
      include_once '../objects/product.php';


      //instantiate database object
      $database = new Database();
      $db = $database->getConnection();

      //initialize product object
      $product = new Product($db);

      //utilities
      $utilities = new Helpers();


      //query the products
      $stmt = $product->readPaging($from_record_num, $records_per_page);
      $num = $stmt->rowCount();

      //check if more tha 0 records were found
      if($num > 0){
        //product array
        $products_arr = array();
        $products_arr["records"] = array();
        $products_arr["paging"] = array();

        //retrieve the table of contents
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          //extract row
          extract($row);

          $product_item = array(
            "id" => $id,
            "name" => $name,
            "description" => html_entity_decode($description),
            "price" => $price,
            "category_id" => $category_id,
            "category_name" => $category_name
          );

          array_push($products_arr["records"], $product_item);
        }

        //include paging
        $total_rows = $product->count();
        $page_url="{home_url}product/read_paging.php?";
        $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
        $products_arr["paging"] = $paging;

        echo json_encode($products_arr);
      }else {
        echo json_encode(
          array("message" => "No products found.")
        );
      }
?>
