<?php

namespace app\models;

class Category extends \yii\db\ActiveRecord {

    public static function tableName() {
        return 'categories';
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
            [['name'], 'required'],
            ['name', 'string', 'max' => 100],
            ['name', 'unique', 'targetAttribute' => ['name', 'parentId']],
        ];
    }

    public function attributeLabels() {
        return [
            'name' => 'Название',
            'parentId' => 'Родительская категория'
        ];
    }

    public function getChildCategories() {
        return self::hasMany(self::className(), ['parentId' => 'id']);
    }

    public function getParent() {
        return self::hasOne(self::className(), ['id' => 'parentId']);
    }

    public function getTests() {
        return self::hasMany(Test::className(), ['categoryId' => 'id']);
    }
}