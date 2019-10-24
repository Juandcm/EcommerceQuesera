<?php
$codigorestaurar = isset($_REQUEST['codigo']) ? $_REQUEST['codigo'] : '';
?>

<div class="row">
    <div class="col-md-12">
        <div class="main-content">
            <div class="commerce commerce-account">
                <h2 class="commerce-account-heading">Restaurar Contraseña</h2>
                <form id="reenviarcontrasenaForm" class="text-center">


                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">


                                <div class="form-group">
                                    <label for="reenviarcontrasenanueva" class="col-xs-12">
                                        Contraseña <span class="required">*</span>
                                    </label>
                                    <div class="col-xs-2"></div>
                                    <div class="col-xs-8">
                                        <input type="hidden" name="codigorestaurar" id="codigorestaurar" value="<?= $codigorestaurar; ?>">
                                        <input type="password" id="reenviarcontrasenanueva" name="reenviarcontrasenanueva" class="form-control" placeholder="Correo">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="repitereenviarcontrasena" class="col-xs-12">
                                        Repite la contraseña <span class="required">*</span>
                                    </label>
                                    <div class="col-xs-2"></div>
                                    <div class="col-xs-8">
                                        <input type="password" id="repitereenviarcontrasena" name="repitereenviarcontrasena" class="form-control" placeholder="Correo">
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>


                    <div class="form-row">
                        <button class="btn btn-outline rounded" type="submit">Restaurar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>