<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '分享主页';
$this->params['breadcrumbs'] = null;

?>

<h1> 欢迎来到分享主页 </h1>

<div class="share-user-form">


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nickName')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '确认分享' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
