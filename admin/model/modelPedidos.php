<?php

require_once("../library/conexion.php");

class modelPedidos{

    private $id;
    private $fecha;
    private $total;
    private $estado;
    private $id_cliente;
    private $id_usuario;

    public function __construct(){}

    public function editarPedido($id, $estado){

        $bd = new Conexion; 

        try{

            $consulta = "UPDATE pedido SET estado=? WHERE pedido.id=?";

            $editar = $bd -> conecta() -> prepare($consulta);            
            $editar -> execute([$estado, $id]);

            
            
            echo '<script type="text/javascript">
                  alert("Estado de pedido actualizado con éxito!");
                  window.location.href="../view/Pedidos.php";
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

    public function setId(string $id){
        $this -> id = $id;
    }

    public function setEstado(string $estado){
        $this -> estado = $estado;
    }

    public function getEstado(): string{
        return $this -> estado;
    }

    public function getId(): string{
        return $this -> id;
    }



}






?>