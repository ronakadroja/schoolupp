<?php

class Database {

    private $username = "root";
    private $password = "";
    private $dbname = "sms";
    private $database = "mysql"; // your database which you use
    private $hostname = "localhost";
    public $conn;

    public function __construct(){
        try {
            $this->conn = new PDO($this->database . ':' . 'host=' . $this->hostname . ';' . 'dbname=' . $this->dbname,$this->username,$this->password );


        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        
        }

        return $this->conn;
    }

    public function testInput($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    public function showMessage($type,$message){
        return ' <div class="alert alert-'. $type .' alert-dismissible fade show" role="alert">
        ' . $message . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div> ';
    }
}

?>