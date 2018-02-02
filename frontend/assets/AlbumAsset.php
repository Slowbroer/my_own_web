<?php
/**
 * Created by PhpStorm.
 * User: Slowbro
 * Date: 17/12/12
 * Time: AM11:18
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class AlbumAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        "js/album.js",
    ];
    public $css = [
        'css/album.css'
    ];
}