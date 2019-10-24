// Ejecucion de los datatables

// Esto sirve para los tooltip del datatables de bootstrap
$('body').tooltip({ selector: '[data-toggle="tooltip"]' });

var swalWithBootstrapButtons = swal.mixin({
    confirmButtonClass: 'btn btn-success',
    cancelButtonClass: 'btn btn-danger',
    buttonsStyling: false
});

// Aqui muestra el swall alert del tipo error
function alertaError(valorestado, valormsg) {
    swal({
        type: valorestado,
        title: 'Error',
        text: valormsg,
        showConfirmButton: false,
        timer: 3000
    });
}
// Aqui muestra el swall alert del tipo success
function alertaSuccess(valorestado, valormsg) {
    swal({
        type: valorestado,
        title: 'Exito',
        text: valormsg,
        showConfirmButton: false,
        timer: 3000
    });
}

function recargarPagina(direccion) {
    if (direccion.length > 0) {
        setTimeout(function () {
            window.location.replace(direccion);
        }, 2000);
    } else {
        setTimeout(function () {
            window.location.reload(true);
        }, 2000);
    }

}

function recargarPaginAnimada(direccion) {
    if (direccion.length > 0) {
        setTimeout(function () {
            $('body').html("<div class='preloader'><div class='cssload-speeding-wheel'></div></div>");
            window.location.replace(direccion);
        }, 5000);
    } else {
        setTimeout(function () {
            $('body').html("<div class='preloader'><div class='cssload-speeding-wheel'></div></div>");
            window.location.reload(true);
        }, 5000);
    }

}

function elimininarDespuesde() {
    setTimeout(function () {
        $("#eliminarImagenForm").click();
    }, 4000);
}

function eliminarImagen() {
    $('#foto_usuario').val('');
    $('#url_archivo').val('');
}

//////////////////////////////////////
// Inicio de las Validaciones
///////////////////////////////////////

// Subida de la foto del usuario con Fine uploader
$("#fine-uploader-validation_foto").fineUploader({
    // Aqui me muestra la plantilla personalizada
    template: 'qq-template-validation',
    // Aqui me muestra los mensajes en la consola
    debug: false,
    multiple: false,
    autoUpload: true,
    request: {
        endpoint: 'Modelo/FineUploader/FotoUsuario.php'
    },
    thumbnails: {
        placeholders: {
            waitingPath: '/Vista/CosasGenerales/js/placeholders/waiting-generic.png',
            notAvailablePath: '/Vista/CosasGenerales/js/placeholders/not_available-generic.png'
        }
    },
    validation: {
        itemLimit: 1,
        sizeLimit: 5120000, // 50 kB = 50 * 1024 bytes
        acceptFiles: "image/jpeg, image/jpeg, image/png, image/gif",
        allowedExtensions: ['jpeg', 'jpg', 'png', 'gif']
    },
    resume: {
        enabled: true
    },
    retry: {
        enableAuto: true,
        showButton: true
    },
    deleteFile: {
        enabled: true,
        endpoint: "Modelo/FineUploader/FotoUsuario.php"
    }
}).on('error', function (event, id, name, reason) {
    console.log(event);
    console.log(reason);
}).on('complete', function (event, id, name, response) {
    ubicacionFoto = response.uuid + "/" + response.uploadName;
    valorFoto = $('#foto_usuario').val(ubicacionFoto);
});

// Este codigo borra todo cuando se cierra el modal
$('#userregisterModal').on('hidden.bs.modal', function () {
    $('#userregisterModalForm input').val('');
    if ($('#foto_usuario').val() == '') {
        elimininarDespuesde();
    } else { }
});

$('#editartipoproductoModal').on('hidden.bs.modal', function () {
    $('#editartipoproductoForm input').val('');
});

$('#enviarmensjaeModal').on('hidden.bs.modal', function () {
    $('#enviarmensjaeModalForm input').val('');
});

// Subida del mensaje del usuario con Fine uploader
$("#fine-uploader-validation_mensaje").fineUploader({
    // Aqui me muestra la plantilla personalizada
    template: 'qq-template-validation',
    // Aqui me muestra los mensajes en la consola
    debug: false,
    multiple: false,
    autoUpload: true,
    request: {
        endpoint: 'Modelo/FineUploader/MensajeUsuario.php'
    },
    thumbnails: {
        placeholders: {
            waitingPath: '/Vista/CosasGenerales/js/placeholders/waiting-generic.png',
            notAvailablePath: '/Vista/CosasGenerales/js/placeholders/not_available-generic.png'
        }
    },
    validation: {
        itemLimit: 1,
        sizeLimit: 5120000, // 50 kB = 50 * 1024 bytes
        acceptFiles: "image/jpeg, image/jpeg, image/png, image/gif",
        allowedExtensions: ['jpeg', 'jpg', 'png', 'gif']
    },
    resume: {
        enabled: true
    },
    retry: {
        enableAuto: true,
        showButton: true
    },
    deleteFile: {
        enabled: true,
        endpoint: "Modelo/FineUploader/MensajeUsuario.php"
    }
}).on('error', function (event, id, name, reason) {
    console.log(event);
    console.log(reason);
}).on('complete', function (event, id, name, response) {
    ubicacionFoto = response.uuid + "/" + response.uploadName;
    valorFoto = $('#mensaje_usuario').val(ubicacionFoto);
    // valorFoto = $('#editar_foto_producto').val(ubicacionFoto);
});













// Subida de la transferencia de la compra del usuario con Fine uploader
$("#fine-uploader-validation_transferencia").fineUploader({
    // Aqui me muestra la plantilla personalizada
    template: 'qq-template-validation',
    // Aqui me muestra los mensajes en la consola
    debug: false,
    multiple: false,
    autoUpload: true,
    request: {
        endpoint: 'Modelo/FineUploader/TransferenciaUsuario.php'
    },
    thumbnails: {
        placeholders: {
            waitingPath: '/Vista/CosasGenerales/js/placeholders/waiting-generic.png',
            notAvailablePath: '/Vista/CosasGenerales/js/placeholders/not_available-generic.png'
        }
    },
    validation: {
        itemLimit: 1,
        sizeLimit: 5120000, // 50 kB = 50 * 1024 bytes
        acceptFiles: "image/jpeg, image/jpeg, image/png, image/gif",
        allowedExtensions: ['jpeg', 'jpg', 'png', 'gif']
    },
    resume: {
        enabled: true
    },
    retry: {
        enableAuto: true,
        showButton: true
    },
    deleteFile: {
        enabled: true,
        endpoint: "Modelo/FineUploader/TransferenciaUsuario.php"
    }
}).on('error', function (event, id, name, reason) {
    console.log(event);
    console.log(reason);
}).on('complete', function (event, id, name, response) {
    ubicacionFoto = response.uuid + "/" + response.uploadName;
    valorFoto = $('#transferencia_usuario').val(ubicacionFoto);
    // valorFoto = $('#editar_foto_producto').val(ubicacionFoto);
});


// Subida de la foto del usuario con Fine uploader
$("#fine-uploader-validation_producto").fineUploader({
    // Aqui me muestra la plantilla personalizada
    template: 'qq-template-validation',
    // Aqui me muestra los mensajes en la consola
    debug: false,
    multiple: false,
    autoUpload: true,
    request: {
        endpoint: 'Modelo/FineUploader/ArchivosUsuario.php'
    },
    thumbnails: {
        placeholders: {
            waitingPath: '/Vista/CosasGenerales/js/placeholders/waiting-generic.png',
            notAvailablePath: '/Vista/CosasGenerales/js/placeholders/not_available-generic.png'
        }
    },
    validation: {
        itemLimit: 1,
        sizeLimit: 5120000, // 50 kB = 50 * 1024 bytes
        acceptFiles: "image/jpeg, image/jpeg, image/png, image/gif",
        allowedExtensions: ['jpeg', 'jpg', 'png', 'gif']
    },
    resume: {
        enabled: true
    },
    retry: {
        enableAuto: true,
        showButton: true
    },
    deleteFile: {
        enabled: true,
        endpoint: "Modelo/FineUploader/ArchivosUsuario.php"
    }
}).on('error', function (event, id, name, reason) {
    console.log(event);
    console.log(reason);
}).on('complete', function (event, id, name, response) {
    ubicacionFoto = response.uuid + "/" + response.uploadName;
    valorFoto = $('#foto_producto').val(ubicacionFoto);
    // valorFoto = $('#editar_foto_producto').val(ubicacionFoto);
});

