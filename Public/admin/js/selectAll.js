//高版本必须用prop
$(function() { 
    $(".check-all:checkbox").click(function(){
        $(".ids:checkbox").prop("checked", this.checked);
    });
    $(".ids:checkbox").click(function(){
        var option = $(".ids");
        option.each(function(i){
            if(!this.checked){
                $(".check-all:checkbox").prop("checked", false);
                return false;
            }else{
                $(".check-all:checkbox").prop("checked", true);
            }
        });
    });
});


// 选择多选框   老版本用onclick效果的 
// function selectAll()
// { 
//     // alert("hehe");
//     // alert(document.getElementById("choose").checked);
//     if(document.getElementById("choose").checked==false){
//         for(var i=0;i<document.getElementsByName("ID_Delete[]").length;i++){
//             document.getElementsByName("ID_Delete[]")[i].checked=false;
//         }
//     }  
//     if(document.getElementById("choose").checked==true){
//         for(var i=0;i<document.getElementsByName("ID_Delete[]").length;i++){ 
//             document.getElementsByName("ID_Delete[]")[i].checked=true;
//         }
//     }
// }