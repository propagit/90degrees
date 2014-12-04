<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('category_model');
		$this->load->model('product_model');
	}
	
	function index($category = "")
	{
		$records_per_page = RECORDS_PER_PAGE;
		$order = isset($_GET['order']) ? $_GET['order'] : 'name';	
		$cur_page = isset($_GET['p']) ? $_GET['p'] : 1;
		$data['order'] = $order;
		$data['cur_category'] = $category;
		
		$data['parent_categories'] = $this->category_model->get_parent_categories();	
		
		if($category){
			# get category info
			$category = $this->category_model->get_category_by_slug($category);
			if($category){
				$params = array(
									'category_id' => $category['category_id'],
									'cur_page' => $cur_page,
									'records_per_page' => $records_per_page,
									'order' => $order	
								);
	
				$data['products'] = $this->product_model->get_products_by_category($params);
				$total_products =  $this->product_model->get_products_by_category(array('category_id' => $category['category_id']));
			}else{
				show_404();
			}
				
		}else{
			show_404();	
		}
		
 		$data['breadcrumb'] = modules::run('common/breadcrumb', array(
					array('url' => '#', 'label' => 'Category'),
					array('url' => '#', 'label' => isset($category['name']) ? $category['name'] : '') # this check is not needed but kept to ensure it does not break
				));
		
		# pagination params	
		$url = '';
		if($order){
			$url = '?order=' . $order;		
		}
		if($cur_page){
			$url .= '&p=';	
		}
		$data['pagination_params'] = array(
											'records_per_page' => RECORDS_PER_PAGE,
											'total_records' => count($total_products),
											'current_page' => $cur_page,
											'url' => base_url().'category/' . $data['cur_category']  . $url	
										);
		
		$this->load->view('common/header', isset($data) ? $data : NULL);
		$this->load->view('catalog/categories', isset($data) ? $data : NULL);
		$data['add_js'] = $this->load->view('catalog/js', isset($data) ? $data : NULL, true);
		$this->load->view('common/footer', isset($data) ? $data : NULL);
	}
		
	function id($category_id)
	{
		return $this->category_model->get_category($category_id);
	}
}