// Subida de la foto del usuario con Fine uploader
$("#fine-uploader-validation_editar_producto").fineUploader({
    // Aqui me muestra la plantilla personalizada
    template: 'qq-template-validation',
    // Aqui me muestra los mensajes en la consola
    debug: false,
    multiple: false,
    autoUpload: true,
    request: {
        endpoint: 'Modelo/FineUploader/ArchivosUsuario.php'
    },
    thumbnails: {
        placeholders: {
            waitingPath: '/Vista/CosasGenerales/js/placeholders/waiting-generic.png',
            notAvailablePath: '/Vista/CosasGenerales/js/placeholders/not_available-generic.png'
        }
    },
    validation: {
        itemLimit: 1,
        sizeLimit: 5120000, // 50 kB = 50 * 1024 bytes
        acceptFiles: "image/jpeg, image/jpeg, image/png, image/gif",
        allowedExtensions: ['jpeg', 'jpg', 'png', 'gif']
    },
    resume: {
        enabled: true
    },
    retry: {
        enableAuto: true,
        showButton: true
    },
    deleteFile: {
        enabled: true,
        endpoint: "Modelo/FineUploader/ArchivosUsuario.php"
    }
}).on('error', function (event, id, name, reason) {
    console.log(event);
    console.log(reason);
}).on('complete', function (event, id, name, response) {
    ubicacionFoto = response.uuid + "/" + response.uploadName;
    valorFoto = $('#editar_foto_producto').val(ubicacionFoto);
});

// Este codigo borra todo cuando se cierra el modal
$('#userregisterModal').on('hidden.bs.modal', function () {
    $('#userregisterModalForm input').val('');
    if ($('#foto_usuario').val() == '') {
        elimininarDespuesde();
    } else { }
});

// Este codigo borra todo cuando se cierra el modal
$('#crearproductoModal').on('hidden.bs.modal', function () {
    $('#crearproductoForm input').val('');
    if ($('#foto_producto').val() == '') {
        elimininarDespuesde();
    } else { }
});


$('#eliminarImagenForm').on('click', eliminarImagen());



// ///////////////////
// Registro del usuario
$("#userregisterModalForm").validate({
    errorClass: 'help-block animation-slideUp', // You can change the animation class for a different entrance animation - check animations page
    errorElement: 'div',
    errorPlacement: function (error, e) {
        e.parents('.form-group > div').append(error);
    },
    highlight: function (e) {
        $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
        $(e).closest('.help-block').remove();
    },
    success: function (e) {
        e.closest('.form-group').removeClass('has-success has-error');
        e.closest('.help-block').remove();
    },
    rules: {
        user_login: {
            required: true,
            minlength: 2
        },
        user_email: {
            required: true,
            email: true
        },
        user_telefono: {
            required: true,
            number: true
        },
        user_password: {
            required: true,
            minlength: 5
        },
        cuser_password: {
            required: true,
            minlength: 5,
            equalTo: "#user_password"
        }
    },
    messages: {
        user_login: {
            required: "Escribe tu nombre",
            minlength: "Tu Nombre es demasiado corto"
        },
        user_email: {
            required: "Por Favor, introduzca una dirección de correo",
            email: "Introduzca un correo verdadero"
        },
        user_telefono: {
            required: "Escribe tu telefono",
            number: "Escribe números"
        },
        user_password: {
            required: "Escribe tu contraseña",
            minlength: "Tu contraseña debe tener más de 5 letras"
        },
        cuser_password: {
            required: "Escribe tu contraseña",
            minlength: "Tu contraseña debe tener más de 5 letras",
            equalTo: "Tus contraseñas deben coincidir"
        }
    }
});
// ///////////////////////



if ($("#reenviarcontrasenaForm").length) {
    if ($("#codigorestaurar").val() == '') {
        recargarPagina('./');
    }
}

/////////////////////// formulario de restauracion de la contraseña
$("#reenviarcontrasenaForm").validate({
    errorClass: 'help-block animation-slideUp', // You can change the animation class for a different entrance animation - check animations page
    errorElement: 'div',
    errorPlacement: function (error, e) {
        e.parents('.form-group > div').append(error);
    },
    highlight: function (e) {
        $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
        $(e).closest('.help-block').remove();
    },
    success: function (e) {
        e.closest('.form-group').removeClass('has-success has-error');
        e.closest('.help-block').remove();
    },
    rules: {
        reenviarcontrasenanueva: {
            required: true,
            minlength: 5
        },
        repitereenviarcontrasena: {
            required: true,
            minlength: 5,
            equalTo: "#reenviarcontrasenanueva"
        }
    },
    messages: {
        reenviarcontrasenanueva: {
            required: "Escribe tu contraseña",
            minlength: "Tu contraseña debe tener más de 5 letras"
        },
        repitereenviarcontrasena: {
            required: "Escribe tu contraseña",
            minlength: "Tu contraseña debe tener más de 5 letras",
            equalTo: "Tus contraseñas deben coincidir"
        }
    }
});
/////////////////////////////


// ///////////////////
// Edicion del usuario
$("#usereditarModalForm").validate({
    errorClass: 'help-block animation-slideUp', // You can change the animation class for a different entrance animation - check animations page
    errorElement: 'div',
    errorPlacement: function (error, e) {
        e.parents('.form-group > div').append(error);
    },
    highlight: function (e) {
        $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
        $(e).closest('.help-block').remove();
    },
    success: function (e) {
        e.closest('.form-group').removeClass('has-success has-error');
        e.closest('.help-block').remove();
    },
    rules: {
        user_editar: {
            required: true,
            minlength: 2
        },
        user_email_editar: {
            required: true,
            email: true
        },
        user_telefono_editar: {
            required: true,
            number: true
        },
        user_password_editar: {
            required: true,
            minlength: 5
        },
        cuser_password_editar: {
            required: true,
            minlength: 5,
            equalTo: "#user_password_editar"
        }
    },
    messages: {
        user_editar: {
            required: "Escribe tu nombre",
            minlength: "Tu Nombre es demasiado corto"
        },
        user_email_editar: {
            required: "Por Favor, introduzca una dirección de correo",
            email: "Introduzca un correo verdadero"
        },
        user_telefono_editar: {
            required: "Escribe tu telefono",
            number: "Escribe números"
        },
        user_password_editar: {
            required: "Escribe tu contraseña",
            minlength: "Tu contraseña debe tener más de 5 letras"
        },
        cuser_password_editar: {
            required: "Escribe tu contraseña",
            minlength: "Tu contraseña debe tener más de 5 letras",
            equalTo: "Tus contraseñas deben coincidir"
        }
    }
});
// ///////////////////////


// ///////////////////
// Recordar contraseña del usuario
$("#userlostpasswordModalForm").validate({
    errorClass: 'help-block animation-slideUp', // You can change the animation class for a different entrance animation - check animations page
    errorElement: 'div',
    errorPlacement: function (error, e) {
        e.parents('.form-group > div').append(error);
    },
    highlight: function (e) {
        $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
        $(e).closest('.help-block').remove();
    },
    success: function (e) {
        e.closest('.form-group').removeClass('has-success has-error');
        e.closest('.help-block').remove();
    },
    rules: {
        user_recordar_correo: {
            required: true,
            email: true
        }
    },
    messages: {
        user_recordar_correo: {
            required: "Por Favor, introduzca una dirección de correo",
            email: "Introduzca un correo verdadero"
        }
    }
});
// ///////////////////////


// ///////////////////
// Login del usuario
$("#userloginModalForm").validate({
    errorClass: 'help-block animation-slideUp', // You can change the animation class for a different entrance animation - check animations page
    errorElement: 'div',
    errorPlacement: function (error, e) {
        e.parents('.form-group > div').append(error);
    },
    highlight: function (e) {
        $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
        $(e).closest('.help-block').remove();
    },
    success: function (e) {
        e.closest('.form-group').removeClass('has-success has-error');
        e.closest('.help-block').remove();
    },
    rules: {
        user_login_correo: {
            required: true,
            email: true
        },
        user_login_contraseña: {
            required: true,
            minlength: 5
        }
    },
    messages: {
        user_login_correo: {
            required: "Por Favor, introduzca una dirección de correo",
            email: "Introduzca un correo verdadero"
        },
        user_login_contraseña: {
            required: "Escribe tu contraseña",
            minlength: "Tu contraseña debe tener más de 5 letras"
        }
    }
});
// ///////////////////////

//////////////////////////////////////
// Fin de las Validaciones
///////////////////////////////////////




//////////////////////////////////////
// Inicio de los datatables del sistema
///////////////////////////////////////

