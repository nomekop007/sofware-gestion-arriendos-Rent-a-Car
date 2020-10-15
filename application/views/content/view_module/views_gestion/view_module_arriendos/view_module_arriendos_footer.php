</div>
<br><br>
</main>

</div>
</div>



<script>
$("#m_arriendo").addClass("active");
$("#l_arriendo").addClass("card");

//funciones para cambiar de color los botones del tab Registrar arriendo
$("#btn-arriendo").click(function() {
    $(this).toggleClass("btn-dark btn-outline-dark");
});
$("#btn-cliente").click(function() {
    $(this).toggleClass("btn-dark btn-outline-dark");
});
$("#btn-conductor").click(function() {
    $(this).toggleClass("btn-dark btn-outline-dark");
});
$("#btn-vehiculo").click(function() {
    $(this).toggleClass("btn-dark btn-outline-dark");
});
$("#btn-garantia").click(function() {
    $(this).toggleClass("btn-dark btn-outline-dark");
});


$(document).ready(() => {
    $("#tablaTotalArriendos").DataTable(lenguaje);
});


//carga tablaTotalArriendos
function cargarArriendoEnTabla(arriendo) {
    var cliente = "";
    switch (arriendo.tipo_arriendo) {
        case "PARTICULAR":
            var cliente = arriendo.cliente.nombre_cliente;
            break;
        case "REMPLAZO":
            var cliente = arriendo.remplazo.cliente.nombre_cliente;
            break;
        case "EMPRESA":
            var cliente = arriendo.empresa.nombre_empresa;
            break;
        default:
            break;
    }

    var tablaTotalArriendos = $("#tablaTotalArriendos").DataTable(lenguaje);
    tablaTotalArriendos.row
        .add([
            arriendo.id_arriendo,
            cliente,
            formatearFechaHora(arriendo.createdAt),
            arriendo.tipo_arriendo,
            arriendo.estado_arriendo,
            arriendo.usuario.nombre_usuario,
            " <button " +
            "id='" +
            arriendo.id_arriendo +
            "' " +
            " value='" +
            arriendo.id_arriendo +
            "' " +
            " onclick='cargarArriendo(this.value)'" +
            " data-toggle='modal' data-target='#modal_confirmar_arriendo' class='btn btn-outline-info'><i class='fas fa-feather-alt'></i></button>  " +
            " <button disabled data-toggle='modal' data-target='#modal_editar_arriendo' class='btn btn btn-outline-primary'><i class='far fa-edit'></i></button>  ",
        ])
        .draw(false);

    if (arriendo.estado_arriendo != "PENDIENTE") {
        $(`#${arriendo.id_arriendo}`).attr("disabled", true);
    }
}
</script>

<!-- importaciones del select2 -->
<script src="<?php echo base_url() ?>assets/js/select2.min.js"></script>

<!-- importaciones del arriendos -->
<script src="<?php echo base_url() ?>assets/js/js_gestion/js_module_arriendos/js_module_arriendos_registrar.js">
</script>

<script src="<?php echo base_url() ?>assets/js/js_gestion/js_module_arriendos/js_module_arriendos_todos.js">
</script>


<script src="<?php echo base_url() ?>assets/js/firmaDigital.js">
</script>