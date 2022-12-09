var tabla = "";
var valores = "";
$(document).ready(function(){

    /** mandamos a cargar los datos en la tabla **/
    cargar_datos();

    /** accion que permite abriel el modal con el formulario**/
    $("#btn_nuevo").click(function(){
        $("#modificar").hide();
        $("#eliminar").hide();
        $("#formulario").modal('show');
        $("#username").focus().prop('disabled', false);
    });

    /** funcion que limpia el formulario y cierrar el modal**/
    $("#cancelar").click(function(){
        $("#id_usuario").val("");
        $("#username").val("");
        $("#passkey").val("");
        $("#confirm_passkey").val("");
        $("#guardar").show();
        $("#modificar").hide();
        $("#eliminar").hide();
        $("#tabla_usuarios input:checkbox").prop("checked", false);
    });

    /** funcion que valida la entrada de solo numeron en un campo de texto **/
    $('#confirm_passkey').keyup(function (){
        var passkey = $("#passkey").val();
        var confirm_passkey = $("#confirm_passkey").val();
        if(passkey == confirm_passkey){
            $("#success_pass").show();
            $("#error_pass").hide();
        }else{
            $("#success_pass").hide();
            $("#error_pass").show();
        }
    });

});

/** funcion que permite traer los datos de la base de datos **/
/** para enviarlo a la funcion que dibuja la tabla **/
function cargar_datos(){
    $.ajax({
        data:{
            clase  : "usuarios",
            accion : "listar",
            datos  : null
        },
        url: 'controllers/usuariosController.php',
        type: 'POST',
        dataType:'json',
        success:  function (resp)
        {
            if(resp["success"])
            {
                listado(resp["data"]);
            }
        }
    });
}
/** funcion que captura la accion a realizar en el crud **/
function acciones(clase, accion, data = null)
{
    var datos={
            id_usuario  : $("#id_usuario").val(),
            username    : $("#username").val(),
            passkey     : $("#passkey").val()
        };

    if(data != null){
        datos = data;
    }else{
        validar_input_vacios();
    }

    $.ajax({
        data:{
            clase  : clase,
            accion : accion,
            datos  : datos
        },
        url: 'controllers/usuariosController.php',
        type: 'POST',
        dataType:'json',
        success:  function (resp)
        {
            if(resp["success"])
            {
                swal({title: resp["message"],text: "",timer: 2000,type: "success"});
                $("#cancelar").click();
                cargar_datos();
            }else{
                swal(resp["message"], "", "error");
            }
        }
    });
}

/** funcion que dibuja los datos traidos de la **/
/** base de datos en la tabla **/
function listado(data){

    if(data!=""){
        tabla = $('#tabla_usuarios').bootstrapTable('destroy').bootstrapTable({data: data});
        tabla.fadeIn();
        $(".load_table").hide();
        $(".fixed-table-loading").hide();
    }else{
        $('#tabla_usuarios').hide();
    }

}

/** funcion que permite asignar los valores en los **/
/** campos del formulario y muestra el modal **/
function asignar_valores(data){
    $("#id_persona").val(data[0]['id_persona']);
    $("#cedula").val(data[0]['cedula']).prop('disabled', true);
    $("#nombre").val(data[0]['nombre']);
    $("#telefono").val(data[0]['telefono']);
    $("#direccion").val(data[0]['direccion']);
    $("#email").val(data[0]['email']);
    $("#guardar").hide();
    $("#modificar").show();
    $("#eliminar").show();
    $("#formulario").modal('show');
}

/** funcion que permite mostrar un mensaje de confirmacion **/
/** a la hora de seleccionar la opcion eliminar **/
function eliminar(id_usuario){
    swal({
          title: "Esta seguro que desea eliminar el usuario?",
          text: "",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Si, Eliminar",
          closeOnConfirm: false
        },
        function(){
          acciones("usuarios", "eliminar", {'id_usuario': id_usuario});
        });
}

/** funcion que valida si hay campos vacios **/
function validar_input_vacios(){
    var cont=0;
    $("#form_usuarios input[type=text]").each(function(){
        if($(this).val()==""){
            var campo = $(this).attr("title");
            $(this).focus();
            swal({
                title: "AVISO",
                text: "El campo "+campo+" Se encuentra Vacio",
                timer: 3000,
                type: "warning"
            });
            cont++;
            return false;
        }
    });
    if(cont==0){return true;}else{return false;}
}

/** funcion que permite verificar si la cedula **/
/** agregada en el campo existe en la base de datos **/
function validar_username(username)
{
    $.ajax({
        data:{
            clase  : "usuarios",
            accion : "buscar",
            datos  : {username: username}
        },
        url: 'controllers/usuariosController.php',
        type: 'POST',
        dataType:'json',
        success:  function (resp)
        {
            if(resp["data"] != "")
            {
                swal({
                    title: "ALERTA",
                    text: "El nombre de usuario ya se encuentra registrado",
                    timer: 3500,
                    type: "error"
                });

                $("#username").val("");
            }
        }
    });
}

function cambiar_estatus(id_usuario, estatus){
    if(estatus == 'ACTIVO'){
        estatus = 'INACTIVO';
    }else{
        estatus = 'ACTIVO';
    }
    acciones("usuarios", "actualizar", {'id_usuario': id_usuario, 'estatus': estatus});
}