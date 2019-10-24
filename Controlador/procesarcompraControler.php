<?php session_start();
error_reporting(-1);
require_once "../Modelo/procesarcompraModelo.php";

require '../Modelo/PHPMailer/src/Exception.php';
require '../Modelo/PHPMailer/src/PHPMailer.php';
require '../Modelo/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// Iniciamos la clase de la carta
$Limpiarvar = new Funciones();
$procesar = new ProcesarCompra;

//Datos de la session del usuario
$DataUsuario = isset($_SESSION['DatosUsuario']) ? $_SESSION['DatosUsuario'] : '';
$idUsuario = !empty($DataUsuario['usuario']['id']) ? $DataUsuario['usuario']['id'] : '';

//Datos de la compra
$idcompra = isset($_POST['idcompra']) ? $Limpiarvar->limpiar($_POST['idcompra'], '0') : '';

// Procesar el pago de la compra
$selectbanco = isset($_POST['selectbanco']) ? $Limpiarvar->limpiar($_POST['selectbanco'], '0') : '';
$idbancousuario = isset($_POST['idbancousuario']) ? $Limpiarvar->limpiar($_POST['idbancousuario'], '0') : '';
$referencia = isset($_POST['referencia']) ? $Limpiarvar->limpiar($_POST['referencia'], '0') : '';
$transferencia_usuario = isset($_POST['transferencia_usuario']) ? $Limpiarvar->limpiar($_POST['transferencia_usuario'], '0') : '';

$comprobante_id = isset($_POST['com_id']) ? $Limpiarvar->limpiar($_POST['com_id'], '0') : '';

$creado = date("Y-m-d H:i:s");


//Datos del carrito
$car_id = isset($_POST['car_id']) ? $Limpiarvar->limpiar($_POST['car_id'], '0') : '';


$datos = '';

$op = isset($_REQUEST['op']) ? $Limpiarvar->limpiar($_REQUEST['op'], '0') : '';
$data = array();

