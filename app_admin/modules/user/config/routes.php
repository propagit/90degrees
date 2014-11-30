<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route[ROOT_PATH . 'user/user_ajax/(:any)'] = 'user/user_ajax/$1';

$route[ROOT_PATH . 'customer'] = 'user/user';
$route[ROOT_PATH . 'customer/(:any)'] = 'user/user/$1';
$route[ROOT_PATH . 'customer/(:any)/(:any)'] = 'user/user/$1/$2';

/* End of file routes.php */
/* Location: ./application/modules/users/config/routes.php */