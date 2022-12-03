<?php

include_once("../library/conexion.php");

class modelDetalleCompra{

    private $idMetodoEnvio;
    private $direccion1;
    private $direccion2;
    private $nombres;
    private $apellidos;
    private $provincia;
    private $distrito;
    private $departamento;
    private $celular;
    private $dniRecoge;
    private $idCliente;

    public function __construct(){}

    public function insertarDetalleCompra($metodoEnvio, $direccion1, $direccion2, $nombres, $apellidos, $provincia, $distrito, $departamento, $celular, $dniRecoge, $id_cliente){

        $bd = new Conexion;
        $valorTemp = 1;

        try{

            

            $consulta = "INSERT INTO detalle_envio(id_pedido, id_metodoEnvio, direccion_1, direccion_2, Nombres, Apellidos, provincia, distrito, departamento, celular, dniRecoge, id_cliente) 
            VALUES (:id_pedido, :id_metodoEnvio, :direccion_1, :direccion_2, :Nombres, :Apellidos, :provincia, :distrito, :departamento, :celular, :dniRecoge, :id_cliente)";

            $registrarD = $bd -> conecta() -> prepare($consulta);
            $registrarD -> bindParam(':id_pedido', $valorTemp, PDO::PARAM_STR);
            $registrarD -> bindParam(':id_metodoEnvio', $metodoEnvio, PDO::PARAM_INT);
            $registrarD -> bindParam(':direccion_1', $direccion1, PDO::PARAM_STR);
            $registrarD -> bindParam(':direccion_2', $direccion2, PDO::PARAM_STR);
            $registrarD -> bindParam(':Nombres', $nombres, PDO::PARAM_STR);
            $registrarD -> bindParam(':Apellidos', $apellidos, PDO::PARAM_STR);
            $registrarD -> bindParam(':provincia', $provincia, PDO::PARAM_STR);
            
            $registrarD -> bindParam(':distrito', $distrito, PDO::PARAM_STR);
            $registrarD -> bindParam(':departamento', $departamento, PDO::PARAM_STR);
            $registrarD -> bindParam(':celular', $celular, PDO::PARAM_STR);
            $registrarD -> bindParam(':dniRecoge', $dniRecoge, PDO::PARAM_STR);
            $registrarD -> bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);            
            $registrarD -> execute();

            echo '<script type="text/javascript">
                  alert("¡Detalle de Envío Registrado! Puede continuar con el pago");      
                  window.location.href="../views/carritoCompra.php";            
                  </script>';                
                  exit();
        }catch (PDOException $e){
            echo 'Falló el registro del detalle de envío: '.$e->getMessage();
            die();
        }finally{
            $registrarD = null;
            $bd = null;
        }

    }

    public function editarDetalleCompra($metodoEnvio, $direccion1, $direccion2, $nombres, $apellidos, $provincia, $distrito, $departamento, $celular, $dni, $id_cliente){
        $bd = new Conexion;
        $valorTemp = 1;

        try{

            $consulta = "UPDATE detalle_envio SET id_pedido = :id_pedido, id_metodoEnvio = :id_metodoEnvio, direccion_1 = :direccion_1, direccion_2 = :direccion_2, 
            Nombres = :Nombres, Apellidos = :Apellidos, provincia = :provincia, distrito = :distrito, departamento = :departamento, celular = :celular, dniRecoge = :dniRecoge
            WHERE id_cliente = :id_cliente";

            $editarD = $bd -> conecta() -> prepare($consulta);
            $editarD -> bindParam(':id_pedido', $valorTemp, PDO::PARAM_INT);
            $editarD -> bindParam(':id_metodoEnvio', $metodoEnvio, PDO::PARAM_INT);
            $editarD -> bindParam(':direccion_1', $direccion1, PDO::PARAM_STR);
            $editarD -> bindParam(':direccion_2', $direccion2, PDO::PARAM_STR);
            $editarD -> bindParam(':Nombres', $nombres, PDO::PARAM_STR);
            $editarD -> bindParam(':Apellidos', $apellidos, PDO::PARAM_STR);
            $editarD -> bindParam(':provincia', $provincia, PDO::PARAM_STR);
            $editarD -> bindParam(':distrito', $distrito, PDO::PARAM_STR);
            $editarD -> bindParam(':departamento', $departamento, PDO::PARAM_STR);
            $editarD -> bindParam(':celular', $celular, PDO::PARAM_STR);
            $editarD -> bindParam(':dniRecoge', $dni, PDO::PARAM_STR);      
            $editarD -> bindParam(':id_cliente', $id_cliente, PDO::PARAM_STR);
            $editarD -> execute();

            echo '<script type="text/javascript">
                  alert("¡Detalle de Envío Actualizado! Puede continuar con el pago");       
                  window.location.href="../views/carritoCompra.php";           
                  </script>';                
                  exit();
        }catch (PDOException $e){
            echo 'Falló el registro del detalle de envío: '.$e->getMessage();
            die();
        }finally{
            $editarD = null;
            $bd = null;
        }
    }

    public function setIdMetodoEnvio(string $metodo){
        $this -> idMetodoEnvio = $metodo;
    }

    public function setDireccion1(string $direccion11){
        $this -> direccion1 = $direccion11;
    }

    public function setDireccion2(string $direccion22){
        $this -> direccion2 = $direccion22;
    }

    public function setNombres(string $nombre){
        $this -> nombres = $nombre;
    }

    public function setApellidos(string $apellido){
        $this -> apellidos = $apellido;
    }

    public function setProvincia(string $provincia){
        $this -> provincia = $provincia;
    }

    public function setDistrito(string $distrito){
        $this -> distrito = $distrito;
    }

    public function setDepartamento(string $departamento){
        $this -> departamento = $departamento;
    }

    public function setCelular(string $celular){
        $this -> celular = $celular;
    }

    public function setDniRecoge(string $dni){
        $this -> dniRecoge = $dni;
    }

    public function setIdCliente(string $idCliente){
        $this -> idCliente = $idCliente;
    }

    public function getIdMetodoEnvio(): string{
        return $this -> idMetodoEnvio;
    }

    public function getDireccion1(): string{
        return $this -> direccion1;
    }

    public function getDireccion2(): string{
        return $this -> direccion2;
    }

    public function getNombres(): string{
        return $this -> nombres;
    }

    public function getApellidos(): string{
        return $this -> apellidos;
    }

    public function getProvincia(): string{
        return $this -> provincia;
    }

    public function getDistrito(): string{
        return $this -> distrito;
    }

    public function getDepartamento(): string{
        return $this -> departamento;
    }

    public function getCelular(): string{
        return $this -> celular;
    }

    public function getDNI(): string{
        return $this -> dniRecoge;
    }

    public function getIdCliente(): string{
        return $this -> idCliente;
    }
}


?>