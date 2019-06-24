<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;
/* @var $this yii\web\View */
/* @var $model common\models\EmpLeave */
/* @var $form yii\widgets\ActiveForm */
 $empId = $model->emp_id; 
 
 $emp_name = Yii::$app->db->createCommand("SELECT emp_name FROM emp_info WHERE emp_id = '$empId'")->queryAll();
 $empName = $emp_name[0]['emp_name'];
?>

<div class="emp-leave-form">
    
     <?php $form = ActiveForm::begin(); ?>

     <div class="row">
         <div class="col-md-4">
             <?= $form->field($model, 'emp_id')->textInput(['value'=>$empName,'readonly'=>true]) ?>

         </div>
          <div class="col-md-4">
             <?= $form->field($model, 'applying_date')->textInput(['readonly'=>true]) ?>
         </div>
          <div class="col-md-4">
             <?= $form->field($model, 'leave_type')->textInput(['readonly'=>true]) ?>
         </div>
     </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'starting_date')->textInput(['readonly'=>true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'ending_date')->textInput(['readonly'=>true]) ?>
        </div>
        <div class="col-md-4">
           <?= $form->field($model, 'no_of_days')->textInput(['readonly'=>true]) ?>
        </div>
    </div>
     <div class="row">
        <div class="col-md-12">
           <?= $form->field($model, 'leave_purpose')->textArea(['maxlength' => true, 'readonly'=>true]) ?>  
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
           <?= $form->field($model, 'remarks')->textArea(['maxlength' => true]) ?>  
        </div>
    </div>   
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'status')->dropDownList([ 'Pending' => 'Pending', 'Accepted' => 'Accepted', 'Rejected' => 'Rejected'], ['prompt' => 'Select Leave Status']) ?>
        </div>
    </div>

    <?php if (!Yii::$app->request->isAjax){ ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
