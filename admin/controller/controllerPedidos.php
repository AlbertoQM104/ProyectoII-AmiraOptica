<?php

include_once("../model/modelPedidos.php");

if(isset($_POST['editarPedido'])){

    //Instanciar objeto
    $editarEstado = new modelPedidos;

    //Almacenar en objeto
    $editarEstado -> setId($_POST['id']);
    $editarEstado -> setEstado($_POST['estadoPedido']);
    

    //Almacenar en nuevas variables
    $idP = $editarEstado -> getId();
    $estad = $editarEstado -> getEstado();

    //Usar método para actualizar estado
    $editarEstado -> editarPedido($idP, $estad);
}






?>