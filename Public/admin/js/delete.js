// 删除友情链接
function confirmDeleteLink(val) {
    swal({
        title: "您确定要删除这条友情链接吗",
        text: "删除后将无法恢复，请谨慎操作！",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "是的，我要删除！",
        cancelButtonText: "让我再考虑一下…",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function (isConfirm) {
        if (isConfirm) {
            var url='/index.php/Admin/Link/linkDelete';
            $.post(
                url,
                {id:val},
                function(data){
                    if(data){
                        swal({title:"删除成功！", text:"您已经永久删除了这条友情链接。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload();
                            }
                        });
                    }else{
                        swal("删除失败！", "删除这条友情链接失败了。", "error");
                    }
                }
            );
        } else {
            swal("已取消", "您取消了删除操作！", "error");
        }
    });
}

// 删除说说
function confirmDeleteTalk(val) {
    swal({
        title: "您确定要删除这条说说吗",
        text: "删除后将无法恢复，请谨慎操作！",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "是的，我要删除！",
        cancelButtonText: "让我再考虑一下…",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function (isConfirm) {
        if (isConfirm) {
            var url='/index.php/Admin/Talk/talkDelete';
            $.post(
                url,
                {id:val},
                function(data){
                    if(data){
                        swal({title:"删除成功！", text:"您已经永久删除了这条说说。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload();
                            }
                        });
                    }else{
                        swal("删除失败！", "删除这条说说失败了。", "error");
                    }
                }
            );
        } else {
            swal("已取消", "您取消了删除操作！", "error");
        }
    });
}

// 删除留言板
function confirmDeleteGuestbook(val) {
    swal({
        title: "您确定要删除这条留言吗",
        text: "删除后将无法恢复，请谨慎操作！",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "是的，我要删除！",
        cancelButtonText: "让我再考虑一下…",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function (isConfirm) {
        if (isConfirm) {
            var url='/index.php/Admin/Guestbook/guestbookDelete';
            $.post(
                url,
                {id:val},
                function(data){
                    if(data){
                        swal({title:"删除成功！", text:"您已经永久删除了这条留言。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload();
                            }
                        });
                    }else{
                        swal("删除失败！", "删除这条留言失败了。", "error");
                    }
                }
            );
        } else {
            swal("已取消", "您取消了删除操作！", "error");
        }
    });
}

// 删除相册
function confirmDeletePhoto(val) {
    swal({
        title: "您确定要删除这个相册吗",
        text: "删除后将无法恢复，请谨慎操作！",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "是的，我要删除！",
        cancelButtonText: "让我再考虑一下…",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function (isConfirm) {
        if (isConfirm) {
            var url='/index.php/Admin/Photo/photoDelete';
            $.post(
                url,
                {id:val},
                function(data){
                    if(data){
                        swal({title:"删除成功！", text:"您已经永久删除了这个相册。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload();
                            }
                        });
                    }else{
                        swal("删除失败！", "删除这个相册失败了。", "error");
                    }
                }
            );
        } else {
            swal("已取消", "您取消了删除操作！", "error");
        }
    });
}

// 删除图片
function confirmDeletePicture(val) {
    swal({
        title: "您确定要删除这个图片吗",
        text: "删除后将无法恢复，请谨慎操作！",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "是的，我要删除！",
        cancelButtonText: "让我再考虑一下…",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function (isConfirm) {
        if (isConfirm) {
            var url='/index.php/Admin/Picture/pictureDelete';
            $.post(
                url,
                {id:val},
                function(data){
                    if(data){
                        swal({title:"删除成功！", text:"您已经永久删除了这个图片。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload();
                            }
                        });
                    }else{
                        swal("删除失败！", "删除这个图片失败了。", "error");
                    }
                }
            );
        } else {
            swal("已取消", "您取消了删除操作！", "error");
        }
    });
}

