<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\ShareUser */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Share Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="share-user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nick_name',
            'created_at',
            'view_times',
            'open_id',
            'share_cookie',
            'weixin_nick_name',
        ],
    ]) ?>

</div>
