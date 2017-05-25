/**
 * Created by linpeiyu on 2016-08-30.
 */


$('li.dropdown').mouseover(function() {
    $(this).addClass('open');    }).mouseout(function() {        $(this).removeClass('open');    });

$('#myblog_nav').on('show.bs.tab', recent_blog());

$('#mycollect_nav').on('show.bs.tab', recent_collect());
$(".nav-list > li").on("mouseover",function(){

});

function recent_blog()
{
    $.ajax(
        {
            url:'index.php?r=user/recent_blog',
            success:function(data){
                // console.log(data);
                if(data==null)
                {
                    $('#blogContent').html("there is nothing here! ");
                }
                else{
                    //alert("test");
                    $('#blogContent').html(data);
                }

            },
            error:function(data){
                console.log(data);
            }
        }
    );
    //console.log(e.target); // 激活的标签页
    //e.relatedTarget // 前一个激活的标签页
}

function del_blog(id)
{
    confirm("Are you sure to delete this blog");
    $.ajax(
        {

            url:'index.php?r=blog/del',
            data:{id:id},
            type:"POST",
            success:function(){
                recent_blog();

            },
            error:function(){
                alert("delete failed")
            }

        }
    );
}


function recent_collect() {
    // alert('111');
    $.ajax({
        url:"index.php?r=user/recent-collect",
        success:function (data) {
            if(data==null)
            {
                $('#collectContent').html("there is nothing here! ");
            }
            else{
                //alert("test");
                $('#collectContent').html(data);
            }
        },
        error:function (data) {

        }
    })
}





