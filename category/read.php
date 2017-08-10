<?php
      // required header
      header("Access-Control-Allow-Origin: *");
      header("Content-Type: application/json; charset=UTF-8");

      //include the database and object files
      include_once '../config/database.php';
      include_once '../objects/category.php';

      //instantiate database and Category object
      $database = new Database();
      $db = $database->getConnection();
      $category = new Category($db);

      //query the Category table
      $stmt = $category->read();
      $num = $stmt->rowCount();

      if($num > 0){
        //check if more than 0 recors are returned
        // products array
        $categories_arr=array();
        $categories_arr["records"]=array();

        //retireve all the reocrds with fetch()
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $category_item = array(
            "id" => $id,
            "name" => $name,
            "description" => html_entity_decode($description)
          );

          array_push($categories_arr["records"], $category_item);
        }
        echo json_encode($categories_arr);
      }else{
        echo json_encode(
          array("message" => "No products found.")
        );
      }


?>
