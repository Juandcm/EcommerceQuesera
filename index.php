<?php session_start();
// No me va a ningun error que puede tener el codigo php
error_reporting(-1);

$DataUsuario = !empty($_SESSION['DatosUsuario']) ? $_SESSION['DatosUsuario'] : '';
$permiso = isset($DataUsuario['usuario']['permiso']) ? $DataUsuario['usuario']['permiso'] : '';


// $servidor = 'https://localhost/';
$servidor = 'http://localhost/';

//Datos del carrito
$DataCarrito = !empty($_SESSION['cart_contents']) ? $_SESSION['cart_contents'] : '';

// Revisar esto aqui
// https://xd.adobe.com/view/9c74790d-4f37-4be0-70b0-d87a479e1034-ea45/?fullscreen
// https://xd.adobe.com/view/9efb6884-6158-48a5-4d96-1f0d791f26e5-e8ca/?fullscreen
// https://xd.adobe.com/view/f26085ed-03cb-4014-7375-f05a8bdea821-8451/?fullscreen
// https://www.pluralsight.com/browse?gclid=EAIaIQobChMIgOKC46-l4gIVCYTICh1s9QCWEAAYASABEgI5uvD_BwE&utm_term=sl_browse-courses&ef_id=EAIaIQobChMIgOKC46-l4gIVCYTICh1s9QCWEAAYASABEgI5uvD_BwE:G:s&s_kwcid=AL!5668!3!347411527606!e!!g!!pluralsight&aid=7010c0000022IqSAAU&promo=&oid=&utm_source=branded&utm_medium=digital_paid_search_google&utm_campaign=XYZ_NASA_Brand_E&utm_content=

if (!isset($_SESSION['DatosUsuario'])) {
	include_once "Vista/frontend.php";
} else {

	switch ($permiso) {
		case '0':
			include_once 'Vista/frontend.php';
			break;

		case '1':
			include_once 'Vista/CosasAdmin/Administrador/indexAdmin.php';
			break;

		default:
			break;
	}
}




// Hacer tabs para editar los tabs de la cuenta del banco

// Esta es la pagina: paginacastinblanco.000webhostapp.com

// Datos de las cuentas:
// gmail: queseraylacteos@gmail.com
// clave: losllanos

//https://app.postgrain.com/channel/form/
//queseraylacteos@gmail.com
//12345

// instagram: usuario: queseraylacteos
// clave: losllanos

// Client ID d392214c7a4f4ac2a78a80e8380039e0
// Client Secret 31b83166f94349e687c8c4b0bd938b48 
// https://api.instagram.com/v1/self/media/recent?access_token=d392214c7a4f4ac2a78a80e8380039e0


// Facebook: usuario: queseraylacteos@gmail.com
// clave: 123456losllanos
// nombre de app
// aplicaciontienda

//twitter: user: queseraylacteos@gmail.com
//pass: Juandcm1197*

// id de la app: 2047991688838148
// clave secreta de la app: c472a45695ecabcb0845a9b6d8229200
// TOKEN DE CLIENTE: 8d1d0b57a6cf274628bda0cb4d3b629a


// tiendanueva
// id de la app: 434887790406514
// clave secreta de la app: e315e0cdbb33e8e24597e99de80ddccc
// token nuevo: EAAGLhzRDq3IBAJ1c02RBPZCQnIJXKfHsGxuuqxWeGOplxWo0UHsS9TqfLbJlZAXpZBj8DZBV6dFbV3qUKxDVVBOl6x8Le8pfh7eZA4jSLncEzeVZCZAZChpKV4iR0a32Op0taxne806PYVGtxm2MjGUtiU6K4BaY78eGXhnfzoLGIXRKcZAYaevWb

// id del usuario de prueba: 106703850559680
// token del usuario de prueba: EAAGLhzRDq3IBAGKyPSbvFZAZB4psjJO9FwN6idEdKuwjEnCQRE9aSZAWH1VaKdaeKOy4RZAn1shxkuUJwDLbsOH0eYh6uBgTp3sPjyYRcL2nvn1yYGKgRxQ5Os4iNKe6oXGrKqpBwRY8VE2EEGJvZCDgqMbuNhBLUmtxIvB2fibF2Q8aFyDQZBcvEcK7WirtUk0vOZBVALw0ZApFzEETkZBZCp

// https://graph.facebook.com/434887790406514/feed?message=mensjaenuevo&access_token=EAAGLhzRDq3IBAOfaKZChoy4D9ggr7ZBaV0bM1FgdJHedJDm503e4LyLPr3mHw6LXqjk3Rl2dznFZAjP5CeQNAxztCdEPjy9FhKU7gcRd8iR2nHxpNZCTF5TQS7hWHZAsyscHAzYW3IE5QhZBWoZAVOlUTKhO8EMWyUZCX8iR9j7HXcPDoBuIi5E5GZBNQUbnEXIqCK12lB1HrPKaEOxvLPDfyZACBDQedmEl4ZD

