<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\StdEnrollmentHead;

$branch_id = Yii::$app->user->identity->branch_id;
/* @var $this yii\web\View */
/* @var $model common\models\TimeTableHead */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="time-table-head-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'class_id')->dropDownList(
                    ArrayHelper::map(StdEnrollmentHead::find()->where(['delete_status'=>1,'branch_id'=> $branch_id])->all(),'std_enroll_head_id','std_enroll_head_name'),
                    ['prompt'=>'','id'=>'classId','disabled'=>'disabled']
                )?>
        </div>
        <div class="col-md-6"> 
                

                <?= $form->field($model, 'days')->textInput(['readonly'=>true]);
                ?>
            </div>
    </div>
    <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'status')->dropDownList([ 'Active' => 'Active', 'Inactive' => 'Inactive', ], ['prompt' => 'Select Status']) ?>
            </div>
            
        </div>

            

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