// Fin de la funcion que permite actualizar el carrito
function tablacarritodecompras(){
    $("#tablacarritodecompras").dataTable({
        "iDisplayLength": 5, //Paginacion
        language: {
            "url": "/Vista/CosasGenerales/js/Spanish.json"
        },
        "bPaginate": true,
        "ajax": {
            url: 'http://paginacastinblanco.000webhostapp.com/Controlador/carritoControler.php?op=mostrarProductosCarritosFull',
            type: "post",
            dataType: "json",
            beforeSend: function () {
                $(".cuerpo").css('filter', 'blur(2px)');
            },
            error: function (e) {
                console.log(e.responseText);
            },
            complete: function (e) {
                $(".cuerpo").css('filter', 'blur(0px)');
            }
        },
        "order": [
            [0, "desc"]
        ]
    }).dataTable();
}



// Inicio de la funcion que permite mostrar las compras realizadas por el usuario front
function tablaprocesarcompras() {
    $("#tablaprocesarcompras").dataTable({
        "iDisplayLength": 5, //Paginacion
        language: {
            "url": "/Vista/CosasGenerales/js/Spanish.json"
        },
        // "bDestroy": true,
        // "bProcessing": true,
        // "bServerSide": true,
        // Esto es cuando no se trae de nuevo los datos desde php
        destroy: true,
        "bPaginate": true,
        "ajax": {
            url: 'http://paginacastinblanco.000webhostapp.com/Controlador/procesarcompraControler.php?op=mostrartodascompras',
            type: "post",
            dataType: "json",
            beforeSend: function () {
                $(".cuerpo").css('filter', 'blur(2px)');
            },
            error: function (e) {
                console.log(e.responseText);
            },
            complete: function (e) {
                $(".cuerpo").css('filter', 'blur(0px)');
            }
        },
        "order": [
            [0, "desc"]
        ]
    }).dataTable();
}
// Fin de la funcion que permite mostrar las compras realizadas por el usuario front


// Inicio de la funcion para mostrar los mensajes al usuario general
function tablamensajeusuario0() {
    $("#tablamensajeusuario0").dataTable({
        "iDisplayLength": 5, //Paginacion
        language: {
            "url": "/Vista/CosasGenerales/js/Spanish.json"
        },
        // "bDestroy": true,
        // "bProcessing": true,
        // "bServerSide": true,
        // Esto es cuando no se trae de nuevo los datos desde php
        destroy: true,
        "bPaginate": true,
        "ajax": {
            url: 'http://paginacastinblanco.000webhostapp.com/Controlador/mensajeControler.php?op=mensajeusuario0',
            type: "post",
            dataType: "json",
            beforeSend: function () {
                $(".cuerpo").css('filter', 'blur(2px)');
            },
            error: function (e) {
                console.log(e.responseText);
            },
            complete: function (e) {
                $(".cuerpo").css('filter', 'blur(0px)');
            }
        },
        "order": [
            [0, "desc"]
        ]
    }).dataTable();
}
function tablamensajeusuario1() {
    $("#tablamensajeusuario1").dataTable({
        "iDisplayLength": 5, //Paginacion
        language: {
            "url": "/Vista/CosasGenerales/js/Spanish.json"
        },
        // "bDestroy": true,
        // "bProcessing": true,
        // "bServerSide": true,
        // Esto es cuando no se trae de nuevo los datos desde php
        destroy: true,
        "bPaginate": true,
        "ajax": {
            url: 'http://paginacastinblanco.000webhostapp.com/Controlador/mensajeControler.php?op=mensajeusuario1',
            type: "post",
            dataType: "json",
            beforeSend: function () {
                $(".cuerpo").css('filter', 'blur(2px)');
            },
            error: function (e) {
                console.log(e.responseText);
            },
            complete: function (e) {
                $(".cuerpo").css('filter', 'blur(0px)');
            }
        },
        "order": [
            [0, "desc"]
        ]
    }).dataTable();
}
// Fin de la funcion para mostrar los mensajes al usuario general




// Inicio de la funcion para mostrar los mensajes al usuario administrador
function tablamensajeadmin0() {
    $("#tablamensajeadmin0").dataTable({
        "iDisplayLength": 5, //Paginacion
        language: {
            "url": "/Vista/CosasGenerales/js/Spanish.json"
        },
        // "bDestroy": true,
        // "bProcessing": true,
        // "bServerSide": true,
        // Esto es cuando no se trae de nuevo los datos desde php
        destroy: true,
        "bPaginate": true,
        "ajax": {
            url: 'http://paginacastinblanco.000webhostapp.com/Controlador/mensajeControler.php?op=mensajeusuarioadmin0',
            type: "post",
            dataType: "json",
            beforeSend: function () {
                $(".cuerpo").css('filter', 'blur(2px)');
            },
            error: function (e) {
                console.log(e.responseText);
            },
            complete: function (e) {
                $(".cuerpo").css('filter', 'blur(0px)');
            }
        },
        "order": [
            [0, "desc"]
        ]
    }).dataTable();
}
function tablamensajeadmin1() {
    $("#tablamensajeadmin1").dataTable({
        "iDisplayLength": 5, //Paginacion
        language: {
            "url": "/Vista/CosasGenerales/js/Spanish.json"
        },
        // "bDestroy": true,
        // "bProcessing": true,
        // "bServerSide": true,
        // Esto es cuando no se trae de nuevo los datos desde php
        destroy: true,
        "bPaginate": true,
        "ajax": {
            url: 'http://paginacastinblanco.000webhostapp.com/Controlador/mensajeControler.php?op=mensajeusuarioadmin1',
            type: "post",
            dataType: "json",
            beforeSend: function () {
                $(".cuerpo").css('filter', 'blur(2px)');
            },
            error: function (e) {
                console.log(e.responseText);
            },
            complete: function (e) {
                $(".cuerpo").css('filter', 'blur(0px)');
            }
        },
        "order": [
            [0, "desc"]
        ]
    }).dataTable();
}
// Fin de la funcion para mostrar los mensajes al usuario administrador







// 
// 



// Inicio de la funcion que permite mostrar las compras realizadas por el usuario front
function tablacomprastienda() {
    $("#tablacomprastienda").dataTable({
        "iDisplayLength": 5, //Paginacion
        language: {
            "url": "/Vista/CosasGenerales/js/Spanish.json"
        },
        // "bDestroy": true,
        // "bProcessing": true,
        // "bServerSide": true,
        // Esto es cuando no se trae de nuevo los datos desde php
        destroy: true,
        "bPaginate": true,
        "ajax": {
            url: 'http://paginacastinblanco.000webhostapp.com/Controlador/procesarcompraControler.php?op=mostrartodascomprasusuarios',
            type: "post",
            dataType: "json",
            beforeSend: function () {
                $(".cuerpo").css('filter', 'blur(2px)');
            },
            error: function (e) {
                console.log(e.responseText);
            },
            complete: function (e) {
                $(".cuerpo").css('filter', 'blur(0px)');
            }
        },
        "order": [
            [0, "desc"]
        ]
    }).dataTable();
}
// Fin de la funcion que permite mostrar las compras realizadas por el usuario front


// Inicio de la funcion que permite mostrar las compras realizadas por el usuario front
function tablabancos() {
    $("#tablabancos").dataTable({
        "iDisplayLength": 5, //Paginacion
        language: {
            "url": "/Vista/CosasGenerales/js/Spanish.json"
        },
        // "bDestroy": true,
        // "bProcessing": true,
        // "bServerSide": true,
        // Esto es cuando no se trae de nuevo los datos desde php
        destroy: true,
        "bPaginate": true,
        "ajax": {
            url: 'http://paginacastinblanco.000webhostapp.com/Controlador/bancoControler.php?op=mostrarbancoadmin',
            type: "post",
            dataType: "json",
            beforeSend: function () {
                $(".cuerpo").css('filter', 'blur(2px)');
            },
            error: function (e) {
                console.log(e.responseText);
            },
            complete: function (e) {
                $(".cuerpo").css('filter', 'blur(0px)');
            }
        },
        "order": [
            [0, "desc"]
        ]
    }).dataTable();
}
// Fin de la funcion que permite mostrar las compras realizadas por el usuario front

// Mostrar los productos en 1 al administrador
function productosen1() {
    $("#productosen1").dataTable({
        "iDisplayLength": 5, //Paginacion
        language: {
            "url": "/Vista/CosasGenerales/js/Spanish.json"
        },
        "bDestroy": true,
        "bProcessing": true,
        "bServerSide": true,
        "bPaginate": true,
        "ajax": {
            url: 'http://paginacastinblanco.000webhostapp.com/Controlador/productoControler.php?op=listarSoloEstado1',
            type: "post",
            dataType: "json",
            beforeSend: function () {
                $(".cuerpo").css('filter', 'blur(2px)');
            },
            error: function (e) {
                console.log(e.responseText);
            },
            complete: function (e) {
                $(".cuerpo").css('filter', 'blur(0px)');
            }
        },
        "order": [
            [0, "desc"]
        ]
    }).dataTable();
}

