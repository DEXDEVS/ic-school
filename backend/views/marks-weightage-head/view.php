<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MarksWeightageHead */
?>
<div class="marks-weightage-head-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'marks_weightage_id',
            'exam_category_id',
            // 'class_id',
            // 'subjects_id',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
        ],
    ]) ?>

</div>
