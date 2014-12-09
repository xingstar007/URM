<?php	if (!defined('BASEPATH')) {exit('Access Denied');}
class Release extends CI_Controller {
				
	function __construct()
	{
		parent::__construct();
		$this->load->model('Release_model');
		$this->load->helper('array');
		$this->load->library('table');
	}
	
	function index()
	{
		$projectlist = $this->Release_model->get_all_project();
		$page_data['project_list'] = $projectlist;
		$this->load->view('product/release/project_page',$page_data);
	}
	
	function version($project_id)
	{					
		$version_page_data['page_title'] = $this->Release_model->get_project_name($project_id);
		$version_page_data['project_id'] = $project_id;
		
		$version_type = $this->Release_model->get_version_count($project_id);
		if(count($version_type)>0){
			for ($i =0 ; $i < count($version_type);$i++)
			{
				$versionlist[$i] = $this->Release_model->get_project_version($project_id,$version_type[$i]);		
			}
			$version_page_data['version_type'] = $version_type;
			$version_page_data['version_list'] = $versionlist;
		}
		$this->load->view('product/release/version_page',$version_page_data);	
	}

	function add_version($project_id)
	{
		$this->load->library('input');
		$this->load->helper('form');
		$date['project_id'] = $project_id;
		$this->load->view('product/release/add_version',$date);		
	}
	
	function create_version_submit($project_id)
	{
		$this->load->library('form_validation');
		
		$version_type = $this->input->post('version_type');
		$version_name = $this->input->post('version_name');
		$publish_flag = $this->input->post('publish-flag');
		
		if($publish_flag)
		{
			$is_publish = 1;
		}else {
			$is_publish = 0;
		}
		
		if(($project_id =='')||$version_type==''||$version_name =='')
		{
			error_redirct("","资料不全");
		}
		else
		{
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'apk';
			$config['max_size'] = '64000000';
			$config['encrypt_name'] = 'TRUE';
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('product')) 
			{
				print_r ( array('error' => $this->upload->display_errors()));

				error_redirct("","上传失败");
			}else {
				$product = $this->upload->data();
				$file_name = $product['full_path'];
				$file_url = base_url().'uploads/'.$product['file_name'];
					
				$this->load->helper('date');
				$version_date =  mdate("%Y-%m-%d", time());
					
				$this->Release_model->insert_version($version_name,$version_date,$project_id,$file_name,$file_url,$version_type,$is_publish);
				
				success_redirct("product/release/version/".$project_id,"新增成功！");
			}
			
		}
						
	}
	
	public function version_delete($del_version_id)
	{
		$del_result = $this->Release_model->delete_version($del_version_id);
		if($del_result == 0){
			error_redirct("","删除失败");
		}else {
			success_redirct("","删除成功！");
		}		
	}
	
	public function version_publish()
	{
		$this->load->library('input');
		$version_id = $this->input->post('version_id');
		$result = $this->Release_model->update_version_publish($version_id);
 		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($result);
	}

}