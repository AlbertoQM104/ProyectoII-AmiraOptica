<?php

include_once("../model/modelDetalleCompra.php");

if(isset($_POST['registrarDetallesCompra'])){

    $db = new Conexion();
    $con = $db->conecta();

    //Primero se consulta si existe usuario con detalle de envío
    $consultaD = "SELECT * FROM detalle_envio WHERE id_cliente = ?";
    $deta = $con -> prepare($consultaD);
    $deta -> execute([$_SESSION['idCliente']]);
    $datosD = $deta -> fetch(PDO::FETCH_OBJ);

    try{

        if($datosD){ //Si existe

            //Objeto
            $detalle = new modelDetalleCompra;

            //Guardar en el objeto            
            $detalle -> setDireccion1($_POST['primeraDireccion']);
            $detalle -> setDireccion2($_POST['segundaDireccion']);
            $detalle -> setNombres($_POST['firstname']);
            $detalle -> setApellidos($_POST['firstSurname']);
            $detalle -> setProvincia($_POST['provinciaG']);
            $detalle -> setDistrito($_POST['distritoG']);
            $detalle -> setDepartamento($_POST['departamentoG']);
            $detalle -> setCelular($_POST['celularG']);
            $detalle -> setDniRecoge($_SESSION['DNI']);
            $detalle -> setIdCliente($_SESSION['idCliente']);
            
            //Guardar en nuevas variables            
            $direccion1 = $detalle -> getDireccion1();
            $direccion2 = $detalle -> getDireccion2();
            $nombre = $detalle -> getNombres();
            $apellido = $detalle -> getApellidos();
            $provincia = $detalle -> getProvincia();
            $distrito = $detalle -> getDistrito();
            $departamento = $detalle -> getDepartamento();
            $celular = $detalle -> getCelular();
            $dni = $detalle -> getDNI();
            $idCliente = $detalle -> getIdCliente();
            

            /* Método para actualizar */
            $detalle -> editarDetalleCompra($direccion1, $direccion2, $nombre, $apellido, $provincia, $distrito, $departamento, $celular, $dni, $idCliente);


        }else{ //Si aún no existe

            //Objeto
            $detalle = new modelDetalleCompra;

            //Guardar en el objeto            
            $detalle -> setDireccion1($_POST['primeraDireccion']);
            $detalle -> setDireccion2($_POST['segundaDireccion']);
            $detalle -> setNombres($_POST['firstname']);
            $detalle -> setApellidos($_POST['firstSurname']);
            $detalle -> setProvincia($_POST['provinciaG']);
            $detalle -> setDistrito($_POST['distritoG']);
            $detalle -> setDepartamento($_POST['departamentoG']);
            $detalle -> setCelular($_POST['celularG']);
            $detalle -> setDniRecoge($_SESSION['DNI']);
            $detalle -> setIdCliente($_SESSION['idCliente']);
            
            //Guardar en nuevas variables            
            $direccion1 = $detalle -> getDireccion1();
            $direccion2 = $detalle -> getDireccion2();
            $nombre = $detalle -> getNombres();
            $apellido = $detalle -> getApellidos();
            $provincia = $detalle -> getProvincia();
            $distrito = $detalle -> getDistrito();
            $departamento = $detalle -> getDepartamento();
            $celular = $detalle -> getCelular();
            $dni = $detalle -> getDNI();
            $idCliente = $detalle -> getIdCliente();

            /* Método para insertar */
            $detalle -> insertarDetalleCompra($direccion1, $direccion2, $nombre, $apellido, $provincia, $distrito, $departamento, $celular, $dni, $idCliente);
            
        }

    }catch (PDOException $e){
        echo 'Falló el registro del detalle de envío: '.$e->getMessage();
        die();
    }finally{
        $deta = null;
        $db = null;
        $con = null;
    }

}




?>