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
    $("#btn-contacto").click(function() {
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
</script>

<!-- importaciones del select2 -->
<script src="<?php echo base_route() ?>assets/js/select2.min.js"></script>

<!-- importaciones del arriendos -->
<script src="<?php echo base_route() ?>assets/js/js_gestion/js_module_arriendos/js_module_arriendos_registrar.js">
</script>

<script src="<?php echo base_route() ?>assets/js/js_gestion/js_module_arriendos/js_module_arriendos_todos.js">
</script>

<script src="<?php echo base_route() ?>assets/js/canvasVisorPDF.js">
</script>


<script src="<?php echo base_route() ?>assets/js/canvasFirmaDigital.js">
</script>

<script src="<?php echo base_route() ?>assets/js/comunaCiudad.js">
</script>