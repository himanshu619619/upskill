<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] 						= 'frontend';
$route['404_override'] 							    = 'errors';
$route['translate_uri_dashes'] 					    = FALSE;

//this for the frontend console
$route['home']										= 'frontend/index';
$route['search-flights']							= 'frontend/search_flights';
$route['search-flights-pages']					    = 'frontend/search_flights_page';

//this is for all ajax requests from frontend
$route['ajax/search-location'] 					    = 'ajax/get_autosuggest_locations';

$route['validate']									= 'ajax/index';
$route['register']									= 'frontend/register';
$route['login']										= 'frontend/login';
$route['login/(:any)']								= 'frontend/login/$1';

$route['dashboard']									= 'customer/index';
$route['logout']									= 'customer/logout';

//this for the backend console
$route['admin']										= 'admin/backend/index';
$route['admin/dashboard']							= 'admin/backend/index';
$route['admin/login']								=	'admin/login/index';
$route['admin/logout']								=	'admin/login/logout';

$route['admin/users']								= 'admin/backend/users';
$route['admin/users/add']							=	'admin/backend/user_form/';
$route['admin/users/edit/(:any)'] 			        = 'admin/backend/user_form/$1';

$route['admin/user-groups']							= 'admin/backend/user_groups';
$route['admin/user-group/add']					    ='admin/backend/user_group_form/';
$route['admin/user-group/edit/(:any)']              = 'admin/backend/user_group_form/$1';

$route['admin/pages']							    = 'admin/page/index';
$route['admin/pages/add']							= 'admin/page/page_form/';
$route['admin/pages/edit/(:any)']				    = 'admin/page/page_form/$1';

$route['admin/pages/link/add']					    = 'admin/page/link_form/';
$route['admin/pages/link/edit/(:any)']	            = 'admin/page/link_form/$1';

$route['admin/setting']								= 'admin/backend/setting_form';

$route['admin/ajax/employees']					    =	'admin/ajax/auto_employees';
$route['admin/ajax/zones']							=	'admin/ajax/get_zone_menu';

$route['email'] =                                                            'Frontend';