// Mostrar los productos en 0 al administrador
function productosen0() {
     $("#productosen0").dataTable({
        "iDisplayLength": 5, //Paginacion
        language: {
            "url": "/Vista/CosasGenerales/js/Spanish.json"
        },
        "bDestroy": true,
        "bProcessing": true,
        "bServerSide": true,
        "bPaginate": true,
        "ajax": {
            url: 'http://paginacastinblanco.000webhostapp.com/Controlador/productoControler.php?op=listarSoloEstado0',
            type: "post",
            dataType: "json",
            beforeSend: function () {
                $(".cuerpo").css('filter', 'blur(2px)');
            },
            error: function (e) {
                console.log(e.responseText);
            },
            complete: function (e) {
                $(".cuerpo").css('filter', 'blur(0px)');
            }
        },
        "order": [
            [0, "desc"]
        ]
    }).dataTable();
}

// Esto muestra los tipos de producto que existen
function tipoproductos() {
    $("#tabalatipoproducto").dataTable({
        "iDisplayLength": 5, //Paginacion
        language: {
            "url": "/Vista/CosasGenerales/js/Spanish.json"
        },
        "bDestroy": true,
        "bProcessing": true,
        "bServerSide": true,
        "bPaginate": true,
        "ajax": {
            url: 'http://paginacastinblanco.000webhostapp.com/Controlador/productoControler.php?op=tipoproductos',
            type: "post",
            dataType: "json",
            beforeSend: function () {
                $(".cuerpo").css('filter', 'blur(2px)');
            },
            error: function (e) {
                console.log(e.responseText);
            },
            complete: function (e) {
                $(".cuerpo").css('filter', 'blur(0px)');
            }
        },
        "order": [
            [0, "desc"]
        ]
    }).dataTable();
}


// Esto muestra al administrador todos los usuarios en 1
function usuariosen1() {
    $("#usuariosen1").dataTable({
        "iDisplayLength": 5, //Paginacion
        language: {
            "url": "/Vista/CosasGenerales/js/Spanish.json"
        },
        "bDestroy": true,
        "bProcessing": true,
        "bServerSide": true,
        "bPaginate": true,
        "ajax": {
            url: 'http://paginacastinblanco.000webhostapp.com/Controlador/usuarioControler.php?op=usuariosen1',
            type: "post",
            dataType: "json",
            beforeSend: function () {
                $(".cuerpo").css('filter', 'blur(2px)');
            },
            error: function (e) {
                console.log(e.responseText);
            },
            complete: function (e) {
                $(".cuerpo").css('filter', 'blur(0px)');
            }
        },
        "order": [
            [0, "desc"]
        ]
    }).dataTable();
}


// Esto muestra al administrador todos los usuarios en 0
function usuariosen0() {
    $("#usuariosen0").dataTable({
        "iDisplayLength": 5, //Paginacion
        language: {
            "url": "/Vista/CosasGenerales/js/Spanish.json"
        },
        "bDestroy": true,
        "bProcessing": true,
        "bServerSide": true,
        "bPaginate": true,
        "ajax": {
            url: 'http://paginacastinblanco.000webhostapp.com/Controlador/usuarioControler.php?op=usuariosen0',
            type: "post",
            dataType: "json",
            beforeSend: function () {
                $(".cuerpo").css('filter', 'blur(2px)');
            },
            error: function (e) {
                console.log(e.responseText);
            },
            complete: function (e) {
                $(".cuerpo").css('filter', 'blur(0px)');
            }
        },
        "order": [
            [0, "desc"]
        ]
    }).dataTable();
}




//////////////////////////////////////
// Fin de los datatables del sistema
///////////////////////////////////////


//////////////////////////////////////
// Inicio de los Formularios AJAX
///////////////////////////////////////

// Inicio del Registro del usuario
$('#userregisterModalForm').on('submit', function (e) {
    e.preventDefault()
    formulario = $('#userregisterModalForm').serialize()
    $.post('http://paginacastinblanco.000webhostapp.com/Controlador/usuarioControler.php?op=registrar', formulario, function (data) {
    }).done(function (data) {
        // console.log(data);
        datos = JSON.parse(data);
        valorestado = datos.estado.type;
        valormsg = datos.estado.msg;
        $("#userregisterModal").modal('hide');
        switch (valorestado) {

            case 'success':
                alertaSuccess(valorestado, valormsg);
                direccion = './';
                recargarPagina(direccion);
                break;

            case 'error':
                alertaError(valorestado, valormsg);
                break;

            default:
                break;
        }
    })
})

$('#crearusuarioModalForm').on('submit', function (e) {
    e.preventDefault()
    formulario = $('#crearusuarioModalForm').serialize()
    $.post('http://paginacastinblanco.000webhostapp.com/Controlador/usuarioControler.php?op=registrar', formulario, function (data) {
    }).done(function (data) {
        // console.log(data);
        datos = JSON.parse(data);
        valorestado = datos.estado.type;
        valormsg = datos.estado.msg;
        $("#userregisterModal").modal('hide');
        switch (valorestado) {

            case 'success':
                alertaSuccess(valorestado, valormsg);
                direccion = './';
                recargarPagina(direccion);
                break;

            case 'error':
                alertaError(valorestado, valormsg);
                break;

            default:
                break;
        }
    })
})

// Fin del Registro del usuario


// Inicio del envio del mensaje
$('#enviarmensjaeModalForm').on('submit', function (e) {
    e.preventDefault()
    $("#enviarmensjaeModal").modal('hide')
    formulario = $('#enviarmensjaeModalForm').serialize()
    $.post('http://paginacastinblanco.000webhostapp.com/Controlador/mensajeControler.php?op=enviarmensaje', formulario, function (data) {
    }).done(function (data) {
        // console.log(data);
        datos = JSON.parse(data);
        valorestado = datos.estado.type;
        valormsg = datos.estado.msg;
        $("#userregisterModal").modal('hide');
        switch (valorestado) {

            case 'success':
                alertaSuccess(valorestado, valormsg);
                direccion = './mensaje';
                recargarPagina(direccion);
                break;

            case 'error':
                alertaError(valorestado, valormsg);
                break;

            default:
                break;
        }
    })
})
// Fin del envio del mensaje


// Inicio de la restauracion de la contraseña
$('#reenviarcontrasenaForm').on('submit', function (e) {
    e.preventDefault()
    formulario = $('#reenviarcontrasenaForm').serialize()
    $.post('http://paginacastinblanco.000webhostapp.com/Controlador/usuarioControler.php?op=reenviarcontrasena', formulario, function (data) {
    }).done(function (data) {
        // console.log(data);
        datos = JSON.parse(data);
        valorestado = datos.estado.type;
        valormsg = datos.estado.msg;
        switch (valorestado) {
            case 'success':
                alertaSuccess(valorestado, valormsg);
                direccion = '../../';
                recargarPagina(direccion);
                break;

            case 'error':
                alertaError(valorestado, valormsg);
                break;

            default:
                break;
        }
    })
})
// Fin de la restauracion de la contraseña


// Inicio del carrito de compras para agregar productos
function agregarProductoCarrito(idproducto, precioproducto, valorboton) {
    if (valorboton == 'busquedasolo') {
        cantidad = $(".qty").val()
    } else {
        cantidad = $(".qty2").val()
    }

    // console.log(idproducto + " " + precioproducto + " " + cantidad + " " + valorboton)

    formulario = {
        'id': idproducto,
        'precio': precioproducto,
        'qty': cantidad,
    }

    $("#quickviewmodal").modal('hide');
    $.post('http://paginacastinblanco.000webhostapp.com/Controlador/carritoControler.php?op=addToCart', formulario, function (data) {
    }).done(function (data) {
        // console.log(data);
        datos = JSON.parse(data);
        valorestado = datos.estado.type;
        valormsg = datos.estado.msg;
        switch (valorestado) {
            case 'success':
                alertaSuccess(valorestado, valormsg);
                direccion = './';
                recargarPagina(direccion);
                break;

            case 'error':
                alertaError(valorestado, valormsg);
                break;

            default:
                break;
        }
    })
}
// Fin del carrito de compras para agregar productos

