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
		$this->load->view("product/shorturl/sinashorturl");
	}

	public function getsinashorturl()
	{
		$this->load->helper('form');
		$long_url = $this->input->post('long_url');
		$this->load->library('myshorturl');
		$url_filter = $this->myshorturl->filterUrl($long_url);
		if($url_filter){
			$date['short_url_sina'] = $this->myshorturl->sinaShortenUrl($url_filter);
		}else {
			$date['error_sina'] = 'error';
		}
		$this->load->view("product/shorturl/sinashorturl",$date);
	}
		
}
