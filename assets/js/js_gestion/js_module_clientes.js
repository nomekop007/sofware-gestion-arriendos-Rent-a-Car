$("#m_cliente").addClass("active");
$("#l_cliente").addClass("card");

const buscarCliente = async(rut_cliente) => {
    limpiarCampos();
    const data = new FormData();
    data.append("rut_cliente", rut_cliente);
    const response = await ajax_function(data, "buscar_cliente");
    if (response.success) {
        const cliente = response.data;
        $("#form_header").text("Cliente particular");
        $("#inputNombreCliente").val(cliente.nombre_cliente);
        $("#inputRutCliente").val(cliente.rut_cliente);
        $("#inputEstadoCivilCliente").val(cliente.estadoCivil_cliente);
        $("#inputNacimientoCliente").val(
            cliente.fechaNacimiento_cliente ?
            formatearFecha(cliente.fechaNacimiento_cliente) :
            ""
        );
        $("#inputCorreoCliente").val(cliente.correo_cliente);
        $("#inputCiudadCliente").val(cliente.ciudad_cliente);
        $("#inputDireccionCliente").val(cliente.direccion_cliente);
        $("#inputTelefonoCliente").val("+569 " + cliente.telefono_cliente);
        $("#inputCreateAtCliente").val(formatearFechaHora(cliente.createdAt));
        $("#form_cliente").show();
    }
    $("#spinner_cliente").hide();
};

const buscarEmpresa = async(rut_empresa) => {
    limpiarCampos();
    const data = new FormData();
    data.append("rut_empresa", rut_empresa);
    const response = await ajax_function(data, "buscar_empresa");
    if (response.success) {
        const empresa = response.data;
        $("#form_header").text("Cliente Empresa");
        $("#inputCiudadEmpresa").val(empresa.ciudad_empresa);
        $("#inputCorreoEmpresa").val(empresa.correo_empresa);
        $("#inputCreateAtEmpresa").val(formatearFechaHora(empresa.createdAt));
        $("#inputDireccionEmpresa").val(empresa.direccion_empresa);
        $("#inputNombreEmpresa").val(empresa.nombre_empresa);
        $("#inputRolEmpresa").val(empresa.rol_empresa);
        $("#inputRutEmpresa").val(empresa.rut_empresa);
        $("#inputTelefonoEmpresa").val("+569 " + empresa.telefono_empresa);
        $("#inputVigenciaEmpresa").val(empresa.vigencia_empresa);
        $("#form_empresa").show();
    }
    $("#spinner_cliente").hide();
};

const buscarConductor = async(rut_conductor) => {
    limpiarCampos();
    const data = new FormData();
    data.append("rut_conductor", rut_conductor);
    const response = await ajax_function(data, "buscar_conductor");
    if (response.success) {
        const conductor = response.data;
        $("#form_header").text("Conductor");
        $("#inputClaseConductor").val(conductor.clase_conductor);
        $("#inputCreateAtConductor").val(formatearFechaHora(conductor.createdAt));
        $("#inputDireccionConductor").val(conductor.direccion_conductor);
        $("#inputMunicipalidadConductor").val(conductor.municipalidad_conductor);
        $("#inputNombreConductor").val(conductor.nombre_conductor);
        $("#inputNumeroConductor").val(conductor.numero_conductor);
        $("#inputRutConductor").val(conductor.rut_conductor);
        $("#inputTelefonoConductor").val("+569 " + conductor.telefono_conductor);
        $("#inputVCTOconductor").val(
            conductor.vcto_conductor ? formatearFecha(conductor.vcto_conductor) : ""
        );
        $("#form_conductor").show();
    }
    $("#spinner_cliente").hide();
};

const limpiarCampos = () => {
    $("#form_cliente").hide();
    $("#form_empresa").hide();
    $("#form_conductor").hide();
    $("#spinner_cliente").show();
    $("#form_header").text("");

    $("#inputNombreCliente").val("");
    $("#inputRutCliente").val("");
    $("#inputEstadoCivilCliente").val("");
    $("#inputNacimientoCliente").val("");
    $("#inputCorreoCliente").val("");
    $("#inputCiudadCliente").val("");
    $("#inputDireccionCliente").val("");
    $("#inputTelefonoCliente").val("");
    $("#inputCreateAtCliente").val("");

    $("#inputCiudadEmpresa").val("");
    $("#inputCorreoEmpresa").val("");
    $("#inputCreateAtEmpresa").val("");
    $("#inputDireccionEmpresa").val("");
    $("#inputNombreEmpresa").val("");
    $("#inputRolEmpresa").val("");
    $("#inputRutEmpresa").val("");
    $("#inputTelefonoEmpresa").val("");
    $("#inputVigenciaEmpresa").val("");

    $("#inputClaseConductor").val("");
    $("#inputCreateAtConductor").val("");
    $("#inputDireccionConductor").val("");
    $("#inputMunicipalidadConductor").val("");
    $("#inputNombreConductor").val("");
    $("#inputNumeroConductor").val("");
    $("#inputRutConductor").val("");
    $("#inputTelefonoConductor").val("");
    $("#inputVCTOconductor").val("");
};

