<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Visitors */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="visitors-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
         <div class="col-md-4">
            <?= $form->field($model, 'visitor_cnic')->textInput(['maxlength' => true, 'id'=>'visitor_cnic']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'visitor_name')->textInput(['maxlength' => true, 'id'=>'visitor_name']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'visitor_contact_no')->widget(yii\widgets\MaskedInput::class, ['options' => ['id' => 'visitor_contact_no'], 'mask' => '+99-999-9999999']) ?>
        </div>
    </div>
    <div  class="row">
        <div class="col-md-4">
             <?= $form->field($model, 'visitor_photo')->fileInput() ?>
        </div>
        <div class="col-md-4">
            <label>Date & Time</label>
            <?= DateTimePicker::widget([
                'model' => $model,
                'attribute' => 'date_time',
                'language' => 'en',
                'size' => 'xs',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd HH:ii:ss',
                    // 'startDate' => date('2000-01-01'),
                    // 'endDate' => date(''),
                    'todayBtn' => true
                ]
            ]);?>
        </div>
       
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'visit_purpose')->textarea(['maxlength' => true, 'rows'=>6]) ?>
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
$url = \yii\helpers\Url::to("./fetch-visitors");

$script = <<< JS

// getting visitors by CNIC...
$('#visitor_cnic').on('change',function(){
   var visitorCnic = $('#visitor_cnic').val();
   
   $.ajax({
        type:'post',
        data:{visitorCnic:visitorCnic},
        url: "$url",
        success: function(result){

            var jsonResult = JSON.parse(result.substring(result.indexOf('['), result.indexOf(']')+2));
            // if( !$.isArray(jsonResult) ||  !jsonResult.length ){
            //     alert("Record not Found.!");
            // } else {
            //     var visitor = jsonResult[0];
            //     $('#visitor_name').val(visitor['visitor_name']);
            //     $('#visitor_contact_no').val(visitor['visitor_contact_no']);
            // }
           // console.log(jsonResult);
        }         
    }); 
});

JS;
$this->registerJs($script);
?>
</script>