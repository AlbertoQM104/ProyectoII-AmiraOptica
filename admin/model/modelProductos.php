<?php 

include("../library/conexion.php");

class modelProductos{
    
    private $id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $id_categoria;
    private $imagen;
    
    

    public function __construct($nombre_, $descripcion_, $precio_, $stock_, $id_categoria_, $imagen_){        
        $this->nombre=$nombre_;
        $this->descripcion=$descripcion_;
        $this->precio=$precio_;
        $this->stock=$stock_;
        $this->id_categoria=$id_categoria_;
        $this->imagen=$imagen_;
    }

    public function insertar($nombre, $descripcion, $precio, $stock, $id_categoria, $imagen){

        $bd = new Conexion; 

        try{

            $consulta = "INSERT INTO producto(nombre, Descripcion, precio, stock, id_categoria, imagen) VALUES (:nombre, :descripcion, :precio, :stock, :id_categoria, :imagen)";

            $registrar = $bd -> conecta() -> prepare($consulta);
            $registrar -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $registrar -> bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
            $registrar -> bindParam(':precio', $precio, PDO::PARAM_STR);
            $registrar -> bindParam(':stock', $stock, PDO::PARAM_INT);
            $registrar -> bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
            $registrar -> bindParam(':imagen', $imagen, PDO::PARAM_STR);
            $registrar -> execute();

            /* ['nombre'=>$nombre, 'apellido' => $apellido, 'correo'=>$correo, 'passw'=>$passw] */
            
            echo '<script type="text/javascript">
                  alert("¡Registro de producto exitoso!");
                  window.location.href="../view/Productos.php";
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

    public function editar($id, $nombre, $descripcion, $precio, $stock, $id_categoria, $imagen){
        
        $bd = new Conexion; 

        try{

            $consulta = "UPDATE producto SET nombre=?, Descripcion=?, precio=?, stock=?, id_categoria=?, imagen=? WHERE id=?";

            $editar = $bd -> conecta() -> prepare($consulta);            
            $editar -> execute([$nombre, $descripcion, $precio, $stock, $id_categoria, $imagen, $id]);

            
            
            echo '<script type="text/javascript">
                  alert("Producto Editado con éxito!");
                  window.location.href="../view/Productos.php";
                  </script>';                
                  exit();
                  
        }catch (PDOException $e){
            echo 'Falló el registro de usuario: '.$e->getMessage();
            die();
        }finally{
            $editar = null;
            $bd = null;
        }
    }

    public function eliminar($id){

        $bd = new Conexion;

        try{

            $consulta = "DELETE FROM producto WHERE id=?";

            $eliminar = $bd -> conecta() -> prepare($consulta);
            $eliminar->execute([$id]);

            echo '<script type="text/javascript">
            alert("¡Producto Eliminado!");
            window.location.href="../view/Productos.php";
            </script>';

        }catch(PDOEXception $e){
            echo 'Falló al eliminar producto: '.$e->getMessage();
            die();
        }finally{
            $eliminar = null;
            $bd = null;
        }

    }

    public function setId(string $id1){
        $this->id = $id1;
    }

    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function getPrecio(){
        return $this->precio;
    }

    public function getStock(){
        return $this->stock;
    }

    public function getIDCategoria(){
        return $this->id_categoria;
    }

    public function getImagen(){
        return $this->imagen;
    }

    public function getLentesContacto(){

    }

    public function getLentesSol(){
        
    }

    public function getLentesOftalmologicos(){
        
    }



}

?>