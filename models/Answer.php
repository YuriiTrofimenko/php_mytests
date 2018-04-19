<?php

namespace app\models;

class Answer extends \yii\db\ActiveRecord {

    public static function tableName() {
        return 'answers';
    }

    public function behaviors() {
        return [
            [
                'class' => 'yii\behaviors\TimestampBehavior',
                'createdAtAttribute' => 'createdAt',
                'updatedAtAttribute' => 'updatedAt',
                'value' => new \yii\db\Expression('NOW()')
            ]
        ];
    }

    public function rules() {
        return [
            [['questionId','isTrue','text_'], 'required'],
            ['text_', 'string', 'max' => 300],
            ['isTrue', 'boolean', 'trueValue' => 1],
            ['questionId', 'integer'],
            ['questionId', 'exist', 'targetClass' => Question::className(), 'targetAttribute' => 'id']
        ];
    }

    public function attributeLabels() {
        return [
            'questionId' => 'Вопрос',
            'text_' => 'Ответ',
            'isTrue' => 'Правильность'
        ];
    }

    public function getQuestion() {
        return self::hasOne('app\models\Question', ['id' => 'questionId']);
    }
}