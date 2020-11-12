const canvasFirmasActa = {
    canvas1: null,
    canvas2: null,
    ctxFirma1: null,
    ctxFirma2: null,
    cwFirma1: null,
    cxFirma1: null,
    chFirma1: null,
    cyFirma1: null,
    cwFirma2: null,
    cxFirma2: null,
    chFirma2: null,
    cyFirma2: null,
    dibujarFirma1: false,
    dibujarfirma2: false,
    factorDeAlisamiento1: 5,
    factorDeAlisamiento2: 5,
    Trazados1: [],
    Trazados2: [],
    puntos1: [],
    puntos2: [],
    m1: { x: 0, y: 0 },
    m2: { x: 0, y: 0 },
    eventsRy1: [{ event: "mousedown", func: onStart1 },
        { event: "touchstart", func: onStart1 },
        { event: "mousemove", func: onMove1 },
        { event: "touchmove", func: onMove1 },
        { event: "mouseup", func: onEnd1 },
        { event: "touchend", func: onEnd1 },
        { event: "mouseout", func: onEnd1 }
    ],
    eventsRy2: [{ event: "mousedown", func: onStart2 },
        { event: "touchstart", func: onStart2 },
        { event: "mousemove", func: onMove2 },
        { event: "touchmove", func: onMove2 },
        { event: "mouseup", func: onEnd2 },
        { event: "touchend", func: onEnd2 },
        { event: "mouseout", func: onEnd2 }
    ],
}


function mostrarCanvasFirmasActaEntrega([id_canvas_firma1, id_canvas_firma2, id_limpiar1, id_limpiar2]) {

    canvasFirmasActa.canvas1 = document.getElementById(id_canvas_firma1);
    canvasFirmasActa.canvas2 = document.getElementById(id_canvas_firma2);
    canvasFirmasActa.ctxFirma1 = canvasFirmasActa.canvas1.getContext("2d");
    canvasFirmasActa.ctxFirma2 = canvasFirmasActa.canvas2.getContext("2d");
    canvasFirmasActa.ctxFirma1.lineJoin = "round";
    canvasFirmasActa.ctxFirma2.lineJoin = "round";
    canvasFirmasActa.cwFirma1 = (canvasFirmasActa.canvas1.width = 300)
    canvasFirmasActa.cxFirma1 = canvasFirmasActa.cwFirma1 / 2;
    canvasFirmasActa.chFirma1 = (canvasFirmasActa.canvas1.height = 150)
    canvasFirmasActa.cyFirma1 = canvasFirmasActa.chFirma1 / 2;
    canvasFirmasActa.cwFirma2 = (canvasFirmasActa.canvas2.width = 300)
    canvasFirmasActa.cxFirma2 = canvasFirmasActa.cwFirma2 / 2;
    canvasFirmasActa.chFirma2 = (canvasFirmasActa.canvas2.height = 150)
    canvasFirmasActa.cyFirma2 = canvasFirmasActa.chFirma2 / 2;
    document.getElementById(id_limpiar1).addEventListener("click", limpiarfirma1);
    document.getElementById(id_limpiar2).addEventListener("click", limpiarfirma2);

    cargarfuncionesTouchfirma1();
    cargarfuncionesTouchfirma2();
    limpiarFirmas();
}

function limpiarFirmas() {
    //se limpia los canvas de firma
    canvasFirmasActa.dibujarFirma1 = false;
    canvasFirmasActa.dibujarFirma2 = false;
    canvasFirmasActa.ctxFirma1.clearRect(0, 0, canvasFirmasActa.cwFirma1, canvasFirmasActa.chFirma1);
    canvasFirmasActa.ctxFirma2.clearRect(0, 0, canvasFirmasActa.cwFirma2, canvasFirmasActa.chFirma2);
    canvasFirmasActa.Trazados1.length = 0;
    canvasFirmasActa.Trazados2.length = 0;
    canvasFirmasActa.puntos1.length = 0;
    canvasFirmasActa.puntos2.length = 0;
}





function cargarfuncionesTouchfirma1() {
    for (let i = 0; i < canvasFirmasActa.eventsRy1.length; i++) {
        (function(i) {
            let e = canvasFirmasActa.eventsRy1[i].event;
            let f = canvasFirmasActa.eventsRy1[i].func;
            canvasFirmasActa.canvas1.addEventListener(e, f, false);
        })(i);
    }
}

function cargarfuncionesTouchfirma2() {
    for (let i = 0; i < canvasFirmasActa.eventsRy2.length; i++) {
        (function(i) {
            let e = canvasFirmasActa.eventsRy2[i].event;
            let f = canvasFirmasActa.eventsRy2[i].func;
            canvasFirmasActa.canvas2.addEventListener(e, f, false);
        })(i);
    }
}


function onStart1(evt) {
    evt.preventDefault();
    canvasFirmasActa.m1 = oMousePos(canvasFirmasActa.canvas1, evt);
    canvasFirmasActa.puntos1.length = 0;
    canvasFirmasActa.ctxFirma1.beginPath();
    canvasFirmasActa.dibujarFirma1 = true;
}

function onStart2(evt) {
    evt.preventDefault();
    canvasFirmasActa.m2 = oMousePos(canvasFirmasActa.canvas2, evt);
    canvasFirmasActa.puntos2.length = 0;
    canvasFirmasActa.ctxFirma2.beginPath();
    canvasFirmasActa.dibujarFirma2 = true;
}

