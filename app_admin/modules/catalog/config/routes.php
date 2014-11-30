<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route[ROOT_PATH . 'catalog/(category_ajax|product_ajax)/(:any)'] = 'catalog/$1/$2';

$route[ROOT_PATH . 'category'] = 'catalog/category';
$route[ROOT_PATH . 'category/(:any)'] = 'catalog/category/$1';
$route[ROOT_PATH . 'category/(:any)/(:any)'] = 'catalog/category/$1/$2';

$route[ROOT_PATH . 'product'] = 'catalog/product';
$route[ROOT_PATH . 'product/(:any)'] = 'catalog/product/$1';
$route[ROOT_PATH . 'product/(:any)/(:any)'] = 'catalog/product/$1/$2';
$route[ROOT_PATH . 'product/(:any)/(:any)/(:any)'] = 'catalog/product/$1/$2/$3';

/* End of file routes.php */
/* Location: ./application/modules/cms/config/routes.php */