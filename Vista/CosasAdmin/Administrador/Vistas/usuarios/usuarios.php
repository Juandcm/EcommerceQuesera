<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="text-center">Opciones Administrativas</h1>
                </div>

                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <button class="fcbtn btn btn-outline btn-block btn-success btn-1e  waves-effect waves-light" style="font-size: large;" data-toggle="modal" data-target="#crearusuarioModal">Crear usuario </button>
                </div>
                <div class="col-md-4">
                </div>
            </div>

        </div>
    </div>
</div>



<div class="row">
    <div class="col-md-12">
        <!-- ////// -->
        <div class="white-box">
            <!-- Nav tabs -->
            <ul class="nav customtab nav-tabs nav-pills nav-justified" role="tablist">
                <li role="presentation" class="active">
                    <a href="#usuarios1" aria-controls="usuarioen1" role="tab" data-toggle="tab" aria-expanded="false">
                        <span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs letrasGrandes">
                            Usuarios activos
                        </span></a>
                </li>
                <li role="presentation" class="">
                    <a href="#usuario0" aria-controls="usuarioen0" role="tab" data-toggle="tab" aria-expanded="false">
                        <span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs letrasGrandes">
                            Usuarios desactivados
                        </span>
                    </a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="usuarios1">
                    <div class="col-xs-12">
                    <?php
                                include_once 'Vistas/usuarioactivo.php';
                    ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="usuario0">
                    <div class="col-xs-12">
                    <?php
                                include_once 'Vistas/usuarioinactivo.php';
                    ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- ////// -->
    </div>
</div>

<!-- Modal de registro del usuario -->
<!-- nombre_nuevo correo_nuevo telefono_nuevo contrasena_nueva repite_contrasena_nueva -->
<!-- user_login user_email user_telefono user_password cuser_password -->
<div class="modal fade" id="crearusuarioModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="crearusuarioModalForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center">Crear usuario</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12">

                                <div class="form-group">
                                    <label for="user_login" class="col-xs-12">Nombre</label>
                                    <div class="col-xs-12">
                                        <input type="text" name="user_login" id="user_login" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user_email" class="col-xs-12">Correo</label>
                                    <div class="col-xs-12">
                                        <input type="email" id="user_email" name="user_email" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user_telefono" class="col-xs-12">Telefono</label>
                                    <div class="col-xs-12">
                                        <input type="text" id="user_telefono" name="user_telefono" class="form-control">
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


                            </div>
                        </div>
                    </div>    
                </div>
                
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary waves-effect">Crear</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>


</div>