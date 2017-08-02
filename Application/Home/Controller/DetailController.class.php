<?php
namespace Home\Controller;
use Think\Controller;  
/**
* 文章页控制器
*/
class DetailController extends CommonController{
	
	public function index(){
		$id = $_GET['id'];
		if($id == 0){
			if(!$_GET['contentid'] || !is_numeric($id)){
				return $this->error('url地址不合法');
			}
			$advContent = D('PositionContent')->getPositionContentById($_GET['contentid']);
			if(!$advContent || $advContent['status'] != 1){
				return $this->error('站外链接失效');
			}
			Header("Location:".$advContent['url']);
		}
		if(!$id || !is_numeric($id)){
			return $this->error('url不合法');
		}
		$news = D('News')->getNewsById($id);
		if(!$news || $news['status'] != 1){
			return $this->error('文章不存在或已经被关闭');
		}
		$newsCount = intval($news['count'])+1;
		D('News')->updateNewsCount($id,$newsCount);//更新阅读数
		if(is_file('./Application/Runtime/content'.$id.'.html')){//静态页面判断
			require_once('./Application/Runtime/content'.$id.'.html');
		}else{
			$this->common($id);
	    	$this->buildHtml('content'.$id,HTML_PATH,'Detail/index');
			$this->display('Detail/index');
		}
		
	}
	
	public function view(){
		if(!getLoginUsername()){
			return $this->error('没有访问权限');
		}
		$id = $_GET['id'];
		if(!$id || !is_numeric($id)){
			return $this->error('url不合法');
		}
		$news = D('News')->getNewsById($id);
		if(!$news || $news['status'] == -1){
			return $this->error('文章不存在');
		}
		$this->common($id);
		$this->display('Detail/index');
	}
	public function build_html(){
		$news = D('News')->selectAll();
		$error = array();
		foreach ($news as $value) {
			$this->common($value['news_id']);
			$res = $this->buildHtml('content'.$value['news_id'],HTML_PATH,'Detail/index');
			if(!$res){
				$error[] = $value['news_id'];
			}
		}
		if($error){
			return show(0,'更新失败-'.implode(',', $error));
		}
		return show(1,'更新成功');

	}
	public function common($id){
		$data5 = array('thumb' => array('neq',''));
		$news = D('News')->getNewsById($id);
		$newsContent = D('NewsContent')->getNewsContentById($id);
		$news['content'] = htmlspecialchars_decode($newsContent['content']);//从内容表获取文章内容信息
		$data3 = array('position_id' => 4);
		$advNews = D('PositionContent')->select($data3,2);
		$rankNews = D('News')->getRank($data5,10);
		$this->assign('result',array(
	           'advNews' => $advNews,
	           'rankNews' => $rankNews,
	           'news' => $news,
	           'catid' => $news['catid'],
	    ));
	}
}