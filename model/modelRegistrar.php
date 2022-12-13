<?php
// Conexión con la BD
include("../library/conexion.php");

class modelRegistrar{

    private $intID;
    private $strNombre;
    private $strApellido;
    private $strCorreo;
    private $strPassword;
    private $strDni;


    public function __construct(){}
    
    public function registrar($nombre, $apellido, $correo, $passw, $dni){

        $bd = new Conexion;           

        try{

            //Primero se verifica si existe el correo
            $query = $bd -> conecta() -> prepare("SELECT * FROM cliente WHERE correo = :correo");
            $query -> execute(['correo'=>$correo]);

            $emailExistencia = $query -> fetchColumn();

            if($emailExistencia > 0){

                echo '<div class="error">El email: '.$correo.' ya existe. Prueba con otro.</div>';
                
            }else{

                $consulta = "INSERT INTO cliente(nombres, apellidos, correo, contraseña, dni) VALUES (:nombres, :apellidos, :correo, :passw, :dni)";

                $registrar = $bd -> conecta() -> prepare($consulta);
                $registrar -> bindParam(':nombres', $nombre, PDO::PARAM_STR);
                $registrar -> bindParam(':apellidos', $apellido, PDO::PARAM_STR);
                $registrar -> bindParam(':correo', $correo, PDO::PARAM_STR);
                $registrar -> bindParam(':passw', $passw, PDO::PARAM_STR);
                $registrar -> bindParam(':dni', $dni, PDO::PARAM_STR);
                $registrar -> execute();

                /* ['nombre'=>$nombre, 'apellido' => $apellido, 'correo'=>$correo, 'passw'=>$passw] */
                
                    echo '<script type="text/javascript">
                        alert("¡Registro de datos exitoso!");
                        window.location.href="../views/login.php";
                        </script>';                
                    exit();
                

                
            } 

        }catch (PDOException $e){
            echo 'Falló el registro de usuario: '.$e->getMessage();
            die();
        }finally{
            $registrar = null;
            $bd = null;
        }
        

    }

    public function getNombre():string{
        return $this->strNombre;
    }

    public function getApellido():string{
        return $this->strApellido;
    }

    public function getCorreo():string{
        return $this->strCorreo;
    }

    public function getPassword():string{
        return $this->strPassword;
    }

    public function getDni():string{
        return $this->strDni;
    }

    public function setNombre(string $nombre){
        $this -> strNombre = $nombre;
    }

    public function setApellido(string $apellido){
        $this -> strApellido = $apellido;
    }

    public function setCorreo(string $correo){
        $this -> strCorreo = $correo;
    }

    public function setPassword(string $pass){
        $this -> strPassword = $pass;
    }

    public function setDni(string $dni){
        $this -> strDni = $dni;
    }
}

?>