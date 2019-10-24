<?php session_start();
error_reporting(-1);
require_once "../Modelo/carritoModelo.php";

// Iniciamos la clase de la carta
$Limpiarvar = new Funciones();
$cart = new Cart;


//Variables del carrito
$productID = isset($_REQUEST['id']) ? $Limpiarvar->limpiar($_REQUEST['id'], '0') : '';
$rowid = isset($_REQUEST['rowid']) ? $Limpiarvar->limpiar($_REQUEST['rowid'], '0') : '';
$cantidadProducto = isset($_REQUEST['qty']) ? $Limpiarvar->limpiar($_REQUEST['qty'], '0') : '';

//Datos de la session del usuario
$DataUsuario = isset($_SESSION['DatosUsuario']) ? $_SESSION['DatosUsuario'] : '';
$idUsuario = !empty($DataUsuario['usuario']['id']) ? $DataUsuario['usuario']['id'] : '';

$vista = isset($_POST['vista']) ? $Limpiarvar->limpiar($_POST['vista'], '0') : '';
$datos = '';
$creado = date("Y-m-d H:i:s");

$op = isset($_REQUEST['op']) ? $Limpiarvar->limpiar($_REQUEST['op'], '0') : '';

switch ($op) {
    case 'addToCart':
        // $cart->addToCart($productID,$cantidadProducto,$datos);

        // Aqui agrego el carrito
        // get product details
        $sql = "SELECT * FROM producto WHERE pro_idproducto = '$productID'";
        // Revisar aqui para configurar bien la consulta
        $consulta = $Limpiarvar->ejecutarConsultaSimpleFila($sql, $datos);
        // Aqui tengo que hacer la consulta del producto
        if ($consulta) {
            //  echo "Esto es lo que buscas: ".$resultado->usu_iden;
            $itemData = array(
                'id' => $productID,
                'name' => $consulta->pro_nombre,
                'price' => $consulta->pro_precio,
                'qty' => $cantidadProducto,
                'imagen' => $consulta->pro_imagen
            );
            $insertItem = $cart->insert($itemData);

            if ($insertItem) {
                $sessData['estado']['type'] = 'success';
                $sessData['estado']['msg'] = 'Se agrego correctamente.';
            } else {
                $sessData['estado']['type'] = 'error';
                $sessData['estado']['msg'] = 'No se pudo agregar.';
            }
        } else {
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'No se pudo agregar.';
        }

        echo json_encode($sessData);
        break;

    case 'actualizarCarrito':
        // Aqui actualizo el carrito
        $itemData = array(
            'rowid' => $productID,
            'qty' => $cantidadProducto
        );

        $updateItem = $cart->update($itemData);
        if ($updateItem) {
            $sessData['estado']['type'] = 'success';
            $sessData['estado']['msg'] = 'Se actualizo correctamente.';
        } else {
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'No se pudo actualizar.';
        }
        echo json_encode($sessData);
        break;

    case 'removeCartItem':
        // Aqui elimino un producto del carrito
        $deleteItem = $cart->remove($rowid);
        if ($deleteItem) {
            $sessData['estado']['type'] = 'success';
            $sessData['estado']['msg'] = 'Se elimino correctamente.';
        } else {
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'No se pudo eliminar.';
        }
        echo json_encode($sessData);
        break;

    case 'mostrarProductosCarritosFull':
        $data = array();
        if ($cart->total_items() > 0) {
            //get cart items from session
            $cartItems = $cart->contents();
            foreach ($cartItems as $item) {

                $foto = empty($item["imagen"]) ? '' : $item["imagen"];
                $imagen = '';
                if ($vista == '') {
                    $imagen = "<img src='SubidArchivos/archivos/articulosUsuario/" . $foto . "' alt='' class='product__img' style='width:150px; height: 240px;'>";
                } else {
                    $imagen = "<img src='http://localhost/SubidArchivos/archivos/articulosUsuario/" . $foto . "' alt='' class='product__img' style='width:150px; height: 240px;'>";
                }

                $data[] = array(
                    "0" => '<div class="product-thumbnail"><a href="#">
                    ' . $imagen . '
</a>
</div>',
                    "1" => $item["name"],
                    "2" => $item["price"] . ' Bs',
                    "3" => '
                    <div class="quantity buttons_added">
                    <input type="button" value="-" class="minus">
                    <input type="number" step="0" min="0" value="' . $item["qty"] . '" title="Qty" max="300" class="input-text qty text" onchange="updateCartItem(\'' . $item["rowid"] . '\', this)">
                    <input type="button" value="+" class="plus"></div>',
                    "4" => '' . $item["subtotal"] . ' Bs',
                    "5" => '

<a href="#" class="remove" onclick="eliminarproductocarrito(\'' . $item["rowid"] . '\')" data-toggle="tooltip" title="" data-original-title="Eliminar producto">
<i class="ui-close"></i>
</a>'

                );
            }
        } else {
            $data[] = array(
                "0" => '', "1" => '', "2" => 'No hay nada', "3" => 'No hay nada',
                "4" => '', "5" => ''
            );
        }

        $datosnuevo = array('data' => $data);
        echo json_encode($datosnuevo);


        break;

    case 'placeOrder':
        // Despues hago esto
        // Aqui paso a guardar la compra en la base de datos
        if ($cart->total_items() > 0 && !empty($idUsuario)) {
            // insert order details into database
            $preciototalProductos = $cart->total();
            $cantidadtotalproductos = $cart->total_items();
            $sqlprimera = "INSERT INTO compra (com_id, com_precio, com_cantidad, com_creado, com_actualizado, com_estado, usu_id) VALUES (NULL, '$preciototalProductos', '$cantidadtotalproductos', '$creado', NULL, '0', '$idUsuario');";

            $insertOrder = $Limpiarvar->ejecutarConsulta($sqlprimera, $datos);

            if ($insertOrder) {
                $orderID = $Limpiarvar->ejecutarConsulta_retornrID();
                $sql = '';
                // get cart items
                $cartItems = $cart->contents();
                foreach ($cartItems as $item) {
                    // Revisar esta consulta
                    $cantida = $item['qty'];
                    $subtotal = $item['subtotal'];
                    $idproducto = $item['id'];

                    $sql .= "INSERT INTO carrito_compra (car_id, car_cantidadproducto, car_precioproductototal, com_idprincipal, pro_id) VALUES (NULL, '$cantida', '$subtotal', '$orderID', '$idproducto');";

                    // Esta es la consulta que me va a restar en la tabla producto
                    // $sql="UPDATE tienda SET stock = stock - $cantidad WHERE producto_id = $producto_id";  
                
                }


                // insert order items into database
                $insertOrderItems = $Limpiarvar->ejecutarConsulta($sql, $datos);

                if ($insertOrderItems) {
                    $cart->destroy();
                    $sessData['estado']['type'] = 'success';
                    $sessData['estado']['msg'] = 'Listo, ahora te toca pagar los productos.';
                } else {
                    $sessData['estado']['type'] = 'error';
                    $sessData['estado']['msg'] = 'No se pudo comprar.';
                }
            } else {
                $sessData['estado']['type'] = 'error';
                $sessData['estado']['msg'] = 'No se pudo comprar.';
            }
        } else {
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'No se puede comprar porque tienes que estar logueado.';
        }
        echo json_encode($sessData);

        break;

    default:
        break;
}
