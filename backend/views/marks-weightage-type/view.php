<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MarksWeightageType */
?>
<div class="marks-weightage-type-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'weightage_type_id',
            'weightage_type_name',
            'weightage_type_description',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
