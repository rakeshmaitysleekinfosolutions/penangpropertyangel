<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] 	= 'Login';
$route['404_override']          = 'PageNotFoundController/index';
$route['admin']                 = 'login';
$route['admin/logout']                 = 'login/logout';
//$route['admin/login']           = 'login';
$route['filemanager']           = 'filemanager';


