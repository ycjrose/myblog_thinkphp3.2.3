<?php
namespace Common\Model;
use Think\Model;
/**
*　操作数据表position_content的模型类   
*/
class PositionContentModel extends Model{
	private $_db = '';
	function __construct(){
		$this->_db = M('position_content');
	}
	public function insert($data = array()){
		if(!$data || !is_array($data)){
			throw_exception('插入的数据不合法');
		}
		$data['create_time'] = time();
		return $this->_db->data($data)->add();  
	}
	public function getPositionContent($data,$offset,$pageSize = 10){
	    $data['status'] = array('neq',-1);
	    if(isset($data['title']) && $data['title']){
	    	$data['title'] = array('like','%'.$data['title'].'%');
	    }
	    $list = $this->_db->where($data)->order('listorder desc,id desc')->limit($offset,$pageSize)->select();
	    return $list;
	}
	public function getPositionContentCount($data = array()){
	    $data['status'] = array('neq',-1);
	    if(isset($data['title']) && $data['title']){
	    	$data['title'] = array('like','%'.$data['title'].'%');
	    }
	    return $this->_db->where($data)->count();
	}
	public function getPositionContentById($id){
		if(!$id || !is_numeric($id)){
			return array();
		}
		return $this->_db->where('id='.$id)->find();
	}
	public function updatePositionContentById($id,$data){
		if(!$id || !is_numeric($id)){
			throw_exception("ID不合法");
		}
		if(!$data || !is_array($data)){
			throw_exception("更新的数据不合法");
		}
		$data['update_time'] = time();
		return $this->_db->where('id='.$id)->save($data);
	}
	public function select($data = array(),$page){//前台展示用
		if(!is_array($data) || !$data){
			return 0;
		} 
		$data['status'] = 1;
		return $this->_db->where($data)->order('listorder desc,id desc')->limit(0,$page)->select();
	}

}