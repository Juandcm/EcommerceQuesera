<div class="col-sm-12">
    <div class="box-ft box-ft-5">
        <!-- Page Title -->
        <section class="page-title text-center">
            <div class="container">
                <h1 class=" heading page-title__title">Compras realizadas de tus carritos</h1>
            </div>
            

            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4 text-center">
                    <!-- small box -->
                    <a href="/Controlador/mostrarPdfControler.php?op=mostrarcomprasusuario" target="_blank">
                        <div class="atb-3d-d atb-large atb-round atb-success">
                            <div class="inner text-center">
                                <h1>Descargar</h1>
                                <h6>Todas las compras realizadas</h6>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </section>






        <!-- Cart -->
        <section class="section-wrap cart pt-50 pb-40">
            <div class="container relative">

                <div class="table-wrap">
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-striped table-bordered table-condensed table-hover" id="tablaprocesarcompras" style="margin:0; width:96%">
                        <thead>
                            <tr>
                                <!-- com_id	com_precio	com_cantidad	com_creado	com_actualizado	com_estado	usu_id -->
                                <th>Precio de la compra</th>
                                <th>Cantidad de productos</th>
                                <th>Fecha de la compra</th>
                                <th>Estado</th>
                                <th>Ajustes</th>
                            </tr>
                        </thead>
                        <tbody class="cuerpo">
                            <!-- son 5 filas -->

                        </tbody>
                    </table>
                </div>

            </div> <!-- end container -->
        </section>
        <!-- end cart -->
    </div>
</div>

<!-- Modal de las compras -->

<div class="modal fade" id="detallescompraModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Detalles de la compra</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12" id="contenidodetallescompra">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal para procesar la compra -->
<div class="modal fade" id="procesarcompraModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="procesarpagoForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Procesar la compra</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12" id="procesarcompra">


                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-xs-12">

                                            <div class="form-group">
                                                <label for="selectbanco" class="col-xs-12">Selecciona el banco</label>
                                                <div class="col-xs-12">
                                                    <select name="selectbanco" id="selectbanco" class="form-control" placeholder="selecciona">
                                                    </select>
                                                    <input type="hidden" name="idcompra" id="idcompra">
                                                    <input type="hidden" name="idbancousuario" id="idbancousuario">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="referencia" class="col-xs-12">Ingresa la referencia de la transferencia</label>
                                                <div class="col-xs-12">
                                                    <input name="referencia" id="referencia" class="form-control" value="" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group" id="mostrabancoadmin">
                                            </div>
                                            <div class="form-group">
                                                <div id="fine-uploader-validation_transferencia"></div>
                                                <input type="hidden" id="transferencia_usuario" name="transferencia_usuario">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- selectbanco referencia -->

                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>

                    <button type="submit" class="btn btn-default btn-outline">Procesar pago de la compra</button>
                </div>

            </form>

        </div>
    </div>
</div>