</div>
<br><br>
</div>
</main>


</div>
</div>



<script>
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
$("#btn-documentos").click(function() {
    $(this).toggleClass("btn-dark btn-outline-dark");
});


$(document).ready(() => {
    $("#tablaTotalArriendos").DataTable(lenguaje);
});

//carga tablaTotalArriendos
function cargarArriendoEnTabla(arriendo) {
    var tablaTotalArriendos = $("#tablaTotalArriendos").DataTable(lenguaje);
    tablaTotalArriendos.row
        .add([
            arriendo.id_arriendo,
            formatearFechaHora(arriendo.createdAt),
            arriendo.tipo_arriendo,
            arriendo.estado_arriendo,
            arriendo.usuario.nombre_usuario,
            " <button  onclick='cargarPagoArriendo(" +
            arriendo.id_arriendo +
            ")' data-toggle='modal' data-target='#modal_confirmar_arriendo' class='btn btn-outline-info'><i class='fas fa-check-circle'></i></button>  " +
            " <button data-toggle='modal' data-target='#modal_bajar_docs' class='btn btn-outline-dark'><i class='far fa-file-alt'></i></button>  "
            /*    " <button data-toggle='modal' data-target='#modal_editar_arriendo' class='btn btn btn-outline-primary'><i class='far fa-edit'></i></button>  ", */
        ])
        .draw(false);
}
</script>

<!-- importaciones del select2 -->
<script src="<?php echo base_route() ?>/assets/js/select2.min.js"></script>

<!-- importaciones del arriendos -->
<script src="<?php echo base_route() ?>/assets/js/js_gestion/js_module_arriendos/js_module_arriendos_registrar.js">
</script>
<script src="<?php echo base_route() ?>/assets/js/js_gestion/js_module_arriendos/js_module_arriendos_activos.js">
</script>
<script src="<?php echo base_route() ?>/assets/js/js_gestion/js_module_arriendos/js_module_arriendos_todos.js">
</script>