<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\base\testIoGii */

$this->title = 'Create Test Io Gii';
$this->params['breadcrumbs'][] = ['label' => 'Test Io Gii', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-io-gii-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
