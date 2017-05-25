// 清除缓存的ajax
function clearCache(){
    // alert('hhe');
    $.ajax({
        url: '/index.php/Admin/Config/clearCache',
        type: 'POST',
        dataType: 'json',
        success: function (result) {
            // alert(result);
            if(result){
                swal({title:"清除成功", text:"清除缓存成功了。", type:"success"},
                function(isClick){
                    if (isClick) {
                        window.location.reload(true);
                    }
                });
            }else{
                swal("清除失败！","清除缓存失败了。","error");
            }
        }
    });
}

// 优化表
function optimize($name){
    // alert($name);
    // alert('hehe');
    // return;
    $.ajax({
        url: '/index.php/Admin/Database/optimize',
        type: 'POST',
        data: {tables:$name},
        dataType: 'json',
        success: function (result) {
            swal(result);
            // alert(result);
            // if(result){
            //     swal({title:"优化成功", text:"清除缓存成功了。", type:"success"},
            //     function(isClick){
            //         if (isClick) {
            //             window.location.reload(true);
            //         }
            //     });
            // }else{
            //     swal("清除失败！","清除缓存失败了。","error");
            // }
        }
    });
}

// 优化表全选
function optimizeAll(){
    $.ajax({
        url: '/index.php/Admin/Database/optimize',
        type: 'POST',
        data:$('#export-form').serialize(),// 你的formid
        dataType: 'json',
        success: function (result) {
            swal(result);
        }
    });
}

// 修复表
function repair($name){
    // alert($name);
    $.ajax({
        url: '/index.php/Admin/Database/repair',
        type: 'POST',
        data: {tables:$name},
        dataType: 'json',
        success: function (result) {
            swal(result);
        }
    });
}

// 修复表全选
function repairAll(){
    $.ajax({
        url: '/index.php/Admin/Database/repair',
        type: 'POST',
        data:$('#export-form').serialize(),// 你的formid
        dataType: 'json',
        success: function (result) {
            swal(result);
        }
    });
}

// 删除备份信息
function deleteImport($time){
    // alert($time);
    $.ajax({
        url: '/index.php/Admin/Database/del',
        type: 'POST',
        data: {time:$time},
        dataType: 'json',
        success: function (result) {
            swal({title:result},
            function(isClick){
                if (isClick) {
                    window.location.reload(true);
                }
            });
        }
    });
}