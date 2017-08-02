<?php
namespace Common\Model;
use Think\Model;   
/**
*　操作数据表menu的模型类   
*/
class MenuModel extends Model{  
	private $_db = '';
	function __construct(){
		$this->_db = M('menu');
	}
	public function insertMenu($data = array()){
		if(!$data || !is_array($data)){ 
			return 0;
		}
		return $this->_db->data($data)->add();  
	}
	public function getMenus($data,$offset,$pageSize = 10){
	    $data['status'] = array('neq',-1);
	    $list = $this->_db->where($data)->order('listorder desc,menu_id desc')->limit($offset,$pageSize)->select();
	    return $list;
	}
	public function getMenusCount($data = array()){
	    $data['status'] = array('neq',-1);
	    return $this->_db->where($data)->count();
	}
	public function getMenuById($id){
		if(!$id || !is_numeric($id)){
			return array();
		}
		return $this->_db->where('menu_id='.$id)->find();
	}
	public function updateMenuById($id,$data){
		if(!$id || !is_numeric($id)){
			throw_exception("ID不合法");
		}
		if(!$data || !is_array($data)){
			throw_exception("更新的数据不合法");
		}
		return $this->_db->where('menu_id='.$id)->save($data);
	}
	public function getAdminMenus(){
		$data = array(
			'status' => 1,
			'type' => 1
		);
		return $this->_db->where($data)->order('listorder desc,menu_id desc')->select();
	}
	public function getHomeMenus(){
		$data = array(
			'status' => 1,
			'type' => 0
		);
		return $this->_db->where($data)->order('listorder desc,menu_id desc')->select();
	}
	public function getHomeTrueMenus(){//前台展示
		$data = array(
			'status' => 1,
			'type' => 0
		);
		return $this->_db->where($data)->order('listorder desc,menu_id desc')->select();
	}
	
}