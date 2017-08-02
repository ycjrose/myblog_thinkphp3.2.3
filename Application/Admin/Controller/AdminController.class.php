<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 管理用户控制器
*/
class AdminController extends CommonController{
	public function index(){

			$admins = D('Admin')->select();
			$this->assign('admins',$admins);
			$this->display();
		
		
	}
	public function add(){
		if($_POST){
			if(!trim($_POST['username'])){
				return show(0,'用户名不能为空');
			}
			if(!trim($_POST['password'])){
				return show(0,'密码不能为空');
			}
			if(!trim($_POST['realname'])){
				return show(0,'真实姓名不能为空');
			}
			
				

			$_db = D('Admin');
			$ret = $_db->getAdminByUsername($_POST['username']);
			if(!empty($ret)){
				return show(0,'该用户已存在');
			}
			$pwdmd5 = getMd5Password($_POST['password']);
			$_POST['password'] = $pwdmd5;
			$enroll = $_db->setAdmin($_POST);
			if($enroll){
				return show(1,'注册成功');
			}
			return show(0,'注册失败');
		}
		return $this->display();
	}
	public function setStatus(){//删除操作
	    if($_POST){
	        $adminId = $_POST['id'];
	        unset($_POST['id']);
	        try{
	            $id = D('Admin')->updateAdminById($adminId,$_POST);
	            if($id === false){
	                return show(0,'操作失败');
	            }
	            return show(1,'操作成功');
	        }catch(Exception $e){
	            return show(0,$e->getMessage());
	        }
	    }
	    return show(0,'没有提交数据');
	}
	public function personal(){
		$admin = $this->getLoginUser();
		$vo = D('Admin')->getAdminById($admin['admin_id']);
		$this->assign('vo',$vo);
		$this->display();
	}
	public function save(){
		$admin = $this->getLoginUser();
		if(!$admin){
			return show(0,'请登录');
		}
		try{
			$res = D('Admin')->updateAdminById($admin['admin_id'],$_POST);
			if($res === false){
				return show(0,'更新失败');
			}
		}catch(Exception $e){
			return show(0,$e->getMessage());
		}
		return show(1,'更新成功');
	}
	
}