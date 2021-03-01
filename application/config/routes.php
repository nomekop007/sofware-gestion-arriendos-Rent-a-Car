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

/* rutas de controller region */
$route['cargar_regiones'] = 'Region_controller/cargarRegiones';

/* rutas de controller sucursal */
$route['cargar_Sucursales'] = 'Sucursal_controller/cargarSucursales';
$route['cargar_VehiculosPorSucursal'] = 'Sucursal_controller/cargarVehiculosPorSucursal';

/* rutas de controller vehiculo */
$route['cargar_Vehiculos'] = 'Vehiculo_controller/cargarVehiculos';
$route['registrar_vehiculo'] = 'Vehiculo_controller/registrarVehiculo';
$route['buscar_vehiculo'] = 'Vehiculo_controller/buscarVehiculo';
$route['editar_vehiculo'] = 'Vehiculo_controller/editarVehiculo';
$route['guardar_fotoVehiculo'] = 'Vehiculo_controller/guardarFotoVehiculo';
$route['cambiarEstado_vehiculo'] = 'Vehiculo_controller/cambiarEstadoVehiculo';
$route['cargar_VehiculosArrendados'] = 'Vehiculo_controller/vehiculosArrendados';



/* rutas de controller usuario */
$route['iniciar_sesion'] = 'Usuario_controller/iniciarSesion';
$route['cargar_usuarios'] = 'Usuario_controller/cargarUsuarios';
$route['registrar_usuario'] = 'Usuario_controller/registrarUsuario';
$route['buscar_usuario'] = 'Usuario_controller/buscarUsuario';
$route['editar_usuario'] = 'Usuario_controller/editarUsuario';
$route['cambiarEstado_usuario'] = 'Usuario_controller/cambiarEstadoUsuario';

/* rutas controller Rol  */
$route['cargar_roles'] = 'Rol_controller/cargarRoles';

/* rutas controller Propietario  */
$route['cargar_propietarios'] = 'Propietario_controller/cargarPropietarios';

/* rutas controller Accesorio  */
$route['cargar_accesorios'] = 'Accesorio_controller/cargarAccesorios';

/* rutas de controller cliente */
$route['registrar_cliente'] = 'Cliente_controller/crearCliente';
$route['cargar_clientes'] = 'Cliente_controller/cargarClientes';
$route['buscar_cliente'] = 'Cliente_controller/buscarCliente';
$route['modificar_cliente'] = 'Cliente_controller/modificarCliente';
$route['editarArchivos_cliente'] = 'Cliente_controller/editarArchivosCliente';


/* rutas de controller conductor */
$route['registrar_conductor'] = 'Conductor_controller/crearConductor';
$route['cargar_conductores'] = 'Conductor_controller/cargarConductores';
$route['buscar_conductor'] = 'Conductor_controller/buscarConductor';
$route['modificar_conductor'] = 'Conductor_controller/modificarConductor';
$route['editarArchivos_conductor'] = 'Conductor_controller/editarArchivosConductor';


/* rutas de controller empresa */
$route['registrar_empresa'] = 'Empresa_controller/crearEmpresa';
$route['cargar_empresas'] = 'Empresa_controller/cargarEmpresas';
$route['buscar_empresa'] = 'Empresa_controller/buscarEmpresa';
$route['modificar_empresa'] = 'Empresa_controller/modificarEmpresa';
$route['editarArchivos_empresa'] = 'Empresa_controller/editarArchivosEmpresa';


/* rutas de controller remplazo */
$route['registrar_remplazo'] = 'Remplazo_controller/crearRemplazo';

/* rutas de controller PagoAccesorio */
$route["registrar_pagoAccesorios"] = 'PagoAccesorio_controller/registrarPagosAccesorios';

/* rutas de controller Facturacion */
$route["cargar_facturaciones"] = 'Facturacion_controller/cargarFacturaciones';
$route["registrar_facturacion"] = 'Facturacion_controller/registrarFacturacion';
$route["guardar_documentoFacturacion"] = 'Facturacion_controller/guardarDocumentoFacturacion';

/* rutas de controller requisitos  */
$route['registrar_requisitos'] = 'Requisito_controller/guardarDocumentosRequistosArriendo';
$route['buscar_requisito'] = 'Requisito_controller/buscarRequisitoArriendo';

/* rutas de controller Contrato */
$route['generar_PDFcontrato'] = 'Contrato_controller/generarPDFcontrato';
$route['generar_PDFextencionContrato'] = 'Contrato_controller/generarPDFextencionContrato';
$route['registrar_contrato'] = 'Contrato_controller/registrarContrato';
$route['registrar_extencionContrato'] = 'Contrato_controller/registrarExtencionContrato';
$route['subir_contrato'] = 'Contrato_controller/subirContrato';
$route['subir_extencionContrato'] = 'Contrato_controller/subirExtencionContrato';
$route['enviar_correoContrato'] = 'Contrato_controller/enviarCorreoContrato';
$route['enviar_correoExtencion'] = 'Contrato_controller/enviarCorreoContratoExtencion';


