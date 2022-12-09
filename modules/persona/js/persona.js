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
        $("#cedula").focus().prop('disabled', false);
    });

    /** funcion que limpia el formulario y cierrar el modal**/
    $("#cancelar").click(function(){
        $("#id_persona").val("");
        $("#cedula").val("");
        $("#nombre").val("");
        $("#telefono").val("");
        $("#direccion").val("");
        $("#email").val("");
        $("#guardar").show();
        $("#modificar").hide();
        $("#eliminar").hide();
        $("#tabla_persona input:checkbox").prop("checked", false);
    });

    /** funcion que valida la entrada de solo numeron en un campo de texto **/
    $('.solo-numero').keyup(function (){
        this.value = (this.value + '').replace(/[^0-9]/g, '');
    });

    /** funcion que valida formato de correo electronico en campo de texto**/
    $('.email').on("blur", function() {
        // Expresion regular para validar el correo
        var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
        // Se utiliza la funcion test() nativa de JavaScript
        if ($('.email').val()!="" && !regex.test($('.email').val().trim())) {
            $('.email').val("");
            swal({title: "AVISO",text: "La dirección de correo no es valida",timer: 3000,type: "warning"});
        }
    });

});

/** funcion que permite traer los datos de la base de datos **/
/** para enviarlo a la funcion que dibuja la tabla **/
function cargar_datos(){
    $.ajax({
        data:{
            clase  : "persona",
            accion : "listar",
            datos  : null
        },
        url: 'controllers/controlador.php',
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
function acciones(clase, accion)
{
    var datos={
            id_persona: $("#id_persona").val(),
            cedula    : $("#cedula").val(),
            nombre    : $("#nombre").val(),
            telefono  : $("#telefono").val(),
            direccion : $("#direccion").val(),
            email     : $("#email").val()
        };
    if(validar_input_vacios())
    {
        $.ajax({
            data:{
                clase  : clase,
                accion : accion,
                datos  : datos
            },
            url: 'controllers/controlador.php',
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
}

/** funcion que dibuja los datos traidos de la **/
/** base de datos en la tabla **/
function listado(data){

    if(data!=""){
        tabla = $('#tabla_persona').bootstrapTable('destroy').bootstrapTable({data: data});
        tabla.fadeIn();
        $(".load_table").hide();
        $(".fixed-table-loading").hide();
    }else{
        $('#tabla_persona').hide();
    }
    $("#tabla_persona tr").css("cursor","pointer").click(function(){
        console.log($(this))
        var valores = tabla.bootstrapTable('getSelections');
        asignar_valores(valores);
    });

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
function confirmar(){
    swal({
          title: "Esta seguro que desea eliminar esta Persona?",
          text: "",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Si, Eliminar",
          closeOnConfirm: false
        },
        function(){
          acciones("persona", "eliminar");
        });
}

/** funcion que valida si hay campos vacios **/
function validar_input_vacios(){
    var cont=0;
    $("#form_persona input[type=text]").each(function(){
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
function validar_cedula(cedula)
{
    $.ajax({
        data:{
            clase  : "persona",
            accion : "buscar",
            datos  : {cedula: cedula}
        },
        url: 'controllers/controlador.php',
        type: 'POST',
        dataType:'json',
        success:  function (resp)
        {
            if(resp["data"] != "")
            {
                swal({
                    title: "ALERTA",
                    text: "La cedula agregada ya existe en la base de datos",
                    timer: 3500,
                    type: "error"
                });
            }
        }
    });
}