<?php

namespace app\models;

class Test extends \yii\db\ActiveRecord {

    public static function tableName() {
        return 'tests';
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
            [['questions','name', 'categoryId','description'], 'required'],
            ['name', 'string', 'max' => 100],
            ['description', 'string', 'max' => 300],
            ['categoryId', 'integer'],
            ['categoryId', 'exist', 'targetClass' => Category::className(), 'targetAttribute' => 'id'],
            [['name'], 'unique', 'targetAttribute' => ['name', 'categoryId']],
            ['questions', 'integer']
        ];
    }

    public function attributeLabels() {
        return [
            'name' => 'Название',
            'categoryId' => 'Родительская категория',
            'questions' => 'Количество вопросов',
            'description' => 'Описание'
        ];
    }

    public function getCategory() {
        return self::hasOne('app\models\Category', ['id' => 'categoryId']);
    }

    public function getQuestion() {
        return self::hasMany(Question::className(), ['testId' => 'id']);
    }
}