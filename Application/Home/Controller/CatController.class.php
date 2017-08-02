<?php
namespace Home\Controller;  
use Think\Controller;
/**
* 列表页控制器
*/
class CatController extends CommonController{
	
	public function index(){
		if(!$_GET['id'] || !is_numeric($_GET['id'])){
			return $this->error('url不合法');
		}
		$menu = D('Menu')->getMenuById($_GET['id']);
		if(!$menu || $menu['status'] !=1 || $menu['type'] != 0){
			return $this->error('该栏目不存在');
		}
		$id = $_GET['id'];
		
		if(is_file('./Application/Runtime/'.$id.'.html')){
			require_once('./Application/Runtime/'.$id.'.html');
		}else{
			$this->common($id);
	    	$this->buildHtml($id,HTML_PATH,'Cat/index');
			$this->display();
		}
		
	}
	public function build_html(){
			$menus = D('Menu')->getHomeTrueMenus();
			$error = array();
			foreach ($menus as $menu) {
				$this->common($menu['menu_id']);
	    		$res = $this->buildHtml($menu['menu_id'],HTML_PATH,'Cat/index');
	    		if(!$res){
	    			$error[] = $menu['menu_id'];
	    		}
			}
			if($error){
				return show(0,'更新失败-'.implode(',', $error));
			}
			return show(1,'更新成功');
	}
	public function common($id){
		$data1 = array('catid' => $id);
		$data5 = array('thumb' => array('neq',''));
		$pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 5;
		$newsCount = D('News')->getHomeNewsCount($data1);
		$ret = new \Think\Page($newsCount,$pageSize);//实例化分页操作类库
		$pageRes = $ret->show();
		$listNews = D('News')->getHomeNews($data1,$ret->firstRow,$ret->listRows);
		$data3 = array('position_id' => 4);
		$advNews = D('PositionContent')->select($data3,2);
		$rankNews = D('News')->getRank($data5,10);
		$this->assign('result',array(
	    	'listNews' => $listNews,
	    	'pageRes' => $pageRes,
	           'advNews' => $advNews,
	           'rankNews' => $rankNews,
	           'catid' => $id,
	    ));
	}
}