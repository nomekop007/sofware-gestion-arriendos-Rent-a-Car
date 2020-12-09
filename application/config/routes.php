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

/* rutas de controller conductor */
$route['registrar_conductor'] = 'Conductor_controller/crearConductor';
$route['cargar_conductores'] = 'Conductor_controller/cargarConductores';
$route['buscar_conductor'] = 'Conductor_controller/buscarConductor';

/* rutas de controller empresa */
$route['registrar_empresa'] = 'Empresa_controller/crearEmpresa';
$route['cargar_empresas'] = 'Empresa_controller/cargarEmpresas';
$route['buscar_empresa'] = 'Empresa_controller/buscarEmpresa';

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
$route['registrar_contrato'] = 'Contrato_controller/registrarContrato';
$route['enviar_correoContrato'] = 'Contrato_controller/enviarCorreoContrato';

/* rutas de controller arriendo  */
$route['registrar_arriendo'] = 'Arriendo_controller/registrarArriendo';
$route['cargar_arriendos'] = 'Arriendo_controller/cargarArriendos';
$route['buscar_arriendo'] = 'Arriendo_controller/buscarArriendo';
$route['cambiarEstado_arriendo'] = 'Arriendo_controller/cambiarEstadoArriendo';
$route['extender_arriendo'] = 'Arriendo_controller/extenderArriendo';

/* rutas de controller ActaEntrega */
$route['registrar_actaEntrega'] = 'ActaEntrega_controller/registrarActaEntrega';
$route['generar_PDFactaEntrega'] = 'ActaEntrega_controller/generarPDFactaEntrega';
$route['enviar_correoActaEntrega'] = 'ActaEntrega_controller/enviarCorreoActaEntrega';
$route['buscar_actaEntrega'] = 'ActaEntrega_controller/buscarActaEntrega';

/* rutas de controller contacto */
$route['registrar_contacto'] = 'Contacto_controller/registrarContacto';

/* rutas de controller Despacho */
$route['registrar_despacho'] = 'Despacho_controller/registrarDespacho';
$route['registrar_revision'] = 'Despacho_controller/registrarRevision';

/* rutas de controller pagoArriendo */
$route['registrar_pagoArriendo'] = 'PagoArriendo_controller/registrarPagoArriendo';
$route['revisar_estadoPago'] = 'PagoArriendo_controller/revisarEstadoPago';

/* rutas de controller pagos */
$route['cargar_pagosERpendientes'] = 'Pago_controller/cargarPagosERpendientes';
$route['registrar_pago'] = 'Pago_controller/registrarPago';
$route['actualizar_pago'] = 'Pago_controller/actualizarPago';
$route['buscar_pagoER'] = 'Pago_controller/buscarPagoERpendientes';
$route['aplicarDescuento_UltimoPago'] = 'Pago_controller/aplicarDescuentoPago';

/* rutas de controller empresaRemplazo */
$route['cargar_empresasRemplazo'] = 'EmpresaRemplazo_controller/cargarEmpresasRemplazo';

/* rutas de controller garantia */
$route['registrar_garantia'] = 'Garantia_controller/registrarGarantia';

/* rutas de controller pagoDanio */
$route['registrar_pagoDanio'] = 'PagoDanio_controller/registrarPagoDanio';
$route['guardar_comprobantePagoDanio'] = 'PagoDanio_controller/subirComprobantePagoDanio';

/* rutas de controller danio */
$route['registrar_danio_vehiculo'] = 'DanioVehiculo_controller/registrarDanioVehiculo';
$route['revisar_danioVehiculo'] = 'DanioVehiculo_controller/revisarDanioVehiculo';
$route['cargar_todos_danios'] = 'DanioVehiculo_controller/cargarDanios';
$route['cambiar_estadoDanioVehiculo'] = 'DanioVehiculo_controller/cambiarEstadoDanio';

$route['404_override'] = '';
$route['translate_uri_dashes'] = false;