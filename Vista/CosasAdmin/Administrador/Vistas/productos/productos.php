<div class="row">
    <div class="col-md-12">
        <div class="white-box">

            <div class="row">
                <div class="col-xs-12">
                    <h1 class="text-center">Opciones Administrativas</h1>
                </div>
                <div class="col-md-4">
                    <a href="#" data-toggle="modal" data-target="#crearproductoModal">
                        <button class="fcbtn btn btn-outline btn-block btn-success btn-1e  waves-effect waves-light" style="font-size: large;">Subir producto </button>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#" data-toggle="modal" data-target="#tipoproductoModal">
                        <button class="fcbtn btn btn-outline btn-block btn-warning btn-1e  waves-effect waves-light" style="font-size: large;">Crear tipos de producto </button>
                    </a>
                </div>
                <div class="col-md-4">
                <a href="#" data-toggle="modal" data-target="#crearbancoModal">
                    <button class="fcbtn btn btn-outline btn-block btn-info btn-1e  waves-effect waves-light" style="font-size: large;" >Subir banco del administrador</button>
                </a>
                </div>
            </div>

        </div>
    </div>
</div>








<!-- ////// -->
<div class="white-box">
    <!-- Nav tabs -->
    <ul class="nav customtab nav-tabs nav-pills nav-justified" role="tablist">
        <li role="presentation" class="active">
            <a href="#primeraopcion" aria-controls="primeraopcion" role="tab" data-toggle="tab" aria-expanded="false">
                <span class="visible-xs"><i class="ti-home"></i></span>
                <span class="hidden-xs letrasGrandes">
                    Productos en la tienda
                </span>
            </a>
        </li>
        <li role="presentation" class="">
            <a href="#segundaopcion" aria-controls="segundaopcion" role="tab" data-toggle="tab" aria-expanded="false">
                <span class="visible-xs"><i class="ti-user"></i></span>
                <span class="hidden-xs letrasGrandes">
                    Tipos de productos y el banco de la tienda
                </span>
            </a>
        </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="primeraopcion">
            <div class="col-xs-12">

                <!-- ////// -->
                <div class="white-box">
                    <!-- Nav tabs -->
                    <ul class="nav customtab nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#producto1" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs letrasMedianas">Productos activos </span></a></li>
                        <li role="presentation" class=""><a href="#productos0" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs letrasMedianas">Productos inactivos </span></a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="producto1">
                            <div class="col-xs-12">
                                <?php
                                include_once 'Vistas/productosactivos.php';
                                ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="productos0">
                            <div class="col-xs-12">
                                <?php
                                include_once 'Vistas/productosinactivos.php';
                                ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- ////// -->

            </div>
            <div class="clearfix"></div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="segundaopcion">
            <div class="col-xs-12">
                <!-- ////// -->
                <div class="white-box">
                    <!-- Nav tabs -->
                    <ul class="nav customtab nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#tipoproducto" aria-controls="producto" role="tab" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs letrasMedianas">Tipos de producto
                                </span></a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#banco" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs letrasMedianas">Bancos </span></a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="tipoproducto">
                            <div class="col-xs-12">
                                <?php
                                include_once 'Vistas/tipodeproducto.php';
                                ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="banco">
                            <div class="col-xs-12">
                                <?php
                                include_once 'Vistas/bancos.php';
                                ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- ////// -->
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- ////// -->




<?php
include_once 'Vistas/creartipoproducto.php';
include_once 'Vistas/crearproducto.php';
include_once 'Vistas/editarTipoProducto.php';
include_once 'Vistas/editarproducto.php';
include_once 'Vistas/crearbanco.php';
include_once 'Vistas/subiredsocial.php';
?>