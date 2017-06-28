<?php
/**
 * Created by PhpStorm.
 * User: Slowbro
 * Date: 17/5/10
 * Time: PM4:29
 */
use \yii\bootstrap\Html;

?>


<div class="panel panel-default" style="margin: 20px auto;width: 95%">
    <?php foreach($lists as $list){ ?>
        <div class="panel-body">
            <a href="<?php echo \yii\helpers\Url::toRoute('blog/info').'&id='.$list['id'] ?>"><?= $list['blog']['title'] ?></a>
            <a style="float: right;padding-left: 10px" href="#" onclick="del_blog(<?php echo $list['blog']['id'] ?>)">删除</a>
            <a style="float: right;" href="<?php echo \yii\helpers\Url::toRoute('blog/edit').'&id='.$list['blog']['id'] ?>">编辑</a>
        </div>
    <?php } ?>
</div>

<div style="margin: 10px auto">

    <a href="index.php?r=catalog/list">
        <button type="button" class="btn btn-success">查看所有收藏</button>
    </a>
</div>
