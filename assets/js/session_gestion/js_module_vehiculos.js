$(document).ready(function() {

    var base_url = "http://localhost/Rentacar/";




    //iniciar el datateble
    $('#tablaVehiculos').DataTable({
        responsive: true,
        language: {

            "decimal": "",
            "emptyTable": "No hay datos",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "infoEmpty": "Mostrando 0 a 0 de 0 registros",
            "infoFiltered": "(Filtro de _MAX_ total registros)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ registros",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron coincidencias",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Próximo",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": Activar orden de columna ascendente",
                "sortDescending": ": Activar orden de columna desendente"
            }

        }
    });




    //registrar Vehiculo
    $("#btn_registrar_vehiculo").click((e) => {
        //  e.preventDefault();
        // no funcionan los validadores


        // verificar que los datos se estan guardando
        var data = new FormData();
        data.append('modelo', $('#inputModelo').val());
        data.append('patente', $('#inputPatente').val());
        data.append('edad', $('#inputedad').val());
        data.append('tipo', $('#inputTipo').val());
        data.append('color', $('#inputColor').val());
        data.append('sucursal', $('#inputSucursal').val());
        data.append('propietario', $('#inputPropietario').val());
        data.append('compra', $('#inputCompra').val());
        data.append('precio', $('#inputPrecio').val());
        data.append('fechaCompra', $('#inputFechaCompra').val());
        //opcion pendiente
        data.append('foto', $('#inputFoto').val());



        console.log(data);

        $.ajax({
            url: base_url + "registrar_vehiculo",
            type: "post",
            dataType: "json",
            data: { datos: "prueba datos" },
            success: (e) => { console.log("success: " + e); },
            error: (e) => { console.log("error: " + e); }
        })

    })


});