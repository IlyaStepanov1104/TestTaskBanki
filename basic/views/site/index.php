<?php

/** @var yii\web\View $this */

$this->title = 'Images API';

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Images API!</h1>

        <p class="lead">You can upload not more 5 images.</p>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">
                <h2>Upload images</h2>
                <p>You can upload images in this site!</p>
                <p><?= Html::a('Upload', ['/site/upload'], ['class' => 'btn btn-outline-secondary'])?></p>
            </div>
            <div class="col-lg-6">
                <h2>View images information</h2>

                <p>You can view information about all upload images!</p>

                <p><?= Html::a('View', ['/site/view'], ['class' => 'btn btn-outline-secondary'])?></p>
            </div>
        </div>

    </div>
</div>
