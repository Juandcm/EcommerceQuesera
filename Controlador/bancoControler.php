<?php session_start();
error_reporting(-1);
require_once "../Modelo/bancoModelo.php";

// Iniciamos la clase de la carta
$Limpiarvar = new Funciones();
$banco = new Banco;

//Datos de la session del usuario
$DataUsuario = isset($_SESSION['DatosUsuario']) ? $_SESSION['DatosUsuario'] : '';
$idUsuario = !empty($DataUsuario['usuario']['id']) ? $DataUsuario['usuario']['id'] : '';

//Datos del banco
$nombre_banco = isset($_POST['nombre_banco']) ? $Limpiarvar->limpiar($_POST['nombre_banco'], '0') : '';
$nombre_titular = isset($_POST['nombre_titular']) ? $Limpiarvar->limpiar($_POST['nombre_titular'], '0') : '';
$cedula_titular = isset($_POST['cedula_titular']) ? $Limpiarvar->limpiar($_POST['cedula_titular'], '0') : '';
$numero_cuenta = isset($_POST['numero_cuenta']) ? $Limpiarvar->limpiar($_POST['numero_cuenta'], '0') : '';
$creado = date("Y-m-d H:i:s");



//Edicion del banco
$editar_nombre_banco = isset($_POST['editar_nombre_banco']) ? $Limpiarvar->limpiar($_POST['editar_nombre_banco'], '0') : '';
$editar_nombre_titular = isset($_POST['editar_nombre_titular']) ? $Limpiarvar->limpiar($_POST['editar_nombre_titular'], '0') : '';
$editar_cedula_titular = isset($_POST['editar_cedula_titular']) ? $Limpiarvar->limpiar($_POST['editar_cedula_titular'], '0') : '';
$editar_numero_cuenta = isset($_POST['editar_numero_cuenta']) ? $Limpiarvar->limpiar($_POST['editar_numero_cuenta'], '0') : '';


$ban_id = isset($_POST['ban_id']) ? $Limpiarvar->limpiar($_POST['ban_id'], '0') : '';


$op = isset($_REQUEST['op']) ? $Limpiarvar->limpiar($_REQUEST['op'], '0') : '';
$data = array();
$datos = '';
$sql = '';

switch ($op) {
	case 'procesarbanco':

	$sql = "INSERT INTO banco (ban_id, ban_nombre, ban_imagen, ban_estado) VALUES (NULL, '$nombre_banco', NULL, '1');";

	$insertar = $banco->ejecutarConsulta($sql, $datos);

	if ($insertar) {

		$orderID = $banco->ejecutarConsulta_retornrID();

		$sql2 = "INSERT INTO usuario_banco (uba_id, uba_nombre, uba_cedula, uba_cuenta, uba_tipocuenta, ban_id) VALUES (NULL, '$nombre_titular', '$cedula_titular', '$numero_cuenta', '1', '$orderID');";

		$insertar2 = $banco->ejecutarConsulta($sql2, $datos);

		if ($insertar2) {
			$sessData['estado']['type'] = 'success';
			$sessData['estado']['msg'] = 'Se guardo correctamente.';
		}else{
			$sessData['estado']['type'] = 'error';
			$sessData['estado']['msg'] = 'No se pudo guardar.';		
		}

	} else {
		$sessData['estado']['type'] = 'error';
		$sessData['estado']['msg'] = 'No se pudo guardar.';
	}

	echo json_encode($sessData);
	break;

	case 'mostrarbancoadmin':

	$sql2 = "SELECT ban.ban_id, ban.ban_nombre, ban.ban_imagen, uba.uba_nombre, uba.uba_cedula, uba.uba_cuenta FROM banco ban INNER JOIN usuario_banco uba ON ban.ban_id = uba.ban_id";
	$consulta2 = $banco->ejecutarConsultaTodasFilas($sql2, $datos);
	if ($consulta2) {
        	// ban_id 	ban_nombre 	ban_imagen 	ban_estado 	uba_id 	uba_nombre 	uba_cedula 	uba_cuenta 	uba_tipocuenta 	ban_id
		foreach ($consulta2 as $row) {

			$data[] = array(
				"0" => '<p>' . $row->ban_nombre . '</p>',
				"1" => '<p>' . $row->uba_nombre . '</p>',
				"2" => '<p>' . $row->uba_cedula. '</p>',
				"3" => '<p>' . $row->uba_cuenta . '</p>',
				"4" => '
				<a href="#" class="text-inverse p-r-10" data-toggle="tooltip" title="" data-original-title="Editar" onclick="editarbanco(\'' . $row->ban_id . '\',\'' . $row->uba_nombre . '\',\'' . $row->uba_cedula . '\',\'' . $row->uba_cuenta . '\',\'' . $row->ban_nombre . '\');" data-toggle="modal" data-target="#editarbancoModal">
				<i class="ti-marker-alt"></i>
				</a>
				<a href="#" class="text-inverse prevendefaultboton" title="" data-toggle="tooltip" data-original-title="Eliminar Banco" onclick="eliminarbanco(\'' . $row->ban_id . '\')">
				<i class="ti-trash"></i>
				</a>',
			);
		}

	} else {
		$data[] = array(
			"0" => '', "1" => '', "2" => 'No hay nada', "3" => '',
			"4" => ''
		);
	}
	$datosnuevo = array('data' => $data);
	echo json_encode($datosnuevo);

	break;

	case 'editarbanco':
// $ban_id
// $editar_nombre_banco
// $editar_nombre_titular
// $editar_cedula_titular
// $editar_numero_cuenta


	$sql1 = "UPDATE banco SET ban_nombre = '$editar_nombre_banco' WHERE banco.ban_id = '$ban_id';";
	$editar = $banco->ejecutarConsulta($sql1, $datos);

	if ($editar) {

		$sql2 = "UPDATE usuario_banco SET uba_nombre = '$editar_nombre_titular', uba_cedula = '$editar_cedula_titular', uba_cuenta = '$editar_numero_cuenta' WHERE usuario_banco.ban_id = '$ban_id';";

		$editar2 = $banco->ejecutarConsulta($sql2, $datos);

		if ($editar2) {
			$sessData['estado']['type'] = 'success';
			$sessData['estado']['msg'] = 'Ya se edito el banco.';
		}else{
			$sessData['estado']['type'] = 'error';
			$sessData['estado']['msg'] = 'No se pudo editar.';
		}


	} else {
		$sessData['estado']['type'] = 'error';
		$sessData['estado']['msg'] = 'No se pudo editar.';
	}

	echo json_encode($sessData);
	break;


	case 'eliminarbanco':
	$sql = "DELETE FROM usuario_banco WHERE ban_id = '$ban_id'";
	$eliminar = $banco->ejecutarConsulta($sql, $datos);

	$sql1 = "DELETE FROM banco WHERE ban_id = '$ban_id'";
	$eliminar1 = $banco->ejecutarConsulta($sql1, $datos);

	if ($eliminar && $eliminar1) {
		$sessData['estado']['type'] = 'success';
		$sessData['estado']['msg'] = 'Ya se elimino el banco.';

	} else {
		$sessData['estado']['type'] = 'error';
		$sessData['estado']['msg'] = 'No se pudo eliminar.';
	}

	echo json_encode($sessData);
	break;
	

	default:
	break;
}
