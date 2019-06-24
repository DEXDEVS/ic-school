<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\StdSessions;
use common\models\StdClassName;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\StdSections */
/* @var $form yii\widgets\ActiveForm */
?>
<?php  
    $branch_id = Yii::$app->user->identity->branch_id;
?>

<div class="std-sections-form">

    <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'session_id')->dropDownList(
                    ArrayHelper::map(StdSessions::find()->where(['delete_status'=>1 , 'session_branch_id'=>$branch_id])->all(),'session_id','session_name')
                )?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'class_id')->dropDownList(
                    ArrayHelper::map(StdClassName::find()->where(['delete_status'=>1 , 'branch_id'=>$branch_id])->all(),'class_name_id','class_name')
                )?>
            </div> 
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'section_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'section_description')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'section_intake')->input('number') ?>
            </div>
        </div>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
