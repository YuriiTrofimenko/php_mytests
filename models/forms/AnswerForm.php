<?php

namespace app\models\forms;

use app\models\Answer;
use yii\base\ArrayableTrait;
use yii\helpers\ArrayHelper;

class AnswerForm extends \yii\base\Model {
    public $isTrue;
    public $text_;

    public function rules() {
        return [
            ['text_', 'string', 'max' => 300, 'on' => ['create', 'update']],
            ['isTrue', 'boolean', 'trueValue' => 1, 'on' => ['create', 'update']]
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'isTrue' => 'Правильность ответа',
            'text_' => 'Ответ',
        ];
    }

}