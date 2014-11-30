<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Ajax URL
 *
 * @access	public
 * @param string
 * @return	string
 */
if ( ! function_exists('ajax_url'))
{
	function ajax_url()
	{
		$CI =& get_instance();
		return $CI->config->base_url() . ROOT_PATH;
	}
}

// ------------------------------------------------------------------------
