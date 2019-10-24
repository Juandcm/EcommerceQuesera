<div class="modal fade editar-producto-modal" id="editarproductoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editarproductoForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center">Editar Producto</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12">

                                <div class="form-group">
                                    <input type="hidden" name="editar_producto_id" id="editar_producto_id">
                                    <label for="editar_nombre_producto" class="col-xs-12">Nombre del producto</label>
                                    <div class="col-xs-12">
                                        <input type="text" name="editar_nombre_producto" id="editar_nombre_producto" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="editar_precio_producto" class="col-xs-12">Precio del producto</label>
                                    <div class="col-xs-12">
                                        <input type="number" id="editar_precio_producto" name="editar_precio_producto" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="editar_cantidad_producto" class="col-xs-12">Cantidad del producto</label>
                                    <div class="col-xs-12">
                                        <input type="number" id="editar_cantidad_producto" name="editar_cantidad_producto" class="form-control">
                                    </div>
                                </div>
                                    <!-- <div class="container">
                                    <div class="row"> -->
                                <div class="col-xs-12 margintop25px">
                                    <div class="form-group">
                                        <div id="fine-uploader-validation_editar_producto"></div>
                                        <input type="hidden" id="editar_foto_producto" name="editar_foto_producto">
                                    </div>
                                </div>
                                <!-- </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary waves-effect text-left">editar</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
</div>