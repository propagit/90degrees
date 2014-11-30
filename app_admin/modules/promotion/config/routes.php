<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route[ROOT_PATH . 'promotion/promotion_ajax/(:any)'] = 'promotion/promotion_ajax/$1';

$route[ROOT_PATH . 'promotion'] = 'promotion';
$route[ROOT_PATH . 'promotion/(:any)'] = 'promotion/$1';
$route[ROOT_PATH . 'promotion/(:any)/(:any)'] = 'promotion/$1/$2';

/* End of file routes.php */
/* Location: ./application/modules/promotion/config/routes.php */