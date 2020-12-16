</div>
</div>
</main>
</div>
<br><br><br>
</div>


<script>
$("#m_tarifas").addClass("active");
$("#l_tarifas").addClass("card");

$(document).ready(() => {
    cargarSelectSucursal("cargar_Sucursales", "inputSucursal");
});
</script>


<script
    src="<?php echo base_route() ?>assets/js/js_atencion/js_module_tarifas_accesorios.js?v=<?php echo version(); ?>">
</script>
<script
    src="<?php echo base_route() ?>assets/js/js_atencion/js_module_tarifas_promociones.js?v=<?php echo version(); ?>">
</script>
<script src="<?php echo base_route() ?>assets/js/js_atencion/js_module_tarifas_remplazos.js?v=<?php echo version(); ?>">
</script>
<script src="<?php echo base_route() ?>assets/js/js_atencion/js_module_tarifas_vehiculos.js?v=<?php echo version(); ?>">
</script>