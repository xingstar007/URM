<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Node_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('release',true);
	}
	
	function getnodelist()
	{
		$rbac_where = "";
		$node_hidden_array = $this->config->item('rbac_manage_node_hidden');
		if(!empty($node_hidden_array)){
			$rbac_where = "WHERE ";
			foreach($node_hidden_array as $node_hidden){
				$rbac_where.= "dirc != '$node_hidden' AND ";
			}
			$rbac_where = substr($rbac_where,0,-4);
		}
		$query = $this->db->query("SELECT * FROM rbac_node {$rbac_where} ORDER BY dirc,cont,func");
		return $query->result();
	}

	function  insternode($dirc,$cont,$func,$status,$memo)
	{
		$sql = "SELECT id FROM rbac_node 
				WHERE dirc = '".$dirc."' AND cont = '".$cont."' AND func = '".$func."'";
		$query = $this->db->query($sql);
		$data = $query->row_array();
		if(!$data){
			$sql = "INSERT INTO rbac_node (`dirc`,`cont`,`func`,`status`,`memo`)
					values('{$dirc}','{$cont}','{$func}','{$status}','{$memo}')";
			//echo $sql;die();
			$this->db->query($sql);
			if($this->db->affected_rows())
			{
				$result['flag'] = true;
				$result['msg'] = '节点添加成功！';
			}else {
				$result['flag'] = false;
				$result['msg'] = '数据库新增失败';
			}
		}else{
			$result['flag'] = false;
			$result['msg'] = '该节点已存在！';
		}
		return $result;
	}
	
	function deletenode($where_dirc,$where_cont,$where_func)
	{
		$sql = "SELECT GROUP_CONCAT(id) as node_id 
				FROM rbac_node WHERE {$where_dirc} {$where_cont} {$where_func}";
		$query = $this->db->query($sql);
		$node_list = $query->row_array();
		$sql = "UPDATE rbac_menu SET node_id = NULL WHERE node_id in (".$node_list['node_id'].")";
		$this->db->query($sql);
		$sql = "DELETE FROM rbac_node 
				WHERE {$where_dirc} {$where_cont} {$where_func} ";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	function getnode($id)
	{
		$sql = "SELECT * FROM rbac_node WHERE id = ".$id;
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	
	
	function updatenode($memo,$status,$id)
	{
		$sql = "UPDATE rbac_node set `memo`='{$memo}',`status` = '{$status}' WHERE id = {$id}";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	
}