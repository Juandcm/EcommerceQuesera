<div class="modal fade user-register-modal" id="userregisterModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="userregisterModalForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Registrar cuenta</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user_login" class="col-xs-12">Nombre</label>
                        <div class="col-xs-12">
                            <input type="text" name="user_login" id="user_login" class="form-control" placeholder="Nombre">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_email" class="col-xs-12">Correo</label>
                        <div class="col-xs-12">
                            <input type="email" id="user_email" name="user_email" class="form-control" placeholder="Correo">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_telefono" class="col-xs-12">Telefono</label>
                        <div class="col-xs-12">
                            <input type="text" id="user_telefono" name="user_telefono" class="form-control" placeholder="Telefono">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_password" class="col-xs-12">Contraseña</label>
                        <div class="col-xs-12">
                            <input type="password" id="user_password" name="user_password" class="form-control" placeholder="Contraseña">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cuser_password" class="col-xs-12">Reingrese la contraseña</label>
                        <div class="col-xs-12">
                            <input type="password" id="cuser_password" name="cuser_password" class="form-control" placeholder="Reingrese la contraseña">
                        </div>
                    </div>
                    <div class="form-group">
                        <div id="fine-uploader-validation_foto"></div>
                        <input type="hidden" id="foto_usuario" name="foto_usuario">
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="user-login-modal-link pull-left">
                        <a data-rel="loginModal" href="#loginModal">¿Ya tienes una cuenta?</a>
                    </span>
                    <button type="submit" class="btn btn-default btn-outline">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>