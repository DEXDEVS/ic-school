<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Subjects;
use common\models\StdClassName;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model common\models\StdSubjects */
/* @var $form yii\widgets\ActiveForm */
//$branch_id = Yii::$app->user->identity->branch_id;
?>

<div class="std-subjects-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php  $branch_id = Yii::$app->user->identity->branch_id; ?>

    <?= $form->field($model, 'class_id')->dropDownList(ArrayHelper::map(StdClassName::find()->where(['delete_status'=>1, 'branch_id'=>$branch_id])->all(),'class_name_id','class_name'),
    	['prompt'=>'Select Class']
	)?>

    <?= $form->field($model, 'subId')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Subjects::find()->where(['delete_status'=>1])->all(),'subject_name','subject_name'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select'],
        'pluginOptions' => [
            'allowClear' => true,
            'multiple' => true
        ],
    ]);
    ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
