<?php session_start();
error_reporting(-1);
require_once "../Modelo/MostrarPdfModelo.php";

// Send Headers
// header('Content-type: application/pdf');
// header('Content-type: application/force-download'); 
// header('Content-Disposition: attachment; filename="myPDF.pdf');

// Send Headers: Prevent Caching of File
header('Cache-Control: private');
header('Pragma: private');

$Limpiarvar = new Funciones();
$mostrarConexion = new MostrarConexion(); //Esto es para hacer las consultas a la bd
$pdf = new Pdf(); //Esto es para generar el pdf

// Sesion del usuario
$DataUsuario = isset($_SESSION['DatosUsuario']) ? $_SESSION['DatosUsuario'] : '';
$idUsuario = !empty($DataUsuario['usuario']['id']) ? $DataUsuario['usuario']['id'] : '';
$nombreUsuario = !empty($DataUsuario['usuario']['nombre']) ? $DataUsuario['usuario']['nombre'] : '';


//Para colocar en el pdf
$nombre = '';
$correo = '';
$usu_imagen = '';

$id = isset($_GET['id']) ? $Limpiarvar->limpiar($_GET['id'], '1') : '';

$datos = "";
$op = isset($_GET['op']) ? $Limpiarvar->limpiar($_GET['op'], '0') : '';

