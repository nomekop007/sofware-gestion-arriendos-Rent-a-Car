$(document).ready(() => {

    (() => {
        const url = base_route + "cargar_TotalArriendos";
        $.getJSON(url, (result) => {
            if (result.success) {
                $.each(result.data, (i, arriendo) => {
                    cargarArriendoEnTabla(arriendo);
                });
            } else {
                console.log("ah ocurrido un error al cargar los arriendos");
            }
        });
    })();



    $("#btn_crear_contrato").click(() => {
        console.log("contratar");
    })

});