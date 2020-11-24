<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] 	= 'app';
$route['404_override']          = 'PageNotFoundController/index';
$route['admin']                 = 'login';
$route['admin/logout']                 = 'login/logout';
//$route['admin/login']           = 'login';
$route['filemanager']           = 'filemanager';


$route['app-register'] = 'app/register';
$route['app-login'] = 'app/login';
$route['logout'] = 'app/logout';
