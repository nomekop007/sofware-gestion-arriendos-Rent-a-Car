//funcion que tranforma en mayuscula
//onblur="mayus(this);"
function mayus(e) {
    e.value = e.value.toUpperCase();
}

//Script para validar limite de numeros
//oninput="this.value = soloNumeros(this)"
function soloNumeros(evt) {
    if (evt.value.length > evt.maxLength) {
        return evt.value.slice(0, evt.maxLength);
    } else {
        return evt.value;
    }
}

// Script para cargar año vehiculo
function cargarOlder(input) {
    var n = new Date().getFullYear();
    var select = document.getElementById(input);
    for (var i = n; i >= 1970; i--) select.options.add(new Option(i, i));
}

// Script para validar los campos de un formulario
(() => {
    "use strict";
    window.addEventListener(
        "load",
        function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName("needs-validation");
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener(
                    "submit",
                    function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        } else {
                            event.preventDefault();
                        }
                        form.classList.add("was-validated");
                    },
                    false
                );
            });
        },
        false
    );
})();

// funcion para formatear rut
function formateaRut(rut) {
    //onblur="this.value=formateaRut(this.value)"
    var actual = rut.replace(/^0+/, "");
    if (actual != "" && actual.length > 1) {
        var sinPuntos = actual.replace(/\./g, "");
        var actualLimpio = sinPuntos.replace(/-/g, "");
        var inicio = actualLimpio.substring(0, actualLimpio.length - 1);
        var rutPuntos = "";
        var i = 0;
        var j = 1;
        for (i = inicio.length - 1; i >= 0; i--) {
            var letra = inicio.charAt(i);
            rutPuntos = letra + rutPuntos;
            if (j % 3 == 0 && j <= inicio.length - 1) {
                rutPuntos = "." + rutPuntos;
            }
            j++;
        }
        var dv = actualLimpio.substring(actualLimpio.length - 1);
        rutPuntos = rutPuntos + "-" + dv;
    }
    return rutPuntos;
}

//funcion para formatear fechas
function formatearFechaHora(fecha) {
    let f = new Date(fecha);
    let opciones = {
        weekday: "long",
        year: "numeric",
        month: "numeric",
        day: "numeric",
        hour: "numeric",
        minute: "numeric",
        second: "numeric",
    };
    return (fecha = f.toLocaleDateString("es-GB", opciones));
}

//funcion para formatear fechas
function formatearFecha(fecha) {
    let f = new Date(fecha);
    let opciones = {
        year: "numeric",
        month: "numeric",
        day: "numeric",
    };
    return (fecha = f.toLocaleDateString("es-GB", opciones));
}

//lenguaje de los datatable
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
//lenguaje del select 2
var lenguajeSelect2 = {
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
};

//se valida los input files
$(document).on("change", 'input[type="file"]', function() {
    var fileName = this.files[0].name;
    var fileSize = this.files[0].size;
    var ext = fileName.split(".");
    // ahora obtenemos el ultimo valor despues el punto
    // obtenemos el length por si el archivo lleva nombre con mas de 2 puntos
    ext = ext[ext.length - 1];
    switch (ext) {
        case "png":
            $("#tamanoArchivo").text(fileSize + " bytes en " + ext);
            break;
        case "jpeg":
            $("#tamanoArchivo").text(fileSize + " bytes " + ext);
            break;
        case "jpg":
            $("#tamanoArchivo").text(fileSize + " bytes " + ext);
            break;
        case "gif":
            $("#tamanoArchivo").text(fileSize + " bytes " + ext);
            break;
        case "pdf":
            $("#tamanoArchivo").text(fileSize + " bytes " + ext);
            break;
        default:
            alert("El archivo no tiene la extensión adecuada");
            this.value = ""; // reset del valor
            this.files[0].name = "";
            break;
    }
    //fileSize > 21000000  10mb
    //fileSize > 1500000
    if (fileSize > 12000000) {
        alert("El archivo tiene que pesar menos de 10mb");
        this.value = ""; // reset del valor
        this.files[0].name = "";
    }
});

// redimenciona una imagen en formato base 64 (base64, canvas.width, canvas.height)
//ES ASINCRONO
const resizeBase64Img = (base64, newWidth, newHeight) => {
    return new Promise((resolve, reject) => {
        var canvas = document.createElement("canvas");
        canvas.width = newWidth / 2;
        canvas.height = newHeight / 2;
        let context = canvas.getContext("2d");
        let img = document.createElement("img");
        img.src = base64;
        img.onload = function() {
            context.scale(newWidth / 2 / img.width, newHeight / 2 / img.height);
            context.drawImage(img, 0, 0);
            resolve(canvas.toDataURL());
        };
    });
};