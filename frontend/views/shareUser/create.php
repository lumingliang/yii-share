<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ShareUser */

$this->title = 'Create Share User';
$this->params['breadcrumbs'][] = ['label' => 'Share Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="share-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
