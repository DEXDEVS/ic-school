<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\StdClassName */
?>
 <?php 

    $created_by = $model->created_by;
    $updated_by = $model->updated_by;
    $branchId = $model->branch_id;

    $branchName = Yii::$app->db->createCommand("SELECT branch_name FROM branches WHERE branch_id = '$branchId'")->queryAll();
    if (!empty($branchName)) {
        $branchName = $branchName[0]['branch_name'];
        //$branchName = "<span class='label label-success'>$branchName</span>";
    }

    $createdBy = Yii::$app->db->createCommand("SELECT username FROM user WHERE id = '$created_by'")->queryAll();
    if (!empty($createdBy)) {
        $createdBy = $createdBy[0]['username'];
    }
    $updatedBy = Yii::$app->db->createCommand("SELECT username FROM user WHERE id = '$updated_by'")->queryAll();
    if (!empty($updatedBy)) {
        $updatedBy = $updatedBy[0]['username'];
    }
    else{
        $updatedBy = "<span class='label label-warning'>Not Updated</span>";
    }
    
 ?>
<div class="std-class-name-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'class_name_id',
            //'branch_id',
            [
             'attribute' => 'branch_id',
             'format'=>'raw',
             'value'=> $branchName,
            ],
            'class_name',
            'class_name_description',
            'status',
            'created_at',
            'updated_at',
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