// 删除文章
function confirmDeleteArticle(val) {
    swal({
        title: "您确定要删除这篇文章吗",
        text: "删除后将无法恢复，请谨慎操作！",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "是的，我要删除！",
        cancelButtonText: "让我再考虑一下…",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function (isConfirm) {
        if (isConfirm) {
            var url='/index.php/Admin/Article/articleDelete';
            $.post(
                url,
                {id:val},
                function(data){
                    if(data){
                        swal({title:"删除成功！", text:"您已经永久删除了这篇文章。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload();
                            }
                        });
                    }else{
                        swal("删除失败！", "删除这篇文章失败了。", "error");
                    }
                }
            );
        } else {
            swal("已取消", "您取消了删除操作！", "error");
        }
    });
}
// 删除文章栏目
function confirmDeletePrograma(val) {
    swal({
        title: "您确定要删除这个栏目吗",
        text: "删除后将无法恢复，请谨慎操作！",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "是的，我要删除！",
        cancelButtonText: "让我再考虑一下…",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function (isConfirm) {
        if (isConfirm) {
            var url='/index.php/Admin/Programa/programaDelete';
            $.post(
                url,
                {id:val},
                function(data){
                    if(data){
                        swal({title:"删除成功！", text:"您已经永久删除了这个栏目。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload();
                            }
                        });
                    }else{
                        swal("删除失败！", "栏目里有文章,请先把文章删除!", "error");
                    }
                }
            );
        } else {
            swal("已取消", "您取消了删除操作！", "error");
        }
    });
}
// 删除权限
function confirmDeleteAuth(val) {
    // return window.confirm("是否要删除编号为" + val + "的权限");
    swal({
        title: "您确定要删除这条信息吗",
        text: "删除后将无法恢复，请谨慎操作！",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "是的，我要删除！",
        cancelButtonText: "让我再考虑一下…",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function (isConfirm) {
        if (isConfirm) {
            var url='/index.php/Admin/Auth/authDelete';
            $.post(
                url,
                {id:val},
                function(data){
                    if(data){
                        swal({title:"删除成功！", text:"您已经永久删除了这条信息。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload();
                            }
                        });
                    }else{
                        swal("删除失败！", "删除这条信息失败了!", "error");
                    }
                }
            );
        } else {
            swal("已取消", "您取消了删除操作！", "error");
        }
    });
}
// 删除管理员
function confirmDeleteAdmin(val) {
    // return window.confirm("是否要删除编号为" + val + "的管理员");
    swal({
        title: "您确定要删除这条信息吗",
        text: "删除后将无法恢复，请谨慎操作！",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "是的，我要删除！",
        cancelButtonText: "让我再考虑一下…",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function (isConfirm) {
        if (isConfirm) {
            var url='/index.php/Admin/Manager/managerDelete';
            $.post(
                url,
                {id:val},
                function(data){
                    if(data){
                        swal({title:"删除成功！", text:"您已经永久删除了这条信息。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload();
                            }
                        });
                    }else{
                        swal("删除失败！", "禁止删除超级管理员!", "error");
                    }
                }
            );
        } else {
            swal("已取消", "您取消了删除操作！", "error");
        }
    });
}
// 删除角色
function confirmDeleteRole(val) {
    // return window.confirm("是否要删除编号为" + val + "的角色");
    swal({
        title: "您确定要删除这条信息吗",
        text: "删除后将无法恢复，请谨慎操作！",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "是的，我要删除！",
        cancelButtonText: "让我再考虑一下…",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function (isConfirm) {
        if (isConfirm) {
            var url='/index.php/Admin/Role/roleDelete';
            $.post(
                url,
                {id:val},
                function(data){
                    if(data){
                        swal({title:"删除成功！", text:"您已经永久删除了这条信息。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload();
                            }
                        });
                    }else{
                        swal("删除失败！", "角色里有管理员,请先把管理员删除,禁止删除超级管理员!", "error");
                    }
                }
            );
        } else {
            swal("已取消", "您取消了删除操作！", "error");
        }
    });
}



// 全删界面

// 友情链接全删
function confirmDeleteLinkAll(){
    swal({
        title: "您确定要删除这些友情链接吗",
        text: "删除后将无法恢复，请谨慎操作！",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "是的，我要删除！",
        cancelButtonText: "让我再考虑一下…",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                cache: true,
                type: "POST",
                url:"/index.php/Admin/Link/linkDeleteAll",
                data:$('#form_do').serialize(),// 你的formid
                async: false,
                success: 
                function(data) {
                    if(data){
                        swal({title:"删除成功！", text:"您已经永久删除了这些友情链接。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload(true);
                            }
                        });
                    }else{
                        swal("删除失败！", "请选择要删除的友情链接!", "error");
                    }
                }
            });
        } else {
            swal("已取消", "您取消了删除操作！", "error");
        }
    });
}

