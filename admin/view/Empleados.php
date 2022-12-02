<?php include("./header.php"); ?>

<?php require_once("../controller/controllerUsuarioSistema.php"); ?>
            <!-- Begin Page Content -->
            <div class="container-fluid">
                    <p><h1>Usuarios del Sistema</h1></p> 
                    <p><h3>Recomendación:</h3></p>
                    <!-- <p class="mb-4">Usar la columna "stock_min" y filtrar los ceros y reponer el stock de los Productos
                        que llegan al límite del stock sin reposición.</p>
                        Usar la columna de "fecha" para mantener actualizados los precios, sobre todo en temporada de campaña.
                    <br><br><br> -->
                    <a id="abrirEmpleado" class="btn btn-primary btn-icon-split btn-lg">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                        </span>
                        <span class="text">Añadir Usuario al Sistema</span>
                    </a>

                    <br><br><br>
                    <!-- TABLA DE DATOS -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DETALLE DE PRODUCTOS</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="dropdown show">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Exportar Data
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                      <a class="dropdown-item" href="#">Excel</a>
                                      <a class="dropdown-item" href="#">PDF</a>
                                    </div>
                                  </div><br>

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>                                            
                                            <th>Correo</th>
                                            <th>Contraseña</th>                                            
                                            <th>DNI</th>
                                            <th>Celular</th>
                                            <th>Dirección</th>
                                            <th>Rol</th>
                                            <th>Modificar</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        
                                        <?php
                                            
                                            $bd2 = new Conexion;
                                            $sql = "SELECT * FROM usuario";
                                            $tabla = $bd2 -> conecta() -> prepare($sql);
                                            $tabla -> execute();
                                            $resultado = $tabla -> fetchAll(PDO::FETCH_OBJ);
                                            
                                                foreach($resultado as $result){                                               
                                        ?>

                                        <tr>
                                            <td><?php echo $result->id ?></td>
                                            <td><?php echo $result->nombres ?></td>
                                            <td><?php echo $result->apellidos ?></td>
                                            <td><?php echo $result->correo ?></td>
                                            <td><?php echo $result->contraseña ?></td>
                                            <td><?php echo $result->dni ?></td>
                                            <td><?php echo $result->celular ?></td>
                                            <td><?php echo $result->direccion ?></td>                                            
                                            <td><?php echo $result->rol ?></td>                                            
                                            
                                            <td>
                                                    <!-- Editar -->
                                                    <button type="button" class="btn btn-info editabtn" data-toggle="modal" data-target="#editarUser">Editar</button>
                                                    
                                            </td>
                                            
                                            <td>
                                                <!-- <form action="" method="post" > -->
                                                    <button type="button" class="btn btn-danger eliminarbtn" data-toggle="modal" data-target="#eliminarUser">Eliminar</button>
                                                <!-- </form> -->
                                                
                                            </td>
                                                    
                                        </tr>
                                        
                                        <?php 
                                    
                                                }
                                            ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Modal para añadir productos -->
            <div id="empleados" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-gradient-primary text-white">
                            <h5 class="modal-title" id="title">Nuevo Usuario del Sistema</h5>
                            <button class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input id="nombres" class="form-control" type="text" name="nombres" placeholder="Nombres" required>
                                        </div>
                                    </div>                                   
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="apellidos">Apellidos</label>
                                            <input id="apellidos" class="form-control" name="apellidos" placeholder="Apellidos" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="correo">Correo</label>
                                            <input id="correo" class="form-control" type="text" name="correo" placeholder="Correo" required>
                                        </div>
                                    </div>         
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contrasena">Contraseña</label>
                                            <input id="contrasena" class="form-control" type="password" name="contrasena" placeholder="Contraseña" required>
                                        </div>
                                    </div>                           
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dni">DNI</label>
                                            <input id="dni" class="form-control" type="text" name="dni" placeholder="DNI" minlength="8" maxlength="8" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="celular">Celular</label>
                                            <input id="celular" class="form-control" type="text" name="celular" placeholder="Celular" minlength="9" maxlength="9" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="direccion">Dirección</label>
                                            <input id="direccion" class="form-control" type="text" name="direccion" placeholder="Dirección" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="rol">Rol</label>
                                            <select name="rol" id="rol" class="form-control" required>
                                                <option value="Usuario">Usuario</option>
                                                <option value="Administrador">Administrador</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> <br>

                                <button class="btn btn-primary" type="submit" name="registrarUsuario" id="registrarUsuario">Registrar Usuario</button>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para editar producto -->             
            <div class="modal fade" id="editarUser" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-gradient-primary text-white">
                            <h5 class="modal-title" id="title">Editar Producto</h5>
                            <button class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                                <input type="hidden" name="id" id="update_id">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input id="nombresE" class="form-control" type="text" name="nombresE" placeholder="Nombres" required>
                                        </div>
                                    </div>                                   
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="descripcion">Apellidos</label>
                                            <input id="apellidosE" class="form-control" name="apellidosE" placeholder="Apellidos" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="precio">Correo</label>
                                            <input id="correoE" class="form-control" type="text" name="correoE" placeholder="Correo" required>
                                        </div>
                                    </div>         
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cantidad">Contraseña</label>
                                            <input id="contrasenaE" class="form-control" type="password" name="contrasenaE" placeholder="Contraseña" required>
                                        </div>
                                    </div>                           
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="categoria">DNI</label>
                                            <input id="dniE" class="form-control" type="text" name="dniE" placeholder="DNI" minlength="8" maxlength="8" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="imagen">Celular</label>
                                            <input id="celularE" class="form-control" type="text" name="celularE" placeholder="Celular" minlength="9" maxlength="9" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="imagen">Dirección</label>
                                            <input id="direccionE" class="form-control" type="text" name="direccionE" placeholder="Dirección" required>
                                        </div>
                                    </div>
                                
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="rolE">Rol</label>
                                            <select name="rolE" id="rolE" class="form-control" required>
                                                <option value="Usuario">Usuario</option>
                                                <option value="Administrador">Administrador</option>
                                            </select>
                                        </div>
                                    </div>

                                </div><br>

                                <button class="btn btn-primary" type="submit" name="editarUsuario" id="editarUsuario">Editar Usuario</button>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para eliminar -->
            <div class="modal fade" id="eliminarUser" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header bg-gradient-primary text-white">
                            <h5 class="modal-title" id="title">Eliminar producto</h5>
                            <button class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="text-dark">¿Realmente desea eliminar este producto?</p>
                            <!-- Formulario Eliminar -->
                            <form action="" method="POST" enctype="multipart/form-data">
                                <input type="text" name="id" id="delete_id">
                            
                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>                            
                            <button type="submit" class="btn btn-danger" name="eliminarUsuario" id="eliminarUsuario">Eliminar</button>                                
                            
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <!-- Script para capturar datos para editar producto -->
            <script>                
                $('.editabtn').on('click', function(){

                    $tr=$(this).closest('tr');
                    var datos = $tr.children("td").map(function(){
                        return $(this).text();
                    });
                    $('#update_id').val(datos[0]);
                    $('#nombresE').val(datos[1]);
                    $('#apellidosE').val(datos[2]);
                    $('#correoE').val(datos[3]);
                    $('#contrasenaE').val(datos[4]);
                    $('#dniE').val(datos[5]);
                    $('#celularE').val(datos[6]);
                    $('#direccionE').val(datos[7]);
                    $('#rolE').val(datos[8]);
                });
            </script>

            <!-- Script para eliminar -->
            <script>                
                $('.eliminarbtn').on('click', function(){

                    $tr=$(this).closest('tr');
                    var datos = $tr.children("td").map(function(){
                        return $(this).text();
                    });
                    $('#delete_id').val(datos[0]);                    
                });
            </script>

<?php require_once("./footer.php"); ?>