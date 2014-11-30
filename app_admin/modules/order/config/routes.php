<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route[ROOT_PATH . 'order/ajax/(:any)'] = 'order/$1/$2';

$route[ROOT_PATH . 'order'] = 'order';
$route[ROOT_PATH . 'order/(:any)'] = 'order/$1';
$route[ROOT_PATH . 'order/(:any)/(:any)'] = 'order/$1/$2';

/* End of file routes.php */
/* Location: ./application/modules/order/config/routes.php */