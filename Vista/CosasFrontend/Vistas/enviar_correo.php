<div class="modal fade user-lostpassword-modal" id="userlostpasswordModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="userlostpasswordModalForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" id="botoncerrarmodal">
                        <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Olvido la contraseña</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12">

                                <div class="form-group">
                                    <label for="user_recordar_correo" class="col-xs-12">Correo</label>
                                    <div class="col-xs-12">
                                        <input type="email" id="user_recordar_correo" name="user_recordar_correo" class="form-control" placeholder="Correo">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="user-login-modal-link pull-left">
                        <a data-rel="loginModal" href="#loginModal">¿Ya tienes una cuenta?</a>
                    </span>
                    <button type="submit" class="btn btn-default btn-outline">Enviar correo</button>
                </div>
            </form>
        </div>
    </div>
</div>