$(document).ready(() => {
	var base_route = $("#ruta").val();

	$(".btn_login").click(() => {
		var correo = $("#inputEmail").val();
		var clave = $("#inputclave").val();

		if (correo.length != 0 || clave.length != 0) {
			$.ajax({
				url: base_route + "iniciarSesion",
				type: "post",
				datatype: "json",
				data: {
					correo,
					clave,
				},
				success: (e) => {
					var response = JSON.parse(e);

					if (response.success) {
						irPlataforma(response.usuario);
					} else {
						Swal.fire({
							icon: "error",
							title: "inicio de Sesion",
							text: response.msg,
						});
						$("#inputclave").val("");
					}
				},
				error: () => {
					Swal.fire({
						icon: "error",
						title: "Oops...",
						text: "A ocurrido un Error Contacte a informatica",
					});
				},
			});
		}
	});

	function irPlataforma(usuario) {
		$.ajax({
			url: base_route + "irPlataforma",
			type: "post",
			datatype: "json",
			data: {
				nombre_usuario: usuario.nombre_usuario,
				email_usuario: usuario.email_usuario,
				estado_usuario: usuario.estado_usuario,
				id_rol: usuario.id_rol,
				id_usuario: usuario.id_usuario,
				userToken: usuario.userToken,
			},
			success: (e) => {
				var response = JSON.parse(e);
				if (response.msg == "OK") {
					window.location.href = base_route + "cargarPanel?panel=1";
				} else {
					Swal.fire({
						icon: "error",
						title: "Oops...",
						text: "A ocurrido un Error Contacte a informatica",
					});
				}
			},
			error: () => {
				Swal.fire({
					icon: "error",
					title: "Oops...",
					text: "A ocurrido un Error Contacte a informatica",
				});
			},
		});
	}
});
