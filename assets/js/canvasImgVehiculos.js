var image = new Image();
var limpiar = document.getElementById("limpiar-fotoVehiculo");
var limpiarTodo = document.getElementById("seleccionarFoto");


var canvasVehiculo = document.getElementById('canvas-fotoVehiculo');
var ctxVehiculo = canvasVehiculo.getContext('2d');;
var input = document.getElementById('inputImagenVehiculo');
var curFile = input.files;
var source = "";

var cwVehiculo = (canvasVehiculo.width = 1100),
    cxVehiculo = cwVehiculo / 2;
var chVehiculo = (canvasVehiculo.height = 600),
    cyVehiculo = chVehiculo / 2;


input.addEventListener('change', updateImageDisplay);

function updateImageDisplay() {
    var curFile = input.files;
    dibujar = false;
    ctxVehiculo.clearRect(0, 0, cwVehiculo, chVehiculo);
    Trazados.length = 0;
    puntos.length = 0;
    var list = document.createElement('ol');
    var listItem = document.createElement('li');
    for (var i = 0; i < curFile.length; i++) {
        if (validFileType(curFile[i])) {
            source = curFile[i].name;
            image.src = window.URL.createObjectURL(curFile[i]);
            image.onload = function() {
                ctxVehiculo.drawImage(image, 0, 0, canvasVehiculo.width, canvasVehiculo.height);
                image.style.display = 'none';
            }
            listItem.appendChild(image);
        }

        list.appendChild(listItem);
    }
}

var fileTypes = [
    'image/jpeg',
    'image/pjpeg',
    'image/png'
]

function validFileType(file) {
    for (var i = 0; i < fileTypes.length; i++) {
        if (file.type === fileTypes[i])
            return true;
    }

    return false;
}



//Dibujar en el camvas

var dibujar = false;
var factorDeAlisamiento = 5;
var Trazados = [];
var puntos = [];
ctxVehiculo.lineJoin = "round";

var color = "black";
var grosor = 1;

function defcolor(c) {
    color = c;
}

function defgrosor(g) {
    grosor = g;
}


limpiarTodo.addEventListener(
    "click",
    function(evt) {
        dibujar = false;
        ctxVehiculo.clearRect(0, 0, cwVehiculo, chVehiculo);
        Trazados.length = 0;
        puntos.length = 0;
        curFile = null;
        input.files = null;
        input.value = null;
        image.src = "";
    },
    false
);



limpiar.addEventListener(
    "click",
    function(evt) {
        dibujar = false;
        ctxVehiculo.clearRect(0, 0, cwVehiculo, chVehiculo);
        Trazados.length = 0;
        puntos.length = 0;
        ctxVehiculo.drawImage(image, 0, 0, canvasVehiculo.width, canvasVehiculo.height);
    },
    false
);

canvasVehiculo.addEventListener(
    "mousedown",
    function(evt) {
        dibujar = true;
        //ctxVehiculo.clearRect(0, 0, cwVehiculo, chVehiculo);
        puntos.length = 0;
        ctxVehiculo.beginPath();
    },
    false
);

canvasVehiculo.addEventListener(
    "mouseup",
    function(evt) {
        dibujar = false;
        ctxVehiculo.strokeStyle = color;
        ctxVehiculo.lineWidth = grosor;
    },
    false
);

canvasVehiculo.addEventListener(
    "mouseout",
    function(evt) {
        dibujar = false;
        ctxVehiculo.strokeStyle = color;
        ctxVehiculo.lineWidth = grosor;
    },
    false
);

canvasVehiculo.addEventListener(
    "mousemove",
    function(evt) {
        if (dibujar) {
            var m = oMousePos(canvasVehiculo, evt);
            puntos.push(m);
            ctxVehiculo.lineTo(m.x, m.y);
            ctxVehiculo.stroke();
        }
    },
    false
);