<?php
namespace Common\Model;
use Think\Model;
/**
*　操作数据表position的模型类   
*/
class PositionModel extends Model{
	private $_db = '';
	function __construct(){
		$this->_db = M('position');
	}
	public function insertPosition($data = array()){
		if(!$data || !is_array($data)){
			return 0;
		}
		$data['create_time'] = time();
		return $this->_db->data($data)->add();  
	}
	public function getPosition($data,$offset,$pageSize = 10){
	    $data['status'] = array('neq',-1);
	    $list = $this->_db->where($data)->order('id asc')->limit($offset,$pageSize)->select();
	    return $list;
	}
	public function getPositionCount($data = array()){
	    $data['status'] = array('neq',-1);
	    return $this->_db->where($data)->count();
	}
	public function getPositionById($id){
		if(!$id || !is_numeric($id)){
			return array();
		}
		return $this->_db->where('id='.$id)->find();
	}
	public function updatePositionById($id,$data){
		if(!$id || !is_numeric($id)){
			throw_exception("ID不合法");
		}
		if(!$data || !is_array($data)){
			throw_exception("更新的数据不合法");
		}
		$data['update_time'] = time();
		return $this->_db->where('id='.$id)->save($data);
	}
	public function select(){
		$data['status'] = array('neq',-1);
		return $this->_db->where($data)->order('id asc')->select();
	}
	public function getPositionHomeCount(){
		$data = array('status' => 1);
	    return $this->_db->where($data)->count();
	}
	
}