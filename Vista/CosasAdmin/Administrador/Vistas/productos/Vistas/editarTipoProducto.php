<div class="modal fade editar-tipoproducto-modal" id="editartipoproductoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editartipoproductoForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center">Editar tipo de Producto</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12">

                            <div class="form-group">
                                <input type="hidden" name="idtipo" id="idtipo" value="">
                                    <label for="editar_nombre_tipo" class="col-xs-12">Nombre del tipo de producto</label>
                                    <div class="col-xs-12">
                                        <input type="text" name="editar_nombre_tipo" id="editar_nombre_tipo" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="editar_peso_tipo" class="col-xs-12">Tipo de peso a utilizar</label>
                                    <div class="col-xs-12">
                                        <input type="text" id="editar_peso_tipo" name="editar_peso_tipo" class="form-control">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary waves-effect text-left">Actualizar</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
</div>