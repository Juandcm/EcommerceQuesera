<?php session_start();
error_reporting(-1);
require_once "../Modelo/procesarcompraModelo.php";

// Iniciamos la clase de la carta
$Limpiarvar = new Funciones();
$mensaje = new ProcesarCompra;

//Datos de la session del usuario
$DataUsuario = isset($_SESSION['DatosUsuario']) ? $_SESSION['DatosUsuario'] : '';
$idUsuario = !empty($DataUsuario['usuario']['id']) ? $DataUsuario['usuario']['id'] : '';

//Datos del mensaje
$idmensaje = isset($_POST['idmensaje']) ? $Limpiarvar->limpiar($_POST['idmensaje'], '0') : '';
$asuntomensaje = isset($_POST['asuntomensaje']) ? $Limpiarvar->limpiar($_POST['asuntomensaje'], '0') : '';
$descripcionmensaje = isset($_POST['descripcionmensaje']) ? $Limpiarvar->limpiar($_POST['descripcionmensaje'], '0') : '';
$mensaje_usuario = isset($_POST['mensaje_usuario']) ? $Limpiarvar->limpiar($_POST['mensaje_usuario'], '0') : '';
$creado = date("Y-m-d H:i:s");

//Detalles del mensaje
$men_id = isset($_POST['men_id']) ? $Limpiarvar->limpiar($_POST['men_id'], '0') : '';
$idusuarionormal = isset($_POST['idusuarionormal']) ? $Limpiarvar->limpiar($_POST['idusuarionormal'], '0') : '';

$op = isset($_REQUEST['op']) ? $Limpiarvar->limpiar($_REQUEST['op'], '0') : '';
$data = array();
$datos = '';
$sql = '';

