<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 后台定时计划任务
*/
class CronController{
	public function dumpmysql(){ 
		if(APP_CRONTAB != 1){
            die('the_file_must_exec_crontab');
        }
		$res = D('Basic')->select();
		if($res['dumpmysql'] !=1){
			die('数据库更新已关闭');
		}
		$shell = 'mysqldump -u'.C('DB_USER').' '.C('DB_NAME').' > C:/xampp/htdocs/cms'.date('Ymd').'.sql';
		exec($shell);
	}
	public function dumpmysql_fast(){
		$shell = 'mysqldump -u'.C('DB_USER').' '.C('DB_NAME').' > C:/xampp/htdocs/cms'.date('Ymd').'.sql';
		exec($shell);
		if(is_file('./cms'.date('Ymd').'.sql')){
			return show(1,'备份成功');
		}
		return show(0,'备份失败');
	}
}