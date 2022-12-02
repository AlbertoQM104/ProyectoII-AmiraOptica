<?php include("./header.php"); ?>



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
                                            <th>Nombre producto</th>
                                            <th>Cantidad</th>
                                            <th>#Pedido</th>
                                            <th>Precio</th>
                                            <th>Fecha</th>
                                            <th>ID</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nombre producto</th>
                                            <th>Cantidad</th>
                                            <th>#Pedido</th>
                                            <th>Precio</th>
                                            <th>Fecha</th>
                                            <th>ID</th>
                                            <th>Status</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <td>Lente código 0001</td>
                                            <td>143</td>
                                            <td>1233</td>
                                            <td>S/.199.90</td>
                                            <td>2022/11/20</td>
                                            <td>39842</td>
                                            <td>Cancelado</td>
                                        </tr>
                                        <tr>
                                            <td>Lente código 0001</td>
                                            <td>143</td>
                                            <td>1233</td>
                                            <td>S/.199.90</td>
                                            <td>2022/11/20</td>
                                            <td>39842</td>
                                            <td>Pendiente Pago</td>
                                        </tr>
                                        <tr>
                                            <td>Lente código 0001</td>
                                            <td>143</td>
                                            <td>1233</td>
                                            <td>S/.199.90</td>
                                            <td>2022/11/20</td>
                                            <td>39842</td>
                                            <td>Delivery</td>
                                        </tr>
                                        <tr>
                                            <td>Lente código 0001</td>
                                            <td>143</td>
                                            <td>1233</td>
                                            <td>S/.199.90</td>
                                            <td>2022/11/20</td>
                                            <td>39842</td>
                                            <td>Cancelado</td>
                                        </tr>
                                        <tr>
                                            <td>Lente código 0001</td>
                                            <td>143</td>
                                            <td>1233</td>
                                            <td>S/.199.90</td>
                                            <td>2022/11/20</td>
                                            <td>39842</td>
                                            <td>Delivery</td>
                                        </tr>
                                        <tr>
                                            <td>Lente código 0001</td>
                                            <td>143</td>
                                            <td>1233</td>
                                            <td>S/.199.90</td>
                                            <td>2022/11/20</td>
                                            <td>39842</td>
                                            <td>Cancelado</td>
                                        </tr>

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