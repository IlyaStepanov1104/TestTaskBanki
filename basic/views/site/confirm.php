<?php

/** @var yii\web\View $this */

$this->title = 'Images API';
/* @var $model app\models\UploadImage */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4"> Successful upload!</h1>
        <p class="lead">You upload <?=count($model->files)?> images!</p>
        <p><?= Html::a('Upload more', ['/site/upload'], ['class' => 'btn btn-outline-secondary'])?></p>
    </div>
</div>
