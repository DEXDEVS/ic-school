<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AccountNature */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-nature-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'account_no')->textInput() ?>

    <?= $form->field($model, 'account_nature_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'account_nature_status')->dropDownList([ '+ve' => '+ve', '-ve' => '-ve', ], ['prompt' => '']) ?>

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
