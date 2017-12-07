// 兼容旧的函数
function vr(w){return $("input[name='"+w+"']").val();}
function sr(w){return $("select[name='"+w+"']").val();}
function tr(w){return $("textarea[name='"+w+"']").val();}
// 后台loading
function loading2(text,s){
    $("#mask > .loading").html("<img src='Public/res/loading_icon.gif'><br>"+text);
    if(s == undefined){
        $("#mask").show();
    }else{
        if(s > 0){
            setTimeout(function(){$("#mask").hide();},s);
        }else{
            $("#mask").hide();
        }
    }
}

// 输入框值的读取或设置
function IptVal(w,v){
    if(v == undefined){
       return $("input[name='"+w+"']").val();
    }else{
        $("input[name='"+w+"']").val(v);
    }
}
// 下拉选择框值的读取或设置
function SelVal(w,v){
    if(v == undefined){
       return $("select[name='"+w+"']").val();
    }else{
        $("select[name='"+w+"']").val(v);
    }
}
// 输入区域值的读取或设置
function TexVal(w,v){
    if(v == undefined){
       return $("textarea[name='"+w+"']").val();
    }else{
        $("textarea[name='"+w+"']").val(v);
    }
}

function datetime_to_unix(datetime){
    var tmp_datetime = datetime.replace(/:/g,'-');
    tmp_datetime = tmp_datetime.replace(/ /g,'-');
    var arr = tmp_datetime.split("-");
    var now = new Date(Date.UTC(arr[0],arr[1]-1,arr[2],arr[3]-8,arr[4],arr[5]));
    return parseInt(now.getTime()/1000);
}
function unix_to_datetime(unix,mod) {
    var now = new Date(parseInt(unix) * 1000);
    if(mod == 1){
    	return now.getFullYear()+"-"+(now.getMonth()+1)+"-"+now.getDate();
    }else{
    	return now.getFullYear()+"-"+(now.getMonth()+1)+"-"+now.getDate()+" "+now.getHours()+":"+now.getMinutes()+":"+now.getSeconds();
    }

}

//字符替换
String.prototype.replaceAll = function(search, replace){  
 var regex = new RegExp(search, "g");  
 return this.replace(regex, replace);  
}
// 动态加载模态框
function loadpage(url,w,m){
    if(m == undefined){
        if($("#temp_modal").html() > 0){
            // 如果存在
            $("#temp_modal").modal('hide');
            $("#temp_modal").remove();
        }
        // 如果容器不存在 使用备用容器
        var temp_modal = '<div class="modal" id="temp_modal"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button><b class="modal-title">查看详情</b></div><div class="modal-body" id="temp_content"></div><div class="modal-footer"><button type="button" class="btn btn-default pull-right" data-dismiss="modal">关闭</button></div></div></div></div>';
        $("body").append(temp_modal);
        m = '#temp_modal';
        w = '#temp_content';
    }
    $(w).html("<center><img src='Public/res/loading_icon.gif'></center>");
    $(w).load(url);
    $(m).modal('show');
}