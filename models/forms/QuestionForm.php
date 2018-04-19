<?php

namespace app\models\forms;

use app\models\Test;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class QuestionForm extends Model
{
    public $id;
    public $text_;

    public function rules() {
        return [
            [['text_'], 'required', 'on' => ['create','update']],
            ['text_', 'string', 'max' => 300, 'on' => ['create','update']],
        ];
    }

    public function attributeLabels() {
        return [
            'testId' => 'Тест',
            'text_' => 'Вопрос',
        ];
    }

    public function getParentOptions() {
        $query = Test::find();

        return ArrayHelper::map($query->all(), 'id', 'name');
    }

}