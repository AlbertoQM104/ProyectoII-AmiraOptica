<?php    

/* error_reporting(0); */

    if(!isset($_SESSION)){
        session_start();
    }else{
        session_destroy();
        
    } 

    require_once("../config/config.php");
    /* session_start(); */

    /* print_r($_SESSION['carrito']['productos']);    
    $json = file_get_contents('php://input');
    $datos = json_decode($json, true);

    print_r($datos); */
    /* print_r($_SESSION['DNI']); */
    /* print_r($_SESSION); */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AmiraOptic</title>

    <!--   Link de la fuente -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">    
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;700&display=swap" rel="stylesheet">


    <!-- link de la carpeta CSS -->
    <link rel="stylesheet" href="../assets/css/stylos.css">
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/encabezado.css">
    <link rel="stylesheet" href="../assets/css/pie-pagina.css">
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="../assets/css/registrar.css">
    <link rel="stylesheet" href="../assets/css/mostrarProductos.css">
    <link rel="stylesheet" href="../assets/css/detalleProducto.css">
    <link rel="stylesheet" href="../assets/css/tipoLuna.css">
    <link rel="stylesheet" href="../assets/css/tratamientoAdicional.css">
    <link rel="stylesheet" href="../assets/css/carritoCompra.css">
    <link rel="stylesheet" href="../assets/css/carritoCompra2.css">
    <link rel="stylesheet" href="../assets/css/carritoCompra3.css">
    <link rel="stylesheet" href="../assets/css/compraOnline.css">
    <link rel="stylesheet" href="../assets/css/ingresarGraduacion.css">
    <link rel="stylesheet" href="../assets/css/detalleCompra.css">
    <link rel="stylesheet" href="../assets/css/errorMensaje.css">
    <!-- <link rel="stylesheet" href="./assets/css-bootstrap/bootstrap.css">
    <link rel="stylesheet" href="./assets/css-bootstrap/bootstrap.min.css"> -->
    
    <style type="text/css"> 
        ul, ol{
            list-style: none;
        }
        

        .listaCliente1 li ul{
            display: none;
            position: absolute;     
                
        }
        

        .listaCliente1 li:hover > ul{
            display:block;
        }

        
    </style>


</head>
<body>
    <!-- Inicio de la Cabecera -->
    <header>
        <div class="header-1">        
            <div class="header-2">
                    <!-- Logo -->
                    <div class="logo-encabezado">                
                        <a href="./index.php"><img src="../img/logo.png" alt="" height="65" width="190"></a>
                    </div>
                    <!-- Input search -->

                    <!-- <form class="busqueda" role="search" action="../view/buscarProd.php" method="POST">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input class="busqueda" name="buscarProdu" type="search" placeholder="Buscar..." aria-label="Search"> 
                              
            </form> -->

                    <form action="../views/resultadoBusqueda.php" class="search-box-container" method="POST"> <!-- caja de busqueda -->
                        <label for="search-box" class="fas fa-search"></label>  
                        <input type="search" id="search-box" name="buscarProducto" placeholder="Buscar producto...">                         
                    </form>
                    
                    <!--      Menú de Items  -->
                    <div id="menu-bar" class="fas fa-bars"></div>
                        <nav class="navbar">
                            
                            <a href="../views/lentesOftalmologicos.php">Lentes oftalmológicos</a>
                            <a href="../views/lentesSol.php">Lentes sol</a>
                            <a href="../views/lentesContacto.php">Lentes de contacto</a>
                            

                            <?php if($_SESSION['usuario']==null){ ?>

                            <a href="../views/login.php" class="cuadro-login">Log in</a>

                            <?php }else{ ?>

                                <div class="listaCliente1">
                                    <ul>
                                        <li><a href="./index.php" class="cuadro-login"><?php echo $_SESSION['nombre'] ?></a>

                                            

                                                <ul style="background-color: #F9F8F8; border-radius: 15px;">
                                                    <li style="padding-top: 15px;"><a href="./compraOnline.php">Compras</a></li>
                                                    <li style="padding-top: 15px;"><a href="../model/cerrarSesion.php">Cerrar Sesión</a></li>
                                                </ul>

                                            

                                        </li>
                                    </ul>
                                </div>

                                

                            <?php } ?>

                            <div class="iconos11">
                                <a href="../views/carritoCompra.php" class="fas fa-shopping-cart carrito1"></a>
                                
                                <span id="num_cart" class="carritSpan"><?php echo $num_cart; ?></span>
                                
                            </div> 
                        </nav>
                    

            </div>
        </div>
    </header>
 

    <!-- Fin de la Cabecera -->