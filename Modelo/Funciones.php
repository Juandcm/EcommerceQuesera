<?php
require_once "../config/Conexion.php";
class Funciones extends Conexion
{


public function getSubString($string, $length=NULL){
  //Si no se especifica la longitud por defecto es 50
  if ($length == NULL)
    $length = 40;
  // quitamos las etiquetas HTML
  $stringDisplay = strip_tags($string);
  // solo se recorta si la longitud es mayor que el limite
  if (strlen($stringDisplay) > $length) {
    // obtenemos la posicion a partir de la cual se cortara
    $indiceCorte = strrpos($stringDisplay, " ", $length - strlen($stringDisplay));
    // montamos una nueva cadena con el corte primero y la elipsis
    $stringDisplay = substr($stringDisplay, 0, $indiceCorte) . "...";
  }
  return $stringDisplay;
}


    public function cortarletras($string, $length = NULL)
    {
        if ($length == NULL) $length = 60;

        $stringDisplay = strip_tags($string);
        if (strlen($stringDisplay) > $length) {
            $indiceCorte = strrpos($stringDisplay, " ", $length - strlen($stringDisplay));
            $stringDisplay = substr($stringDisplay, 0, $indiceCorte) . "...";
        }

        return $stringDisplay;
    }
    public function cleanInput($input)
    {
        $search = array(
            '@<script[^>]*?>.*?</script>@si',   // Elimina javascript
            '@<[\/\!]*?[^<>]*?>@si',            // Elimina las etiquetas HTML
            '@<style[^>]*?>.*?</style>@siU',    // Elimina las etiquetas de estilo
            '@<![\s\S]*?--[ \t\n\r]*>@'         // Elimina los comentarios multi-línea
        );
        $output = preg_replace($search, '', $input);
        return $output;
    }
    public function limpiar($input, $numero)
    {
        if ($numero == '1') {
            trim($input);
        }
        if (is_array($input)) {
            foreach ($input as $var => $val) {
                $output[$var] = self::limpiar($val,$numero);
            }
        } else {
            if (get_magic_quotes_gpc()) {
                $input = stripslashes($input);
            }
            $output1  = self::cleanInput($input);
            $input1 = strip_tags($output1);

            $search = array('select', 'from', 'update', 'delete', 'select * from', 'delete * from', 'update * from', 'insert into values', 'inner join', 'alter table', 'drop table', 'drop database', 'create database', 'create index', 'create unique index', 'create view', 'drop index', 'truncate table', 'SELECT', 'FROM', 'UPDATE', 'DELETE', 'SELECT * FROM', 'DELETE * FROM', 'UPDATE * FROM', 'INSERT INTO VALUES', 'INNER JOIN', 'ALTER TABLE', 'DROP TABLE', 'DROP DATABASE', 'CREATE DATABASE', 'CREATE INDEX', 'CREATE UNIQUE INDEX', 'CREATE VIEW', 'DROP INDEX', 'TRUNCATE TABLE');

            $output = str_replace($search, '', $input1);
        }

        return htmlspecialchars($output);
    }

    // $creado = date("Y-m-d H:i:s");

    # Los datos que queremos insertar
    // //Esto sirve para guardar datos en la BD
    // $sql = "INSERT INTO usuario (usu_iden, usu_nomb, usu_apel, usu_corr, usu_cont, usu_tele, usu_foto, usu_fech, usu_perm, usu_esta) VALUES (:usu_iden, :usu_nomb, :usu_apel, :usu_corr, :usu_cont, :usu_tele, :usu_foto, :usu_fech, :usu_perm, :usu_esta)";

    // $datos = array( 'usu_iden' => 'Cathy', 'usu_nomb' => '9 Dark and Twisty', 'usu_apel' => 'Cardiff','usu_corr'=>'corrreonu','usu_cont'=>'contraseña','usu_tele'=>'1245','usu_foto'=>'foto','usu_fech'=>$creado,'usu_perm'=>'1','usu_esta'=>'1');

    // $consulta = $usu_normal->ejecutarConsulta($sql,$datos);
    // if ($consulta) {
    // echo "se ejecuto bien";
    // }else{
    //  echo "error";
    // } 
    // Abajo
    public function ejecutarConsulta($sql, $datos)
    {
        $inicio = $this->conexion->prepare($sql);
        if (is_array($datos)) {
            ($inicio->execute($datos)) ? $result = true : $result = false;
        } else {
            ($inicio->execute()) ? $result = true : $result = false;
        }
        return $result;
    }

