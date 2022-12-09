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
    });

    /** funcion que limpia el formulario y cierrar el modal**/
    $("#cancelar").click(function(){
        $("#id_prueba").val("");
        $("#dato1").val("");
        $("#dato2").val("");
        $("#guardar").show();
        $("#modificar").hide();
        $("#eliminar").hide();
        $("#tabla_prueba input:checkbox").prop("checked", false);
    });

});

/** funcion que permite traer los datos de la base de datos **/
/** para enviarlo a la funcion que dibuja la tabla **/
function cargar_datos(){
    $.ajax({
        data:{
            clase  : "prueba",
            accion : "listar",
            datos  : null
        },
        url: 'controllers/pruebaController.php',
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
            id_prueba: $("#id_prueba").val(),
            dato1    : $("#dato1").val(),
            dato2    : $("#dato2").val()
        };
    if(validar_input_vacios())
    {
        $.ajax({
            data:{
                clase  : clase,
                accion : accion,
                datos  : datos
            },
            url: 'controllers/pruebaController.php',
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
                    swal(resp["message"], resp["error"], "error");
                }
            }
        });
    }
}

/** funcion que dibuja los datos traidos de la **/
/** base de datos en la tabla **/
function listado(data){

    if(data!=""){
        tabla = $('#tabla_prueba').bootstrapTable('destroy').bootstrapTable({data: data});
        tabla.fadeIn();
        $(".load_table").hide();
        $(".fixed-table-loading").hide();
    }else{
        $('#tabla_prueba').hide();
    }
    $("#tabla_prueba tr").css("cursor","pointer").click(function(){
        console.log($(this))
        var valores = tabla.bootstrapTable('getSelections');
        asignar_valores(valores);
    });

}

/** funcion que permite asignar los valores en los **/
/** campos del formulario y muestra el modal **/
function asignar_valores(data){
    $("#id_prueba").val(data[0]['id_prueba']);
    $("#dato1").val(data[0]['dato1']);
    $("#dato2").val(data[0]['dato2']);
    $("#guardar").hide();
    $("#modificar").show();
    $("#eliminar").show();
    $("#formulario").modal('show');
}

/** funcion que permite mostrar un mensaje de confirmacion **/
/** a la hora de seleccionar la opcion eliminar **/
function eliminar_prueba(){
    swal({
          title: "Esta seguro que desea eliminar estos datos?",
          text: "",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Si, Eliminar",
          closeOnConfirm: false
        },
        function(){
          acciones("prueba", "eliminar");
        });
}

/** funcion que valida si hay campos vacios **/
function validar_input_vacios(){
    var cont=0;
    $("#form_prueba input[type=text]").each(function(){
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