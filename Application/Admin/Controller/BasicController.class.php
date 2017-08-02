<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 站点配置相关
*/
class BasicController extends CommonController{
	
	public function index(){   
		$res = D('Basic')->select();
		$this->assign('res',$res);
		$this->assign('type',1);
		$this->display();
	}
	public function add(){
		if($_POST){
			if(!trim($_POST['title'])){
				return show(0,'站点信息不能为空');
			}
			if(!trim($_POST['keywords'])){
				return show(0,'站点关键词不能为空');
			}
			if(!trim($_POST['description'])){
				return show(0,'站点描述不能为空');
			}
			D('Basic')->save($_POST);
			return show(1,'配置成功');
		}
		return show(0,'没有提交数据');
	}
	public function cache(){
		$this->assign('type',2);
		$this->display();
	}
}