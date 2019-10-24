<?php
$id = !empty($DataUsuario['usuario']['id']) ? $DataUsuario['usuario']['id'] : '';
$nombre = !empty($DataUsuario['usuario']['nombre']) ? $DataUsuario['usuario']['nombre'] : '';
$email = !empty($DataUsuario['usuario']['email']) ? $DataUsuario['usuario']['email'] : '';
$telefono = !empty($DataUsuario['usuario']['telefono']) ? $DataUsuario['usuario']['telefono'] : '';
$foto_usuario = !empty($DataUsuario['usuario']['foto_usuario']) ? $DataUsuario['usuario']['foto_usuario'] : 'user-default.jpg';

$fechaOriginal = !empty($DataUsuario['usuario']['creado']) ? $DataUsuario['usuario']['creado'] : '';
$fechaFormateada = date("d-m-Y", strtotime($fechaOriginal));
$creadoDesde = $fechaFormateada;

$vista = isset($_GET['vista']) ? $_GET['vista'] : '';
$codigoproducto = isset($_REQUEST['codigo']) ? $_REQUEST['codigo'] : '';


//Datos del carrito de compras
$cart_total = isset($DataCarrito['cart_total']) ? $DataCarrito['cart_total'] : '';
$total_itemsviejo = isset($DataCarrito['total_items']) ? $DataCarrito['total_items'] : '0';
// '<img src="SubidArchivos/archivos/fotosUsuario/' . $foto_usuario . '" alt="user-img" class="img-circle">';

$valorcarrito = isset($DataCarrito) ? $DataCarrito : 0;
if ($valorcarrito == 0) {
	$total_items = 0;
}else{
	$total_items = count($valorcarrito) - 2;
}



$mostrarUsuario = '';
$mostrarDatosNuevos = '';
if (!empty($nombre)) {
	$mostrarUsuario = '<li class="menu-item-has-children megamenu megamenu-fullwidth dropdown"><a href="#" class="dropdown-hover sf-with-ul" data-toggle="modal" data-target="#usuarioModal"><span class="underline">Perfil</span></a>
	<ul class="dropdown-menu" style="display: none;">
	<li class="mega-col-1">
	<h2 class="text-center">' . $nombre . '</h2>
	<h5 class="megamenu-title">
	<div class="text-center">
	<span>
	Creado desde: ' . $creadoDesde . ' 
	</span><br>
	<span>
	Editado el: ' . $creadoDesde . '
	</span>
	</div>
	<div class="text-center mt-2">
	<a href="#" data-toggle="modal" data-target="#usereditarModal">
	<button class="btn btn-lg btn-color marginrigth5px">Editar</button>
	</a>
	<a href="carrito">
	<button class="btn btn-lg btn-black marginrigth5px">Ver carrito</button>
	</a>
	<a href="mensaje">
	<button class="btn btn-lg btn-color marginrigth5px">Mensajes</button>
	</a>
	<a href="completarcompra">
	<button class="btn btn-lg btn-color mt-1">Ver Compras</button>
	</a>
	</div>
	</h5>
	
	<ul class="dropdown-menu" style="display: none;">
	<li><img src="SubidArchivos/archivos/fotosUsuario/' . $foto_usuario . '" alt="user-img" class="img-circle" style="border: 1px solid black;margin-left: 30%;height: 190px;width: 220px;"></li>
	</ul>
	

	</li>
	</ul></li>';

	$mostrarDatosNuevos = '<li class="menu-item-has-children dropdown current-menu-ancestor">
	<a href="./" class="dropdown-hover">Perfil <span class="caret"></span></a>
	<ul class="dropdown-menu">
	<h2 class="text-center">' . $nombre . '</h2>
	<h5 class="megamenu-title">Creado desde: ' . $creadoDesde . ' <span class="caret"></span></h5>
	<li><img src="SubidArchivos/archivos/fotosUsuario/' . $foto_usuario . '" alt="user-img" class="img-circle" style="border: 1px solid black;margin-left: 12%;height: 150px;width: 190px;"></li>
	<li>

	<a href="#" data-toggle="modal" data-target="#usereditarModal">
	<button class="btn btn-lg btn-color marginrigth5px">Editar</button>
	</a>
	<a href="carrito">
	<button class="btn btn-lg btn-black marginrigth5px">Ver carrito</button>
	</a>
	<a href="completarcompra">
	<button class="btn btn-lg btn-black marginrigth5px">Ver Compras</button>
	</a>
	<a href="mensaje">
	<button class="btn btn-lg btn-color marginrigth5px">Mensajes</button>
	</a>

	
	</li>	
	</ul>
	</li>';
}
?>


