$(document).ready(() => {
    var base_url = "http://localhost/proyectos/Rentacar/";

    //iniciar el datateble
    $("#tablaVehiculos").DataTable({
        responsive: true,
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
    });

    $("#btn_registrar_vehiculo").click(() => {
        var patente = $("#inputPatente").val();
        var modelo = $("#inputModelo").val();
        var edad = $("#inputedad").val();
        var tipo = $("#inputTipo").val();
        var color = $("#inputColor").val();
        var sucursal = $("#inputSucursal").val();
        var propietario = $("#inputPropietario").val();
        var compra = $("#inputCompra").val();
        var precio = $("#inputPrecio").val();
        var fechaCompra = $("#inputFechaCompra").val();

        if (
            patente.length != 0 &&
            modelo.length != 0 &&
            edad.length != 0 &&
            color.length != 0 &&
            propietario.length != 0 &&
            compra.length != 0 &&
            precio.length != 0 &&
            fechaCompra.length != 0
        ) {
            $.ajax({
                url: base_url + "registrar_vehiculo",
                type: "post",
                dataType: "json",
                data: {
                    patente,
                    modelo,
                    edad,
                    tipo,
                    color,
                    sucursal,
                    propietario,
                    compra,
                    precio,
                    fechaCompra,
                },
                success: (e) => {
                    if (e.msg == "404") {
                        console.log(e.msg);
                        Swal.fire("ocurrio un error al registrar el vehiculo");
                    } else {
                        Swal.fire("Vehiculo registrado");
                        console.log(e.msg);
                    }
                },
                error: () => {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "A ocurrido un Error!",
                    });
                },
            });
        }
    });
});