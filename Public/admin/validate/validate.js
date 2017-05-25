// 验证表单字段
$().ready(function () {
    // alert("hhe");

    // 自定义验证
    //只能有英文
    jQuery.validator.addMethod("allenglish", function(value, element) {
        return this.optional(element) || /^[a-zA-Z]+$/.test(value);
    }, "只能有英文");
    // 英文、数字或下划线
    jQuery.validator.addMethod("allstring", function(value, element) {
        return this.optional(element) || /^\w+$/.test(value);
    }, "英文、数字或下划线");

    
    // 关于我修改
    $("#aboutFormUpdate").validate({
        rules: {     
            about_net_name: {
                required: true,
                minlength:2,
                maxlength:15
            },
            about_name: {
                required: true,
                minlength:2,
                maxlength:15
            },
            about_job: {
                required: true,
                minlength:2,
                maxlength:15
            },
            about_favorite_book: {
                required: true,
                minlength:2,
                maxlength:30
            },
            about_favorite_music: {
                required: true,
                minlength:2,
                maxlength:30
            },
            about_favorite_star: {
                required: true,
                minlength:2,
                maxlength:30
            },
            about_favorite_star: {
                required: true,
                minlength:2,
                maxlength:30
            },
            about_domain_name: {
                required: true,
                minlength:10,
                maxlength:30
            },
            about_server: {
                required: true,
                minlength:2,
                maxlength:20
            },
            about_record: {
                required: true,
                minlength:2,
                maxlength:20
            },
            about_procedure: {
                required: true,
                minlength:2,
                maxlength:20
            }
        },
        messages: {  
            about_net_name: {  
                required: "请输入网名",  
                minlength: "网名最少两个字符",
                maxlength: "网名最多十五个字符"
            },
            about_name: {  
                required: "请输入姓名",  
                minlength: "姓名最少两个字符",
                maxlength: "姓名最多十五个字符"
            },
            about_job: {  
                required: "请输入职业",  
                minlength: "职业最少两个字符",
                maxlength: "职业最多十五个字符"
            },
            about_favorite_book: {  
                required: "请输入喜欢的书",  
                minlength: "喜欢的书最少两个字符",
                maxlength: "喜欢的书最多三十个字符"
            },
            about_favorite_music: {  
                required: "请输入喜欢的音乐",  
                minlength: "喜欢的音乐最少两个字符",
                maxlength: "喜欢的音乐最多三十个字符"
            },
            about_favorite_star: {  
                required: "请输入喜欢的明星",  
                minlength: "喜欢的明星最少两个字符",
                maxlength: "喜欢的明星最多三十个字符"
            },
            about_domain_name: {  
                required: "请输入域名",  
                minlength: "域名最少十个字符",
                maxlength: "域名最多三十个字符"
            },
            about_server: {  
                required: "请输入服务器",  
                minlength: "服务器最少二个字符",
                maxlength: "服务器最多二十个字符"
            },
            about_record: {  
                required: "请输入备案号",  
                minlength: "备案号最少二个字符",
                maxlength: "备案号最多二十个字符"
            },
            about_procedure: {  
                required: "请输入程序",  
                minlength: "程序最少二个字符",
                maxlength: "程序最多二十个字符"
            }
        },
        submitHandler:function() {
            if(!UE.getEditor('container').hasContents()){
                swal({
                    title: "内容不为空",
                    type: "error"
                });
                UE.getEditor('container').focus();
                return false;
            }        
            $('#aboutFormUpdate').ajaxSubmit({
                url: '/index.php/Admin/About/aboutUpdate',
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    if(result){
                        swal({title:"修改成功！", text:"修改这条信息成功了。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload(true);
                                // window.location.assign('/index.php/Admin/About/about');
                            }
                        });
                    }else{
                        swal("修改失败！","修改这条信息失败了。","error");
                    }
                },
                iframe: false
            });
            return false;
        }
    });

    // 说说添加
    $("#talkFormAdd").validate({
        rules: {     
            talk_content: {
                required: true
            }
        },
        messages: {  
            talk_content: {  
                required: "请输入说说内容",
            }
        },
        submitHandler:function() { 
            $('#talkFormAdd').ajaxSubmit({
                url: '/index.php/Admin/Talk/talkAdd',
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    if(result){
                        swal({title:"添加成功！", text:"添加这条说说成功了。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload(true);
                            }
                        });
                    }else{
                        swal("添加失败！","添加这条说说失败了。","error");
                    }
                },
                iframe: false
            });
            return false;
        }
    });
    // 说说修改
    $("#talkFormUpdate").validate({
        rules: {     
            talk_content: {
                required: true
            }
        },
        messages: {  
            talk_content: {  
                required: "请输入说说内容"
            }
        },
        submitHandler:function() { 
            $('#talkFormUpdate').ajaxSubmit({
                url: '/index.php/Admin/Talk/talkUpdate',
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    if(result){
                        swal({title:"修改成功！", text:"修改这条说说成功了。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.assign('/index.php/Admin/Talk/talk');
                            }
                        });
                    }else{
                        swal("修改失败！","修改这条说说失败了。","error");
                    }
                },
                iframe: false
            });
            return false;
        }
    });

    // 留言回复
    $("#guestbookFormReply").validate({
        rules: {     
            talk_content: {
                required: true
            }
        },
        messages: {  
            talk_content: {  
                required: "请输入回复内容"
            }
        },
        submitHandler:function() { 
            $('#guestbookFormReply').ajaxSubmit({
                url: '/index.php/Admin/Guestbook/guestbookReply',
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    if(result){
                        swal({title:"回复成功！", text:"回复这条留言成功了。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.assign('/index.php/Admin/Guestbook/guestbook');
                            }
                        });
                    }else{
                        swal("回复失败！","回复这条留言失败了。","error");
                    }
                },
                iframe: false
            });
            return false;
        }
    });

    // 相册添加
    $("#photoFormAdd").validate({
        rules: {     
            photo_name: {
                required: true,
                maxlength:10,
                remote: {
                    url: "/index.php/Admin/Photo/validateName",     //后台处理程序
                    type: "post",               //数据发送方式
                    dataType: "json",           //接受数据格式
                    data: {                     //要传递的数据
                        photo_name: function() {
                            return $("#photo_name").val();
                        }
                    }
                }
            },
            photo_pic:{
                required:true
            }
        },
        messages: {  
            photo_name: {  
                required: "请输入相册名称",
                maxlength: "名称最多十个字符",
                remote:"名称已存在"
            },
            photo_pic:{
                required:"请选择图片"
            }
        },
        submitHandler:function() { 
            $('#photoFormAdd').ajaxSubmit({
                url: '/index.php/Admin/Photo/photoAdd',
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    if(result){
                        swal({title:"添加成功！", text:"添加这个相册成功了。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload(true);
                            }
                        });
                    }else{
                        swal("添加失败！","添加这个相册失败了。","error");
                    }
                },
                iframe: false
            });
            return false;
        }
    });
    // 相册修改
    $("#photoFormUpdate").validate({
        rules: {     
            photo_name: {
                required: true,
                maxlength:10,
                remote: {
                    url: "/index.php/Admin/Photo/validateNameUpdate",     //后台处理程序
                    type: "post",               //数据发送方式
                    dataType: "json",           //接受数据格式
                    data: {                     //要传递的数据
                        photo_name: function() {
                            return $("#photo_name").val();
                        },
                        photo_id: function() {
                            return $("#photo_id").val();
                        }
                    }
                }
            }
        },
        messages: {  
            photo_name: {  
                required: "请输入相册名称",
                maxlength: "名称最多十个字符",
                remote:"名称已存在"
            }
        },
        submitHandler:function() { 
            $('#photoFormUpdate').ajaxSubmit({
                url: '/index.php/Admin/Photo/photoUpdate',
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    if(result){
                        swal({title:"修改成功！", text:"修改这个相册成功了。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.assign('/index.php/Admin/Photo/photoList');
                            }
                        });
                    }else{
                        swal("修改失败！","修改这个相册失败了。","error");
                    }
                },
                iframe: false
            });
            return false;
        }
    });

    // 图片添加
    $("#pictureFormAdd").validate({
        rules: {     
            // picture_name: {
            //     required: true,
            //     maxlength:10
            // },
            picture_pic:{
                required:true
            }
        },
        messages: {  
            // picture_name: {  
            //     required: "请输入图片名称",
            //     maxlength: "名称最多十个字符"
            // },
            picture_pic:{
                required:"请选择图片"
            }
        },
        submitHandler:function() { 
            $('#pictureFormAdd').ajaxSubmit({
                url: '/index.php/Admin/Picture/pictureAdd',
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    if(result){
                        swal({title:"添加成功！", text:"添加这个图片成功了。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload(true);
                            }
                        });
                    }else{
                        swal("添加失败！","添加这个图片失败了。","error");
                    }
                },
                iframe: false
            });
            return false;
        }
    });
    // 图片修改
    $("#pictureFormUpdate").validate({
        // rules: {     
        //     picture_name: {
        //         required: true,
        //         maxlength:10
        //     }
        // },
        // messages: {  
        //     picture_name: {  
        //         required: "请输入图片名称",
        //         maxlength: "名称最多十个字符"
        //     }
        // },
        submitHandler:function() { 
            $('#pictureFormUpdate').ajaxSubmit({
                url: '/index.php/Admin/Picture/pictureUpdate',
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    if(result){
                        swal({title:"修改成功！", text:"修改这个图片成功了。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.assign('/index.php/Admin/Picture/pictureList');
                            }
                        });
                    }else{
                        swal("修改失败！","修改这个图片失败了。","error");
                    }
                },
                iframe: false
            });
            return false;
        }
    });

    // 文章栏目添加
    $("#programaFormAdd").validate({
        rules: {     
            programa_name: {
                required: true,
                minlength:2,
                maxlength:15,
                remote: {
                    url: "/index.php/Admin/Programa/validateName",     //后台处理程序
                    type: "post",               //数据发送方式
                    dataType: "json",           //接受数据格式
                    data: {                     //要传递的数据
                        programa_name: function() {
                            return $("#programa_name").val();
                        }
                    }
                }
            },
            programa_rank:{
                digits:true,
                max:10000
            }
        },
        messages: {  
            programa_name: {  
                required: "请输入名称",  
                minlength: "名称最少两个字符",
                maxlength: "名称最多十五个字符",   
                remote: "名称已存在"
            }
        },
        submitHandler:function() { 
            $('#programaFormAdd').ajaxSubmit({
                url: '/index.php/Admin/Programa/programaAdd',
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    if(result){
                        swal({title:"添加成功！", text:"添加这个栏目成功了。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload(true);
                            }
                        });
                    }else{
                        swal("添加失败！","添加这个栏目失败了。","error");
                    }
                },
                iframe: false
            });
            return false;
        }
    });
    // 文章栏目修改
    $("#programaFormUpdate").validate({
        rules: {     
            programa_name: {
                required: true,
                minlength:2,
                maxlength:15,
                remote: {
                    url: "/index.php/Admin/Programa/validateNameUpdate",     //后台处理程序
                    type: "post",               //数据发送方式
                    dataType: "json",           //接受数据格式
                    data: {                     //要传递的数据
                        programa_name: function() {
                            return $("#programa_name").val();
                        },
                        programa_id: function() {
                            return $("#programa_id").val();
                        }
                    }
                }
            },
            programa_rank:{
                digits:true,
                max:10000
            }
        },
        messages: {  
            programa_name: {  
                required: "请输入名称",  
                minlength: "名称最少两个字符",
                maxlength: "名称最多十五个字符",   
                remote: "名称已存在"
            },
        },
        submitHandler:function() { 
            $('#programaFormUpdate').ajaxSubmit({
                url: '/index.php/Admin/Programa/programaUpdate',
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    if(result){
                        swal({title:"修改成功！", text:"修改这个栏目成功了。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.assign('/index.php/Admin/Programa/programaList');
                            }
                        });
                    }else{
                        swal("修改失败！","修改这个栏目失败了。","error");
                    }
                },
                iframe: false
            });
            return false;
        }
    });

    // 管理员添加
    $("#managerFormAdd").validate({
        rules: {     
            admin_account: {
                required: true,
                allstring:true,
                minlength:5,
                maxlength:18,
                remote: {
                    url: "/index.php/Admin/Manager/validateAccount",     //后台处理程序
                    type: "post",               //数据发送方式
                    dataType: "json",           //接受数据格式
                    data: {                     //要传递的数据
                        admin_account: function() {
                            return $("#admin_account").val();
                        }
                    }
                }
            },
            admin_name: {
                required: true,
                minlength:2,
                maxlength:15
            },
            admin_pwd:{
                required: true,
                allstring:true,
                minlength:5,
                maxlength:18
            }
        },
        messages: {  
            admin_account: {  
                required: "请输入帐号", 
                allstring: "帐号只能为英文、数字或下划线", 
                minlength: "帐号最少五个字符",
                maxlength: "帐号最多十八个字符",   
                remote: "帐号已存在"
            },
            admin_name: {  
                required: "请输入名称",  
                minlength: "名称最少两个字符",
                maxlength: "名称最多十五个字符"
            },
            admin_pwd:{
                required: "请输入密码", 
                allstring: "密码只能为英文、数字或下划线", 
                minlength: "密码最少五个字符",
                maxlength: "密码最多十八个字符", 
            }
        },
        submitHandler:function() { 
            $('#managerFormAdd').ajaxSubmit({
                url: '/index.php/Admin/Manager/managerAdd',
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    if(result){
                        swal({title:"添加成功！", text:"添加这条信息成功了。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload(true);
                            }
                        });
                    }else{
                        swal("添加失败！","添加这条信息失败了。","error");
                    }
                },
                iframe: false
            });
            return false;
        }
    });

    // 管理员信息修改
    $("#managerFormUpdate").validate({
        rules: {     
            admin_name: {
                required: true,
                minlength:2,
                maxlength:15
            }
        },
        messages: {
            admin_name: {  
                required: "请输入名称",  
                minlength: "名称最少两个字符",
                maxlength: "名称最多十五个字符"
            }
        },
        submitHandler:function() { 
            $('#managerFormUpdate').ajaxSubmit({
                url: '/index.php/Admin/Manager/managerUpdate',
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    if(result){
                        swal({title:"修改成功！", text:"修改这条信息成功了。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.assign('/index.php/Admin/Manager/managerList');
                            }
                        });
                    }else{
                        swal("修改失败！","禁止修改超级管理员信息，或者修改这条信息失败了。","error");
                    }
                },
                iframe: false
            });
            return false;
        }
    });

    // 管理员密码修改
    $("#managerPwdFormUpdate").validate({
        rules: {
            admin_pwd:{
                required: true,
                allstring:true,
                minlength:5,
                maxlength:18
            },
            admin_new_pwd:{
                required: true,
                allstring:true,
                minlength:5,
                maxlength:18,
                equalTo: "#admin_pwd"
            }
        },
        messages: {
            admin_pwd:{
                required: "请输入密码", 
                allstring: "密码只能为英文、数字或下划线", 
                minlength: "密码最少五个字符",
                maxlength: "密码最多十八个字符", 
            },
            admin_new_pwd:{
                required: "请输入确认新密码", 
                allstring: "确认新密码只能为英文、数字或下划线", 
                minlength: "确认新密码最少五个字符",
                maxlength: "确认新密码最多十八个字符",
                equalTo: "两次输入密码不一致" 
            }
        },
        submitHandler:function() { 
            $('#managerPwdFormUpdate').ajaxSubmit({
                url: '/index.php/Admin/Manager/managerUpdatePwd',
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    if(result){
                        swal({title:"修改成功！", text:"修改密码成功了。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.assign('/index.php/Admin/Manager/managerList');
                            }
                        });
                    }else{
                        swal("修改失败！","原密码错误。","error");
                    }
                },
                iframe: false
            });
            return false;
        }
    });

    // 角色添加
    $("#roleFormAdd").validate({
        rules: {     
            role_name: {
                required: true,
                minlength:2,
                maxlength:15,
                remote: {
                    url: "/index.php/Admin/Role/validateName",     //后台处理程序
                    type: "post",               //数据发送方式
                    dataType: "json",           //接受数据格式
                    data: {                     //要传递的数据
                        role_name: function() {
                            return $("#role_name").val();
                        }
                    }
                }
            }
        },
        messages: {  
            role_name: {  
                required: "请输入名称", 
                minlength: "名称最少两个字符",
                maxlength: "名称最多十五个字符",   
                remote: "名称已存在"
            }
        },
        submitHandler:function() { 
            $('#roleFormAdd').ajaxSubmit({
                url: '/index.php/Admin/Role/roleAdd',
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    if(result){
                        swal({title:"添加成功！", text:"添加这条信息成功了。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload(true);
                            }
                        });
                    }else{
                        swal("添加失败！","添加这条信息失败了。","error");
                    }
                },
                iframe: false
            });
            return false;
        }
    });

    // 角色修改
    $("#roleFormUpdate").validate({
        rules: {     
            role_name: {
                required: true,
                minlength:2,
                maxlength:15,
                remote: {
                    url: "/index.php/Admin/Role/validateNameUpdate",     //后台处理程序
                    type: "post",               //数据发送方式
                    dataType: "json",           //接受数据格式
                    data: {                     //要传递的数据
                        role_name: function() {
                            return $("#role_name").val();
                        },
                        role_id: function() {
                            return $("#role_id").val();
                        }
                    }
                }
            }
        },
        messages: {  
            role_name: {  
                required: "请输入名称", 
                minlength: "名称最少两个字符",
                maxlength: "名称最多十五个字符",   
                remote: "名称已存在"
            }
        },
        submitHandler:function() { 
            $('#roleFormUpdate').ajaxSubmit({
                url: '/index.php/Admin/Role/roleUpdate',
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    if(result){
                        swal({title:"修改成功！", text:"修改这条信息成功了。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.assign('/index.php/Admin/Role/roleList');
                            }
                        });
                    }else{
                        swal("修改失败！","修改这条信息失败了。","error");
                    }
                },
                iframe: false
            });
            return false;
        }
    });

    // 角色权限分配
    $("#authFormDistribute").validate({
        submitHandler:function() { 
            $('#authFormDistribute').ajaxSubmit({
                url: '/index.php/Admin/Role/authDistribute',
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    if(result){
                        swal({title:"权限分配成功！", text:"权限分配成功了。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.assign('/index.php/Admin/Role/roleList');
                            }
                        });
                    }else{
                        swal("权限分配失败！","权限分配失败了。","error");
                    }
                },
                iframe: false
            });
        }
    });

    // 个人信息修改
    $("#personalFormUpdate").validate({
        rules: {     
            admin_name: {
                required: true,
                minlength:2,
                maxlength:15
            }
        },
        messages: {
            admin_name: {  
                required: "请输入名称",  
                minlength: "名称最少两个字符",
                maxlength: "名称最多十五个字符"
            }
        },
        submitHandler:function() { 
            $('#personalFormUpdate').ajaxSubmit({
                url: '/index.php/Admin/Personal/personalInfo',
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    if(result){
                        swal({title:"修改成功！", text:"修改这条信息成功了。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.assign('/index.php/Admin/Personal/personal');
                            }
                        });
                    }else{
                        swal("修改失败！","修改这条信息失败了。","error");
                    }
                },
                iframe: false
            });
            return false;
        }
    });

    // 个人密码修改
    $("#personalPwdFormUpdate").validate({
        rules: {
            admin_pwd:{
                required: true,
                allstring:true,
                minlength:5,
                maxlength:18
            },
            admin_new_pwd:{
                required: true,
                allstring:true,
                minlength:5,
                maxlength:18
            },
            admin_confirm_new_pwd:{
                required: true,
                allstring:true,
                minlength:5,
                maxlength:18,
                equalTo: "#admin_new_pwd"
            }
        },
        messages: {
            admin_pwd:{
                required: "请输入密码", 
                allstring: "密码只能为英文、数字或下划线", 
                minlength: "密码最少五个字符",
                maxlength: "密码最多十八个字符", 
            },
            admin_new_pwd:{
                required: "请输入新密码", 
                allstring: "新密码只能为英文、数字或下划线", 
                minlength: "新密码最少五个字符",
                maxlength: "新密码最多十八个字符", 
            },
            admin_confirm_new_pwd:{
                required: "请输入确认新密码", 
                allstring: "确认新密码只能为英文、数字或下划线", 
                minlength: "确认新密码最少五个字符",
                maxlength: "确认新密码最多十八个字符",
                equalTo: "两次输入密码不一致" 
            }
        },
        submitHandler:function() { 
            $('#personalPwdFormUpdate').ajaxSubmit({
                url: '/index.php/Admin/Personal/personalPwdUpdate',
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    if(result){
                        swal({title:"修改成功！", text:"修改密码成功了。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.assign('/index.php/Admin/Personal/personal');
                            }
                        });
                    }else{
                        swal("修改失败！","原密码错误。","error");
                    }
                },
                iframe: false
            });
            return false;
        }
    });

    // 文章添加
    $("#articleFormAdd").validate({
        rules: {     
            article_title: {
                required: true,
                minlength:2
            },
            article_origin: {
                required: true,
                minlength:2
            },
            article_pic: {
                required: true
            },
            article_intro: {
                required: true,
                minlength:10,
                maxlength:150
            }
        },
        messages: {  
            article_title: {  
                required: "请输入文章标题",  
                minlength: "文章标题最少两个字符"
            },
            article_origin: {  
                required: "请输入文章来源",  
                minlength: "文章来源最少两个字符"
            },
            article_pic:{
              required: "请选择图片"
            },
            article_intro: {  
                required: "请输入简介", 
                minlength: "简介最少十个字符",
                maxlength: "简介最多一百五十个字符"
            }
        },
        submitHandler:function() { 
            // 验证表单内容字段
            if(!UE.getEditor('container').hasContents()){
                swal({
                    title: "内容不为空",
                    type: "error"
                });
                UE.getEditor('container').focus();
                return false;
            }else if(UE.getEditor('container').getContentTxt().length<=10){
                swal({
                    title: "输入内容要大于十个字",
                    type: "error"
                });
                UE.getEditor('container').focus();
                return false;
            }
            
            $('#articleFormAdd').ajaxSubmit({
                url: '/index.php/Admin/Article/articleAdd',
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    if(result){
                        swal({title:"添加成功！", text:"添加这条信息成功了。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload(true);
                            }
                        });
                    }else{
                        swal("添加失败！","添加这条信息失败了。","error");
                    }
                },
                iframe: false
            });
            return false;
        }
    });
    // 文章修改
    $("#articleFormUpdate").validate({
        rules: {     
            article_title: {
                required: true,
                minlength:2
            },
            article_origin: {
                required: true,
                minlength:2
            },
            article_intro: {
                required: true,
                minlength:10,
                maxlength:150
            }
        },
        messages: {  
            article_title: {  
                required: "请输入文章标题",  
                minlength: "文章标题最少两个字符"
            },
            article_origin: {  
                required: "请输入文章来源",  
                minlength: "文章来源最少两个字符"
            },
            article_intro: {  
                required: "请输入简介", 
                minlength: "简介最少十个字符",
                maxlength: "简介最多一百五十个字符"
            }
        },
        submitHandler:function() { 
            // 验证表单内容字段
            if(!UE.getEditor('container').hasContents()){
                // alert('请输入内容');
                swal({
                    title: "内容不为空",
                    // text: "Sweet Alert 是一个替代传统的 JavaScript Alert 的漂亮提示效果。",
                    type: "error"
                });
                UE.getEditor('container').focus();
                return false;
            }else if(UE.getEditor('container').getContentTxt().length<=10){
                // alert('输入内容要大于十个字');
                swal({
                    title: "输入内容要大于十个字",
                    // text: "Sweet Alert 是一个替代传统的 JavaScript Alert 的漂亮提示效果。",
                    type: "error"
                });
                UE.getEditor('container').focus();
                return false;
            }
            
            $('#articleFormUpdate').ajaxSubmit({
                url: '/index.php/Admin/Article/articleUpdate',
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    if(result){
                        swal({title:"修改成功！", text:"修改这条信息成功了。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.assign('/index.php/Admin/Article/articleList');
                            }
                        });
                    }else{
                        swal("修改失败！","修改这条信息失败了。","error");
                    }
                },
                iframe: false
            });
            return false;
        }
    });

    // 权限添加
    $("#authFormAdd").validate({
        // debug:true,
        rules: {     
            auth_name: {
                required: true
            },
            auth_rank:{
              digits:true,
              max:10000
            }
        },
        messages: {
            auth_name:{
              required: "请输入名称"
            }
        },
        submitHandler:function() { 
            $('#authFormAdd').ajaxSubmit({
                url: '/index.php/Admin/Auth/authAdd',
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    if(result){
                        swal({title:"添加成功！", text:"添加这条信息成功了。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload(true);
                            }
                        });
                    }else{
                        swal("添加失败！","添加这条信息失败了。","error");
                    }
                },
                iframe: false
            });
            return false;
        }
    });
    // 权限修改
    $("#authFormUpdate").validate({
        // debug:true,
        rules: {     
            auth_name: {
                required: true
            },
            auth_rank:{
              digits:true,
              max:10000
            }
        },
        messages: {
            auth_name:{
              required: "请输入名称"
            }
        },
        submitHandler:function() { 
            $('#authFormUpdate').ajaxSubmit({
                url: '/index.php/Admin/Auth/authUpdate',
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    if(result){
                        swal({title:"修改成功！", text:"修改这条信息成功了。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.assign('/index.php/Admin/Auth/authList');
                            }
                        });
                    }else{
                        swal("修改失败！","修改这条信息失败了。","error");
                    }
                },
                iframe: false
            });
            return false;
        }
    });

    // 配置管理修改
    $("#configFormUpdate").validate({
        submitHandler:function() { 
            $('#configFormUpdate').ajaxSubmit({
                url: '/index.php/Admin/Config/configUpdate',
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    if(result){
                        swal({title:"修改成功！", text:"修改这条信息成功了。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload();
                            }
                        });
                    }else{
                        swal("修改失败！","修改这条信息失败了。","error");
                    }
                },
                iframe: false
            });
            return false;
        }
    });

    // 友情链接添加
    $("#linkFormAdd").validate({
        rules: {     
            link_name: {
                required: true,
                minlength:2
            },
            link_url: {
                required: true,
                url:true
            },
            link_email: {
                email:true
            },
            link_rank: {
                digits:true,
                max:10000
            }
        },
        messages: {  
            link_name: {  
                required: "请输入友情链接名称",
                minlength: "名称最少两个字符"
            },
            link_url: {  
                required: "请输入友情链接网址",
                url: "请输入正确的网址"
            },
            link_email: {
                email:"请输入正确的email"
            }
        },
        submitHandler:function() { 
            $('#linkFormAdd').ajaxSubmit({
                url: '/index.php/Admin/Link/linkAdd',
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    if(result){
                        swal({title:"添加成功！", text:"添加这条友情链接成功了。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload(true);
                            }
                        });
                    }else{
                        swal("添加失败！","添加这条友情链接失败了。","error");
                    }
                },
                iframe: false
            });
            return false;
        }
    });
    // 友情链接修改
    $("#linkFormUpdate").validate({
        rules: {     
            link_name: {
                required: true,
                minlength:2
            },
            link_url: {
                required: true,
                url:true
            },
            link_email: {
                email:true
            },
            link_rank: {
                digits:true,
                max:10000
            }
        },
        messages: {  
            link_name: {  
                required: "请输入友情链接名称",
                minlength: "名称最少两个字符"
            },
            link_url: {  
                required: "请输入友情链接网址",
                url: "请输入正确的网址"
            },
            link_email: {
                email:"请输入正确的email"
            }
        },
        submitHandler:function() { 
            $('#linkFormUpdate').ajaxSubmit({
                url: '/index.php/Admin/Link/linkUpdate',
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    if(result){
                        swal({title:"修改成功！", text:"修改这条友情链接成功了。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.assign('/index.php/Admin/Link/link');
                            }
                        });
                    }else{
                        swal("修改失败！","修改这条友情链接失败了。","error");
                    }
                },
                iframe: false
            });
            return false;
        }
    });
});