<!doctype html>
<html lang="en-US">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
	<title>Quesera y Lácteos los Llanos</title>
	<link rel="shortcut icon" href="SubidArchivos/logosolo.png">

	<link rel='stylesheet' href='<?= $servidor; ?>Vista/CosasFrontend/css/settings.css' type='text/css' media='all' />
	<link rel='stylesheet' href='<?= $servidor; ?>Vista/CosasFrontend/css/bootstrap.min.css' type='text/css' media='all' />
	<link rel='stylesheet' href='<?= $servidor; ?>Vista/CosasFrontend/css/font-awesome.min.css' type='text/css' media='all' />
	<link rel='stylesheet' href='<?= $servidor; ?>Vista/CosasFrontend/css/font-icons.css' type='text/css' media='all' />
	<!-- <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Karla:400,400italic,700,700italic%7CCrimson+Text:400,400italic,600,600italic,700,700italic' type='text/css' media='all' /> -->
	<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700"> -->
	<link rel="stylesheet" href="<?= $servidor; ?>Vista/CosasFrontend/css/animate.css">
	<link rel='stylesheet' href='<?= $servidor; ?>Vista/CosasFrontend/css/elegant-icon.css' type='text/css' media='all' />


	<link rel="stylesheet" type="text/css" href="<?= $servidor; ?>Vista/CosasGenerales/css/sweetalert2.min.css">
	<link rel="stylesheet" type="text/css" href="<?= $servidor; ?>Vista/CosasGenerales/css/fine-uploader-new.css">

	<!-- Datatable -->
	<link rel="stylesheet" href="<?= $servidor; ?>Vista/CosasGenerales/css/datatable/jquery.dataTables.min.css">
	<link rel="stylesheet" href="<?= $servidor; ?>Vista/CosasGenerales/css/datatable/responsive.dataTables.min.css">
	<link rel="stylesheet" href="<?= $servidor; ?>Vista/CosasGenerales/css/jquery-ui.custom.css">


	<link rel='stylesheet' href='<?= $servidor; ?>Vista/CosasFrontend/css/styleheader.css' type='text/css' media='all' />
	<link rel='stylesheet' href='<?= $servidor; ?>Vista/CosasFrontend/css/commerce.css' type='text/css' media='all' />
	<link rel='stylesheet' href='<?= $servidor; ?>Vista/CosasFrontend/css/custom.css' type='text/css' media='all' />
	<link rel="stylesheet" href="<?= $servidor; ?>Vista/CosasFrontend/css/stylebotones.css">
	<link rel="stylesheet" href="<?= $servidor; ?>Vista/CosasFrontend/css/stylefooter.css">
	<link rel="stylesheet" href="<?= $servidor; ?>Vista/CosasFrontend/css/style.css">

</head>

