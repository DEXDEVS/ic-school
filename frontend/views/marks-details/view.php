<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MarksDetails */
?>
<div class="marks-details-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'marks_detail_id',
            'marks_head_id',
            'subject_id',
            'obtained_marks',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
