var canvas = document.getElementById("canvas-firma");
var ctx = canvas.getContext("2d");
var cw = (canvas.width = 300),
    cx = cw / 2;
var ch = (canvas.height = 150),
    cy = ch / 2;

var dibujar = false;
var factorDeAlisamiento = 5;
var puntos = [];
ctx.lineJoin = "round";

canvas.addEventListener(
    "mousedown",
    function(evt) {
        dibujar = true;
        ctx.clearRect(0, 0, cw, ch);
        puntos.length = 0;
        ctx.beginPath();
    },
    false
);

canvas.addEventListener(
    "mouseup",
    function(evt) {
        redibujarTrazado();
    },
    false
);

canvas.addEventListener(
    "mouseout",
    function(evt) {
        redibujarTrazado();
    },
    false
);

canvas.addEventListener(
    "mousemove",
    function(evt) {
        if (dibujar) {
            var m = oMousePos(canvas, evt);
            puntos.push(m);
            ctx.lineTo(m.x, m.y);
            ctx.stroke();
        }
    },
    false
);

function reducirArray(n, elArray) {
    var nuevoArray = [];
    nuevoArray[0] = elArray[0];
    for (var i = 1; i < elArray.length; i++) {
        if (i % n == 0) {
            nuevoArray[nuevoArray.length] = elArray[i];
        }
    }
    nuevoArray[nuevoArray.length - 1] = elArray[elArray.length - 1];
    return nuevoArray;
}

function calcularPuntoDeControl(a, b) {
    var pc = {};
    pc.x = (a.x + b.x) / 2;
    pc.y = (a.y + b.y) / 2;
    return pc;
}

function alisarTrazado(ry) {
    if (ry.length > 1) {
        var ultimoPunto = ry.length - 1;
        ctx.beginPath();
        ctx.moveTo(ry[0].x, ry[0].y);
        for (i = 1; i < ry.length - 2; i++) {
            var pc = calcularPuntoDeControl(ry[i], ry[i + 1]);
            ctx.quadraticCurveTo(ry[i].x, ry[i].y, pc.x, pc.y);
        }
        ctx.quadraticCurveTo(
            ry[ultimoPunto - 1].x,
            ry[ultimoPunto - 1].y,
            ry[ultimoPunto].x,
            ry[ultimoPunto].y
        );
        ctx.stroke();
    }
}

function redibujarTrazado() {
    dibujar = false;
    ctx.clearRect(0, 0, cw, ch);
    var nuevoArray = reducirArray(factorDeAlisamiento, puntos);
    alisarTrazado(nuevoArray);
}

function oMousePos(canvas, evt) {
    var ClientRect = canvas.getBoundingClientRect();
    return {
        //objeto
        x: Math.round(evt.clientX - ClientRect.left),
        y: Math.round(evt.clientY - ClientRect.top),
    };
}

$("#limpiar-firma").click(() => {
    canvas.width = canvas.width;
});