//----------------------------------------------- DENTRO DEL DOCUMENT.READY ------------------------------------//

$(document).ready(() => {
    //se inician los datatable
    const tablaCliente = $("#tablaClientes").DataTable(lenguaje);
    const tablaEmpresa = $("#tablaEmpresas").DataTable(lenguaje);
    const tablaConductor = $("#tablaConductores").DataTable(lenguaje);

    const btnCliente = document.getElementById("nav-clientes-tab");
    const btnEmpresas = document.getElementById("nav-empresas-tab");
    const btnConductores = document.getElementById("nav-conductores-tab");

    btnCliente.addEventListener("click", () => {
        refrescarTablaCliente();
    });
    btnEmpresas.addEventListener("click", () => {
        refrescarTablaEmpresa();
    });
    btnConductores.addEventListener("click", () => {
        refrescarTablaConductor();
    });

    const refrescarTablaCliente = () => {
        //limpia la tabla
        tablaCliente.row().clear().draw(false);
        //carga nuevamente
        cargarClientes();
    };
    const refrescarTablaEmpresa = () => {
        //limpia la tabla
        tablaEmpresa.row().clear().draw(false);
        //carga nuevamente
        cargarEmpresas();
    };
    const refrescarTablaConductor = () => {
        //limpia la tabla
        tablaConductor.row().clear().draw(false);
        //carga nuevamente
        cargarConductores();
    };

    (cargarClientes = async() => {
        $("#spinner_tablaClientes").show();
        const response = await ajax_function(null, "cargar_clientes");
        if (response.success) {
            $.each(response.data, (i, o) => {
                try {
                    tablaCliente.row
                        .add([
                            o.nombre_cliente,
                            o.rut_cliente,
                            "+569 " + o.telefono_cliente,
                            o.correo_cliente,
                            ` <button value="${o.rut_cliente}"` +
                            " onclick='buscarCliente(this.value)'" +
                            " data-toggle='modal' data-target='#modal_ver' class='btn btn-outline-info'><i class='far fa-eye color'></i></button>",
                        ])
                        .draw(false);
                } catch (error) {}
            });
        }
        $("#spinner_tablaClientes").hide();
    })();

    const cargarEmpresas = async() => {
        $("#spinner_tablaEmpresas").show();
        const response = await ajax_function(null, "cargar_empresas");
        if (response.success) {
            $.each(response.data, (i, o) => {
                try {
                    tablaEmpresa.row
                        .add([
                            o.nombre_empresa,
                            o.rut_empresa,
                            o.rol_empresa,
                            o.correo_empresa,
                            ` <button value="${o.rut_empresa}"` +
                            " onclick='buscarEmpresa(this.value)'" +
                            " data-toggle='modal' data-target='#modal_ver' class='btn btn-outline-info'><i class='far fa-eye color'></i></button>",
                        ])
                        .draw(false);
                } catch (error) {}
            });
        }
        $("#spinner_tablaEmpresas").hide();
    };

    const cargarConductores = async() => {
        $("#spinner_tablaConductores").show();
        const response = await ajax_function(null, "cargar_conductores");
        if (response.success) {
            $.each(response.data, (i, o) => {
                try {
                    tablaConductor.row
                        .add([
                            o.nombre_conductor,
                            o.rut_conductor,
                            o.clase_conductor,
                            "+569 " + o.telefono_conductor,
                            ` <button value="${o.rut_conductor}"` +
                            " onclick='buscarConductor(this.value)'" +
                            " data-toggle='modal' data-target='#modal_ver' class='btn btn-outline-info'><i class='far fa-eye color'></i></button>",
                        ])
                        .draw(false);
                } catch (error) {}
            });
        }
        $("#spinner_tablaConductores").hide();
    };
});