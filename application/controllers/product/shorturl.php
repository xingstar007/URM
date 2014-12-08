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
		$this->load->helper('shorturl');
		$url_flag = filterUrl($long_url);
		//print_r($url_flag);
		if($url_flag){
			$date['short_url'] = sinaShortenUrl($url_flag);
			$this->load->view("product/shorturl",$date);
		}else {
			$this->load->view("product/shorturl");
		}		
	}
	
	
}
