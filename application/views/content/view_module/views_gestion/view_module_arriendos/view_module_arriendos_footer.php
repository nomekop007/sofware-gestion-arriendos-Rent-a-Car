</div>
<br><br>
</div>
</main>


</div>
</div>



<script>
// Script para cargar vigencia Empresa
(() => {
    var n = (new Date()).getFullYear()
    var select = document.getElementById("inputVigencia");
    for (var i = n; i >= 1970; i--) select.options.add(new Option(i, i));
})();

// Script para cambia el tab cliente de acuerdo al tipo de arriendo
(tipoArriendo = () => {
    var a = $("#inputTipo option:selected").val();
    if (a == 1) {
        $('#titulo_empresa').hide();
        $('#form_empresa').hide();
        $('#form_carnet_empresa').hide();
        $('#titulo_cliente').show();
        $('#form_cliente').show();
        $('#form_comprobante_cliente').show();
        $('#form_licencia_conducir').show();
        $('#form_carnet_cliente').show();
    } else if (a == 2) {
        $('#titulo_cliente').show();
        $('#form_cliente').show();
        $('#titulo_empresa').show();
        $('#form_empresa').show();
        $('#form_carnet_empresa').show();
        $('#form_comprobante_cliente').show();
        $('#form_licencia_conducir').show();
        $('#form_carnet_cliente').show();
    } else {
        $('#titulo_cliente').hide();
        $('#form_cliente').hide();
        $('#form_carnet_cliente').hide();
        $('#form_comprobante_cliente').hide();
        $('#titulo_empresa').show();
        $('#form_empresa').show();
    }
})();

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


//espiners de los forms cliente , conductor y empresa
$("#spinner_conductor").hide();
$("#spinner_cliente").hide();
$("#spinner_empresa").hide();
$("#spinner_btn_registrar").hide();

//carga tablaTotalArriendos
function cargarArriendoEnTabla(arriendo) {
    var tablaTotalArriendos = $("#tablaTotalArriendos").DataTable(lenguaje);
    tablaTotalArriendos.row
        .add([
            arriendo.id_arriendo,
            arriendo.createdAt,
            arriendo.tipo_arriendo,
            arriendo.estado_arriendo,
            arriendo.usuario.nombre_usuario,
            " <button  onclick='confirmacionArriendo(" +
            arriendo.id_arriendo +
            ")' data-toggle='modal' data-target='#modal_confirmar_arriendo' class='btn btn-outline-info'><i class='fas fa-check-circle'></i></button>  " +
            " <button data-toggle='modal' data-target='#modal_bajar_docs' class='btn btn-outline-dark'><i class='far fa-file-alt'></i></button>  " +
            " <button data-toggle='modal' data-target='#modal_editar_arriendo' class='btn btn btn-outline-primary'><i class='far fa-edit'></i></button>  ",
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