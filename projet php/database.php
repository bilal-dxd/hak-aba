<?php
class Database{
  
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "shop_db";
    private $username = "root";
    private $password = "";
    public $conn;
  
    // get the database connection
    public function getConnection(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            // En cas d'échec de la connexion, affichage d'un message d'erreur
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}
?>