<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] 	= 'app';
$route['404_override']          = 'PageNotFoundController/index';


$route['admin']                 = 'adminDashboard';
$route['admin-login']           = 'adminDashboard/login';
$route['admin-dashboard']       = 'adminDashboard/dashboard/';
$route['admin-logout']          = 'adminDashboard/admin_logout';




$route['filemanager']           = 'filemanager';