<body>

	<!-- Preloader -->
	<div class="loader-mask">
		<div class="loader">
			<div></div>
		</div>
	</div>
	<!-- Preloader -->

	<!-- Boton volver inicio -->
	<div id="back-to-top" class="show">
		<a href="#top"><i class="ui-arrow-up"></i></a>
	</div>
	<!-- Boton volver inicio -->


	<!-- ESTE ES EL MENU LATERAL -->
	<div class="offcanvas open">
		<div class="offcanvas-wrap">
			<div class="offcanvas-user clearfix">

				<?php
				if (!empty($nombre)) {
					echo '<a class="offcanvas-user-account-link salirsession" href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Salir"><i class="fa fa-power-off"></i> Salir</a>
					</a>';
				} else {
					echo '<a class="offcanvas-user-account-link" data-rel="loginModal" href="#"><i class="fa fa-user"></i> Ingresar</a>';
				}
				?>


			</div>
			<nav class="offcanvas-navbar">
				<ul class="offcanvas-nav">
					<li><a href="./"><span class="underline">Inicio</span></a></li>
					<li><a href="#" data-toggle="modal" data-target="#quienesomosModal"><span class="underline">Quienes Somos</span></a></li>
					<li><a href="#" data-toggle="modal" data-target="#preguntasModal"><span class="underline">Preguntas Frecuentes</span></a></li>
					<!-- Revisar aqui -->


					<?php
					echo $mostrarDatosNuevos;
					?>




				</ul>
			</nav>
		</div>
	</div>
	<!-- fIN DEL MENU LATERAL -->

	<!-- Inicio del contenido principal -->
	<div id="wrapper" class="wide-wrap">
		<div class="offcanvas-overlay"></div>
		<header class="header-container header-type-classic header-navbar-classic header-scroll-resize">

			<div class="navbar-container">
				<div class="navbar navbar-default navbar-scroll-fixed navbar-fixed-top fixed-transition">
					<div class="navbar-default-wrap">
						<div class="container">
							<div class="row">
								<div class="navbar-default-col">
									<div class="navbar-wrap">
										<div class="navbar-header">
											<button type="button" class="navbar-toggle">
												<span class="sr-only">Toggle navigation</span>
												<span class="icon-bar bar-top"></span>
												<span class="icon-bar bar-middle"></span>
												<span class="icon-bar bar-bottom"></span>
											</button>
											<a class="navbar-search-button search-icon-mobile" href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Buscar">
												<i class="fa fa-search"></i>
											</a>


											<a class="search-icon-mobile" href="./compras" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Compras">
												<span class="minicart-icon">
													<i class="fa fa-shopping-cart"></i>
													<span><?= $total_items; ?></span>
												</span>
											</a>


											<?php
											if (!empty($nombre)) {
												echo '<a class="search-icon-mobile" href="./mensaje" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Mensaje">
												<span class="minicart-icon">
												<i class="fa fa-envelope"></i>
												<span>0</span>
												</span>
												</a>';

												echo '<a class="search-icon-mobile salirsession" href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Salir">
												<i class="fa fa-power-off"></i>
												</a>';
											} else {
												echo '<a class="search-icon-mobile" href="#" data-rel="loginModal">
												<i class="fa fa-user" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Entrar"></i>
												</a>';
											}


											if (!empty($codigoproducto)) {
												echo '<a class="navbar-brand" href="../../">
												<img class="logo" alt="WOOW" src="' . $servidor . 'SubidArchivos/logoquienes.png">
												<img class="logo-fixed" alt="WOOW" src="' . $servidor . 'SubidArchivos/logoquienes.png">
												<img class="logo-mobile" alt="WOOW" src="' . $servidor . 'SubidArchivos/logoquienes.png">
												</a>';
											} else {
												echo '<a class="navbar-brand" href="./">
												<img class="logo" alt="WOOW" src="' . $servidor . 'SubidArchivos/logoquienes.png">
												<img class="logo-fixed" alt="WOOW" src="' . $servidor . 'SubidArchivos/logoquienes.png">
												<img class="logo-mobile" alt="WOOW" src="' . $servidor . 'SubidArchivos/logoquienes.png">
												</a>';
											}

											?>
										</div>
										<!-- Inicio del menu centrado -->
										<nav class="collapse navbar-collapse primary-navbar-collapse">
											<ul class="nav navbar-nav primary-nav">

												<?php

												if (!empty($codigoproducto)) {
													echo '<li><a href="../../"><span class="underline">Inicio</span></a></li>';
												} else {
													echo '<li><a href="./"><span class="underline">Inicio</span></a></li>';
												}
												?>

												<li><a href="#" data-toggle="modal" data-target="#quienesomosModal"><span class="underline">Quienes Somos</span></a></li>
												<li><a href="#" data-toggle="modal" data-target="#preguntasModal"><span class="underline">Preguntas Frecuentes</span></a></li>
												<!-- Revisar aqui -->
												<?= $mostrarUsuario; ?>
											</ul>
										</nav>

										<!-- Fin del menu centrado -->
										<!-- Inicio de los iconos laterales -->
										<div class="header-right">
											<div class="navbar-search" style="display: ruby-base; border-left: 0px solid #e5e5e5;">
												<a class="navbar-search-button" href="#">
													<i class="fa fa-search" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Buscar"></i>
												</a>
												<div class="search-form-wrap show-popup hide"></div>
											</div>


											<div class="navbar-minicart navbar-minicart-topbar">
												<div class="navbar-minicart">
													<!-- <a class="minicart-link" href="#"> -->
													<a class="wishlist" href="./carrito">
														<span class="minicart-icon">
															<i class="fa fa-shopping-cart" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Compras"></i>
															<span><?= $total_items; ?></span>
														</span>
													</a>
												</div>
											</div>

