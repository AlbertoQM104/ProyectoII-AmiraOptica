<?php

    require_once ("../config/config.php");  

    Class Conexion{

        /* En caso que no se pueda importar la carpeta "config" */
        // Lista de configuración de la BD
        private $server = "localhost";
        private $user = "root";
        private $password = "";
        private $db = "db_optica";
        private $charset = "utf8";

        /* Devolver variable PDO */
        private $conecta;

        public function __construct(){
            $connectString = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;

            try{ 
                $this->conecta = new PDO($connectString, DB_USER, DB_PASSWORD);
                /* $this->conecta -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); */
                 /* echo "conexión exitosa";  */
            }catch(PDOException $e){ 
                $this->conecta = 'Error de conexión';
                echo "ERROR: ".$e->getMessage();
            } 
            
        }

        public function conecta(){            
                return $this->conecta;            
        }

        public function prepare($sql){
            $this->conecta->prepare($sql);
        }
    }    
?>