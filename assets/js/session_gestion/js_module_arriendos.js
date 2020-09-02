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
                console.log(result);
            },
            error: () => {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "A ocurrido un Error al registrar vehiculo!",
                });
            },
        });
    });
});