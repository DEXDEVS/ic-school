<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Designation;
use common\models\EmpInfo;
use common\models\EmpType;


/* @var $this yii\web\View */
/* @var $model common\models\EmpDesignation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="emp-designation-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'emp_id')->dropDownList(
                ArrayHelper::map(EmpInfo::find()->where(['delete_status'=>1])->all(),'emp_id','emp_name'), ['prompt'=>'Select Employee Name',"disabled" => "disabled"]
            )?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'designation_id')->dropDownList(
                ArrayHelper::map(Designation::find()->where(['delete_status'=>1])->all(),'designation_id','designation'), ['prompt'=>'Select Designation',"disabled" => "disabled"]
            )?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'emp_type_id')->dropDownList(
                ArrayHelper::map(EmpType::find()->where(['delete_status'=>1])->all(),'emp_type_id','emp_type'), ['prompt'=>'Select Employee Name',"disabled" => "disabled"]
            )?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
             <?= $form->field($model, 'group_by')->dropDownList([ 'Faculty' => 'Faculty', 'Non-Faculty' => 'Non-Faculty', ], ['prompt' => 'Group By',"disabled" => "disabled"]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'emp_salary')->textInput(['readOnly'=>true]) ?>
        </div>
        <div class="col-md-4">
             <?= $form->field($model, 'designation_status')->dropDownList(['Registered' => 'Registered','Promotion' => 'Promotion', 'Demotion' => 'Demotion', ], ['prompt' => 'Select Designation Status',"disabled" => "disabled"]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'status')->dropDownList([ 'Active' => 'Active', 'Inactive' => 'Inactive', ], ['prompt' => '']) ?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'updateDesignation_id')->dropDownList(
                ArrayHelper::map(Designation::find()->where(['delete_status'=>1])->all(),'designation_id','designation'), ['prompt'=>'Select Designation']
            )?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'updateEmp_type_id')->dropDownList(
                ArrayHelper::map(EmpType::find()->where(['delete_status'=>1])->all(),'emp_type_id','emp_type'), ['prompt'=>'Select Employee Name']
            )?>
        </div>
         <div class="col-md-4">
             <?= $form->field($model, 'updateGroup_by')->dropDownList([ 'Faculty' => 'Faculty', 'Non-Faculty' => 'Non-Faculty', ], ['prompt' => 'Group By']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'updateEmp_salary')->textInput() ?>
        </div>
        <div class="col-md-4">
             <?= $form->field($model, 'updateDesignation_status')->dropDownList(['Registered' => 'Registered','Promotion' => 'Promotion', 'Demotion' => 'Demotion', ], ['prompt' => 'Select Designation Status']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'updateStatus')->dropDownList([ 'Active' => 'Active', 'Inactive' => 'Inactive', ], ['prompt' => '']) ?>
        </div>
    </div>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
