<?php
    include("../library/conexion.php");

    class modelLogin{

        private $strCorreo;
        private $strPassword;

        /* Cambiar el constructor */
        
        public function __construct(){}

        public function iniciar(string $correo, string $password){

            $bd = new Conexion;
            /* $bd -> conecta();   */ 

            try{

                $validarLogin = $bd->conecta()->prepare("select * from cliente where correo = ? and contraseña = ?;");
                $validarLogin -> execute([$correo, $password]);
                
                $datos = $validarLogin -> fetch(PDO::FETCH_OBJ);

                /* Capturar datos del cliente        */
                $idCli = $datos -> id;
                $nombre = $datos -> nombres;
                $dni = $datos -> dni;
                

                if($datos){
                    session_start();
                    $_SESSION['usuario'] = $correo;
                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['idCliente'] = $idCli;
                    $_SESSION['DNI'] = $dni;
                    
                    echo '<script type="text/javascript">
                        alert("Ingreso de datos exitoso. Iniciando sesión...");
                        window.location.href="../views/index.php";
                        </script>';                
                    exit();
                }else{
                    echo '*Usuario no existe, verifique los datos ingresados';
                } 
            }catch (PDOException $e){
                echo 'Falló el inicio de sesión de usuario: '.$e->getMessage();
                die();
            }finally{
                $validarLogin = null;
                $bd = null;
                $datos = null;
            }
        }

        public function getCorreo():string{
            return $this -> strCorreo;
        }

        public function getPassword():string{
            return $this -> strPassword;
        }

        public function setCorreo(String $corr){
            $this -> strCorreo = $corr;
        }

        public function setPassword(string $pass){
            $this -> strPassword = $pass;
        }
        
    }

?>