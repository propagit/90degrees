<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route[ROOT_PATH . 'dashboard/dashboard_ajax/(:any)'] = 'dashboard/dashboard_ajax/$1';

$route[ROOT_PATH . 'dashboard'] = 'dashboard';
$route[ROOT_PATH . 'dashboard/(:any)'] = 'dashboard/$1';
$route[ROOT_PATH . 'dashboard/(:any)/(:any)'] = 'dashboard/$1/$2';

/* End of file routes.php */
/* Location: ./application/modules/dashboard/config/routes.php */