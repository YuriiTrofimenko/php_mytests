<?php

namespace app\modules\tests;

/**
 * tests module definition class
 */
class TestsModule extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\tests\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        $this->layout = 'tests';
    }
}
