<?php

include("../library/conexion.php");

class modelRegisTarjetayPago{

    private $id_pedido;
    private $id_metodoPago;
    private $num_cuenta;
    private $ccv;
    private $vencimientoMes;
    private $vencimientoAnio;
    private $banco;
    private $id_cliente;


    public function __construct(){}

    public function insertarTarjeta($id_pedido, $id_metodoPago, $num_cuenta, $ccv, $vencimientoMes, $vencimientoAnio, $id_cliente){
        $bd = new Conexion; 

        try{

            $consulta = "INSERT INTO detalle_pago(id_pedido, id_metodoPago, num_cuneta, cci, MesVencimiento, AnioVencimiento, cvv, banco, id_cliente) 
            VALUES (:id_pedido, :id_metodoPago, :num_cuneta, :cci, :MesVencimiento, :AnioVencimiento, :cvv, :banco, :id_cliente)";

            $registrar = $bd -> conecta() -> prepare($consulta);
            $registrar -> bindParam(':id_pedido', $id_pedido, PDO::PARAM_STR);
            $registrar -> bindParam(':id_metodoPago', $id_metodoPago, );
            $registrar -> bindParam(':num_cuneta', $num_cuenta, PDO::PARAM_STR);
            $registrar -> bindParam(':cci', null, PDO::PARAM_INT);
            $registrar -> bindParam(':MesVencimiento', $vencimientoMes, PDO::PARAM_INT);
            $registrar -> bindParam(':AnioVencimiento', $vencimientoAnio, PDO::PARAM_INT);
            $registrar -> bindParam(':cvv', $ccv, PDO::PARAM_INT);
            $registrar -> bindParam(':banco', null, PDO::PARAM_STR);
            $registrar -> bindParam(':id_cliente', $id_cliente, PDO::PARAM_STR);
            $registrar -> execute();

            /* ['nombre'=>$nombre, 'apellido' => $apellido, 'correo'=>$correo, 'passw'=>$passw] */
                
            echo '<script type="text/javascript">
                  alert("¡Registro de tarjeta exitoso!");
                  window.location.href="../views/carritoCompra.php";
                  </script>';                
                  exit();
        }catch (PDOException $e){
            echo 'Falló el registro de tarjeta: '.$e->getMessage();
            die();
        }finally{
            $registrar = null;
            $bd = null;
        }
    }

    public function editarTarjeta($id_pedido, $id_metodoPago, $num_cuenta, $ccv, $vencimientoMes, $vencimientoAnio, $id_cliente){
        $bd = new Conexion; 

        try{

            $consulta = "UPDATE detalle_pago SET  id_metodoPago = :id_metodoPago, num_cuneta = :num_cuneta, MesVencimiento = :MesVencimiento, AnioVencimiento = :AnioVencimiento, 
            cvv = :cvv WHERE id_cliente = :id_cliente";

            $editar = $bd -> conecta() -> prepare($consulta);            
            $editar -> bindParam(':id_metodoPago', $id_metodoPago, );
            $editar -> bindParam(':num_cuneta', $num_cuenta, PDO::PARAM_STR);            
            $editar -> bindParam(':MesVencimiento', $vencimientoMes, PDO::PARAM_INT);
            $editar -> bindParam(':AnioVencimiento', $vencimientoAnio, PDO::PARAM_INT);
            $editar -> bindParam(':cvv', $ccv, PDO::PARAM_INT);            
            $editar -> bindParam(':id_cliente', $id_cliente, PDO::PARAM_STR);
            $editar -> execute();

            /* ['nombre'=>$nombre, 'apellido' => $apellido, 'correo'=>$correo, 'passw'=>$passw] */
                
            echo '<script type="text/javascript">
                  alert("¡Modificación de tarjeta exitoso!");
                  window.location.href="../views/carritoCompra.php";
                  </script>';                
                  exit();
        }catch (PDOException $e){
            echo 'Falló la modificación de tarjeta: '.$e->getMessage();
            die();
        }finally{
            $editar = null;
            $bd = null;
        }
    }

    public function pagar(){

    }

    public function setId_Pedido(string $IDPedido){
        $this -> id_pedido = $IDPedido;
    }

    public function setId_metodoPago(string $metodoPago){
        $this -> id_metodoPago = $metodoPago;
    }

    public function setNum_cuenta(string $numeroC){
        $this -> num_cuenta = $numeroC;
    }

    public function setCcv(string $ccv){
        $this -> ccv = $ccv;
    }

    public function setVencimientoMes(string $mes){
        $this -> vencimientoMes = $mes;
    }

    public function setVencimientoAnio(string $anio){
        $this -> vencimientoAnio = $anio;
    }

    public function setId_cliente(string $idCliente){
        $this -> id_cliente = $idCliente;
    }

    public function getId_Pedido(): string{
        return $this -> id_pedido;
    }

    public function getId_metodoPago(): string{
        return $this -> id_metodoPago;
    }

    public function getNum_cuenta(): string{
        return $this -> num_cuenta;
    }

    public function getCcv(): string{
        return $this -> ccv;
    }

    public function getVencimientoMes(): string{
        return $this -> vencimientoMes;
    }

    public function getVencimientoAnio(): string{
        return $this -> vencimientoAnio;
    }

    public function getId_cliente(): string{
        return $this -> id_cliente;
    }

}




?>