<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MarksWeightageType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marks-weightage-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'weightage_type_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'weightage_type_description')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
