<div class="row">
 <div class="col-md-12">
    <div class="white-box">

        <div class="row">
            <div class="col-xs-12">
                <h1 class="text-center bg-success">Mensajes</h1>
            </div>
            <div class="col-xs-12">
                
<div>
    <ul class="nav nav-pills nav-justified">
        <li class="active"><a href="#mensajerecibidosadmin" data-toggle="tab" aria-expanded="true">Recibidos</a></li>
        <li class=""><a href="#mensajenviadoadmin" data-toggle="tab" aria-expanded="false">Enviados</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="mensajerecibidosadmin">
            <section class="section-wrap cart pt-50 pb-40">
                <div class="container relative">

                    <div class="table-wrap">
                        <table cellpadding="0" cellspacing="0" border="0" class="display table table-striped table-bordered table-condensed table-hover" id="tablamensajeadmin0" style="margin:0; width:96%">
                            <thead>
                                <tr>
                                    <!-- com_id com_precio  com_cantidad    com_creado  com_actualizado com_estado  usu_id -->
                                    <th>Identificador</th>
                                    <th>Usuario</th>
                                    <th>Imagen del usuario</th>
                                    <th>Asunto del mensaje</th>
                                    <th>Fecha del envio</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody class="cuerpo">
                                <!-- son 5 filas -->

                            </tbody>
                        </table>
                    </div>

                </div> <!-- end container -->
            </section>

        </div>

        <div class="tab-pane" id="mensajenviadoadmin">
            <section class="section-wrap cart pt-50 pb-40">
                <div class="container relative">

                    <div class="table-wrap">
                        <table cellpadding="0" cellspacing="0" border="0" class="display table table-striped table-bordered table-condensed table-hover" id="tablamensajeadmin1" style="margin:0; width:96%">
                            <thead>
                                <tr>
                                    <!-- com_id com_precio  com_cantidad    com_creado  com_actualizado com_estado  usu_id -->
                                    <th>Identificador</th>
                                    <th>Usuario</th>
                                    <th>Imagen del usuario</th>
                                    <th>Asunto del mensaje</th>
                                    <th>Fecha del envio</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody class="cuerpo">
                                <!-- son 5 filas -->

                            </tbody>
                        </table>
                    </div>

                </div> <!-- end container -->
            </section>
        </div>
    </div>
</div>

            </div>
        </div>

    </div>
</div> 
</div>





<div class="modal fade" id="detallesmensajeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Detalles del mensaje</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12" id="detallesmensajeusuario">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>






<div class="modal fade" id="enviarmensjaeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="enviarmensjaeModalForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title text-center">Responder mensaje</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12">


                                <div class="form-group">
                                    <label for="asuntomensaje" class="col-xs-12">Asunto</label>
                                    <div class="col-xs-12">
                                        <input type="text" name="asuntomensaje" id="asuntomensaje" class="form-control">
                                        <input type="hidden" name="idusuarionormal" id="idusuarionormal">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="descripcionmensaje" class="col-xs-12">Descripción</label>
                                    <div class="col-xs-12">
                                        <input type="text" id="descripcionmensaje" name="descripcionmensaje" class="form-control">
                                    </div>
                                </div>
                                <!-- <div class="container">
                                    <div class="row"> -->
                                        <div class="col-xs-12 margintop25px">
                                            <div class="form-group">
                                                <div id="fine-uploader-validation_mensaje"></div>
                                                <input type="hidden" id="mensaje_usuario" name="mensaje_usuario">
                                            </div>
                                        </div>
                                <!-- </div>
                                </div> -->


                            </div>


                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary waves-effect">Enviar</button>
                </div>
            </form>

        </div>
    </div>
</div>