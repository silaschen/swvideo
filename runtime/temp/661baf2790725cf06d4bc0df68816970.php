<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"/data/home/bxu2442190303/htdocs/application/index/view/index/videolist.html";i:1512622943;s:70:"/data/home/bxu2442190303/htdocs/application/index/view/index/base.html";i:1512623515;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title><?php echo $title; ?></title>
<meta name="author" content="swvideo">
<meta http-equiv="cleartype" content="on">
<meta content="telephone=no,email=no" name="format-detection">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<!-- <script charset="utf-8" src="STATIC/video/js/video.min.js"></script> -->
<link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<!-- <link rel="stylesheet" href="Public/com/video/css/video-js.css"> -->
<script  src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="Public/com/jQuery-File-Upload-9.9.3/css/jquery.fileupload.css">
<!-- <script src="http://html5media.googlecode.com/svn/trunk/src/html5media.min.js"></script> -->




<!-- 页面零碎css -->


</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Swvideo</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo url('Index/videolist'); ?>">video</a></li>
        <li><a href="<?php echo url('Index/index'); ?>">tags</a></li>
       	<li><a href="<?php echo url('Index/law'); ?>">法律(law)</a></li>
      </ul>
    
     
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>




<style type="text/css">
	.video{background: yellow;padding-left:0;padding-right: 0; }
	.overs:hover{opacity: 0.7;background: pink;}
</style>
<div class="container">
  
  <div class="row">
      
       <?php if(is_array($list['data']) || $list['data'] instanceof \think\Collection || $list['data'] instanceof \think\Paginator): if( count($list['data'])==0 ) : echo "" ;else: foreach($list['data'] as $key=>$v): ?>
    
			  <div class="col-sm-12 col-md-4" onclick="toUrl(<?php echo $v['id']; ?>)">
			    <div class="thumbnail overs" style="position: relative;">
			    	<div style="position: absolute;top:0;background:#6f6262 ;opacity: 0.5;left: 0;right: 0;bottom: 90px;"><img style="margin-top: 70px;width: 80px;cursor: pointer;" class="center-block" src="/public/static/play.png">
			    	</div>

			      <img src="<?php echo $v['cover']; ?>" alt="..." onmouseover="showplay()" style="cursor: pointer;">
			      <div class="caption">
			  
			        <h4><a href="<?php echo url('Index/play'); ?>?id=<?php echo $v['id']; ?>" style="color: #282828;text-decoration: none;font-size: 16px;"><?php echo $v['title']; ?></a></h4>
			        <p><span>upload at &nbsp<?php echo date("Y-m-d H:i",$v['addtime']); ?></span></p>
			      </div>
			    </div>
			  </div>
		



          
  <?php endforeach; endif; else: echo "" ;endif; ?>
 

  </div>

<ul class="pagination pagination-sm no-margin text-center"><?php echo $page; ?></ul>
</div>


<script type="text/javascript">
	

	function toUrl(id){

			location.href="<?php echo url('Index/play'); ?>?id="+id;


	}
</script>






<div class="container text-center" style="height: 40px;line-height: 20px;margin-top: 15px;">
  <hr>
  <span>SWvideo team 2017</span>
  <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1271270281'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s13.cnzz.com/z_stat.php%3Fid%3D1271270281%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script><br>
  <span>广告合作请联系QQ434684326(Sw advteam)</span>

</div>

</body>
</html>