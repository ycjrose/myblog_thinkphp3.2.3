在不同环境下搭建要注意修改以下几个文件
Application/Common/Conf/db.php修改数据库配置信息，例如用户名和密码
Application/Admin/Controller/CronController.class.php修改备份数据库的路径
Linux环境下注意文件夹权限问题
Runtime目录要给权限
upload目录是图片上传保存目录，要给权限，不然图片上传功能失效
该系统用到以下几个插件
layer http://layer.layui.com/
uploadify http://www.uploadify.com/
kindEditor http://kindeditor.net