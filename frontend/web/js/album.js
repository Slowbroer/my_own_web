/**
 * Created by Slowbro on 17/12/12.
 */


$(function () {
    var getCode = $("#getCode");
    getCode.on("click",function(){
        showLink();
    });
    $("#linkForm").on("beforeSubmit",function () {
           // alert(111);
        $.ajax({
            url:"index.php?r=album/download-link",
            type:"post",
            data:$(this).serialize(),
            success:function (data) {
                data = eval("("+data+")");

                if(data.code==0)
                {
                    alert("获取失败");
                }
                else if(data.code == 1)
                {
                    getCode.html(data.link_pw);
                    getCode.unbind('click');
                }
                else if(data.code == 2)
                {
                    getCode.html("专辑还没有下载链接哦");
                    getCode.unbind('click');
                }
                $("#linkModel").modal("hide");
            },
            error:function (data) {

            }
        });
        return false;
    });
});
function showLink() {
    // alert('111');
    $("#linkModel").modal("show");
}
function praiseComment(id,ele) {
    $.ajax({
        url:"",//TODO::url
        data:"id="+id,
        type:"get",
        success:function (data) {
//                console.log(data);
//                alert(data);
            data=eval("("+data+")");
            if(data.code==1)
            {
                // alert("111");
                $(ele).attr("onclick",'');
                $(ele).attr("class",'glyphicon glyphicon-heart')
            }
        },
        error:function () {

        }
    });
}
