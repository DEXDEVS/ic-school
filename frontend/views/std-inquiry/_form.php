<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StdInquiry */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="std-inquiry-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'branch_id')->textInput() ?>

    <?= $form->field($model, 'std_inquiry_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inquiry_session')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'std_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'std_father_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->dropDownList([ 'Female' => 'Female', 'Male' => 'Male', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'std_contact_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'std_father_contact_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'std_inquiry_date')->textInput() ?>

    <?= $form->field($model, 'std_intrested_class')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'std_previous_class')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'previous_institute')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'std_roll_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'std_obtained_marks')->textInput() ?>

    <?= $form->field($model, 'std_total_marks')->textInput() ?>

    <?= $form->field($model, 'std_percentage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'refrence_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'refrence_contact_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'refrence_designation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'std_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inquiry_status')->dropDownList([ 'Inquiry' => 'Inquiry', 'Registered' => 'Registered', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
