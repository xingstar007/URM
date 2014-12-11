<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Role_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('release',true);
	}
	
	
	function getrolecount()
	{
		$sql = "SELECT COUNT(1) as cnt FROM rbac_role";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	
	function getrolelist($page,$per_page)
	{
		$sql = "SELECT * FROM rbac_role 
				LIMIT ".(($page-1)*$per_page).",".$per_page;
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function getrolebyid($id)
	{
		$sql = "SELECT * FROM rbac_role WHERE id = ".$id;
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	
	function updaterole($rolename,$status,$id)
	{
		$sql = "UPDATE rbac_role set `rolename`='{$rolename}',`status`='{$status}' WHERE id = {$id}";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	function getrolebyname($rolename)
	{
		$sql = "SELECT * FROM rbac_role WHERE rolename = '".$rolename."'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	
	function insertrole($rolename,$status)
	{
		$sql = "INSERT INTO rbac_role (`rolename`,`status`)
				values('{$rolename}','{$status}')";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	function deleterole($id)
	{
		$sql = "DELETE FROM `rbac_role` WHERE id = ".$id." ";
		$this->db->query($sql);
		$result_one = $this->db->affected_rows();
		$sql = "DELETE FROM `rbac_auth` WHERE role_id = ".$id." ";
		$this->db->query($sql);
		$result_two = $this->db->affected_rows();
		return $result_one||$result_two;
	}
	
	function authrole($node_id,$id)
	{
		$sql = "SELECT node_id FROM rbac_auth WHERE node_id= {$node_id} AND role_id={$id}";
		$query = $this->db->query($sql);
		$data = $query->row_array();
		if($data)
		{
			$sql = "DELETE FROM rbac_auth WHERE node_id= {$node_id} AND role_id={$id}";
		}else{
			$sql = "INSERT INTO rbac_auth (`node_id`,`role_id`) values('{$node_id}','{$id}')";
		}
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	function getnodelist()
	{
		$rbac_where = "";
		$node_hidden_array = $this->config->item('rbac_manage_node_hidden');
		if(!empty($node_hidden_array))
		{
			$rbac_where = "WHERE ";
			foreach($node_hidden_array as $node_hidden)
			{
				$rbac_where.= "dirc != '$node_hidden' AND ";
			}
			$rbac_where = substr($rbac_where,0,-4);
		}
		$query = $this->db->query("SELECT * FROM rbac_node {$rbac_where} ORDER BY dirc,cont,func");
		$data = $query->result();
		foreach($data as $vo)
		{
			$node_list[$vo->dirc][$vo->cont][$vo->func] = $vo;
		}
		return $node_list;
	}
	
	function getrolenodelist($id)
	{
		$sql = "SELECT id,dirc,cont,func 
				FROM `rbac_node` 
				WHERE id in (SELECT node_id FROM `rbac_auth` WHERE role_id = ".$id.")";
		$query = $this->db->query($sql);
		$role_data = $query->result();
		$role_node_list = array();
		foreach($role_data as $vo){
			$role_node_list[$vo->dirc][$vo->cont][$vo->func] = TRUE;
		}
		return $role_node_list;
	}
	
	
	
}