<div class="modal fade crear-tipoproducto-modal" id="tipoproductoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="tipoproductoForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center">Crear tipo de producto</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12">

                                <div class="form-group">
                                    <label for="nombre_tipo" class="col-xs-12">Nombre del tipo de producto</label>
                                    <div class="col-xs-12">
                                        <input type="text" name="nombre_tipo" id="nombre_tipo" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="peso_tipo" class="col-xs-12">Tipo de peso a utilizar</label>
                                    <div class="col-xs-12">
                                        <input type="text" id="peso_tipo" name="peso_tipo" class="form-control">
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