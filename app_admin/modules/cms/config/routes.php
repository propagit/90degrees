<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route[ROOT_PATH . 'cms/(page_ajax|menu_ajax|banner_ajax|tiles_ajax|form_ajax)/(:any)'] = 'cms/$1/$2';

$route[ROOT_PATH . 'page'] = 'cms/page';
$route[ROOT_PATH . 'page/(:any)'] = 'cms/page/$1';
$route[ROOT_PATH . 'page/(:any)/(:any)'] = 'cms/page/$1/$2';

$route[ROOT_PATH . 'menu'] = 'cms/menu';
$route[ROOT_PATH . 'menu/(:any)'] = 'cms/menu/$1';
$route[ROOT_PATH . 'menu/(:any)/(:any)'] = 'cms/menu/$1/$2';

$route[ROOT_PATH . 'form'] = 'cms/form';
$route[ROOT_PATH . 'form/(:any)'] = 'cms/form/$1';
$route[ROOT_PATH . 'form/(:any)/(:any)'] = 'cms/form/$1/$2';

$route[ROOT_PATH . 'banner'] = 'cms/banner';
$route[ROOT_PATH . 'banner/(:any)'] = 'cms/banner/$1';
$route[ROOT_PATH . 'banner/(:any)/(:any)'] = 'cms/banner/$1/$2';
$route[ROOT_PATH . 'banner/(:any)/(:any)/(:any)'] = 'cms/banner/$1/$2/$3';

$route[ROOT_PATH . 'tiles'] = 'cms/tiles';
$route[ROOT_PATH . 'tiles/(:any)'] = 'cms/tiles/$1';
$route[ROOT_PATH . 'tiles/(:any)/(:any)'] = 'cms/tiles/$1/$2';
$route[ROOT_PATH . 'tiles/(:any)/(:any)/(:any)'] = 'cms/tiles/$1/$2/$3';

/* End of file routes.php */
/* Location: ./application/modules/cms/config/routes.php */
