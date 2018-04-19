<?php

use yii\grid\GridView;

$this->params['breadcrumbs'][] = ['label' => 'Категории'];

?>

<div class="row">
    <div class="col-md-12">
        <a class="btn btn-default pull-right" href="<?= \yii\helpers\Url::to(['category/add']) ?>">
            <i class="glyphicon glyphicon-plus"></i> Добавить Категорию
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php if($deleteConfirmation = \Yii::$app->session->getFlash('children-delete-confirmation')) {?>
            <div class="alert alert-warning alert-dismissible" role="alert">
                <span>Эта категория является родительской. Подтвердите удаление.</span>
                <form method="post" action="<?=\yii\helpers\Url::to(['category/delete', 'id' => $deleteConfirmation['categoryId']]) ?>">
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>" />
                    <button type="submit" name="remove-all" value="1" class="btn btn-primary">Удалить</button>
                </form>
                <button type="button" data-dismiss="alert" aria-label="Cancel">Отменить</button>
            </div>
        <?php } ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'id',
                'name',
                [
                    'label' => 'Родительская категория',
                    'value' => 'parent.name'
                ],
                [
                    'class' => \yii\grid\ActionColumn::className(),
                    'template' => '{update} {delete}'
                ]
            ]
        ]) ?>
    </div>
</div>
