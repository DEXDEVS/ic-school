<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TimeTableHead */

?>
<div class="time-table-head-create">
    <?= $this->render('_form', [
        'model' => $model,
        'timeTableDetails' => $timeTableDetails,
    ]) ?>
</div>
