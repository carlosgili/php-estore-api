<?php
class Category{

      //datbase connection and table name variables
      private $conn;
      private $table_name = "categories";


      //object properties
      public $id;
      public $name;
      public $description;
      public $created;

      public function __construct($db){
        $this->conn = $db;
      }

      //this is used by the select drop down list
      public function readAll(){
        $query = "SELECT
                    id, name, description
                FROM
                    " . $this->table_name . "
                ORDER BY
                    name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
      }


      public function read(){
        $query = "SELECT
                id, name, description
            FROM
                " . $this->table_name . "
            ORDER BY
                name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
      }

}

?>
