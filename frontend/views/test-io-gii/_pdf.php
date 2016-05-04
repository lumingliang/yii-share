<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model frontend\models\base\testIoGii */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Test Io Gii', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-io-gii-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Test Io Gii'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'hidden' => true],
        'name',
        'email:email',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
