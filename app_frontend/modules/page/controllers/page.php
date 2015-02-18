<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('page_model');
		$this->load->model('banner_model');
		$this->load->model('tiles_model');
	}


	function index()
	{
		$data['new_products'] = modules::run('catalog/product/new_products');
		$data['banners'] = $this->banner_model->get_banners();
		$data['tiles'] = $this->tiles_model->get_tiles();

		$this->load->view('common/header');
		$this->load->view('home', isset($data) ? $data : NULL);
		$data['add_js'] = $this->load->view('page/js', isset($data) ? $data : NULL, true);
		$this->load->view('common/footer', isset($data) ? $data : NULL);
	}
	
	function home_v2()
	{
		$data['new_products'] = modules::run('catalog/product/new_products');
		$data['banners'] = $this->banner_model->get_banners();
		$data['tiles'] = $this->tiles_model->get_tiles();

		$this->load->view('common/header_v2');
		$this->load->view('home_v2', isset($data) ? $data : NULL);
		$data['add_js'] = $this->load->view('page/js', isset($data) ? $data : NULL, true);
		$this->load->view('common/footer_v2', isset($data) ? $data : NULL);	
	}

	function get_banner_first_image($banner_id)
	{
		return $this->banner_model->get_first_image($banner_id);
	}

	function get_tiles_first_image($tile_id)
	{
		return $this->tiles_model->get_first_image($tile_id);
	}

	function get_tiles_feature_image($feature_image_id)
	{
		$feature_image = $this->tiles_model->get_feature_image($feature_image_id);
		if($feature_image){
			return $feature_image;	
		}
		return false;
	}

	function details($slug = '')
	{
		$page = $this->page_model->get_page_by_slug($slug);
		#$page = $this->page_model->get_page(8);


		if (!$page)
		{
			show_404();
		}
		#$data['images'] = $this->page_model->get_images($page['page_id']);

		$data['title'] = $page['title'];
		$data['meta_desc'] = $page['meta_description'];
		$data['meta_keywords'] = $page['meta_keywords'];

		# Rending forms
		$form_patterns = '/\[\bform id=\b\d+\]/';
		preg_match_all($form_patterns, $page['content'], $matches);
		foreach($matches[0] as $form_pattern) {
			$s = explode('=', $form_pattern);
			$form_id = $s[1]; $form_id = str_replace(']', '', $form_id);
			$form_view = modules::run('form/index', $form_id);
			$content = str_replace($form_pattern, $form_view, $page['content']);
			$page['content'] = $content;
		}

		$data['page'] = $page;

		#$data['add_css'] = $this->load->view('page/css', isset($data) ? $data : NULL, true);
		$this->load->view('common/header', isset($data) ? $data : NULL);

		$this->load->view('page/details', isset($data) ? $data : NULL);

		$data['add_js'] = $this->load->view('page/js', isset($data) ? $data : NULL, true);
		$this->load->view('common/footer', isset($data) ? $data : NULL);
	}

	function top_menu($params)
	{
		$grid = '';
		if($params['add_grid'] == 'yes'){
			$grid = 'col-lg-3 col-md-3 col-sm-3 col-xs-3 remove-gutters';
		}
		$current_page = $params['cur_page'];

		$menu = $this->menu(1);
		$html = '<ul class="nav navbar-nav">';
		foreach($menu as $url) {
			$html .= $this->rec_top_menu($url,$grid,$current_page);
		}
		$html .= '</ul>';
		echo $html;
	}

	function rec_top_menu($url,$grid,$current_page)
	{
		$target = '';
		# New window icon
		if ($url['new_window'])
		{
			$target = ' target="_blank"';
		}

		$address = '#';
		if ($url['address'] != '')
		{
			$address = $url['address'];
		}

		if (isset($url['children']))
		{
			$html = '<li class="dropdown">
						<a data-toggle="dropdown" class="dropdown-toggle" href="' . $address . '"' . $target . '>' .
							$url['label'] . '<b class="caret"> </b>
						</a>';
			$html .= '<ul class="dropdown-menu">';
			foreach($url['children'] as $child)
			{
				$html .= $this->rec_top_menu($child,$grid,$current_page);
			}
			$html .= '</ul>';
		}
		else
		{
			$html = '<li class="' . $grid . '"><a ' . ($address == $current_page ? 'class="active"' : '') . ' href="' . $address . '"' . $target . '>' . $url['label'] . '</a>';
		}

		$html .= '</li>';

		return $html;
	}

	function menu($menu_id)
	{
		$menu = array();
		$urls = $this->page_model->get_urls($menu_id); # Get all root urls (no parent) of the menu
		foreach($urls as $url)
		{
			$menu[] = $this->get_child_url($url);
		}
		return $menu;
	}

	/**
	*	@desc: recursive function to get the array of menu url with sub urls
	*	@param: $url: object of url
	*	@return: $url: the object of url itself include children
	*/
	function get_child_url($url)
	{
		$url = $this->url_details($url);
		$sub_urls = $this->page_model->get_child_urls($url['url_id']);
		if (count($sub_urls) > 0)
		{
			$children = array();
			foreach($sub_urls as $sub_url)
			{
				$children[] = $this->get_child_url($sub_url);
			}
			$url['children'] = $children;
		}
		return $url;
	}

	function url_details($url)
	{
		if ($url['url_type'] == 'system')
		{
			switch($url['subject']) {
				case 'page':
						$page = modules::run('cms/page/id', $url['subject_id']);
						$url['label'] = ($url['label']) ? $url['label'] : $page['title'];
						$url['address'] = base_url() . $page['uri_path'] . '.html';
					break;
				case 'category':
						$category = modules::run('catalog/category/id', $url['subject_id']);
						$url['label'] = ($url['label']) ? $url['label'] : $category['name'];
						$url['address'] = base_url() . 'category/' . $category['uri_path'];
					break;
				case 'product':
						$product = modules::run('catalog/product/id', $url['subject_id']);
						$url['label'] = ($url['label']) ? $url['label'] : $product['name'];
						$url['address'] = base_url() . 'product/' . $product['uri_path'];
					break;
			}
		}
		return $url;
	}

	function rec_footer_menu($url)
	{
		$target = '';
		# New window icon
		if ($url['new_window'])
		{
			$target = ' target="_blank"';
		}

		$address = '#';
		if ($url['address'] != '')
		{
			$address = $url['address'];
		}

		if (isset($url['children']))
		{
			$html = '<li class="dropdown">
						<a data-toggle="dropdown" class="dropdown-toggle" href="' . $address . '"' . $target . '>' .
							$url['label'] . '<b class="caret"> </b>
						</a>';
			$html .= '<ul class="dropdown-menu">';
			foreach($url['children'] as $child)
			{
				$html .= $this->rec_footer_menu($child);
			}
			$html .= '</ul>';
		}
		else
		{
			$html = '<li><a href="' . $address . '"' . $target . '>' . $url['label'] . '</a>';
		}

		$html .= '</li>';

		return $html;
	}

	function footer_quicklinks()
	{
		$menu = $this->menu(2);
		$html = '<ul>';
		foreach($menu as $url) {
			$html .= $this->rec_footer_menu($url);
		}
		$html .= '</ul>';
		echo $html;
	}

	function id($page_id)
	{
		return $this->page_model->get_page($page_id);
	}

	function contact_form()
	{
		return $this->load->view('page/contact_form', isset($data) ? $data : NULL, true);
	}


	/* Tiles - Our Work */
	function work($slug)
	{
		$work = $this->tiles_model->get_tiles_by_slug($slug);

		if (!$work)
		{
			show_404();
		}

		$data['title'] = $work['name'];
		$data['meta_desc'] = '';
		$data['meta_keywords'] = '';

		$data['work'] = $work;
		$data['work_gallery'] = $this->tiles_model->get_images($work['tile_id']);

		$this->load->view('common/header', isset($data) ? $data : NULL);

		$this->load->view('page/work_details', isset($data) ? $data : NULL);

		$data['add_js'] = $this->load->view('page/js', isset($data) ? $data : NULL, true);
		$this->load->view('common/footer', isset($data) ? $data : NULL);
	}

	function google_map()
	{
		$this->load->view('contact_map');
	}
	
	# function to sync tiles order to same as tile id
	/*function _set_orders()
	{
		$tiles = $this->db->get('cms_tiles')->result_array();
		foreach($tiles as $tile){
			$this->db->where('tile_id',$tile['tile_id'])->update('cms_tiles',array('tile_order' => $tile['tile_id']));	
		}
			
	}*/
}

