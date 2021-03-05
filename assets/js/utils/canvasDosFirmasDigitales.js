const canvasDosFirmas = {
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


function mostrarCanvasDosFirmas([id_canvas_firma1, id_canvas_firma2, id_limpiar1, id_limpiar2]) {

	canvasDosFirmas.canvas1 = document.getElementById(id_canvas_firma1);
	canvasDosFirmas.canvas2 = document.getElementById(id_canvas_firma2);
	canvasDosFirmas.ctxFirma1 = canvasDosFirmas.canvas1.getContext("2d");
	canvasDosFirmas.ctxFirma2 = canvasDosFirmas.canvas2.getContext("2d");
	canvasDosFirmas.ctxFirma1.lineJoin = "round";
	canvasDosFirmas.ctxFirma2.lineJoin = "round";
	canvasDosFirmas.cwFirma1 = (canvasDosFirmas.canvas1.width = 300)
	canvasDosFirmas.cxFirma1 = canvasDosFirmas.cwFirma1 / 2;
	canvasDosFirmas.chFirma1 = (canvasDosFirmas.canvas1.height = 150)
	canvasDosFirmas.cyFirma1 = canvasDosFirmas.chFirma1 / 2;
	canvasDosFirmas.cwFirma2 = (canvasDosFirmas.canvas2.width = 300)
	canvasDosFirmas.cxFirma2 = canvasDosFirmas.cwFirma2 / 2;
	canvasDosFirmas.chFirma2 = (canvasDosFirmas.canvas2.height = 150)
	canvasDosFirmas.cyFirma2 = canvasDosFirmas.chFirma2 / 2;
	document.getElementById(id_limpiar1).addEventListener("click", limpiarfirma1);
	document.getElementById(id_limpiar2).addEventListener("click", limpiarfirma2);

	cargarfuncionesTouchfirma1();
	cargarfuncionesTouchfirma2();
	limpiarFirmas();
}

function limpiarFirmas() {
	//se limpia los canvas de firma
	canvasDosFirmas.dibujarFirma1 = false;
	canvasDosFirmas.dibujarFirma2 = false;
	canvasDosFirmas.ctxFirma1.clearRect(0, 0, canvasDosFirmas.cwFirma1, canvasDosFirmas.chFirma1);
	canvasDosFirmas.ctxFirma2.clearRect(0, 0, canvasDosFirmas.cwFirma2, canvasDosFirmas.chFirma2);
	canvasDosFirmas.Trazados1.length = 0;
	canvasDosFirmas.Trazados2.length = 0;
	canvasDosFirmas.puntos1.length = 0;
	canvasDosFirmas.puntos2.length = 0;
}





function cargarfuncionesTouchfirma1() {
	for (let i = 0; i < canvasDosFirmas.eventsRy1.length; i++) {
		(function (i) {
			let e = canvasDosFirmas.eventsRy1[i].event;
			let f = canvasDosFirmas.eventsRy1[i].func;
			canvasDosFirmas.canvas1.addEventListener(e, f, false);
		})(i);
	}
}

function cargarfuncionesTouchfirma2() {
	for (let i = 0; i < canvasDosFirmas.eventsRy2.length; i++) {
		(function (i) {
			let e = canvasDosFirmas.eventsRy2[i].event;
			let f = canvasDosFirmas.eventsRy2[i].func;
			canvasDosFirmas.canvas2.addEventListener(e, f, false);
		})(i);
	}
}


function onStart1(evt) {
	evt.preventDefault();
	canvasDosFirmas.m1 = oMousePos(canvasDosFirmas.canvas1, evt);
	canvasDosFirmas.puntos1.length = 0;
	canvasDosFirmas.ctxFirma1.beginPath();
	canvasDosFirmas.dibujarFirma1 = true;
}

function onStart2(evt) {
	evt.preventDefault();
	canvasDosFirmas.m2 = oMousePos(canvasDosFirmas.canvas2, evt);
	canvasDosFirmas.puntos2.length = 0;
	canvasDosFirmas.ctxFirma2.beginPath();
	canvasDosFirmas.dibujarFirma2 = true;
}

function onMove1(evt) {
	evt.preventDefault();
	if (canvasDosFirmas.dibujarFirma1) {
		canvasDosFirmas.ctxFirma1.moveTo(canvasDosFirmas.m1.x, canvasDosFirmas.m1.y);
		canvasDosFirmas.m1 = oMousePos(canvasDosFirmas.canvas1, evt);
		canvasDosFirmas.puntos1.push(canvasDosFirmas.m1)
		canvasDosFirmas.ctxFirma1.lineTo(canvasDosFirmas.m1.x, canvasDosFirmas.m1.y);
		canvasDosFirmas.ctxFirma1.stroke();
	}
}

function onMove2(evt) {
	evt.preventDefault();
	if (canvasDosFirmas.dibujarFirma2) {
		canvasDosFirmas.ctxFirma2.moveTo(canvasDosFirmas.m2.x, canvasDosFirmas.m2.y);
		canvasDosFirmas.m2 = oMousePos(canvasDosFirmas.canvas2, evt);
		canvasDosFirmas.puntos2.push(canvasDosFirmas.m2)
		canvasDosFirmas.ctxFirma2.lineTo(canvasDosFirmas.m2.x, canvasDosFirmas.m2.y);
		canvasDosFirmas.ctxFirma2.stroke();
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
	canvasDosFirmas.dibujarFirma2 = false;
}


function redibujarTrazados1() {
	canvasDosFirmas.dibujarFirma1 = false;
	canvasDosFirmas.ctxFirma1.clearRect(0, 0, canvasDosFirmas.cwFirma1, canvasDosFirmas.chFirma1);
	let nuevoArray = reducirArray(canvasDosFirmas.factorDeAlisamiento1, canvasDosFirmas.puntos1);
	canvasDosFirmas.Trazados1.push(nuevoArray);
	for (let i = 0; i < canvasDosFirmas.Trazados1.length; i++)
		alisarTrazado(canvasDosFirmas.Trazados1[i], canvasDosFirmas.ctxFirma1);
}

function redibujarTrazados2() {
	canvasDosFirmas.dibujarFirma2 = false;
	canvasDosFirmas.ctxFirma2.clearRect(0, 0, canvasDosFirmas.cwFirma2, canvasDosFirmas.chFirma2);
	let nuevoArray = reducirArray(canvasDosFirmas.factorDeAlisamiento2, canvasDosFirmas.puntos2);
	canvasDosFirmas.Trazados2.push(nuevoArray);
	for (let i = 0; i < canvasDosFirmas.Trazados2.length; i++)
		alisarTrazado(canvasDosFirmas.Trazados2[i], canvasDosFirmas.ctxFirma2);
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
	canvasDosFirmas.dibujarFirma2 = false;
	canvasDosFirmas.ctxFirma2.clearRect(0, 0, canvasDosFirmas.cwFirma2, canvasDosFirmas.chFirma2);
	canvasDosFirmas.Trazados2.length = 0;
	canvasDosFirmas.puntos2.length = 0;
};

function limpiarfirma1(evt) {
	canvasDosFirmas.dibujarFirma1 = false;
	canvasDosFirmas.ctxFirma1.clearRect(0, 0, canvasDosFirmas.cwFirma1, canvasDosFirmas.chFirma1);
	canvasDosFirmas.Trazados1.length = 0;
	canvasDosFirmas.puntos1.length = 0;
};
