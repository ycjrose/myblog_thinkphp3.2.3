<?php if (!defined('THINK_PATH')) exit(); $navs = D('Menu')->getHomeTrueMenus(); $config = D('Basic')->select(); ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo ($config["title"]); ?></title>
  <meta name="keywords" content="<?php echo ($config["keywords"]); ?>" />
  <meta name="description" content="<?php echo ($config["description"]); ?>" />
  <link rel="stylesheet" href="/Public/css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="/Public/css/home/main.css" type="text/css" />
  <style type="text/css">
    a:hover{
      text-decoration: none;
    }
  </style>
</head>
<body>
<header id="header">
  <div class="navbar-inverse">
    <div class="container">
      <div class="navbar-header">
        <a href="/">
          <img src="/Public/images/logo.png" alt="">
        </a>
      </div>
      <ul class="nav navbar-nav navbar-left">
        <li><a href="/" <?php if($result['catid'] == 0): ?>class="curr"<?php endif; ?>>首页</a></li>
        <?php if(is_array($navs)): foreach($navs as $key=>$nav): ?><li><a href="/index.php?c=cat&id=<?php echo ($nav["menu_id"]); ?>" <?php if($nav['menu_id'] == $result['catid']): ?>class="curr"<?php endif; ?>><?php echo ($nav["name"]); ?></a></li><?php endforeach; endif; ?>
      </ul>
    </div>
  </div>
</header>
	<section>
		<div class="container text-center" style="...">
			<h1 style="color: red"><?php echo ($message); ?></h1>
			<h3 id="location">系统将在<span style="color: red">3</span>秒后自动跳转到首页</h3>
		</div>
	</section>
</body>
<script src="/Public/js/jquery.js"></script>
<script type="text/javascript">
	var url = "/";
	var time = 3;
	setInterval("refer()",1000);
	function refer(){
		if(time == 0){
			window.location.href = url;
		}
		$('#location span').html(time);
		time--;
	}
</script>
</html>