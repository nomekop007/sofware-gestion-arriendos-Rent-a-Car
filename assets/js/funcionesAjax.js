// ruta definitiva al helper_url
var base_route = $("#ruta").val();
var storage = $("#storage").val();

//cargar selects
function cargarSelect(ruta, idSelect) {
    const url = base_route + ruta;
    const select = document.getElementById(idSelect);
    $.getJSON(url, (result) => {
        if (result.success) {
            $.each(result.data, (i, object) => {
                const option = document.createElement("option");
                for (const key in object) {
                    if (key.includes("nombre")) {
                        option.innerHTML = object[key];
                    }
                    if (key.includes("id")) {
                        option.value = object[key];
                    }
                }
                select.appendChild(option);
            });
        } else {
            console.log("ah ocurrido un error al cargar");
        }
    });
}