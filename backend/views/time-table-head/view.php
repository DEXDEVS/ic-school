<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TimeTableHead */
?>
<div class="time-table-head-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'time_table_h_id:datetime',
            'class_id',
            'days',
            'status',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
