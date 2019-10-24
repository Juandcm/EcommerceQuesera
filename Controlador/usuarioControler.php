<?php session_start();
error_reporting(-1);
require_once "../Modelo/usuarioModelo.php";
$Limpiarvar = new Funciones();
$usu_normal = new Usuario();

// Sesion del usuario
$DataUsuario = isset($_SESSION['DatosUsuario']) ? $_SESSION['DatosUsuario'] : '';
$idUsuario = !empty($DataUsuario['usuario']['id']) ? $DataUsuario['usuario']['id'] : '';
$foto_usuario_sesion = !empty($DataUsuario['usuario']['foto_usuario']) ? $DataUsuario['usuario']['foto_usuario'] : '';
$permiso = isset($DataUsuario['usuario']['permiso']) ? $DataUsuario['usuario']['permiso'] : '';
$fechaOriginal = !empty($DataUsuario['usuario']['creado']) ? $DataUsuario['usuario']['creado'] : '';
// Fecha de creacion o modificacion
$creado = date("Y-m-d H:i:s");

// Datos de registro
$user_login = isset($_POST['user_login']) ? $Limpiarvar->limpiar($_POST['user_login'], '0') : '';
$user_email = isset($_POST['user_email']) ? $Limpiarvar->limpiar($_POST['user_email'], '1') : '';
$user_telefono = isset($_POST['user_telefono']) ? $Limpiarvar->limpiar($_POST['user_telefono'], '1') : '';
$user_password = isset($_POST['user_password']) ? $Limpiarvar->limpiar($_POST['user_password'], '0') : '';
$foto_usuario = isset($_POST['foto_usuario']) ? $Limpiarvar->limpiar($_POST['foto_usuario'], '0') : '';
//user-default.jpg es la imagen por defecto para utilizar en el usuario que no tenga foto

// Datos de entrada al sistema
$user_login_correo = isset($_POST['user_login_correo']) ? $Limpiarvar->limpiar($_POST['user_login_correo'], '1') : '';
$user_login_contraseña = isset($_POST['user_login_contraseña']) ? $Limpiarvar->limpiar($_POST['user_login_contraseña'], '0') : '';
$rememberme = isset($_POST['rememberme']) ? $Limpiarvar->limpiar($_POST['rememberme'], '1') : '';

// Recordar contraseña mediante el correo
$user_recordar_correo = isset($_POST['user_recordar_correo']) ? $Limpiarvar->limpiar($_POST['user_recordar_correo'], '0') : '';

// Datos de actualizacion
$user_editar = isset($_POST['user_editar']) ? $Limpiarvar->limpiar($_POST['user_editar'], '0') : '';
$user_email_editar = isset($_POST['user_email_editar']) ? $Limpiarvar->limpiar($_POST['user_email_editar'], '1') : '';
$user_telefono_editar = isset($_POST['user_telefono_editar']) ? $Limpiarvar->limpiar($_POST['user_telefono_editar'], '1') : '';
$user_password_editar = isset($_POST['user_password_editar']) ? $Limpiarvar->limpiar($_POST['user_password_editar'], '0') : '';
$idusuarioadmin = isset($_POST['idusuarioadmin']) ? $Limpiarvar->limpiar($_POST['idusuarioadmin'], '0') : '';

//Datos para el cambio de contraseña del usuairo
$codigorestaurar = isset($_POST['codigorestaurar']) ? $Limpiarvar->limpiar($_POST['codigorestaurar'], '0') : '';
$reenviarcontrasenanueva = isset($_POST['reenviarcontrasenanueva']) ? $Limpiarvar->limpiar($_POST['reenviarcontrasenanueva'], '0') : '';
$repitereenviarcontrasena = isset($_POST['repitereenviarcontrasena']) ? $Limpiarvar->limpiar($_POST['repitereenviarcontrasena'], '0') : '';

// Id del usuario para desactivar y activar y eliminar
$usu_id = isset($_POST['usu_id']) ? $Limpiarvar->limpiar($_POST['usu_id'], '0') : '';


$op = isset($_GET['op']) ? $Limpiarvar->limpiar($_GET['op'], '0') : '';
switch ($op) {
    case 'registrar':
        $usu_normal->RegistrarUsuario($creado, $user_login, $user_email, $user_password, $user_telefono, $foto_usuario);
        // echo "hola";
        break;

    case 'entrar':
        $usu_normal->EntrarUsuario($user_login_correo, $user_login_contraseña, $rememberme);
        break;

    case 'editarUsuario':
        $usu_normal->EditarUsuario($idUsuario, $user_editar, $user_email_editar, $user_telefono_editar, $user_password_editar, $foto_usuario, $permiso, $fechaOriginal, $creado, $foto_usuario_sesion, $idusuarioadmin);

        break;

    case 'salir':
        if (!empty($_REQUEST['op'])) {
            unset($_SESSION['DatosUsuario']);
            session_destroy();
        }
        break;

    case 'usuariosen1':
        $usu_normal->usuariosen1();
        break;

    case 'usuariosen0':
        $usu_normal->usuariosen0();
        break;

    case 'enviarcorreo':
        $usu_normal->enviarcorreo($user_recordar_correo);
        break;

    case 'reenviarcontrasena':
        $usu_normal->reenviarcontrasena($codigorestaurar, $reenviarcontrasenanueva, $repitereenviarcontrasena);
        break;

    case 'activarusuario':
$usu_normal->activarusuario($usu_id);
    break;
    
    case 'desactivarusuario':
$usu_normal->desactivarusuario($usu_id);
    break;

    case 'eliminarusuario':
    $usu_normal->eliminarusuario($usu_id);
        break;
    
    default:
        break;
}
