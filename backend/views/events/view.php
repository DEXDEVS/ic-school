<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Events */
?>
<div class="events-view">
 <?php 

    $created_by = $model->created_by;
    $updated_by = $model->updated_by;

    $createdBy = Yii::$app->db->createCommand("SELECT username FROM user WHERE id = '$created_by'")->queryAll();
    if (!empty($createdBy)) {
        $createdBy = $createdBy[0]['username'];
        // $createdBy = $createdBy;
    }
    $updatedBy = Yii::$app->db->createCommand("SELECT username FROM user WHERE id = '$updated_by'")->queryAll();
    if (!empty($updatedBy)) {
        $updatedBy = $updatedBy[0]['username'];
        //$updatedBy = "<span class='label label-default'>$updatedBy</span>";
    }
    else{
        $updatedBy = "<span class='label label-default'>Not Updated</span>";
    }
    
 ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'event_id',
            'event_title',
            'event_detail:ntext',
            'event_venue',
            'event_start_datetime',
            'event_end_datetime',
            'created_at',
            'updated_at',
            'is_status',
            [
             'attribute' => 'created_by',
             'format'=>'raw',
             'value'=> $createdBy,
            ],  
            [
             'attribute' => 'updated_by',
             'format'=>'raw',
             'value'=>  $updatedBy,
            ],
        ],
    ]) ?>

</div>
