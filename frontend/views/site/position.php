<?php
/**
 * Created by PhpStorm.
 * User: Slowbro
 * Date: 17/10/12
 * Time: PM4:24
 */



?>




<script>
    function getLocation(){
        if (navigator.geolocation){

            navigator.geolocation.getCurrentPosition(showPosition,showError);
        }else{
            alert("浏览器不支持地理定位。");
        }
    }
    function showError(error){
//        console.log(error.code);

        switch(error.code) {
            case error.PERMISSION_DENIED:
                alert("定位失败,用户拒绝请求地理定位");
                break;
            case error.POSITION_UNAVAILABLE:
                alert("定位失败,位置信息是不可用");
                break;
            case error.TIMEOUT:
                alert("定位失败,请求获取用户位置超时");
                break;
            case error.UNKNOWN_ERROR:
                alert("定位失败,定位系统失效");
                break;
        }
    }
    function showPosition(position){
        var lat = position.coords.latitude; //纬度
        var lag = position.coords.longitude; //经度
        alert('纬度:'+lat+',经度:'+lag);
    }


    getLocation();
</script>