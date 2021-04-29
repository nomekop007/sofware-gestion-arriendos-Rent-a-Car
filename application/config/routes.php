<?php
defined('BASEPATH') or exit('No direct script access allowed');
$route['default_controller'] = 'Sesion_controller';





/* ruta de controller  session  */
$route['cerrar_sesion'] = 'Sesion_controller/cerrarSesion';
$route['crear_sesion'] = 'Sesion_controller/crearSesion';
$route['cargar_panel'] = 'Sesion_controller/cargarPanel';

/* ruta de controller modulo  */
$route['modulos_gestion'] = 'Modulo_controller/cargarModulosGestion';
$route['modulos_atencion'] = 'Modulo_controller/cargarModulosAtencion';

/* ruta de controller utils */
$route['buscar_documento'] = 'Utils_controller/buscarDocumento';


/* rutas controller Accesorio  */
$route['cargar_accesorios'] = 'Accesorio_controller/cargarAccesorios';


/* rutas de controller arriendo  */

$route['registrar_arriendo'] = 'Arriendo_controller/registrarArriendo';
$route['cargar_arriendos'] = 'Arriendo_controller/cargarArriendos';
$route['buscar_arriendo'] = 'Arriendo_controller/buscarArriendo';
$route['cambiarEstado_arriendo'] = 'Arriendo_controller/cambiarEstadoArriendo';
$route['extender_arriendo'] = 'Arriendo_controller/extenderArriendo';
$route['cargar_arriendosActivos'] = 'Arriendo_controller/cargarArriendosActivos';
$route['cargar_arriendosDespachos'] = 'Arriendo_controller/cargarArriendosDespachos';
$route['anular_arriendo'] = 'Arriendo_controller/anularArriendo';
$route['enviarCorreo_alertaArriendo'] = 'Arriendo_controller/enviarCorreoAtraso';
$route['finalizar_arriendos'] = 'Arriendo_controller/finalizarArriendosRecepcionados';
$route['registrar_requisitos'] = 'Arriendo_controller/guardarDocumentosRequistosArriendo';
$route['buscar_requisito'] = 'Arriendo_controller/buscarRequisitoArriendo';
$route['registrar_garantia'] = 'Arriendo_controller/registrarGarantia';
$route['registrar_contacto'] = 'Arriendo_controller/registrarContacto';
$route['registrar_extencion'] = 'Arriendo_controller/registrarExtencion';
$route['cargar_extenciones'] = 'Arriendo_controller/cargarExtenciones';
$route['generar_PDFcontrato'] = 'Arriendo_controller/generarPDFcontrato';
$route['generar_PDFextencionContrato'] = 'Arriendo_controller/generarPDFextencionContrato';
$route['registrar_contrato'] = 'Arriendo_controller/registrarContrato';
$route['registrar_extencionContrato'] = 'Arriendo_controller/registrarExtencionContrato';
$route['subir_contrato'] = 'Arriendo_controller/subirContrato';
$route['subir_extencionContrato'] = 'Arriendo_controller/subirExtencionContrato';
$route['enviar_correoContrato'] = 'Arriendo_controller/enviarCorreoContrato';
$route['enviar_correoExtencion'] = 'Arriendo_controller/enviarCorreoContratoExtencion';
$route['cargar_arriendos_proceso'] = 'Arriendo_controller/cargarArriendosEnProceso';

/* rutas de controller cliente */
$route['registrar_cliente'] = 'Cliente_controller/crearCliente';
$route['cargar_clientes'] = 'Cliente_controller/cargarClientes';
$route['buscar_cliente'] = 'Cliente_controller/buscarCliente';
$route['modificar_cliente'] = 'Cliente_controller/modificarCliente';
$route['editarArchivos_cliente'] = 'Cliente_controller/editarArchivosCliente';
$route['registrar_conductor'] = 'Cliente_controller/crearConductor';
$route['cargar_conductores'] = 'Cliente_controller/cargarConductores';
$route['buscar_conductor'] = 'Cliente_controller/buscarConductor';
$route['modificar_conductor'] = 'Cliente_controller/modificarConductor';
$route['editarArchivos_conductor'] = 'Cliente_controller/editarArchivosConductor';
$route['registrar_empresa'] = 'Cliente_controller/crearEmpresa';
$route['cargar_empresas'] = 'Cliente_controller/cargarEmpresas';
$route['buscar_empresa'] = 'Cliente_controller/buscarEmpresa';
$route['modificar_empresa'] = 'Cliente_controller/modificarEmpresa';
$route['editarArchivos_empresa'] = 'Cliente_controller/editarArchivosEmpresa';


