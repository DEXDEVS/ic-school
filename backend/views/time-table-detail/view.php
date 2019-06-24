<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TimeTableDetail */
?>
<div class="time-table-detail-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'time_table_d_id:datetime',
            'time_table_h_id:datetime',
            'subject_id',
            'start_time',
            'end_time',
            'room',
            'created_by',
            'update_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
