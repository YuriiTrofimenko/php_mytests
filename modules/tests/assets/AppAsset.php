<?php

namespace app\modules\tests\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/tests/web';

    public $css = [
        'css/materialize.min.css',
        '//fonts.googleapis.com/icon?family=Material+Icons',
        'css/custom.css',
    ];
    public $js = [
        'js/materialize.min.js',
        'js/jquery-hashchange.js',
        'js/hogan-3.0.2.min.js',
        'js/app.js',
        'js/init.js',
    ];
    public $depends = [
    	'yii\web\YiiAsset',
    ];
}