/* rutas de controller Despacho */
$route['registrar_despacho'] = 'Despacho_controller/registrarDespacho';
$route['registrar_revision'] = 'Despacho_controller/registrarRevision';
$route['registrar_bloqueoUsuario'] = 'Despacho_controller/registrarBloqueoUsuario';
$route['revisar_bloqueoUsuario'] = 'Despacho_controller/revisarBloqueoUsuario';
$route['registrar_actaEntrega'] = 'Despacho_controller/registrarActaEntrega';
$route['generar_PDFactaEntrega'] = 'Despacho_controller/generarPDFactaEntrega';
$route['generar_PDFactaRecepcion'] = 'Despacho_controller/generarPDFactaRecepcion';
$route['enviar_correoActaEntrega'] = 'Despacho_controller/enviarCorreoActaEntrega';
$route['buscar_actaEntrega'] = 'Despacho_controller/buscarActaEntrega';
$route['guardar_fotosVehiculo'] = 'Despacho_controller/guardarFotosVehiculo';
$route['guardar_fotoRecepcion'] = 'Despacho_controller/guardarFotoRecepcion';
$route['eliminar_FotosRecepcion'] = 'Despacho_controller/eliminarFotosRecepcion';
$route['eliminar_FotosDespacho'] = 'Despacho_controller/eliminarFotosDespacho';
$route['confirmar_despachoArriendo'] = 'Despacho_controller/confirmarDespachoArriendo';
$route['confirmar_recepcionArriendo'] = 'Despacho_controller/confirmarRecepcionArriendo';


/* rutas de controller empresaRemplazo */
$route['cargar_empresasRemplazo'] = 'EmpresaRemplazo_controller/cargarEmpresasRemplazo';
$route['registrar_remplazo'] = 'EmpresaRemplazo_controller/crearRemplazo';


/* rutas de controller pagos */
$route['cargar_pagosERpendientes'] = 'Pago_controller/cargarPagosERpendientes';
$route['registrar_pago'] = 'Pago_controller/registrarPago';
$route['actualizar_pagos'] = 'Pago_controller/actualizarPagos';
$route['modificar_pago'] = 'Pago_controller/modificarPago';
$route['buscar_pagoCliente'] = 'Pago_controller/buscarPagoClientes';
$route['cargar_pagosCliente'] = 'Pago_controller/cargarPagosClientes';
$route['buscar_pagoER'] = 'Pago_controller/buscarPagoERpendientes';
$route['buscar_pagoER_conFiltros'] = 'Pago_controller/buscarPagoERpendientesConFiltro';

$route['aplicarDescuento_UltimoPago'] = 'Pago_controller/aplicarDescuentoPago';
$route['calcularTotal_pago'] = 'Pago_controller/calcularTotalPagos';
$route['buscar_pago'] = 'Pago_controller/buscarPago';
$route['actualizar_montoPago'] = 'Pago_controller/actualizarMontoPago';
$route['actualizar_pagoAPagado'] = 'Pago_controller/actualizarUnPagoAPagado';
$route['registrar_pagoExtra'] = 'Pago_controller/registrarPagoExtra';
$route['cargar_pagosExtrasPorArriendo'] = 'Pago_controller/cargarPagosExtrasPorArriendo';
$route['eliminarPagoExtra'] = 'Pago_controller/eliminarPagoExtra';
$route['actualizarPagoExtra'] = 'Pago_controller/actualizarPagoExtra';
$route["registrar_pagoAccesorios"] = 'Pago_controller/registrarPagosAccesorios';
$route["cargar_facturaciones"] = 'Pago_controller/cargarFacturaciones';
$route["registrar_facturacion"] = 'Pago_controller/registrarFacturacion';
$route["guardar_documentoFacturacion"] = 'Pago_controller/guardarDocumentoFacturacion';
$route['registrar_pagoArriendo'] = 'Pago_controller/registrarPagoArriendo';
$route['consultar_pagoArriendos'] = 'Pago_controller/consultarPagosArriendo';
$route['consultar_totalPagoArriendos'] = 'Pago_controller/consultarTotalPagosArriendo';
$route['registrar_pagoDanio'] = 'Pago_controller/registrarPagoDanio';
$route['registrar_abono'] = 'Pago_controller/registrarAbono';


/* rutas controller Permiso  */
$route['cargar_roles'] = 'Permiso_controller/cargarRoles';


