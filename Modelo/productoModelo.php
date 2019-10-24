<?php
require_once "Funciones.php";

class Producto extends Funciones
{
    public function crearTipoProducto($nombre_tipo, $peso_tipo)
    {
        $sql = "INSERT INTO tipo_producto (tip_id, tip_nombre, tip_peso) VALUES (NULL, '$nombre_tipo', '$peso_tipo');";
        $datos = '';
        $consulta = self::ejecutarConsulta($sql, $datos);

        if ($consulta) {
            $sessData['estado']['type'] = 'success';
            $sessData['estado']['msg'] = 'Se guardo correctamente.';
        } else {
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'No se pudo guardar.';
        }
        echo json_encode($sessData);
    }

    public function mostrartipoproducto()
    {
        $sql = "SELECT tip_id, tip_nombre FROM tipo_producto";
        $idvalue = 'tip_id';
        $nombreoption = 'tip_nombre';
        self::combosSelect($sql, $idvalue, $nombreoption);
    }

    public function crearProducto($nombre_producto, $precio_producto, $cantidad_producto, $creado, $tipo_producto_id, $foto_producto)
    {
        $sql = "INSERT INTO producto (pro_idproducto, pro_nombre, pro_precio, pro_cantidad, pro_imagen, pro_creado, pro_actualizado, tip_id, pro_estado) VALUES (NULL, '$nombre_producto', '$precio_producto', '$cantidad_producto', '$foto_producto', '$creado', NULL, '$tipo_producto_id','1');";
        $datos = '';
        $consulta = self::ejecutarConsulta($sql, $datos);

        if ($consulta) {
            $sessData['estado']['type'] = 'success';
            $sessData['estado']['msg'] = 'Se guardo correctamente.';
        } else {
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'No se pudo guardar.';
        }
        echo json_encode($sessData);
    }
    public function listarSoloEstado1()
    {
        $requestData = $_POST;
        $columns = array(
            0 => 'pro.pro_idproducto',
            1 => 'pro.pro_nombre',
            2 => 'pro.pro_precio',
            3 => 'pro.pro_cantidad',
            4 => 'pro.pro_imagen',
            5 => 'tip.tip_nombre',
            6 => 'pro.pro_creado',
            7 => 'pro.pro_idproducto',
        );
        $datos = '';
        // SELECT pro.pro_idproducto, pro.pro_nombre, pro.pro_precio, pro.pro_cantidad, pro.pro_imagen, pro.pro_creado, tip.tip_nombre, tip.tip_peso FROM producto pro INNER JOIN tipo_producto tip ON pro.tip_id = tip.tip_id 
        // inv_iden, usu_iden, inv_nomb, inv_desc, inv_prec, inv_fech, inv_foto, inv_cant, inv_esta
        // getting total number records without any search
        $sql1 = "SELECT COUNT(pro.pro_idproducto) as totalcero FROM producto pro WHERE pro.pro_estado = '1' ";
        $query = self::ejecutarConsultaSimpleFila($sql1, $datos);
        // Revisar desde aqui
        if ($query) {
            $totalData = $query->totalcero;
        }
        $sql = "SELECT pro.pro_idproducto, pro.pro_nombre, pro.pro_precio, pro.pro_cantidad, pro.pro_imagen, pro.pro_creado, tip.tip_nombre, tip.tip_peso FROM producto pro INNER JOIN tipo_producto tip ON pro.tip_id = tip.tip_id WHERE pro.pro_estado='1'";
        // getting records as per search parameters
        if (isset($requestData['search']) && $requestData['search'] !== "") {   //name
            $sql .= " AND pro.pro_nombre LIKE '%" . addslashes($requestData['search']['value']) . "%' ";
        }
        // Revisar esto
        $query = self::ejecutarConsultaCantidadRow($sql, $datos);
        $totalFiltered = $query;

        $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length
        $query = self::ejecutarConsultaTodasFilas($sql, $datos);
        $data = array();

        if ($query) {
            foreach ($query as $row) {
                $fechaOriginal = $row->pro_creado;
                $fechaFormateada = date("d-m-Y", strtotime($fechaOriginal));
                $foto = empty($row->pro_imagen) ? '' : $row->pro_imagen;
                $data[] = array(
                    "0" => '<td>' . $row->pro_idproducto . '</td>',


                    "1" => '<td>' . $row->pro_nombre . '</td>',
                    "2" => '<td>' . $row->pro_precio . ' Bs</td>',
                    "3" => '<td>' . $row->pro_cantidad . ' ' . $row->tip_peso . ' </td>',
                    '4' => '<td> ' . $row->tip_nombre . '</td>',
                    "5" => '<td> <img src="SubidArchivos/archivos/articulosUsuario/' . $foto . '" alt="imagen" width="80"> </td>',
                    "6" => '<td>' . $fechaFormateada . '</td>',
                    "7" => '<td class="sorting_1">
            <div class="text-center">
            <a href="#" class="text-inverse p-r-10" data-toggle="tooltip" title="" data-original-title="Editar" onclick="editarProducto(\'' . $row->pro_idproducto . '\',\'' . $row->pro_nombre . '\',\'' . $row->pro_precio . '\',\'' . $row->pro_cantidad . '\');">
                <i class="ti-marker-alt"></i>
            </a>
            <a href="#" class="text-inverse p-r-10" title="" data-toggle="tooltip" data-original-title="Eliminar" onclick="eliminarProducto(\'' . $row->pro_idproducto . '\');">
                <i class="ti-trash"></i>
            </a>

            <a href="#" class="text-inverse p-r-10" title="" data-toggle="tooltip" data-original-title="Desactivar Producto" onclick="desaprobar(\'' . $row->pro_idproducto . '\');">
                <i class="fa fa-thumbs-o-down"></i>
            </a>
            </div>
            <a href="#" class="fcbtn btn btn-outline btn-block btn-success btn-1e  waves-effect waves-light" onclick="publicared(\'' . $row->pro_nombre . '\',\'' . $row->pro_precio . '\',\'' . $row->pro_cantidad . '\',\'' . $row->tip_peso . '\', \'' . $foto . '\');">
                Publicar en red social
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



    public function listarSoloEstado0()
    {
        $requestData = $_POST;
        $columns = array(
            0 => 'pro.pro_idproducto',
            1 => 'pro.pro_nombre',
            2 => 'pro.pro_precio',
            3 => 'pro.pro_cantidad',
            4 => 'pro.pro_imagen',
            5 => 'tip.tip_nombre',
            6 => 'pro.pro_creado',
            7 => 'pro.pro_idproducto',
        );
        $datos = '';
        // SELECT pro.pro_idproducto, pro.pro_nombre, pro.pro_precio, pro.pro_cantidad, pro.pro_imagen, pro.pro_creado, tip.tip_nombre, tip.tip_peso FROM producto pro INNER JOIN tipo_producto tip ON pro.tip_id = tip.tip_id 
        // inv_iden, usu_iden, inv_nomb, inv_desc, inv_prec, inv_fech, inv_foto, inv_cant, inv_esta
        // getting total number records without any search
        $sql1 = "SELECT COUNT(pro.pro_idproducto) as totalcero FROM producto pro WHERE pro.pro_estado = '0' ";
        $query = self::ejecutarConsultaSimpleFila($sql1, $datos);
        // Revisar desde aqui
        if ($query) {
            $totalData = $query->totalcero;
        }
        $sql = "SELECT pro.pro_idproducto, pro.pro_nombre, pro.pro_precio, pro.pro_cantidad, pro.pro_imagen, pro.pro_creado, tip.tip_nombre, tip.tip_peso FROM producto pro INNER JOIN tipo_producto tip ON pro.tip_id = tip.tip_id WHERE pro.pro_estado='0'";
        // getting records as per search parameters
        if (isset($requestData['search']) && $requestData['search'] !== "") {   //name
            $sql .= " AND pro.pro_nombre LIKE '%" . addslashes($requestData['search']['value']) . "%' ";
        }
        // Revisar esto
        $query = self::ejecutarConsultaCantidadRow($sql, $datos);
        $totalFiltered = $query;

        $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length
        $query = self::ejecutarConsultaTodasFilas($sql, $datos);
        $data = array();

        if ($query) {
            foreach ($query as $row) {
                $fechaOriginal = $row->pro_creado;
                $fechaFormateada = date("d-m-Y", strtotime($fechaOriginal));
                $foto = empty($row->pro_imagen) ? '' : $row->pro_imagen;
                $data[] = array(
                    "0" => '<td>' . $row->pro_idproducto . '</td>',


                    "1" => '<td>' . $row->pro_nombre . '</td>',
                    "2" => '<td>' . $row->pro_precio . ' Bs</td>',
                    "3" => '<td>' . $row->pro_cantidad . ' ' . $row->tip_peso . ' </td>',
                    '4' => '<td> ' . $row->tip_nombre . '</td>',
                    "5" => '<td> <img src="SubidArchivos/archivos/articulosUsuario/' . $foto . '" alt="imagen" width="80"> </td>',

                    "6" => '<td>' . $fechaFormateada . '</td>',
                    "7" => '<td class="sorting_1">
                    <a href="#" class="text-inverse p-r-10" data-toggle="tooltip" title="" data-original-title="Editar" onclick="editarProducto(\'' . $row->pro_idproducto . '\',\'' . $row->pro_nombre . '\',\'' . $row->pro_precio . '\',\'' . $row->pro_cantidad . '\');">
                    <i class="ti-marker-alt"></i>
                </a>
                <a href="#" class="text-inverse p-r-10" title="" data-toggle="tooltip" data-original-title="Eliminar" onclick="eliminarProducto(\'' . $row->pro_idproducto . '\');">
                    <i class="ti-trash"></i>

                <a href="#" class="text-inverse p-r-10" title="" data-toggle="tooltip" data-original-title="Aprobar Producto" onclick="aprobar(\'' . $row->pro_idproducto . '\');">
                    <i class="fa fa-thumbs-o-up"></i>
                </a>
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




    public function tipoproductos()
    {
        $requestData = $_POST;
        $columns = array(
            0 => 'tip.tip_id',
            1 => 'tip.tip_nombre',
            2 => 'tip.tip_peso',
            3 => 'tip.tip_id'
        );
        $datos = '';

        // getting total number records without any search
        $sql1 = "SELECT COUNT(tip.tip_id) as totalcero FROM tipo_producto tip ";
        $query = self::ejecutarConsultaSimpleFila($sql1, $datos);
        // Revisar desde aqui
        if ($query) {
            $totalData = $query->totalcero;
        }
        $sql = "SELECT tip.tip_id, tip.tip_nombre, tip.tip_peso FROM tipo_producto tip";
        // getting records as per search parameters
        if (isset($requestData['search']) && $requestData['search'] !== "") {   //name
            $sql .= " WHERE tip.tip_nombre LIKE '%" . addslashes($requestData['search']['value']) . "%' ";
        }
        // Revisar esto
        $query = self::ejecutarConsultaCantidadRow($sql, $datos);
        $totalFiltered = $query;

        $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";  // adding length
        $query = self::ejecutarConsultaTodasFilas($sql, $datos);
        $data = array();

        if ($query) {
            foreach ($query as $row) {
                $data[] = array(
                    "0" => '<td>' . $row->tip_id . '</td>',
                    "1" => '<td>' . $row->tip_nombre . '</td>',
                    "2" => '<td>' . $row->tip_peso . ' Bs</td>',
                    "3" => '<td class="sorting_1">
            <a href="#" class="text-inverse p-r-10" data-toggle="tooltip" title="" data-original-title="Editar" onclick="editarTipoProducto(\'' . $row->tip_id . '\',\'' . $row->tip_nombre . '\',\'' . $row->tip_peso . '\');" data-toggle="modal" data-target="#editartipoproductoModal">
                <i class="ti-marker-alt"></i>
            </a>
            <a href="javascript:void(0)" class="text-inverse" title="" data-toggle="tooltip" data-original-title="Eliminar" onclick="eliminarTipoProducto(\'' . $row->tip_id . '\');">
                <i class="ti-trash"></i>
            </a>
        </td>'
                );
            }
        } else {
            $data[] = array("0" => '', "1" => 'No hay nada', "2" => 'No hay nada', "3" => '');
        }

        $json_data = array(
            "sEcho" => intval($requestData['draw']),  //Informacion para el datatables
            "iTotalRecords" => intval($totalData), //enviamos el total de registros al datatable 
            "iTotalDisplayRecords" => intval($totalFiltered), //enviamos el total registros a visualizar 
            "aaData" => $data
        );
        echo json_encode($json_data);  // send data as json format
    }


    public function mostrarproductofront($buscarproducto, $vista)
    {
        // $vista = '';
        if ($buscarproducto == '') {

            if ($vista == '') {
                $sql = "SELECT pro_idproducto, pro_nombre, pro_precio, pro_imagen FROM producto where pro_estado = '1' AND pro_cantidad > 0";
            } else {
                $sql = "SELECT pro_idproducto, pro_nombre, pro_precio, pro_imagen FROM producto where pro_estado = '1' AND pro_cantidad > 0 LIMIT 3";
            }
        } else {


            if ($vista == '') {
                $sql = "SELECT pro_idproducto, pro_nombre, pro_precio, pro_imagen FROM producto where pro_estado = '1' AND pro_nombre like '%$buscarproducto%' AND pro_cantidad > 0";
            } else {
                $sql = "SELECT pro_idproducto, pro_nombre, pro_precio, pro_imagen FROM producto where pro_estado = '1' AND pro_nombre like '%$buscarproducto%' AND pro_cantidad > 0  LIMIT 3";
            }
        }
        $datos = '';
        $query = self::ejecutarConsultaTodasFilas($sql, $datos);
        if ($query) {
            foreach ($query as $row) {
                $foto = empty($row->pro_imagen) ? '' : $row->pro_imagen;

                if ($vista == '') {
                    $imagen = "<img src='SubidArchivos/archivos/articulosUsuario/" . $foto . "' alt='' class='product__img'>";
                } else {
                    $imagen = "<img src='http://localhost/SubidArchivos/archivos/articulosUsuario/" . $foto . "' alt='' class='product__img'>";
                }


                echo "
                <div class='col-lg-4 col-sm-4 product  bounceInUp animated'>
<div class='product__img-holder'>
    <a href='' class='product__link' data-rel='quickviewmodal' aria-label='Product' style='height: 250px;border: 1px solid black;' onclick='mostrarDetallesProducto(\"" . $row->pro_idproducto . "\",\"" . $vista . "\");'>
        " . $imagen . "
    </a>
    <div class='product__actions'>
        <a href='#' class='product__quickview' data-rel='quickviewmodal' onclick='mostrarDetallesProducto(\"" . $row->pro_idproducto . "\",\"" . $vista . "\");'>
            <i class='ui-eye'></i>
            <span>Detalles</span>
        </a>
    </div>
</div>

<div class='product__details text-center'>
    <h3 class='product__title'>
        <a href='#' data-rel='quickviewmodal' onclick='mostrarDetallesProducto(\"" . $row->pro_idproducto . "\",\"" . $vista . "\");'>" . $row->pro_nombre . "</a>
    </h3>
</div>

<span class='product__price'>
    <ins>
        <span class='amount'>Precio: " . $row->pro_precio . " Bs 
        </span>
    </ins>
</span>

</div>

";
            }
        } else {
            echo "<div class='alert alert-danger alert-dismissable'>
            <h1 class='heading page-title__title letrasGrandes text-center'>¡Error! ¡No se encontro el producto!</h1>
        </div>
        ";
        }
    }


    public function mostrarDetallesProducto($idproducto, $vista)
    {

        $buscar = str_replace('_', ' ', $idproducto);
        $datos = "";

        $valorboton = '';
        $botonagregar = '';


        // strrpo
        // ver si tiene _ o no lo tiene para diferenciar el input del cantidad del carrito

        $sql1 = "SELECT pro.pro_idproducto, pro.pro_nombre, pro.pro_precio, pro.pro_cantidad, pro.pro_imagen, pro.pro_creado, tip.tip_nombre, tip.tip_peso FROM producto pro INNER JOIN tipo_producto tip ON pro.tip_id = tip.tip_id WHERE pro.pro_idproducto='$buscar' OR pro.pro_nombre like '%$buscar%' LIMIT 1";
        $query = self::ejecutarConsultaSimpleFila($sql1, $datos);
        // Revisar desde aqui
        if ($query) {
            $foto = empty($query->pro_imagen) ? '' : $query->pro_imagen;
            if ($vista == '') {
                $imagen = '<img src="SubidArchivos/archivos/articulosUsuario/' . $foto . '" alt="" style="width: 100%;height: 550px;" />';
            } else {
                $imagen = '<img src="http://localhost/SubidArchivos/archivos/articulosUsuario/' . $foto . '" alt="" style="width: 100%;height: 550px;" />';
            }

            if (strpos($idproducto, '_') !== false) {
                // aqui lo encontro
                $inputnumero = '<input type="number" id="cantidadid1" name="cantidadproductos" disabled="true" step="0" min="0" value="0" title="Qty" max="' . $query->pro_cantidad . '" class="input-text qty text">';
                $valorboton = 'busquedasolo';

                $botonagregar = '<a href="#" class="btn btn-lg btn-color product-single__add-to-cart" onclick="agregarProductoCarrito(\'' . $query->pro_idproducto . '\',\'' . $query->pro_precio . '\',\'' . $valorboton . '\');">
                <i class="ui-bag"></i>
                <span id="botonformulariocarrito">Agregar al Carrito</span></a>';
            } else {
                $inputnumero = '<input type="number" id="cantidadid2" name="cantidadproductos" disabled="true" step="0" min="0" value="0" title="Qty" max="' . $query->pro_cantidad . '" class="input-text qty2 text">';

                $valorboton = 'busquedamodal';
                $botonagregar = '<a href="#" class="btn btn-lg btn-color product-single__add-to-cart" onclick="agregarProductoCarrito(\'' . $query->pro_idproducto . '\',\'' . $query->pro_precio . '\',\'' . $valorboton . '\');">
                <i class="ui-bag"></i>
                <span id="botonformulariocarrito">Agregar al Carrito</span></a>';
            }
            echo '<div class="quickview-popup">
            <div class="row">
                <!-- start col img slider -->
                <div class="col-md-6 product-slider">
                    <div class="gallery-cell">
                        ' . $imagen . '
                    </div>
        
                    <div class="product_meta">
                        <ul>
                            <li>
                                <span class="product-country">Hecho en: <span>Venezuela. Estado. Barinas</span></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- end col img slider -->
        
                <div class="col-md-6 product-single">
                    <div class="quickview-popup__padding-box">
        
                        <h1 class="product-single__title uppercase">' . $query->pro_nombre . '</h1>
        
                        <span class="product-single__price">
                            <ins>
                                <h2 class="product-single__title uppercase">Precio <span class="amount" id="precioproductosolo">' . $query->pro_precio . ' </span>Bs</h2>
                            </ins>
                        </span>
        
        
                        <div class="size-quantity clearfix">
        
                            <div class="quantity">
                                <label>Cantidad ' . $query->pro_cantidad . ' ' . $query->tip_peso . '</label>
                            </div>
                        </div>
        
                        <form id="formulariocarrito">
        
                            <div class="row row-10 product-single__actions clearfix">
                                <div class="col text-center">
                                    <div class="quantity buttons_added">
                                        <input type="button" value="-" class="minus">
                                        ' . $inputnumero . '

                                        <input type="button" value="+" class="plus">
                                    </div>
                                </div>
                            </div>

                            <div class="row row-10 product-single__actions clearfix">
                                <div class="col">
                                <p class="bg-success product-single__title uppercase text-center" style="display:none" id="displaytotal">Precio total: <span id="preciosubtotal">189 Bs</span></p>
                                    <input type="hidden" id="pro_precio" value="' . $query->pro_precio . '">
                                </div>
                            </div>

                            <div class="row row-10 product-single__actions clearfix">
                                <div class="col">

                                    '.$botonagregar.'

                                </div>
                            </div>
        
                        </form>
        
        
        
                    </div>
        
                </div> <!-- end col product description -->
            </div> <!-- end row -->
        </div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissable"><h1 class="heading page-title__title letrasGrandes text-center">¡Error! ¡No se encontro el producto!</h1></div>';
        }
    }


    public function eliminartipo($idtipo)
    {
        // DELETE FROM tipo_producto WHERE tip_id = 6
        $datos = '';

        $sql1 = "DELETE FROM producto WHERE tip_id = '$idtipo'";
        $consulta1 = self::ejecutarConsulta($sql1, $datos);

        $sql = "DELETE FROM tipo_producto WHERE tip_id = '$idtipo'";
        $consulta = self::ejecutarConsulta($sql, $datos);

        if ($consulta1 && $consulta) {
            $sessData['estado']['type'] = 'success';
            $sessData['estado']['msg'] = 'Se elimino correctamente.';
        } else {
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'No se pudo eliminar.';
        }
        echo json_encode($sessData);
    }

    public function eliminarproducto($idproducto)
    {
        $datos = '';
        $sql1 = "DELETE FROM producto WHERE pro_idproducto = '$idproducto'";
        $consulta1 = self::ejecutarConsulta($sql1, $datos);

        if ($consulta1) {
            $sessData['estado']['type'] = 'success';
            $sessData['estado']['msg'] = 'Se elimino correctamente.';
        } else {
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'No se pudo eliminar.';
        }
        echo json_encode($sessData);
    }

    public function editartipoProducto($idtipo, $editar_nombre_tipo, $editar_peso_tipo)
    {

        $sql = "UPDATE tipo_producto SET tip_nombre = '$editar_nombre_tipo', tip_peso = '$editar_peso_tipo' WHERE tip_id = '$idtipo';";
        $datos = '';

        $consulta = self::ejecutarConsulta($sql, $datos);

        if ($consulta) {
            $sessData['estado']['type'] = 'success';
            $sessData['estado']['msg'] = 'Se actualizo correctamente.';
        } else {
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'No se pudo actualizar.';
        }
        echo json_encode($sessData);
    }

    public function editarProducto($editar_producto_id, $editar_nombre_producto, $editar_precio_producto, $editar_cantidad_producto, $editar_foto_producto, $creado)
    {
        if ($editar_foto_producto == '') {
            $sql = "UPDATE producto SET pro_nombre='$editar_nombre_producto', pro_precio = '$editar_precio_producto', pro_cantidad='$editar_cantidad_producto', pro_actualizado='$creado' WHERE pro_idproducto = '$editar_producto_id';";
        } else {
            $sql = "UPDATE producto SET pro_nombre='$editar_nombre_producto', pro_precio = '$editar_precio_producto', pro_cantidad='$editar_cantidad_producto', pro_imagen='$editar_foto_producto', pro_actualizado='$creado' WHERE pro_idproducto = '$editar_producto_id';";
        }
        $datos = '';

        $consulta = self::ejecutarConsulta($sql, $datos);

        if ($consulta) {
            $sessData['estado']['type'] = 'success';
            $sessData['estado']['msg'] = 'Se actualizo correctamente.';
        } else {
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'No se pudo actualizar.';
        }
        echo json_encode($sessData);
    }

    public function aprobarproducto($idproducto)
    {
        $sql = "UPDATE producto SET pro_estado = '1' WHERE pro_idproducto = '$idproducto';";
        $datos = '';

        $consulta = self::ejecutarConsulta($sql, $datos);

        if ($consulta) {
            $sessData['estado']['type'] = 'success';
            $sessData['estado']['msg'] = 'Se actualizo correctamente.';
        } else {
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'No se pudo actualizar.';
        }
        echo json_encode($sessData);
    }
    public function desactivarproducto($idproducto)
    {
        $sql = "UPDATE producto SET pro_estado = '0' WHERE pro_idproducto = '$idproducto';";
        $datos = '';

        $consulta = self::ejecutarConsulta($sql, $datos);

        if ($consulta) {
            $sessData['estado']['type'] = 'success';
            $sessData['estado']['msg'] = 'Se actualizo correctamente.';
        } else {
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'No se pudo actualizar.';
        }
        echo json_encode($sessData);
    }
}
