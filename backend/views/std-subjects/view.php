<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\StdSubjects */
?>
<?php 

 	$subjectName = $model->std_subject_name;
 	$classId = $model->class_id;

    $className = Yii::$app->db->createCommand("SELECT class_name FROM std_class_name WHERE class_name_id = '$classId'")->queryAll();

    if (!empty($className)) {
        $className = $className[0]['class_name'];
        //$branchName = "<span class='label label-success'>$branchName</span>";
    }

    // $createdBy = Yii::$app->db->createCommand("SELECT username FROM user WHERE id = '$created_by'")->queryAll();
    // if (!empty($createdBy)) {
    //     $createdBy = $createdBy[0]['username'];
    //     $createdBy = "<span class='label label-success'>$createdBy</span>";
    // }
    // $updatedBy = Yii::$app->db->createCommand("SELECT username FROM user WHERE id = '$updated_by'")->queryAll();
    // if (!empty($updatedBy)) {
    //     $updatedBy = $updatedBy[0]['username'];
    //     $updatedBy = "<span class='label label-danger'>$updatedBy</span>";
    // }
    // else{
    //     $updatedBy = "<span class='label label-warning'>Not Updated</span>";
    // }
    
 ?>
<div class="std-subjects-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'std_subject_id',
            //'class_id',
            [
             'attribute' => 'Class Name',
             'format'=>'raw',
             'value'=>  $className,
            ],
            //'std_subject_name',
             [
             'attribute' => 'Subject Name',
             'format'=>'raw',
             'value'=>  $subjectName,
            ],
        ],
    ]) ?>

</div>
