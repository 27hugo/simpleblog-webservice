<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'posts';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

$route['users']['get'] = 'users/index';
$route['users/(:num)']['get'] = 'users/search/$1';
$route['users']['post'] = 'users/index';
$route['users/(:num)']['put'] = 'users/index/$1';
$route['users/(:num)']['delete'] = 'users/index/$1';


$route['posts']['get'] = 'posts/index';
$route['posts/(:num)']['get'] = 'posts/search/$1';
$route['posts']['post'] = 'posts/index';
$route['posts/(:num)']['put'] = 'posts/index/$1';
$route['posts/(:num)']['delete'] = 'posts/index/$1';


/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/
//$route['api/example/users/(:num)'] = 'api/example/users/id/$1'; // Example 4
//$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8
