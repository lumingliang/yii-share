<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ViewPeoPleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'View Peoples';
$this->params['breadcrumbs'][] = Null;
?>
<div class="view-people-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'mobileMime',
            'shareuserId',
            'created_at',
            [
                'class' => 'yii\grid\ActionColumn', 
                'header' => '操作',
                'template' => '{delete}',
                'controller' => 'view-people',
                'buttons' => [
                    'delete' => function($url, $model, $key) {
                        return Html::a('删除', $url, ['class' => 'btn btn-xs btn-danger', 'title' => 'delete', 'data-confirm' => '您确定要删除吗', 'data-method' => 'post', 'data-pjax' => '0']);
                    },
                ],
            ],
        ],
    ]); ?>

</div>
