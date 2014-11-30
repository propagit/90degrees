<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$route[ROOT_PATH . 'support'] = 'support';
$route[ROOT_PATH . 'support/(:any)'] = 'support/$1';
$route[ROOT_PATH . 'support/(:any)/(:any)'] = 'support/$1/$2';

/* End of file routes.php */
/* Location: ./application/modules/support/config/routes.php */