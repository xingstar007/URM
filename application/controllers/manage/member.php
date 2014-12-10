<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI RBAC
 * RBAC管理后台中用户模块
 * @author		toryzen
 * @link		http://www.toryzen.com
 */
class Member extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('rbac/member_model');
	}
	/**
	 * 人员列表
	 * @param number $page
	 */
	public function index($page=1)
	{
		$cnt_data = $this->member_model->getmembercount();
		//分页
		$this->load->library('pagination');
		$config['base_url'] = site_url("manage/member/index");
		$config['total_rows'] = $cnt_data['cnt'];
		$config['per_page']   = 35;
		$config['uri_segment']= '4';
		$config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config);
		$data = $this->member_model->getmemberlist($page,$config['per_page']);
		$this->load->view("manage/member",array("data"=>$data));
	}
	/**
	 * 人员修改
	 * @param number $id
	 */
	public function edit($id){
		$data = $this->member_model->getmemberrole($id);
		$role_data = $this->member_model->getrole();
		if($data){
			if($this->input->post()){
				$account = $this->input->post("account");
				$nickname = $this->input->post("nickname");
				$email = $this->input->post("email");
				$role = $this->input->post("role");
				$status = $this->input->post("status");
				$password = $this->input->post("password");
				$password2 = $this->input->post("password2");
				if($id>0){
					if($password==$password2){
						if($nickname&&$email){
							$this->member_model->updatamember($id,$password,$status,$role,$nickname,$email);
							success_redirct("manage/member/index","用户信息修改成功！");
						}else{
							error_redirct("","信息填写不全！");
						}
					}else{
						error_redirct("","新密码两次输入验证不符！");
					}
				}else{
					error_redirct("","未找到此用户");
				}
			}
			$this->load->view("manage/member/edit",array("data"=>$data,"role_data"=>$role_data));
		}else{
			error_redirct("manage/member/index","未找到此用户");
		}
	}
	/**
	 * 人员增加
	 */
	public function add(){
		$role_data = $this->member_model->getrole();
		if($this->input->post()){
			$username = $this->input->post("username");
			$nickname = $this->input->post("nickname");
			$email = $this->input->post("email");
			$role = $this->input->post("role");
			$status = $this->input->post("status");
			$password = md5($this->input->post("password"));
			$password2 = md5($this->input->post("password2"));
			if($password==$password2){
				if($username&&$nickname&&$email&&$password2){
					$result = $this->member_model->insertmember($username,$nickname,$email,$password2,$role,$status);
					if($result['flag']){
						success_redirct("manage/member/index","用户新增成功！");
					}else {
						error_redirct("",$result[msg]);
					}
				}else{
					error_redirct("","信息填写不全！");
				}
			}else{
				error_redirct("","新密码两次输入验证不符！");
			}
		}
		$this->load->view("manage/member/add",array("role_data"=>$role_data));
	}
	/**
	 * 人员删除
	 * @param number $id
	 */
	public function delete($id){
		$data = $this->member_model->getmember($id);
		if($data){
			if($this->input->post()){
				$verfiy = $this->input->post("verfiy");
				if($verfiy){
					$this->member_model->deletemember($id);
					success_redirct("manage/member/index","用户删除成功");
				}else{
					error_redirct("manage/member/index","操作失败");
				}
			}
			$this->load->view("manage/member/delete",array("data"=>$data));
		}else{
			error_redirct("manage/member/index","未找到此用户");
		}
	}

}
