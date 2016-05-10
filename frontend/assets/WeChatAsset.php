<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class WeChatAsset extends AssetBundle {

    public $basePath = '@webroot/wechatShare';
    public $baseUrl = '@web/wechatShare';
    public $css = [
        'css/main.css',
    ];

    public $js = [
        
    ];

    public $depends = [
        //依赖的其他需要先打开的资源
        
    ];

}