// Inicio de la funcion para eliminar productos del carrito
function eliminarproductocarrito(idproducto) {

    swalWithBootstrapButtons({
        title: '¿Quieres eliminar el producto del carrito?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, deseo hacerlo',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {

            $.post('http://paginacastinblanco.000webhostapp.com/Controlador/carritoControler.php?op=removeCartItem', { 'rowid': idproducto }, function (data) {
            }).done(function (data) {
                // console.log(data);
                datos = JSON.parse(data);
                valorestado = datos.estado.type;
                valormsg = datos.estado.msg;
                switch (valorestado) {
                    case 'success':
                        alertaSuccess(valorestado, valormsg);
                        direccion = './compras';
                        recargarPagina(direccion);
                        break;

                    case 'error':
                        alertaError(valorestado, valormsg);
                        break;

                    default:
                        break;
                }
            })


        } else if (result.dismiss === swal.DismissReason.cancel) {
        }
    });

}
// Fin de la funcion para eliminar productos del carrito

// Inicio de la funcion que permite actualizar el carrito
function updateCartItem(id, cantidad) {

    swalWithBootstrapButtons({
        title: '¿Quieres actualizar el carrito?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, deseo hacerlo',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {

            $.post('http://paginacastinblanco.000webhostapp.com/Controlador/carritoControler.php?op=actualizarCarrito', { 'id': id, 'qty': cantidad.value }, function (data) {
            }).done(function (data) {
                // console.log(data);
                datos = JSON.parse(data);
                valorestado = datos.estado.type;
                valormsg = datos.estado.msg;
                switch (valorestado) {
                    case 'success':
                        alertaSuccess(valorestado, valormsg);
                        direccion = './compras';
                        recargarPagina(direccion);
                        break;

                    case 'error':
                        alertaError(valorestado, valormsg);
                        break;

                    default:
                        break;
                }
            })


        } else if (result.dismiss === swal.DismissReason.cancel) {
        }
    });
}

// Aqui le doy a comprar al carrito
$("#botoncomprar").on('click', function (e) {
    e.preventDefault();
    $.post('http://paginacastinblanco.000webhostapp.com/Controlador/carritoControler.php?op=placeOrder', {}, function (data) {
    }).done(function (data) {
        // console.log(data);
        datos = JSON.parse(data);
        valorestado = datos.estado.type;
        valormsg = datos.estado.msg;
        switch (valorestado) {
            case 'success':
                alertaSuccess(valorestado, valormsg);
                direccion = './completarcompra';
                recargarPagina(direccion);
                break;

            case 'error':
                alertaError(valorestado, valormsg);
                break;

            default:
                break;
        }
    })


})
// Aqui le doy a comprar al carrito


// aqui miro los detalles de la compra del usuario en session
function detallescompra(idcompra) {
    // console.log(idcompra)
    $.post("http://paginacastinblanco.000webhostapp.com/Controlador/procesarcompraControler.php?op=detallescompra", {
        "idcompra": idcompra
    }, function () { }).done(function (data) {
        // console.log(data)
        $("#contenidodetallescompra").html(data);

    });
}
function detallescomprausuarios(idcompra) {
    // console.log(idcompra)
    $.post("http://paginacastinblanco.000webhostapp.com/Controlador/procesarcompraControler.php?op=detallescomprausuarios", {
        "idcompra": idcompra
    }, function () { }).done(function (data) {
        // console.log(data)
        $("#detallescomprauser").html(data);

    });
}
// aqui miro los detalles de la compra del usuario en session



// funcion para eliminar productos de la tabla compras
function eliminarproductocompra(car_id){
    $("#detallescompraModal").modal('hide')
    swalWithBootstrapButtons({
        title: '¿Estas seguro de eliminar el producto de la compra?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, deseo eliminar el producto',
        cancelButtonText: 'No, cancelar eliminación',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.post("http://paginacastinblanco.000webhostapp.com/Controlador/procesarcompraControler.php?op=eliminarproductocompra", {
                "car_id": car_id
            }, function () { }).done(function (data) {
                // console.log(data)
                datos = JSON.parse(data);
                valorestado = datos.estado.type;
                valormsg = datos.estado.msg;
                alertaSuccess(valorestado, valormsg);
                tablaprocesarcompras();

            });
        } else if (result.dismiss === swal.DismissReason.cancel) {
        }
    });
}
// funcion para eliminar productos de la tabla compras


//funcion para eliminar la compra del usuario en session
function eliminarcompra(idcompra) {
    swalWithBootstrapButtons({
        title: '¿Estas seguro de cancelar la compra?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, deseo cancelarla',
        cancelButtonText: 'No, cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.post("http://paginacastinblanco.000webhostapp.com/Controlador/procesarcompraControler.php?op=cancelarcompra", {
                "idcompra": idcompra
            }, function () { }).done(function (data) {
                // console.log(data)
                datos = JSON.parse(data);
                valorestado = datos.estado.type;
                valormsg = datos.estado.msg;
                alertaSuccess(valorestado, valormsg);
                tablaprocesarcompras();

            });
        } else if (result.dismiss === swal.DismissReason.cancel) {
        }
    });
}
//funcion para eliminar la compra del usuario en session

// Inicio del envio del correo para la restauracion de la contraseña
$('#userlostpasswordModalForm').on('submit', function (e) {
    e.preventDefault()
    $("#botoncerrarmodal").click();
    formulario = $('#userlostpasswordModalForm').serialize()
    $.post('http://paginacastinblanco.000webhostapp.com/Controlador/usuarioControler.php?op=enviarcorreo', formulario, function (data) {
    }).done(function (data) {
        // console.log(data);

        datos = JSON.parse(data);
        valorestado = datos.estado.type;
        valormsg = datos.estado.msg;
    $("#userlostpasswordModal").modal('hide');
        switch (valorestado) {
            case 'success':
                alertaSuccess(valorestado, valormsg);
                // direccion = './';
                // recargarPagina(direccion);
                break;

            case 'error':
                alertaError(valorestado, valormsg);
                break;

            default:
                break;
        }
    })
})
// Fin del envio del correo para la restauracion de la contraseña



// Inicio del Login del usuario
$('#userloginModalForm').on('submit', function (e) {
    e.preventDefault()
    formulario = $('#userloginModalForm').serialize()
    $.post('http://paginacastinblanco.000webhostapp.com/Controlador/usuarioControler.php?op=entrar', formulario, function (data) {
    }).done(function (data) {
        // console.log(data);
        datos = JSON.parse(data);
        valorestado = datos.estado.type;
        valormsg = datos.estado.msg;
        $("#userloginModal").modal('hide');
        switch (valorestado) {

            case 'success':
                alertaSuccess(valorestado, valormsg);
                direccion = './';
                recargarPagina(direccion);
                break;

            case 'error':
                alertaError(valorestado, valormsg);
                break;

            default:
                break;
        }
    })
})
// Fin del Login del usuario

// Inicio de edicion del usuario
$('#usereditarModalForm').on('submit', function (e) {
    e.preventDefault()
    formulario = $('#usereditarModalForm').serialize()
    $.post('http://paginacastinblanco.000webhostapp.com/Controlador/usuarioControler.php?op=editarUsuario', formulario, function (data) {
    }).done(function (data) {
        // console.log(data);
        datos = JSON.parse(data);
        valorestado = datos.estado.type;
        valormsg = datos.estado.msg;
        $("#usereditarModal").modal('hide');
        switch (valorestado) {
            case 'success':
                alertaSuccess(valorestado, valormsg);
                direccion = './';
                recargarPagina(direccion);
                break;

            case 'error':
                alertaError(valorestado, valormsg);
                break;

            default:
                break;
        }


        direccion = './';
        recargarPaginAnimada(direccion);

    })
})
// Fin de edicion del usuario

// Inicio de creacion del tipo de producto
$('#tipoproductoForm').on('submit', function (e) {
    e.preventDefault()
    formulario = $('#tipoproductoForm').serialize()
    $.post('http://paginacastinblanco.000webhostapp.com/Controlador/productoControler.php?op=crearTipoProducto', formulario, function (data) {
    }).done(function (data) {
        // console.log(data);
        datos = JSON.parse(data);
        valorestado = datos.estado.type;
        valormsg = datos.estado.msg;
        $("#tipoproductoModal").modal('hide');
        switch (valorestado) {
            case 'success':
                alertaSuccess(valorestado, valormsg);
                tipoproductos();
                break;

            case 'error':
                alertaError(valorestado, valormsg);
                break;

            default:
                break;
        }

    })
})
// Fin de creacion del tipo de producto


// Inicio de creacion del producto
$('#crearproductoForm').on('submit', function (e) {
    e.preventDefault()
    formulario = $('#crearproductoForm').serialize()
    $.post('http://paginacastinblanco.000webhostapp.com/Controlador/productoControler.php?op=crearProducto', formulario, function (data) {
    }).done(function (data) {
        // console.log(data);
        datos = JSON.parse(data);
        valorestado = datos.estado.type;
        valormsg = datos.estado.msg;
        $("#crearproductoModal").modal('hide');
        switch (valorestado) {
            case 'success':
                alertaSuccess(valorestado, valormsg);
                // productosen1();

                direccion = 'producto';
                recargarPagina(direccion);
                break;

            case 'error':
                alertaError(valorestado, valormsg);
                break;

            default:
                break;
        }

    })
})
// Fin de creacion del producto

