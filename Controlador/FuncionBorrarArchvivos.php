<?php
include_once '../Modelo/BorrarArchivos.php';
// No me va a mostrar ningun error
error_reporting(-1);


$eliminarDocumentoUsuario = new EliminarArchivos();
$direccionArchivosUsuario='../SubidArchivos/archivos/articulosUsuario/';
$tipoArchivo='pro_imagen';
$tabla='producto';


$eliminarFotoUsuario = new EliminarArchivos();
$direccionFotosUsuario='../SubidArchivos/archivos/fotosUsuario/';
$tipoArchivo2='usu_imagen';
$tablausuario='usuario';


$eliminarDocumentoUsuario->eliminarArchivosUsuario($direccionArchivosUsuario,$tabla,$tipoArchivo);
$eliminarFotoUsuario->eliminarArchivosUsuario($direccionFotosUsuario,$tablausuario,$tipoArchivo2);
