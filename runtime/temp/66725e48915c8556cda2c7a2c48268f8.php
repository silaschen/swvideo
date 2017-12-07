<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:74:"/data/home/bxu2442190303/htdocs/application/index/view/admin/addvideo.html";i:1512543133;s:70:"/data/home/bxu2442190303/htdocs/application/index/view/admin/base.html";i:1512542653;}*/ ?>
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
    
  <link rel="stylesheet" href="/public/com/jQuery-File-Upload-9.9.3/css/jquery.fileupload.css">
  <div class="box box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">添加/编辑视频</h3><a href="<?php echo url('Admin/videolist'); ?>" class='btn btn-default btn-xs pull-right'>返回列表</a>
    </div><!-- /.box-header -->
    <div class="box-body">
         <form method="POST" action="<?php echo url('Admin/addvideo'); ?>" id='form'>
         
            <div class='form-group'>
              <label>标题：</label>
              <input type='text' name='title' class='form-control'>
            </div>
        
            <div class='form-group'>
              <label>封面图片：</label>
                <a href="javascript:$('#cover').val('');$('.showcover').html('');" onclick="return confirm('确定清除封面？');" class='pull-right'>清除封面</a> <br>
                  <button type='button' class='btn btn-success btn-sm fileinput-button'><i class="glyphicon glyphicon-picture"></i> <small>推荐尺寸 400*300 点击上传</small><input  id="uploadcover" type="file" name="files" accept="image/*" ></button>
                    <div id="progress" class="progress">
                        <div class="progress-bar progress-bar-success"></div>
                    </div>
                    <div id="files" class="files">
                    </div>
                    <div class='showcover'>
              
                    </div>
                <input class='hide' name='cover' id='cover'>
            </div>

            <div class='form-group'>
              <label>内容：</label>
                <textarea id="editor_id" name="desc" style="width:100%;min-height:260px;"></textarea>
            </div>
            
            <div class="form-group">
              <label>video key</label>
              <input type="text" name="key" class="form-control">
            </div>

            
            <div class="form-group">
              <label>tag</label>
              <input type="text" name="tag" class="form-control" placeholder="红黄蓝,虐童...">
            </div>
 

            <div class='form-group'>
              <label>浏览量：</label>
              <input type='number' name='views' class='form-control' placeholder="">
            </div>

         </form>
    </div><!-- /.box-body -->
    <div class="box-footer clearfix">
      <button type="button" onclick="saveart();" class="btn btn-success pull-right saveart">确定</button>
    </div>   
  </div>
<div class='hide temp'></div>
<script charset="utf-8" src="/public/com/kindeditor/kindeditor.js"></script>
<script charset="utf-8" src="/public/com/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript">
KindEditor.ready(function(K) {
    window.editor = K.create('#editor_id',{
      uploadJson:"<?php echo url('Common/upload',array('body'=>1)); ?>"
    });
    editor.html($('.temp').html());
});
function saveart(){
  $("#editor_id").val(editor.html());
  $.post("<?php echo url('Admin/addvideo'); ?>",$("#form").serialize(),function(data){
      alert(data.msg);
   
  },'JSON');
}
</script>
<script src="/public/com/jQuery-File-Upload-9.9.3/js/vendor/jquery.ui.widget.js"></script>
<script src="/public/com/jQuery-File-Upload-9.9.3/js/load-image.all.min.js"></script>
<script src="/public/com/jQuery-File-Upload-9.9.3/js/canvas-to-blob.min.js"></script>
<script src="/public/com/jQuery-File-Upload-9.9.3/js/jquery.iframe-transport.js"></script>
<script src="/public/com/jQuery-File-Upload-9.9.3/js/jquery.fileupload.js"></script>
<script src="/public/com/jQuery-File-Upload-9.9.3/js/jquery.fileupload-process.js"></script>
<script src="/public/com/jQuery-File-Upload-9.9.3/js/jquery.fileupload-image.js"></script>
<script type="text/javascript">
$(function(){
    $('#uploadcover').fileupload({
        url: "<?php echo url('Common/upload'); ?>",
        dataType: 'JSON',
        acceptFileTypes: 'jpg,png,gif,jpeg,bmp',
      maxFileSize: 8000000, // 800kb
      disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator && navigator.userAgent),
        imageMaxWidth: 700, //自动裁剪保持该宽度
        imageMaxHeight: 400,
        imageCrop: true,
        done: function (e, data) {
          if(data.result.ret == 1){
              $("input[name='cover']").val(data.result.file);
              $(".showcover").html("<img src='/"+data.result.file+"'>");
            }else{
              alert(data.result.msg);
            }
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');

});
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
