<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>sing后台管理平台</title>
    <!-- Bootstrap Core CSS -->
    <link href="./Public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="./Public/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="./Public/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="./Public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="./Public/css/sing/common.css" />
    <link rel="stylesheet" href="./Public/css/party/bootstrap-switch.css" />

    <!-- jQuery -->
    <script src="./Public/js/jquery.js"></script>
    <script src="./Public/js/bootstrap.min.js"></script>
    <script src="./Public/js/dialog/layer.js"></script>
    <script src="./Public/js/dialog.js"></script>
    <script type="text/javascript" src="./Public/js/party/jquery.uploadify.js"></script>

</head>

    




    



<body>

<div id="wrapper">

    <?php
 $navs = D('Menu')->getAdminMenus(); $username = getLoginUsername(); foreach($navs as $key => $nav){ if($nav['c'] == 'admin' && $username != 'ycj'){ unset($navs[$key]); } } $index = 'index'; ?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    
    <a class="navbar-brand" >singcms内容管理平台</a>
  </div>
  <!-- Top Menu Items -->
  <ul class="nav navbar-right top-nav">
    
    
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['adminUser']['username']; ?> <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li>
          <a href="./admin.php?c=admin&a=personal"><i class="fa fa-fw fa-user"></i> 个人中心</a>
        </li>
        <li class="divider"></li>
        
        <li>
          <a href="./admin.php?a=logout"><i class="fa fa-fw fa-power-off"></i> 退出</a>
        </li>


      </ul>
    </li>
  </ul>
  <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav nav_list">
      <li <?php echo (getActive($index)); ?>>
        <a href="/admin.php?c=index"><i class="fa fa-fw fa-dashboard"></i> 首页</a>
      </li>
      <?php if(is_array($navs)): $i = 0; $__LIST__ = $navs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?><li <?php echo (getActive($nav["c"])); ?>>
        <a href="<?php echo (getAdminMenusUrl($nav)); ?>"><i class="fa fa-fw fa-bar-chart-o"></i><?php echo ($nav["name"]); ?></a>
      </li><?php endforeach; endif; else: echo "" ;endif; ?>

    </ul>
  </div>
  <!-- /.navbar-collapse -->
</nav>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    您好!欢迎使用singcms内容管理平台
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> 平台整理指标
                    </li>
                </ol>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"></div>
                                <div>今日登录用户数<?php echo ($userCount); ?></div>
                            </div>
                        </div>
                    </div>
                    
                        <div class="panel-footer">
                            <span class="pull-left"></span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-tasks fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"></div>
                                <div>文章数量<?php echo ($newsCount); ?></div>
                            </div>
                        </div>
                    </div>
                    <a href="/admin.php?c=content">
                        <div class="panel-footer">
                            <span class="pull-left">查看</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa glyphicon glyphicon-asterisk  fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"></div>
                                <div>文章最大阅读数<?php echo ($newsMax["count"]); ?></div>
                            </div>
                        </div>
                    </div>
                    <a target="_blank" href="./index.php?c=detail&id=<?php echo ($newsMax["news_id"]); ?>">
                        <div class="panel-footer">
                            <span class="pull-left"></span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix">前往查看</div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-support fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"></div>
                                <div>推荐位数<?php echo ($positionCount); ?></div>
                            </div>
                        </div>
                    </div>
                    <a href="/admin.php?c=position">
                        <div class="panel-footer">
                            <span class="pull-left">查看</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>




    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<!-- Morris Charts JavaScript -->

</div>
    <!-- /#wrapper -->

<script src="./Public/js/admin/common.js"></script>



</body>

</html>