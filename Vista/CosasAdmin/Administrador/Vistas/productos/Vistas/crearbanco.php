<div class="modal fade crear-banco-modal" id="crearbancoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="crearbancoForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center">Subir el banco del administrador</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12">

                                <div class="form-group">
                                    <label for="nombre_banco" class="col-xs-12">Nombre del banco</label>
                                    <div class="col-xs-12">
                                        <input type="text" name="nombre_banco" id="nombre_banco" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nombre_titular" class="col-xs-12">Nombre del titular de la cuenta</label>
                                    <div class="col-xs-12">
                                        <input type="text" name="nombre_titular" id="nombre_titular" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="cedula_titular" class="col-xs-12">Cédula del titular de la cuenta</label>
                                    <div class="col-xs-12">
                                        <input type="text" name="cedula_titular" id="cedula_titular" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="numero_cuenta" class="col-xs-12">Número de la cuenta</label>
                                    <div class="col-xs-12">
                                        <input type="number" name="numero_cuenta" id="numero_cuenta" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary waves-effect text-left">Crear</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
</div>



<div class="modal fade" id="editarbancoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editarbancoForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center">Edición del Banco</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12">

                                <div class="form-group">
                                    <label for="editar_nombre_banco" class="col-xs-12">Nombre del banco</label>
                                    <div class="col-xs-12">
                                        <input type="hidden" name="ban_id" id="ban_id">
                                        <input type="text" name="editar_nombre_banco" id="editar_nombre_banco" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="editar_nombre_titular" class="col-xs-12">Nombre del titular de la cuenta</label>
                                    <div class="col-xs-12">
                                        <input type="text" name="editar_nombre_titular" id="editar_nombre_titular" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="editar_cedula_titular" class="col-xs-12">Cédula del titular de la cuenta</label>
                                    <div class="col-xs-12">
                                        <input type="text" name="editar_cedula_titular" id="editar_cedula_titular" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="editar_numero_cuenta" class="col-xs-12">Número de la cuenta</label>
                                    <div class="col-xs-12">
                                        <input type="number" name="editar_numero_cuenta" id="editar_numero_cuenta" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary waves-effect text-left">Editar</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
</div>