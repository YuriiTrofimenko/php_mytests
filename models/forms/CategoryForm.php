<?php

namespace app\models\forms;

use app\models\Category;
use yii\base\ArrayableTrait;
use yii\helpers\ArrayHelper;

class CategoryForm extends \yii\base\Model {
    public $id;
    public $name;
    public $parentId;

    public function rules() {
        return [
            ['name', 'required', 'on' => ['create', 'update']],
            ['name', 'string', 'max' => 100, 'on' => ['create', 'update']],
            ['parentId', 'integer'],
            ['parentId', 'exist', 'targetClass' => 'app\models\Category', 'targetAttribute' => 'id', 'on' => ['create', 'update']],
            ['name', 'unique', 'targetClass' => 'app\models\Category', 'targetAttribute' => ['name', 'parentId'], 'on' => ['create']],

            ['name', 'unique', 'targetClass' => 'app\models\Category', 'targetAttribute' => ['name', 'parentId'],
                'on' => ['update'], 'filter' => ['!=', 'id', $this->id]
            ],

            ['id', 'required', 'on' => ['update']],
            ['id', 'integer', 'on' => ['update']],
            ['id', 'exist', 'targetClass' => 'app\models\Category', 'on' => ['update']],
            ['parentId', 'compare', 'compareAttribute' => 'id', 'operator' => '!=', 'on' => ['update']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'parentId' => 'Родительская категория',
        ];
    }

    public function save()
    {
        if($this->validate())
        {
            switch($this->scenario) {
                case 'create' :
                    $category = new Category();
                    $category->name=$this->name;
                    $category->parentId=$this->parentId;
                    if ($category->save()) {
                        return true;
                    };
                    break;
                case 'update' :
                    $category = Category::findOne($this->id);
                    $category->name=$this->name;
                    $category->parentId=$this->parentId;
                    if ($category->save()) {
                        return true;
                    };
                    break;
            }
        }

        return false;
    }

    public function getParentOptions() {   
        $query = Category::find();

        if ($this->scenario == 'update') {
            $query->andWhere(['!=', 'id', $this->id]);
        }

        return ArrayHelper::map($query->all(), 'id', 'name');
    }
}