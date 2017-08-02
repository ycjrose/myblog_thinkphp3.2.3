<?php
namespace Common\Model;
use Think\Model;
/**   
* 操作数据表Admin的模型类
*/
class AdminModel extends Model{
	
	private $_db = '';//储存实例化后的操作数据库对象
	function __construct()
	{
		$this->_db = M('admin');
    }
    public function getAdminByUsername($username){
    	return $this->_db->where('username="'.$username.'"')->find();
    }
    public function getAdminById($id){
        return $this->_db->where('admin_id='.$id)->find();
    }
    public function setAdmin($dbvalues = array()){
        if(!$dbvalues || !is_array($dbvalues)){
            return 0 ;
        }
    	return $this->_db->data($dbvalues)->add();
    }
    public function select(){
        $data['status'] = array('neq',-1);
        return $this->_db->where($data)->select();
    }
    public function updateAdminById($id,$data){
        if(!$id || !is_numeric($id)){
            throw_exception("ID不合法");
        }
        if(!$data || !is_array($data)){
            throw_exception("更新的数据不合法");
        }
        return $this->_db->where('admin_id='.$id)->save($data);
    }
    public function getTodayCount(){
        $time = mktime(0,0,0,date('m'),date('d'),date('Y'));
        $data = array(
            'status' => 1,
            'lastlogintime' => array('gt',$time),
        );
        return $this->_db->where($data)->count();
    }
}