<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ShareUser */

$this->title = 'Update Share User: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Share Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="share-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
