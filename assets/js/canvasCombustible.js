var output = document.getElementById("output");

var canvasCombustible = document.getElementById("canvas-combustible");
var ctxCombustible = canvasCombustible.getContext("2d");


var cwCombustible = canvasCombustible.width = 290,
    cxCombustible = cwCombustible / 2;
var chCombustible = canvasCombustible.height = 290,
    cyCombustible = chCombustible / 2;
var rad = Math.PI / 180;
var R = 110,
    r = 7;

var handle = {
    x: cxCombustible + R,
    y: cyCombustible,
    r: 7
}


var imagen = new Image();
imagen.src = "assets/images/indicadorBencina.jpg";

imagen.addEventListener("load", function() {
    ctxCombustible.drawImage(imagen, 0, -30, canvasCombustible.width, canvasCombustible.height);
}, false)




output.style.top = (handle.y - 50) + "px";
output.style.left = (handle.x - 30) + "px";

var isDragging = false;
ctxCombustible.strokeStyle = "#555";
ctxCombustible.fillStyle = "#e18728";


strokeCircle(cxCombustible, cyCombustible, R);
drawHandle(handle);
drawHub()

// Events ***************************

canvasCombustible.addEventListener('mousedown', function(evt) {

    isDragging = true;
    updateHandle(evt);

}, false);

// mousemove 
canvasCombustible.addEventListener('mousemove', function(evt) {

    if (isDragging) {

        updateHandle(evt);

    }
}, false);
// mouseup 
canvasCombustible.addEventListener('mouseup', function() {

    isDragging = false;
}, false);
// mouseout 
canvasCombustible.addEventListener('mouseout', function(evt) {

    isDragging = false;
}, false); /**/

// Helpers ***************************
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
    ctxCombustible.restore()
}

function drawHub() {
    ctxCombustible.save()
    ctxCombustible.fillStyle = "black";
    ctxCombustible.beginPath();
    ctxCombustible.arc(cxCombustible, cyCombustible, 10, 0, 2 * Math.PI);
    ctxCombustible.fill();
    ctxCombustible.restore();
}

function oMousePos(canvas, evt) {
    var rect = canvas.getBoundingClientRect();
    return {
        x: Math.round(evt.clientX - rect.left),
        y: Math.round(evt.clientY - rect.top)
    };
}

function drawHandle(handle) {
    ctxCombustible.drawImage(imagen, 0, -30, canvasCombustible.width, canvasCombustible.height);
    ctxCombustible.beginPath();
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
    drawHub()

    output.innerHTML = parseInt(handle.a * (180 / Math.PI) + 150) + "E";
    output.style.top = (handle.y - 50) + "px";
    output.style.left = (handle.x - 30) + "px";
}