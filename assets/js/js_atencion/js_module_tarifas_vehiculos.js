$(document).ready(() => {

    const config = lenguaje;
    config.scrollX = true;
    const tabla_tarifas_vehiculo = $("#tabla_tarifas_vehiculos").DataTable(config);

    cargarOlder("anio_vehiculo");

});