// Inicio de edicion del tipo del producto
$('#editartipoproductoForm').on('submit', function (e) {
    e.preventDefault()
    formulario = $('#editartipoproductoForm').serialize()
    $.post('http://paginacastinblanco.000webhostapp.com/Controlador/productoControler.php?op=editartipoProducto', formulario, function (data) {
    }).done(function (data) {
        // console.log(data);
        datos = JSON.parse(data);
        valorestado = datos.estado.type;
        valormsg = datos.estado.msg;
        $("#editartipoproductoModal").modal('hide');
        switch (valorestado) {
            case 'success':
                alertaSuccess(valorestado, valormsg);
                tipoproductos();
                productosen1();
                productosen0();
                break;

            case 'error':
                alertaError(valorestado, valormsg);
                break;

            default:
                break;
        }

    })
})
// Fin de edicion del tipo del producto

// Inicio de edicion del producto
$('#editarproductoForm').on('submit', function (e) {
    e.preventDefault()
    formulario = $('#editarproductoForm').serialize()
    $.post('http://paginacastinblanco.000webhostapp.com/Controlador/productoControler.php?op=editarProducto', formulario, function (data) {
    }).done(function (data) {
        // console.log(data);
        datos = JSON.parse(data);
        valorestado = datos.estado.type;
        valormsg = datos.estado.msg;
        $("#editarproductoModal").modal('hide');
        switch (valorestado) {
            case 'success':
                alertaSuccess(valorestado, valormsg);
                direccion = 'producto';
                recargarPagina(direccion);
                break;

            case 'error':
                alertaError(valorestado, valormsg);
                break;

            default:
                break;
        }

    })
})
// Fin de edicion del producto

// Inicio de edicion del producto
$('#buscarProductoFront').on('submit', function (e) {
    e.preventDefault()
    buscador = $("#buscarnombreproducto").val();
    // console.log(buscador);
    mostrarproductofront(buscador);
})
// Fin de edicion del producto


// Inicio de Salir de la sesion
$(".salirsession").on('click', function (event) {
    event.preventDefault();
    // console.log('saliendo')
    valorestado = 'success';
    valormsg = 'Has salido correctamente del sistema';
    $.post("http://paginacastinblanco.000webhostapp.com/Controlador/usuarioControler.php?op=salir", {}, function () { }).done(function () {
        $('body').html("<div class='preloader'><div class='cssload-speeding-wheel'></div></div>");


        direccion = './';
        recargarPagina(direccion);
    });
});
// Fin de Salir de la sesion

// Inicio de mostrar el tipo de producto para el registro del producto
function mostrartipoproducto() {
    $.post('http://paginacastinblanco.000webhostapp.com/Controlador/productoControler.php?op=mostrartipoproducto', {}, function (data) {
        /*optional stuff to do after success */
    }).done(function (data) {
        $("#tipo_producto_id").html(data);
        // console.log(data);
    }).fail(function (data) {
        console.log(data)
    });
}
if ($("#tipo_producto_id").length) {
    mostrartipoproducto();
}
// Fin de mostrar el tipo de producto para el registro del producto


// Inicio de la muestra de los productos en frontend
function mostrarproductofront(buscar) {

    if ($("#mostrarsoloproducto").length) {
        vista = $("#vista").val();
        valores = { 'buscarproducto': buscar, 'vista': vista }
    } else {
        valores = { 'buscarproducto': buscar }
    }


    $("#muestradeproductosfront").html('<div class="loader"><div></div></div>');
    $.post('http://paginacastinblanco.000webhostapp.com/Controlador/productoControler.php?op=mostrarproductofront', valores, function (data) {
        /*optional stuff to do after success */
    }).done(function (data) {
        $("#muestradeproductosfront").html(data);
        // console.log(data);
    }).fail(function (data) {
        console.log(data)
    });
}

// Estp es para buscar los productos en la vista frontend
buscar = '';
if ($("#muestradeproductosfront").length) {
    mostrarproductofront(buscar);
}



// Esto es para mostrar los detalles producto en la vista frontend
contadorproducto = 0;
function mostrarDetallesProducto(idproducto, vista) {
    // console.log(idproducto);
    $("#modalProducto").html('<div class="loader"><div></div></div>');
    if ($("#mostrarsoloproducto").length) {
        vista = $("#vista").val();
    }

    $.post('http://paginacastinblanco.000webhostapp.com/Controlador/productoControler.php?op=mostrarDetallesProducto', { 'idproducto': idproducto, 'vista': vista }, function (data) {
        /*optional stuff to do after success */
    }).done(function (data) {

        // Revisar aqui
        if ($("#mostrarsoloproducto").length) {

            if (contadorproducto == 1) {
                $("#mostrarsoloproducto").html(data);
            } else {
                $("#modalProducto").html(data);
            }


        } else {
            $("#modalProducto").html(data);
        }

        // console.log(data);
    }).fail(function (data) {
        console.log(data)
    });
    contadorproducto++;
    // console.log(contadorproducto);
}


if ($("#mostrarsoloproducto").length) {
    valorinput = $("#codigoproducto").val();
    mostrarDetallesProducto(valorinput);
    $("#textoProductos").text('Los 3 productos más nuevos');
}



// Aqui paso los datos al modal de edicion del tipo producto
function editarTipoProducto(idtipo, tip_nombre, tip_peso) {
    // console.log(idtipo);
    $("#idtipo").val(idtipo);
    $('#editar_nombre_tipo').val(tip_nombre);
    $('#editar_peso_tipo').val(tip_peso);
    $('#editartipoproductoModal').modal('show')
}

// Aqui paso los datos al modal de edicion del producto
function editarProducto(pro_idproducto, pro_nombre, pro_precio, pro_cantidad) {
    $("#editar_producto_id").val(pro_idproducto);
    $('#editar_nombre_producto').val(pro_nombre);
    $('#editar_precio_producto').val(pro_precio);
    $('#editar_cantidad_producto').val(pro_cantidad);
    $('#editarproductoModal').modal('show')
}

// Funcion para eliminar el tipo de producto
function eliminarTipoProducto(idtipo) {
    swalWithBootstrapButtons({
        title: '¿Estas seguro de eliminar el tipo? "Se puede eliminar el producto"',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, deseo eliminarlo',
        cancelButtonText: 'No, cancelar eliminanación',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.post("http://paginacastinblanco.000webhostapp.com/Controlador/productoControler.php?op=eliminartipo", {
                "idtipo": idtipo
            }, function () { }).done(function (data) {
                // console.log(data)
                datos = JSON.parse(data);
                valorestado = datos.estado.type;
                valormsg = datos.estado.msg;
                alertaSuccess(valorestado, valormsg);
                tipoproductos();
                productosen1();
                productosen0();
            });
        } else if (result.dismiss === swal.DismissReason.cancel) {
            swalWithBootstrapButtons(
                'Eliminación cancelada',
                'El articulo no fue eliminado',
                'error'
            )
        }
    });
}


// Funcion para eliminar los productos
function eliminarProducto(idproducto) {
    swalWithBootstrapButtons({
        title: '¿Estas seguro de eliminar el producto?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, deseo eliminarlo',
        cancelButtonText: 'No, cancelar eliminanación',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.post("http://paginacastinblanco.000webhostapp.com/Controlador/productoControler.php?op=eliminarproducto", {
                "idproducto": idproducto
            }, function () { }).done(function (data) {
                // console.log(data)
                datos = JSON.parse(data);
                valorestado = datos.estado.type;
                valormsg = datos.estado.msg;
                alertaSuccess(valorestado, valormsg);
                productosen1();
                productosen0();
            });
        } else if (result.dismiss === swal.DismissReason.cancel) {
            swalWithBootstrapButtons(
                'Eliminación cancelada',
                'El articulo no fue eliminado',
                'error'
            )
        }
    });
}

// Funcion para desactivar los productos
function desaprobar(idproducto) {
    // console.log(idproducto)
    swalWithBootstrapButtons({
        title: '¿Estas seguro de desactivar el producto?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, deseo desactivarlo',
        cancelButtonText: 'No, cancelar desactivación',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.post("http://paginacastinblanco.000webhostapp.com/Controlador/productoControler.php?op=desactivarproducto", {
                "idproducto": idproducto
            }, function () { }).done(function (data) {
                // console.log(data)
                datos = JSON.parse(data);
                valorestado = datos.estado.type;
                valormsg = datos.estado.msg;
                alertaSuccess(valorestado, valormsg);
                productosen1();
                productosen0();
            });
        } else if (result.dismiss === swal.DismissReason.cancel) {
            swalWithBootstrapButtons(
                'Desactivación cancelada',
                'El articulo no fue desactivado',
                'error'
            )
        }
    });
}

