<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'SignUp';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Пожалуйста, заполните следующие поля, чтобы зарегистрироваться:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'options' => ['class' => 'col s12 m6'],
        'fieldConfig' => [
            'template' => "<div class=\"input-field col s12\">\n{input}\n{label}\n<div class=\"col s12\">{error}</div></div>",
            'labelOptions' => ['class' => ''],
            'options' => [
                'tag' => false,
            ],
        ],
    ]); ?>

        <div class="row">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'validate', ['placeholder' => "Placeholder"]]) ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
        </div>
        <?= Html::submitButton('SignUp<i class="material-icons right">send</i>', ['class' => 'btn waves-effect waves-light', 'name' => 'login-button']) ?>

    <?php ActiveForm::end(); ?>
</div>
<script type="text/javascript">
    /*var preloaderHide = function() {
        $(".preloader-wrapper").css("display", "none");
    }
    preloaderHide();*/
    /*var preloader = document.getElementsByClassName('preloader-wrapper')[0];
    preloader.style.display = "none";*/
</script>
