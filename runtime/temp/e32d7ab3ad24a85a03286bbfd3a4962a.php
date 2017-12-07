<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:71:"/data/home/bxu2442190303/htdocs/application/index/view/index/index.html";i:1512537225;s:70:"/data/home/bxu2442190303/htdocs/application/index/view/index/base.html";i:1512623515;}*/ ?>
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
  
  @media screen and (min-width: 980px) {
    .video a{margin:25px;}
}

  @media screen and (max-width: 500px) {
    .video a{margin:10px;}
}


</style>
<div class="container text-center video" style="padding-top: 10%;width: 80%; ">

    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$t): ?>


          <a href="<?php echo url('Index/videolist'); ?>?tag=<?php echo $t['tag']; ?>"  style="<?php echo $style[rand(0,6)]; ?>;font-size: <?php echo rand(15,30); ?>px;display: inline-block;"><?php echo $t['tag']; ?></a>


    <?php endforeach; endif; else: echo "" ;endif; ?>

</div>










<div class="container text-center" style="height: 40px;line-height: 20px;margin-top: 15px;">
  <hr>
  <span>SWvideo team 2017</span>
  <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1271270281'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s13.cnzz.com/z_stat.php%3Fid%3D1271270281%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script><br>
  <span>广告合作请联系QQ434684326(Sw advteam)</span>

</div>

</body>
</html>