switch ($op) {
	case 'mostrarcomprasusuario':

	$sql2 = "SELECT * FROM compra com INNER JOIN usuario usu ON com.usu_id = usu.usu_id where com.usu_id = '$idUsuario'";
	$consulta2 = $mostrarConexion->ejecutarConsultaTodasFilas($sql2, $datos);
	$estado = '';

	$titulo = "Compras realizadas por: ".$nombreUsuario;
	$pdf->titulo($titulo);
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Times','',12);
    $pdf->SetFillColor(2,157,116);//Fondo verde de celda
    $pdf->SetTextColor(0, 0, 0); //Letra color blanco
    if ($consulta2) {
            // com_id	com_precio	com_cantidad	com_creado	com_actualizado	com_estado	usu_id

        // $pdf->Cell(10,10,utf8_decode('Id'),0,0,'C',0);
        // $pdf->Cell(45,10,'Precio total',0,0,'C',0);
        // $pdf->Cell(45,10,'Cantidad total',0,0,'C',0);
        // $pdf->Cell(45,10,'Fecha de compra',0,0,'C',0);
        // $pdf->Cell(45,10,'Estado de la compra',0,0,'C',0);
        // usu_nombre
        // usu_correo

        $pdf->Ln(10);
    	$pdf->Cell(10,10,utf8_decode('Id'),1,0,'C',0);
    	$pdf->Cell(45,10,'Precio total',1,0,'C',0);
    	$pdf->Cell(45,10,'Cantidad total',1,0,'C',0);
    	$pdf->Cell(45,10,'Fecha de compra',1,0,'C',0);
    	$pdf->Cell(45,10,'Estado de la compra',1,0,'C',0);
    	$pdf->Ln(10);
    	foreach ($consulta2 as $row) {

$nombre = $row->usu_nombre;
$correo = $row->usu_correo;
$fotopago = empty($row->usu_imagen) ? '' : "../SubidArchivos/archivos/fotosUsuario/".$row->usu_imagen;
$usu_imagen = $fotopago;

    		switch ($row->com_estado) {
    			case '0':
    			$estado = 'En proceso';
    			break;
    			case '1':
    			$estado = 'Aprobado';
    			break;
    			case '2':
    			$estado = 'Rechazado';
    			break;
    			default:
    			break;
    		}
    		$pdf->CellFitSpace(10,15,utf8_decode($row->com_id),1,0,'C',0);
    		$pdf->CellFitSpace(45,15,utf8_decode($row->com_precio),1,0,'C',0);
    		$pdf->CellFitSpace( 45, 15, utf8_decode($row->com_cantidad), 1, 0, 'C', 0 );
    		$pdf->CellFitSpace( 45, 15, utf8_decode($row->com_creado), 1, 0, 'C', 0 );
    		$pdf->CellFitSpace( 45, 15, utf8_decode($estado), 1, 0, 'C', 0 );
    		$pdf->Ln(15);

    	}
        $pdf->Ln(30);
        $pdf->Cell(60,10,utf8_decode('Datos del comprador'),0,0,'C');
        $pdf->Ln(15);
        $pdf->CellFitSpace( 45, 30, utf8_decode($nombre), 0, 0, 'C', 0 );
        $pdf->CellFitSpace( 45, 30, utf8_decode($correo), 0, 0, 'C', 0 );
        if ($usu_imagen == '') {
            $pdf->CellFitSpace( 45, 30, utf8_decode('Sin imagen'), 0, 0, 'C', 0 );
        }else{
            // $pdf->CellFitSpace( 45, 30, utf8_decode('Sin imagen'), 0, 0, 'C', 0 );
        $pdf->Cell(40,30, $pdf->Image($usu_imagen, $pdf->GetX(), $pdf->GetY(),40,30),0);
        }

        // $nombre; $correo; $usu_imagen;

    } else {
    	$pdf->Ln(15);
    	$pdf->Cell(30,6,'No hay nada',1,0,'C',1);
    }
    $pdf->Output('I','comprasusuario.pdf',TRUE);
    break;

    case 'mostrardetallescomprasusuario':
    $sql2 = "SELECT car.car_id, pro.pro_nombre, pro.pro_precio, pro.pro_imagen, car.car_cantidadproducto, car.car_precioproductototal, usu.usu_nombre, usu.usu_correo, usu.usu_correo FROM compra com INNER JOIN carrito_compra car ON car.com_idprincipal = com.com_id INNER JOIN producto pro ON car.pro_id = pro.pro_idproducto INNER JOIN usuario usu ON com.usu_id = usu.usu_id where com.com_id = '$id'";
        // car_id    pro_nombre    pro_precio    pro_imagen    car_cantidadproducto    car_precioproductototal
    $consulta2 = $mostrarConexion->ejecutarConsultaTodasFilas($sql2, $datos);
    $sqlcompra = "SELECT tra.tra_creado, com.com_id, com.com_referencia, com.com_archivo, uba.uba_nombre, uba.uba_cedula, uba.uba_cuenta, ban.ban_nombre FROM transaccion tra INNER JOIN comprobante com ON tra.com_idcomprobante = com.com_id INNER JOIN usuario_banco uba ON com.uba_id = uba.uba_id INNER JOIN banco ban ON uba.ban_id = ban.ban_id WHERE tra.com_idcompra = '$id';";
    $consultacompra = $mostrarConexion->ejecutarConsultaTodasFilas($sqlcompra, $datos);



    if ($consulta2) {
    $titulo = "Detalles de la compra Número: ".$id;
    $pdf->titulo($titulo);
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','',12);
    $pdf->SetFillColor(2,157,116);//Fondo verde de celda
    $pdf->SetTextColor(0, 0, 0); //Letra color blanco

    
    	$pdf->CellFitSpace(40,10,utf8_decode('Producto'),1,0,'C',0);
    	$pdf->CellFitSpace(40,10,utf8_decode('Precio'),1,0,'C',0);
    	$pdf->CellFitSpace(35,10,utf8_decode('Cantidad'),1,0,'C',0);
    	$pdf->CellFitSpace(40,10,utf8_decode('Sub-Total'),1,0,'C',0);
    	$pdf->CellFitSpace(40,10,utf8_decode('Imagen'),1,0,'C',0);
    	$pdf->Ln(10);
    	foreach ($consulta2 as $row) {

$nombre = $row->usu_nombre;
$correo = $row->usu_correo;
$fotousuariogeneral = empty($row->usu_imagen) ? '' : "../SubidArchivos/archivos/fotosUsuario/".$row->usu_imagen;
$usu_imagen = $fotousuariogeneral;

    		$foto = empty($row->pro_imagen) ? '' : $row->pro_imagen;
    		$imagen = '../SubidArchivos/archivos/articulosUsuario/'.$foto;

    		$pdf->CellFitSpace(40,30,utf8_decode($row->pro_nombre),1,0,'C',0);
    		$pdf->CellFitSpace(40,30,utf8_decode($row->pro_precio),1,0,'C',0);
    		$pdf->CellFitSpace( 35, 30, utf8_decode($row->car_cantidadproducto), 1, 0, 'C', 0 );
    		$pdf->CellFitSpace( 40, 30, utf8_decode($row->car_precioproductototal), 1, 0, 'C', 0 );
    		$pdf->Cell(40,30, $pdf->Image($imagen, $pdf->GetX(), $pdf->GetY(),40,30),1);
    		$pdf->Ln();
    	}

        $pdf->Ln(30);
        $pdf->Cell(60,10,utf8_decode('Datos del comprador'),0,0,'C');
        $pdf->Ln(15);
        $pdf->CellFitSpace( 45, 30, utf8_decode($nombre), 0, 0, 'C', 0 );
        $pdf->CellFitSpace( 45, 30, utf8_decode($correo), 0, 0, 'C', 0 );
        // if ($usu_imagen == '') {
        //     $pdf->CellFitSpace( 45, 30, utf8_decode('Sin imagen'), 0, 0, 'C', 0 );
        // }else{
        //     // $pdf->CellFitSpace( 45, 30, utf8_decode('Sin imagen'), 0, 0, 'C', 0 );
        // $pdf->Cell(40,30, $pdf->Image($usu_imagen, $pdf->GetX(), $pdf->GetY(),40,30),0);
        // }

    	if ($consultacompra) {
    		$titulo = "Detalles del pago de la compra Número: ".$id;
    		$pdf->titulo($titulo);
    		$pdf->AddPage();
    		$pdf->SetFont('Times','',12);
			$pdf->SetFillColor(2,157,116);//Fondo verde de celda
    		$pdf->SetTextColor(0, 0, 0); //Letra color blanco
    		$pdf->CellFitSpace(30,10,utf8_decode('Referencia bancaria'),1,0,'C',0);
    		$pdf->CellFitSpace(35,10,utf8_decode('Fecha'),1,0,'C',0);
    		$pdf->CellFitSpace(20,10,utf8_decode('Banco'),1,0,'C',0);
    		$pdf->CellFitSpace(60,10,utf8_decode('Número de cuenta'),1,0,'C',0);
    		$pdf->CellFitSpace(60,10,utf8_decode('Imagen'),1,0,'C',0);
    		$pdf->Ln(10);
    foreach ($consultacompra as $rowcompra) {
    // tra_creado  com_id  com_referencia  com_archivo uba_nombre  uba_cedula  uba_cuenta  ban_nombre  
    	$fotopago = empty($rowcompra->com_archivo) ? '' : $rowcompra->com_archivo;
    	$imagenpago = "../SubidArchivos/archivos/transferenciaUsuario/".$fotopago;
    	$pdf->CellFitSpace(30,30,utf8_decode($rowcompra->com_referencia),1,0,'C',0);
    	$pdf->CellFitSpace(35,30,utf8_decode($rowcompra->tra_creado),1,0,'C',0);
    	$pdf->CellFitSpace(20,30,utf8_decode($rowcompra->ban_nombre),1,0,'C',0);
    	$pdf->CellFitSpace(60, 30, utf8_decode($rowcompra->uba_cuenta), 1, 0, 'C', 0 );
    	$pdf->Cell(60,30, $pdf->Image($imagenpago, $pdf->GetX(), $pdf->GetY(),60,30),1);
    	$pdf->Ln();
    }
}else{
	    	$titulo = "Detalles del pago de la compra Número: ".$id;
    		$pdf->titulo($titulo);
    		$pdf->AddPage();
    		$pdf->SetFont('Times','',12);
    		$pdf->Ln(10);
    		$pdf->Cell(60,10,utf8_decode('¡Error! No has pagado todavia'),0,0,'C');
        }
}else {
		    $titulo = "Error";
    		$pdf->titulo($titulo);
    		$pdf->AddPage();
    		$pdf->SetFont('Times','',12);
    		$pdf->Ln(10);
    		$pdf->Cell(60,10,utf8_decode('Intenta de nuevo más tarde'),0,0,'C');
    }
$pdf->Output('I','detallescompra.pdf',TRUE);
break;


case 'descargartodaslacompras':
    $sql2 = "SELECT * FROM compra com INNER JOIN usuario usu ON com.usu_id = usu.usu_id ORDER BY com.com_creado DESC;";
    $consulta2 = $mostrarConexion->ejecutarConsultaTodasFilas($sql2, $datos);
    $estado = '';

    $titulo = "Compras realizadas por los usuarios";
    $pdf->titulo($titulo);
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','',12);
    $pdf->SetFillColor(2,157,116);//Fondo verde de celda
    $pdf->SetTextColor(0, 0, 0); //Letra color blanco
    if ($consulta2) {
            // com_id   com_precio  com_cantidad    com_creado  com_actualizado com_estado  usu_id

        $pdf->Cell(10,10,utf8_decode('Id'),1,0,'C',0);
        $pdf->Cell(25,10,'Precio',1,0,'C',0);
        $pdf->Cell(25,10,'Cantidad',1,0,'C',0);
        $pdf->Cell(45,10,'Fecha',1,0,'C',0);
        $pdf->Cell(25,10,'Estado',1,0,'C',0);
        $pdf->Cell(60,10,'Correo del comprador',1,0,'C',0);
        // 15
        $pdf->Ln(10);
        foreach ($consulta2 as $row) {
            switch ($row->com_estado) {
                case '0':
                $estado = 'En proceso';
                break;
                case '1':
                $estado = 'Aprobado';
                break;
                case '2':
                $estado = 'Rechazado';
                break;
                default:
                break;
            }
            $pdf->CellFitSpace(10,15,utf8_decode($row->com_id),1,0,'C',0);
            $pdf->CellFitSpace(25,15,utf8_decode($row->com_precio),1,0,'C',0);
            $pdf->CellFitSpace( 25, 15, utf8_decode($row->com_cantidad), 1, 0, 'C', 0 );
            $pdf->CellFitSpace( 45, 15, utf8_decode($row->com_creado), 1, 0, 'C', 0 );
            $pdf->CellFitSpace( 25, 15, utf8_decode($estado), 1, 0, 'C', 0 );
            $pdf->CellFitSpace( 60, 15, utf8_decode($row->usu_correo), 1, 0, 'C', 0 );
            $pdf->Ln(15);
        }

    } else {
        $pdf->Ln(15);
        $pdf->Cell(30,6,'No hay nada',1,0,'C',1);
    }
    $pdf->Output('I','compras.pdf',TRUE);
    break;


    case 'descargartodosusuarios':
    $sql = "SELECT usu.usu_id, usu.usu_nombre, usu.usu_correo, usu.usu_telefono, usu.usu_imagen, usu.usu_creado, usu.usu_estado FROM usuario usu WHERE usu_permiso = '0';";
    $consulta2 = $mostrarConexion->ejecutarConsultaTodasFilas($sql, $datos);

    $titulo = "Todos los usuarios registrados en la tienda";
    $pdf->titulo($titulo);
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','',12);
    $pdf->SetFillColor(2,157,116);//Fondo verde de celda
    $pdf->SetTextColor(0, 0, 0); //Letra color blanco
    if ($consulta2) {

        $pdf->Cell(10,10,utf8_decode('Id'),1,0,'C',0);
        $pdf->Cell(45,10,'Nombre',1,0,'C',0);
        $pdf->Cell(40,10,'Correo',1,0,'C',0);
        $pdf->Cell(35,10,'Telefono',1,0,'C',0);
        $pdf->Cell(25,10,'Creado',1,0,'C',0);
        $pdf->Cell(40,10,'Imagen',1,0,'C',0);
        // 15
        $pdf->Ln(10);
        foreach ($consulta2 as $row) {
            switch ($row->usu_estado) {
                case '0':
                $estado = 'Inactivo';
                break;
                case '1':
                $estado = 'Activo';
                break;
                default:
                break;
            }

            $fechaOriginal = $row->usu_creado;
            $fechaFormateada = date("d-m-Y", strtotime($fechaOriginal));

        $fotousuario = empty($row->usu_imagen) ? '' : $row->usu_imagen;
        $imagenusuario = '';


            $pdf->CellFitSpace(10,30,utf8_decode($row->usu_id),1,0,'C',0);
            $pdf->CellFitSpace(45,30,utf8_decode($row->usu_nombre),1,0,'C',0);
            $pdf->CellFitSpace( 40, 30, utf8_decode($row->usu_correo), 1, 0, 'C', 0 );
            $pdf->CellFitSpace( 35, 30, utf8_decode($row->usu_telefono), 1, 0, 'C', 0 );
            $pdf->CellFitSpace( 25, 30, utf8_decode($fechaFormateada), 1, 0, 'C', 0 );
        if ($fotousuario =='') {
        $imagenusuario = '';
            $pdf->Cell(40,30, 'Sin imagen',1,0,'C',0);
        }else{
        $imagenusuario = "../SubidArchivos/archivos/fotosUsuario/".$fotousuario;
            $pdf->Cell(40,30, $pdf->Image($imagenusuario, $pdf->GetX(), $pdf->GetY(),40,30),1);
        }

            $pdf->Ln();
        }

    } else {
        $pdf->Ln(15);
        $pdf->Cell(30,6,'No hay nada',1,0,'C',1);
    }
    $pdf->Output('I','usuarios.pdf',TRUE);

        break;

    case 'descargartodoslosproductos':
      $sql = "SELECT pro.pro_idproducto, pro.pro_nombre, pro.pro_precio, pro.pro_cantidad, pro.pro_imagen, pro.pro_creado, pro.pro_estado, tip.tip_nombre, tip.tip_peso FROM producto pro INNER JOIN tipo_producto tip ON pro.tip_id = tip.tip_id;";

$consulta2 = $mostrarConexion->ejecutarConsultaTodasFilas($sql, $datos);

    $titulo = "Todos los productos registrados en la tienda";
    $pdf->titulo($titulo);
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','',12);
    $pdf->SetFillColor(2,157,116);//Fondo verde de celda
    $pdf->SetTextColor(0, 0, 0); //Letra color blanco
    if ($consulta2) {

        $pdf->Cell(10,10,utf8_decode('Id'),1,0,'C',0);
        $pdf->Cell(45,10,'Nombre',1,0,'C',0);
        $pdf->Cell(30,10,'Precio',1,0,'C',0);
        $pdf->Cell(30,10,'Cantidad',1,0,'C',0);
        $pdf->Cell(15,10,'Estado',1,0,'C',0);
        $pdf->Cell(25,10,'Creado',1,0,'C',0);
        $pdf->Cell(40,10,'Imagen',1,0,'C',0);
        // 15
        $pdf->Ln(10);

        // pro.pro_idproducto, pro.pro_nombre, pro.pro_precio, pro.pro_cantidad, pro.pro_imagen, pro.pro_creado, tip.tip_nombre, tip.tip_peso
        foreach ($consulta2 as $row) {
            switch ($row->pro_estado) {
                case '0':
                $estado = 'Inactivo';
                break;
                case '1':
                $estado = 'Activo';
                break;
                default:
                break;
            }

            $fechaOriginal = $row->pro_creado;
            $fechaFormateada = date("d-m-Y", strtotime($fechaOriginal));

        $fotoarticulo = empty($row->pro_imagen) ? '' : $row->pro_imagen;
        $imagenarticulo = '';


            $pdf->CellFitSpace(10,30,utf8_decode($row->pro_idproducto),1,0,'C',0);
            $pdf->CellFitSpace(45,30,utf8_decode($row->pro_nombre),1,0,'C',0);
            $pdf->CellFitSpace( 30, 30, utf8_decode($row->pro_precio), 1, 0, 'C', 0 );
            $pdf->CellFitSpace( 30, 30, utf8_decode($row->pro_cantidad), 1, 0, 'C', 0 );
            $pdf->CellFitSpace( 15, 30, utf8_decode($estado), 1, 0, 'C', 0 );
            $pdf->CellFitSpace( 25, 30, utf8_decode($fechaFormateada), 1, 0, 'C', 0 );
        if ($fotoarticulo =='') {
        $imagenarticulo = '';
            $pdf->Cell(40,30, 'Sin imagen',1,0,'C',0);
        }else{
        $imagenarticulo = "../SubidArchivos/archivos/articulosUsuario/".$fotoarticulo;
            $pdf->Cell(40,30, $pdf->Image($imagenarticulo, $pdf->GetX(), $pdf->GetY(),40,30),1);
        }

            $pdf->Ln();
        }

    } else {
        $pdf->Ln(15);
        $pdf->Cell(30,6,'No hay nada',1,0,'C',1);
    }
    $pdf->Output('I','productos.pdf',TRUE);
        break;
default:
break;
}


?>