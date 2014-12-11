<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI RBAC
 * RBAC后台管理中角色模块
 * @author		toryzen
 * @link		http://www.toryzen.com
 */
class Role extends CI_Controller 
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('rbac/role_model');
	}
	/**
	 * 角色首页
	 * @param number $page
	 */
	public function index($page=1)
	{
		$cnt_data = $this->role_model->getrolecount();
		//分页
		$this->load->library('pagination');
		$config['base_url'] = site_url("manage/role/index");
		$config['total_rows'] = $cnt_data['cnt'];
		$config['per_page']   = 35;
		$config['uri_segment']= '4';
		$config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config);
		
		$data = $this->role_model->getrolelist($page,$config['per_page']);
		$this->load->view("manage/role",array("data"=>$data));
	}
	
	/**
	 * 角色修改
	 * @param number $id
	 */
	public function edit($id)
	{
		$data = $this->role_model->getrolebyid($id);
		if($data)
		{
			if($this->input->post())
			{
				$rolename = $this->input->post("rolename");
				$status = $this->input->post("status")?1:0;
				if($rolename)
				{
					$result = $this->role_model->updaterole($rolename,$status,$id);
					if($result)
					{
						success_redirct("manage/role/index","角色信息修改成功！");
					}else {
						error_redirct("","角色信息修改失败");
					}
				}else{
					error_redirct("","信息填写不全！");
				}
			}
			$this->load->view("manage/role/edit",array("data"=>$data));
		}else{
			error_redirct("manage/role/index","未找到此角色");
		}
	}
	
	/**
	 * 角色新增
	 * @param number $id
	 */
	public function add()
	{
		if($this->input->post())
		{
			$rolename = $this->input->post("rolename");
			$status = $this->input->post("status")?1:0;
			if($rolename)
			{
				$data = $this->role_model->getrolebyname($rolename);
				if(!$data)
				{
					$result = $this->role_model->insertrole($rolename,$status);
					if($result)
					{
						success_redirct("manage/role/index","角色新增成功！");
					}else {
						error_redirct("","角色新增失败");
					}
				}else{
					error_redirct("","此角色名已存在！");
				}
			}else{
				error_redirct("","信息填写不全！");
			}
		}
		$this->load->view("manage/role/add");
	}
	
	/**
	 * 角色删除
	 * @param number $id
	 */
	public function delete($id)
	{
		$data = $this->role_model->getrolebyid($id);
		if($data)
		{
			if($this->input->post())
			{
				$verfiy = $this->input->post("verfiy");
				if($verfiy)
				{
					$result = $this->role_model->deleterole($id);
					if($result)
					{
						success_redirct("manage/role/index","角色删除成功");
					}else {
						error_redirct("manage/role/index","操作失败");
					}
				}else{
					error_redirct("manage/role/index","操作失败");
				}
			}
			$this->load->view("manage/role/delete",array("data"=>$data));
		}else{
			error_redirct("manage/role/index","未找到此角色");
		}
	}
	
	/**
	 * 角色赋权
	 * @param number $id
	 */
	public function action($id,$node_id=NULL)
	{
		if(!$id)
		{
			error_redirct("manage/role/index","未找到此角色");
		}
		if($node_id!=NULL)
		{
			$result = $this->role_model->authrole($node_id,$id);
			if($result)
			{
				success_redirct("","节点操作成功",1);
			}else {
				error_redirct("","节点操作失败");
			}
		}
		$node_list = $this->role_model->getnodelist();
		$role_node_list = $this->role_model->getrolenodelist($id);
		$this->load->view('manage/role/action',array('role_id'=>$id,'node'=>$node_list,'rnl'=>$role_node_list));
	}
	
}
