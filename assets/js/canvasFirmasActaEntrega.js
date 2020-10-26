var limpiar1 = document.getElementById("limpiar-firma1");
var limpiar2 = document.getElementById("limpiar-firma2");

var canvas1 = document.getElementById("canvas-firma1");
var canvas2 = document.getElementById("canvas-firma2");

var ctxFirma1 = canvas1.getContext("2d");
var ctxFirma2 = canvas2.getContext("2d");


var cwFirma1 = (canvas1.width = 300),
    cxFirma1 = cwFirma1 / 2;
var chFirma1 = (canvas1.height = 150),
    cyFirma1 = chFirma1 / 2;


var cwFirma2 = (canvas2.width = 300),
    cxFirma2 = cwFirma2 / 2;
var chFirma2 = (canvas2.height = 150),
    cyFirma2 = chFirma2 / 2;



var dibujarFirma1 = false;
var dibujarfirma2 = false;



var factorDeAlisamiento1 = 5;
var factorDeAlisamiento2 = 5;

var Trazados1 = [];
var Trazados2 = [];

var puntos1 = [];
var puntos2 = [];

ctxFirma1.lineJoin = "round";
ctxFirma2.lineJoin = "round";


var m1 = { x: 0, y: 0 };
var m2 = { x: 0, y: 0 };



limpiar1.addEventListener(
    "click",
    function(evt) {
        dibujarFirma1 = false;
        ctxFirma1.clearRect(0, 0, cwFirma1, chFirma1);
        Trazados1.length = 0;
        puntos1.length = 0;
    },
    false
);

limpiar2.addEventListener(
    "click",
    function(evt) {
        dibujarFirma2 = false;
        ctxFirma2.clearRect(0, 0, cwFirma2, chFirma2);
        Trazados2.length = 0;
        puntos2.length = 0;
    },
    false
);




var eventsRy1 = [{ event: "mousedown", func: "onStart1" },
    { event: "touchstart", func: "onStart1" },
    { event: "mousemove", func: "onMove1" },
    { event: "touchmove", func: "onMove1" },
    { event: "mouseup", func: "onEnd1" },
    { event: "touchend", func: "onEnd1" },
    { event: "mouseout", func: "onEnd1" }
];


var eventsRy2 = [{ event: "mousedown", func: "onStart2" },
    { event: "touchstart", func: "onStart2" },
    { event: "mousemove", func: "onMove2" },
    { event: "touchmove", func: "onMove2" },
    { event: "mouseup", func: "onEnd2" },
    { event: "touchend", func: "onEnd2" },
    { event: "mouseout", func: "onEnd2" }
];






function onStart1(evt) {
    m1 = oMousePos(canvas1, evt);
    puntos1.length = 0;
    ctxFirma1.beginPath();
    dibujarFirma1 = true;
}


function onStart2(evt) {
    m2 = oMousePos(canvas2, evt);
    puntos2.length = 0;
    ctxFirma2.beginPath();
    dibujarFirma2 = true;
}




function onMove1(evt) {
    if (dibujarFirma1) {
        ctxFirma1.moveTo(m1.x, m1.y);
        m1 = oMousePos(canvas1, evt);
        puntos1.push(m1)
        ctxFirma1.lineTo(m1.x, m1.y);
        ctxFirma1.stroke();
    }
}

function onMove2(evt) {
    if (dibujarFirma2) {
        ctxFirma2.moveTo(m2.x, m2.y);
        m2 = oMousePos(canvas2, evt);
        puntos2.push(m2)
        ctxFirma2.lineTo(m2.x, m2.y);
        ctxFirma2.stroke();
    }
}



function onEnd1(evt) {
    redibujarTrazados1();
    dibujarFirma1 = false;
}

function onEnd2(evt) {
    redibujarTrazados2();
    dibujarFirma2 = false;
}


for (var i = 0; i < eventsRy1.length; i++) {
    (function(i) {
        var e = eventsRy1[i].event;
        var f = eventsRy1[i].func;
        canvas1.addEventListener(e, function(evt) {
            evt.preventDefault();
            window[f](evt);
            return;
        }, false);
    })(i);
}


for (var i = 0; i < eventsRy2.length; i++) {
    (function(i) {
        var e = eventsRy2[i].event;
        var f = eventsRy2[i].func;
        canvas2.addEventListener(e, function(evt) {
            evt.preventDefault();
            window[f](evt);
            return;
        }, false);
    })(i);
}




function redibujarTrazados1() {
    dibujarFirma1 = false;
    ctxFirma1.clearRect(0, 0, cwFirma1, chFirma1);
    var nuevoArray = reducirArray(factorDeAlisamiento1, puntos1);
    Trazados1.push(nuevoArray);
    for (var i = 0; i < Trazados1.length; i++)
        alisarTrazado(Trazados1[i], ctxFirma1);
}

function redibujarTrazados2() {
    dibujarFirma2 = false;
    ctxFirma2.clearRect(0, 0, cwFirma2, chFirma2);
    var nuevoArray = reducirArray(factorDeAlisamiento2, puntos2);
    Trazados2.push(nuevoArray);
    for (var i = 0; i < Trazados2.length; i++)
        alisarTrazado(Trazados2[i], ctxFirma2);
}






function oMousePos(canvas, evt) {
    var ClientRect = canvas.getBoundingClientRect();
    var e = evt.touches ? evt.touches[0] : evt;

    return {
        x: Math.round(e.clientX - ClientRect.left),
        y: Math.round(e.clientY - ClientRect.top)
    };
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

    return nuevoArray;
}


function alisarTrazado(ry, ctx) {
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



function calcularPuntoDeControl(ry, a, b) {
    var pc = {}
    pc.x = (ry[a].x + ry[b].x) / 2;
    pc.y = (ry[a].y + ry[b].y) / 2;
    return pc;
}