/* rutas controller Propietario  */
$route['cargar_propietarios'] = 'Propietario_controller/cargarPropietarios';


/* rutas de controller reservas */
$route['cargar_reservas'] = 'Reserva_controller/cargarReservas';
$route['buscar_reserva'] = 'Reserva_controller/buscarReserva';
$route['registrar_reserva'] = 'Reserva_controller/registrarReserva';
$route['editar_reserva'] = 'Reserva_controller/editarReserva';
$route['eliminar_reserva'] = 'Reserva_controller/eliminarReserva';


/* rutas de controller sucursal */
$route['cargar_regiones'] = 'Sucursal_controller/cargarRegiones';
$route['cargar_Sucursales'] = 'Sucursal_controller/cargarSucursales';
$route['buscar_sucursal'] = 'Sucursal_controller/buscarSucursal';


/* rutas de controller usuario */
$route['iniciar_sesion'] = 'Usuario_controller/iniciarSesion';
$route['cargar_usuarios'] = 'Usuario_controller/cargarUsuarios';
$route['registrar_usuario'] = 'Usuario_controller/registrarUsuario';
$route['buscar_usuario'] = 'Usuario_controller/buscarUsuario';
$route['editar_usuario'] = 'Usuario_controller/editarUsuario';
$route['cambiarEstado_usuario'] = 'Usuario_controller/cambiarEstadoUsuario';


/* rutas de controller vehiculo */
$route['cargar_Vehiculos'] = 'Vehiculo_controller/cargarVehiculos';
$route['registrar_vehiculo'] = 'Vehiculo_controller/registrarVehiculo';
$route['buscar_vehiculo'] = 'Vehiculo_controller/buscarVehiculo';
$route['editar_vehiculo'] = 'Vehiculo_controller/editarVehiculo';
$route['guardar_fotoVehiculo'] = 'Vehiculo_controller/guardarFotoVehiculo';
$route['cambiarEstado_vehiculo'] = 'Vehiculo_controller/cambiarEstadoVehiculo';
$route['cargar_VehiculosArrendados'] = 'Vehiculo_controller/vehiculosArrendados';
$route['cargar_VehiculosDisponibles'] = 'Vehiculo_controller/cargarVehiculosDisponibles';
$route['cargar_vehiculosDisponibleSucursal'] = 'Vehiculo_controller/cargarVehiculosDisponiblesPorSucursal';
$route['cargar_vehiculosArrendadoSucursal'] = 'Vehiculo_controller/cargarVehiculosArrendadosPorSucursal';
$route['registrar_danio_vehiculo'] = 'Vehiculo_controller/registrarDanioVehiculo';
$route['revisar_danioVehiculo'] = 'Vehiculo_controller/revisarDanioVehiculo';
$route['cargar_todos_danios'] = 'Vehiculo_controller/cargarDanios';
$route['cambiar_estadoDanioVehiculo'] = 'Vehiculo_controller/cambiarEstadoDanio';
$route['buscarTarifasVehiculo'] = 'Vehiculo_controller/buscarTarifasVehiculo';

//ruta creada por Esteban Mallea para el control de Daños Vehiculares
//alias primero va al js ------
$route['registrar_danio_vehiculo_new'] = 'Vehiculo_controller/registrarDanioVehiculo_new';
$route['eliminar_danio_vehiculo_new'] = 'Vehiculo_controller/eliminarDanioVehiculo_new';

// Rutas de Tarifas Empresas Reemplazo Creadas por Esteban Mallea

$route['obtenerTarifasEmpresaSucursal'] = 'EmpresaRemplazo_controller/obtenerTarifasEmpresaSucursal';

// Rutas de Traslado Creadas por Esteban Mallea
$route['generar_actaOrigen'] = 'Sucursal_controller/generar_ActaTraslado';  //funcion create de traslados
$route['eliminarTraslado'] = 'Sucursal_controller/eliminarTraslado';
$route['actualizarTrasladoEstado'] = 'Sucursal_controller/actualizarTrasladoEstado';
$route['obtenerTodosTraslados'] = 'Sucursal_controller/obtenerTodosTraslados';
$route['obtenerTraslado'] = 'Sucursal_controller/obtenerTraslado';
$route['ActualizarFotosTraslado'] = 'Sucursal_controller/guardarFotosTrasladoOrigen';
$route['ActualizarFotosTrasladoDestino'] = 'Sucursal_controller/guardarFotosTrasladoDestino';

// ----------------------------------------------------------




$route['404_override'] = '';
$route['translate_uri_dashes'] = false;
