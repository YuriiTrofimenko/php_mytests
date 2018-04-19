<?php

use yii\grid\GridView;

$this->params['breadcrumbs'][] = ['label' => 'Тесты', 'url' => \yii\helpers\Url::to(['test/index'])];

$this->params['breadcrumbs'][] = [
    'label' => $model->test->name,
    'url' => \yii\helpers\Url::to(['test/view', 'id' => $model->test->id])
];

$this->params['breadcrumbs'][] = ['label' => 'Вопрос: ' . $model->id]

?>

<h1>Вопрос: <?= $model->id ?></h1>

<p><?= $model->text_ ?></p>

<div class="row">
    <div class="col-md-12">
        <a class="btn btn-default pull-right" href="<?= \yii\helpers\Url::to(['answer/add', 'questionId' => $model->id]) ?>">
            <i class="glyphicon glyphicon-plus"></i> Добавить ответ
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'id',
                'text_',
                [
                    'attribute' => 'isTrue',
                    'value' => function($model) {
                        return $model->isTrue ?
                            '<i class="glyphicon glyphicon-ok"></i>' :
                            '';
                    },
                    'format' => 'raw'
                ],
                [
                    'class' => \yii\grid\ActionColumn::className(),
                    'urlCreator' => function($action, $model) {
                        return \yii\helpers\Url::to(["answer/$action", 'id' => $model->id]);
                    },
                    'template' => '{update} {delete}'
                ]
            ]
        ]) ?>
    </div>
</div>
