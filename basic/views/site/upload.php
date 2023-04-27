<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
/* @var $model app\models\UploadImage */

$this->title = 'Upload Images (Images API)';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Upload Images!</h1>

        <p class="lead">You can upload not more 5 images.</p>

    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-xs-8 offset-xs-2 col-lg-4 offset-lg-4">
                <?php $form = ActiveForm::begin(['id' => 'width', 'options' => ['class' => 'col-12'], 'method' => 'post', ]);?>
                    <?= $form->field($model, 'files[]')
                        ->fileInput(['name' => 'files[]', 'value' => 'none',
                            'accept' => 'image/png,image/jpeg', 'multiple' => 'true', 'id' => 'files'])
                        ->label('<div class="btn btn-primary col-12">Choose images</div>', ['class' => 'col-12']); ?>
                    <div id="warning" class="warning "></div>
                    <div class="form-group">
                        <?= Html::submitButton('Upload', ['class' => 'btn btn-outline-success col-12', 'id' => 'upload', 'disabled' => 'true']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
