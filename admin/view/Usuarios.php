<?php include("./header.php"); ?>

<?php require_once("../controller/controllerCliente.php"); ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- CABECERAS RESUMEN  -->
                    <B><h1 class="h3 mb-2 text-gray-800">USUARIOS</h1></B><BR>
                    <p class="mb-4">Registrar la medida del cliente usando la columna "#Doc" <a target="_blank"
                    </a>.</p> 
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-left">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            NUEVOS REGISTROS</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">430</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <!-- <a href="#" class="btn btn-primary btn-icon-split btn-lg">
                            <span class="icon text-white-50">
                                <i class="fa fa-user-plus" aria-hidden="true"></i>
                            </span>
                            <span class="text">Añadir Usuarios</span>
                        </a> -->
                    </div>

                    <!-- TABLA DE DATOS -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">REGISTRO DE USUARIOS</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Correo</th>
                                            <th>Contraseña</th>
                                            <th>DNI</th>                                                                                       
                                            <th>ID_Medida</th>
                                            <th>Esfera derecho</th>
                                            <th>Cilindro derecho</th>
                                            <th>Eje derecho</th>
                                            <th>Esfera izquierda</th>
                                            <th>Cilindro izquierdo</th>
                                            <th>Eje izquierdo</th>                                            
                                            <th>Distancia Interpupilar</th>
                                            <th>ID_Cliente</th>
                                            <!-- <th>Modificar</th>
                                            <th>Eliminar</th> -->

                                        </tr>
                                    </thead>
                                    
                                    <tbody>

                                        <?php
                                            
                                            $bd2 = new Conexion;
                                            $sql = "SELECT * 
                                                    FROM cliente tabla1 
                                                    inner join medidas tabla2 on (tabla1.id = tabla2.id_cliente)";
                                            $tabla = $bd2 -> conecta() -> prepare($sql);
                                            $tabla -> execute();
                                            $resultado = $tabla -> fetchAll(PDO::FETCH_OBJ);
                                            
                                                foreach($resultado as $result){                                               
                                        ?>

                                        <tr>
                                            <td><?php echo $result -> id ?></td>
                                            <td><?php echo $result -> nombres ?></td>
                                            <td><?php echo $result -> apellidos ?></td>
                                            <td><?php echo $result -> correo ?></td>
                                            <td><?php echo $result -> contraseña ?></td>
                                            <td><?php echo $result -> dni ?></td>
                                            <td><?php echo $result -> id ?></td>
                                            <td><?php echo $result -> ld_esfera ?></td>
                                            <td><?php echo $result -> ld_cilindro ?></td>
                                            <td><?php echo $result -> ld_eje ?></td>
                                            <td><?php echo $result -> li_esfera ?></td>
                                            <td><?php echo $result -> li_cilindro ?></td>
                                            <td><?php echo $result -> li_eje ?></td>
                                            <td><?php echo $result -> DistanciaInterpupilar ?></td>
                                            <td><?php echo $result -> id_cliente ?></td>
                                            
                                            <!-- <td><a><button class="btn btn-info">Editar</button></a></td>
                                            <td><button class="btn btn-danger eliminar"id="785">Eliminar</button> </td> -->
                                        </tr>

                                        <?php } ?>
                                                                             
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php require_once("./footer.php"); ?>