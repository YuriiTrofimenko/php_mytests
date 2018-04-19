<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php

$this->title = 'Ответы';
$this->params['breadcrumbs'][] = $this->title;
$answer=new \app\models\Answer();
?>

<div>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Заполните поля для ответа:</p>

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'text_')->textInput() ?>

    <?= $form->field($model, 'isTrue')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>
</div>