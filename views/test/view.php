<?php

use yii\widgets\DetailView;
use yii\grid\GridView;

$this->params['breadcrumbs'][] = ['label' => 'Тесты', 'url' => ['test/index']];

$this->params['breadcrumbs'][] = ['label' => $model->name];


?>

<h1>Тест: <?= $model->id ?></h1>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'name',
                'description',
                'questions',
                'createdAt'
            ]
        ]) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <a class="btn btn-default pull-right" href="<?= \yii\helpers\Url::to(['question/add', 'testId' => $model->id]) ?>">
            <i class="glyphicon glyphicon-plus"></i> Добавить вопрос
        </a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?= GridView::widget([
            'dataProvider' => $provider,
            'columns' => [
                'id',
                'text_',
                [ 
                    'class' => \yii\grid\ActionColumn::className(),
                    'urlCreator' => function($action, $model){
                        return \yii\helpers\Url::to(["question/$action", 'id' => $model->id]);
                    },                    
                ]
            ]
        ])?>
    </div>
</div> 