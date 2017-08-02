<?php
namespace Common\Model;
use Think\Model;
/**
*　操作数据表news_content的模型类
*/
class NewsContentModel extends Model{
	private $_db = '';
	function __construct(){
		$this->_db = M('news_content');
	}
	public function insert($data = array()){
		if(!$data || !is_array($data)){
			return 0;
		}
		$data['create_time'] = time();
		if(isset($data['content']) && $data['content']){
			$data['content'] = htmlspecialchars($data['content']);
		}
		return $this->_db->data($data)->add();
	}
	public function getNewsContentById($id){
		if(!$id){
			return 0;
		}
		$id = intval($id);
		return $this->_db->where('news_id='.$id)->find();
	}
	public function updateNewsContentById($id,$data = array()){
		if(!$id){
			return false;
		}
		if(!$data || !is_array($data)){
			return false;
		}
		$id = intval($id);
		$data['update_time'] = time();
		if(isset($data['content']) && $data['content']){
			$data['content'] = htmlspecialchars($data['content']);
		}
		return $this->_db->where('news_id='.$id)->save($data);
	}

}