<?php

use yii\bootstrap\ActiveForm;

?>

<div class="row">
    <div class="col-md-12 text-center">
        <?php if ($model->scenario == 'create') { ?>
            <h3>Новый вопрос</h3>
        <?php } else { ?>
            <h3>Редактирование вопроса</h3>
        <?php } ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <?php $form = ActiveForm::begin([

        ]) ?>

        <?= $form->field($model, 'text_') ?>

        <div class="form-group">
            <button type="submit" class="btn btn-primary pull-right">Сохранить</button>
        </div>

        <?php $form->end() ?>
    </div>
</div>