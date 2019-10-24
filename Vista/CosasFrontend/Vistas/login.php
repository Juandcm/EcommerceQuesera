<div class="modal fade user-login-modal" id="userloginModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="userloginModalForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Entrar</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12">

                                <div class="form-group">
                                    <label for="user_login_correo" class="col-xs-12">Correo</label>
                                    <div class="col-xs-12">
                                        <input type="email" id="user_login_correo" name="user_login_correo" class="form-control" placeholder="Correo">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user_login_contraseña" class="col-xs-12">Contraseña</label>
                                    <div class="col-xs-12">
                                        <input type="password" id="user_login_contraseña" name="user_login_contraseña" class="form-control" placeholder="Contraseña">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="checkbox clearfix">
        <!--                                     <label class="form-flat-checkbox pull-left">
                                                <input type="checkbox" name="rememberme" id="rememberme" value="forever">
                                                <i></i>&nbsp;Recordar
                                            </label> -->
                                            <span class="lostpassword-modal-link pull-right">
                                                <a href="#lostpasswordModal" data-rel="lostpasswordModal">¿Has perdido tu contraseña?</a>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="user-login-modal-register pull-left">
                        <a data-rel="registerModal" href="#">¿No estas registrado?</a>
                    </span>
                    <button type="submit" class="btn btn-default btn-outline">Ingresar</button>
                </div>
            </form>
        </div>
    </div>
</div>