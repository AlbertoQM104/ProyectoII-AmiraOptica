<?php include("./header.php"); ?>

<?php require_once("../controller/controllerProductos.php"); ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <p><h1>PRODUCTOS</h1></p> 


                    <div class="container-fluid d-flex justify-content-between">
                        <div class="col-xl-3 col-md-4 mb-4">
                                <div class="card border-left-danger shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                    PRODUCTOS POCO STOCK</div>

                                                <?php
                                                
                                                    $db = new Conexion();
                                                    $con = $db -> conecta();

                                                    try{

                                                        $query = "SELECT COUNT(*) from producto WHERE stock<10";
                                                        $mostrar = $con -> prepare($query);
                                                        $mostrar -> execute();
                                                        $pocoStock = $mostrar -> fetchColumn();

                                                ?>

                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $pocoStock; ?></div>

                                                <?php
                                                
                                                    }catch(PDOException $e){
                                                        echo 'Falló al mostrar poco stock: '.$e->getMessage();
                                                        die();
                                                    }finally{
                                                        $db = null;
                                                        $con = null;
                                                        $mostrar = null;
                                                        $pocoStock = null;
                                                    }
                                                
                                                ?>

                                            </div>
                                            <div class="col-auto">
                                                <i class="fa-solid fa-circle-exclamation fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>



                    <p><h3>Recomendación:</h3></p>
                    <p class="mb-4">Usar la columna "stock_min" y filtrar los ceros y reponer el stock de los Productos
                        que llegan al límite del stock sin reposición.</p>
                        Usar la columna de "fecha" para mantener actualizados los precios, sobre todo en temporada de campaña.
                    <br><br><br>
                    <a id="abrirProducto" class="btn btn-primary btn-icon-split btn-lg">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                        </span>
                        <span class="text">Añadir Producto</span>
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
                                      <a class="dropdown-item" href="/ExcelProductos.php">Excel</a>
                                      <a class="dropdown-item" href="/ReporteProductos.php">PDF</a>
                                    </div>
                                  </div><br>

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre producto</th>
                                            <th>Descripcion</th>                                            
                                            <th>Precio S/.</th>
                                            <th>Stock</th>                                            
                                            <th>Id_Categoría</th>
                                            <th>Imagen</th>
                                            <th>Borrar</th>
                                            <th>Modificar</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        
                                        <?php
                                            
                                            $bd2 = new Conexion;
                                            $sql = "SELECT * FROM producto";
                                            $tabla = $bd2 -> conecta() -> prepare($sql);
                                            $tabla -> execute();
                                            $resultado = $tabla -> fetchAll(PDO::FETCH_OBJ);
                                            
                                                foreach($resultado as $result){                                               
                                        ?>

                                        <tr>
                                            <td><?php echo $result->id ?></td>
                                            <td><?php echo $result->nombre ?></td>
                                            <td><?php echo $result->Descripcion ?></td>
                                            <td><?php echo $result->precio ?></td>

                                            <!-- Stock -->
                                            <td>
                                            
                                            <?php

                                            if($result->stock<10){

                                            echo "<div style='color: red;'>" . $result->stock . "</div>";
                                             
                                            }else{
                                            echo $result->stock;
                                            }

                                            ?>
                                             
                                            </td>


                                            <td><?php echo $result->id_categoria ?></td>
                                            <td><img class="img-fluid rounded mx-auto d-block" src="../img/<?php echo $result->imagen ?>" width="100"></td>
                                            
                                            <td>
                                                    <!-- Editar -->
                                                    <button type="button" class="btn btn-info editabtn" data-toggle="modal" data-target="#editar">Editar</button>
                                                    
                                            </td>
                                            
                                            <td>
                                                <!-- <form action="" method="post" > -->
                                                    <button type="button" class="btn btn-danger eliminarbtn" data-toggle="modal" data-target="#eliminarProd">Eliminar</button>
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
            <div id="productos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-gradient-primary text-white">
                            <h5 class="modal-title" id="title">Nuevo Producto</h5>
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
                                            <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre" required>
                                        </div>
                                    </div>                                   
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="descripcion">Descripción</label>
                                            <textarea id="descripcion" class="form-control" name="descripcion" placeholder="Descripción" rows="3" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="precio">Precio Normal</label>
                                            <input id="precio" class="form-control" type="text" name="precio" placeholder="Precio Normal" required>
                                        </div>
                                    </div>         
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cantidad">Cantidad</label>
                                            <input id="stock" class="form-control" type="text" name="stock" placeholder="Cantidad" required>
                                        </div>
                                    </div>                           
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="categoria">Categoria</label>
                                            <select id="categoria" class="form-control" name="categoria" required>
                                                <?php
                                                /* $categorias = mysqli_query($conexion, "SELECT * FROM productos");
                                                foreach ($categorias as $cat) {  */?>
                                                    <option value="1">Lentes Oftalmológicos</option>
                                                    <option value="2">Lentes de sol</option>
                                                    <option value="3">Lentes de contacto</option>
                                                <?php /* } */ ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="imagen">Foto</label>
                                            <input type="file" class="form-control" name="foto">
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-primary" type="submit" name="registrarProducto" id="registrarProducto">Registrar</button>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            
            
            

            <!-- Modal para editar producto -->             
            <div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-gradient-primary text-white">
                            <h5 class="modal-title" id="title">Editar Producto</h5>
                            <button class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                                <input type="hidden" name="id" id="update_id">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input id="nombreE" class="form-control" type="text" name="nombreE" placeholder="Nombre" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="descripcion">Descripción</label>
                                            <textarea id="descripcionE" class="form-control" type="text" name="descripcionE" placeholder="Descripción" rows="3" required></textarea>
                                        </div>
                                    </div>                                                                     
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="precio">Precio Normal</label>
                                            <input id="precioE" class="form-control" type="text" name="precioE" placeholder="Precio Normal" required>
                                        </div>
                                    </div>      
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cantidad">Cantidad</label>
                                            <input id="stockE" class="form-control" type="text" name="stockE" placeholder="Cantidad" required>
                                        </div>
                                    </div>                                 
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="categoria">Categoria</label>
                                            <select id="categoriaE" class="form-control" name="categoriaE" required>                                                
                                                    <option value="1">Lentes Oftalmológicos</option>
                                                    <option value="2">Lentes de sol</option>
                                                    <option value="3">Lentes de contacto</option>                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="imagen">Foto</label>
                                            <input id="imagenE" type="file" class="form-control" name="fotoE">
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-primary" type="submit" name="editarProducto" id="editarProducto">Editar</button>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para eliminar -->
            <div class="modal fade" id="eliminarProd" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                <input type="hidden" name="id" id="delete_id">
                            
                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>                            
                            <button type="submit" class="btn btn-danger" name="btnEliminar" id="btnEliminar">Eliminar</button>                                
                            
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
                    $('#nombreE').val(datos[1]);
                    $('#descripcionE').val(datos[2]);
                    $('#precioE').val(datos[3]);
                    $('#stockE').val(datos[4]);
                    $('#categoriaE').val(datos[5]);
                    $('#imagenE').val(datos[6]);
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