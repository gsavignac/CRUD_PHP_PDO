$(document).ready(function(){

    // si se le da enter en el campo de contraseña
    // se ejecuta la accion de iniciar sesion
    $("#passkey").keypress(function(e) {
         if(e.which == 13) {
            iniciar_sesion();
         }
    });
});
/** 
 * funcion que permite enviar credenciales para
 * verificar autenticacion del usuario
 *  **/
function iniciar_sesion()
{
    var datos={
            username    : $("#username").val(),
            passkey    : $("#passkey").val()
        };
    if(validar_input_vacios())
    {
        $.ajax({
            data:{
                accion : 'iniciar_sesion',
                datos  : datos
            },
            url: 'controllers/loginController.php',
            type: 'POST',
            dataType:'json',
            success:  function (resp)
            {
                console.log(resp)
                if(resp["success"])
                {
                    //redireccionar
                    document.location = 'admin.php';
                }else{
                    swal(resp["message"], resp["error"], "error");
                }
            }
        });
    }
}

/** 
 * funcion que permite cerrar la sesion activa
 *  **/
function cerrar_sesion()
{
    swal({
          title: "Esta seguro que desea cerrar la sesión?",
          text: "",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-info",
          confirmButtonText: "Si",
          closeOnConfirm: false
        },
        function(){
            $.ajax({
                data:{
                    clase  : 'login',
                    accion : 'cerrar_sesion',
                    datos  : null
                },
                url: 'controllers/loginController.php',
                type: 'POST',
                dataType:'json',
                success:  function (resp)
                {
                    if(resp["success"])
                    {
                        //redireccionar
                        document.location = 'index.php';
                    }else{
                        swal(resp["message"], "", "error");
                    }
                }
            });
        });
}


/** funcion que valida si hay campos vacios **/
function validar_input_vacios(){
    var cont=0;
    $("#form_login input[type=text]").each(function(){
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