// Funcion para aprobar los productos
function aprobar(idproducto) {
    // console.log(idproducto)
    swalWithBootstrapButtons({
        title: '¿Estas seguro de aprobar el producto?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, deseo aprobarlo',
        cancelButtonText: 'No, cancelar aprobación',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.post("http://paginacastinblanco.000webhostapp.com/Controlador/productoControler.php?op=aprobarproducto", {
                "idproducto": idproducto
            }, function () { }).done(function (data) {
                // console.log(data)
                datos = JSON.parse(data);
                valorestado = datos.estado.type;
                valormsg = datos.estado.msg;
                alertaSuccess(valorestado, valormsg);
                productosen1();
                productosen0();
            });
        } else if (result.dismiss === swal.DismissReason.cancel) {
            swalWithBootstrapButtons(
                'Aprobación cancelada',
                'El articulo no fue aprobado',
                'error'
            )
        }
    });
}




// Inicio del envio del correo para la restauracion de la contraseña
$('#crearbancoForm').on('submit', function (e) {
    e.preventDefault()
    formulario = $('#crearbancoForm').serialize()
    $("#crearbancoModal").modal('hide')
    $.post('http://paginacastinblanco.000webhostapp.com/Controlador/bancoControler.php?op=procesarbanco', formulario, function (data) {
    }).done(function (data) {
        // console.log(data);
        datos = JSON.parse(data);
        valorestado = datos.estado.type;
        valormsg = datos.estado.msg;
        switch (valorestado) {
            case 'success':
                alertaSuccess(valorestado, valormsg);
                tablabancos();
                break;

            case 'error':
                alertaError(valorestado, valormsg);
                break;

            default:
                break;
        }
    })
})
// Fin del envio del correo para la restauracion de la contraseña

// Aqui edito el banco del administrador
$("#editarbancoForm").on('submit', function(e){
    e.preventDefault();
    formulario = $("#editarbancoForm").serialize();
    $("#editarbancoModal").modal('hide');
    swalWithBootstrapButtons({
        title: '¿Estas seguro de editar los datos del banco?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, deseo editarlo',
        cancelButtonText: 'No, cancelar edición',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.post("http://paginacastinblanco.000webhostapp.com/Controlador/bancoControler.php?op=editarbanco", formulario, function () { }).done(function (data) {
                // console.log(data)
                datos = JSON.parse(data);
                valorestado = datos.estado.type;
                valormsg = datos.estado.msg;
                alertaSuccess(valorestado, valormsg);
                tablabancos();
            });
        } else if (result.dismiss === swal.DismissReason.cancel) {
        }
    });
})
// Aqui edito el banco del administrador



$("#procesarpagoForm").on('submit', function(e){
    e.preventDefault();
    formulario = $("#procesarpagoForm").serialize();
    // console.log(formulario) 
    $("#procesarcompraModal").modal('hide')
    swalWithBootstrapButtons({
        title: '¿Estas seguro de guardar los datos?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, deseo guardarlo',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.post("http://paginacastinblanco.000webhostapp.com/Controlador/procesarcompraControler.php?op=completarpago", formulario, function () { }).done(function (data) {
                // console.log(data)
                datos = JSON.parse(data);
                valorestado = datos.estado.type;
                valormsg = datos.estado.msg;
                alertaSuccess(valorestado, valormsg);
                direccion = 'completarcompra';
                recargarPaginAnimada(direccion);
                // tablabancos();
            });
        } else if (result.dismiss === swal.DismissReason.cancel) {
        }
    });
})


// if ($("#procesarpagoForm").length) {
function mostrarbancoselect(){
    $.post('http://paginacastinblanco.000webhostapp.com/Controlador/procesarcompraControler.php?op=revisarbanco', {}, function(data) {
        /*optional stuff to do after success */
    }).done(function(data){
        $("#selectbanco").html(data);
        // console.log(data)
    }).fail(function (data) {
        console.log(data)
    });
}

if($("#selectbanco").length){
mostrarbancoselect() 
}
// }

$("#selectbanco").change(function(){
    selectbanco=$("#selectbanco").val();

    $.post('http://paginacastinblanco.000webhostapp.com/Controlador/procesarcompraControler.php?op=mostrarbancousuario', {'selectbanco':selectbanco}, function(data) {
        /*optional stuff to do after success */
    }).done(function(data){
    //   console.log(data)
        datos = JSON.parse(data);
        valorid = datos.valorid;
        valormsg = datos.msg;
        $("#idbancousuario").val(valorid);
        $("#mostrabancoadmin").html(valormsg);
        
    }).fail(function (data) {
        console.log(data)
    });

});




// Funcion para editar el banco
function editarbanco(ban_id,uba_nombre,uba_cedula,uba_cuenta,ban_nombre){
    // console.log(ban_id)
    $("#ban_id").val(ban_id)
    $("#editar_nombre_banco").val(ban_nombre)
    $("#editar_nombre_titular").val(uba_nombre)
    $("#editar_cedula_titular").val(uba_cedula)
    $("#editar_numero_cuenta").val(uba_cuenta)
    $("#editarbancoModal").modal('show');
} 

// Funcion para eliminar el banco
function eliminarbanco(ban_id){
    // console.log(ban_id)
    swalWithBootstrapButtons({
        title: '¿Estas seguro de eliminar el banco? ¡Se eliminara todas las cuentas de bancos que tenga asociada a la cuenta!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, deseo eliminarlo',
        cancelButtonText: 'No, cancelar eliminación',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.post("http://paginacastinblanco.000webhostapp.com/Controlador/bancoControler.php?op=eliminarbanco", {
                "ban_id": ban_id
            }, function () { }).done(function (data) {
                // console.log(data)
                datos = JSON.parse(data);
                valorestado = datos.estado.type;
                valormsg = datos.estado.msg;
                alertaSuccess(valorestado, valormsg);
                tablabancos();
            });
        } else if (result.dismiss === swal.DismissReason.cancel) {
        }
    });
}


$(".prevendefaultboton").on('click',function(e){
    e.preventDefault();
})

// Funcion para procesar el pago final
function procesarpago(idcompra) {
    // console.log(idcompra)
    $("#idcompra").val(idcompra)
    mostrarbancoselect()
    // contenidodetallescompra
}


function eliminarcomprobante(com_id){
    console.log('comprobante'+com_id)
    $("#detallescompraModal").modal('hide')
    swalWithBootstrapButtons({
        title: '¿Estas seguro de eliminar el comprobante del pago?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, deseo eliminarlo',
        cancelButtonText: 'No, cancelar eliminación',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.post("http://paginacastinblanco.000webhostapp.com/Controlador/procesarcompraControler.php?op=eliminarcomprobante", {
                "com_id": com_id
            }, function () { }).done(function (data) {
                // console.log(data)
                datos = JSON.parse(data);
                valorestado = datos.estado.type;
                valormsg = datos.estado.msg;
                alertaSuccess(valorestado, valormsg);
            });
        } else if (result.dismiss === swal.DismissReason.cancel) {
        }
    });
}

function mostrarestadisticas(){
    $.post("http://paginacastinblanco.000webhostapp.com/Controlador/estadisticaControler.php?op=mostrartodo", {}, function () { }).done(function (data) {
    // console.log(data)
    datos = JSON.parse(data);
    valorestado = datos.estado.type;
if (valorestado == 'error') {
    valormsg = datos.estado.msg;
    alertaError(valorestado, valormsg);
}else{
productosactivos = datos.productosactivos;
productosinactivos = datos.productosinactivos;
usuarioactivo = datos.usuarioactivo;
usuarioinactivo = datos.usuarioinactivo;
cantidadbancos = datos.cantidadbancos;
comproceso = datos.comproceso;
comcompleta = datos.comcompleta;
precioventas = datos.precioventas;
mensajesenviados = datos.mensajesenviados;
mensajesrecibidos = datos.mensajesrecibidos;



$("#produactivos").html(productosactivos)
$("#produinactivos").html(productosinactivos)
$("#usuactivos").html(usuarioactivo)
$("#usuinactivos").html(usuarioinactivo)
$("#bancotodos").html(cantidadbancos)
$("#totalventas0").html(comproceso) 
$("#totalventas1").html(comcompleta) 
$("#dineroventas").html(precioventas)
$("#mensajenviados").html(mensajesenviados)
$("#mensajerecibidos").html(mensajesrecibidos)
}



            });
}
if ($("#produactivos").length) {
    mostrarestadisticas();
}



