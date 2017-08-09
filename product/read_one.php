<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');

  //include database and object Files
  include_once '../config/database.php';
  include_once '../objects/product.php';

  // get database connection
  $database = new Database();
  $db = $database->getConnection();

  // prepare product object
  $product = new Product($db);

  //set the id property of the product to be edited
  $product->id = isset($_GET['id']) ? $_GET['id'] : die();

  //read the details of the product to be edited
  $product->readOne();

  //create array
  $prodcut_arr = array(
    "id" => $product->id,
    "name" => $product->name,
    "description" => $product->description,
    "price" => $product->price,
    "category_id" => $product->category_id,
    "category_name" => $product->category_name
  );

  //output the product in json format
  print_r(json_encode($prodcut_arr));

?>
