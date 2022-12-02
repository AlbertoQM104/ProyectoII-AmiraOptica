<?php 

include("../library/conexion.php");

class modelUsuarioSistema{
    
    private $id;
    private $nombres;
    private $apellidos;
    private $correo;
    private $contrasena;
    private $dni;
    private $celular;
    private $direccion;
    private $rol;

    public function __construct(){  
    }

    public function iniciarSesion($correo, $contrasena){
        $bd = new Conexion; 

        try{

            $sql = "SELECT * FROM usuario where correo = ? and contraseña = ?;";            
            

            $validarLogin = $bd -> conecta() -> prepare($sql);
            $validarLogin -> execute([$correo, $contrasena]);
            $datos = $validarLogin -> fetch(PDO::FETCH_OBJ);

            if($datos){
                session_start();
                $_SESSION['correo'] = $correo;
                echo '<script type="text/javascript">
                    alert("Ingreso de datos exitoso. Iniciando sesión...");
                    window.location.href="./Productos.php";
                    </script>';                
                exit();
            }else{
                echo '<div class="errorIn">*Usuario no existe, verifique los datos ingresados</div>';
            } 

        }catch(PDOException $e){
            echo 'Falló el inicio de sesión: '.$e->getMessage();
            die();
        }finally{

            $bd = null;
        }
    }

    public function insertar($nombres, $apellidos, $correo, $contrasena, $dni, $celular, $direccion, $rol){

        $bd = new Conexion; 

        try{

            $consulta = "INSERT INTO usuario(nombres, apellidos, correo, contraseña, dni, celular, direccion, rol) VALUES (:nombres, :apellidos, :correo, :contrasena, :dni, :celular, :direccion, :rol)";

            $registrar = $bd -> conecta() -> prepare($consulta);
            $registrar -> bindParam(':nombres', $nombres, PDO::PARAM_STR);
            $registrar -> bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
            $registrar -> bindParam(':correo', $correo, PDO::PARAM_STR);
            $registrar -> bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
            $registrar -> bindParam(':dni', $dni, PDO::PARAM_STR);
            $registrar -> bindParam(':celular', $celular, PDO::PARAM_STR);
            $registrar -> bindParam(':direccion', $direccion, PDO::PARAM_STR);
            $registrar -> bindParam(':rol', $rol, PDO::PARAM_STR);
            $registrar -> execute();
            
            echo '<script type="text/javascript">
                  alert("¡Registro de usuario del sistema exitoso!");
                  window.location.href="../view/Empleados.php";
                  </script>';                
                  exit();
                  
        }catch (PDOException $e){
            echo 'Falló el registro de usuario: '.$e->getMessage();
            die();
        }finally{
            $registrar = null;
            $bd = null;
        }
    }

    public function editar($id, $nombres, $apellidos, $correo, $contrasena, $dni, $celular, $direccion, $rol){
        
        $bd = new Conexion; 

        try{

            $consulta = "UPDATE usuario SET nombres=?, apellidos=?, correo=?, contraseña=?, dni=?, celular=?, direccion=?, rol=? WHERE id=?";

            $editar = $bd -> conecta() -> prepare($consulta);            
            $editar -> execute([$nombres, $apellidos, $correo, $contrasena, $dni, $celular, $direccion, $rol, $id]);

            
            
            echo '<script type="text/javascript">
                  alert("¡Empleado editado con éxito!");
                  window.location.href="../view/Empleados.php";
                  </script>';                
                  exit();
                  
        }catch (PDOException $e){
            echo 'Falló al editar usuario: '.$e->getMessage();
            die();
        }finally{
            $editar = null;
            $bd = null;
        }
    }

    public function eliminar($id){

        $bd = new Conexion;

        try{

            $consulta = "DELETE FROM usuario WHERE id=?";

            $eliminar = $bd -> conecta() -> prepare($consulta);
            $eliminar->execute([$id]);

            echo '<script type="text/javascript">
            alert("¡Usuario del sistema Eliminado!");
            window.location.href="../view/Empleados.php";
            </script>';

        }catch(PDOEXception $e){
            echo 'Falló al eliminar usuario: '.$e->getMessage();
            die();
        }finally{
            $eliminar = null;
            $bd = null;
        }

    }

    public function setId(string $id1){
        $this->id = $id1;
    }

    public function setNombres(string $nombres){
        $this->nombres = $nombres;
    }

    public function setApellidos(string $apellidos){
        $this->apellidos = $apellidos;
    }

    public function setCorreo(string $correo){
        $this->correo = $correo;
    }

    public function setContrasena(string $contrasena){
        $this->contrasena = $contrasena;
    }

    public function setDni(string $dni){
        $this->dni = $dni;
    }

    public function setCelular(string $celular){
        $this->celular = $celular;
    }

    public function setDireccion(string $direccion){
        $this->direccion = $direccion;
    }

    public function setRol(string $rol){
        $this->rol = $rol;
    }

    public function getId(){
        return $this->id;
    }

    public function getNombres(){
        return $this->nombres;
    }

    public function getApellidos(){
        return $this->apellidos;
    }

    public function getCorreo(){
        return $this->correo;
    }

    public function getContrasena(){
        return $this->contrasena;
    }

    public function getDni(){
        return $this->dni;
    }

    public function getCelular(){
        return $this->celular;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function getRol(){
        return $this->rol;
    }
}

?>