<?php

use yii\grid\GridView;

?>

<div class="row">
    <div class="col-md-12">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'id',
                'text_',
                [
                    'label' => 'Тест',
                    'value' => 'test.name'
                ]
                ,
                [
                    'class' => \yii\grid\ActionColumn::className(),
                ]
            ]
        ]) ?>
    </div>
</div>