// EAAGLhzRDq3IBALBs50ZCXFTsrLiJyw5OfWusXk9uCBCuTmCAJepESFkBACuuJgBSBIMVbnrGYYDmaMzi7yCm4kWbEeZBXNaa4HUAPaewYFzcHZCc6zZBqCQk5kiWtitKejhaBUqcG4vSwcNTGuwryjJF99iMe2KEy7FAzs9KL1gSMFGVAzjWs6B4Pjsd1EVhCyy4bBUuXYCcQhaSNSM7oF6EqjPByzAZD

// Token de cliente: f3cfba9926902e8bf7de0df4330a743e

// https://developers.facebook.com/apps/434887790406514/fb-login/settings/
// https://developers.facebook.com/apps/434887790406514/dashboard/


// Revisar
// https://www.instagram.com/developer/?fbclid=IwAR1w9tCKjuRQ9dwZ8tiujXGGIlva07wtwXeQHTUs_QqBw-rSoadhX87Kk5U
// https://developers.facebook.com/tools/explorer/?method=POST&path=&version=v3.3
// https://developers.facebook.com/docs/graph-api/reference/v3.0/page/feed
// https://developers.facebook.com/docs/graph-api/reference/page

// 000webhost
// usuario: correo
// clave: 123456789
// Contraseña del hosting: 1234567890
// nombre de la bd: paginacastinblancoweb
// usuario: juandcm
// contraseña: 1234567890

// Nombre del Host:
// files.000webhost.com
// Port: 21
// Usuario: paginacastinblanco
// contraseña: 1234567890

// Nombre de Base de Datos: id9510480_paginacastinblancoweb
// Usuario de Base de Datos: id9510480_juandcm
// Host de Base de datos: localhost

// https://databases-auth.000webhost.com/index.php




// Javascript de facebook
// <script>
//   window.fbAsyncInit = function() {
//     FB.init({
//       appId      : '{your-app-id}',
//       cookie     : true,
//       xfbml      : true,
//       version    : '{api-version}'
//     });
      
//     FB.AppEvents.logPageView();   
      
//   };

//   (function(d, s, id){
//      var js, fjs = d.getElementsByTagName(s)[0];
//      if (d.getElementById(id)) {return;}
//      js = d.createElement(s); js.id = id;
//      js.src = "https://connect.facebook.net/en_US/sdk.js";
//      fjs.parentNode.insertBefore(js, fjs);
//    }(document, 'script', 'facebook-jssdk'));
// </script>

// Login facebook
// FB.getLoginStatus(function(response) {
//     statusChangeCallback(response);
// });


// {
//     status: 'connected',
//     authResponse: {
//         accessToken: '...',
//         expiresIn:'...',
//         signedRequest:'...',
//         userID:'...'
//     }
// }

//  En status se especifica el estado de inicio de sesión de la persona que usa la aplicación. El estado puede ser uno de los siguientes:

//     connected: la persona inició sesión en Facebook y en tu aplicación.
//     not_authorized: la persona inició sesión en Facebook, pero no en tu aplicación.
//     unknown: la persona no inició sesión en Facebook y no sabes si lo hizo en tu aplicación o si se llamó antes al método FB.logout(), por lo que no puede conectarse a Facebook.

// authResponse: se incluye si el estado es connected, y consta de los siguientes elementos:

//     accessToken: contiene un token de acceso para la persona que usa la aplicación.
//     expiresIn: indica la hora UNIX en que el token caduca y se debe renovar.
//     signedRequest: un parámetro firmado que contiene información sobre la persona que usa la aplicación.
//     userID: es el identificador de la persona que usa la aplicación.


// <fb:login-button 
//   scope="public_profile,email"
//   onlogin="checkLoginState();">
// </fb:login-button>


// function checkLoginState() {
//   FB.getLoginStatus(function(response) {
//     statusChangeCallback(response);
//   });
// }


// tumblr: 
// user: queseraylacteos@gmail.com
// pass:  quesera1234
// aplicacion Quesera
// OAuth Consumer Key: gM2N8xYg4gJ2NAGYoLGGoBzKHGg7GX4dOHtxpPIXob1GG5p4Tz
// Secret Key:  7PP9WfRZpscKoTokicfU2hln25pDV8OpdpduqJ3yjkwTiF10Uc

// https://api.tumblr.com/v2/blog/queseralosllanos.tumblr.com/info?api_key=gM2N8xYg4gJ2NAGYoLGGoBzKHGg7GX4dOHtxpPIXob1GG5p4Tz
// https://queseralosllanos.tumblr.com/

// https://api.tumblr.com/v2/blog/queseralosllanos.tumblr.com/post?api_key=gM2N8xYg4gJ2NAGYoLGGoBzKHGg7GX4dOHtxpPIXob1GG5p4Tz
// vk:
// aplicacion Quesera
// ID de la app	6998311
// clave de seguridad: jPjeOTqUd5tJqPnex4ia
// token: cb7b37a5cb7b37a5cb7b37a538cb11fe82ccb7bcb7b37a597919ad05eaffa35b20dba07


// PARA SUBIR EN LA RED SOCIAL
// http://localhost/Controlador/redsocialControler.php?op=subirTumblr


// https://api.tumblr.com/console/calls/user/info
?>
