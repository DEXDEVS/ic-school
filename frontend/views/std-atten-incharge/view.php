<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\StdAttenIncharge */
?>
<div class="std-atten-incharge-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'atten_id',
            'branch_id',
            'teacher_id',
            'class_name_id',
            'session_id',
            'section_id',
            'date',
            'std_id',
            'attendance',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
