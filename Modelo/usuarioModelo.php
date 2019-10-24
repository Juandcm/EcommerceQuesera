<?php
require_once "Funciones.php";

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Usuario extends Funciones
{
    // Inicio del registro del usuario
    public function RegistrarUsuario($creado, $user_login, $user_email, $user_password, $user_telefono, $foto_usuario)
    {
        if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'El correo no es valido';
        } else {
            // Aqui verifico de que el correo no este dentro del sistema
            $sql = "SELECT usu_correo FROM usuario WHERE usu_correo='$user_email' LIMIT 1";
            $datos = '';
            $prevUser = self::ejecutarConsultaSimpleFila($sql, $datos);
            if ($prevUser) {
                $sessData['estado']['type'] = 'error';
                $sessData['estado']['msg'] = 'Email existe, Por favor ingrese otro email.';
            } else {
                // En este caso, queremos aumentar el coste predeterminado de BCRYPT a 12.
                // Observe que también cambiamos a BCRYPT, que tendrá siempre 60 caracteres.
                $opciones = ['cost' => 12];
                $contrasenaFinal = password_hash($user_password, PASSWORD_BCRYPT, $opciones);
                // Aqui registro al usuario en el sistema
                $sql = "INSERT INTO usuario (usu_id, usu_nombre, usu_correo, usu_telefono, usu_password, usu_olvido_password, usu_imagen, usu_creado, usu_actualizado, usu_estado, usu_permiso) VALUES (NULL, '$user_login', '$user_email', '$user_telefono', '$contrasenaFinal', '', '$foto_usuario', '$creado', NULL, '1', '0');";

                $consulta = self::ejecutarConsulta($sql, $datos);

                if ($consulta) {
                    $sessData['estado']['type'] = 'success';
                    $sessData['estado']['msg'] = 'Te registraste exitosamente, inicia sesión con tus credenciales.';
                } else {
                    $sessData['estado']['type'] = 'error';
                    $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
                }
            }
        }
        echo json_encode($sessData);
    }
    // Fin del registro del usuario

    // Inicio de la entrada a la tienda
    public function EntrarUsuario($user_login_correo, $user_login_contraseña, $rememberme)
    {
        if (!filter_var($user_login_correo, FILTER_VALIDATE_EMAIL)) {
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'El correo no es valido';
        } else {
            // Aqui verifico si el usuario esta activo en el sistema
            $sql = "SELECT usu_id, usu_nombre, usu_correo, usu_telefono, usu_password, usu_imagen, usu_creado, usu_actualizado, usu_permiso, usu_estado FROM usuario WHERE usu_correo='$user_login_correo' LIMIT 1";
            $datos = '';
            $prevUser = self::ejecutarConsultaSimpleFila($sql, $datos);

            // // Aqui verifico si el usuario esta inactivo en el sistema
            // $sql2 = "SELECT usu_correo FROM usuario WHERE usu_correo='$user_login_correo' AND usu_estado='0'";
            // $prevUser2 = self::ejecutarConsultaSimpleFila($sql2, $datos);

            //Aqui verifico solo el correo
            // $sql3 = "SELECT usu_correo FROM usuario WHERE usu_correo='$user_login_correo' LIMIT 1";
            // $prevUser3 = self::ejecutarConsultaSimpleFila($sql3, $datos);

            if ($prevUser) {
if ($prevUser->usu_estado == '0') {
                $sessData['estado']['type'] = 'error';
                $sessData['estado']['msg'] = 'No puedes entrar ya que estas desactivado, revisa tu correo para poder entrar a la página web';
}else{
            if (password_verify($user_login_contraseña, $prevUser->usu_password)) {
                    $sessData['estado']['type'] = 'success';
                    $sessData['estado']['msg'] = 'Bienvenido ' . $prevUser->usu_nombre;
                    // // Aqui asigno la id del usuario a la session
                    $sessionUsuario['usuario']['id'] = $prevUser->usu_id;
                    $sessionUsuario['usuario']['nombre'] = $prevUser->usu_nombre;
                    $sessionUsuario['usuario']['email'] = $prevUser->usu_correo;
                    $sessionUsuario['usuario']['telefono'] = $prevUser->usu_telefono;
                    $sessionUsuario['usuario']['foto_usuario'] = $prevUser->usu_imagen;
                    $sessionUsuario['usuario']['permiso'] = $prevUser->usu_permiso;
                    $sessionUsuario['usuario']['creado'] = $prevUser->usu_creado;
                    $sessionUsuario['usuario']['actualizado'] = $prevUser->usu_actualizado;
                    $_SESSION['DatosUsuario'] = $sessionUsuario;
                }else{
                    $sessData['estado']['type'] = 'error';
                    $sessData['estado']['msg'] = 'La contraseña no es correcta.';  
                }    
        }
            }else{
                    $sessData['estado']['type'] = 'error';
                    $sessData['estado']['msg'] = 'El Email que ingreso no se encuentra en el sistema, por favor ingrese el correo correctamente';
            }


            
        }
        echo json_encode($sessData);
    }
    // Fin de la entrada a la tienda

    public function EditarUsuario($idUsuario, $user_editar, $user_email_editar, $user_telefono_editar, $user_password_editar, $foto_usuario, $permiso, $fechaOriginal, $creado, $foto_usuario_sesion, $idusuarioadmin)
    {
        // $idUsuario, $user_editar, $user_email_editar, $user_telefono_editar, $user_password_editar, $foto_usuario, $foto_usuario_sesion

        // En este caso, queremos aumentar el coste predeterminado de BCRYPT a 12.
        // Observe que también cambiamos a BCRYPT, que tendrá siempre 60 caracteres.
        $opciones = ['cost' => 12];
        $contrasenaFinal = password_hash($user_password_editar, PASSWORD_BCRYPT, $opciones);
        $datos = '';

        // Aqui verifico de que el correo no este dentro del sistema
        $sqlCorreo = "SELECT usu_id FROM usuario WHERE usu_correo='$user_email_editar'";
        $revisarCorreo = self::ejecutarConsultaSimpleFila($sqlCorreo, $datos);

$valorid='';
if($idusuarioadmin == ''){
    $valorid="usu_id = '$idUsuario'";
}else{
    $valorid="usu_id = '$idusuarioadmin'";
}


        if ($revisarCorreo) {
            $idRevisar = $revisarCorreo->usu_id;
            if ($idUsuario == $idRevisar) {

                // Actualizando el usuario

                if ($foto_usuario == '') {
                    if ($user_password_editar == '') {
                        $sql2 = "UPDATE usuario SET usu_nombre='$user_editar', usu_correo='$user_email_editar', usu_telefono='$user_telefono_editar', usu_actualizado='$creado' WHERE ".$valorid;
                    } else {
                        $sql2 = "UPDATE usuario SET usu_nombre='$user_editar', usu_correo='$user_email_editar', usu_telefono='$user_telefono_editar', usu_password='$contrasenaFinal', usu_actualizado='$creado' WHERE ".$valorid;
                    }
                } else {
                    if ($user_password_editar == '') {
                        $sql2 = "UPDATE usuario SET usu_nombre='$user_editar', usu_correo='$user_email_editar', usu_telefono='$user_telefono_editar', usu_imagen='$foto_usuario', usu_actualizado='$creado' WHERE ".$valorid;
                    } else {
                        $sql2 = "UPDATE usuario SET usu_nombre='$user_editar', usu_correo='$user_email_editar', usu_telefono='$user_telefono_editar', usu_password='$contrasenaFinal', usu_imagen='$foto_usuario', usu_actualizado='$creado' WHERE ".$valorid;
                    }
                }

                $insert = self::ejecutarConsulta($sql2, $datos);
                if ($insert) {
                    // Aqui asigno la id del usuario a la session
                    $sessionUsuario['usuario']['id'] = $idUsuario;
                    $sessionUsuario['usuario']['nombre'] = $user_editar;
                    $sessionUsuario['usuario']['email'] = $user_email_editar;
                    $sessionUsuario['usuario']['telefono'] = $user_telefono_editar;

                    if ($foto_usuario == '') {
                        $sessionUsuario['usuario']['foto_usuario'] = $foto_usuario_sesion;
                    } else {
                        $sessionUsuario['usuario']['foto_usuario'] = $foto_usuario;
                    }

                    // Revisar aqui
                    $sessionUsuario['usuario']['permiso'] = $permiso;
                    $sessionUsuario['usuario']['creado'] = $fechaOriginal;
                    $sessionUsuario['usuario']['actualizado'] = $creado;
                    $_SESSION['DatosUsuario'] = $sessionUsuario;
                    // $idUsuario, $user_editar, $user_email_editar, $user_telefono_editar, $user_password_editar, $foto_usuario,

                    $sessData['estado']['type'] = 'success';
                    $sessData['estado']['msg'] = 'Se actualizo el usuario.';
                } else {
                    $sessData['estado']['type'] = 'error';
                    $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
                }
            } else {
                $sessData['estado']['type'] = 'error';
                $sessData['estado']['msg'] = 'Este email ya esta en uso en el sistema por favor ingresa otro email.';
            }
        } else {


            //             // Actualizando el usuario
            if ($foto_usuario == '') {
                if ($user_password_editar == '') {
                    $sql2 = "UPDATE usuario SET usu_nombre='$user_editar', usu_correo='$user_email_editar', usu_telefono='$user_telefono_editar', usu_actualizado='$creado' WHERE ".$valorid;
                } else {
                    $sql2 = "UPDATE usuario SET usu_nombre='$user_editar', usu_correo='$user_email_editar', usu_telefono='$user_telefono_editar', usu_password='$contrasenaFinal', usu_actualizado='$creado' WHERE ".$valorid;
                }
            } else {
                if ($user_password_editar == '') {
                    $sql2 = "UPDATE usuario SET usu_nombre='$user_editar', usu_correo='$user_email_editar', usu_telefono='$user_telefono_editar', usu_imagen='$foto_usuario', usu_actualizado='$creado' WHERE ".$valorid;
                } else {
                    $sql2 = "UPDATE usuario SET usu_nombre='$user_editar', usu_correo='$user_email_editar', usu_telefono='$user_telefono_editar', usu_password='$contrasenaFinal', usu_imagen='$foto_usuario', usu_actualizado='$creado' WHERE ".$valorid;
                }
            }

            $insert = self::ejecutarConsulta($sql2, $datos);
            if ($insert) {
                // Aqui asigno la id del usuario a la session
                $sessionUsuario['usuario']['id'] = $idUsuario;
                $sessionUsuario['usuario']['nombre'] = $user_editar;
                $sessionUsuario['usuario']['email'] = $user_email_editar;
                $sessionUsuario['usuario']['telefono'] = $user_telefono_editar;
                if ($foto_usuario == '') {
                    $sessionUsuario['usuario']['foto_usuario'] = $foto_usuario_sesion;
                } else {
                    $sessionUsuario['usuario']['foto_usuario'] = $foto_usuario;
                }

                // Revisar aqui
                $sessionUsuario['usuario']['permiso'] = $permiso;
                $sessionUsuario['usuario']['creado'] = $fechaOriginal;
                $sessionUsuario['usuario']['actualizado'] = $creado;
                $_SESSION['DatosUsuario'] = $sessionUsuario;

                $sessData['estado']['type'] = 'success';
                $sessData['estado']['msg'] = 'Se actualizo el usuario.';
            } else {
                $sessData['estado']['type'] = 'error';
                $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
            }
        }

        echo json_encode($sessData);
    }

    public function usuariosen1()
    {
        $requestData = $_POST;
        $columns = array(
            0 => 'usu.usu_id',
            1 => 'usu.usu_nombre',
            2 => 'usu.usu_correo',
            3 => 'usu.usu_telefono',
            4 => 'usu.usu_imagen',
            5 => 'usu.usu_creado',
            6 => 'usu.usu_id',
        );
        $datos = '';
        // SELECT usu.usu_id, usu.usu_nombre, usu.usu_correo, usu.usu_telefono, usu.usu_imagen, usu.usu_creado FROM usuario usu WHERE usu.usu_estado = '1' 
        // inv_iden, usu_iden, inv_nomb, inv_desc, inv_prec, inv_fech, inv_foto, inv_cant, inv_esta
        // getting total number records without any search
        $sql1 = "SELECT COUNT(usu.usu_id) as totalcero FROM usuario usu WHERE usu.usu_estado = '1' ";
        $query = $this->ejecutarConsultaSimpleFila($sql1, $datos);
        // Revisar desde aqui
        if ($query) {
            $totalData = $query->totalcero;
        }
        $sql = "SELECT usu.usu_id, usu.usu_nombre, usu.usu_correo, usu.usu_telefono, usu.usu_imagen, usu.usu_creado FROM usuario usu WHERE usu.usu_estado = '1' ";
        // getting records as per search parameters
        if (isset($requestData['search']) && $requestData['search'] !== "") {   //name
            $sql .= " AND usu.usu_nombre LIKE '%" . addslashes($requestData['search']['value']) . "%' ";
        }
        // Revisar esto
        $query = $this->ejecutarConsultaCantidadRow($sql, $datos);
        $totalFiltered = $query;

        $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length
        $query = $this->ejecutarConsultaTodasFilas($sql, $datos);
        $data = array();

        if ($query) {
            foreach ($query as $row) {
                $fechaOriginal = $row->usu_creado;
                $fechaFormateada = date("d-m-Y", strtotime($fechaOriginal));
                $foto = empty($row->usu_imagen) ? '' : $row->usu_imagen;
                $data[] = array(
                    "0" => '<td>' . $row->usu_id . '</td>',
                    "1" => '<td>' . $row->usu_nombre . '</td>',
                    "2" => '<td>' . $row->usu_correo . '</td>',
                    "3" => '<td>' . $row->usu_telefono . '</td>',
                    "4" => '<td> <img src="SubidArchivos/archivos/fotosUsuario/' . $foto . '" alt="imagen" width="80"> </td>',
                    "5" => '<td>' . $fechaFormateada . '</td>',
                    "6" => '<td class="sorting_1">
            <a href="javascript:void(0)" class="text-inverse p-r-10" data-toggle="modal" title="" data-original-title="Editar" data-target="#usereditarModal" onclick="editarusuarioadmin(\'' . $row->usu_id . '\', \'' . $row->usu_nombre . '\', \'' . $row->usu_correo . '\', \'' . $row->usu_telefono . '\')">
                <i class="ti-marker-alt"></i>
            </a>
            <!--
            <a href="javascript:void(0)" class="text-inverse p-r-10" title="" data-toggle="tooltip" data-original-title="Eliminar" onclick="eliminarusuario(\'' . $row->usu_id . '\')">
                <i class="ti-trash"></i>
            </a>
            -->
            <a href="javascript:void(0)" class="text-inverse p-r-10" title="" data-toggle="tooltip" data-original-title="Desactivar" onclick="desactivarusuario(\'' . $row->usu_id . '\')">
                <i class="fa fa-thumbs-o-down"></i>
            </a>
        </td>'
                );
            }
        } else {
            $data[] = array(
                "0" => '', "1" => '', "2" => '', "3" => 'No hay nada',
                "4" => 'No hay nada', "5" => '', "6" => '', "7" => ''

            );
        }

        $json_data = array(
            "sEcho" => intval($requestData['draw']),  //Informacion para el datatables
            "iTotalRecords" => intval($totalData), //enviamos el total de registros al datatable 
            "iTotalDisplayRecords" => intval($totalFiltered), //enviamos el total registros a visualizar 
            "aaData" => $data
        );
        echo json_encode($json_data);  // send data as json format
    }


    public function usuariosen0()
    {
        $requestData = $_POST;
        $columns = array(
            0 => 'usu.usu_id',
            1 => 'usu.usu_nombre',
            2 => 'usu.usu_correo',
            3 => 'usu.usu_telefono',
            4 => 'usu.usu_imagen',
            5 => 'usu.usu_creado',
            6 => 'usu.usu_id',
        );
        $datos = '';
        // SELECT usu.usu_id, usu.usu_nombre, usu.usu_correo, usu.usu_telefono, usu.usu_imagen, usu.usu_creado FROM usuario usu WHERE usu.usu_estado = '1' 
        // inv_iden, usu_iden, inv_nomb, inv_desc, inv_prec, inv_fech, inv_foto, inv_cant, inv_esta
        // getting total number records without any search
        $sql1 = "SELECT COUNT(usu.usu_id) as totalcero FROM usuario usu WHERE usu.usu_estado = '0' ";
        $query = $this->ejecutarConsultaSimpleFila($sql1, $datos);
        // Revisar desde aqui
        if ($query) {
            $totalData = $query->totalcero;
        }
        $sql = "SELECT usu.usu_id, usu.usu_nombre, usu.usu_correo, usu.usu_telefono, usu.usu_imagen, usu.usu_creado FROM usuario usu WHERE usu.usu_estado = '0' ";
        // getting records as per search parameters
        if (isset($requestData['search']) && $requestData['search'] !== "") {   //name
            $sql .= " AND usu.usu_nombre LIKE '%" . addslashes($requestData['search']['value']) . "%' ";
        }
        // Revisar esto
        $query = $this->ejecutarConsultaCantidadRow($sql, $datos);
        $totalFiltered = $query;

        $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length
        $query = $this->ejecutarConsultaTodasFilas($sql, $datos);
        $data = array();

        if ($query) {
            foreach ($query as $row) {
                $fechaOriginal = $row->usu_creado;
                $fechaFormateada = date("d-m-Y", strtotime($fechaOriginal));
                $foto = empty($row->usu_imagen) ? '' : $row->usu_imagen;
                $data[] = array(
                    "0" => '<td>' . $row->usu_id . '</td>',
                    "1" => '<td>' . $row->usu_nombre . '</td>',
                    "2" => '<td>' . $row->usu_correo . '</td>',
                    "3" => '<td>' . $row->usu_telefono . '</td>',
                    "4" => '<td> <img src="SubidArchivos/archivos/fotosUsuario/' . $foto . '" alt="imagen" width="80"> </td>',
                    "5" => '<td>' . $fechaFormateada . '</td>',
                    "6" => '<td class="sorting_1">
<a href="javascript:void(0)" class="text-inverse p-r-10" data-toggle="modal" title="" data-original-title="Editar" data-target="#usereditarModal" onclick="editarusuarioadmin(\'' . $row->usu_id . '\', \'' . $row->usu_nombre . '\', \'' . $row->usu_correo . '\', \'' . $row->usu_telefono . '\')">
                <i class="ti-marker-alt"></i>
            </a>
            <!--
            <a href="javascript:void(0)" class="text-inverse p-r-10" title="" data-toggle="tooltip" data-original-title="Eliminar" onclick="eliminarusuario(\'' . $row->usu_id . '\')">
                <i class="ti-trash"></i>
            </a>
            -->

            <a href="javascript:void(0)" class="text-inverse p-r-10" title="" data-toggle="tooltip" data-original-title="Aprobar" onclick="activarusuario(\'' . $row->usu_id . '\')">
                <i class="fa fa-thumbs-o-up"></i>
            </a>
        </td>'
                );
            }
        } else {
            $data[] = array(
                "0" => '', "1" => '', "2" => '', "3" => 'No hay nada',
                "4" => 'No hay nada', "5" => '', "6" => '', "7" => ''

            );
        }

        $json_data = array(
            "sEcho" => intval($requestData['draw']),  //Informacion para el datatables
            "iTotalRecords" => intval($totalData), //enviamos el total de registros al datatable 
            "iTotalDisplayRecords" => intval($totalFiltered), //enviamos el total registros a visualizar 
            "aaData" => $data
        );
        echo json_encode($json_data);  // send data as json format
    }


    public function enviarcorreo($user_recordar_correo)
    {

        $mail = new PHPMailer();
        // Fechas
        $modificado = date("Y-m-d H:i:s");
        // Aqui verifico de que el correo este dentro del sistema
        $sql = "SELECT * FROM usuario WHERE usu_correo ='$user_recordar_correo'";
        $datos = '';
        $prevUser = self::ejecutarConsultaSimpleFila($sql, $datos);

        if ($prevUser) {
            $olvido_pass_iden = md5(uniqid(mt_rand()));
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
                $mail->SetLanguage('es', 'PHPMailer/language/');
                // Aqui actualizo el estado del usuario a 0, ya que va a estar desactivado hasta que se reinicie la contraseña
                $sql2 = "UPDATE usuario SET usu_olvido_password = '$olvido_pass_iden', usu_estado='0' WHERE usu_correo = '$user_recordar_correo'";
                // if($update){
                // Esta url cambiara cuando se suba a internet:
                $resetPassLink = 'https://localhost/restaurar/' . $olvido_pass_iden . '/';

                $mail->AddAddress($user_recordar_correo); // Esta es la dirección a donde enviamos
                $mail->Subject = 'Solicitud de actualización de contraseña'; // Este es el titulo del email.
                $body = 'Estimado ' . $prevUser->usu_nombre;
                $body .= ',<br/>Recientemente se envió una solicitud para restablecer una contraseña para su cuenta. Si esto fue un error, simplemente ignore este correo electrónico y no pasará nada. <br/>Para restablecer su contraseña, visite el siguiente enlace: ';
                $body .= '<a href="' . $resetPassLink . '">Restaurar contraseña</a>';
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

                // if ($mail->ErrorInfo=="Error SMTP: Datos no aceptados.") {
                // $update = self::ejecutarConsulta($sql2);
                // $enviar=true;
                // }   

                // El problema se encuentra en la UNELLEZ, problema resuelto
                if (!$enviar) {
                    $sessData['estado']['type'] = 'error';
                    $sessData['estado']['msg'] = 'No se pudo realizar la solicitud de reincio de contraseña, debido a: ' . $mail->ErrorInfo;
                } else {
                    $update = self::ejecutarConsulta($sql2, $datos);
                    if ($update) {
                        $sessData['estado']['type'] = 'success';
                        $sessData['estado']['msg'] = 'Solicitud de actualización de contraseña correcta, revisa el correo';
                    }
                }
                $mail->ClearAddresses();
            } catch (Exception $e) {
                $sessData['estado']['type'] = 'error';
                $sessData['estado']['msg'] = 'No se pudo realizar la solicitud de reincio de contraseña, debido a:' . $mail->ErrorInfo;
            }
        } else {
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'El correo electrónico dado no está asociado con ninguna cuenta.';
        }
        echo json_encode($sessData);
    }


    public function reenviarcontrasena(
        $codigorestaurar,
        $reenviarcontrasenanueva,
        $repitereenviarcontrasena
    ) {
 $datos = '';
        if(!empty($reenviarcontrasenanueva) && !empty($repitereenviarcontrasena) && !empty($codigorestaurar)){
            //password and confirm password comparison
            if($reenviarcontrasenanueva !==  $repitereenviarcontrasena){
                $sessData['estado']['type'] = 'error';
                $sessData['estado']['msg'] = 'Las contraseñas no coinciden.'; 
            }else{
    
            $sql5 = "SELECT usu_olvido_password FROM usuario WHERE usu_olvido_password='$codigorestaurar'";
            $prevUser = self::ejecutarConsultaSimpleFila($sql5,$datos);
    
            if($prevUser){
    
            $opciones = ['cost' => 12];
            $contrasenaFinal = password_hash($repitereenviarcontrasena, PASSWORD_BCRYPT, $opciones);
    
            $sql6 = "UPDATE usuario SET usu_password = '$contrasenaFinal', usu_olvido_password='', usu_estado ='1' WHERE usu_olvido_password = '$codigorestaurar'";
            $update = self::ejecutarConsulta($sql6,$datos);
                if($update){
                    $sessData['estado']['type'] = 'success';
                    $sessData['estado']['msg'] = 'La contraseña de su cuenta se ha restablecido con éxito. Por favor inicie sesión con su nueva contraseña.';
                }else{
                        $sessData['estado']['type'] = 'error';
                        $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
                }
    
            }else{
                    $sessData['estado']['type'] = 'error';
                    $sessData['estado']['msg'] = 'No está autorizado a restablecer una nueva contraseña de esta cuenta.';
                }
            }
        }else{
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'Todos los campos son obligatorios, por favor complete todos los campos.'; 
        }
    
    echo json_encode($sessData);
    }

    public function desactivarusuario($usu_id){
        $datos ="";
        $sql = "UPDATE usuario SET usu_estado = '0' WHERE usuario.usu_id = '$usu_id'";
        $update = self::ejecutarConsulta($sql,$datos);
        if($update){
            $sessData['estado']['type'] = 'success';
            $sessData['estado']['msg'] = 'Se desactivo el usuario.';
        }else{
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
        }
        echo json_encode($sessData);
    }

    public function activarusuario($usu_id){
        $datos ="";
        $sql = "UPDATE usuario SET usu_estado = '1' WHERE usuario.usu_id = '$usu_id'";
        $update = self::ejecutarConsulta($sql,$datos);
        if($update){
            $sessData['estado']['type'] = 'success';
            $sessData['estado']['msg'] = 'Se activo el usuario.';
        }else{
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
        }
        echo json_encode($sessData);
    }


    public function eliminarusuario($usu_id){
        // $datos ="";
        // $sql = "UPDATE usuario SET usu_estado = '1' WHERE usuario.usu_id = '$usu_id'";
        // $update = self::ejecutarConsulta($sql,$datos);
        // if($update){
            $sessData['estado']['type'] = 'success';
            $sessData['estado']['msg'] = 'Se activo el usuario.';
        // }else{
        //     $sessData['estado']['type'] = 'error';
        //     $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
        // }
        echo json_encode($sessData);
    }


}
