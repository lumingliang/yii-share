<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\base\testIoGii */

$this->title = 'Update Test Io Gii: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Test Io Gii', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', ]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="test-io-gii-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
