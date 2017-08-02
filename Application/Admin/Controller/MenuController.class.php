<?php
namespace Admin\Controller;
use Think\Controller;   
/**
 * 后台菜单相关
 */
class MenuController extends CommonController{
    public function index(){
        /**  
         * 分页操作逻辑
         */
        $data = array();
        if(isset($_REQUEST['type']) && in_array($_REQUEST['type'],array(0,1))){
            $data['type'] = intval($_REQUEST['type']);
            $this->assign('type',$data['type']);
        }else{
            $this->assign('type',-1);
        }
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 5;
        $menusCount = D('Menu')->getMenusCount($data);
        $ret = new \Think\Page($menusCount,$pageSize);//实例化分页操作类库
        $pageRes = $ret->show();
        $menus = D('Menu')->getMenus($data,$ret->firstRow,$ret->listRows);
        $this->assign('menus',$menus);
        $this->assign('pageRes',$pageRes);
        $this->display();
    }
    public function add(){   
        if($_POST){
            //传递数据过来时的操作
            if(!trim($_POST['name'])){
                show(0,'菜单名不能为空');
            }
            if(!trim($_POST['m'])){
                show(0,'模块名不能为空');
            }
            if(!trim($_POST['c'])){
                show(0,'控制器不能为空');
            }
            if(!trim($_POST['f'])){
                show(0,'方法不能为空');
            }
            if($_POST['menu_id']){//更新修改数据操作
                $menuId = $_POST['menu_id'];
                unset($_POST['menu_id']);
                try{
                    $id = D('Menu')->updateMenuById($menuId,$_POST);
                    if($id === false){
                        return show(0,'更新失败');
                    }
                    return show(1,'更新成功');
                }catch(Exception $e){
                    return show(0,$e->getMessage());
                }
                
                
            }
            $ret = D('Menu')->insertMenu($_POST);
            if($ret){
                return show(1,'添加成功');
            }
            return show(0,'添加失败');

        }else{
        $this->display();
            
        }
    }
    public function edit(){//修改操作
        $menuId = $_GET['id'];
        $menu = D('Menu')->getMenuById($menuId);
        $this->assign('menu',$menu);
        $this->display();
    }
    public function setStatus(){//删除操作
        if($_POST){
            $menuId = $_POST['id'];
            unset($_POST['id']);
            try{
                $id = D('Menu')->updateMenuById($menuId,$_POST);
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
    public function listorder(){//排序操作
        $listorder = $_POST['listorder'];
        $error = array();
        $jumpurl = $_SERVER['HTTP_REFERER'];
        if($listorder){
            try{
                foreach ($listorder as $key => $value) {
                    $data = array('listorder' => $value);
                    $id = D('Menu')->updateMenuById($key,$data);
                    if($id === false){
                        $error[] = $key; 
                    }
                }
            }catch(Exception $e){
                return show(0,$e->getMessage());
            }
            if($error){
               return show(0,'排序失败-'.implode(',', $error));
            }
            return show(1,'排序成功',array('jump_url' => $jumpurl));
        }
        return show(0,'排序失败');
    }
}