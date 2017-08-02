<?php
/**
 * 后台文章管理相关
 */
namespace Admin\Controller;
use Think\Controller;
class PositioncontentController extends CommonController {
    
    public function index(){
    	/**
        * 分页逻辑
        */
        $this->assign('positioncontents',D('Position')->select());
        $condition = array();
        if($_GET['position_id']){
            $condition['position_id'] = intval($_GET['position_id']);
            $this->assign('position_id',$condition['position_id']);
        }
        if($_GET['title']){
            $condition['title'] = $_GET['title'];
            $this->assign('title2',$condition['title']);
        }
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 5;
        $contentsCount = D('PositionContent')->getPositionContentCount($condition);
        $res = new \Think\Page($contentsCount,$pageSize);
        $pageRes = $res->show();
        $contents = D('PositionContent')->getPositionContent($condition,$res->firstRow,$res->listRows);
        $this->assign('contents',$contents);
        $this->assign('pageRes',$pageRes);
    	$this->display();
    }    

    public function add() {
    	if($_POST){
    		if(!trim($_POST['title'])){
    			return show(0,'标题不能为空');
    		}
    		if(!trim($_POST['position_id'])){
    			return show(0,'请选择推荐位！');
    		}
    	    if(trim($_POST['url']) && trim($_POST['news_id'])){
                return show(0,'url与文章id只能填一项');
            }
            if(!trim($_POST['url']) && !trim($_POST['news_id'])){
                return show(0,'url与文章id不能同时为空');
            }
            if($_POST['news_id']){
               
                   $res = D('News')->getNewsById($_POST['news_id']);
                   if($res && is_array($res)){
                       $_POST['thumb'] = $res['thumb'];
                   } 
                
            }
            if($_POST['id']){//更新修改操作
                $updateContentId = $_POST['id'];
                unset($_POST['id']);
                try{
                    $res = D('PositionContent')->updatePositionContentById($updateContentId,$_POST);
                    if($res === false){
                        return show(0,'更新失败');
                    }
                    return show(1,'更新成功');
                }catch(Exception $e){
                    return show(0,$e->getMessage());
                }
                
            }
    		$positionId = D('PositionContent')->insert($_POST);
    		if($positionId){
    				return show(1,'新增成功');
    		}
    		return show(0,'新增失败');

    	}
    	$positions = D('Position')->select();
    	$this->assign('positions',$positions);
    	$this->display();
    }
    public function edit(){
        if($_GET['id']){
            $content = D('PositionContent')->getPositionContentById($_GET['id']);
            if(!$content){
                $this->redirect('/admin.php?c=positioncontent');
            }
            
            $this->assign('content',$content);
        }
        $positions = D('Position')->select();
        $this->assign('positions',$positions);
        $this->display();
    }
    public function setStatus(){
        if($_POST){
            $contentId = $_POST['id'];
            unset($_POST['id']);
            $_POST['status'] = intval($_POST['status']);
            $res = D('PositionContent')->updatePositionContentById($contentId,$_POST);
            if($res === false){
                return show(0,'操作失败');
            }
            return show(1,'操作成功');
        }
        return show(0,'没有提交数据');
    }

    public function listorder(){
        if($_POST){
            $listorder = $_POST['listorder'];
            $jumpurl = $_SERVER['HTTP_REFERER'];
            $error = array();
            $content = D('PositionContent');
            if($listorder){
                foreach ($listorder as $key => $value) {
                    $data = array('listorder' => $value);
                    $res = $content->updatePositionContentById($key,$data);
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
   

}