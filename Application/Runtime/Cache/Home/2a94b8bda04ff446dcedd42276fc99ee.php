<?php if (!defined('THINK_PATH')) exit();?>
<?php
 $navs = D('Menu')->getHomeTrueMenus(); $config = D('Basic')->select(); ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo ($config["title"]); ?></title>
  <meta name="keywords" content="<?php echo ($config["keywords"]); ?>" />
  <meta name="description" content="<?php echo ($config["description"]); ?>" />
  <link rel="stylesheet" href="/Public/css/bootstrap.min.css" type="text/css" />
  <link href="/Public/css/home/jquery.bxslider.css" rel="stylesheet">
  <!-- Custom Fonts -->
  <link href="/Public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="./Public/css/sing/common.css" />
  <!-- Custom styles for this template -->
  <link href="/Public/css/home/style.css" rel="stylesheet">
  <link href="/Public/css/home/main.css" rel="stylesheet">

  
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/" <?php if($result['catid'] == 0): ?>class="curr"<?php endif; ?>>首页</a></li>
            <?php if(is_array($navs)): foreach($navs as $key=>$nav): ?><li><a href="/index.php?c=cat&id=<?php echo ($nav["menu_id"]); ?>" <?php if($nav['menu_id'] == $result['catid']): ?>class="curr"<?php endif; ?>><?php echo ($nav["name"]); ?></a></li><?php endforeach; endif; ?>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
            <li><a href="#"><i class="fa fa-reddit"></i></a></li>
          </ul>


        </div>
        <!--/.nav-collapse -->
      </div>
    </nav>


    <div class="container">
    <p>&nbsp</p>
    <p>&nbsp</p>
    <p>&nbsp</p>

    
    <section>
      <div class="row">
        <div class="col-md-8">
          <article class="blog-post">
            <div class="blog-post-image">
              <section class="main-slider">
                <ul class="bxslider">
                <?php if(is_array($result['topPicNews'])): $i = 0; $__LIST__ = $result['topPicNews'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                    <div class="slider-item">
                    <div class="banner-info"><span>阅读数</span><i class="news_count node-<?php echo ($vo["news_id"]); ?>" news-id="<?php echo ($vo["news_id"]); ?>"></i></div>
                      <a href="/index.php?c=detail&id=<?php echo ($vo["news_id"]); ?>" target="_blank"><img src="<?php echo ($vo["thumb"]); ?>" alt="<?php echo ($vo["title"]); ?>"  height="350" width="750"></a>
                      <h2><a href="/index.php?c=detail&id=<?php echo ($vo["news_id"]); ?>" target="_blank"><?php echo ($vo["title"]); ?></a></h2>
                    </div>
                  </li><?php endforeach; endif; else: echo "" ;endif; ?>  
                </ul>
              </section>
            </div>
            
          </article>
          <!-- article -->
          <?php if(is_array($result['listNews'])): $i = 0; $__LIST__ = $result['listNews'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><article class="blog-post">
            <div class="blog-post-body">
              <h2><a href="/index.php?c=detail&id=<?php echo ($vo["news_id"]); ?>" target="_blank"><?php echo ($vo["title"]); ?></a></h2>
              <div class="post-meta"><span>by <a href="#"><?php echo ($vo["username"]); ?></a></span>/<span><i class="fa fa-clock-o"></i>
                <?php if($vo['update_time'] == 0): echo (date("Y-m-d H:s",$vo["create_time"])); endif; ?>
                <?php if($vo['update_time'] != 0): echo (date("Y-m-d H:s",$vo["update_time"])); endif; ?>
                </span>/<span><i class="fa fa-comment-o"></i> <i news-id="<?php echo ($vo["news_id"]); ?>" class="news_count node-<?php echo ($vo["news_id"]); ?>"></i></span></div>
              <p><?php echo ($vo["description"]); ?></p>
              <div class="read-more"><a href="/index.php?c=detail&id=<?php echo ($vo["news_id"]); ?>" target="_blank">继续阅读</a></div>
            </div>
          </article><?php endforeach; endif; else: echo "" ;endif; ?>
          <!-- article -->
          
        </div>

        <div class="col-md-4 sidebar-gutter">
        <!-- right-->        
        
  <aside>
  <!-- sidebar-widget -->
  <div class="sidebar-widget">
    <h3 class="sidebar-title">热度文章</h3>
    <div class="widget-container">
      <?php if(is_array($result['rankNews'])): $i = 0; $__LIST__ = $result['rankNews'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><article class="widget-post">
          <div class="post-image">
            <a href="/index.php?c=detail&id=<?php echo ($vo["news_id"]); ?>" target="_blank"><img src="<?php echo ($vo["thumb"]); ?>" alt="<?php echo ($vo["title"]); ?>" width="90" height="60"></a>
          </div>
          <div class="post-body">
            <h2><a href="/index.php?c=detail&id=<?php echo ($vo["news_id"]); ?>" target="_blank"><?php echo ($vo["title"]); ?></a></h2>
            <div class="post-meta">
              <span><i class="fa fa-clock-o"></i>
                <?php if($vo['update_time'] == 0): echo (date("Y-m-d H:s",$vo["create_time"])); endif; ?>
                <?php if($vo['update_time'] != 0): echo (date("Y-m-d H:s",$vo["update_time"])); endif; ?>
              </span>
              <span><i class="fa fa-comment-o"></i><i news-id="<?php echo ($vo["news_id"]); ?>" class="news_count node-<?php echo ($vo["news_id"]); ?>"></i></span>
            </div>
          </div>
        </article><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
  </div>
  <!-- sidebar-widget -->
  <h3 class="sidebar-title">推荐内容</h3>
  <?php if(is_array($result['advNews'])): $i = 0; $__LIST__ = $result['advNews'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="sidebar-widget">
      <div class="widget-container widget-about">
        <a href="/index.php?c=detail&id=<?php echo ($vo["news_id"]); ?>&contentid=<?php echo ($vo["id"]); ?>" target="_blank"><img src="<?php echo ($vo["thumb"]); ?>" alt="<?php echo ($vo["title"]); ?>" height="200"></a>
      </div>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>
  
  
  </div>
  </aside>
</div>
      </div>
    </section>
    </div><!-- /.container -->
<script>
  var SCOPE = {
    'count_url' : '/index.php?c=index&a=get_count',
    
  }
</script>
</body>
<script src="/Public/js/jquery.js"></script>
<script src="/Public/js/bootstrap.min.js"></script>
<script src="/Public/js/home/jquery.bxslider.js"></script>
<script src="/Public/js/home/mooz.scripts.min.js"></script>
<script src="/Public/js/count.js"></script>
</html>