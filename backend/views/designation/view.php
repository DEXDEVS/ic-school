<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Designation */
?>
<div class="designation-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'designation_id',
            'designation',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
