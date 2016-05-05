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
|		my-controller/my-method	-> my_controller/my_method
*/
/*$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;*/
/*$route['news/create'] = 'news/create';
$route['news/(:any)'] = 'news/view/$1';
$route['news'] = 'news';
$route['(:any)'] = 'pages/view/$1';
$route['default_controller'] = 'pages/view';*/

// albums routing
$route['albums/(:num)']['DELETE'] = 'albums/delete/$1';
$route['albums/(:num)']['GET'] = 'albums/get/$1';
$route['albums']['GET'] = 'albums/get';
$route['albums']['POST'] = 'albums/add';
$route['albums/(:num)']['PUT'] = 'albums/update/$1';

// users routing
$route['users/(:num)']['DELETE'] = 'users/delete/$1';
$route['users/(:num)']['GET'] = 'users/get/$1';
$route['users']['GET'] = 'users/get';
$route['users']['POST'] = 'users/add';
$route['users/(:num)']['PUT'] = 'users/update/$1';

// albums/images routing
$route['albums/images/(:num)']['DELETE'] = 'albums_images/delete/$1';
$route['albums/images/(:num)']['GET'] = 'albums_images/get/$1';
$route['albums/images']['GET'] = 'albums_images/get';
$route['albums/images']['POST'] = 'albums_images/add';
$route['albums/images/(:num)']['PUT'] = 'albums_images/update/$1';

// cache
$route['memcached/(:any)']['GET'] = 'cache/delete/$1';
$route['memcached']['GET'] = 'cache/view';

//reset password
$route['reset']['POST'] = 'reset/mail';
$route['reset/password']['POST'] = 'reset/password';
$route['reset']['PUT'] = 'reset/password';
$route['mail'] = 'swiftmailer/index';

