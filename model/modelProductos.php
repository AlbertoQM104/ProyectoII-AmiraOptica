<?php 

include_once("../library/conexion.php");

class modelProductos{

    private $id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    
    

    public function __construct(){
        
    }

    public function insertar($nombre, $descripcion, $precio, $stock){

        $bd = new Conexion; 

        try{

            $consulta = "INSERT INTO producto(nombre, descripcion, precio, stock) VALUES (:nombre, :descripcion, :precio, :stock)";

            $registrar = $bd -> conecta() -> prepare($consulta);
            $registrar -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $registrar -> bindParam(':descripcion', $descripcion, );
            $registrar -> bindParam(':precio', $precio, PDO::PARAM_STR);
            $registrar -> bindParam(':stock', $stock, PDO::PARAM_INT);
            $registrar -> execute();

            /* ['nombre'=>$nombre, 'apellido' => $apellido, 'correo'=>$correo, 'passw'=>$passw] */
                
            echo '<script type="text/javascript">
                  alert("¡Registro de datos exitoso!");
                  window.location.href="../views/login.php";
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

    public function eliminar($id){

        $bd = new Conexion;

        try{

            $consulta = "DELETE FROM productos WHERE id=?";
            $eliminar = $bd -> conecta() -> prepare($consulta);
            $eliminar->execute([$id]);

        }catch(PDOEXception $e){
            echo 'Falló al eliminar producto: '.$e->getMessage();
            die();
        }finally{
            $eliminar = null;
            $bd = null;
        }

    }

    public function getLentesContacto(){

    }

    public function getLentesSol(){
        
    }

    public function getLentesOftalmologicos(){
        
    }



}

?>