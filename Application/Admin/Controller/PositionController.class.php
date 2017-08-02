<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 后台推荐位管理相关
 */
class PositionController extends CommonController{
    public function index(){
        /**  
         * 分页操作逻辑
         */
        $data = array();
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 5;
        $positionsCount = D('Position')->getPositionCount($data);
        $ret = new \Think\Page($positionsCount,$pageSize);//实例化分页操作类库
        $pageRes = $ret->show();
        $positions = D('Position')->getPosition($data,$ret->firstRow,$ret->listRows);
        $this->assign('positions',$positions);
        $this->assign('pageRes',$pageRes);
        $this->display();
    }
    public function add(){   
        if($_POST){
            //传递数据过来时的操作
            if(!trim($_POST['name'])){
                show(0,'推荐位名不能为空');
            }
            if($_POST['id']){//更新修改数据操作
                $positionId = $_POST['id'];
                unset($_POST['id']);
                try{
                    $id = D('Position')->updatePositionById($positionId,$_POST);
                    if($id === false){
                        return show(0,'更新失败');
                    }
                    return show(1,'更新成功');
                }catch(Exception $e){
                    return show(0,$e->getMessage());
                }
                
                
            }
            $ret = D('Position')->insertPosition($_POST);
            if($ret){
                return show(1,'添加成功');
            }
            return show(0,'添加失败');

        }else{
        $this->display();
            
        }
    }
    public function edit(){//修改操作
        $positionId = $_GET['id'];
        $position = D('Position')->getPositionById($positionId);
        $this->assign('position',$position);
        $this->display();
    }
    public function setStatus(){//删除操作
        if($_POST){
            $positionId = $_POST['id'];
            unset($_POST['id']);
            try{
                $id = D('Position')->updatePositionById($positionId,$_POST);
                if($id === false){
                    return show(0,'删除失败');
                }
                return show(1,'删除成功');
            }catch(Exception $e){
                return show(0,$e->getMessage());
            }
        }
        return show(0,'没有提交数据');
    }
   
}