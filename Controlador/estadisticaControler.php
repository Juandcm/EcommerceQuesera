<?php session_start();
error_reporting(-1);
require_once "../Modelo/estadisticaModelo.php";

// Iniciamos la clase de la carta
$Limpiarvar = new Funciones();
$estadistica = new Estadistica;

//Datos de la session del usuario
$DataUsuario = isset($_SESSION['DatosUsuario']) ? $_SESSION['DatosUsuario'] : '';
$idUsuario = !empty($DataUsuario['usuario']['id']) ? $DataUsuario['usuario']['id'] : '';

$creado = date("Y-m-d H:i:s");

$op = isset($_REQUEST['op']) ? $Limpiarvar->limpiar($_REQUEST['op'], '0') : '';
$data = array();
$datos = '';
$sql = '';

switch ($op) {
	case 'mostrartodo':
// buscar todas las consultas produactivos produinactivos usuactivos usuinactivos bancotodos mensajenviados mensajerecibidos totalventas dineroventas

	$sql1 = "SELECT SUM(com_precio) as precioventas FROM compra;";
	$sql2 = "SELECT COUNT(pro_idproducto) as productosinactivos FROM producto WHERE pro_estado = '0';";
	$sql3 = "SELECT COUNT(pro_idproducto) as productosactivos FROM producto WHERE pro_estado = '1';";
	$sql4 = "SELECT COUNT(usu_id) as usuarioactivo FROM usuario WHERE usu_estado = '1';";
	$sql5 = "SELECT COUNT(usu_id) as usuarioinactivo FROM usuario WHERE usu_estado = '0';";
	$sql6 = "SELECT COUNT(uba_id) as cantidadbancos FROM usuario_banco;";
	$sql7 = "SELECT COUNT(com_id) as comproceso FROM compra WHERE com_estado = '0';";
	$sql8 = "SELECT COUNT(com_id) as comcompleta FROM compra WHERE com_estado = '1';";

$sql9 = "SELECT COUNT(men_id) as mensajesenviados FROM mensaje WHERE men_tipo = '1';";
$sql10 = "SELECT COUNT(men_id) as mensajesrecibidos FROM mensaje WHERE men_tipo = '0';";



	$resultado1 = $estadistica->ejecutarConsultaSimpleFila($sql1,$datos);
	$resultado2 = $estadistica->ejecutarConsultaSimpleFila($sql2,$datos);
	$resultado3 = $estadistica->ejecutarConsultaSimpleFila($sql3,$datos);
	$resultado4 = $estadistica->ejecutarConsultaSimpleFila($sql4,$datos);
	$resultado5 = $estadistica->ejecutarConsultaSimpleFila($sql5,$datos);
	$resultado6 = $estadistica->ejecutarConsultaSimpleFila($sql6,$datos);
	$resultado7 = $estadistica->ejecutarConsultaSimpleFila($sql7,$datos);
	$resultado8 = $estadistica->ejecutarConsultaSimpleFila($sql8,$datos);
$resultado9 = $estadistica->ejecutarConsultaSimpleFila($sql9,$datos);
$resultado10 = $estadistica->ejecutarConsultaSimpleFila($sql10,$datos);
	if ($resultado1 && $resultado2 && $resultado3 && $resultado4 && $resultado5 && $resultado6 && $resultado7 && $resultado8 && $resultado9 && $resultado10 ) {
		// foreach ($resultado as $row) {
		$sessData['estado']['type'] = 'success';
		$sessData['precioventas'] = $resultado1->precioventas." Bs";
		$sessData['productosinactivos'] = $resultado2->productosinactivos;
		$sessData['productosactivos'] = $resultado3->productosactivos;
		$sessData['usuarioactivo'] = $resultado4->usuarioactivo;
		$sessData['usuarioinactivo'] = $resultado5->usuarioinactivo;
		$sessData['cantidadbancos'] = $resultado6->cantidadbancos;
		$sessData['comproceso'] = $resultado7->comproceso;
		$sessData['comcompleta'] = $resultado8->comcompleta;
		$sessData['mensajesenviados'] = $resultado9->mensajesenviados;
		$sessData['mensajesrecibidos'] = $resultado10->mensajesrecibidos;
		// }
	}else{
		$sessData['estado']['type'] = 'error';
		$sessData['estado']['msg'] = 'No se encontraron los datos';
	}

	echo json_encode($sessData);
	break;

	default:
	break;
}
