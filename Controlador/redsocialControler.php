<?php session_start();
error_reporting(-1);
require_once "../Modelo/RedSocialModelo.php";

// Iniciamos la clase de la carta
$Limpiarvar = new Funciones();
$redsocia = new RedSocial;

//Datos de la session del usuario
$DataUsuario = isset($_SESSION['DatosUsuario']) ? $_SESSION['DatosUsuario'] : '';
$idUsuario = !empty($DataUsuario['usuario']['id']) ? $DataUsuario['usuario']['id'] : '';

//Datos del mensaje
// $nombre_banco = isset($_POST['nombre_banco']) ? $Limpiarvar->limpiar($_POST['nombre_banco'], '0') : '';
$nombreproducto = isset($_POST['nombreproducto']) ? $Limpiarvar->limpiar($_POST['nombreproducto'], '0') : '';
$precioproducto = isset($_POST['precioproducto']) ? $Limpiarvar->limpiar($_POST['precioproducto'], '0') : '';
$cantidadproducto = isset($_POST['cantidadproducto']) ? $Limpiarvar->limpiar($_POST['cantidadproducto'], '0') : '';
$pesoproducto = isset($_POST['pesoproducto']) ? $Limpiarvar->limpiar($_POST['pesoproducto'], '0') : '';
$fotoproducto = isset($_POST['fotoproducto']) ? $Limpiarvar->limpiar($_POST['fotoproducto'], '0') : '';

$creado = date("Y-m-d H:i:s");

$op = isset($_REQUEST['op']) ? $Limpiarvar->limpiar($_REQUEST['op'], '0') : '';
$data = array();
$datos = '';
$sql = '';

switch ($op) {
	case 'subirTumblr':

$nombreproductofinal = str_replace(' ', '_', $nombreproducto);

$dataenvio = array('title' => 'Producto Nuevo', 'body' => '
	<p>Nombre "'.$nombreproducto.'"</p>
	<p>Cantidad "'.$cantidadproducto.'" "'.$pesoproducto.'"</p>
	<p>Precio "'.$precioproducto.'" Bs</p>
	<p>
	<a href="localhost/detalleproducto/'.$nombreproductofinal.'/" target="_blank">Ir a la página del producto</a>
	</p>
 <img class="avatar-image" src="http://localhost/'.$fotoproducto.'" alt="queseralosllanos" data-orig-height="128" data-orig-width="128" data-orig-src="http://localhost/'.$fotoproducto.'">');

// Make the request
// $datos = $redsocia->client->getUserInfo();
$datosnuevos = $redsocia->client->createPost('queseralosllanos', $dataenvio);

if ($datosnuevos->state == 'published') {
	$sessData['estado']['type'] = 'success';
	$sessData['estado']['msg'] = "Publicado con el id: ".$datosnuevos->id;
}else{
     $sessData['estado']['type'] = 'error';
     $sessData['estado']['msg'] = 'No se pudo publicar el producto en la red social.';
}

	echo json_encode($sessData);
	break;


	default:
	break;
}