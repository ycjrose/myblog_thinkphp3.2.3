<?php
/**
* 控制图片上传的类
*/
namespace Admin\Controller;
use Think\controller;
class ImageController extends CommonController{
	public function ajaxUploadImage(){
		$res = D('UploadImage')->imageUpload();
		if($res === false){
			return show(0,'上传失败','');
		}else{
			return show(1,'上传成功',$res);
		}
	}
	public function kindUpload(){
		$res = D('UploadImage')->upload();
		if($res === false){
			return showKind(1,'上传失败');
		}
		return showKind(0,$res);
	}
}