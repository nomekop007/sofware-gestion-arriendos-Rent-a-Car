const canvasImgVehiculos = {
    resize: 2,
    id_limpiarCanvas: "",
    id_dibujarCanvas: "",
    name_dibujarCanvas: "",
    id_inputImg: "",
    image: new Image(),
    canvasVehiculo: "",
    ctxVehiculo: "",
    input: "",
    curFile: null,
    source: "",
    cwVehiculo: null,
    chVehiculo: null,
    fileTypes: ["image/jpeg", "image/jpg", "image/png"],
    dibujar: false,
    factorDeAlisamiento: 5,
    Trazados: [],
    puntos: [],
    color: "black",
    grosor: 1,
    mImgVehiculo: { x: 0, y: 0 },
    cxVehiculo: null,
    cyVehiculo: null,
    eventsRyImgVehiculo: [
        { event: "mousedown", func: onStartVehiculo },
        { event: "touchstart", func: onStartVehiculo },
        { event: "mousemove", func: onMoveVehiculo },
        { event: "touchmove", func: onMoveVehiculo },
        { event: "mouseup", func: onEndVehiculo },
        { event: "touchend", func: onEndVehiculo },
        { event: "mouseout", func: onEndVehiculo },
    ]
}



function mostrarCanvasImgVehiculo([canvas, id_limpiar, id_dibujar, id_inputIMG]) {

    canvasImgVehiculos.id_limpiarCanvas = id_limpiar;
    canvasImgVehiculos.id_dibujarCanvas = id_dibujar;
    canvasImgVehiculos.id_inputImg = id_inputIMG;
    canvasImgVehiculos.input = document.getElementById(id_inputIMG);
    canvasImgVehiculos.curFile = canvasImgVehiculos.input.files;
    canvasImgVehiculos.canvasVehiculo = document.getElementById(canvas);
    canvasImgVehiculos.ctxVehiculo = canvasImgVehiculos.canvasVehiculo.getContext("2d");
    canvasImgVehiculos.ctxVehiculo.lineJoin = "round";
    canvasImgVehiculos.cwVehiculo = (canvasImgVehiculos.canvasVehiculo.width = 1300), canvasImgVehiculos.cxVehiculo = canvasImgVehiculos.cwVehiculo / 2;
    canvasImgVehiculos.chVehiculo = (canvasImgVehiculos.canvasVehiculo.height = 700), canvasImgVehiculos.cyVehiculo = canvasImgVehiculos.chVehiculo / 2;

    document.getElementById(canvasImgVehiculos.id_limpiarCanvas).addEventListener("click", limpiarCanvas);
    document.getElementById(canvasImgVehiculos.id_dibujarCanvas).addEventListener("click", dibujarCanvas);
    document.getElementById(canvasImgVehiculos.id_inputImg).addEventListener("change", updateImageDisplay);
    limpiarTodoCanvasVehiculo();
}





function updateImageDisplay() {
    let curFile = canvasImgVehiculos.input.files;
    canvasImgVehiculos.dibujar = false;
    canvasImgVehiculos.ctxVehiculo.clearRect(0, 0, canvasImgVehiculos.cwVehiculo, canvasImgVehiculos.chVehiculo);
    canvasImgVehiculos.Trazados.length = 0;
    canvasImgVehiculos.puntos.length = 0;
    let list = document.createElement("ol");
    let listItem = document.createElement("li");
    for (let i = 0; i < curFile.length; i++) {
        if (validFileType(curFile[i])) {
            canvasImgVehiculos.source = curFile[i].name;
            canvasImgVehiculos.image.src = window.URL.createObjectURL(curFile[i]);

            canvasImgVehiculos.image.onload = function () {
                canvasImgVehiculos.canvasVehiculo.width = this.width / canvasImgVehiculos.resize;
                canvasImgVehiculos.canvasVehiculo.height = this.height / canvasImgVehiculos.resize;
                canvasImgVehiculos.ctxVehiculo.drawImage(
                    canvasImgVehiculos.image,
                    0,
                    0,
                    canvasImgVehiculos.canvasVehiculo.width,
                    canvasImgVehiculos.canvasVehiculo.height
                );
                canvasImgVehiculos.image.style.display = "none";
            };
            listItem.appendChild(canvasImgVehiculos.image);
        }
        list.appendChild(listItem);
    }
}


function validFileType(file) {
    for (let i = 0; i < canvasImgVehiculos.fileTypes.length; i++) {
        if (file.type === canvasImgVehiculos.fileTypes[i]) return true;
    }
    return false;
}



