<?php
/**
 * 后台文章管理相关
 */
namespace Admin\Controller;
use Think\Controller;
class ContentController extends CommonController {
    
    public function index(){
    	/**
        * 分页逻辑
        */
        $this->assign('homeMenus',D('Menu')->getHomeMenus());
        $condition = array();
        if($_GET['catid']){
            $condition['catid'] = intval($_GET['catid']);
            $this->assign('catid2',$condition['catid']);
        }
        if($_GET['title']){
            $condition['title'] = $_GET['title'];
            $this->assign('title2',$condition['title']);
        }
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 5;
        $newsCount = D('News')->getNewsCount($condition);
        $res = new \Think\Page($newsCount,$pageSize);
        $pageRes = $res->show();
        $positions = D('Position')->select();
        $news = D('News')->getNews($condition,$res->firstRow,$res->listRows);
        $this->assign('positions',$positions);
        $this->assign('news',$news);
        $this->assign('pageRes',$pageRes);
    	$this->display();
    }    

    public function add() {
    	if($_POST){
    		if(!trim($_POST['title'])){
    			return show(0,'标题不能为空');
    		}
    		if(!trim($_POST['catid'])){
    			return show(0,'请选择栏目！');
    		}
    		if(!trim($_POST['copyfrom'])){
    			return show(0,'请选择来源！');
    		}
    		if(!trim($_POST['content'])){
    			return show(0,'内容不能为空');
    		}
    		if(!trim($_POST['description'])){
    			return show(0,'描述不能为空');
    		}
            
            if($_POST['news_id']){//更新修改操作
                $updateNewsId = $_POST['news_id'];
                unset($_POST['news_id']);
                $res = D('News')->updateNewsById($updateNewsId,$_POST);
                $contentData['content'] = $_POST['content'];
                $res2 = D('NewsContent')->updateNewsContentById($updateNewsId,$contentData);
                if($res === false || $res2 === false){
                    return show(0,'更新失败');
                }
                return show(1,'更新成功');
            }
    		$newsId = D('News')->insert($_POST);
    		if($newsId){
    			$contentData['news_id'] = $newsId;
    			$contentData['content'] = $_POST['content'];
    			$newsContentId = D('NewsContent')->insert($contentData);
    			if($newsContentId){
    				return show(1,'新增成功');
    			}
    			return show(0,'增加内容失败');
    		}
    		return show(0,'新增失败');

    	}
    	$homeMenus = D('Menu')->getHomeMenus();
    	$titleFontColor = C('TITLE_FONT_COLOR');
    	$copyFrom = C('COPY_FROM');
    	$this->assign('titleFontColor',$titleFontColor);
    	$this->assign('copyFrom',$copyFrom);
    	$this->assign('homeMenus',$homeMenus);
    	$this->display();
    }
    public function edit(){
        if($_GET['id']){
            $news = D('News')->getNewsById($_GET['id']);
            if(!$news){
                $this->redirect('/admin.php?c=content');
            }
            $newsContent = D('NewsContent')->getNewsContentById($_GET['id']);
            if($newsContent){
                $news['content'] = $newsContent['content'];
            }
            $this->assign('news',$news);
        }
        $homeMenus = D('Menu')->getHomeMenus();
        $titleFontColor = C('TITLE_FONT_COLOR');
        $copyFrom = C('COPY_FROM');
        $this->assign('titleFontColor',$titleFontColor);
        $this->assign('copyFrom',$copyFrom);
        $this->assign('homeMenus',$homeMenus);
        $this->display();
    }
    public function setStatus(){
        if($_POST){
            $newsId = $_POST['id'];
            unset($_POST['id']);
            $_POST['status'] = intval($_POST['status']);
            $res = D('News')->updateNewsById($newsId,$_POST);
            if($res === false){
                return show(0,'操作失败');
            }
            return show(1,'操作成功');
        }
        return show(0,'没有提交数据');
    }
    public function setStatusSelect(){
        if($_POST){
            $pushcheck = $_POST;
            $news = D('News');
            $error = array();
            
                foreach ($pushcheck as $value) {
                    $data = array('status' => -1);
                    $res = $news->updateNewsById($value,$data);
                    if($res === false){
                        $error[] = $value; 
                    }
                }
                if($error){
                    return show(0,'删除失败-'.implode(',', $error));
                }
                return show(1,'删除成功');
            
        }
        return show(0,'没有提交数据');
    }
    public function listorder(){
        if($_POST){
            $listorder = $_POST['listorder'];
            $jumpurl = $_SERVER['HTTP_REFERER'];
            $error = array();
            $news = D('News');
            if($listorder){
                foreach ($listorder as $key => $value) {
                    $data = array('listorder' => $value);
                    $res = $news->updateNewsById($key,$data);
                    if($res === false){
                        $error[] = $key;
                    }
                }
                if($error){
                    return show(0,'排序失败-'.implode(',', $error));
                }
                return show(1,'排序成功',array('jump_url' => $jumpurl));
            }
            return show(0,'排序失败');
        }
        return show(0,'没有提交数据');
    }
    public function push(){
        $positionId = $_POST['position_id'];
        $newsIds = $_POST['push'];
        if(!$positionId){
            return show(0,'没有选择推荐位');
        } 
        if(!$newsIds || !is_array($newsIds)){
            return show(0,'没有选择新闻');
        }
        $jumpurl = $_SERVER['HTTP_REFERER'];
        try{
            $news = D('News')->getNewsByIds($newsIds);
            if(!$news){
                return show(0,'没有相关内容');
            }
            foreach ($news as $new) {
                $data = array(
                    'position_id' => $positionId,
                    'title' => $new['title'],
                    'thumb' => $new['thumb'],
                    'news_id' => $new['news_id'],
                    'status' => 1,
                );
                $res = D('PositionContent')->insert($data);
            }
            return show(1,'推送成功',array('jump_url' => $jumpurl));
        }catch(Exception $e){
            return show(0,$e->getMessage());
        }

    }

}