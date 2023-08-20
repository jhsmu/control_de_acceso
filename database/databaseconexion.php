<?php
    class Database
    {
        private $host="localhost";
        private $dbname="fucla";
        private $username="root";
        private $password="";
        private $charset="utf8";

        public function connect(){
            
            //Primero declaramos los argumentos de la función de conexión
            $connection = "mysql: host=".$this->host."; dbname=".$this->dbname."; charset=".$this->charset;
            
            //Declaramos los párametros para el procesamiento de errores de la función
            $option=[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION];

            try{
                //Encierro el pedazo de código que puede fallar
                $pdo = new PDO($connection,$this->username,$this->password,$option);
                return $pdo;//Este es el objeto que nos interesa
            } catch(PDOException $e){
                return "Error: ".$e->getMessage();
                die();//Termina la ejecución
            }
        }
    }
