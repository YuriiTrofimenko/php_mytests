<?php

namespace app\models\forms;

use app\models\Category;
use app\models\Test;
use yii\base\Exception;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\Validators\UniqueValidator;

class TestForm extends Model
{
    public $categoryId;
    public $name;
    public $description;

    private $_id;
    private $_test;

    public function setTest($test) {
        if (!$test instanceof Test) {
            throw new Exception('объект не является тестом');
        }

        $this->_test = $test;
        $this->categoryId = $test->categoryId;
        $this->name = $test->name;
        $this->description = $test->description;
    }

    public function getTest() {
        return $this->_test;
    }

    public function getId() {
        if ($this->_test) {
            return $this->_test->id;
        }

        return null;
    }
    
    public function rules()
    {
        return [
            [['name', 'categoryId', 'description'], 'required', 'on' => ['create','update']],
            ['name', 'string', 'max' => 100, 'on' => ['create','update']],
            ['categoryId', 'integer'],
            ['categoryId','exist', 'targetClass' => 'app\models\Category', 'targetAttribute' => 'id', 'on' => ['create', 'update']],
            [['name'], 'unique', 'targetClass' => 'app\models\Test', 'targetAttribute' => ['name', 'categoryId']],
            ['description', 'string', 'max' => '300'],

            ['id', 'required', 'on' => ['update']],
        ];
    }

    public function save()
    {
        if($this->validate())
        {
            switch($this->scenario) {
                case 'create' :
                    $test = new Test();
                    $test->categoryId = $this->categoryId;
                    $test->name = $this->name;
                    $test->questions = 0;
                    $test->description = $this->description;
                    if ($test->save()) {
                        return true;
                    };
                    break;
                case 'update' :
                    $test = $this->test;
                    $test->categoryId = $this->categoryId;
                    $test->name = $this->name;
                    $test->description = $this->description;
                    if ($test->save()) {
                        return true;
                    };
                    break;
            }
        }

        return false;
    }

    /*public function beforeValidate() {
        if (empty($this->idParent)) { $this->idParent = null;}

        return parent::beforeValidate();
    }*/

    public function attributeLabels() {
        return [
            'name' => 'Название',
            'categoryId' => 'Категория',
            'questions' => 'Кол-во вопросов',
            'description' => 'Описание',
        ];
    }

    public function getParentOptions() { //эт я не тупо скопипастил, а специально. Здесь нужен точно такойже массив.
        $query = Category::find();

        return ArrayHelper::map($query->all(), 'id', 'name');
    }

}