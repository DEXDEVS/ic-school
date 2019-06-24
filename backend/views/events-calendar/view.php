<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\EventsCalendar */
?>
<div class="events-calendar-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'calendar_id',
            'title',
            'description',
            'date',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