    //Esto sirve para mostrar los datos de manera bien
    // $sql2 = "SELECT usu_iden,usu_nomb,usu_apel,usu_corr FROM usuario";
    // $datos = '';
    // $consulta2 = $usu_normal->ejecutarConsultaTodasFilas($sql2,$datos);
    // if ($consulta2) {
    // foreach ($consulta2 as $row) {
    // echo '<br/>'.$row->usu_iden;
    // echo '<br/>'.$row->usu_nomb;
    // echo '<br/>'.$row->usu_apel;
    // echo '<br/>'.$row->usu_corr;
    // }
    // }else{
    // echo "no hay nada";
    // }

    // Abajo
    public function ejecutarConsultaTodasFilas($sql, $datos)
    {
        $query = $this->conexion->prepare($sql);
        if (is_array($datos)) {
            $query->execute($datos);
            $rows = $query->fetchAll(PDO::FETCH_OBJ);
        } else {
            $query->execute();
            $rows = $query->fetchAll(PDO::FETCH_OBJ);
        }
        return $rows;
    }

    //  //Esto sirve para buscar un solo dato en la BD
    // $sql3 = "SELECT usu_iden,usu_nomb,usu_apel,usu_corr FROM usuario WHERE usu_iden=:usu_iden LIMIT 1";
    // $datos = array( 'usu_iden' => '70');
    // $resultado = $usu_normal->ejecutarConsultaSimpleFila($sql3,$datos);
    // if ($resultado) {
    //  echo "Esto es lo que buscas: ".$resultado->usu_iden;
    // }else{
    //  echo "no se encontro nada";
    // }
    // Abajo
    public function ejecutarConsultaSimpleFila($sql, $datos)
    {
        $query = $this->conexion->prepare($sql);
        if (is_array($datos)) {
            $query->execute($datos);
            $row = $query->fetch(PDO::FETCH_OBJ);
        } else {
            $query->execute();
            $row = $query->fetch(PDO::FETCH_OBJ);
        }
        return $row;
    }

    // $creado = date("Y-m-d H:i:s");

    // // Los datos que queremos insertar
    // //Esto sirve para guardar datos en la BD y devolver el id de ese registro al mismo tiempo
    // $sql = "INSERT INTO usuario (usu_iden, usu_nomb, usu_apel, usu_corr, usu_cont, usu_tele, usu_foto, usu_fech, usu_perm, usu_esta) VALUES (:usu_iden, :usu_nomb, :usu_apel, :usu_corr, :usu_cont, :usu_tele, :usu_foto, :usu_fech, :usu_perm, :usu_esta)";

    // $datos = array( 'usu_iden' => 'Cathy', 'usu_nomb' => '9 Dark and Twisty', 'usu_apel' => 'Cardiff','usu_corr'=>'corrreonu','usu_cont'=>'contraseña','usu_tele'=>'1245','usu_foto'=>'foto','usu_fech'=>$creado,'usu_perm'=>'1','usu_esta'=>'1');

    // $consulta = $usu_normal->ejecutarConsulta_retornrID();
    // echo $consulta;

    // Abajo

    public function ejecutarConsulta_retornrID()
    {
        return $this->conexion->lastInsertId();
    }


    public function __destruct()
    {
        $this->conexion = null;
    }




    // Numero de filas devueltas
    // $datos='';
    // $sql='SELECT * FROM inventario';
    // $query = $usu_normal->ejecutarConsultaCantidadRow($sql,$datos);
    // echo $query
    // Abajo
    public function ejecutarConsultaCantidadRow($sql, $datos)
    {
        $query = $this->conexion->prepare($sql);
        if (is_array($datos)) {
            $query->execute($datos);
            $count = $query->rowCount(); // Return array indexed by column number 
        } else {
            $query->execute();
            $count = $query->rowCount(); // Return array indexed by column number 
        }
        return $count; // Resets array cursor and returns first value (the count) 
    }


    // <SELECT>
    // combosSelect('select * from tabla', 'idtabla', 'nombrecampo')
    // </SELECT>
    public function combosSelect($sql, $idvalue, $nombreoption)
    {
        $query = $this->conexion->prepare($sql);
        $query->execute();
        $rows = $query->fetchAll();
        foreach ($rows as $key) {
            echo "<option value='" . $key["{$idvalue}"] . "'>" . $key["{$nombreoption}"] . "</option>";
        }
    }


    public function subirArchivo($direccionfile, $archivoTemporal, $name, $ubicacionsubida)
    {

        if (file_exists($archivoTemporal) || is_uploaded_file($archivoTemporal)) {
            $file = $direccionfile;
            $directorioCompleto = $file . '/' . basename($_FILES['archivo']['name']);
            $imagen = round(microtime(true)) . '--' . $name;
            $direct = $file . $ubicacionsubida;
            $direccionCompleta = $direct . $imagen;
            $msg = (move_uploaded_file($archivoTemporal, $direccionCompleta)) ? 'true' : 'false';
        }
        $valores = array(
            "0" => $msg,
            "1" => $direccionCompleta
        );
        return $valores;
    }
}
