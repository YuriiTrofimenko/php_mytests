<?php

namespace app\models;

class Question extends \yii\db\ActiveRecord {

    public static function tableName() {
        return 'questions';
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
            [['testId','text_'], 'required'],
            ['text_', 'string', 'max' => 300],
            ['testId', 'integer'],
            ['testId', 'exist', 'targetClass' => Test::className(), 'targetAttribute' => 'id']
        ];
    }

    public function attributeLabels() {
        return [
            'testId' => 'Тест',
            'text_' => 'Вопрос',
        ];
    }

    public function getTest() {
        return self::hasOne('app\models\Test', ['id' => 'testId']);
    }

     public function getAnswers() {
         return $this->hasMany(Answer::className(), ['questionId' => 'id']);
     }

    public function getTrueAnswers() {
        return $this->hasMany(Answer::className(), ['questionId' => 'id'])
            ->where(['isTrue' => 1]);
    }
}
