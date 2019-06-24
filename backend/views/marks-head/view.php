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
            'exam_category_id',
            'class_head_id',
            'std_id',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
