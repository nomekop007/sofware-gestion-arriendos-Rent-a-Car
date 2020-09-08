$(document).ready(() => {
    var base_route = $("#ruta").val();

    var lenguaje = {
        responsive: true,
        destroy: true,
        language: {
            decimal: "",
            emptyTable: "No hay datos",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(Filtro de _MAX_ total registros)",
            infoPostFix: "",
            thousands: ",",
            lengthMenu: "Mostrar _MENU_ registros",
            loadingRecords: "Cargando...",
            processing: "Procesando...",
            search: "Buscar:",
            zeroRecords: "No se encontraron coincidencias",
            paginate: {
                first: "Primero",
                last: "Ultimo",
                next: "Próximo",
                previous: "Anterior",
            },
            aria: {
                sortAscending: ": Activar orden de columna ascendente",
                sortDescending: ": Activar orden de columna desendente",
            },
        },
    };
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
                            o.rut_cliente,
                            o.nombre_cliente,
                            o.telefono_cliente,
                            o.correo_cliente,
                            "<button data-toggle='modal' data-target='#modal_ver' class='btn'><i class='far fa-eye color'></i></button>",
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
                            o.rut_empresa,
                            o.nombre_empresa,
                            o.rol_empresa,
                            o.correo_empresa,
                            "<button data-toggle='modal' data-target='#modal_ver' class='btn'><i class='far fa-eye color'></i></button>",
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
                            o.rut_conductor,
                            o.nombre_conductor,
                            o.clase_conductor,
                            o.telefono_conductor,
                            "<button data-toggle='modal' data-target='#modal_ver' class='btn'><i class='far fa-eye color'></i></button>",
                        ])
                        .draw(false);
                });
            } else {
                console.log("ah ocurrido un error al cargar conductor");
            }
        });
    })();
});