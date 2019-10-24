<div class="modal fade user-editar-modal" id="usereditarModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="usereditarModalForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center">Editar usuario</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12">

                                <div class="form-group">
                                    <label for="user_editar" class="col-xs-12">Nombre</label>
                                    <div class="col-xs-12">
                                        <input type="text" name="user_editar" id="user_editar" class="form-control" value="<?= $nombre ?>">
                                        <input type="hidden" name="idusuarioadmin" id="idusuarioadmin">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user_email_editar" class="col-xs-12">Correo</label>
                                    <div class="col-xs-12">
                                        <input type="email" id="user_email_editar" name="user_email_editar" class="form-control" value="<?= $email ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user_telefono_editar" class="col-xs-12">Telefono</label>
                                    <div class="col-xs-12">
                                        <input type="text" id="user_telefono_editar" name="user_telefono_editar" class="form-control" value="<?= $telefono ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user_password_editar" class="col-xs-12">Contraseña</label>
                                    <div class="col-xs-12">
                                        <input type="password" id="user_password_editar" name="user_password_editar" class="form-control" placeholder="Contraseña">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cuser_password_editar" class="col-xs-12">Reingrese la contraseña</label>
                                    <div class="col-xs-12">
                                        <input type="password" id="cuser_password_editar" name="cuser_password_editar" class="form-control" placeholder="Reingrese la contraseña">
                                    </div>
                                </div>
                                
                                <!-- <div class="container">
                                    <div class="row"> -->
                                        <div class="col-xs-12 margintop25px">
                                            <div class="form-group">
                                                <div id="fine-uploader-validation_foto"></div>
                                                <input type="hidden" id="foto_usuario" name="foto_usuario">
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
        <!-- /.modal-content -->
    </div>


</div>