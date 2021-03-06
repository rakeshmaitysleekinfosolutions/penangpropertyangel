<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']= 'app';
$route['404_override']      = 'PageNotFoundController/index';
$route['admin']             = 'login';
$route['admin/logout']      = 'login/logout';
//$route['admin/login']           = 'login';
$route['filemanager']       = 'filemanager';


$route['app-register']      = 'app/register';
$route['app-login']         = 'app/login';
$route['logout']            = 'app/logout';
$route['agents']            = 'app/agents';
//$route['rent'] = 'app/rent';
//$route['buy'] = 'app/buy';
$route['p/(:any)']          = 'app/view/$1';
$route['compare']           = 'app/compare/index';
$route['compare/add']       = 'app/compare/add';
$route['compare/remove']    = 'app/compare/remove';
$route['fetchSubProject']   = 'app/fetchSubProject';

// Rent Route
$route['rent']              = 'app/Item/index';
$route['buy']               = 'app/Item/index';
$route['item/filter']       = 'app/Item/filter';
$route['rent/(:any)']       = 'app/Item/getItems/$1';
$route['buy/(:any)']        = 'app/Item/getItems/$1';
$route['buy/(:any)/(:any)'] = 'app/Item/getItem/$1/$2';
$route['rent/(:any)/(:any)'] = 'app/Item/getItem/$1/$2';
$route['inspection-arranged'] = 'app/Item/submitInspectionArranged';
$route['download-all-files'] = 'app/Item/downloadAllFiles';
$route['foreigner-handbook'] = 'app/foreignerHandbooks';
$route['foreigner-handbook/(:any)'] = 'app/foreignerHandbook/$1';

$route['features'] = 'app/features';

$route['information/(:any)'] = 'app/Page/index/$1';
$route['contact'] = 'app/Page/contact';

$route['page-not-found']      = 'PageNotFoundController/index';