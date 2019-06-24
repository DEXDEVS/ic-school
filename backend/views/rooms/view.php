<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Rooms */
?>
<div class="rooms-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'room_id',
            'room_name',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
