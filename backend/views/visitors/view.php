<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Visitors */
?>
<div class="visitors-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'visitor_id',
            'visitor_name',
            'visitor_contact_no',
            'visitor_photo',
            'visitor_cnic',
            'date_time',
            'visit_purpose',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
