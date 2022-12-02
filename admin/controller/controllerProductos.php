<?php
    include("../model/modelProductos.php");

    /* Añadir producto */
    if(isset($_POST['registrarProducto'])){

        $img = $_FILES['foto'];
        $name = $img['name'];
        $tmpname = $img['tmp_name'];
        $fecha = date("YmdHis");
        $foto = $fecha . ".jpg";
        $destino = "../img/" . $foto;

        //Instanciar objeto Registrar y Almacenar en el objeto registrarProd los valores
        $registrarProd = new modelProductos($_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['stock'], $_POST['categoria'], $foto);

        //Guardar en nuevas variables
        $nombreP = $registrarProd->getNombre();
        $descripcionP = $registrarProd->getDescripcion();
        $precioP = $registrarProd->getPrecio();
        $stockP = $registrarProd->getStock();
        $idCat = $registrarProd->getIDCategoria();
        $imagenP = $registrarProd->getImagen();

        move_uploaded_file($tmpname, $destino);

        //Usar el método para almacenar productos
        if($imagenP != null){
            $registrarProd->insertar($nombreP, $descripcionP, $precioP, $stockP, $idCat, $imagenP);  
        }else{
            $registrarProd->insertar($nombreP, $descripcionP, $precioP, $stockP, $idCat, null);  
        }
          

    }

    /* Editar producto */
    if(isset($_POST['editarProducto'])){

        $img = $_FILES['fotoE'];
        $name = $img['nameE'];
        $tmpname = $img['tmp_name'];
        $fecha = date("YmdHis");
        $foto = $fecha . ".jpg";
        $destino = "../img/" . $foto;

       //Instanciar objeto editarProd y Almacenar en el objeto registrarProd los valores       
       $editarProd = new modelProductos($_POST['nombreE'], $_POST['descripcionE'], $_POST['precioE'], $_POST['stockE'], $_POST['categoriaE'], $foto);  
       $editarProd -> setId($_POST['id']);
        
        //Guardar en nuevas variables
        $idE = $editarProd -> getId();
        $nombreE = $editarProd->getNombre();
        $descripcionE = $editarProd->getDescripcion();
        $precioE = $editarProd->getPrecio();
        $stockE = $editarProd->getStock();
        $idCatE = $editarProd->getIDCategoria();
        $imagenE = $editarProd->getImagen();

        //Usar el método para actualizar productos
        if($imagenE != null){
            $editarProd->editar($idE, $nombreE, $descripcionE, $precioE, $stockE, $idCatE, $imagenE);
        }else{
            $editarProd->editar($idE, $nombreE, $descripcionE, $precioE, $stockE, $idCatE, null);
        }
    }


    /* Eliminar producto */
    if(isset($_POST['btnEliminar'])){
        echo 'hola';

        /* Instanciar objeto  eliminarProd*/
        $eliminarProd = new modelProductos(null, null, null, null, null, null);
        $eliminarProd -> setId($_POST['id']);

        //Guardar en una nueva variable
        $id = $eliminarProd -> getId();

        /* Usar método para eliminar producto*/
        $eliminarProd -> eliminar($id);
    }
?>