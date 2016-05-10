<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ShareUserSearch */
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
            // [
                // 'attribute' => 'id',
                // 'header' => '用户id',
            // ],
            'nick_name',
            'created_at',
            [
                'attribute' => 'view_times',
                'content' => function($model, $key) {
                    //return Html::tag('a', '查看详情', ['href'])
                    return Html::a(Html::tag('span', $model->view_times, ['class' => 'badge']).'&nbsp&nbsp查看详情', Url::to(['share-user/view-peoples', 'id' => $model->id]), ['class' => 'label label-primary']);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn', 
                'header' => '操作',
                'template' => '{view} {delete}',
                'buttons' => [
                    'view' => function($url, $model, $key) {
                        return Html::a('查看', $url, ['class' => 'btn btn-xs btn-primary']);
                    },
                    'update' => function($url, $model, $key) {
                        return Html::a('更新', $url, ['class' => 'btn btn-xs btn-success']);
                    },
                    'delete' => function($url, $model, $key) {
                        return Html::a('删除', $url, ['class' => 'btn btn-xs btn-danger', 'title' => 'delete', 'data-confirm' => '您确定要删除吗', 'data-method' => 'post', 'data-pjax' => '0']);
                    },
                ],
            ],
            // [
                // 'class' => 'yii\grid\CheckboxColumn',
            // ]
        ],
        'summary' => '第{begin}-{end}条，共{totalCount}条数据.',
        'summaryOptions' => [
            'class' => 'h5 pull-left',
        ],
        'layout' => "{items}\n{summary}\n{pager}",
        'pager' => [
            'options' => ['class' => 'pagination pull-right reset margin top bottom'],
        ],
    ]); ?>

</div>
