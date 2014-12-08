<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shorturl extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	}

	public function index()
	{
		//取消重写VIEW
		//$this->view_override = FALSE;
		$this->load->helper('form');
		$this->load->view("product/shorturl");
	}

	public function get()
	{
		$this->load->helper('form');
		$long_url = $this->input->post('long_url');
		$this->load->library('mshorturl');
		$url_flag = $this->mshorturl->filterUrl($long_url);
		if($url_flag){
			$date['short_url'] = $this->mshorturl->sinaShortenUrl($url_flag);
		}else {

		}
		$this->load->view("product/shorturl",$date);
	}
	
	
}