/* rutas de controller arriendo  */
$route['registrar_arriendo'] = 'Arriendo_controller/registrarArriendo';
$route['cargar_arriendos'] = 'Arriendo_controller/cargarArriendos';
$route['buscar_arriendo'] = 'Arriendo_controller/buscarArriendo';
$route['cambiarEstado_arriendo'] = 'Arriendo_controller/cambiarEstadoArriendo';
$route['extender_arriendo'] = 'Arriendo_controller/extenderArriendo';
$route['cargar_arriendosActivos'] = 'Arriendo_controller/cargarArriendosActivos';
$route['cargar_arriendosDespachos'] = 'Arriendo_controller/cargarArriendosDespachos';

$route['enviarCorreo_alertaArriendo'] = 'Arriendo_controller/enviarCorreoAtraso';
$route['finalizar_arriendos'] = 'Arriendo_controller/finalizarArriendosRecepcionados';


/* rutas de controller ActaEntrega */
$route['registrar_actaEntrega'] = 'ActaEntrega_controller/registrarActaEntrega';
$route['generar_PDFactaEntrega'] = 'ActaEntrega_controller/generarPDFactaEntrega';
$route['enviar_correoActaEntrega'] = 'ActaEntrega_controller/enviarCorreoActaEntrega';
$route['buscar_actaEntrega'] = 'ActaEntrega_controller/buscarActaEntrega';
$route['guardar_fotosVehiculo'] = 'ActaEntrega_controller/guardarFotosVehiculo';

/* rutas de controller contacto */
$route['registrar_contacto'] = 'Contacto_controller/registrarContacto';

/* rutas de controller Despacho */
$route['registrar_despacho'] = 'Despacho_controller/registrarDespacho';
$route['registrar_revision'] = 'Despacho_controller/registrarRevision';

/* rutas de controller pagoArriendo */
$route['registrar_pagoArriendo'] = 'PagoArriendo_controller/registrarPagoArriendo';
$route['consultar_pagoArriendos'] = 'PagoArriendo_controller/consultarPagosArriendo';

/* rutas de controller pagos */
$route['cargar_pagosERpendientes'] = 'Pago_controller/cargarPagosERpendientes';
$route['registrar_pago'] = 'Pago_controller/registrarPago';
$route['actualizar_pagos'] = 'Pago_controller/actualizarPagos';
$route['modificar_pago'] = 'Pago_controller/modificarPago';
$route['buscar_pagoCliente'] = 'Pago_controller/buscarPagoClientes';
$route['cargar_pagosCliente'] = 'Pago_controller/cargarPagosClientes';
$route['buscar_pagoER'] = 'Pago_controller/buscarPagoERpendientes';
$route['aplicarDescuento_UltimoPago'] = 'Pago_controller/aplicarDescuentoPago';
$route['calcularTotal_pago'] = 'Pago_controller/calcularTotalPagos';
$route['buscar_pago'] = 'Pago_controller/buscarPago';
$route['actualizar_montoPago'] = 'Pago_controller/actualizarMontoPago';
$route['actualizar_pagoAPagado'] = 'Pago_controller/actualizarUnPagoAPagado';
$route['registrar_pagoExtra'] = 'Pago_controller/registrarPagoExtra';
$route['cargar_pagosExtrasPorArriendo'] = 'Pago_controller/cargarPagosExtrasPorArriendo';




/* rutas de controller empresaRemplazo */
$route['cargar_empresasRemplazo'] = 'EmpresaRemplazo_controller/cargarEmpresasRemplazo';

/* rutas de controller garantia */
$route['registrar_garantia'] = 'Garantia_controller/registrarGarantia';

/* rutas de controller pagoDanio */
$route['registrar_pagoDanio'] = 'PagoDanio_controller/registrarPagoDanio';

/* rutas de controller danio */
$route['registrar_danio_vehiculo'] = 'DanioVehiculo_controller/registrarDanioVehiculo';
$route['revisar_danioVehiculo'] = 'DanioVehiculo_controller/revisarDanioVehiculo';
$route['cargar_todos_danios'] = 'DanioVehiculo_controller/cargarDanios';
$route['cambiar_estadoDanioVehiculo'] = 'DanioVehiculo_controller/cambiarEstadoDanio';

/* rutas de controller TarifasVehiculo */
$route['buscarTarifasVehiculo'] = 'TarifaVehiculo_controller/buscarTarifasVehiculo';


/* rutas de controller reservas */
$route['cargar_reservas'] = 'Reserva_controller/cargarReservas';
$route['buscar_reserva'] = 'Reserva_controller/buscarReserva';
$route['registrar_reserva'] = 'Reserva_controller/registrarReserva';
$route['editar_reserva'] = 'Reserva_controller/editarReserva';
$route['eliminar_reserva'] = 'Reserva_controller/eliminarReserva';


/* rutas de controller extencion */
$route['registrar_extencion'] = 'Extencion_controller/registrarExtencion';
$route['cargar_extenciones'] = 'Extencion_controller/cargarExtenciones';


/* rutas de controller abono */
$route['registrar_abono'] = 'Abono_controller/registrarAbono';

$route['404_override'] = '';
$route['translate_uri_dashes'] = false;