function onMove1(evt) {
    evt.preventDefault();
    if (canvasFirmasActa.dibujarFirma1) {
        canvasFirmasActa.ctxFirma1.moveTo(canvasFirmasActa.m1.x, canvasFirmasActa.m1.y);
        canvasFirmasActa.m1 = oMousePos(canvasFirmasActa.canvas1, evt);
        canvasFirmasActa.puntos1.push(canvasFirmasActa.m1)
        canvasFirmasActa.ctxFirma1.lineTo(canvasFirmasActa.m1.x, canvasFirmasActa.m1.y);
        canvasFirmasActa.ctxFirma1.stroke();
    }
}

function onMove2(evt) {
    evt.preventDefault();
    if (canvasFirmasActa.dibujarFirma2) {
        canvasFirmasActa.ctxFirma2.moveTo(canvasFirmasActa.m2.x, canvasFirmasActa.m2.y);
        canvasFirmasActa.m2 = oMousePos(canvasFirmasActa.canvas2, evt);
        canvasFirmasActa.puntos2.push(canvasFirmasActa.m2)
        canvasFirmasActa.ctxFirma2.lineTo(canvasFirmasActa.m2.x, canvasFirmasActa.m2.y);
        canvasFirmasActa.ctxFirma2.stroke();
    }
}

function onEnd1(evt) {
    evt.preventDefault();
    redibujarTrazados1();
    dibujarFirma1 = false;
}

function onEnd2(evt) {
    evt.preventDefault();
    redibujarTrazados2();
    canvasFirmasActa.dibujarFirma2 = false;
}


function redibujarTrazados1() {
    canvasFirmasActa.dibujarFirma1 = false;
    canvasFirmasActa.ctxFirma1.clearRect(0, 0, canvasFirmasActa.cwFirma1, canvasFirmasActa.chFirma1);
    let nuevoArray = reducirArray(canvasFirmasActa.factorDeAlisamiento1, canvasFirmasActa.puntos1);
    canvasFirmasActa.Trazados1.push(nuevoArray);
    for (let i = 0; i < canvasFirmasActa.Trazados1.length; i++)
        alisarTrazado(canvasFirmasActa.Trazados1[i], canvasFirmasActa.ctxFirma1);
}

function redibujarTrazados2() {
    canvasFirmasActa.dibujarFirma2 = false;
    canvasFirmasActa.ctxFirma2.clearRect(0, 0, canvasFirmasActa.cwFirma2, canvasFirmasActa.chFirma2);
    let nuevoArray = reducirArray(canvasFirmasActa.factorDeAlisamiento2, canvasFirmasActa.puntos2);
    canvasFirmasActa.Trazados2.push(nuevoArray);
    for (let i = 0; i < canvasFirmasActa.Trazados2.length; i++)
        alisarTrazado(canvasFirmasActa.Trazados2[i], canvasFirmasActa.ctxFirma2);
}


function oMousePos(canvas, evt) {
    let ClientRect = canvas.getBoundingClientRect();
    let e = evt.touches ? evt.touches[0] : evt;

    return {
        x: Math.round(e.clientX - ClientRect.left),
        y: Math.round(e.clientY - ClientRect.top)
    };
}

function reducirArray(n, elArray) {

    let nuevoArray = [];
    nuevoArray[0] = elArray[0];
    for (let i = 0; i < elArray.length; i++) {
        if (i % n == 0) {
            nuevoArray[nuevoArray.length] = elArray[i];
        }
    }
    nuevoArray[nuevoArray.length - 1] = elArray[elArray.length - 1];

    return nuevoArray;
}

function alisarTrazado(ry, ctx) {
    if (ry.length > 1) {
        let ultimoPunto = ry.length - 1;
        ctx.beginPath();
        ctx.moveTo(ry[0].x, ry[0].y);
        for (i = 1; i < ry.length - 2; i++) {
            let pc = calcularPuntoDeControl(ry, i, i + 1);
            ctx.quadraticCurveTo(ry[i].x, ry[i].y, pc.x, pc.y);
        }
        ctx.quadraticCurveTo(ry[ultimoPunto - 1].x, ry[ultimoPunto - 1].y, ry[ultimoPunto].x, ry[ultimoPunto].y);
        ctx.stroke();
    }
}

function calcularPuntoDeControl(ry, a, b) {
    let pc = {}
    pc.x = (ry[a].x + ry[b].x) / 2;
    pc.y = (ry[a].y + ry[b].y) / 2;
    return pc;
}

function limpiarfirma2(evt) {
    canvasFirmasActa.dibujarFirma2 = false;
    canvasFirmasActa.ctxFirma2.clearRect(0, 0, canvasFirmasActa.cwFirma2, canvasFirmasActa.chFirma2);
    canvasFirmasActa.Trazados2.length = 0;
    canvasFirmasActa.puntos2.length = 0;
};

function limpiarfirma1(evt) {
    canvasFirmasActa.dibujarFirma1 = false;
    canvasFirmasActa.ctxFirma1.clearRect(0, 0, canvasFirmasActa.cwFirma1, canvasFirmasActa.chFirma1);
    canvasFirmasActa.Trazados1.length = 0;
    canvasFirmasActa.puntos1.length = 0;
};