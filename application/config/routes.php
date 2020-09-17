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
$route['default_controller'] = 'welcome';

/* ruta de login de usuario  */
$route['iniciarSesion'] = 'Welcome/iniciarSesion';
$route['cerrarSesion'] = 'Welcome/cerrarSesion';
$route['irPlataforma'] = 'Welcome/irPlataforma';


/* ruta de carga de los paneles principales  */
$route['cargarPanel'] = 'Welcome/cargarPanel';

/* rutas de carga de los modulos */
$route['modulos_gestion'] = 'Session_gestion/cargarModulos';

/* rutas de modulo vehiculo */
$route['cargar_Sucursales'] = 'controller_gestion/Controller_vehiculo/cargarSucursales';
$route['cargar_Vehiculos'] = 'controller_gestion/Controller_vehiculo/cargarVehiculos';
$route['registrar_vehiculo'] = 'controller_gestion/Controller_vehiculo/registrarVehiculo';

/* rutas de modulo cliente */
$route['cargar_clientes'] = 'controller_gestion/Controller_cliente/cargarClientes';
$route['cargar_conductores'] = 'controller_gestion/Controller_cliente/cargarConductores';
$route['cargar_empresas'] = 'controller_gestion/Controller_cliente/cargarEmpresas';

/* rutas de modulo usuario */
$route['cargar_usuarios'] = 'controller_gestion/Controller_usuario/cargarUsuarios';
$route['cargar_roles'] = 'controller_gestion/Controller_usuario/cargarRoles';
$route['registrar_usuario'] = 'controller_gestion/Controller_usuario/registrarUsuario';
$route['buscar_usuario'] = 'controller_gestion/Controller_usuario/buscarUsuario';
$route['editar_usuario'] = 'controller_gestion/Controller_usuario/editarUsuario';





/* rutas de modulo arriendo  */
/* tab registrar arriendo */
$route['cargar_VehiculosPorSucursal'] = 'controller_gestion/Controller_arriendo/cargarVehiculosPorSucursal';
$route['registrar_arriendo'] = 'controller_gestion/Controller_arriendo/registrarArriendo';
$route['registrar_arriendoAccesorios'] = 'controller_gestion/Controller_arriendo/registrarArriendoAccesorios';
$route['cargar_accesorios'] = 'controller_gestion/Controller_arriendo/cargarAccesorios';
$route['buscar_empresa'] = 'controller_gestion/Controller_arriendo/buscarEmpresa';
$route['buscar_conductor'] = 'controller_gestion/Controller_arriendo/buscarConductor';
$route['buscar_cliente'] = 'controller_gestion/Controller_arriendo/buscarCliente';
/* tab total arriendos */
$route['cargar_TotalArriendos'] = 'controller_gestion/Controller_arriendo/cargarTotalArriendos';
$route['buscar_arriendo'] = 'controller_gestion/Controller_arriendo/buscarArriendo';
$route['registrar_pagoArriendo'] = 'controller_gestion/Controller_arriendo/registrarPagoArriendo';
$route['generar_pdfContratoArriendo'] = 'Controller_pdf/generarPDFContratoArriendo';



$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;