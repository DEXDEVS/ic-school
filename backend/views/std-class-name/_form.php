<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;
use common\models\Branches;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\StdClassName */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="std-class-name-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'branch_id')->dropDownList(
                    ArrayHelper::map(Branches::find()->where(['delete_status'=>1])->all(),'branch_id','branch_name'), ['prompt'=>'Select Branch']
            )?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'class_type')->dropDownList([ 'School' => 'School', 'College' => 'College','University' => 'University', 'Academy' => 'Academy', 'Madrisa' => 'Madrisa'], ['prompt' => 'Select class type']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'class_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'class_name_description')->textInput(['maxlength' => true]) ?>
        </div>  
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'status')->dropDownList([ 'Active' => 'Active', 'Inactive' => 'Inactive', ], ['prompt' => '']) ?>
        </div>
    </div>
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