// 说说全删
function confirmDeleteTalkAll(){
    swal({
        title: "您确定要删除这些说说吗",
        text: "删除后将无法恢复，请谨慎操作！",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "是的，我要删除！",
        cancelButtonText: "让我再考虑一下…",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                cache: true,
                type: "POST",
                url:"/index.php/Admin/Talk/talkDeleteAll",
                data:$('#form_do').serialize(),// 你的formid
                async: false,
                success: 
                function(data) {
                    if(data){
                        swal({title:"删除成功！", text:"您已经永久删除了这些说说。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload(true);
                            }
                        });
                    }else{
                        swal("删除失败！", "请选择要删除的说说!", "error");
                    }
                }
            });
        } else {
            swal("已取消", "您取消了删除操作！", "error");
        }
    });
}

// 留言全删
function confirmDeleteGuestbookAll(){
    swal({
        title: "您确定要删除这些留言吗",
        text: "删除后将无法恢复，请谨慎操作！",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "是的，我要删除！",
        cancelButtonText: "让我再考虑一下…",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                cache: true,
                type: "POST",
                url:"/index.php/Admin/Guestbook/guestbookDeleteAll",
                data:$('#form_do').serialize(),// 你的formid
                async: false,
                success: 
                function(data) {
                    if(data){
                        swal({title:"删除成功！", text:"您已经永久删除了这些留言。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload(true);
                            }
                        });
                    }else{
                        swal("删除失败！", "请选择要删除的留言!", "error");
                    }
                }
            });
        } else {
            swal("已取消", "您取消了删除操作！", "error");
        }
    });
}

// 相册全删
function confirmDeletePhotoAll(){
    swal({
        title: "您确定要删除这些相册吗",
        text: "删除后将无法恢复，请谨慎操作！",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "是的，我要删除！",
        cancelButtonText: "让我再考虑一下…",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                cache: true,
                type: "POST",
                url:"/index.php/Admin/Photo/photoDeleteAll",
                data:$('#form_do').serialize(),// 你的formid
                async: false,
                success: 
                function(data) {
                    if(data){
                        swal({title:"删除成功！", text:"您已经永久删除了这些相册。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload(true);
                            }
                        });
                    }else{
                        swal("删除失败！", "请选择要删除的相册!", "error");
                    }
                }
            });
        } else {
            swal("已取消", "您取消了删除操作！", "error");
        }
    });
}

// 图片全删
function confirmDeletePictureAll(){
    swal({
        title: "您确定要删除这些图片吗",
        text: "删除后将无法恢复，请谨慎操作！",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "是的，我要删除！",
        cancelButtonText: "让我再考虑一下…",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                cache: true,
                type: "POST",
                url:"/index.php/Admin/Picture/pictureDeleteAll",
                data:$('#form_do').serialize(),// 你的formid
                async: false,
                success: 
                function(data) {
                    if(data){
                        swal({title:"删除成功！", text:"您已经永久删除了这些图片。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload(true);
                            }
                        });
                    }else{
                        swal("删除失败！", "请选择要删除的图片!", "error");
                    }
                }
            });
        } else {
            swal("已取消", "您取消了删除操作！", "error");
        }
    });
}

