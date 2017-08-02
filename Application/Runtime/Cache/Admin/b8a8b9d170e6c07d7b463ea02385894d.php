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
    <link rel="stylesheet" type="text/css" href="./Public/css/party/uploadify.css">
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

    <div class="container-fluid" >

      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">

          <ol class="breadcrumb">
            <li>
              <i class="fa fa-dashboard"></i>  <a href="/admin.php?c=positioncontent">推荐位管理</a>
            </li>
            <li class="active">
              <i class="fa fa-table"></i>推荐位列表
            </li>
          </ol>
        </div>
      </div>
      <!-- /.row -->
      <div >
        <button  id="button-add" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加 </button>
      </div>
      <div class="row">
        <form action="/admin.php?c=positioncontent" method="get">
          <div class="col-md-3">
            <div class="input-group">
              <span class="input-group-addon">推荐位</span>
              <select class="form-control" name="position_id">
                <option value='' >全部分类</option>
                <?php if(is_array($positioncontents)): foreach($positioncontents as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>" <?php if($vo['id'] == $position_id): ?>selected="selected"<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
              </select>
            </div>
          </div>
          <input type="hidden" name="c" value="positioncontent"/>
          <input type="hidden" name="a" value="index"/>
          <div class="col-md-3">
            <div class="input-group">
              <input class="form-control" name="title" type="text" value="<?php echo ($title2); ?>" placeholder="文章标题" />
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
                </span>
            </div>
          </div>
        </form>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <h3></h3>
          <div class="table-responsive">
            <form id="singcms-listorder">
              <table class="table table-bordered table-hover singcms-table">
                <thead>
                <tr>
                  <th width="14">排序</th>
                  <th>id</th>
                  <th>标题</th>
                  <th>推荐位</th>
                  <th>封面图</th>
                  <th>时间</th>
                  <th>状态</th>
                  <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($contents)): $i = 0; $__LIST__ = $contents;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$content): $mod = ($i % 2 );++$i;?><tr>
                    <td><input size=4 type='text'  name='listorder[<?php echo ($content["id"]); ?>]' value="<?php echo ($content["listorder"]); ?>"/></td><!--6.7-->
                    <td><?php echo ($content["id"]); ?></td>
                    <td><?php echo ($content["title"]); ?></td>
                    <td><?php echo (getPositionName($positioncontents,$content["position_id"])); ?></td>
                    <td>
                      <?php echo (isThumb($content["thumb"])); ?>
                    </td>
                    <td>
                        <?php if($content['update_time'] != 0): echo (date("Y-m-d H:i",$content["update_time"])); endif; ?>
                        <?php if($content['update_time'] == 0): echo (date("Y-m-d H:i",$content["create_time"])); endif; ?>
                    </td>
                    <td><span attr-message="是否更改" attr-status="<?php if($content['status'] == 1): ?>0<?php else: ?>1<?php endif; ?>"  attr-id="<?php echo ($content["id"]); ?>" class="sing_cursor singcms-on-off" id="singcms-on-off" ><?php echo (status($content["status"])); ?></span></td>
                    <td><span class="sing_cursor glyphicon glyphicon-edit" aria-hidden="true" id="singcms-edit" attr-id="<?php echo ($content["id"]); ?>" ></span>
                      <a id="singcms-delete"  attr-id="<?php echo ($content["id"]); ?>" attr-status="-1" attr-message="是否删除">
                        <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                      </a>

                    </td>
                  </tr><?php endforeach; endif; else: echo "" ;endif; ?>

                </tbody>
              </table>
              <nav>

              <ul class="pagination">
                <?php echo ($pageRes); ?>
              </ul>

            </nav>
              
            </form>
            <div>
              <button  id="button-listorder" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" ></span>排序</button>
              
            </div>  
            <br>
            
          </div>

        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<script>
  var SCOPE = {
    'edit_url' : '/admin.php?c=positioncontent&a=edit',
    'add_url' : '/admin.php?c=positioncontent&a=add',
    'set_status_url' : '/admin.php?c=positioncontent&a=setStatus',
    'sing_news_view_url' : '/index.php?c=view',
    'listorder_url' : '/admin.php?c=positioncontent&a=listorder',
    'push_url' : '/admin.php?c=positioncontent&a=push',
    'delete_select_url' : 'admin.php?c=positioncontent&a=setStatusSelect'
  }
</script>

<script src="./Public/js/admin/common.js"></script>



</body>

</html>