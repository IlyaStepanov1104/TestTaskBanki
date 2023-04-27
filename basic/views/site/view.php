
<?php

/** @var yii\web\View $this */
/* @var $images array */
/* @var $sort string */

$this->title = 'Images API';

use yii\helpers\Html;
?>
<div class="site-index">
    <div id="back"></div>
    <div id="front"></div>
    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4 col-12">View</h1>
        <div class="btn-group" role="group" style="margin-bottom: 10px">
            <input type="radio" class="btn-check" name="btnradio" id="radio1" autocomplete="off" <?php if ($sort == 'name') echo 'checked'; ?>>
            <label class="btn btn-outline-primary" for="radio1" id="sort-by-name">Sort be Name</label>

            <input type="radio" class="btn-check" name="btnradio" id="radio2" autocomplete="off" <?php if ($sort == 'time') echo 'checked'; ?>>
            <label class="btn btn-outline-primary" for="radio2"  id="sort-by-time">Sort by Time</label>
        </div>
        <div class="row" style="">
        <?php foreach ($images as $image): ?>
                <div class="image col-md-2 col-s-4">
                    <img src="<?php echo "images/" . $image['path']?>" class="col-md-12 image_scale" alt="<?php echo $image['path']?>">
                    <p class="col-md-12">
                        Image "<i><?php echo $image['path'];?></i>"<br>
                        ID: <i><?php echo $image['id'];?></i><br>
                        Time: <i><?php echo $image['dateTime'];?></i>
                    </p>
                </div>
        <?php endforeach; ?>
        </div>
    </div>
</div>
