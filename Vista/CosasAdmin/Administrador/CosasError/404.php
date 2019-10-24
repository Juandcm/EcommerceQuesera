<!DOCTYPE html>
<html lang="en">
    
<?php
$servidor = 'https://localhost/Vista/CosasAdmin/Administrador';
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../../plugins/images/favicon.png">
    <title>Error</title>
    <!-- ===== Bootstrap CSS ===== -->
    <link href="<?=$servidor;?>/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- ===== Plugin CSS ===== -->
    <!-- ===== Animation CSS ===== -->
    <link href="<?=$servidor;?>/css/animate.css" rel="stylesheet">
    <!-- ===== Custom CSS ===== -->
    <link href="<?=$servidor;?>/css/style.css" rel="stylesheet">
    <!-- ===== Color CSS ===== -->
    <link href="<?=$servidor;?>/css/colors/green-dark.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="mini-sidebar">
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <section id="wrapper" class="error-page">
        <div class="error-box">
            <div class="error-body text-center">
                <h1>404</h1>
                <h3 class="text-uppercase">¡Página no encontrada!</h3>
                <p class="text-muted m-t-30 m-b-30">Pareces estar intentando encontrar tu camino a casa</p>
                <a href="../../" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">Regresar al inicio</a> </div>
            <footer class="footer text-center">2019 © Quesera y Lácteos los Llanos.</footer>
        </div>
    </section>
    <!-- jQuery -->
    <script src="<?=$servidor;?>/../plugins/components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?=$servidor;?>/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(function() {
        $(".preloader").fadeOut();
    });
    </script>
</body>

</html>
