$(document).ready(() => {
    //se inician los datatable
    var tablaCliente = $("#tablaClientes").DataTable(lenguaje);
    var tablaEmpresa = $("#tablaEmpresas").DataTable(lenguaje);
    var tablaConductor = $("#tablaConductores").DataTable(lenguaje);

    //cargar cliente
    (() => {
        const url = base_route + "cargar_clientes";
        $.getJSON(url, (result) => {
            if (result.success) {
                $.each(result.data, (i, o) => {
                    tablaCliente.row
                        .add([
                            o.nombre_cliente,
                            o.rut_cliente,
                            o.telefono_cliente,
                            o.correo_cliente,
                            " <button value='" +
                            o.rut_cliente + "' " +
                            " onclick='cargarCliente(this.value)'" +
                            " data-toggle='modal' data-target='#modal_ver' class='btn btn-outline-info'><i class='far fa-eye color'></i></button>",
                        ])
                        .draw(false);
                });
            } else {
                console.log("ah ocurrido un error al cargar cliente");
            }
        });
    })();

    //cargar empresas
    (() => {
        const url = base_route + "cargar_empresas";
        $.getJSON(url, (result) => {
            if (result.success) {
                $.each(result.data, (i, o) => {
                    tablaEmpresa.row
                        .add([
                            o.nombre_empresa,
                            o.rut_empresa,
                            o.rol_empresa,
                            o.correo_empresa,
                            " <button value='" +
                            o.rut_empresa + "' " +
                            " onclick='cargarEmpresa(this.value)'" +
                            " data-toggle='modal' data-target='#modal_ver' class='btn btn-outline-info'><i class='far fa-eye color'></i></button>",
                        ])
                        .draw(false);
                });
            } else {
                console.log("ah ocurrido un error al cargar empresa");
            }
        });
    })();

    //cargar conductores
    (() => {
        const url = base_route + "cargar_conductores";
        $.getJSON(url, (result) => {
            if (result.success) {
                $.each(result.data, (i, o) => {
                    tablaConductor.row
                        .add([
                            o.nombre_conductor,
                            o.rut_conductor,
                            o.clase_conductor,
                            o.telefono_conductor,
                            " <button value='" +
                            o.rut_conductor + "' " +
                            " onclick='cargarConductor(this.value)'" +
                            " data-toggle='modal' data-target='#modal_ver' class='btn btn-outline-info'><i class='far fa-eye color'></i></button>",
                        ])
                        .draw(false);
                });

            } else {
                console.log("ah ocurrido un error al cargar conductor");
            }
        });
    })();
});