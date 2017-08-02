<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){

        $this->display();
      
    }
    public function check(){
    	$username = $_POST['username'];
    	$password = $_POST['password'];
        if (!trim($username)) {//强检验,trim函数过滤掉字符串中的空格字符
            return show(0,'用户名不能为空');
        } 
        if (!trim($password)){
            return show(0,'密码不能为空');
        
        }
        $ret = D('Admin')->getAdminByUsername($username);//通过用户名取出整条数据
        if(!$ret || $ret['status'] != 1){
        	return show(0,'用户名不存在');
        }
        if(getMd5Password($password) != $ret['password']){
        	return show(0,'密码错误');

        }
        $id = $ret['admin_id'];
        $data = array();
        $data['lastlogintime'] = time();
        D('Admin')->updateAdminById($id,$data);
        session('adminUser',$ret);
        return show(1,'登录成功');


    }
    public function logout(){
        session('adminUser',null);
        $this->redirect('/admin.php');
    }
}