var output = document.getElementById("output");
var imagen = document.getElementById("imagenBencina");
var canvasCombustible = document.getElementById("canvas-combustible");
var ctxCombustible = canvasCombustible.getContext("2d");



var cwCombustible = (canvasCombustible.width = 300),
    cxCombustible = cwCombustible / 2;
var chCombustible = (canvasCombustible.height = 300),
    cyCombustible = chCombustible / 2;
var rad = Math.PI / 180;
var R = 110,
    r = 6;
// r = ancho circulo
// R = largo linea

var handle = {
    x: cxCombustible + R,
    y: cyCombustible,
    r: 4,
};

var m = { x: 0, y: 0 };


output.style.top = handle.y - 50 + "px";
output.style.left = handle.x - 30 + "px";

var isDragging = false;
ctxCombustible.strokeStyle = "#cc0000";
ctxCombustible.fillStyle = "#e18728";


var eventsRyCombustible = [
    { event: "mousedown", func: onStart },
    { event: "touchstart", func: onStart },
    { event: "mousemove", func: onMove },
    { event: "touchmove", func: onMove },
    { event: "mouseup", func: onEnd },
    { event: "touchend", func: onEnd },
    { event: "mouseout", func: onEnd },
];




document.getElementById("imagenBencina").addEventListener("load", cargarImagen);
strokeCircle(cxCombustible, cyCombustible, R);
drawHandle(handle);
cargarfuncionesTouch();
drawHub();




function cargarfuncionesTouch() {
    for (var i = 0; i < eventsRyCombustible.length; i++) {
        (function(i) {
            var e = eventsRyCombustible[i].event;
            var f = eventsRyCombustible[i].func;
            canvasCombustible.addEventListener(e, f, false);
        })(i);
    }
}


function cargarImagen() {
    ctxCombustible.drawImage(
        imagen,
        0, -30,
        canvasCombustible.width,
        canvasCombustible.height
    );
};

function onStart(evt) {
    isDragging = true;
    updateHandle(evt);
}

function onMove(evt) {
    if (isDragging) {
        updateHandle(evt);
    }
}

function onEnd(evt) {
    isDragging = false;
}


function strokeCircle(x, y, r) {
    ctxCombustible.beginPath();
    ctxCombustible.arc(x, y, r, 0, 2 * Math.PI);
    ctxCombustible.stroke();
}

function fillCircle(x, y, r) {
    ctxCombustible.beginPath();
    ctxCombustible.arc(x, y, r, 0, 2 * Math.PI);

    ctxCombustible.save();
    ctxCombustible.strokeStyle = "#cc0000";
    ctxCombustible.lineWidth = 1;
    ctxCombustible.fill();
    ctxCombustible.stroke();
    ctxCombustible.restore();
}

function drawHub() {
    ctxCombustible.save();
    ctxCombustible.fillStyle = "black";
    ctxCombustible.beginPath();
    ctxCombustible.arc(cxCombustible, cyCombustible, 10, 0, 2 * Math.PI);
    ctxCombustible.fill();
    ctxCombustible.restore();
}

function oMousePos(canvas, evt) {
    var rect = canvas.getBoundingClientRect();
    var e = evt.touches ? evt.touches[0] : evt;
    return {
        x: Math.round(e.clientX - rect.left),
        y: Math.round(e.clientY - rect.top),
    };
}

function drawHandle(handle) {
    ctxCombustible.drawImage(
        imagen,
        0, -30,
        canvasCombustible.width,
        canvasCombustible.height
    );
    ctxCombustible.beginPath();
    //ancho linea
    ctxCombustible.lineWidth = 7;
    ctxCombustible.moveTo(cxCombustible, cyCombustible);
    ctxCombustible.lineTo(handle.x, handle.y);
    ctxCombustible.stroke();

    fillCircle(handle.x, handle.y, handle.r);
}

function updateHandle(evt) {
    var m = oMousePos(canvasCombustible, evt);
    var deltaX = m.x - cxCombustible;
    var deltaY = m.y - cyCombustible;
    handle.a = Math.atan2(deltaY, deltaX);
    handle.x = cxCombustible + R * Math.cos(handle.a);
    handle.y = cyCombustible + R * Math.sin(handle.a);
    ctxCombustible.clearRect(0, 0, cwCombustible, chCombustible);

    strokeCircle(cxCombustible, cyCombustible, R);
    drawHandle(handle);
    drawHub();
    output.innerHTML = parseInt(handle.a * (180 / Math.PI) + 150) + "E";
    output.style.top = handle.y - 50 + "px";
    output.style.left = handle.x - 30 + "px";
}