switch ($op) {
    case 'cancelarcompra':
        // Aqui elimino la compra
    $sql11 = "DELETE FROM transaccion WHERE transaccion.com_idcompra = '$idcompra';";
    $consulta1 = $procesar->ejecutarConsulta($sql11, $datos);

    $sql1 = "DELETE FROM carrito_compra WHERE carrito_compra.com_idprincipal = '$idcompra'";
    $consulta = $procesar->ejecutarConsulta($sql1, $datos);
    
    
    if ($consulta && $consulta1) {
        $sql2 = "DELETE FROM compra WHERE compra.com_id = '$idcompra'";
        $consulta2 = $procesar->ejecutarConsulta($sql2, $datos);
        if ($consulta2) {
            $sessData['estado']['type'] = 'success';
            $sessData['estado']['msg'] = 'Se elimino la compra correctamente.';
        } else {
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'No se pudo cancelar la compra.';
        }

    } else {
        $sessData['estado']['type'] = 'error';
        $sessData['estado']['msg'] = 'No se pudo cancelar la compra.';
    }
    echo json_encode($sessData);
    break;

    case 'eliminarproductocompra':
    $sql1 = "DELETE FROM carrito_compra WHERE carrito_compra.car_id = '$car_id'";
    $consulta = $procesar->ejecutarConsulta($sql1, $datos);
    if ($consulta) {
        $sessData['estado']['type'] = 'success';
        $sessData['estado']['msg'] = 'Se elimino el producto correctamente.';

    } else {
        $sessData['estado']['type'] = 'error';
        $sessData['estado']['msg'] = 'No se pudo eliminar el producto.';
    }
    echo json_encode($sessData);
    break;

    case 'mostrartodascompras':

    $sql2 = "SELECT * FROM compra where usu_id = '$idUsuario'";
    $consulta2 = $procesar->ejecutarConsultaTodasFilas($sql2, $datos);
    $estado = '';
    if ($consulta2) {
            // com_id	com_precio	com_cantidad	com_creado	com_actualizado	com_estado	usu_id
        foreach ($consulta2 as $row) {

            switch ($row->com_estado) {
                case '0':
                $estado = '<p class="text-center bg-warning">En proceso</p>';
                break;
                case '1':
                $estado = '<p class="text-center bg-success">Aprobado</p>';
                break;
                case '2':
                $estado = '<p class="text-center bg-danger">Rechazado</p>';
                break;
                default:
                break;
            }

            $data[] = array(
                "0" => '<p>' . $row->com_precio . ' Bs</p>',
                "1" => '<span class="amount">' . $row->com_cantidad . '</span>',
                "2" => '<span class="amount">' . $row->com_creado . '</span>',
                "3" => $estado,
                "4" => '<div class="text-center">
                <p class="atb-3d-d atb-large atb-round atb-success" onclick="detallescompra(\'' . $row->com_id . '\')" data-toggle="modal" data-target="#detallescompraModal">+ Detalles</p>
                <p class="atb-3d-d atb-large atb-round atb-danger" onclick="eliminarcompra(\'' . $row->com_id . '\')">Cancelar compra</p>
                <p class="atb-3d-d atb-large atb-round atb-warning"  data-toggle="modal" data-target="#procesarcompraModal" onclick="procesarpago(\'' . $row->com_id . '\')">Procesar pago de la compra</p>

                <a href="/Controlador/mostrarPdfControler.php?op=mostrardetallescomprasusuario&id='.$row->com_id.'" target="_blank">
                <p class="atb-3d-d atb-large atb-round atb-primary">Descargar comprobante de la compra</p>
                </a>


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

    case 'mostrartodascomprasusuarios':
    $sql2 = "SELECT * FROM compra";
    $consulta2 = $procesar->ejecutarConsultaTodasFilas($sql2, $datos);
    $estado = '';
    if ($consulta2) {
            // com_id   com_precio  com_cantidad    com_creado  com_actualizado com_estado  usu_id
        foreach ($consulta2 as $row) {

            switch ($row->com_estado) {
                case '0':
                $estado = '<p class="text-center bg-warning">En proceso</p>';
                $valorboton = '<p class="atb-3d-d atb-large atb-round atb-warning" onclick="rechazarcompra(\'' . $row->com_id . '\')">Rechazar compra <i class="fa fa-thumbs-o-down"></i></p><p class="atb-3d-d atb-large atb-round atb-success" onclick="aprobarcompra(\'' . $row->com_id . '\')">Aprobar compra <i class="fa fa-thumbs-o-up"></i></p>';
                break;
                case '1':
                $estado = '<p class="text-center bg-success">Aprobado</p>';
                $valorboton = '';
                break;
                case '2': 
                $estado = '<p class="text-center bg-danger">Rechazado</p>';
                $valorboton = '<p class="atb-3d-d atb-large atb-round atb-success" onclick="aprobarcompra(\'' . $row->com_id . '\')">Aprobar compra <i class="fa fa-thumbs-o-up"></i></p>';
                break;
                default:
                break;
            }

            $data[] = array(
                "0" => '<p>' . $row->com_precio . ' Bs</p>',
                "1" => '<span class="amount">' . $row->com_cantidad . '</span>',
                "2" => '<span class="amount">' . $row->com_creado . '</span>',
                "3" => $estado,
                "4" => '<div class="text-center">
                <p class="atb-3d-d atb-large atb-round atb-success" onclick="detallescomprausuarios(\'' . $row->com_id . '\')" data-toggle="modal" data-target="#detallescompraModalAdmin">+ Detalles</p>
                <a href="/Controlador/mostrarPdfControler.php?op=mostrardetallescomprasusuario&id='.$row->com_id.'" target="_blank">
                <p class="atb-3d-d atb-large atb-round atb-primary">Descargar comprobante de la compra <i class="fa fa-download"></i></p>
                </a>


                '.$valorboton.'



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


    case 'detallescompra':
        // Esto muestra los productos de la compra del usuario en un modal, donde podra eliminar productos
        // Esta es la consulta que me muestra el detalle completo de la compra del carrito con todos los producto en el modal
    $sql2 = "SELECT car.car_id, pro.pro_nombre, pro.pro_precio, pro.pro_imagen, car.car_cantidadproducto, car.car_precioproductototal FROM compra com INNER JOIN carrito_compra car ON car.com_idprincipal = com.com_id INNER JOIN producto pro ON car.pro_id = pro.pro_idproducto where com.com_id = '$idcompra'";
        // car_id    pro_nombre    pro_precio    pro_imagen    car_cantidadproducto    car_precioproductototal
    $consulta2 = $procesar->ejecutarConsultaTodasFilas($sql2, $datos);

    $sqlcompra = "SELECT tra.tra_creado, com.com_id, com.com_referencia, com.com_archivo, uba.uba_nombre, uba.uba_cedula, uba.uba_cuenta, ban.ban_nombre FROM transaccion tra INNER JOIN comprobante com ON tra.com_idcomprobante = com.com_id INNER JOIN usuario_banco uba ON com.uba_id = uba.uba_id INNER JOIN banco ban ON uba.ban_id = ban.ban_id WHERE tra.com_idcompra = '$idcompra';";

    $consultacompra = $procesar->ejecutarConsultaTodasFilas($sqlcompra, $datos);

    if ($consulta2) {
        echo '<section class="section-wrap cart pt-50 pb-40"><div class="container relative">
        <div class="table-wrap">
        <table class="shop_table cart table" style="width: 68%; max-width: 68%;">
        <thead>
        <tr>
        <th class="product-name">Producto</th>
        <th class="product-price">Precio</th>
        <th class="product-quantity">Cantidad</th>
        <th class="product-subtotal">Sub-Total</th>
        <th class="product-subtotal">Opción</th>
        </tr>
        </thead><tbody>';
        foreach ($consulta2 as $row) {
            echo '<tr class="cart_item">';
            $foto = empty($row->pro_imagen) ? '' : $row->pro_imagen;
            $imagen = "<img src='SubidArchivos/archivos/articulosUsuario/" . $foto . "' alt='' class='product__img'>";
                // echo $row->car_id;
            echo '
            <td class="product-thumbnail">
            <a href="#">
            ' . $imagen . '
            <p class="text-center">' . $row->pro_nombre . '</p>
            </a>
            </td>
            <td class="product-price">
            <span class="amount">' . $row->pro_precio . ' Bs</span>
            </td>
            <td class="product-price">
            <span class="amount">' . $row->car_cantidadproducto . '</span>
            </td>
            <td class="product-price">
            <span class="amount">' . $row->car_precioproductototal . ' Bs</span>
            </td>
            <td class="product-remove">
            <a href="#" class="remove" title="Eliminar producto" style="display: contents;" onclick="eliminarproductocompra(\'' . $row->car_id . '\')">
            <i class="ui-close"></i>
            </a>
            </td>';
            echo '</tr>';
        }
        echo '</tbody></table></div></div> <!-- end container --></section>';

// Aqui tengo que poner otro foreach mostrando los datos subidos en la tabla transacion
        /*Revisar aqui para las compras*/
        if ($consultacompra) {
            echo '<h1 class="text-center bg-success">Datos del pago</h1><div class="container-fluid">';
            foreach ($consultacompra as $rowcompra) {
    // tra_creado  com_id  com_referencia  com_archivo uba_nombre  uba_cedula  uba_cuenta  ban_nombre  
                $fotopago = empty($rowcompra->com_archivo) ? '' : $rowcompra->com_archivo;
                $imagenpago = "<img src='SubidArchivos/archivos/transferenciaUsuario/" . $fotopago . "' alt='' class='' style='width: 50%;height: 200px;margin-top: 20px;margin-bottom: 20px;border: 1px solid black;'>";

                echo '<div class="row text-center">
                <div class="row text-justify">
                <div class="col-sm-6">
                <span class="amount">Fecha de la transacción: ' . $rowcompra->tra_creado . '</span>
                </div>
                <div class="col-sm-6">
                <span class="amount">Referencia bancaria: ' . $rowcompra->com_referencia . '</span>
                </div>
                <div class="col-sm-6">
                <span class="amount">Transferencia realizada al: ' . $rowcompra->ban_nombre . '</span>
                </div>
                <div class="col-sm-6">
                <span class="amount">Nombre del titular de la cuenta: ' . $rowcompra->uba_nombre . '</span>
                </div>
                <div class="col-sm-6">
                <span class="amount">Cédula del titular de la cuenta: ' . $rowcompra->uba_cedula . '</span>
                </div>
                <div class="col-sm-6">
                <span class="amount">Número de cuenta: ' . $rowcompra->uba_cuenta . '</span>
                </div>
                </div>
                <p class="atb-3d-d atb-large atb-round atb-danger" onclick="eliminarcomprobante(\'' . $rowcompra->com_id . '\')">Eliminar comprobante de pago</p>
                
                <a href="SubidArchivos/archivos/transferenciaUsuario/'.$fotopago.'" download>
                <p class="atb-3d-d atb-large atb-round atb-success">Descargar comprobante de pago</p>
                </a>
                <div class="col-sm-12">
                '.$imagenpago.'
                </div>

                
                </div><hr>';
            }

        }else{
            echo '<section><h1 class="bg-danger text-center"> ¡Error! No has pagado todavia</h1></section>';
        }
    } else {
        echo "<h1 class='bg-danger'>No hay nada</h1>";
    }
    break;




    case 'detallescomprausuarios':
        // Esto muestra los productos de la compra del usuario en un modal, donde podra eliminar productos
        // Esta es la consulta que me muestra el detalle completo de la compra del carrito con todos los producto en el modal
    $sql2 = "SELECT car.car_id, pro.pro_nombre, pro.pro_precio, pro.pro_imagen, car.car_cantidadproducto, car.car_precioproductototal FROM compra com INNER JOIN carrito_compra car ON car.com_idprincipal = com.com_id INNER JOIN producto pro ON car.pro_id = pro.pro_idproducto where com.com_id = '$idcompra'";
        // car_id    pro_nombre    pro_precio    pro_imagen    car_cantidadproducto    car_precioproductototal
    $consulta2 = $procesar->ejecutarConsultaTodasFilas($sql2, $datos);

    $sqlcompra = "SELECT tra.tra_creado, com.com_id, com.com_referencia, com.com_archivo, uba.uba_nombre, uba.uba_cedula, uba.uba_cuenta, ban.ban_nombre FROM transaccion tra INNER JOIN comprobante com ON tra.com_idcomprobante = com.com_id INNER JOIN usuario_banco uba ON com.uba_id = uba.uba_id INNER JOIN banco ban ON uba.ban_id = ban.ban_id WHERE tra.com_idcompra = '$idcompra';";

    $consultacompra = $procesar->ejecutarConsultaTodasFilas($sqlcompra, $datos);

    if ($consulta2) {
        echo '<section class="section-wrap cart pt-50 pb-40">

        <div class="container-fluid">
        <div class="row bg-info text-center">

        <div class="col-sm-3">
        Producto
        </div>
        <div class="col-sm-2">
        Precio
        </div>
        <div class="col-sm-2">
        Cantidad
        </div>
        <div class="col-sm-2">
        Sub-Total
        </div>

        <div class="col-sm-3">
        Imagen
        </div>

        </div>
        </div>
</section>
<section class="section-wrap cart pt-50 pb-40">
<div class="container-fluid">
        <div class="row text-justify">';
        foreach ($consulta2 as $row) {
            $foto = empty($row->pro_imagen) ? '' : $row->pro_imagen;
            $imagen = "<img src='SubidArchivos/archivos/articulosUsuario/" . $foto . "' style='width: 190px;height: 130px;'>";
            
            // echo $row->car_id;
            echo '<div class="col-sm-3">
            <p>' . $row->pro_nombre . '</p>
            </div>
            <div class="col-sm-2">
            <p>' . $row->pro_precio . ' Bs</p>
            </div>
            <div class="col-sm-2">
            <p>' . $row->car_cantidadproducto . '</p>
            </div>
            <div class="col-sm-2">
            <p>' . $row->car_precioproductototal . ' Bs</p>
            </div>
        <div class="col-sm-3">
        ' . $imagen . '
        </div>
            ';

        }
        echo '</div></div></section>';

// Aqui tengo que poner otro foreach mostrando los datos subidos en la tabla transacion
        /*Revisar aqui para las compras*/
        if ($consultacompra) {
            echo '<h1 class="text-center bg-success">Datos del pago</h1><div class="container-fluid">';
            foreach ($consultacompra as $rowcompra) {
    // tra_creado  com_id  com_referencia  com_archivo uba_nombre  uba_cedula  uba_cuenta  ban_nombre  
                $fotopago = empty($rowcompra->com_archivo) ? '' : $rowcompra->com_archivo;
                $imagenpago = "<img src='SubidArchivos/archivos/transferenciaUsuario/" . $fotopago . "' alt='' class='' style='width: 50%;height: 200px;margin-top: 20px;margin-bottom: 20px;border: 1px solid black;'>";

                echo '<div class="row text-center">
                <div class="row text-justify">
                <div class="col-sm-6">
                <span class="amount">Fecha de la transacción: ' . $rowcompra->tra_creado . '</span>
                </div>
                <div class="col-sm-6">
                <span class="amount">Referencia bancaria: ' . $rowcompra->com_referencia . '</span>
                </div>
                <div class="col-sm-6">
                <span class="amount">Transferencia realizada al: ' . $rowcompra->ban_nombre . '</span>
                </div>
                <div class="col-sm-6">
                <span class="amount">Nombre del titular de la cuenta: ' . $rowcompra->uba_nombre . '</span>
                </div>
                <div class="col-sm-6">
                <span class="amount">Cédula del titular de la cuenta: ' . $rowcompra->uba_cedula . '</span>
                </div>
                <div class="col-sm-6">
                <span class="amount">Número de cuenta: ' . $rowcompra->uba_cuenta . '</span>
                </div>
                <div class="col-sm-12 text-center">
                <a href="SubidArchivos/archivos/transferenciaUsuario/'.$fotopago.'" download>
                <p class="atb-3d-d atb-large atb-round atb-success">Descargar comprobante de pago</p>
                </a>
                </div>
                </div>
                <div class="col-sm-12">
                '.$imagenpago.'
                </div>

                
                </div><hr>';
            }

        }else{
            echo '<section><h1 class="bg-danger text-center"> ¡Error! El usuario no ha pagado todavia</h1></section>';
        }
    } else {
        echo "<h1 class='bg-danger'>No hay nada</h1>";
    }
    break;

    case "revisarbanco":
    $sql = "SELECT ban_id, ban_nombre FROM banco";
    $idbanco = "ban_id";
    $nombrecampo = "ban_nombre";
    // echo "<option disabled selected>Selecciona el banco</option>";
    echo "<option selected hidden>Selecciona el banco</option>";
    $Limpiarvar->combosSelect($sql, $idbanco, $nombrecampo);
    break;


    case 'mostrarbancousuario':
    $sql = "SELECT * FROM usuario_banco WHERE ban_id = '$selectbanco' ";
    // uba_id  uba_nombre  uba_cedula  uba_cuenta  uba_tipocuenta  ban_id 
    $consulta2 = $procesar->ejecutarConsultaSimpleFila($sql, $datos);
    
    if ($consulta2) {
        $sessData['valorid'] = $consulta2->uba_id;
        $sessData['msg'] = "
        <div class='bg-success'>
        <h1 class='text-center'> ¡Datos de la cuenta! </h1>
        <hr>
        <p class='text-center'>Nombre del titular de la cuenta: <span>".$consulta2->uba_nombre."</span></p>
        <p class='text-center'>Cédula del titular de la cuenta: <span>".$consulta2->uba_cedula."</span></p>
        <p class='text-center'>Número de la cuenta: <span>".$consulta2->uba_cuenta."</span></p>
        <hr>
        </div>
        ";

    } else {
        $sessData['valorid'] = '';
        $sessData['msg'] = "<h1 class='text-center bg-danger'> ¡No se encontro la cuenta del banco! </h1>";
    }
    echo json_encode($sessData);

    break;

    case 'completarpago':
        // $idcompra
    // $idbancousuario
    // $referencia
    // $transferencia_usuario
    if ($transferencia_usuario == '') {
        $sql1 = "INSERT INTO comprobante (com_id, com_tipo, com_referencia, com_archivo, uba_id) VALUES (NULL, NULL, '$referencia', NULL, '$idbancousuario');";
    }else{
        $sql1 = "INSERT INTO comprobante (com_id, com_tipo, com_referencia, com_archivo, uba_id) VALUES (NULL, NULL, '$referencia', '$transferencia_usuario', '$idbancousuario');";
    }

    $consulta = $procesar->ejecutarConsulta($sql1, $datos);

    if ($consulta) {
        $valoridretorno = $procesar->ejecutarConsulta_retornrID();
    // INSERT INTO transaccion (tra_id, tra_creado, tra_estado, com_idcompra, com_idcomprobante) VALUES (NULL, '2019-05-07 00:00:00', '0', '5', '1');
        $sql2 = "INSERT INTO transaccion (tra_id, tra_creado, tra_estado, com_idcompra, com_idcomprobante) VALUES (NULL, '$creado', '0', '$idcompra', '$valoridretorno');";
        $consulta2 = $procesar->ejecutarConsulta($sql2, $datos);

        if ($consulta2) {
            $sessData['estado']['type'] = 'success';
            $sessData['estado']['msg'] = 'Se guardaron los datos.';
        } else {
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'No se pudieron guardar los datos.';
        }
    } else {
        $sessData['estado']['type'] = 'error';
        $sessData['estado']['msg'] = 'No se pudieron guardar los datos.';
    }
    echo json_encode($sessData);
    break;

    case 'eliminarcomprobante':

    $sql1 = "DELETE FROM transaccion WHERE transaccion.com_idcomprobante = '$comprobante_id';";
    $consulta = $procesar->ejecutarConsulta($sql1, $datos);

    if ($consulta) {
        $sessData['estado']['type'] = 'success';
        $sessData['estado']['msg'] = 'Se elimino el comprobante de pago correctamente.';
    } else {
        $sessData['estado']['type'] = 'error';
        $sessData['estado']['msg'] = 'No se pudo eliminar el comprobante.';
    }
    echo json_encode($sessData);
    break;

    case 'aprobarcompra':
    $mail = new PHPMailer();
    $sql1 = "UPDATE compra SET com_estado = '1' WHERE compra.com_id = '$comprobante_id';";
    $consulta = $procesar->ejecutarConsulta($sql1, $datos);

    $sql22 = "SELECT com.com_precio, com.com_cantidad, usu.usu_nombre, usu.usu_correo FROM compra com INNER JOIN usuario usu ON com.usu_id = usu.usu_id WHERE com.com_id = '$comprobante_id';";
    $consulta2 = $procesar->ejecutarConsultaSimpleFila($sql22, $datos);
    

    if ($consulta && $consulta2) {
    $compraprecio = $consulta2->com_precio;
    $compracorreo = $consulta2->usu_correo;
    $compranombre = $consulta2->usu_nombre;

try {
                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                $mail->CharSet = "UTF-8";
                // $mail->SMTPDebug = 1; //Esto me muestra los errores del correo
                $mail->IsHTML(true); // El correo se envía como HTML
                $mail->Host = 'smtp.gmail.com'; // SMTP a utilizar. Por ej. smtp.elserver.com
                $mail->SMTPSecure = 'ssl';
                $mail->Username = 'queseraylacteos@gmail.com'; // Correo completo a utilizar
                $mail->Password = 'losllanos'; // Contraseña
                $mail->Port = 465; // Puerto a utilizar
                $mail->From = 'queseraylacteos@gmail.com'; // Desde donde enviamos (Para mostrar)
                $mail->FromName = 'Quesera y Lacteos los Llanos';
                $mail->SetLanguage('es', '../Modelo/PHPMailer/language/');
                // Aqui actualizo el estado del usuario a 0, ya que va a estar desactivado hasta que se reinicie la contraseña
                // if($update){
                // Esta url cambiara cuando se suba a internet:
                $mail->AddAddress($compracorreo); // Esta es la dirección a donde enviamos
                $mail->Subject = 'Solicitud de compra'; // Este es el titulo del email.
                $body = 'Estimado ' . $compranombre;
                $body .= ',<br/>Recientemente se aprobo su compra con el identificador: '.$comprobante_id;
                $body .= '<br/>Con un precio total de: '.$compraprecio;
                $body .= '<br/><br/>Saludos,<br/>Quesera y Lácteos los Llanos';
                $mail->Body = $body; // Mensaje a enviar 

                // $mail->AddAttachment("imagenes/imagen.jpg", "imagen.jpg");  //Esto es para enviar imagenes o otro tipo de archivo
                $enviar = $mail->Send(); // Envía el correo.
                $intentos = 1;
                // Aqui hago 5 intentos hasta que se pueda enviar el email, de lo contrario me mostrara el error
                while ((!$enviar) && ($intentos < 5) && ($mail->ErrorInfo != "Error SMTP: Datos no aceptados.")) {
                    // sleep(3);
                    $enviar = $mail->Send();
                    $intentos = $intentos + 1;
                }
                // El problema se encuentra en la UNELLEZ, problema resuelto
                if (!$enviar) {
                    $sessData['estado']['type'] = 'error';
                    $sessData['estado']['msg'] = 'No se pudo enviar el correo de la aprobación de la compra, debido a:' . $mail->ErrorInfo;
                } else {
                        $sessData['estado']['type'] = 'success';
                        $sessData['estado']['msg'] = 'Se aprobo la compra.';
                }
                $mail->ClearAddresses();
            } catch (Exception $e) {
                $sessData['estado']['type'] = 'error';
                $sessData['estado']['msg'] = 'No se pudo enviar el correo de la aprobación de la compra, debido a:' . $mail->ErrorInfo;
            }

    } else {
        $sessData['estado']['type'] = 'error';
        $sessData['estado']['msg'] = 'No se pudo aprobar.';
    }
    echo json_encode($sessData);
    break;     

    case 'rechazarcompra':



    $mail = new PHPMailer();
    $sql1 = "UPDATE compra SET com_estado = '2' WHERE compra.com_id = '$comprobante_id';";
    $consulta = $procesar->ejecutarConsulta($sql1, $datos);

    $sql22 = "SELECT com.com_precio, com.com_cantidad, usu.usu_nombre, usu.usu_correo FROM compra com INNER JOIN usuario usu ON com.usu_id = usu.usu_id WHERE com.com_id = '$comprobante_id';";
    $consulta2 = $procesar->ejecutarConsultaSimpleFila($sql22, $datos);
    

    if ($consulta && $consulta2) {
    $compraprecio = $consulta2->com_precio;
    $compracorreo = $consulta2->usu_correo;
    $compranombre = $consulta2->usu_nombre;

try {
                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                $mail->CharSet = "UTF-8";
                // $mail->SMTPDebug = 1; //Esto me muestra los errores del correo
                $mail->IsHTML(true); // El correo se envía como HTML
                $mail->Host = 'smtp.gmail.com'; // SMTP a utilizar. Por ej. smtp.elserver.com
                $mail->SMTPSecure = 'ssl';
                $mail->Username = 'queseraylacteos@gmail.com'; // Correo completo a utilizar
                $mail->Password = 'losllanos'; // Contraseña
                $mail->Port = 465; // Puerto a utilizar
                $mail->From = 'queseraylacteos@gmail.com'; // Desde donde enviamos (Para mostrar)
                $mail->FromName = 'Quesera y Lacteos los Llanos';
                $mail->SetLanguage('es', '../Modelo/PHPMailer/language/');
                // Aqui actualizo el estado del usuario a 0, ya que va a estar desactivado hasta que se reinicie la contraseña
                // if($update){
                // Esta url cambiara cuando se suba a internet:
                $mail->AddAddress($compracorreo); // Esta es la dirección a donde enviamos
                $mail->Subject = 'Solicitud de compra'; // Este es el titulo del email.
                $body = 'Estimado ' . $compranombre;
                $body .= ',<br/>Recientemente se rechazo su compra con el identificador: '.$comprobante_id;
                $body .= '<br/>Con un precio total de: '.$compraprecio;
                $body .= '<br/><br/>Saludos,<br/>Quesera y Lácteos los Llanos';
                $mail->Body = $body; // Mensaje a enviar 

                // $mail->AddAttachment("imagenes/imagen.jpg", "imagen.jpg");  //Esto es para enviar imagenes o otro tipo de archivo
                $enviar = $mail->Send(); // Envía el correo.
                $intentos = 1;
                // Aqui hago 5 intentos hasta que se pueda enviar el email, de lo contrario me mostrara el error
                while ((!$enviar) && ($intentos < 5) && ($mail->ErrorInfo != "Error SMTP: Datos no aceptados.")) {
                    // sleep(3);
                    $enviar = $mail->Send();
                    $intentos = $intentos + 1;
                }
                // El problema se encuentra en la UNELLEZ, problema resuelto

                if (!$enviar) {
                    $sessData['estado']['type'] = 'error';
                    $sessData['estado']['msg'] = 'No se pudo enviar el correo de la aprobación de la compra, debido a:' . $mail->ErrorInfo;
                } else {
        $sessData['estado']['type'] = 'success';
        $sessData['estado']['msg'] = 'Se rechazo la compra.';
                }
                $mail->ClearAddresses();
            } catch (Exception $e) {
                $sessData['estado']['type'] = 'error';
                $sessData['estado']['msg'] = 'No se pudo enviar el correo de la aprobación de la compra, debido a:' . $mail->ErrorInfo;
            }

    } else {
        $sessData['estado']['type'] = 'error';
        $sessData['estado']['msg'] = 'No se pudo aprobar.';
    }

    echo json_encode($sessData);
    break;


    default:
    break;
}
