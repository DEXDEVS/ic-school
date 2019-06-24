<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MarksHead */
?>
<div class="marks-head-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'marks_head_id',
            'exam_criteria_id',
            'std_id',
            'grand_total',
            'percentage',
            'grade',
            'exam_status',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
