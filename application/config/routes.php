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
	$route['translate_uri_dashes'] = FALSE;
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

/**
 * Client Web apis.
 */
$route['api/client/check'] = 'api/client/check';
$route['api/client/signup'] = 'api/client/signup';
$route['api/client/login'] = 'api/client/login';
$route['api/client/activate-email/(:any)'] = 'api/client/active_email/$1';
$route['api/client/activate-phone/(:any)'] = 'api/client/active_phone/$1';
$route['api/client/accountinfo'] = 'api/client/updateinfo';
$route['api/client/email-verify'] = 'api/client/email_verify';
$route['api/client/phone-verify'] = 'api/client/phone_verify';

/**
 * Service man Web apis
 */
$route['api/service/updateposition'] = 'api/service/updateposition';
/**
 * Order web apis
 */
$route['api/order/make'] = 'api/order/make';
$route['api/order/ratable'] = 'api/order/getRatableList';
$route['api/order/rate'] = 'api/order/rate';
$route['api/order/history'] = 'api/order/history';
$route['api/order/savetoken'] = 'api/order/savetoken';
$route['api/order/pending'] = 'api/order/getpending';
$route['api/order/setstatus'] = 'api/order/setStatus';
$rotue['api/order/getactive'] = 'api/order/getactive';



/*
 * Admin panels
 */
$route['admin/feedback'] = 'admin/feedback';
$route['admin/order/gettoken'] = 'admin/order/getFCMToken';
$route['admin/order/assign_order_api'] = 'admin/order/assign_order_api';
//$route['admin/order/assign_order/(:any)'] = 'admin/order/assign_order/$1';
$route['admin/order/total'] = 'admin/order/total';

$route['admin/order/view/(:any)'] = 'admin/order/view/$1';

//$route['admin/order'] = 'admin/order/total';




$route['admin/service/search/(:any)'] = 'admin/service/search/$1';
$route['admin/service/edit/(:any)'] = 'admin/service/edit/$1';
$route['admin/service/password/(:any)'] = 'admin/service/change_password/$1';
$route['admin/service/create'] = 'admin/service/create';
$route['admin/service/getposition'] = 'admin/service/getposition';
$route['admin/service/(:any)'] = 'admin/service/view/$1';
$route['amdin/service'] = 'admin/service';


$route['admin/customer/list'] = 'admin/customers/list_client';
$route['admin/customer/verify/(:any)/(:any)'] = 'admin/customers/verify_user/$1/$2';
$route['admin/customer/activeuser/(:any)'] = 'admin/customers/active_user/$1';
$route['admin/customer/blockuser/(:any)'] = 'admin/customers/block_user/$1';
$route['admin/customer/service_list'] = 'admin/customers/service_list';
$route['admin/customer/(:any)'] = 'admin/customers/view/$1';// this is for view detail for customer

$route['admin/customer'] = 'admin/customers';
$route['admin/customer/search/(:any)'] = 'admin/customers/search/$1';
$route['admin/customer/edit/(:any)'] = 'admin/customers/edit/$1';
$route['admin/customer/password/(:any)'] = 'admin/customers/change_password/$1';
$route['admin/customer/create'] = 'admin/customers/create';
$route['admin/dashboard'] = 'admin/dashboard';
$route['admin/logout'] = 'admin/login/logout';
$route['admin'] = 'admin/login';

$route['default_controller'] = 'Welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