function defcolor(c) {
    canvasImgVehiculos.color = c;
}

function defgrosor(g) {
    canvasImgVehiculos.grosor = g;
}


function onStartVehiculo(evt) {
    evt.preventDefault();
    canvasImgVehiculos.mImgVehiculo = oMousePosVehiculo(canvasImgVehiculos.canvasVehiculo, evt);
    canvasImgVehiculos.ctxVehiculo.beginPath();
    canvasImgVehiculos.ctxVehiculo.strokeStyle = canvasImgVehiculos.color;
    canvasImgVehiculos.ctxVehiculo.lineWidth = canvasImgVehiculos.grosor;
    canvasImgVehiculos.dibujar = true;
}

function onMoveVehiculo(evt) {
    evt.preventDefault();
    if (canvasImgVehiculos.dibujar) {
        canvasImgVehiculos.ctxVehiculo.moveTo(canvasImgVehiculos.mImgVehiculo.x, canvasImgVehiculos.mImgVehiculo.y);
        canvasImgVehiculos.mImgVehiculo = oMousePosVehiculo(canvasImgVehiculos.canvasVehiculo, evt);
        canvasImgVehiculos.ctxVehiculo.lineTo(canvasImgVehiculos.mImgVehiculo.x, canvasImgVehiculos.mImgVehiculo.y);
        canvasImgVehiculos.ctxVehiculo.strokeStyle = canvasImgVehiculos.color;
        canvasImgVehiculos.ctxVehiculo.lineWidth = canvasImgVehiculos.grosor;
        canvasImgVehiculos.ctxVehiculo.stroke();
    }
}

function onEndVehiculo(evt) {
    evt.preventDefault();
    canvasImgVehiculos.dibujar = false;
}

function oMousePosVehiculo(canvasVehiculo, evt) {
    let ClientRect = canvasVehiculo.getBoundingClientRect();
    let e = evt.touches ? evt.touches[0] : evt;
    return {
        x: Math.round(e.clientX - ClientRect.left),
        y: Math.round(e.clientY - ClientRect.top),
    };
}

function dibujarCanvas() {
    const checked = $(`[name=${canvasImgVehiculos.id_dibujarCanvas}]:checked`).length;
    if (checked == 1) {
        ActiletEventosDibujar();
    } else {
        DesactiletEventosDibujar();
    }
}

function ActiletEventosDibujar() {
    for (let i = 0; i < canvasImgVehiculos.eventsRyImgVehiculo.length; i++) {
        (function (i) {
            let e = canvasImgVehiculos.eventsRyImgVehiculo[i].event;
            let f = canvasImgVehiculos.eventsRyImgVehiculo[i].func;
            canvasImgVehiculos.canvasVehiculo.addEventListener(e, f, false);
        })(i);
    }
}

function DesactiletEventosDibujar() {
    for (let i = 0; i < canvasImgVehiculos.eventsRyImgVehiculo.length; i++) {
        (function (i) {
            let e = canvasImgVehiculos.eventsRyImgVehiculo[i].event;
            let f = canvasImgVehiculos.eventsRyImgVehiculo[i].func;
            canvasImgVehiculos.canvasVehiculo.removeEventListener(e, f, false);
        })(i);
    }
}




function limpiarCanvas() {
    canvasImgVehiculos.dibujar = false;
    canvasImgVehiculos.ctxVehiculo.clearRect(0, 0, canvasImgVehiculos.cwVehiculo, canvasImgVehiculos.chVehiculo);
    canvasImgVehiculos.Trazados.length = 0;
    canvasImgVehiculos.puntos.length = 0;
    canvasImgVehiculos.ctxVehiculo.drawImage(
        canvasImgVehiculos.image, 0, 0,
        canvasImgVehiculos.canvasVehiculo.width,
        canvasImgVehiculos.canvasVehiculo.height
    );
};

//limpiar canvas imagen + lineas
function limpiarTodoCanvasVehiculo() {
    canvasImgVehiculos.dibujar = false;
    canvasImgVehiculos.ctxVehiculo.clearRect(0, 0, canvasImgVehiculos.cwVehiculo, canvasImgVehiculos.chVehiculo);
    canvasImgVehiculos.canvasVehiculo.width = 1300;
    canvasImgVehiculos.canvasVehiculo.height = 700;
    canvasImgVehiculos.Trazados.length = 0;
    canvasImgVehiculos.puntos.length = 0;
    canvasImgVehiculos.curFile = null;
    canvasImgVehiculos.input.files = null;
    canvasImgVehiculos.input.value = null;
    canvasImgVehiculos.image.src = "";
}