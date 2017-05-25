// 验证表单字段
$().ready(function () {   
    // 留言板添加
    $("#guestbookFormAdd").validate({
        rules: {     
            guestbook_name: {
                required: true
            },
            guestbook_email: {
                required: true,
                email:true
            },
            guestbook_url: {
                url:true
            },
            guestbook_content: {  
                required: true,
                maxlength: 150
            },
            codecheck:{
                required:true
            }
        },
        messages: {  
            guestbook_name: {
                required: "请输入昵称"
            },
            guestbook_email: {
                required: "请输入邮箱",
                email:"请输入正确的邮箱"
            },
            guestbook_url: {
                url:"请输入正确的主页(没有请清空)"
            },
            guestbook_content: {  
                required: "请输入留言内容",
                maxlength:"内容不超过150个字"
            },
            codecheck: {  
                required: "请输入验证码"
            }
        },
        submitHandler:function() { 
            $('#guestbookFormAdd').ajaxSubmit({
                url: '/index.php/Home/Guestbook/guestbookAdd',
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    // alert(result);
                    // return;
                    if(result){
                        swal({title:"发表成功！", text:"已发送邮件到博主邮箱。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload(true);
                            }
                        });
                    }else{
                        swal("发表失败！","验证码错误。","error");
                    }
                },
                iframe: false
            });
            return false;
        }
    });
});