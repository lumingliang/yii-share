<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ShareUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Share Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="share-user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Share User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nickName',
            'created_at',
            'updated_at',
            'viewTimes:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
