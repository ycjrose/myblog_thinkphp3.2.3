<?php
/**
 * 后台Index相关
 */
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController {
    
    public function index(){
    	$userCount = D('Admin')->getTodayCount();
    	$newsMax = D('News')->getMaxCountNews();
    	$newsCount = D('News')->getHomeNewsCount();
    	$positionCount = D('Position')->getPositionHomeCount();
    	$this->assign('userCount',$userCount);
    	$this->assign('newsMax',$newsMax);
    	$this->assign('newsCount',$newsCount);
    	$this->assign('positionCount',$positionCount);
    	$this->display();
    }
}