function rechazarcompra(com_id){
    // console.log(com_id)
    swalWithBootstrapButtons({
        title: '¿Estas seguro de rechazar la compra?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, deseo rechazarla',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.post("http://paginacastinblanco.000webhostapp.com/Controlador/procesarcompraControler.php?op=rechazarcompra", {
                "com_id": com_id
            }, function () { }).done(function (data) {
                // console.log(data)
                datos = JSON.parse(data);
                valorestado = datos.estado.type;
                valormsg = datos.estado.msg;
                alertaSuccess(valorestado, valormsg);
                tablacomprastienda();
            });
        } else if (result.dismiss === swal.DismissReason.cancel) {
        }
    });
}
function aprobarcompra(com_id){
    // console.log(com_id)
    swalWithBootstrapButtons({
        title: '¿Estas seguro de aprobar la compra?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, deseo aprobarla',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.post("http://paginacastinblanco.000webhostapp.com/Controlador/procesarcompraControler.php?op=aprobarcompra", {
                "com_id": com_id
            }, function () { }).done(function (data) {
                console.log(data)
                datos = JSON.parse(data);
                valorestado = datos.estado.type;
                valormsg = datos.estado.msg;
                alertaSuccess(valorestado, valormsg);
                tablacomprastienda();
            });
        } else if (result.dismiss === swal.DismissReason.cancel) {
        }
    });
}


function desactivarusuario(usu_id){
console.log(usu_id)
 swalWithBootstrapButtons({
        title: '¿Estas seguro de desactivar el usuario?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.post("http://paginacastinblanco.000webhostapp.com/Controlador/usuarioControler.php?op=desactivarusuario", {
                "usu_id": usu_id
            }, function () { }).done(function (data) {
                // console.log(data)
                datos = JSON.parse(data);
                valorestado = datos.estado.type;
                valormsg = datos.estado.msg;
                alertaSuccess(valorestado, valormsg);
                usuariosen1();
                usuariosen0(); 
            });
        } else if (result.dismiss === swal.DismissReason.cancel) {
        }
    });
} 

function activarusuario(usu_id){
console.log(usu_id)
 swalWithBootstrapButtons({
        title: '¿Estas seguro de activar el usuario?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.post("http://paginacastinblanco.000webhostapp.com/Controlador/usuarioControler.php?op=activarusuario", {
                "usu_id": usu_id
            }, function () { }).done(function (data) {
                // console.log(data)
                datos = JSON.parse(data);
                valorestado = datos.estado.type;
                valormsg = datos.estado.msg;
                alertaSuccess(valorestado, valormsg);
                usuariosen1();
                usuariosen0(); 
            });
        } else if (result.dismiss === swal.DismissReason.cancel) {
        }
    });
} 

function eliminarusuario(usu_id){
// console.log(usu_id)
swalWithBootstrapButtons({
        title: '¿Estas seguro de eliminar el usuario?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.post("http://paginacastinblanco.000webhostapp.com/Controlador/usuarioControler.php?op=eliminarusuario", {
                "usu_id": usu_id
            }, function () { }).done(function (data) {
                console.log(data)
                // datos = JSON.parse(data);
                // valorestado = datos.estado.type;
                // valormsg = datos.estado.msg;
                // alertaSuccess(valorestado, valormsg);
                // usuariosen1();
                // usuariosen0(); 
            });
        } else if (result.dismiss === swal.DismissReason.cancel) {
        }
    });
}

function detallesmensaje(men_id){
    // console.log(men_id)
    $.post("http://paginacastinblanco.000webhostapp.com/Controlador/mensajeControler.php?op=detallesmensajeusuario", {'men_id':men_id}, function () { }).done(function (data) {
        // console.log(data)
        $("#detallesmensajeusuario").html(data);
    });
}

$("#botonotificacion").on('click',function(e){
    e.preventDefault();
    $.post("http://paginacastinblanco.000webhostapp.com/Controlador/mensajeControler.php?op=cargarNotificaciones", {}, function () { }).done(function (data) {
        // console.log(data)
        $("#mostrarmensajesnotifcacion").html(data);
        cantidadnotificacion();
    });
})
function cantidadnotificacion(){
    $.post("http://paginacastinblanco.000webhostapp.com/Controlador/mensajeControler.php?op=mostrarCantidadNotificaciones", {}, function () { }).done(function (data) {
        // console.log(data)
        $("#cantidadnotificacion").html(data);
    });
}

$("#botonotificacionusuario").on('click',function(e){
    e.preventDefault();
    $.post("http://paginacastinblanco.000webhostapp.com/Controlador/mensajeControler.php?op=cargarNotificacionesUsuario", {}, function () { }).done(function (data) {
        // console.log(data)
        $("#mostrarmensajesnotifcacionUsuario").html(data);
        cantidadnotificacionUsuario();
    });
})

function cantidadnotificacionUsuario(){
    $.post("http://paginacastinblanco.000webhostapp.com/Controlador/mensajeControler.php?op=mostrarCantidadNotificacionesUsuario", {}, function () { }).done(function (data) {
        // console.log(data)
        $("#cantidadnotificacionUsuario").html(data);
    });
}

if ($("#cantidadnotificacionUsuario").length) {
    cantidadnotificacionUsuario();
}

if ($("#cantidadnotificacion").length) {
    cantidadnotificacion();
}


function respondermensaje(usu_id){
    console.log(usu_id)
    $('#idusuarionormal').val(usu_id);
}


function editarusuarioadmin(idusuario, nombre, correo, telefono){
$("#idusuarioadmin").val(idusuario);
$("#user_editar").val(nombre);
$("#user_email_editar").val(correo);
$("#user_telefono_editar").val(telefono);
}

function publicared(pro_nombre, pro_precio, pro_cantidad, tip_peso, foto){
    $("#publicaredModal").modal('show')

    $("#nombreproducto").val(pro_nombre) 
    $("#precioproducto").val(pro_precio) 
    $("#cantidadproducto").val(pro_cantidad) 
    $("#pesoproducto").val(tip_peso)
    $("#fotoproducto").val("SubidArchivos/archivos/articulosUsuario/"+foto)
}

$("#subirtumblr").on('click', function(e){
    e.preventDefault()

    nombreproducto = $("#nombreproducto").val() 
    precioproducto = $("#precioproducto").val() 
    cantidadproducto = $("#cantidadproducto").val() 
    pesoproducto = $("#pesoproducto").val()
    fotoproducto = $("#fotoproducto").val()
    datos = {
        "nombreproducto" : nombreproducto,
        "precioproducto" : precioproducto,
        "cantidadproducto" : cantidadproducto,
        "pesoproducto" : pesoproducto,
        "fotoproducto" : fotoproducto,
    }

swalWithBootstrapButtons({
        title: '¿Estas seguro subir el producto a la red social?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.post("http://paginacastinblanco.000webhostapp.com/Controlador/redsocialControler.php?op=subirTumblr", datos, function () { }).done(function (data) {
                console.log(data)
                $("#publicaredModal").modal('hide')
                datos = JSON.parse(data);
                valorestado = datos.estado.type;
                valormsg = datos.estado.msg;
                if (valorestado=='success') {
                alertaSuccess(valorestado, valormsg);
                }else{
                alertaError(valorestado, valormsg)
                }
            });
        } else if (result.dismiss === swal.DismissReason.cancel) {
        }
    });
})


$("input[name=cantidadproductos2]").change(function () {  
  // aqui va el codigo que requieres hacer cuando se genere algun cambio....
console.log($(this).val());
});

//////////////////////////////////////
// Fin de los Formularios AJAX
///////////////////////////////////////

// Ejecucion de los datatables
if ($("#tablacarritodecompras").length) {tablacarritodecompras();}
if ($("#tablaprocesarcompras").length) {tablaprocesarcompras();}
if ( $("#tablacomprastienda").length) {tablacomprastienda();}
if ($("#tablabancos").length) {tablabancos();}
if ($("#productosen1").length) {productosen1();}
if ($("#productosen0").length) {productosen0();}
if ($("#tabalatipoproducto").length) {tipoproductos();}
if ($("#usuariosen1").length) {usuariosen1();}
if ($("#usuariosen0").length) {usuariosen0();}
if ($("#tablamensajeusuario0").length) {tablamensajeusuario0();}
if ($("#tablamensajeusuario1").length) {tablamensajeusuario1();}
if ($("#tablamensajeadmin0").length) {tablamensajeadmin0();}
if ($("#tablamensajeadmin1").length) {tablamensajeadmin1();}