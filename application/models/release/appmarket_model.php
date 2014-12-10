<?php	if (!defined('BASEPATH')) {exit('Access Denied');}
class Appmarket_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('release',true);
	}
	
	
	function getmarket(){
		
		
	}

	
	
	
	
}