<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Sesion_controller';

/* ruta de controller  usuario  */
$route['iniciarSesion'] = 'Sesion_controller/iniciarSesion';
$route['cerrarSesion'] = 'Sesion_controller/cerrarSesion';
$route['irPlataforma'] = 'Sesion_controller/irPlataforma';
$route['cargarPanel'] = 'Sesion_controller/cargarPanel';

/* ruta de controller modulo  */
$route['modulos_gestion'] = 'Modulo_controller/cargarModulosGestion';



/* rutas de controller sucursal */
$route['cargar_Sucursales'] = 'Sucursal_controller/cargarSucursales';
$route['cargar_VehiculosPorSucursal'] = 'Sucursal_controller/cargarVehiculosPorSucursal';

/* rutas de controller vehiculo */
$route['cargar_Vehiculos'] = 'Vehiculo_controller/cargarVehiculos';
$route['registrar_vehiculo'] = 'Vehiculo_controller/registrarVehiculo';
$route['buscar_vehiculo'] = 'Vehiculo_controller/buscarVehiculo';
$route['editar_vehiculo'] = 'Vehiculo_controller/editarVehiculo';
$route['guardar_fotoVehiculo'] = 'Vehiculo_controller/guardarFotoVehiculo';

/* rutas de controller usuario */
$route['cargar_usuarios'] = 'Usuario_controller/cargarUsuarios';
$route['registrar_usuario'] = 'Usuario_controller/registrarUsuario';
$route['buscar_usuario'] = 'Usuario_controller/buscarUsuario';
$route['editar_usuario'] = 'Usuario_controller/editarUsuario';
$route['cambiarEstado_usuario'] = 'Usuario_controller/cambiarEstadoUsuario';

/* rutas controller Rol  */
$route['cargar_roles'] = 'Rol_controller/cargarRoles';

/* rutas controller Accesorio  */
$route['registrar_arriendoAccesorios'] = 'Accesorio_controller/registrarArriendoAccesorios';
$route['cargar_accesorios'] = 'Accesorio_controller/cargarAccesorios';

/* rutas de controller cliente */
$route['cargar_clientes'] = 'Cliente_controller/cargarClientes';
$route['buscar_cliente'] = 'Cliente_controller/buscarCliente';

/* rutas de controller conductor */
$route['cargar_conductores'] = 'Conductor_controller/cargarConductores';
$route['buscar_conductor'] = 'Conductor_controller/buscarConductor';

/* rutas de controller empresa */
$route['cargar_empresas'] = 'Empresa_controller/cargarEmpresas';
$route['buscar_empresa'] = 'Empresa_controller/buscarEmpresa';

/* rutas de controller arriendo  */
$route['registrar_arriendo'] = 'Arriendo_controller/registrarArriendo';
$route['cargar_TotalArriendos'] = 'Arriendo_controller/cargarTotalArriendos';
$route['buscar_arriendo'] = 'Arriendo_controller/buscarArriendo';
$route['registrar_pagoArriendo'] = 'Arriendo_controller/registrarPagoArriendo';

/* rutas de controller PDF  */
$route['generar_pdfContratoArriendo'] = 'PDF_controller/generarPDFContratoArriendo';





$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
