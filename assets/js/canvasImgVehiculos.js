var image = new Image();
var limpiar = document.getElementById("limpiar-fotoVehiculo");
var limpiarTodo = document.getElementById("seleccionarFoto");
var dibujarCanvas = document.getElementById("dibujarCanvas");

var canvasVehiculo = document.getElementById("canvas-fotoVehiculo");
var ctxVehiculo = canvasVehiculo.getContext("2d");
var input = document.getElementById("inputImagenVehiculo");
var curFile = input.files;
var source = "";

var cwVehiculo = (canvasVehiculo.width = 1000),
	cxVehiculo = cwVehiculo / 2;
var chVehiculo = (canvasVehiculo.height = 400),
	cyVehiculo = chVehiculo / 2;

//------------ colocar foto en el canvas -------------- //
input.addEventListener("change", updateImageDisplay);

function updateImageDisplay() {
	var curFile = input.files;
	dibujar = false;
	ctxVehiculo.clearRect(0, 0, cwVehiculo, chVehiculo);
	Trazados.length = 0;
	puntos.length = 0;
	var list = document.createElement("ol");
	var listItem = document.createElement("li");
	for (var i = 0; i < curFile.length; i++) {
		if (validFileType(curFile[i])) {
			source = curFile[i].name;
			image.src = window.URL.createObjectURL(curFile[i]);

			image.onload = function () {
				canvasVehiculo.width = this.width / 2;
				canvasVehiculo.height = this.height / 2;
				ctxVehiculo.drawImage(
					image,
					0,
					0,
					canvasVehiculo.width,
					canvasVehiculo.height
				);
				image.style.display = "none";
			};
			listItem.appendChild(image);
		}
		list.appendChild(listItem);
	}
}

var fileTypes = ["image/jpeg", "image/jpg", "image/png"];

function validFileType(file) {
	for (var i = 0; i < fileTypes.length; i++) {
		if (file.type === fileTypes[i]) return true;
	}

	return false;
}

//------------------ Dibujar en el canvas----------------- //

var dibujar = false;
var factorDeAlisamiento = 5;
var Trazados = [];
var puntos = [];
ctxVehiculo.lineJoin = "round";

var color = "black";
var grosor = 1;

function defcolor(c) {
	color = c;
}

function defgrosor(g) {
	grosor = g;
}
var mImgVehiculo = { x: 0, y: 0 };

var eventsRyImgVehiculo = [
	{ event: "mousedown", func: onStartVehiculo },
	{ event: "touchstart", func: onStartVehiculo },
	{ event: "mousemove", func: onMoveVehiculo },
	{ event: "touchmove", func: onMoveVehiculo },
	{ event: "mouseup", func: onEndVehiculo },
	{ event: "touchend", func: onEndVehiculo },
	{ event: "mouseout", func: onEndVehiculo },
];

dibujarCanvas.addEventListener("click", (e) => {
	//1 : checked , 0 : no checked
	const checked = $('[name="dibujarCanvas"]:checked').length;
	if (checked == 1) {
		ActivarEventosDibujar();
	} else {
		DesactivarEventosDibujar();
	}
});

function onStartVehiculo(evt) {
	evt.preventDefault();
	mImgVehiculo = oMousePosVehiculo(canvasVehiculo, evt);
	ctxVehiculo.beginPath();
	ctxVehiculo.strokeStyle = color;
	ctxVehiculo.lineWidth = grosor;
	dibujar = true;
}

function onMoveVehiculo(evt) {
	evt.preventDefault();
	if (dibujar) {
		ctxVehiculo.moveTo(mImgVehiculo.x, mImgVehiculo.y);
		mImgVehiculo = oMousePosVehiculo(canvasVehiculo, evt);
		ctxVehiculo.lineTo(mImgVehiculo.x, mImgVehiculo.y);
		ctxVehiculo.strokeStyle = color;
		ctxVehiculo.lineWidth = grosor;
		ctxVehiculo.stroke();
	}
}

function onEndVehiculo(evt) {
	evt.preventDefault();
	dibujar = false;
}

function oMousePosVehiculo(canvasVehiculo, evt) {
	var ClientRect = canvasVehiculo.getBoundingClientRect();
	var e = evt.touches ? evt.touches[0] : evt;

	return {
		x: Math.round(e.clientX - ClientRect.left),
		y: Math.round(e.clientY - ClientRect.top),
	};
}

function ActivarEventosDibujar() {
	for (var i = 0; i < eventsRyImgVehiculo.length; i++) {
		(function (i) {
			var e = eventsRyImgVehiculo[i].event;
			var f = eventsRyImgVehiculo[i].func;
			canvasVehiculo.addEventListener(e, f, false);
		})(i);
	}
}

function DesactivarEventosDibujar() {
	for (var i = 0; i < eventsRyImgVehiculo.length; i++) {
		(function (i) {
			var e = eventsRyImgVehiculo[i].event;
			var f = eventsRyImgVehiculo[i].func;
			canvasVehiculo.removeEventListener(e, f, false);
		})(i);
	}
}

//limpiar canvas imagen + lineas
function limpiarTodoCanvasVehiculo(evt) {
	dibujar = false;
	ctxVehiculo.clearRect(0, 0, cwVehiculo, chVehiculo);
	canvasVehiculo.width = 1000;
	canvasVehiculo.height = 400;
	Trazados.length = 0;
	puntos.length = 0;
	curFile = null;
	input.files = null;
	input.value = null;
	image.src = "";
}

// limpia canvas lineas
limpiar.addEventListener(
	"click",
	function (evt) {
		dibujar = false;
		ctxVehiculo.clearRect(0, 0, cwVehiculo, chVehiculo);
		Trazados.length = 0;
		puntos.length = 0;
		ctxVehiculo.drawImage(
			image,
			0,
			0,
			canvasVehiculo.width,
			canvasVehiculo.height
		);
	},
	false
);
