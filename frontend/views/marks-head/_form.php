<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MarksHead */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marks-head-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'std_id')->textInput() ?>

    <?= $form->field($model, 'grand_total')->textInput() ?>

    <?= $form->field($model, 'percentage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'grade')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'exam_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
