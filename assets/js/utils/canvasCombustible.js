const canvasCombustible = {
        imagen: null,
        output: null,
        canvasCombustible: null,
        ctxCombustible: null,
        cwCombustible: null,
        cxCombustible: null,
        chCombustible: null,
        cyCombustible: null,
        rad: Math.PI / 180,
        R: 110,
        r: 6,
        handle: null,
        m: { x: 0, y: 0 },
        isDragging: false,
        eventsRyCombustible: [
            { event: "mousedown", func: onStart },
            { event: "touchstart", func: onStart },
            { event: "mousemove", func: onMove },
            { event: "touchmove", func: onMove },
            { event: "mouseup", func: onEnd },
            { event: "touchend", func: onEnd },
            { event: "mouseout", func: onEnd },
        ],
    }
    // r = ancho circulo
    // R = largo linea

function mostrarCanvasCombustible(id_canvas, id_output) {

    canvasCombustible.imagen = document.getElementById("imagenBencina");
    canvasCombustible.output = document.getElementById(id_output);
    canvasCombustible.canvasCombustible = document.getElementById(id_canvas);
    canvasCombustible.ctxCombustible = canvasCombustible.canvasCombustible.getContext("2d");
    canvasCombustible.cwCombustible = (canvasCombustible.canvasCombustible.width = 300);
    canvasCombustible.chCombustible = (canvasCombustible.canvasCombustible.height = 300);
    canvasCombustible.cxCombustible = canvasCombustible.cwCombustible / 2;
    canvasCombustible.cyCombustible = canvasCombustible.chCombustible / 2;
    canvasCombustible.handle = {
        x: canvasCombustible.cxCombustible + canvasCombustible.R,
        y: canvasCombustible.cyCombustible,
        r: 4,
    };
    canvasCombustible.output.style.top = canvasCombustible.handle.y - 50 + "px";
    canvasCombustible.output.style.left = canvasCombustible.handle.x - 30 + "px";
    canvasCombustible.ctxCombustible.strokeStyle = "#cc0000";
    canvasCombustible.ctxCombustible.fillStyle = "#e18728";

    canvasCombustible.imagen.addEventListener("load", cargarImagen);
    strokeCircle(canvasCombustible.cxCombustible, canvasCombustible.cyCombustible, canvasCombustible.R);
    drawHandle(canvasCombustible.handle);
    cargarfuncionesTouch();
    drawHub();
}



function cargarfuncionesTouch() {
    for (let i = 0; i < canvasCombustible.eventsRyCombustible.length; i++) {
        (function(i) {
            let e = canvasCombustible.eventsRyCombustible[i].event;
            let f = canvasCombustible.eventsRyCombustible[i].func;
            canvasCombustible.canvasCombustible.addEventListener(e, f, false);
        })(i);
    }
}

function cargarImagen() {
    canvasCombustible.ctxCombustible.drawImage(
        canvasCombustible.imagen,
        0, -30,
        canvasCombustible.canvasCombustible.width,
        canvasCombustible.canvasCombustible.height
    );
};

function onStart(evt) {
    evt.preventDefault();
    canvasCombustible.isDragging = true;
    updateHandle(evt);
}

function onMove(evt) {
    evt.preventDefault();
    if (canvasCombustible.isDragging) {
        updateHandle(evt);
    }
}

function onEnd(evt) {
    evt.preventDefault();
    canvasCombustible.isDragging = false;
}


function strokeCircle(x, y, r) {
    canvasCombustible.ctxCombustible.beginPath();
    canvasCombustible.ctxCombustible.arc(x, y, r, 0, 2 * Math.PI);
    canvasCombustible.ctxCombustible.stroke();
}

function fillCircle(x, y, r) {
    canvasCombustible.ctxCombustible.beginPath();
    canvasCombustible.ctxCombustible.arc(x, y, r, 0, 2 * Math.PI);

    canvasCombustible.ctxCombustible.save();
    canvasCombustible.ctxCombustible.strokeStyle = "#cc0000";
    canvasCombustible.ctxCombustible.lineWidth = 1;
    canvasCombustible.ctxCombustible.fill();
    canvasCombustible.ctxCombustible.stroke();
    canvasCombustible.ctxCombustible.restore();
}

function drawHub() {
    canvasCombustible.ctxCombustible.save();
    canvasCombustible.ctxCombustible.fillStyle = "black";
    canvasCombustible.ctxCombustible.beginPath();
    canvasCombustible.ctxCombustible.arc(canvasCombustible.cxCombustible, canvasCombustible.cyCombustible, 10, 0, 2 * Math.PI);
    canvasCombustible.ctxCombustible.fill();
    canvasCombustible.ctxCombustible.restore();
}

function oMousePos(canvas, evt) {
    let rect = canvas.getBoundingClientRect();
    let e = evt.touches ? evt.touches[0] : evt;
    return {
        x: Math.round(e.clientX - rect.left),
        y: Math.round(e.clientY - rect.top),
    };
}

function drawHandle(handle) {
    canvasCombustible.ctxCombustible.drawImage(
        canvasCombustible.imagen,
        0, -30,
        canvasCombustible.canvasCombustible.width,
        canvasCombustible.canvasCombustible.height
    );
    canvasCombustible.ctxCombustible.beginPath();
    //ancho linea
    canvasCombustible.ctxCombustible.lineWidth = 7;
    canvasCombustible.ctxCombustible.moveTo(canvasCombustible.cxCombustible, canvasCombustible.cyCombustible);
    canvasCombustible.ctxCombustible.lineTo(handle.x, handle.y);
    canvasCombustible.ctxCombustible.stroke();

    fillCircle(handle.x, handle.y, handle.r);
}

function updateHandle(evt) {
    let m = oMousePos(canvasCombustible.canvasCombustible, evt);
    let deltaX = m.x - canvasCombustible.cxCombustible;
    let deltaY = m.y - canvasCombustible.cyCombustible;
    canvasCombustible.handle.a = Math.atan2(deltaY, deltaX);
    canvasCombustible.handle.x = canvasCombustible.cxCombustible + canvasCombustible.R * Math.cos(canvasCombustible.handle.a);
    canvasCombustible.handle.y = canvasCombustible.cyCombustible + canvasCombustible.R * Math.sin(canvasCombustible.handle.a);
    canvasCombustible.ctxCombustible.clearRect(0, 0, canvasCombustible.cwCombustible, canvasCombustible.chCombustible);

    strokeCircle(canvasCombustible.cxCombustible, canvasCombustible.cyCombustible, canvasCombustible.R);
    drawHandle(canvasCombustible.handle);
    drawHub();
    canvasCombustible.output.innerHTML = parseInt(canvasCombustible.handle.a * (180 / Math.PI) + 150) + "E";
    canvasCombustible.output.style.top = canvasCombustible.handle.y - 50 + "px";
    canvasCombustible.output.style.left = canvasCombustible.handle.x - 30 + "px";
}