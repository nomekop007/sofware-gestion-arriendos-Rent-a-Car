const canvasFirma = {
    canvas: null,
    ctx: null,
    cw: null,
    cx: null,
    ch: null,
    cy: null,
    dibujar: false,
    factorDeAlisamiento: 5,
    Trazados: [],
    puntos: [],
    m: { x: 0, y: 0 },
    eventsRy: [{ event: "mousedown", func: onStart },
        { event: "touchstart", func: onStart },
        { event: "mousemove", func: onMove },
        { event: "touchmove", func: onMove },
        { event: "mouseup", func: onEnd },
        { event: "touchend", func: onEnd },
        { event: "mouseout", func: onEnd }
    ],
}

function mostrarCanvasFirma(id_canvas, id_limpiar) {
    canvasFirma.canvas = document.getElementById(id_canvas);
    canvasFirma.ctx = canvasFirma.canvas.getContext("2d");
    canvasFirma.ctx.lineJoin = "round";
    canvasFirma.cw = (canvasFirma.canvas.width = 300);
    canvasFirma.cx = canvasFirma.cw / 2;
    canvasFirma.ch = (canvasFirma.canvas.height = 150)
    canvasFirma.cy = canvasFirma.ch / 2;
    document.getElementById(id_limpiar).addEventListener("click", limpiarCanvasFirma);
    cargarfuncionesTouchCanvasFirma();
    limpiarCanvasFirma();

}

function cargarfuncionesTouchCanvasFirma() {
    for (let i = 0; i < canvasFirma.eventsRy.length; i++) {
        (function(i) {
            let e = canvasFirma.eventsRy[i].event;
            let f = canvasFirma.eventsRy[i].func;
            canvasFirma.canvas.addEventListener(e, f, false);
        })(i);
    }
}

function limpiarCanvasFirma(evt) {
    canvasFirma.dibujar = false;
    canvasFirma.ctx.clearRect(0, 0, canvasFirma.cw, canvasFirma.ch);
    canvasFirma.Trazados.length = 0;
    canvasFirma.puntos.length = 0;
};

function onStart(evt) {
    evt.preventDefault();
    canvasFirma.m = oMousePos(canvasFirma.canvas, evt);
    canvasFirma.puntos.length = 0;
    canvasFirma.ctx.beginPath();
    canvasFirma.dibujar = true;
}

function onMove(evt) {
    evt.preventDefault();
    if (canvasFirma.dibujar) {
        canvasFirma.ctx.moveTo(canvasFirma.m.x, canvasFirma.m.y);
        canvasFirma.m = oMousePos(canvasFirma.canvas, evt);
        canvasFirma.puntos.push(canvasFirma.m)
        canvasFirma.ctx.lineTo(canvasFirma.m.x, canvasFirma.m.y);
        canvasFirma.ctx.stroke();
    }
}

function onEnd(evt) {
    evt.preventDefault();
    redibujarTrazados();
    canvasFirma.dibujar = false;

}

function oMousePos(canvas, evt) {
    evt.preventDefault();
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
    canvasFirma.Trazados.push(nuevoArray);
}

function calcularPuntoDeControl(ry, a, b) {
    let pc = {}
    pc.x = (ry[a].x + ry[b].x) / 2;
    pc.y = (ry[a].y + ry[b].y) / 2;
    return pc;
}

function alisarTrazado(ry) {
    if (ry.length > 1) {
        let ultimoPunto = ry.length - 1;
        canvasFirma.ctx.beginPath();
        canvasFirma.ctx.moveTo(ry[0].x, ry[0].y);
        for (i = 1; i < ry.length - 2; i++) {
            let pc = calcularPuntoDeControl(ry, i, i + 1);
            canvasFirma.ctx.quadraticCurveTo(ry[i].x, ry[i].y, pc.x, pc.y);
        }
        canvasFirma.ctx.quadraticCurveTo(ry[ultimoPunto - 1].x, ry[ultimoPunto - 1].y, ry[ultimoPunto].x, ry[ultimoPunto].y);
        canvasFirma.ctx.stroke();
    }
}


function redibujarTrazados() {
    canvasFirma.dibujar = false;
    canvasFirma.ctx.clearRect(0, 0, canvasFirma.cw, canvasFirma.ch);
    reducirArray(canvasFirma.factorDeAlisamiento, canvasFirma.puntos);
    for (let i = 0; i < canvasFirma.Trazados.length; i++) {
        alisarTrazado(canvasFirma.Trazados[i]);
    }
}