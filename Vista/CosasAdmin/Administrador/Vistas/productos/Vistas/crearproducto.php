<div class="modal fade crear-producto-modal" id="crearproductoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="crearproductoForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center">Crear Producto</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12">

                                <div class="form-group">
                                    <label for="nombre_producto" class="col-xs-12">Nombre del producto</label>
                                    <div class="col-xs-12">
                                        <input type="text" name="nombre_producto" id="nombre_producto" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="precio_producto" class="col-xs-12">Precio del producto</label>
                                    <div class="col-xs-12">
                                        <input type="number" id="precio_producto" name="precio_producto" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cantidad_producto" class="col-xs-12">Cantidad del producto</label>
                                    <div class="col-xs-12">
                                        <input type="number" id="cantidad_producto" name="cantidad_producto" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tipo_producto_id" class="col-xs-12">Selecciona el tipo de producto</label>
                                    <div class="col-xs-12">
                                        <select name="tipo_producto_id" id="tipo_producto_id" class="form-control">
                                        </select>
                                    </div>
                                </div>

                                <!-- <div class="container">
                                    <div class="row"> -->
                                <div class="col-xs-12 margintop25px">
                                    <div class="form-group">
                                        <div id="fine-uploader-validation_producto"></div>
                                        <input type="hidden" id="foto_producto" name="foto_producto">
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
                    <button type="submit" class="btn btn-primary waves-effect text-left">Crear</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
</div>