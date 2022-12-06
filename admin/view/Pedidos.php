<?php include("./header.php"); ?>

<?php require_once("../controller/controllerPedidos.php"); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- CABECERAS RESUMEN  -->
                    <h1 class="h3 mb-2 text-gray-800">PEDIDOS</h1>
                    
                    <div class="container-fluid d-flex justify-content-between">

                        <div class="col-xl-3 col-md-4 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-left">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                NUEVOS PEDIDOS</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">430</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-4 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                PEDIDOS PENDIENTES</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">76</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    

                        <div class="col-xl-3 col-md-4 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-right">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                DELIVERY</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> -->

                    <!-- TABLA DE DATOS -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DETALLE DE PEDIDOS</h6>
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
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Fecha</th>
                                            <th>Total</th>
                                            <th>Estado</th>
                                            <th>ID_Cliente</th>                                            
                                            <th>Modificar</th>
                                            
                                            
                                        </tr>
                                    </thead>                                    
                                    <tbody>

                                    <?php
                                     $bd = new Conexion;
                                     $sql = "SELECT * FROM pedido";
                                     $tabla = $bd -> conecta() -> prepare($sql);
                                     $tabla -> execute();
                                     $resultado = $tabla -> fetchAll(PDO::FETCH_OBJ);

                                     try{
                                     
                                         foreach($resultado as $result){   
                                      ?>

                                        <tr>
                                            <td><?php echo $result -> id ?></td>
                                            <td><?php echo $result -> fecha ?></td>
                                            <td><?php echo $result -> total ?></td>
                                            <td><?php echo $result -> estado ?></td>
                                            <td><?php echo $result -> id_Cliente ?></td>                                                                                     
                                            <td>
                                                <button type="button" class="btn btn-info editabtn" data-toggle="modal" data-target="#editarP">Editar</button>
                                            </td>
                                        </tr>
                                        
                                    <?php } 
                                    
                                         }catch(PDOException $e){
                                            echo 'Falló el listado de pedidos: '.$e->getMessage();
                                            die();
                                         }finally{
                                            $bd = null;
                                            $tabla = null;
                                            $resultado = null;
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

            <!-- Modal para editar pedido -->             
            <div class="modal fade" id="editarP" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-gradient-primary text-white">
                            <h5 class="modal-title" id="title">Editar Estado Pedido</h5>
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
                                            <label for="categoria">Categoria</label>
                                            <select id="estadoPedido" class="form-control" name="estadoPedido" required>                                                
                                                    <option value="RECIBIDO">RECIBIDO</option>
                                                    <option value="PREPARANDO">PREPARANDO</option>
                                                    <option value="EN RUTA">EN RUTA</option>
                                                    <option value="LISTO PARA RECOJO">LISTO PARA RECOJO</option>
                                                    <option value="ENTREGADO">ENTREGADO</option>                                                
                                            </select>
                                        </div>
                                    </div>                                 
                                </div>

                                <button class="btn btn-primary" type="submit" name="editarPedido" id="editarPedido">Editar</button>
                                
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
                    $('#estadoPedido').val(datos[3]);                    
                });
            </script>

           
<?php require_once("./footer.php"); ?>