<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MarksWeightageDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marks-weightage-details-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'weightage_head_id')->textInput() ?>

    <?= $form->field($model, 'weightage_type_id')->textInput() ?>

    <?= $form->field($model, 'marks')->textInput() ?>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
