<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\StdInquiry */
?>
<div class="std-inquiry-view">
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
        $updatedBy = "<span class='label label-warning'>Not Updated</span>";
    }
    
 ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'std_inquiry_id',
            'std_inquiry_no',
            // 'branch_id',
            'branch.branch_name',
            'inquiry_session',
            'std_name',
            'std_father_name',
            'gender',
            'std_contact_no',
            'std_father_contact_no',
            'std_inquiry_date',
            'std_intrested_class',
            'previous_institute',
            'std_previous_class',
            'std_roll_no',
            'std_obtained_marks',
            'std_total_marks',
            'std_percentage',
            'refrence_name',
            'refrence_contact_no',
            'refrence_designation',
            'std_address',
            'comment',
            'inquiry_status',
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
