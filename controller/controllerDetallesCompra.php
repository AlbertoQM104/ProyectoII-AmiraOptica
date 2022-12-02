<?php

include_once("../model/modelDetalleCompra.php");

if(isset($_POST['registrarDetallesCompra'])){

    $db = new  Conexion();
    $con = $db->conecta();

    //Primero se consulta si existe usuario con detalle de envío
    $consultaD = "SELECT * FROM detalle_envio WHERE id_cliente = ?";
    $medi = $con -> prepare($consultaD);
    $medi -> execute([$_SESSION['idCliente']]);
    $datosD = $medi -> fetch(PDO::FETCH_OBJ);

    try{

        if($datosD){ //Si existe

            //Objeto
            $detalle = new modelDetalleCompra;

            //Guardar en el objeto
            $detalle -> setIdMetodoEnvio($_POST['metodoEnvio']);
            $detalle -> setDireccion1($_POST['primeraDireccion']);
            $detalle -> setDireccion2($_POST['segundaDireccion']);
            $detalle -> setNombres($_POST['firstname']);
            $detalle -> setApellidos($_POST['firstSurname']);
            $detalle -> setProvincia($_POST['provinciaG']);
            $detalle -> setDistrito($_POST['distritoG']);
            $detalle -> setDepartamento($_SESSION['departamentoG']);
            $detalle -> setCelular($_SESSION['celularG']);
            $detalle -> setDniRecoge($_SESSION['DNI']);
            $detalle -> setIdCliente($_SESSION['idCliente']);
            
            //Guardar en nuevas variables
            $metodo = $medida -> getLd_esfera();
            $direccion1 = $medida -> getLd_cilindro();
            $direccion2 = $medida -> getLd_eje();
            $nombre = $medida -> getLi_esfera();
            $apellido = $medida -> getLi_cilindro();
            $provincia = $medida -> getLi_eje();
            $distrito = $medida -> getDistInterpupi();
            $departamento = $medida -> getId_cliente();
            $celular = $medida -> getId_cliente();
            $dni = $medida -> getId_cliente();
            $idCliente = $medida -> getId_cliente();
            

            /* Método para actualizar */
            $medida -> editarDetalleCompra($LDEsfera, $LDCilindro, $LDEje, $LIEsfera, $LICilindro, $LIEje, $DistanciaInterpupilar, $IDCliente);


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