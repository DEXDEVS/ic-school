<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\ExamsCategory;
use common\models\StdClassName;
use common\models\Subjects;
use common\models\MarksWeightageDetails;
use common\models\MarksWeightageType;
use wbraganca\dynamicform\DynamicFormWidget;
/* @var $this yii\web\View */
/* @var $model common\models\MarksWeightageHead */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marks-weightage-head-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'exam_category_id')->dropDownList(
                    ArrayHelper::map(ExamsCategory::find()->all(),'exam_category_id','category_name'),
                        ['prompt'=>'Select Exam Category']
                )?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'class_id')->dropDownList(
                    ArrayHelper::map(StdClassName::find()->where(['class_type'=>'College'])->all(),'class_name_id','class_name'),
                        ['prompt'=>'Select Class', 'id'=>'classId']
                )?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'subjects_id')->dropDownList(
                    ArrayHelper::map(Subjects::find()->all(),'subject_id','subject_name'),
                        ['prompt'=>'Select Subject', 'id'=>'subjectId']
                )?>
        </div>
    </div>

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Marks Weightage</h4></div>
            <div class="panel-body">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 10, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $marksDetails[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'weightage_type_id',  
                    'marks',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($marksDetails as $i => $marksDetail): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Marks</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            
                        ?>
                        <div class="row">
                            <div class="col-sm-6">
                                 <?= $form->field($marksDetail, "[{$i}]weightage_type_id")->dropDownList(
                                    ArrayHelper::map(MarksWeightageType::find()->all(),'weightage_type_id','weightage_type_name'),
                                        ['prompt'=>'Select Exam Category']
                                )?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($marksDetail, "[{$i}]marks")->textInput() ?>
                            </div>
                        </div><!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
            </div>
        </div>  
    </div>
    
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

<?php
//$url = \yii\helpers\Url::to("marks-weightage-head/fetch-subjects");

$script = <<< JS

$('#classId').change(function(){
    var classId = $(this).val();
    $.get('./subjects/get-subjects',{classId : classId},function(data){
        // console.log(data);
        var data =  $.parseJSON(data);
        //  console.log(data[0].length);
        var subjectName = data[0];
        var subjectIds = data[1];

        $('#subjectId').empty();
        $('#subjectId').append("<option>"+"Select Subject"+"</option>");
        var options = '';
            for(var i=0; i<subjectName.length; i++) {
                options += '<option value="'+subjectIds[i]+'">'+subjectName[i]+'</option>';
            }
        // Append to the html
        $('#subjectId').append(options);
    });
});

JS;
$this->registerJs($script);
?>
</script>  
