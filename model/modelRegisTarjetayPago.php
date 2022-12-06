<?php

include_once("../library/conexion.php");

class modelRegisTarjetayPago{

    private $id_pedido;
    private $id_metodoPago;
    private $nombreTitular;
    private $num_cuenta;
    private $ccv;
    private $vencimientoMes;
    private $vencimientoAnio;
    private $banco;
    private $id_cliente;


    public function __construct(){}

    public function insertarTarjeta($id_metodoPago, $nombre, $num_cuenta, $ccv, $vencimientoMes, $vencimientoAnio, $id_cliente,
     $fecha, $total){
        $bd = new Conexion;
        $con = $bd -> conecta(); 

        try{

            $consulta = "INSERT INTO detalle_pago(metodoPago, nombre, num_cuenta, MesVencimiento, AnioVencimiento, cvv, id_cliente) 
            VALUES (:metodoPago, :nombre, :num_cuenta, :MesVencimiento, :AnioVencimiento, :cvv, :id_cliente)";

            $registrar = $bd -> conecta() -> prepare($consulta);            
            $registrar -> bindParam(':metodoPago', $id_metodoPago, PDO::PARAM_STR);
            $registrar -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $registrar -> bindParam(':num_cuenta', $num_cuenta, PDO::PARAM_STR);            
            $registrar -> bindParam(':MesVencimiento', $vencimientoMes, PDO::PARAM_INT);
            $registrar -> bindParam(':AnioVencimiento', $vencimientoAnio, PDO::PARAM_INT);
            $registrar -> bindParam(':cvv', $ccv, PDO::PARAM_INT);            
            $registrar -> bindParam(':id_cliente', $id_cliente, PDO::PARAM_STR);
            $registrar -> execute();
            $id_detallePago = $con -> lastInsertId();

            if($registrar){

                $estadoP="RECIBIDO";                
                
                $consulta2 = "INSERT INTO pedido (fecha, total, estado, id_Cliente, id_detEnvio, id_detpago) 
                VALUES (:fecha, :total, :estado, :id_Cliente, :id_detEnvio, :id_detpago)";

                
                $cons = $con -> prepare("SELECT id from detalle_envio WHERE id_cliente = ?");
                $cons -> execute([$id_cliente]);
                $idDetalleEnvio = $cons -> fetchColumn();

                $regisPedido = $bd -> conecta() -> prepare($consulta2);
                $regisPedido -> bindParam(':fecha', $fecha, PDO::PARAM_STR);
                $regisPedido -> bindParam(':total', $total, PDO::PARAM_STR);
                $regisPedido -> bindParam(':estado', $estadoP, PDO::PARAM_STR);
                $regisPedido -> bindParam(':id_Cliente', $id_cliente, PDO::PARAM_STR);
                $regisPedido -> bindParam(':id_detEnvio', $idDetalleEnvio, PDO::PARAM_STR);
                $regisPedido -> bindParam(':id_detpago', $id_detallePago, PDO::PARAM_STR);
                $regisPedido -> execute();
                $id = $con -> lastInsertId(); 

                if($regisPedido){

                    $productos212 = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;
            
                    if($productos212 != null){
                        foreach($productos212 as $clave => $cantidad){
                            $sqlConsulta = $con->prepare("SELECT id, nombre, precio FROM producto WHERE id=?");
                            $sqlConsulta -> execute([$clave]);
                            $row_prod = $sqlConsulta->fetch(PDO::FETCH_ASSOC);
            
                            $precio = $row_prod['precio'];                
                            
                            $sql_insert = $con->prepare("INSERT INTO detalle_pedido (id_pedido, id_producto, nombre, cantidad) VALUES
                            (?,?,?,?)");
            
                            $sql_insert->execute([$id, $clave, $row_prod['nombre'], $cantidad]);
            
                        }
                    }
            
                    unset($_SESSION['carrito']);

                    echo '<script type="text/javascript">
                    alert("¡Registro de tarjeta exitoso y pedido!");
                    window.location.href="../views/carritoCompra.php";
                    </script>';                
                    exit();
            
                }    

                

            }
                
            
        }catch (PDOException $e){
            echo 'Falló el registro de tarjeta: '.$e->getMessage();
            die();
        }finally{
            $registrar = null;
            $bd = null;
            $con = null;            
            $cons = null;
        }
    }

    public function editarTarjeta($id_metodoPago, $nombre, $num_cuenta, $ccv, $vencimientoMes, $vencimientoAnio, $id_cliente,
    $fecha, $total){
        $bd = new Conexion; 
        $con = $bd -> conecta(); 

        try{

            $consulta = "UPDATE detalle_pago SET metodoPago = :metodoPago, nombre = :nombre,
            num_cuenta = :num_cuenta, MesVencimiento = :MesVencimiento, AnioVencimiento = :AnioVencimiento, cvv = :cvv 
            WHERE detalle_pago.id_cliente = :id_cliente";

            $editar = $bd -> conecta() -> prepare($consulta);            
            $editar -> bindParam(':metodoPago', $id_metodoPago, PDO::PARAM_INT);
            $editar -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $editar -> bindParam(':num_cuenta', $num_cuenta, PDO::PARAM_STR);            
            $editar -> bindParam(':MesVencimiento', $vencimientoMes, PDO::PARAM_INT);
            $editar -> bindParam(':AnioVencimiento', $vencimientoAnio, PDO::PARAM_INT);
            $editar -> bindParam(':cvv', $ccv, PDO::PARAM_INT);            
            $editar -> bindParam(':id_cliente', $id_cliente, PDO::PARAM_STR);
            $editar -> execute();  
                
            if($editar){

                $estadoP="PAGADO";                
                
                $consulta2 = "INSERT INTO pedido (fecha, total, estado, id_Cliente, id_detEnvio, id_detpago) 
                VALUES (:fecha, :total, :estado, :id_Cliente, :id_detEnvio, :id_detpago)";
                
                $cons2 = $bd -> conecta() -> prepare("SELECT id from detalle_envio WHERE id_cliente = ?");
                $cons2 -> execute([$id_cliente]);
                $idDetalleEnvio2 = $cons2 -> fetchColumn();

                $cons3 = $bd -> conecta() -> prepare("SELECT id from detalle_pago WHERE id_cliente = ?");
                $cons3 -> execute([$id_cliente]);
                $idPagoD = $cons3 -> fetchColumn();

                $editarPedido = $bd -> conecta() -> prepare($consulta2);
                $editarPedido -> bindParam(':fecha', $fecha, PDO::PARAM_STR);
                $editarPedido -> bindParam(':total', $total, PDO::PARAM_STR);
                $editarPedido -> bindParam(':estado', $estadoP, PDO::PARAM_STR);
                $editarPedido -> bindParam(':id_Cliente', $id_cliente, PDO::PARAM_STR);
                $editarPedido -> bindParam(':id_detEnvio', $idDetalleEnvio2, PDO::PARAM_INT);
                $editarPedido -> bindParam(':id_detpago', $idPagoD, PDO::PARAM_INT);
                $editarPedido -> execute();
                $id = $con -> lastInsertId(); 

                if($editarPedido){

                    $productos212 = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;
            
                    if($productos212 != null){
                        foreach($productos212 as $clave => $cantidad){
                            $sqlConsulta = $con->prepare("SELECT id, nombre, precio FROM producto WHERE id=?");
                            $sqlConsulta -> execute([$clave]);
                            $row_prod = $sqlConsulta->fetch(PDO::FETCH_ASSOC);
            
                            $precio = $row_prod['precio'];                
                            
                            $sql_insert = $con->prepare("INSERT INTO detalle_pedido (id_pedido, id_producto, nombre, cantidad) VALUES
                            (?,?,?,?)");
            
                            $sql_insert->execute([$id, $clave, $row_prod['nombre'], $cantidad]);
            
                        }
                    }
            
                    unset($_SESSION['carrito']);

                    echo '<script type="text/javascript">
                    alert("Editado de tarjeta exitoso y pedido realizado!");
                    window.location.href="../views/carritoCompra.php";
                    </script>';                
                    exit();
            
                }   
            } 
        }catch (PDOException $e){
            echo 'Falló la modificación de tarjeta: '.$e->getMessage();
            die();
        }finally{
            $editar = null;
            $bd = null;
            $con = null;
            $cons2 = null;
            $idDetalleEnvio2 = null;
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

    public function setNombreTitular(string $nombre){
        $this -> nombreTitular = $nombre;
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

    public function getNombreTitular(): string{
        return $this -> nombreTitular;
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