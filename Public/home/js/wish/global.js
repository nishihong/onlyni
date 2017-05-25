// JavaScript Document
$(function() {
    var tmp;
    $('.paper').each(function() {
        tmp = $(this).css('z-index');
        if (tmp > zIndex)
            zIndex = tmp;
    })

    make_draggable($('dl'));

    $("#fancy").fancybox({
        'type': 'ajax',
        'modal': true,
        'titleShow': false,
    });

    $("#color li").live('click', function() {
        $(this).addClass("current").siblings().removeClass("current");
    });

    $("#addbtn").live('click', function(e) {
        var txt = $("#content_msg").val();
        var username = $("#username").val();
        if (username == "") {
            alert("请输入您的昵称！");
            // $("#username").html("请输入您的姓名！");
            $("#username").focus();
            return false;
        }
        if (txt == "") {
            $("#content_msg").focus();
            return false;
        }
        var left = 0;
        var top = 0;
        var color_id = $("#color").children("li.current").attr("data-color-id");
        var data = {
            'zIndex': ++zIndex,
            'content': txt,
            'username': username,
            'left': left,
            'top': top,
            "color_id": color_id
        };
        $.post('/index.php/Home/Wish/add', data, function(msg) {
            zIndex = zIndex++;
            if (parseInt(msg)) {
                var str = "<dl class='paper a" + color_id + " ui-draggable' data-id='" + msg + "' style='left:" + left + "px;top:" + top + "px;z-index:" + zIndex + "'>\n\
                    <dt><span class='username'>" + username + "</span><span class='num'>No." + zIndex + "</span></dt>\n\
                    <dd class='content'>" + txt + "</dd><dd class='bottom'><span class='time'>刚刚</span>\n\
                    <a class='close' href='javascript:void(0);'></a></dd></dl>";
                $(".container").append(str);
                make_draggable($('dl'));
                $.fancybox.close();
            } else {
                alert(msg);
            }
        });
        e.preventDefault();
    });
    $("#box_close").live('click', function(e) {
        $.fancybox.close();
    });
    $(".close").live('click', function(e) {
        var obj_close = $(this);
        var id = obj_close.parents("dl").attr("data-id");
        $.get("/index.php/Home/Wish/delete", {id: id}, function(data) {
            if (data == 1) {
                obj_close.parents("dl").fadeOut();
            }
        }, "json")
    });

    $(".lock").live('click', function(e) {
        var obj_close = $(this);
        var id = obj_close.parents("dl").attr("data-id");
        $.get("/index.php/Home/Wish/lock", {id: id}, function(data) {
            window.location.reload(true);
        }, "json")
    });

    $('#content_msg').live('keyup', function (){
        var content = $(this).val();
        var lengths = check(content);  //调用check函数取得当前字数

        //最大允许输入50个字
        if (lengths[0] >= 50) {
            $(this).val(content.substring(0, Math.ceil(lengths[1])));
        }

        var num = 50 - Math.ceil(lengths[0]);
        var msg = num < 0 ? 0 : num;
        //当前字数同步到显示提示
        $( '#font-num' ).html( msg );
    });
});

var zIndex = 0;
function make_draggable(elements) {
    elements.draggable({
        handle: 'dt', //拖动把手
        opacity: 0.8,
        containment: 'parent', //拖动范围 
        start: function(e, ui) {
            ui.helper.css('z-index', ++zIndex)
        },
        stop: function(e, ui) {
            $.get('/index.php/Home/Wish/updatePosition', {
                x: ui.position.left,
                y: ui.position.top,
                z: zIndex,
                id: parseInt(ui.helper.attr("data-id"))
            });
        }
    });
}

/**
 * 统计字数
 * @param  字符串
 * @return 数组[当前字数, 最大字数]
 */
function check (str) {
    var num = [0, 50];
    for (var i=0; i<str.length; i++) {
        //字符串不是中文时
        if (str.charCodeAt(i) >= 0 && str.charCodeAt(i) <= 255){
            num[0] = num[0] + 0.5;//当前字数增加0.5个
            num[1] = num[1] + 0.5;//最大输入字数增加0.5个
        } else {//字符串是中文时
            num[0]++;//当前字数增加1个
        }
    }
    return num;
}
