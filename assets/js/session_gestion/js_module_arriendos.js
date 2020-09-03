$(document).ready(() => {
    var base_route = $("#ruta").val();

    //select2 de los vehiculos
    $("#select_vehiculos").select2({
        placeholder: "Vehiculos disponibles",
        allowClear: true,
        language: {
            noResults: () => {
                return "No hay resultado";
            },
            searching: () => {
                return "Buscando..";
            },
        },
    });

    //cargar sucursales
    (() => {
        const url = base_route + "cargar_Sucursales";
        const select = document.getElementById("inputSucursal");
        $.getJSON(url, (result) => {
            if (result.success) {
                $.each(result.data, (i, o) => {
                    const option = document.createElement("option");
                    option.innerHTML = o.nombre_sucursal;
                    option.value = o.id_sucursal;
                    select.appendChild(option);
                });
            } else {
                console.log("ah ocurrido un error al cargar las sucursales");
            }
        });
    })();

    $("#buscar_vehiculos").click(() => {
        var id_sucursal = $("#inputSucursal").val();
        $.ajax({
            url: base_route + "cargar_VehiculosPorSucursal",
            type: "post",
            dataType: "json",
            data: { id_sucursal },
            success: (result) => {
                if (result.success) {
                    $("#select_vehiculos").empty();
                    const select = document.getElementById("select_vehiculos");
                    $.each(result.data.vehiculos, (i, o) => {
                        const option = document.createElement("option");
                        option.innerHTML =
                            "PATENTE: " +
                            o.patente_vehiculo +
                            " - MODELO: " +
                            o.modelo_vehiculo +
                            "  -  " +
                            o.año_vehiculo;
                        option.value = o.patente_vehiculo;
                        select.appendChild(option);
                    });

                    $("#select_vehiculos").attr("disabled", false);
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: result.msg,
                    });
                }
            },
            error: () => {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "A ocurrido un Error Contacte a informatica",
                });
            },
        });
    });

    $("#btn_crear_arriendo").click(() => {
        console.log("guardando...");
    });
});