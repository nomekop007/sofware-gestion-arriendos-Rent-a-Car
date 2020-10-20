var limpiar = document.getElementById("limpiar-firma");
var canvas = document.getElementById("canvas-firma");
var ctx = canvas.getContext("2d");
var cw = (canvas.width = 300),
    cx = cw / 2;
var ch = (canvas.height = 150),
    cy = ch / 2;




var dibujar = false;
var factorDeAlisamiento = 5;
var Trazados = [];
var puntos = [];
ctx.lineJoin = "round";


limpiar.addEventListener(
    "click",
    function(evt) {
        dibujar = false;
        ctx.clearRect(0, 0, cw, ch);
        Trazados.length = 0;
        puntos.length = 0;
    },
    false
);


var m = { x: 0, y: 0 };

var eventsRy = [{ event: "mousedown", func: "onStart" },
    { event: "touchstart", func: "onStart" },
    { event: "mousemove", func: "onMove" },
    { event: "touchmove", func: "onMove" },
    { event: "mouseup", func: "onEnd" },
    { event: "touchend", func: "onEnd" },
    { event: "mouseout", func: "onEnd" }
];

function onStart(evt) {
    m = oMousePos(canvas, evt);
    puntos.length = 0;
    ctx.beginPath();
    dibujar = true;



}

function onMove(evt) {
    if (dibujar) {
        ctx.moveTo(m.x, m.y);
        m = oMousePos(canvas, evt);
        puntos.push(m)
        ctx.lineTo(m.x, m.y);
        ctx.stroke();
    }
}


function onEnd(evt) {
    redibujarTrazados();
    dibujar = false;

}

function oMousePos(canvas, evt) {
    var ClientRect = canvas.getBoundingClientRect();
    var e = evt.touches ? evt.touches[0] : evt;

    return {
        x: Math.round(e.clientX - ClientRect.left),
        y: Math.round(e.clientY - ClientRect.top)
    };
}

for (var i = 0; i < eventsRy.length; i++) {
    (function(i) {
        var e = eventsRy[i].event;
        var f = eventsRy[i].func;
        canvas.addEventListener(e, function(evt) {
            evt.preventDefault();
            window[f](evt);
            return;
        }, false);
    })(i);
}


function reducirArray(n, elArray) {
    var nuevoArray = [];
    nuevoArray[0] = elArray[0];
    for (var i = 0; i < elArray.length; i++) {
        if (i % n == 0) {
            nuevoArray[nuevoArray.length] = elArray[i];
        }
    }
    nuevoArray[nuevoArray.length - 1] = elArray[elArray.length - 1];
    Trazados.push(nuevoArray);
}

function calcularPuntoDeControl(ry, a, b) {
    var pc = {}
    pc.x = (ry[a].x + ry[b].x) / 2;
    pc.y = (ry[a].y + ry[b].y) / 2;
    return pc;
}

function alisarTrazado(ry) {
    if (ry.length > 1) {
        var ultimoPunto = ry.length - 1;
        ctx.beginPath();
        ctx.moveTo(ry[0].x, ry[0].y);
        for (i = 1; i < ry.length - 2; i++) {
            var pc = calcularPuntoDeControl(ry, i, i + 1);
            ctx.quadraticCurveTo(ry[i].x, ry[i].y, pc.x, pc.y);
        }
        ctx.quadraticCurveTo(ry[ultimoPunto - 1].x, ry[ultimoPunto - 1].y, ry[ultimoPunto].x, ry[ultimoPunto].y);
        ctx.stroke();
    }
}


function redibujarTrazados() {
    dibujar = false;
    ctx.clearRect(0, 0, cw, ch);
    reducirArray(factorDeAlisamiento, puntos);
    for (var i = 0; i < Trazados.length; i++)
        alisarTrazado(Trazados[i]);
}