// 文章全删
function confirmDeleteArticleAll(){
    swal({
        title: "您确定要删除这些信息吗",
        text: "删除后将无法恢复，请谨慎操作！",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "是的，我要删除！",
        cancelButtonText: "让我再考虑一下…",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                cache: true,
                type: "POST",
                url:"/index.php/Admin/Article/articleDeleteAll",
                data:$('#form_do').serialize(),// 你的formid
                async: false,
                success: 
                function(data) {
                    // alert(data);
                    if(data){
                        swal({title:"删除成功！", text:"您已经永久删除了这条信息。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                // window.location.reload();
                                window.location.reload(true);
                            }
                        });
                    }else{
                        swal("删除失败！", "请选择要删除的文章!", "error");
                    }
                }
            });
        } else {
            swal("已取消", "您取消了删除操作！", "error");
        }
    });
}
// 权限全删
function confirmDeleteAuthAll(){
    // if(confirm("确定要删除数据吗？")){
    //     subform("authDeleteAll");
    // }
    swal({
        title: "您确定要删除这些信息吗",
        text: "删除后将无法恢复，请谨慎操作！",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "是的，我要删除！",
        cancelButtonText: "让我再考虑一下…",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                cache: true,
                type: "POST",
                url:"/index.php/Admin/Auth/authDeleteAll",
                data:$('#form_do').serialize(),// 你的formid
                async: false,
                success: 
                function(data) {
                    // alert(data);
                    if(data){
                        swal({title:"删除成功！", text:"您已经永久删除了这条信息。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload(true);
                            }
                        });
                    }else{
                        swal("删除失败！", "请选择要删除的权限!", "error");
                    }
                }
            });
        } else {
            swal("已取消", "您取消了删除操作！", "error");
        }
    });
}
// 管理员全删
function confirmDeleteManagerAll(){
    // if(confirm("确定要删除数据吗？")){
    //     subform("managerDeleteAll");
    // }
    swal({
        title: "您确定要删除这些信息吗",
        text: "删除后将无法恢复，请谨慎操作！",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "是的，我要删除！",
        cancelButtonText: "让我再考虑一下…",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                cache: true,
                type: "POST",
                url:"/index.php/Admin/Manager/managerDeleteAll",
                data:$('#form_do').serialize(),// 你的formid
                async: false,
                success: 
                function(data) {
                    // alert(data);
                    if(data){
                        swal({title:"删除成功！", text:"您已经永久删除了这条信息。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload(true);
                            }
                        });
                    }else{
                        swal("删除失败！", "请选择要删除的管理员，或者禁止删除超级管理员!", "error");
                    }
                }
            });
        } else {
            swal("已取消", "您取消了删除操作！", "error");
        }
    });
}
// 文章栏目全删
function confirmDeleteProgramaAll(){
    // if(confirm("确定要删除数据吗？")){
    //     subform("programaDeleteAll");
    // }
    swal({
        title: "您确定要删除这些信息吗",
        text: "删除后将无法恢复，请谨慎操作！",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "是的，我要删除！",
        cancelButtonText: "让我再考虑一下…",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                cache: true,
                type: "POST",
                url:"/index.php/Admin/Programa/programaDeleteAll",
                data:$('#form_do').serialize(),// 你的formid
                async: false,
                success: 
                function(data) {
                    // alert(data);
                    if(data){
                        swal({title:"删除成功！", text:"您已经永久删除了这条信息。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload(true);
                            }
                        });
                    }else{
                        swal("删除失败！", "请选择要删除的栏目，或者栏目里有文章请先把文章删除!", "error");
                    }
                }
            });
        } else {
            swal("已取消", "您取消了删除操作！", "error");
        }
    });
}
// 角色全删
function confirmDeleteRoleAll(){
    // if(confirm("确定要删除数据吗？")){
    //     subform("roleDeleteAll");
    // }
    swal({
        title: "您确定要删除这些信息吗",
        text: "删除后将无法恢复，请谨慎操作！",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "是的，我要删除！",
        cancelButtonText: "让我再考虑一下…",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                cache: true,
                type: "POST",
                url:"/index.php/Admin/Role/roleDeleteAll",
                data:$('#form_do').serialize(),// 你的formid
                async: false,
                success: 
                function(data) {
                    // alert(data);
                    if(data){
                        swal({title:"删除成功！", text:"您已经永久删除了这条信息。", type:"success"},
                        function(isClick){
                            if (isClick) {
                                window.location.reload(true);
                            }
                        });
                    }else{
                        swal("删除失败！", "请选择要删除的角色，或者角色里有管理员请先把管理员删除，或者禁止删除超级管理员!", "error");
                    }
                }
            });
        } else {
            swal("已取消", "您取消了删除操作！", "error");
        }
    });
}