<?php 

require_once("../model/modelRegisTarjetayPago.php");

if(isset($_POST['registrarTarjetaT'])){

    $db = new  Conexion();
    $con = $db->conecta();

    //Primero se consulta si existe usuario con tarjeta
    $consultaM = "SELECT * FROM detalle_pago WHERE id_cliente = ?";
    $tarje = $con -> prepare($consultaM);
    $tarje -> execute([$_SESSION['idCliente']]);
    $datosT = $tarje -> fetch(PDO::FETCH_OBJ);

    try{

        $fechaA = date('Y-m-d');

        if($datosT){ //Si existe

            //Objeto
            $tarjeta = new modelRegisTarjetayPago;

            //Guardar en el objeto            
            $tarjeta -> setId_metodoPago($_REQUEST['radioTipoPago']);
            $tarjeta -> setNombreTitular($_POST['duenoTarjet']);
            $tarjeta -> setNum_cuenta($_POST['nroCredito']);
            $tarjeta -> setCcv($_POST['nroCV']);
            $tarjeta -> setVencimientoMes($_POST['capturaMesT']);
            $tarjeta -> setVencimientoAnio($_POST['capturaAnioT']);
            $tarjeta -> setId_cliente($_SESSION['idCliente']);            
            
            //Guardar en nuevas variables            
            $metodoPago = $tarjeta -> getId_metodoPago();
            $nom = $tarjeta -> getNombreTitular();
            $nroCredito = $tarjeta -> getNum_cuenta();
            $nroCv = $tarjeta -> getCcv();
            $mesT = $tarjeta -> getVencimientoMes();
            $anioT = $tarjeta -> getVencimientoAnio();
            $idCliente = $tarjeta -> getId_cliente();

            /* Método para insertar */
            $tarjeta -> editarTarjeta($metodoPago, $nom, $nroCredito, $nroCv, $mesT, $anioT, $idCliente, $fechaA, $total);


        }else{ //Si aún no existe            

            //Objeto
            $tarjeta = new modelRegisTarjetayPago;

            //Guardar en el objeto            
            $tarjeta -> setId_metodoPago($_REQUEST['radioTipoPago']);
            $tarjeta -> setNombreTitular($_POST['duenoTarjet']);
            $tarjeta -> setNum_cuenta($_POST['nroCredito']);
            $tarjeta -> setCcv($_POST['nroCV']);
            $tarjeta -> setVencimientoMes($_POST['capturaMesT']);
            $tarjeta -> setVencimientoAnio($_POST['capturaAnioT']);
            $tarjeta -> setId_cliente($_SESSION['idCliente']);            
            
            //Guardar en nuevas variables            
            $metodoPago = $tarjeta -> getId_metodoPago();
            $nom = $tarjeta -> getNombreTitular();
            $nroCredito = $tarjeta -> getNum_cuenta();
            $nroCv = $tarjeta -> getCcv();
            $mesT = $tarjeta -> getVencimientoMes();
            $anioT = $tarjeta -> getVencimientoAnio();
            $idCliente = $tarjeta -> getId_cliente();

            /* Fecha */
            


            /* Método para actualizar */
            $tarjeta -> insertarTarjeta($metodoPago, $nom, $nroCredito, $nroCv, $mesT, $anioT, $idCliente, $fechaA, $total);
            
        }

    }catch (PDOException $e){
        echo 'Falló el registro de la tarjeta: '.$e->getMessage();
        die();
    }finally{
        $medida = null;
        $db = null;
        $con = null;
    }

}




?>