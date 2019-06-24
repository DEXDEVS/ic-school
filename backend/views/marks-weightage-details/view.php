<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MarksWeightageDetails */
?>
<div class="marks-weightage-details-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'weightage_detail_id',
            'weightage_head_id',
            'weightage_type_id',
            'marks',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
