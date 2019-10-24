<?php
$id = $DataUsuario['usuario']['id'];
$nombre = $DataUsuario['usuario']['nombre'];
$email = $DataUsuario['usuario']['email'];
$telefono = $DataUsuario['usuario']['telefono'];
$foto_usuario = !empty($DataUsuario['usuario']['foto_usuario']) ? $DataUsuario['usuario']['foto_usuario'] : 'user-default.jpg';


$fechaOriginal = $DataUsuario['usuario']['creado'];
$fechaFormateada = date("d-m-Y", strtotime($fechaOriginal));
$creadoDesde = $fechaFormateada;

$fechaOriginalActualizado = $DataUsuario['usuario']['actualizado'];
$fechaFormateada2 = date("d-m-Y", strtotime($fechaOriginalActualizado));
$actualizado = $fechaFormateada2;


$fechas = ($fechaOriginalActualizado == '') ? '<p class="text-center">Creado el: ' . $creadoDesde . '</p>' : '<p class="text-center">Creado el: ' . $creadoDesde . '</p><p class="text-center">Actualizado el: ' . $actualizado . '</p>';

$vista = isset($_GET['vista']) ? $_GET['vista'] : '';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="SubidArchivos/logosolo.png">
    <title>Quesera y Lácteos los Llanos</title>
    <!-- ===== Bootstrap CSS ===== -->
    <link href="Vista/CosasAdmin/Administrador/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- ===== Plugin CSS ===== -->
    <!-- ===== Animation CSS ===== -->
    <link href="Vista/CosasAdmin/Administrador/css/animate.css" rel="stylesheet">
    <!-- ===== Custom CSS ===== -->
    <link href="Vista/CosasAdmin/Administrador/css/style.css" rel="stylesheet">
    <!-- ===== Color CSS ===== -->
    <link href="Vista/CosasAdmin/Administrador/css/colors/default-dark.css" id="theme" rel="stylesheet">

    <link rel="stylesheet" href="Vista/CosasFrontend/css/stylebotones.css">

    <link rel="stylesheet" type="text/css" href="Vista/CosasGenerales/css/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="Vista/CosasGenerales/css/fine-uploader-new.css">

    <!-- Datatable -->
    <link rel="stylesheet" href="Vista/CosasGenerales/css/datatable/jquery.dataTables.min.css">
    <link rel="stylesheet" href="Vista/CosasGenerales/css/datatable/responsive.dataTables.min.css">
    <link rel="stylesheet" href="Vista/CosasGenerales/css/jquery-ui.custom.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="mini-sidebar fix-sidebar fix-header">
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper">
        <!-- ===== Top-Navigation ===== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <a class="navbar-toggle font-20 hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="top-left-part">
                    <a class="logo" href="#">
                        <b>
                            <img src="SubidArchivos/logosolo.png" alt="home" style="width: 30px;height: 34px;" />
                        </b>
                        <span style="font-size: 0.6em;">
                            Quesera y Lácteos los Llanos
                        </span>
                    </a>
                </div>
                <ul class="nav navbar-top-links navbar-left hidden-xs">
                    <li>
                        <a href="javascript:void(0)" class="sidebartoggler font-20 waves-effect waves-light"><i class="icon-arrow-left-circle"></i></a>
                    </li>
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle waves-effect waves-light font-20" data-toggle="dropdown" href="javascript:void(0);" id="botonotificacion">
                            <i class="icon-speech"></i>
                            <span class="badge badge-xs badge-danger" id="cantidadnotificacion">4</span>
                        </a>
                        <ul class="dropdown-menu mailbox animated bounceInDown" id="mostrarmensajesnotifcacion">
                            
                        </ul>
                    </li>
                    <li class="right-side-toggle">
                        <a class="right-side-toggler waves-effect waves-light b-r-0 font-20" href="javascript:void(0)">
                            <i class="icon-settings"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- ===== Top-Navigation-End ===== -->
        <!-- ===== Left-Sidebar ===== -->
        <aside class="sidebar" role="navigation">
            <div class="scroll-sidebar">
                <div class="user-profile">
                    <div class="dropdown user-pro-body">
                        <div class="profile-image">
                            <img src="SubidArchivos/archivos/fotosUsuario/<?= $foto_usuario ?>" alt="user-img" class="img-circle">
                            <a href="javascript:void(0);" class="dropdown-toggle u-dropdown text-blue" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="badge badge-danger">
                                    <i class="fa fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu animated flipInY">
                                <li><a href="#" data-toggle="modal" data-target="#usereditarModal"><i class="fa fa-user"></i> Perfil</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="mensaje"><i class="fa fa-inbox"></i> Mensajes</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#" class="salirsession"><i class="fa fa-power-off"></i> Salir</a></li>
                            </ul>
                        </div>
                        <p class="profile-text m-t-15 font-16"><a href="javascript:void(0);"><?= $nombre ?></a></p>
                    </div>
                </div>
                <nav class="sidebar-nav">
                    <ul id="side-menu">
                        <li>
                            <a class="waves-effect" href="./" aria-expanded="false"><i class="fa fa-bar-chart-o fa-fw"></i> <span class="hide-menu"> Escritorio </span>
                            </a>
                        </li>
                        <li>
                            <a class="waves-effect" href="ventas" aria-expanded="false"><i class="icon-basket fa-fw"></i> <span class="hide-menu"> Ventas </span></a>
                        </li>
                        <li>
                            <a class="waves-effect" href="producto" aria-expanded="false"><i class="fa fa-briefcase fa-fw"></i> <span class="hide-menu"> Productos </span></a>
                        </li>
                        <li>
                            <a class="waves-effect" href="usuario" aria-expanded="false"><i class="icon-people fa-fw"></i> <span class="hide-menu"> Usuarios
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="waves-effect" href="mensaje" aria-expanded="false"><i class="icon-envelope-letter fa-fw"></i> <span class="hide-menu"> Mensajes
                                </span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- ===== Left-Sidebar-End ===== -->
        <!-- Page Content -->
        <div class="page-wrapper">
            <div class="container-fluid">



                <?php
                switch ($vista) {
                    case 'producto':
                        include 'Vistas/productos/productos.php';
                        break;

                    case 'mensaje':
                        include 'Vistas/mensajes/mensajes.php';
                        break;

                    case 'usuario':
                        include 'Vistas/usuarios/usuarios.php';
                        break;

                    case 'ventas':
                        include 'Vistas/ventas/ventas.php';
                        break;

                    default:
                        include 'Vistas/escritorio/escritorio.php';
                        break;
                }
                ?>




                <!-- ===== Right-Sidebar ===== -->
                <div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Panel de Servicio <span><i class="icon-close right-side-toggler"></i></span> </div>
                        <div class="r-panel-body">


                            <div class="profile-image">
                                <img src="SubidArchivos/archivos/fotosUsuario/<?= $foto_usuario ?>" alt="user-img" class="img-circle img-center">
                                <p class="profile-text m-t-15 font-16 text-center">
                                    <?= $nombre ?>
                                    <?= $fechas ?>
                                </p>

                                <ul class="m-t-20 chatonline text-center">
                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#usereditarModal"><i class="fa fa-user"></i> Perfil</a>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li> <a href="mensaje">
                                            <i class="fa fa-inbox"></i> Mensajes</a>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <button type="button" class="btn btn-danger salirsession">
                                            <i class="fa fa-power-off"></i> Salir
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ===== Right-Sidebar-End ===== -->
            </div>
            <!-- /.container-fluid -->
            <footer class="footer t-a-c"> © 2019
            </footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->










    <!-- Incluyendo los modales -->
    <?php
    include 'Vista/CosasGenerales/Vistas/editarUsuario.php';
    ?>



    <script type="text/template" id="qq-template-validation">
        <?php
        include_once "Vista/PlantillaSubidaFiles.php";
        ?>
	</script>



    <!-- ==============================
        Required JS Files
    =============================== -->
    <!-- ===== jQuery ===== -->
    <script src="Vista/CosasAdmin/plugins/components/jquery/dist/jquery.min.js"></script>
    <!-- ===== Bootstrap JavaScript ===== -->
    <script src="Vista/CosasAdmin/Administrador/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- ===== Slimscroll JavaScript ===== -->
    <script src="Vista/CosasAdmin/Administrador/js/jquery.slimscroll.js"></script>
    <!-- ===== Wave Effects JavaScript ===== -->
    <script src="Vista/CosasAdmin/Administrador/js/waves.js"></script>
    <!-- ===== Menu Plugin JavaScript ===== -->
    <script src="Vista/CosasAdmin/Administrador/js/sidebarmenu.js"></script>
    <!-- ===== Custom JavaScript ===== -->
    <script src="Vista/CosasAdmin/Administrador/js/custom.js"></script>
    <!-- ===== Plugin JS ===== -->

    <script src="Vista/CosasGenerales/js/sweetalert2.min.js"></script>
    <script src="Vista/CosasGenerales/js/jquery.fine-uploader.min.js"></script>
    <script src="Vista/CosasGenerales/js/jquery.validate.min.js"></script>

    <script src="Vista/CosasGenerales/js/datatable/jquery.dataTables.min.js"></script>
    <script src="Vista/CosasGenerales/js/datatable/dataTables.buttons.min.js"></script>
    <script src="Vista/CosasGenerales/js/datatable/dataTables.responsive.min.js"></script>
    <script src="Vista/CosasGenerales/js/jquery-ui-tabs.js"></script>

    <script id="myscript" src="Vista/CosasGenerales/js/Interaccion.js"></script>

</body>

</html>