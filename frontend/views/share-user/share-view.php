<?php

use yii\helpers\Html;

$this->title = '链接分享 ';
$this->params['breadcrumbs'] = Null;

?>

<div>
    <h1> <?= $model->nickName.'向您分享了一个好玩的!' ?> </h1>
    <br>
以下是分享内容
</div>

已经被分享<?= $model->viewTimes ?>次

