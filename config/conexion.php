<?php 
    class conexion{
        private $host = "localhost";
        private $user = "root";
        private $pass = "";
        private $db = "prepa";
        private $charset = "utf8";

        public function conectar(){
            try{
                $connection = "mysql:host=".$this->host.";dbname=".$this->db.";charset=".$this->charset;
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];
                $pdo = new PDO($connection, $this->user, $this->pass, $options);
                return $pdo;
            }catch(PDOException $e){
                print_r("Error connection: ".$e->getMessage());
            }
        }

        
    }
?>