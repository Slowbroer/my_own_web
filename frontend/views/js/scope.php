<?php
/**
 * Created by PhpStorm.
 * User: Slowbro
 * Date: 17/2/25
 * Time: 下午4:16
 * javascript 函数作用域链
 */


?>


<?= \yii\bootstrap\Html::encode("函数作用域：变量在声明它们的函数体以及这个函数体嵌套的任意函数体内都是有定义的;")?>


<script>

    var scope="global";

    function a() {
        console.log(scope);
    }
    a();//print the 'global'


//    一个函数内部任何位置定义的变量，在该函数内部任何地方都可见
//    即函数t和等同函数b
    function t(){
        console.log(scope);// undefined
        var scope="local";//函数里面定义了
        console.log(scope);//local
    }
    t();
    function b() {
        var scope;
        console.log(scope);
        scope = 'b';
        console.log(scope);
    }
    b();


    



    function c() {
        c = "c";
        console.log(c);
//        var c;
    }
    c();

</script>
