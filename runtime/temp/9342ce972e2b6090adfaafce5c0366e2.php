<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:70:"/data/home/bxu2442190303/htdocs/application/index/view/index/play.html";i:1512623100;s:70:"/data/home/bxu2442190303/htdocs/application/index/view/index/base.html";i:1512623515;}*/ ?>
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



	<link href="http://vjs.zencdn.net/6.4.0/video-js.css" rel="stylesheet">
  <!-- If you'd like to support IE8 -->
  <script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
<style type="text/css">
  body{overflow: hidden;}
	@media screen and (max-width: 500px) {
    #my-video{
      /*  width: 320px;
        height: 250px;*/
        width: 100%;
        height: 250px;
    }
/*    .m{margin: -20px auto;width: 320px;height: 250px}*/
  }
	@media screen and (min-width: 800px) {
    #my-video{
       /* width: 740px;
        height: 400px;*/
        width: 100%;
        height: 400px;
    }
    /*.m{margin: -20px auto;width: 740px;height: 400px}*/
}


</style>
<div class="row" style="overflow: hidden;">
    <div class="col-md-7 col-sm-12">
          <div class="m">
              <video id="my-video" class="video-js vjs-default-skin vjs-big-play-centered" controls preload="none"
                  poster="<?php echo $video['cover']; ?>"
                  data-setup="{}">
                <source src="<?php echo $video['url']; ?>" type='video/mp4' />
                <source src="" type='video/webm' />
                <source src="" type='video/ogg' />
                <track kind="captions" src="demo.captions.vtt" srclang="en" label="English"></track><!-- Tracks need an ending tag thanks to IE9 -->
                <track kind="subtitles" src="demo.captions.vtt" srclang="en" label="English"></track><!-- Tracks need an ending tag thanks to IE9 -->
            </video>

          </div>

          <?php if(is_array($tags) || $tags instanceof \think\Collection || $tags instanceof \think\Paginator): if( count($tags)==0 ) : echo "" ;else: foreach($tags as $key=>$t): ?>


          <a href="<?php echo url('Index/videolist'); ?>?tag=<?php echo $t['tag']; ?>"  style="font-size:15px;display: inline-block;margin: 7px;text-decoration: none;color: #0d88c5;font-weight: bolder;"><?php echo $t['tag']; ?></a>


          <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>

    <div class="col-md-5 col-sm-12">
      
      <div class="panel panel-default">
        <div class="panel-body">
          
              <ul class="media-list">
          <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$li): ?>
          <li class="media">
            <div class="media-left">
              <a href="<?php echo url('Index/play'); ?>?id=<?php echo $li['id']; ?>">
                <img class="media-object" src="/<?php echo $li['cover']; ?>" alt="..." width="100">
              </a>
            </div>
            <div class="media-body">
              <h4 class="media-heading"><?php echo $li['title']; ?></h4>
             
            </div>
          </li>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        </div>
      </div>

    </div>

</div>


	  <script src="http://vjs.zencdn.net/6.4.0/video.js"></script>

	  <script type="text/javascript">
			var myPlayer = videojs('my-video');
			videojs("my-video").ready(function(){
				var myPlayer = this;
				// myPlayer.play();
			});
		</script>





<div class="container text-center" style="height: 40px;line-height: 20px;margin-top: 15px;">
  <hr>
  <span>SWvideo team 2017</span>
  <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1271270281'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s13.cnzz.com/z_stat.php%3Fid%3D1271270281%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script><br>
  <span>广告合作请联系QQ434684326(Sw advteam)</span>

</div>

</body>
</html>