switch ($op) {
    case 'enviarmensaje':

    if ($mensaje_usuario == '') {
        if ($idusuarionormal=='') {
        $sql = "INSERT INTO mensaje (men_id, men_asunto, men_descripcion, men_archivo, men_creado, men_actualizado, men_estado, men_tipo, usu_id) VALUES (NULL, '$asuntomensaje', '$descripcionmensaje', NULL, '$creado', NULL, '0', '0', '$idUsuario')";
        }else{
        $sql = "INSERT INTO mensaje (men_id, men_asunto, men_descripcion, men_archivo, men_creado, men_actualizado, men_estado, men_tipo, usu_id) VALUES (NULL, '$asuntomensaje', '$descripcionmensaje', NULL, '$creado', NULL, '0', '1', '$idusuarionormal')";
        }
    } else {
        if ($idusuarionormal == '') {
        $sql = "INSERT INTO mensaje (men_id, men_asunto, men_descripcion, men_archivo, men_creado, men_actualizado, men_estado, men_tipo, usu_id) VALUES (NULL, '$asuntomensaje', '$descripcionmensaje', '$mensaje_usuario', '$creado', NULL, '0', '0', '$idUsuario')";
        }else{
        $sql = "INSERT INTO mensaje (men_id, men_asunto, men_descripcion, men_archivo, men_creado, men_actualizado, men_estado, men_tipo, usu_id) VALUES (NULL, '$asuntomensaje', '$descripcionmensaje', '$mensaje_usuario', '$creado', NULL, '0', '1', '$idusuarionormal')";
        }
    }

    $insertar = $mensaje->ejecutarConsulta($sql, $datos);

    if ($insertar) {
        $sessData['estado']['type'] = 'success';
        $sessData['estado']['msg'] = 'Se envio correctamente.';
    } else {
        $sessData['estado']['type'] = 'error';
        $sessData['estado']['msg'] = 'No se pudo enviar.';
    }

    echo json_encode($sessData);
    break;


    case 'mensajeusuario0':
    $sql2 = "SELECT * FROM mensaje where usu_id = '$idUsuario' AND men_tipo = '0'";
    $consulta2 = $mensaje->ejecutarConsultaTodasFilas($sql2, $datos);
    $estado = '';

    // men_tipo = '0' //cuando es 0 es porque el usuario es el que envio el mensaje
    // men_tipo = '1' //cuando es 0 es porque el usuario es el que recibe el mensaje
    if ($consulta2) {
     // men_id  men_asunto  men_descripcion men_archivo men_creado  men_actualizado men_estado  men_tipo    usu_id

        foreach ($consulta2 as $row) {

            switch ($row->men_estado) {
                case '0':
                $estado = '<p class="text-center bg-warning">Sin leer</p>';
                break;
                case '1':
                $estado = '<p class="text-center bg-success">Leído</p>';
                break;
                default:
                break;
            }
            $data[] = array(
                "0" => '<p>' . $row->men_id . '</p>',
                "1" => '<span class="amount">' . $row->men_asunto . '</span>',
                "2" => '<span class="amount">' . $row->men_creado . '</span>',
                "3" => $estado,
                "4" => '<div class="text-center">
                <p class="atb-3d-d atb-large atb-round atb-success" onclick="detallesmensaje(\'' . $row->men_id . '\')" data-toggle="modal" data-target="#detallesmensajeModal">+ Detalles</p>
                </div>',

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

    case 'mensajeusuario1':
    $sql2 = "SELECT * FROM mensaje where usu_id = '$idUsuario' AND men_tipo = '1'";
    $consulta2 = $mensaje->ejecutarConsultaTodasFilas($sql2, $datos);
    $estado = '';

    // men_tipo = '0' //cuando es 0 es porque el usuario es el que envio el mensaje
    // men_tipo = '1' //cuando es 0 es porque el usuario es el que recibe el mensaje
    if ($consulta2) {
     // men_id  men_asunto  men_descripcion men_archivo men_creado  men_actualizado men_estado  men_tipo    usu_id

        foreach ($consulta2 as $row) {

            switch ($row->men_estado) {
                case '0':
                $estado = '<p class="text-center bg-warning">Sin leer</p>';
                break;
                case '1':
                $estado = '<p class="text-center bg-success">Leído</p>';
                break;
                default:
                break;
            }
            $data[] = array(
                "0" => '<p>' . $row->men_id . '</p>',
                "1" => '<span class="amount">' . $row->men_asunto . '</span>',
                "2" => '<span class="amount">' . $row->men_creado . '</span>',
                "3" => $estado,
                "4" => '<div class="text-center">
                <p class="atb-3d-d atb-large atb-round atb-success" onclick="detallesmensaje(\'' . $row->men_id . '\')" data-toggle="modal" data-target="#detallesmensajeModal">+ Detalles</p>
                </div>',

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

    case 'detallesmensajeusuario':
    $sql2 = "SELECT * FROM mensaje where men_id = '$men_id'";
    $resultado = $mensaje->ejecutarConsultaSimpleFila($sql2,$datos);
    // men_id  men_asunto  men_descripcion men_archivo men_creado  men_actualizado men_estado  men_tipo    usu_id
    if ($resultado) {

        $foto = empty($resultado->men_archivo) ? '' : $resultado->men_archivo;
        $imagen = "<img src='SubidArchivos/archivos/mensajeUsuario/" . $foto . "' class='product__img' style='overflow: hidden;min-width: 70%;height: 300px; width: 70%; margin-rigth: 15%;'>";

        echo "<h1 class='text-center'>".$resultado->men_asunto."</h1>";
        echo "<p class='text-justify'>".$resultado->men_descripcion."</p>";
        if ($foto == '') {
        }else{
           echo $imagen;
       }
       echo '<a href="SubidArchivos/archivos/mensajeUsuario/'.$foto.'" download>
                <p class="atb-3d-d atb-large atb-round atb-success">Descargar foto del mensaje</p>
                </a>';
   }else{
       echo "<h1 class='text-center bg-danger'>No se encontro nada</h1>";
   }
   break;



   case 'cargarNotificaciones':
// Revisar aqui
   $sql1 = "UPDATE mensaje SET men_estado = '1' WHERE men_tipo = '0' AND men_estado = '0';"; 
   $consulta1 = $mensaje->ejecutarConsulta($sql1,$datos);
   $sql2 = "SELECT men.men_asunto, men.men_creado, usu.usu_nombre, usu.usu_imagen FROM mensaje men INNER JOIN usuario usu ON men.usu_id = usu.usu_id WHERE men.men_tipo = '0' ORDER BY men.men_id DESC limit 5;";
   $consulta2 = $mensaje->ejecutarConsultaTodasFilas($sql2,$datos);

   if ($consulta2) {
    echo '<li><div class="drop-title text-center">Mensajes</div></li>';
    foreach ($consulta2 as $row) {

        $fechaOriginal = $row->men_creado;
        $fechaFormateada = date("d-m-Y", strtotime($fechaOriginal));
        $mensajeformat = $mensaje->getSubString($row->men_asunto);
        $foto = empty($row->usu_imagen) ? '' : $row->usu_imagen;
// 
        echo '<li>
        <div class="message-center">
        <a href="javascript:void(0);">
        <div class="user-img">
        <img class="img-circle" src="SubidArchivos/archivos/fotosUsuario/' . $foto . '" alt="user">
        <span class="profile-status online pull-right"></span>
        </div>
        <div class="mail-contnet">
        <h5>'.$row->usu_nombre.'</h5>
        <span class="mail-desc">'.$mensajeformat.'</span>
        <span class="time">'.$fechaFormateada.'</span>
        </div>
        </a>

        </div>
        </li>';

    }
    echo '<li><a class="text-center" href="./mensaje"><strong>Mostrar todos los mensajes</strong><i class="fa fa-angle-right"></i></a></li>';
}else{
    echo "no hay nada";
}

break;

case 'cargarNotificacionesUsuario':
// Revisar aqui
$sql1 = "UPDATE mensaje SET men_estado = '1' WHERE usu_id = '$idUsuario' AND men_tipo = '1' AND men_estado = '0';"; 
$sql2 = "SELECT men.men_asunto, men.men_descripcion, men.men_creado, usu.usu_nombre, usu.usu_imagen FROM mensaje men INNER JOIN usuario usu ON men.usu_id = usu.usu_id WHERE men.usu_id = '$idUsuario' AND men.men_tipo = '1' ORDER BY men.men_id DESC limit 5;";

$consulta1 = $mensaje->ejecutarConsulta($sql1,$datos);
$consulta2 = $mensaje->ejecutarConsultaTodasFilas($sql2,$datos);

if ($consulta2) {
    echo '<li class="bg-success"><div class="drop-title text-center">Mensajes</div><hr></li>';
    foreach ($consulta2 as $row) {

        $fechaOriginal = $row->men_creado;
        $fechaFormateada = date("d-m-Y", strtotime($fechaOriginal));
        $asuntoformat = $mensaje->getSubString($row->men_asunto);
        $mensajeformat = $mensaje->getSubString($row->men_descripcion);
        $foto = empty($row->usu_imagen) ? '' : $row->usu_imagen;
// 
        echo '<li>
        <div class="message-center">
        <a href="javascript:void(0);">
        <div class="user-img">
        <h5 class="text-center">'.$asuntoformat.' <p>'.$fechaFormateada.'</p></h5>
        <p class="text-justify">'.$mensajeformat.'</p>
        </div>
        </a>



        </div>
        <hr>
        </li>';

    }
    echo '<li><a class="text-center" href="./mensaje"><strong>Mostrar todos los mensajes</strong><i class="fa fa-angle-right"></i></a></li>';
}else{
    echo "no hay nada";
}
break;


case 'mostrarCantidadNotificaciones':
$sql2 = "SELECT COUNT(*) total FROM mensaje WHERE men_estado = '0' AND men_tipo='0';";
$resultado = $mensaje->ejecutarConsultaSimpleFila($sql2,$datos);
    // men_id  men_asunto  men_descripcion men_archivo men_creado  men_actualizado men_estado  men_tipo    usu_id
if ($resultado) {
    echo $resultado->total;
}else{
    echo "0";
}
break;

case 'mostrarCantidadNotificacionesUsuario':
$sql2 = "SELECT COUNT(*) total FROM mensaje WHERE usu_id = '$idUsuario' AND men_estado = '0' AND men_tipo = '1'";
$resultado = $mensaje->ejecutarConsultaSimpleFila($sql2,$datos);
    // men_id  men_asunto  men_descripcion men_archivo men_creado  men_actualizado men_estado  men_tipo    usu_id
if ($resultado) {
    echo $resultado->total;
}else{
    echo "0";
}
break;

case 'mensajeusuarioadmin0':
$sql2 = "SELECT men.men_id, men.men_asunto, men.men_creado, men.men_estado, men.usu_id, usu.usu_nombre, usu.usu_imagen FROM mensaje men INNER JOIN usuario usu ON men.usu_id = usu.usu_id where men.men_tipo = '0'";
    $consulta2 = $mensaje->ejecutarConsultaTodasFilas($sql2, $datos);
    $estado = '';

    // men_tipo = '0' //cuando es 0 es porque el usuario es el que envio el mensaje
    // men_tipo = '1' //cuando es 0 es porque el usuario es el que recibe el mensaje
    if ($consulta2) {
// men_id  men_asunto  men_creado  men_estado  usu_nombre  usu_imagen  

        foreach ($consulta2 as $row) {
            $foto = empty($row->usu_imagen) ? '' : $row->usu_imagen;
            $fotocompleta = '<img src="SubidArchivos/archivos/fotosUsuario/' . $foto . '" alt="imagen" width="130">';

            switch ($row->men_estado) {
                case '0':
                $estado = '<p class="text-center bg-warning">Sin leer</p>';
                break;
                case '1':
                $estado = '<p class="text-center bg-success">Leído</p>';
                break;
                default:
                break;
            }
            $data[] = array(
                "0" => '<p>' . $row->men_id . '</p>',
                "1" => '<span class="amount">' . $row->usu_nombre . '</span>',
                "2" => '<span class="amount">' . $fotocompleta . '</span>',
                "3" => '<span class="amount">' . $row->men_asunto . '</span>',
                "4" => '<span class="amount">' . $row->men_creado . '</span>',
                "5" => $estado,
                "6" => '<div class="text-center">
                <p class="atb-3d-d atb-large atb-round atb-success" onclick="detallesmensaje(\'' . $row->men_id . '\')" data-toggle="modal" data-target="#detallesmensajeModal">+ Detalles</p>
                </div>
                <div class="text-center">
                <p class="atb-3d-d atb-large atb-round atb-warning" onclick="respondermensaje(\'' . $row->usu_id . '\')" data-toggle="modal" data-target="#enviarmensjaeModal">Responder</p>
                </div>',

            );
        }
    } else {
        $data[] = array(
            "0" => '', "1" => '', "2" => 'No hay nada', "3" => '',
            "4" => '',"5" => '', "6" => ''
        );
    }
    $datosnuevo = array('data' => $data);
    echo json_encode($datosnuevo);
    break;
case 'mensajeusuarioadmin1':
    $sql2 = "SELECT men.men_id, men.men_asunto, men.men_creado, men.men_estado, usu.usu_nombre, usu.usu_imagen FROM mensaje men INNER JOIN usuario usu ON men.usu_id = usu.usu_id where men.men_tipo = '1'";
    $consulta2 = $mensaje->ejecutarConsultaTodasFilas($sql2, $datos);
    $estado = '';

    // men_tipo = '0' //cuando es 0 es porque el usuario es el que envio el mensaje
    // men_tipo = '1' //cuando es 0 es porque el usuario es el que recibe el mensaje
    if ($consulta2) {
// men_id  men_asunto  men_creado  men_estado  usu_nombre  usu_imagen  

        foreach ($consulta2 as $row) {
            $foto = empty($row->usu_imagen) ? '' : $row->usu_imagen;
            $fotocompleta = '<img src="SubidArchivos/archivos/fotosUsuario/' . $foto . '" alt="imagen" width="130">';

            switch ($row->men_estado) {
                case '0':
                $estado = '<p class="text-center bg-warning">Sin leer</p>';
                break;
                case '1':
                $estado = '<p class="text-center bg-success">Leído</p>';
                break;
                default:
                break;
            }
            $data[] = array(
                "0" => '<p>' . $row->men_id . '</p>',
                "1" => '<span class="amount">' . $row->usu_nombre . '</span>',
                "2" => '<span class="amount">' . $fotocompleta . '</span>',
                "3" => '<span class="amount">' . $row->men_asunto . '</span>',
                "4" => '<span class="amount">' . $row->men_creado . '</span>',
                "5" => $estado,
                "6" => '<div class="text-center">
                <p class="atb-3d-d atb-large atb-round atb-success" onclick="detallesmensaje(\'' . $row->men_id . '\')" data-toggle="modal" data-target="#detallesmensajeModal">+ Detalles</p>
                </div>',

            );
        }
    } else {
        $data[] = array(
            "0" => '', "1" => '', "2" => 'No hay nada', "3" => '',
            "4" => '',"5" => '', "6" => ''
        );
    }
    $datosnuevo = array('data' => $data);
    echo json_encode($datosnuevo);
    break;

default:
break;
}
