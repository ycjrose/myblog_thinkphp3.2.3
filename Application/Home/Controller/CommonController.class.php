<?php
namespace Home\Controller;
use Think\Controller;
/**
* 前台公共模块
*/
class CommonController extends Controller{
	
	function __construct(){
		parent::__construct();
	}
	/**
	* 弹出错误404页面
	*/
	public function error($message = ''){
		$message = $message ? $message : '系统出现错误';
		$this->assign('message',$message);
		$this->display('Index/error');
	} 
}