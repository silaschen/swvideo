<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"/data/home/bxu2442190303/htdocs/application/index/view/admin/videolist.html";i:1512542653;s:70:"/data/home/bxu2442190303/htdocs/application/index/view/admin/base.html";i:1512542653;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $title; ?></title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="/public/static/com/AdminLTE/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="//cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="//cdn.bootcss.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="/public/static/com/AdminLTE/css/AdminLTE.css">
<link rel="stylesheet" href="/public/static/com/AdminLTE/css/skins/skin-red.css">
<!-- jQuery 2.1.4 -->
<script src="//cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="/public/static/com/AdminLTE/bootstrap/js/bootstrap.min.js"></script>
<script src="/public/static/com/common.js"></script>
<style type="text/css">
/*loading*/
#mask{position: fixed;z-index: 999999;top: 0;bottom: 0;left: 0;right: 0;display: none;}
#mask .loading{padding: 10px 15px;background: #333;opacity: 0.75;text-align: center;color: #FFF;line-height: 23px;position: fixed;left:0;right: 0;bottom: 0;top: 0;width: 120px;height: 65px;z-index: 999999;margin: auto;border-radius: 4px;}
</style>
<!--[if lt IE 9]>
<script src="//cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">
  <include file="admin:head" />
  <!-- Left side column. contains the logo and sidebar -->
  <include file="admin:left" />
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <!-- Main content -->
    <section class="content">
    
  <!-- 搜索 -->
  <div class="box box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">视频列表</h3>
      <a href="<?php echo url('Sys/addvideo'); ?>" class='btn btn-success btn-xs pull-right'>添加视频</a>
    </div>
    <div class="box-body">
      <form method="GET" action="<?php echo url('Sys/artlist'); ?>" id='form'>
      <div class="row">
        <div class="col-xs-4 col-md-3">
          <div class="input-group">
            <input name="word" type='text' class='form-control' value="" placeholder='标题关键词搜索..'>
            <span class="input-group-addon" onclick="$('#form').submit();"><i class="fa fa-search"></i></span>
            <if condition="$_GET['word'] neq ''">
            <a title='清除条件' class="input-group-addon" href="<?php echo url('Sys/artlist'); ?>"><i class="fa fa-remove"></i></a>
            </if>
          </div>
        </div>
      </div>
      </form>
    </div><!-- /.box-body -->
  </div>
  <!-- 列表 -->
  <div class="box box-solid">
    <div class="box-body">
      <table class="table table-bordered">
        <tbody>
          <tr>
            <th>ID</th>
            <th>标题</th>
    
            <th>封面</th>
            <th>阅读量</th>
            <th>添加时间</th>
            <th>状态</th>
            <th>操作</th>
          </tr>
          <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
          <tr>
            <td><?php echo $vo['id']; ?></td><td><?php echo $vo['title']; ?></td><td><if condition="$vo.cover neq ''"><a href="<?php echo $vo['cover']; ?>" target='_blank'><i class='fa fa-photo'></i></a></if></td>
            <td><?php echo $vo['views']; ?></td><td><?php echo date('Y-m-d H:i',$vo['addtime']); ?></td>
            <td><if condition="$vo.status eq '1'"><span class="label label-success">正常</span><elseif condition="$vo.status eq '0'"/><span class="label label-default">隐藏</span></if></td>
            <td>
              <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                  管理
                  <span class="caret"></span>
                  <span class="sr-only">+</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="<?php echo url('Sys/addvideo',array('id'=>$vo['id'])); ?>">编辑</a></li>
                  <if condition="$vo.status eq '1'">
                  <li><a href="javascript:setstat(<?php echo $vo['id']; ?>,0);">隐藏</a></li>
                  <else/>
                  <li><a href="javascript:setstat(<?php echo $vo['id']; ?>,1);">显示</a></li>
                  </if>
                  <li class="divider"></li>
                  <li><a href="javascript:setstat(<?php echo $vo['id']; ?>,-1);">删除</a></li>
                </ul>
              </div>
            </td>
          </tr>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
      </table>
       
    </div><!-- /.box-body -->
    <div class="box-footer clearfix">
	    <ul class="pagination pagination-sm no-margin pull-right"><?php echo $page; ?></ul>
	  </div>    
  </div>
<script type="text/javascript">
function setstat(id,t){
  if(t == -1){
    var r = confirm("确定删除该文章？");
  }else if(t == 1){
    var r = confirm("确定显示该文章？");
  }else if(t == 0){
    var r = confirm("确定隐藏该文章？");
  }
  if(r == true){
    $.post(location.href,{"id":id,"t":t},function(data){
      alert(data.msg);
      if(data.ret == 1) location.reload();
    },'JSON');
  }
}
</script>

    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">值得信赖的移动互联网开发服务商!</div>
    <!-- Default to the left -->
    <a  target='_blank'>&copy; </a>
  </footer>
</div><!-- ./wrapper -->
<!-- AdminLTE App -->
<script src="public/static/com/AdminLTE/js/app.min.js"></script>
<div id="mask"><div class='loading'></div></div>
</body>
</html>
