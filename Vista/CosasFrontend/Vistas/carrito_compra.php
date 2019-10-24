<?php
if ($total_items > 0) {
    ?>

    <div class="col-sm-12">
        <div class="box-ft box-ft-5">
            <!-- Page Title -->
            <section class="page-title text-center">
                <div class="container">
                    <h1 class=" heading page-title__title">Carrito de articulos</h1>
                </div>
            </section>

            <!-- Cart -->
            <section class="section-wrap cart pt-50 pb-40">
                <div class="container relative">

                    <div class="table-wrap">
                        <table cellpadding="0" cellspacing="0" border="0" class="display table table-striped table-bordered table-condensed table-hover" id="tablacarritodecompras" style="margin:0; width:96%">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Sub-Total</th>
                                    <th>Opción</th>
                                </tr>
                            </thead>
                            <tbody class="cuerpo"></tbody>
                        </table>
                    </div>


                    <div class="row justify-content-center">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-5">
                            <div class="cart_totals">
                                <h2 class="uppercase text-center mt-5">Total del Carrito</h2>

                                <table class="table shop_table">
                                    <tbody>
                                        <tr class="order-total">
                                            <th>Precio Total</th>
                                            <td>
                                                <span class="amount"><?= $cart_total; ?> Bs</span>
                                            </td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Total de Productos</th>
                                            <td>
                                                <strong><span class="amount"><?= $total_items; ?></span></strong>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div> <!-- end col cart totals -->

                    </div> <!-- end row -->


                    <div class="row justify-content-center">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-5">
                            <div class="actions text-center">
                                <div class="wc-proceed-to-checkout">
                                    <a href="#" class="btn btn-md btn-color btn-button" id="botoncomprar">
                                        <span>Proceder a la compra del carrito</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                </div> <!-- end container -->
            </section>
            <!-- end cart -->
        </div>
    </div>


<?php
} else {
    ?>

    <div class="col-sm-12">
        <div class="box-ft box-ft-5">
            <!-- Page Title -->
            <section class="page-title text-center">
                <div class="container">
                    <h1 class=" heading page-title__title bg-danger">No tienes productos en tu Carrito</h1>
                </div>
            </section>
        </div>
    </div>


<?php
}
?>