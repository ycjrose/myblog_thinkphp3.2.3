<?php
namespace Common\Model;
use Think\Model;
/**
*　操作数据表news的模型类
*/
class NewsModel extends Model{
	private $_db = '';
	function __construct(){
		$this->_db = M('news');
	}
	public function insert($data = array()){
		if(!$data || !is_array($data)){
			return 0;
		}
		$data['create_time'] = time();
		$data['username'] = getLoginUsername();
		return $this->_db->data($data)->add();
	}
	public function getNews($data,$offset,$pageSize = 10){
		$data['status'] = array('neq',-1);
		if(isset($data['title']) && $data['title']){
			$data['title'] = array('like','%'.$data['title'].'%');
		}
		return $this->_db->where($data)->order('listorder desc,news_id desc')->limit($offset,$pageSize)->select();
	}
	public function getNewsCount($data = array()){
		$data['status'] = array('neq',-1);
		if(isset($data['title']) && $data['title']){
			$data['title'] = array('like','%'.$data['title'].'%');
		}
		return $this->_db->where($data)->count();
	}
	public function getNewsById($id){
		if(!$id){
			return 0;
		}
		$id = intval($id);
		return $this->_db->where('news_id='.$id)->find();
	}
	public function updateNewsById($id,$data = array()){
		if(!$id){
			return false;
		}
		if(!is_array($data) || !$data){
			return false;
		}
		$id = intval($id);
		$data['update_time'] = time();
		$data['username'] = getLoginUsername();
		return $this->_db->where('news_id='.$id)->data($data)->save();
	}
	public function getNewsByIds($ids){
		if(!$ids || !is_array($ids)){
			throw_exception('ID不合法');
		}
		$data = array(
			'news_id' => array('in',implode(',', $ids))
		);
		return $this->_db->where($data)->select();
	}
	public function select($data = array(),$page){//前台展示用
			if(!is_array($data) || !$data){
				return 0;
			} 
			$data['status'] = 1;
			return $this->_db->where($data)->order('listorder desc,news_id desc')->limit(0,$page)->select();
	}
	public function getRank($data = array(),$page){//前台排行新闻展示
		$data['status'] = 1;
		return $this->_db->where($data)->order('count desc,news_id desc')->limit(0,$page)->select();
	}
	public function getHomeNews($data,$offset,$pageSize = 10){//前台分页展示
		$data['status'] = 1;
		return $this->_db->where($data)->order('listorder desc,news_id desc')->limit($offset,$pageSize)->select();
	}
	public function getHomeNewsCount($data = array()){
		$data['status'] = 1;
		return $this->_db->where($data)->count();
	}
	public function updateNewsCount($id,$count){
		if(!$id){
			return false;
		}
		$id = intval($id);
		$data['count'] = $count;
		return $this->_db->where('news_id='.$id)->data($data)->save();
	}
	public function selectAll(){//更新所有新闻的静态页面 
			$data['status'] = 1;
			return $this->_db->where($data)->select();
	}
	public function getMaxCountNews(){
		$data = array(
			'status' => 1,	
		);
		return $this->_db->where($data)->order('count desc')->limit(1)->find();
	}
}