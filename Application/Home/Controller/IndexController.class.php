<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
        
            if(is_file('./Application/Runtime/index.html')){//静态页面判断
                require_once('./Application/Runtime/index.html');
            }else{
                    $this->common();
                    $this->buildHtml('index',HTML_PATH,'Index/index');
                    $this->display();
                  
            }
        
        
    }
    public function build_html(){
        $this->common();
        $res = $this->buildHtml('index',HTML_PATH,'Index/index');
        if($res){
            return show(1,'更新静态页面成功');
        }
        return show(0,'更新失败');
    }
    public function get_count(){
        if($_POST){
            $newsIds = array_unique($_POST);
            try{
                $news = D('News')->getNewsByIds($newsIds);
            }catch(Exception $e){
                return show(0,$e->getMessage());
            }
            if($news){
                $data = array();
                foreach ($news as $value) {
                    $data[$value['news_id']] = $value['count'];
                }
                return show(1,'获取成功',$data);
            }
            return show(0,'没有数据');
        }
        return show(0,'没有内容');
    }
    public function crontab_build_html(){
        if(APP_CRONTAB != 1){
            die('the_file_must_exec_crontab');
        }
        $res = D('Basic')->select();
        if($res['static'] != 1){
            die('没有开启自动更新静态页面');
        }
        $this->common();
        $res = $this->buildHtml('index',HTML_PATH,'Index/index');
    }
    public function common(){
        $data1 = array('position_id' => 1);
        $data2 = array('position_id' => 2);
        $data3 = array('position_id' => 4);
        $data4 = array('status' => 1);
        $data5 = array('thumb' => array('neq',''));
        $topPicNews = D('PositionContent')->select($data1,3);
        $topSmallNews = D('PositionContent')->select($data2,3);
        $advNews = D('PositionContent')->select($data3,2);
        $listNews = D('News')->select($data4,3);
        $rankNews = D('News')->getRank($data5,8);
        $this->assign('result',array(
            'topPicNews' => $topPicNews,
            'topSmallNews' => $topSmallNews,
            'listNews' => $listNews,
            'advNews' => $advNews,
            'rankNews' => $rankNews,
            'catid' => 0,
        ));
    }
   
}