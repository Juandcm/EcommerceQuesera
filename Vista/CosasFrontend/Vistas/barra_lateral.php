<div class="minicart-side">
    <div class="minicart-side-title">
        <h4>Carrito de compra</h4>
    </div>
    <div class="minicart-side-content">
        <div class="minicart">
            <div class="minicart-header no-items show">

                <?php if ($total_items > 0){ ?>
                    <p>
                    Tienes <span class="amount"><?=$total_items;?></span> Productos en el carrito    
                    </p>
                    <p>
                    El monto total es de <span class="amount"><?=$cart_total;?> Bs</span>
                    </p>
                <?php }else{ ?>
                    <span class="amount">No tienes ningún producto en tu carrito</span>
                <?php } ?>
                
            </div>
            <div class="minicart-footer">
                <div class="minicart-actions clearfix">
                    <a class="button no-item-button" href="./carrito">
                        <span class="text">Ir a tu carrito</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>