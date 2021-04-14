
//funcion para ocultar y mostrar constraseñas
const mostrarPasswordClaveActual = (inputEditClaveUsuario) => {
    var cambio = document.getElementById("inputEditClaveUsuario");
    if (cambio.type == "password") {
        cambio.type = "text";
        $(".icon").removeClass("fa fa-eye-slash").addClass("fa fa-eye");
    } else {
        cambio.type = "password";
        $(".icon").removeClass("fa fa-eye").addClass("fa fa-eye-slash");
    }
   
};



//metodo para editar a los uusarios
$("#btn_editar_usuario").click(async () => {
    const nombre = $("#inputEditNombreUsuario").val();
    const correo = $("#inputEditCorreoUsuario").val();
    const clave = $("#inputEditClaveUsuario").val();
    const form = $("#form_editar_usuario")[0];
    const data = new FormData(form);
    if (nombre.length != 0 && correo.length != 0) {
        if (clave.length != 0) {
            if (clave.length < 8) {
                Swal.fire({
                    icon: "warning",
                    title: "la clave debe tener minimo 8 caracteres",
                });
                return;
            }
        }
        const response = await ajax_function(data, "editar_usuario");
        if (response.success) {
            Swal.fire("Exito", response.msg, "success");
            $("#modal_editar_usuario").modal("toggle");            
        }
    }
});