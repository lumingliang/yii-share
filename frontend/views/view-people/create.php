<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\ViewPeople */

$this->title = 'Create View People';
$this->params['breadcrumbs'][] = ['label' => 'View Peoples', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="view-people-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