<!-- <div class="dropdown inline open">
        <a href="#" class="wishlist dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><span class="minicart-icon">
                <i class="fa fa-shopping-cart" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Compras"></i>
                <span><?= $total_items; ?></span>
        </span> </a>
        <div class="dropdown-menu pull-right"><li class="bg-success">
        	<div class="drop-title text-center">Carrito de Compras</div><hr></li><li>
                <div class="message-center">

<?php if ($total_items > 0){ ?>
                    <p>
                    Tienes <span class="amount"><?=$total_items;?></span> Productos en el carrito    
                    </p>
                    <hr>
                    <p>
                    El monto total es de <span class="amount"><?=$cart_total;?> Bs</span>
                    </p>
                <?php }else{ ?>
                    <span class="amount">No tienes ningún producto en tu carrito</span>
                <?php } ?>



                </div>
                <hr>
        </li><li><a class="btn btn-lg btn-color text-center" href="./carrito"><strong>Ir a tu carrito</strong></a></li></div>
</div> -->

											<!-- Revisar -->

											<?php
											if (!empty($nombre)) {


												echo '

												<div class="dropdown inline">
												<a href="#" class="wishlist dropdown-toggle" data-toggle="dropdown" aria-expanded="false" id="botonotificacionusuario"><span class="minicart-icon">
			<i class="fa fa-envelope" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Mensajes"></i>
			<span id="cantidadnotificacionUsuario">0</span>
		</span> </a>
												<div class="dropdown-menu pull-right" id="mostrarmensajesnotifcacionUsuario">
												</div>
												</div>


												';

												echo '<div class="navbar-wishlist">
												<a class="wishlist salirsession" href="#">
												<i class="fa fa-power-off" data-toggle="tooltip" data-placement="bottom" data-original-title="Salir"></i>
												</a></div></div>
												';
											} else {
												echo '<div class="navbar-wishlist"><a class="wishlist" href="#" data-rel="loginModal">
												<i class="fa fa-user" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Entrar"></i>
												</a></div>';
											}
											?>



										</div>




										<!-- Fin de los iconos laterales -->

									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="header-search-overlay hide">
						<div class="container">
							<div class="header-search-overlay-wrap">
								<form class="searchform" id="buscarProductoFront">
									<input type="search" class="searchinput" name="buscarnombreproducto" id="buscarnombreproducto" autocomplete="on" value="" placeholder="Buscar Producto" />
								</form>
								<button type="button" class="close">
									<span aria-hidden="true" class="fa fa-times"></span>
									<span class="sr-only">Close</span>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
		<div class="content-container no-padding">
			<div class="container-full">
				<div class="main-content">
					<div class="container">
						<div class="row row-fluid pt-6 pb-6">
							<div class="col-sm-12">
								<div class="box-ft box-ft-5">

									<?php
									// echo "<pre>";
									// var_dump($DataCarrito);
									// echo "</pre>";

									switch ($vista) {

										case 'completarcompra':
										if (!empty($nombre)) {
											include_once 'Vista/CosasFrontend/Vistas/completarcompra.php';
										}else{
											include_once 'Vista/CosasFrontend/Vistas/productosenventa.php';
										}
										break;
										case 'mensaje':
										if (!empty($nombre)) {
											include_once 'Vista/CosasFrontend/Vistas/mensaje.php';
										}else{
											include_once 'Vista/CosasFrontend/Vistas/productosenventa.php';
										}
										break;

										case 'carrito':
										include_once 'Vista/CosasFrontend/Vistas/carrito_compra.php';
										break;


										case 'restaurar':
										if (!empty($nombre)) {
											include_once 'Vista/CosasFrontend/Vistas/paginaerror.php';
										} else {
											include_once 'Vista/CosasFrontend/Vistas/reenviar_contraseña.php';
										}
										break;
										case 'detalleproducto':
										include_once 'Vista/CosasFrontend/Vistas/producto_solo.php';
										include_once 'Vista/CosasFrontend/Vistas/productosenventa.php';
										break;

										default:
										include_once 'Vista/CosasFrontend/Vistas/productosenventa.php';
										break;
									}
									?>




								</div>
							</div>

							<!-- ////////////////////////////////////////////// -->
							<?php
							// Inicio del carrito de compras
							// include_once 'Vista/CosasFrontend/Vistas/carrito_compra.php';
							// Fin del carrito de compras
							?>
							<!-- ////////////////////////////////////////////// -->

						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
		// Foooter inicio
		include_once 'Vista/CosasFrontend/Vistas/footer.php';
		// FOOTER FIN
		?>
	</div>
	<!-- Fin del contenido principal -->

	<?php
	// Inicio de barra lateral derecha
	include_once 'Vista/CosasFrontend/Vistas/barra_lateral.php';
	// Fin de barra lateral derecha

	// Inicio de los modales
	if (empty($nombre)) {
		include_once 'Vista/CosasFrontend/Vistas/login.php';
		include_once 'Vista/CosasFrontend/Vistas/registrar.php';
		include_once 'Vista/CosasFrontend/Vistas/enviar_correo.php';
	} else {
		include 'Vista/CosasGenerales/Vistas/editarUsuario.php';
	}
	include_once 'Vista/CosasFrontend/Vistas/quienesomos.php';
	include_once 'Vista/CosasFrontend/Vistas/preguntasmodal.php';
	// Fin de los modales
	?>

	<script type="text/template" id="qq-template-validation">
		<?php
		include_once "Vista/PlantillaSubidaFiles.php";
		?>
	</script>

	<script src='<?= $servidor; ?>Vista/CosasFrontend/js/jquery.min.js'></script>
	<script src='<?= $servidor; ?>Vista/CosasFrontend/js/jquery-migrate.min.js'></script>
	<script src='<?= $servidor; ?>Vista/CosasFrontend/js/easing.min.js'></script>
	<script src='<?= $servidor; ?>Vista/CosasFrontend/js/bootstrap.min.js'></script>
	<script src='<?= $servidor; ?>Vista/CosasFrontend/js/superfish-1.7.4.min.js'></script>
	<script src="<?= $servidor; ?>Vista/CosasFrontend/js/owl-carousel.min.js"></script>
	<script src="<?= $servidor; ?>Vista/CosasFrontend/js/modernizr.min.js"></script>
	<script src="<?= $servidor; ?>Vista/CosasFrontend/js/flickity.pkgd.min.js"></script>
	<script src="<?= $servidor; ?>Vista/CosasFrontend/js/jquery.magnific-popup.min.js"></script>


	<script src="<?= $servidor; ?>Vista/CosasGenerales/js/sweetalert2.min.js"></script>
	<script src="<?= $servidor; ?>Vista/CosasGenerales/js/jquery.fine-uploader.min.js"></script>
	<script src="<?= $servidor; ?>Vista/CosasGenerales/js/jquery.validate.min.js"></script>

	<script src="<?= $servidor; ?>Vista/CosasGenerales/js/datatable/jquery.dataTables.min.js"></script>
	<script src="<?= $servidor; ?>Vista/CosasGenerales/js/datatable/dataTables.buttons.min.js"></script>
	<script src="<?= $servidor; ?>Vista/CosasGenerales/js/datatable/dataTables.responsive.min.js"></script>
	<script src="<?= $servidor; ?>Vista/CosasGenerales/js/jquery-ui-tabs.js"></script>

	<script src='<?= $servidor; ?>Vista/CosasFrontend/js/scriptheader.js'></script>
	<script src="<?= $servidor; ?>Vista/CosasFrontend/js/scriptsprincipal.js"></script>

	<script src="<?= $servidor; ?>Vista/CosasGenerales/js/Interaccion.js"></script>

</body>

</html>