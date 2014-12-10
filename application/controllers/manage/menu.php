<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI RBAC
 * RBAC管理后台中菜单模块
 * @author		toryzen
 * @link		http://www.toryzen.com
 */
class Menu extends CI_Controller 
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('rbac/menu_model');
	}

	/**
	 * 菜单主页
	 */
	public function index()
	{
		$menu_data = $this->menu_model->get_menu_list();
		$this->load->view("manage/menu",$menu_data);
	}
	
	/**
	 * 菜单删除
	 */
	public function delete($id)
	{
		if($this->menu_model->check_menu($id))
		{
			//获取当前节点及其子节点
			$menu_data = $this->menu_model->get_menu_list($id);
			if($this->input->post())
			{
				$verfiy = $this->input->post("verfiy");
				$this->menu_model->delete_menu($menu_data);
				success_redirct("manage/menu/index","菜单删除成功");
			}
			$this->load->view("manage/menu/delete",$menu_data);
		}else{
			error_redirct("manage/menu/index","未找到此菜单");
		}
	}
	
	/**
	 * 菜单新增
	*/
	public function add($id,$level,$p_id)
	{
		if($this->input->post())
		{
			$title = $this->input->post("title");
			$sort = $this->input->post("sort");
			$node = $this->input->post("node");
			$level = $this->input->post("level");
			if($id&&$level)
			{
				if($title)
				{
					$p_id   = $this->input->post("p_id");
					$status = $this->input->post("status")==""?"0":"1";
					$this->menu_model->add_menu($status,$title,$sort,$node,$p_id);
					success_redirct("manage/menu/index","新增菜单成功！");
				}else{
					error_redirct("","标题不能为空！");
				}
			}else{
				error_redirct("","参数不正确！");
			}
		}
		$node_data = $this->menu_model->show_node();
		$this->load->view("manage/menu/add",array("node"=>$node_data,"level"=>$level,"p_id"=>$p_id));
	}
	
	/**
	 * 菜单修改
	 */
	public function edit($id,$level,$p_id="NULL"){
		if($this->input->post())
		{
			$id = $this->input->post("id");
			$title = $this->input->post("title");
			$sort = $this->input->post("sort");
			$node = $this->input->post("node");
			$level = $this->input->post("level");
			if($id&&$level)
			{
				if($title)
				{
					$p_id   = $this->input->post("p_id")=="NULL"?"p_id = NULL":"p_id='{$p_id}'";
					$status = $this->input->post("status")==""?"status='0'":"status='1'";
					$this->menu_model->update_menu($status,$title,$sort,$node,$p_id,$id);
					success_redirct("manage/menu/index","菜单修改成功！");
				}else{
					error_redirct("","标题不能为空！");
				}
			}else{
				error_redirct("","参数不正确！");
			}
		}
		$data = $this->menu_model->check_menu($id);
		if($data)
		{	
			$node_data = $this->menu_model->show_node();
			$this->load->view("manage/menu/edit",array("data"=>$data,"node"=>$node_data,"level"=>$level,"p_id"=>$p_id));
		}else{
			error_redirct("manage/menu/index","未找到此菜单");
		}
	}
	
}
