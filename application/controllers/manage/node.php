<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI RBAC
 * RBAC后台管理中节点模块
 * @author		toryzen
 * @link		http://www.toryzen.com
 */
class Node extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('rbac/node_model');
	}
	/**
	 * 节点首页
	 */
	public function index()
	{
		$data = $this->node_model->getnodelist();
		foreach($data as $vo){
			$node_list[$vo->dirc][$vo->cont][$vo->func] = $vo;
		}
		$this->load->view('manage/node',array('node'=>$node_list));
	}
	/**
	 * 新增节点
	 * @param string $dirc
	 * @param string $cont
	 * @param string $func
	 */
	public function add($dirc=NULL,$cont=NULL,$func=NULL)
	{
		if($this->input->post())
		{
			$dirc = $this->input->post("dirc")?$this->input->post("dirc"):$dirc;
			$cont = $this->input->post("cont")?$this->input->post("cont"):$cont;
			$func    = $this->input->post("func");
			$memo   = $this->input->post("memo");
			$status   = $this->input->post("status")==1?1:0;
			if($dirc&&$cont&&$func&&$memo)
			{
				$result = $this->node_model->insternode($dirc,$cont,$func,$status,$memo);
				if($result['flag']){
					success_redirct('manage/node/index',$result['msg']);
				}else {
					error_redirct('',$result['msg']);
				}
			}else{
				error_redirct('',"信息填写不全！");
			}
		}
		$this->load->view('manage/node/add',array('dirc'=>$dirc,'cont'=>$cont,'func'=>$func));
	}
	/**
	 * 删除节点
	 * @param string $dirc
	 * @param string $cont
	 * @param string $func
	 */
	public function delete($dirc=NULL,$cont=NULL,$func=NULL)
	{
		if($dirc==NULL)
		{
			error_redirct("manage/node/index","操作失败");
		}
		if($this->input->post())
		{
			$verfiy = $this->input->post("verfiy");
			if($verfiy)
			{
				$where_dirc = "dirc = '{$dirc}'";
				$where_cont = $cont==NULL?"":" AND cont = '{$cont}'";
				$where_func = $func==NULL?"":" AND func = '{$func}'";
				$result = $this->node_model->deletenode($where_dirc,$where_cont,$where_func);
				if($result){
					success_redirct("manage/node/index","删除成功");
				}else {
					error_redirct("manage/node/index","操作失败");
				}	
			}else{
				error_redirct("manage/node/index","操作失败");
			}
		}
		$this->load->view('manage/node/delete',array('dirc'=>$dirc,'cont'=>$cont,'func'=>$func));
	}
	/**
	 * 修改节点
	 * @param unknown $id
	 */
	public function edit($id)
	{
		$data = $this->node_model-> getnode($id);
		if($data)
		{
			if($this->input->post())
			{
				$memo   = $this->input->post("memo");
				$status   = $this->input->post("status")==1?1:0;
				if($memo)
				{
					$result = $this->node_model->updatenode($memo,$status,$id);
					if($result)
					{
						success_redirct("manage/node/index","节点修改成功");
					}else {
						error_redirct("manage/node/index","节点修改失败");
					}
				}else{
					error_redirct('',"信息填写不全！");
				}
			}
			$this->load->view("manage/node/edit",array('data'=>$data));
		}else{
			error_redirct("manage/node/index","未找到此节点");
		}
	}

}
