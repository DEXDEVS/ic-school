<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\StdEnrollmentHead;
use common\models\Subjects;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\time\TimePicker;

$branch_id = Yii::$app->user->identity->branch_id;
/* @var $this yii\web\View */
/* @var $model common\models\TimeTableHead */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="time-table-head-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'class_id')->dropDownList(
                    ArrayHelper::map(StdEnrollmentHead::find()->where(['delete_status'=>1,'branch_id'=> $branch_id])->all(),'std_enroll_head_id','std_enroll_head_name'),
                    ['prompt'=>'Select Class','id'=>'classId']
                )?>
        </div>
        <div class="col-md-6"> 
            <?php $data = [ 'Monday' => 'Monday', 'Tuesday' => 'Tuesday', 'Wednesday' => 'Wednesday', 'Thursday' => 'Thursday', 'Friday' => 'Friday', 'Saturday' => 'Saturday', ]; ?>
            <?= $form->field($model, 'days')->widget(Select2::classname(), [
                'data' => $data,
                'language' => 'en',
                'options' => ['placeholder' => 'Select'],
                'showToggleAll' => true,
                'pluginOptions' => [
                    'allowClear' => true,
                    'multiple' => true,
                    //'maximumSelectionLength'=> 2,
                ],
            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Time Table</h4></div>
            <div class="panel-body">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 10, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $timeTableDetails[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'subject_id',
                    'start_time',
                    'end_time',  
                    'room',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($timeTableDetails as $i => $timeTableDetail): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Subject</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs" id="add"><i class="glyphicon glyphicon-plus"></i></button>
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
                                 <?= $form->field($timeTableDetail, "[{$i}]subject_id")->dropDownList(
                                    ArrayHelper::map(Subjects::find()->all(),'subject_id','subject_name'),
                                        ['prompt'=>'Select Subject', 'id'=>'[{$i}]subjectId']
                                )?>
                            </div>
                            <div class="col-sm-6">
                                 <?= $form->field($timeTableDetail, "[{$i}]start_time")->widget(TimePicker::classname(), [
                                        //'name' => 'start_time',
                                        'pluginOptions' => [
                                            'format' => '00:00',
                                            'showSeconds' => false,
                                            'showMeridian' => false,
                                            'minuteStep' => 1,
                                            'secondStep' => 5,
                                        ]
                                 ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                 <?= $form->field($timeTableDetail, "[{$i}]end_time")->widget(TimePicker::classname(), [
                                        //'name' => 'start_time',
                                        'pluginOptions' => [
                                            'format' => '00:00',
                                            'showSeconds' => false,
                                            'showMeridian' => false,
                                            'minuteStep' => 1,
                                            'secondStep' => 5,
                                        ]
                                 ]); ?>
                            </div>
                            <div class="col-sm-6">
                                 <?= $form->field($timeTableDetail, "[{$i}]room")->textInput(); ?>
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
//$url = \yii\helpers\Url::to("time-table-head/fetch-subjects");

$script = <<< JS
$('#classId').on('change',function(){
    var class_id = $('#classId').val();
    $.get('./subjects/fetch-subjects',{class_id : class_id},function(data){
        // console.log(data);
        var data =  $.parseJSON(data);
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

$('#add').on('click',function(){
    var class_id = $('#classId').val();
   
    $.get('./subjects/fetch-subjects',{class_id : class_id},function(data){
        // console.log(data);
        var data =  $.parseJSON(data);
        var subjectName = data[0];
        var subjectIds = data[1];
        alert(subjectName);
        alert(subjectIds);
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