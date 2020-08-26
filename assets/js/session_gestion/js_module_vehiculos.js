$(document).ready(() => {

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
        e.preventDefault();
        //corregir validacion



        var modelo = $('#inputModelo').val()
        var patente = $('#inputPatente').val()
        var edad = $('#inputedad').val()
        var tipo = $('#inputTipo').val()
        var color = $('#inputColor').val()
        var sucursal = $('#inputSucursal').val()
        var propietario = $('#inputPropietario').val()
        var compra = $('#inputCompra').val()
        var precio = $('#inputPrecio').val()
        var fechaCompra = $('#inputFechaCompra').val()


        const data = {
            modelo,
            patente,
            edad,
            tipo,
            color,
            sucursal,
            propietario,
            compra,
            precio,
            fechaCompra
        }

        $.ajax({
            url: base_url + "registrar_vehiculo",
            type: "post",
            dataType: "json",
            data: data,
            success: (e) => {
                if (e.msg == "404") {
                    console.log("ocurrio un error al registrar el vehiculo");
                } else {
                    console.log("vehiculo registrado : ", e.msg);
                }
            },
            error: () => { console.log("error inesperado! "); }
        })

    });


});