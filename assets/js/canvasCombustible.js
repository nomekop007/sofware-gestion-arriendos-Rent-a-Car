var output = document.getElementById("output");

var c = document.getElementById("canvas-combustible");
var ctx = c.getContext("2d");

var cw = c.width = 280,
    cx = cw / 2;
var ch = c.height = 280,
    cy = ch / 2;
var rad = Math.PI / 180;
var R = 110,
    r = 7;

var handle = {
    x: cx + R,
    y: cy,
    r: 7
}


var imagen = new Image();
imagen.src = "assets/images/indicadorBencina.jpg";

imagen.addEventListener("load", function() {
    ctx.drawImage(imagen, 0, -30, c.width, c.height);
}, false)




output.style.top = (handle.y - 50) + "px";
output.style.left = (handle.x - 30) + "px";

var isDragging = false;
ctx.strokeStyle = "#555";
ctx.fillStyle = "#e18728";


strokeCircle(cx, cy, R);
drawHandle(handle);
drawHub()

// Events ***************************

c.addEventListener('mousedown', function(evt) {

    isDragging = true;
    updateHandle(evt);

}, false);

// mousemove 
c.addEventListener('mousemove', function(evt) {

    if (isDragging) {

        updateHandle(evt);

    }
}, false);
// mouseup 
c.addEventListener('mouseup', function() {

    isDragging = false;
}, false);
// mouseout 
c.addEventListener('mouseout', function(evt) {

    isDragging = false;
}, false); /**/

// Helpers ***************************
function strokeCircle(x, y, r) {
    ctx.beginPath();
    ctx.arc(x, y, r, 0, 2 * Math.PI);
    ctx.stroke();
}

function fillCircle(x, y, r) {
    ctx.beginPath();
    ctx.arc(x, y, r, 0, 2 * Math.PI);

    ctx.save();
    ctx.strokeStyle = "#cc0000";
    ctx.lineWidth = 1;
    ctx.fill();
    ctx.stroke();
    ctx.restore()
}

function drawHub() {
    ctx.save()
    ctx.fillStyle = "black";
    ctx.beginPath();
    ctx.arc(cx, cy, 10, 0, 2 * Math.PI);
    ctx.fill();
    ctx.restore();
}

function oMousePos(canvas, evt) {
    var rect = canvas.getBoundingClientRect();
    return {
        x: Math.round(evt.clientX - rect.left),
        y: Math.round(evt.clientY - rect.top)
    };
}

function drawHandle(handle) {
    ctx.drawImage(imagen, 0, -30, c.width, c.height);
    ctx.beginPath();
    ctx.moveTo(cx, cy);
    ctx.lineTo(handle.x, handle.y);
    ctx.stroke();

    fillCircle(handle.x, handle.y, handle.r);

}

function updateHandle(evt) {
    var m = oMousePos(c, evt);
    var deltaX = m.x - cx;
    var deltaY = m.y - cy;
    handle.a = Math.atan2(deltaY, deltaX);
    handle.x = cx + R * Math.cos(handle.a);
    handle.y = cy + R * Math.sin(handle.a);
    ctx.clearRect(0, 0, cw, ch);

    strokeCircle(cx, cy, R);
    drawHandle(handle);
    drawHub()

    output.innerHTML = parseInt(handle.a * (180 / Math.PI) + 150) + "E";
    output.style.top = (handle.y - 50) + "px";
    output.style.left = (handle.x - 30) + "px";
}