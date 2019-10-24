<?php session_start();
error_reporting(-1);
require_once "../Modelo/productoModelo.php";
$Limpiarvar = new Funciones();
$producto_normal = new Producto();

// Fecha de creacion o modificacion
$creado = date("Y-m-d H:i:s");

// Datos de registro del tipo de producto
$nombre_tipo = isset($_POST['nombre_tipo']) ? $Limpiarvar->limpiar($_POST['nombre_tipo'], '0') : '';
$peso_tipo = isset($_POST['peso_tipo']) ? $Limpiarvar->limpiar($_POST['peso_tipo'], '0') : '';

// Datos de actualizacion del tipo de producto

// Datos para la creacion del producto
$nombre_producto = isset($_POST['nombre_producto']) ? $Limpiarvar->limpiar($_POST['nombre_producto'], '0') : '';
$precio_producto = isset($_POST['precio_producto']) ? $Limpiarvar->limpiar($_POST['precio_producto'], '0') : '';
$cantidad_producto = isset($_POST['cantidad_producto']) ? $Limpiarvar->limpiar($_POST['cantidad_producto'], '0') : '';
$tipo_producto_id = isset($_POST['tipo_producto_id']) ? $Limpiarvar->limpiar($_POST['tipo_producto_id'], '0') : '';
$foto_producto = isset($_POST['foto_producto']) ? $Limpiarvar->limpiar($_POST['foto_producto'], '0') : '';


// Datos para la edicion del producto
$editar_producto_id = isset($_POST['editar_producto_id']) ? $Limpiarvar->limpiar($_POST['editar_producto_id'], '0') : '';
$editar_nombre_producto = isset($_POST['editar_nombre_producto']) ? $Limpiarvar->limpiar($_POST['editar_nombre_producto'], '0') : '';
$editar_precio_producto = isset($_POST['editar_precio_producto']) ? $Limpiarvar->limpiar($_POST['editar_precio_producto'], '0') : '';
$editar_cantidad_producto = isset($_POST['editar_cantidad_producto']) ? $Limpiarvar->limpiar($_POST['editar_cantidad_producto'], '0') : '';
$editar_tipo_producto_id = isset($_POST['editar_tipo_producto_id']) ? $Limpiarvar->limpiar($_POST['editar_tipo_producto_id'], '0') : '';
$editar_foto_producto = isset($_POST['editar_foto_producto']) ? $Limpiarvar->limpiar($_POST['editar_foto_producto'], '0') : '';

// Datos para la busqueda del producto
$buscarproducto = isset($_POST['buscarproducto']) ? $Limpiarvar->limpiar($_POST['buscarproducto'], '0') : '';


// Datos para la edicion del tipo de producto
$editar_nombre_tipo = isset($_POST['editar_nombre_tipo']) ? $Limpiarvar->limpiar($_POST['editar_nombre_tipo'], '0') : '';
$editar_peso_tipo = isset($_POST['editar_peso_tipo']) ? $Limpiarvar->limpiar($_POST['editar_peso_tipo'], '0') : '';
// idtipo

// Id del producto
$idproducto = isset($_POST['idproducto']) ? $Limpiarvar->limpiar($_POST['idproducto'], '0') : '';
$vista = isset($_POST['vista']) ? $Limpiarvar->limpiar($_POST['vista'], '0') : '';

// Id del tipo de producto
$idtipo = isset($_POST['idtipo']) ? $Limpiarvar->limpiar($_POST['idtipo'], '0') : '';

$op = isset($_GET['op']) ? $Limpiarvar->limpiar($_GET['op'], '0') : '';


switch ($op) {
    case 'crearTipoProducto':
        $producto_normal->crearTipoProducto($nombre_tipo, $peso_tipo);
        // echo "hola";
        break;

    case 'mostrartipoproducto':
        $producto_normal->mostrartipoproducto();
        break;

    case 'crearProducto':
        $producto_normal->crearProducto($nombre_producto, $precio_producto, $cantidad_producto, $creado, $tipo_producto_id, $foto_producto);
        break;

    case 'editarProducto':
        $producto_normal->editarProducto($editar_producto_id, $editar_nombre_producto, $editar_precio_producto, $editar_cantidad_producto, $editar_foto_producto, $creado);
        break;

    case 'editartipoProducto':
        $producto_normal->editartipoProducto($idtipo, $editar_nombre_tipo, $editar_peso_tipo);
        break;

    case 'listarSoloEstado1':
        $producto_normal->listarSoloEstado1();
        break;

    case 'listarSoloEstado0':
        $producto_normal->listarSoloEstado0();
        break;

    case 'tipoproductos':
        $producto_normal->tipoproductos();
        break;

    case 'mostrarproductofront':
        $producto_normal->mostrarproductofront($buscarproducto, $vista);
        break;

    case 'mostrarDetallesProducto':
        $producto_normal->mostrarDetallesProducto($idproducto, $vista);
    // echo $idproducto ." ".$vista;
        break;

    case 'eliminartipo':
        $producto_normal->eliminartipo($idtipo);
        break;

    case 'eliminarproducto':
        $producto_normal->eliminarproducto($idproducto);
        break;

case 'aprobarproducto':
    $producto_normal->aprobarproducto($idproducto);
    break;
case 'desactivarproducto':
    $producto_normal->desactivarproducto($idproducto);
    break;
        

    default:
        break;
}
