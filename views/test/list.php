<?php

use yii\grid\GridView;

$this->params['breadcrumbs'][] = ['label' => 'Тесты'];

?>

<div class="row">
    <div class="col-md-12">
        <a class="btn btn-default pull-right" href="<?= \yii\helpers\Url::to(['test/add']) ?>">
            <i class="glyphicon glyphicon-plus"></i> Добавить тест
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'id',
                'name',
                [
                    'label' => 'Категория',
                    'value' => 'category.name'
                ],
                'questions'
                ,
                [
                    'class' => \yii\grid\ActionColumn::className(),
                ]
            ]
        ]) ?>
    </div>
</div>
