/**
 * 添加按钮操作
 */
$('#button-add').click(function(){
    var url = SCOPE.add_url;
    window.location.href = url;
});
/**
 * 提交表单操作
 */ 
$('#singcms-button-submit').click(function(){
    var data = $('#singcms-form').serializeArray();
    var postData = {};
    $(data).each(function(){
       postData[this.name] = this.value ;
    });
    //将获得的post传到服务器
    var url = SCOPE.save_url;
    var jump_url = SCOPE.jump_url;
    $.post(url,postData,function(result){
        if(result.status == 0){
            //失败
            dialog.error(result.message);
        }
        if(result.status == 1){
            //成功
            dialog.success(result.message,jump_url);
        }
        
    },'JSON');
});
/** 
* 修改按钮操作
*/
$('.singcms-table #singcms-edit').click(function(){
     var id = $(this).attr('attr-id');
     var url = SCOPE.edit_url;
     window.location.href = url + '&id=' + id;
});
/**
* 预览按钮操作
*/
$('.singcms-table #singcms-preview').click(function(){
     var id = $(this).attr('attr-id');
     var url = SCOPE.preview_url;
     window.open(url + '&id=' + id);
});
/**
*删除或修改状态按钮操作
*/
$('.singcms-table #singcms-delete, .singcms-table #singcms-on-off').click(function(){
    var id = $(this).attr('attr-id');
    var message = $(this).attr('attr-message');
    var status = $(this).attr('attr-status');
    var url = SCOPE.set_status_url;
    var data = {'id':id,'status':status};
    layer.open({
            content : message,
            icon:3,
            btn : ['是','否'],
            yes : function(){
                //异步传输
                todelete(url,data);
            },
    });    
});
/**
*删除多条记录
*/
$('#button-delete-select').click(function(){
    var message = $(this).attr('attr-message');
    var postData = {};
    $('input[name="pushcheck"]:checked').each(function(i){
       postData[i] = $(this).val() ;
    });
    //console.log(postData);
    var url = SCOPE.delete_select_url;
    layer.open({
            content : message,
            icon:3,
            btn : ['是','否'],
            yes : function(){
                //异步传输
                todelete(url,postData);
            },
    });  
});
/**
* 删除全选操作
*/
$('#singcms-checkbox-all').click(function(){
    if($(this).is(':checked')){
        $('.check-every').prop('checked',true);
    }else{
        $('.check-every').prop('checked',false);
    }
    
});
/**
*异步传输函数
*/
function todelete(url,data){
    $.post(url,data,function(result){
        if(result.status == 0){
            dialog.error(result.message);
        }
        if(result.status == 1){
            dialog.success(result.message,'');
        }
    },'JSON');
}
/**
* 排序操作
*/
$('#button-listorder').click(function(){
    var data = $('#singcms-listorder').serializeArray();
    var postData = {};
    $(data).each(function(){
       postData[this.name] = this.value ;
    });
    //将获得的post传到服务器
    
    var url = SCOPE.listorder_url;
    $.post(url,postData,function(result){
        if(result.status == 0){
            //失败
            dialog.error(result.message);
        }
        if(result.status == 1){
            //成功
            dialog.success(result.message,result['data']['jump_url']);
        }
        
    },'JSON');
});
/**
* 推荐位操作
*/
$('#singcms-push').click(function(){
    var id = $('#select-push').val();
    var url = SCOPE.push_url;
    var push = {};
    var postData = {};
    $('input[name="pushcheck"]:checked').each(function(i){
        push[i] = $(this).val();
    });
    postData['position_id'] = id;
    postData['push'] = push;
    //console.log(postData);
    $.post(url,postData,function(result){
        if(result.status == 0){
            dialog.error(result.message);
        }
        if(result.status == 1){
            dialog.success(result.message,result['data']['jump_url']);
        }
    },'JSON');
});
/**
* 更新首页静态页面操作
*/
$('#cache-index').click(function(){
    var url = SCOPE.cache_url;
    var postData = {};
    $.post(url,postData,function(result){
        if(result.status == 0){
            dialog.error(result.message);
        }
        if(result.status == 1){
            dialog.success(result.message,'');
        }
    },'JSON');
});
/**
* 更新其他静态页面操作
*/
$('#cache-other').click(function(){
    var url1 = SCOPE.cache_cat_url;
    var url2 = SCOPE.cache_detail_url;
    var postData = {};
    $.post(url1,postData,function(result){
        if(result.status == 0){
            dialog.error(result.message);
        }
        if(result.status == 1){
            todelete(url2,postData);
        }
    },'JSON');
});
/**
* 备份数据库操作
*/
$('#data-mysql').click(function(){
    var url = SCOPE.mysql_url;
    var postData = {};
    $.post(url,postData,function(result){
        if(result.status == 0){
            dialog.error(result.message);
        }
        if(result.status == 1){
            dialog.success(result.message,'');
        }
    },'JSON');
});