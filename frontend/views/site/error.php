<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<!-- Main content -->
            <h1><?= $name ?></h1>

            <h1>
                <?= nl2br(Html::encode($message)) ?>
                </h1>


