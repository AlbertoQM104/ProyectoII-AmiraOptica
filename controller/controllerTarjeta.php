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

        if($datosT){ //Si existe

            //Objeto
            $tarjeta = new modelRegisTarjetayPago;

            //Guardar en el objeto
            $tarjeta -> setId_Pedido($_POST['ldEsfera']);
            $tarjeta -> setLd_cilindro($_POST['ldCilindro']);
            $tarjeta -> setLd_eje($_POST['ldEje']);
            $tarjeta -> setLi_esfera($_POST['liEsfera']);
            $tarjeta -> setLi_cilindro($_POST['liCilindro']);
            $tarjeta -> setLi_eje($_POST['liEje']);
            $tarjeta -> setDistInterpupi($_POST['distanInterp']);
            $tarjeta -> setId_cliente($_SESSION['idCliente']);
            
            //Guardar en nuevas variables
            $LDEsfera = $medida -> getLd_esfera();
            $LDCilindro = $medida -> getLd_cilindro();
            $LDEje = $medida -> getLd_eje();
            $LIEsfera = $medida -> getLi_esfera();
            $LICilindro = $medida -> getLi_cilindro();
            $LIEje = $medida -> getLi_eje();
            $DistanciaInterpupilar = $medida -> getDistInterpupi();
            $IDCliente = $medida -> getId_cliente();

            /* Método para actualizar */
            $medida -> editarMedida($LDEsfera, $LDCilindro, $LDEje, $LIEsfera, $LICilindro, $LIEje, $DistanciaInterpupilar, $IDCliente);


        }else{ //Si aún no existe

            //Objeto
            $medida = new modelMedida;

            //Guardar en el objeto
            $medida -> setLd_esfera($_POST['ldEsfera']);
            $medida -> setLd_cilindro($_POST['ldCilindro']);
            $medida -> setLd_eje($_POST['ldEje']);
            $medida -> setLi_esfera($_POST['liEsfera']);
            $medida -> setLi_cilindro($_POST['liCilindro']);
            $medida -> setLi_eje($_POST['liEje']);
            $medida -> setDistInterpupi($_POST['distanInterp']);
            $medida -> setId_cliente($_SESSION['idCliente']);
            
            //Guardar en nuevas variables
            $LDEsfera = $medida -> getLd_esfera();
            $LDCilindro = $medida -> getLd_cilindro();
            $LDEje = $medida -> getLd_eje();
            $LIEsfera = $medida -> getLi_esfera();
            $LICilindro = $medida -> getLi_cilindro();
            $LIEje = $medida -> getLi_eje();
            $DistanciaInterpupilar = $medida -> getDistInterpupi();
            $IDCliente = $medida -> getId_cliente();

            /* Método para insertar */
            $medida -> insertarMedida($LDEsfera, $LDCilindro, $LDEje, $LIEsfera, $LICilindro, $LIEje, $DistanciaInterpupilar, $IDCliente);
            
        }

    }catch (PDOException $e){
        echo 'Falló el registro de las medidas: '.$e->getMessage();
        die();
    }finally{
        $medida = null;
        $db = null;
        $con = null;
    }

}




?>