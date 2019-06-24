<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use dosamigos\datetimepicker\DateTimePicker;
use kartik\select2\Select2;
use common\models\StdPersonalInfo;
use common\models\StdClassName;
use common\models\StdSessions;
use common\models\Concession;
use common\models\StdSubjects;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\StdRegistration */
/* @var $form yii\widgets\ActiveForm */
?>
<html>
<head>
    <title></title>
     <style>
      * {
          color:#7F7F7F;
          font-family:Arial,sans-serif;
          font-size:12px;
          font-weight:normal;
      }    
      #config{
          overflow: auto;
          margin-bottom: 10px;
      }
      .config{
          float: left;
          width: 200px;
          height: 250px;
          border: 1px solid #000;
          margin-left: 10px;
      }
      .config .title{
          font-weight: bold;
          text-align: center;
      }
      .config .barcode2D,
      #miscCanvas{
        display: none;
      }
      #submit{
          clear: both;
      }
      #barcodeTarget {
        margin: 0px;
      }
      #canvasTarget{
        margin-top: 0px;
      }        
    </style>
</head>
<body>

<div class="std-registration-form">
<?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>
<?php 
    $branch_id = Yii::$app->user->identity->branch_id;
?>
<div class="row">
    <div class="col-lg-12">
        <!-- box start -->
        <div class="box box-primary">
            <div class="box-header">
                <h2 style="color: #001F3F;"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Student Registration Form</h2>
            </div>
            <div class="box-body">  
                <!-- Personal info start -->
            <h3 style="color: #3C8DBC; margin-top: -10px">
                <i class="fa fa-info-circle" aria-hidden="true" style="color: #001E3E;"></i>
                Personal Information <small> <i>( Fields with <span style="color: red;">red stars </span>are required )</i></small> 
            </h3>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'stdInquiryNo')->textInput(['id' => 'inquiryNo']) ?>
                </div>
                <div class="col-md-4">
                    <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 113px; top: 6px"></i>
                    <label>Admission Date</label>
                    <?= DateTimePicker::widget([
                        'model' => $model,
                        'attribute' => 'admission_date',
                        'language' => 'en',
                        'size' => 'ms',
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd HH:ii:ss',
                            'startDate' => date('1960-01-01'),
                            'endDate' => date(''),
                            'todayBtn' => true
                        ]
                    ]);?>
                </div>
            </div> 
            <div class="row">
                <div class="col-md-4">
                    <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 75px; top: 6px"></i>
                    <?= $form->field($model, 'std_name')->textInput(['maxlength' => true,'id' => 'std_name', 'required'=> true]) ?>
                </div>
                <div class="col-md-4">
                     <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 115px; top: 6px"></i>
                    <?= $form->field($model, 'std_father_name')->textInput(['maxlength' => true,'id' => 'std_father_name']) ?>
                </div>  
                <div class="col-md-4">
                   <!-- <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 156px; top: 6px"></i> -->
                    <?= $form->field($model, 'std_contact_no')->widget(yii\widgets\MaskedInput::class, [ 'mask' => '+99-999-9999999', 'id' => 'std_contact_no']) ?>
                </div>     
            </div>
            <div class="row"> 
                <div class="col-md-4" id="inputDate">
                    <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 95px; top: 6px"></i>
                    <label>Student DOB</label>
                    <?= DateTimePicker::widget([
                        'model' => $model,
                        'attribute' => 'std_DOB',
                        'language' => 'en',
                        'size' => 'ms',
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd',
                            'startDate' => date('1990-01-01'),
                            'endDate' => date(''),
                            'todayBtn' => true
                        ],
                        'options' => ['id' => 'date']
                    ]);?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'age')->textInput(['id'=>'setAge', 'readonly'=>true]) ?>
                </div>
                <div class="col-md-4">
                    <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 80px; top: 6px"></i>
                    <?= $form->field($model, 'std_gender')->dropDownList
                    ([ 'M' => 'Male', 'F' => 'Female', ], ['prompt' => '','id' => 'std_gender']) ?>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-4">
                    <!-- <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 120px; top: 6px"></i> -->
                    <?= $form->field($model, 'std_email')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <!-- <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 131px; top: 6px"></i> -->
                    <?= $form->field($model, 'std_b_form')->widget(yii\widgets\MaskedInput::class, ['options' => ['id' => 'stdBform', 'onchange' => 'generateBarcode();'], 'mask' => '99999-9999999-9']) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'barcode')->hiddenInput(['id' => 'barcode_ID']) ?>
                    <div id="barcodeTarget" class="barcodeTarget"></div>
                    <canvas id="canvasTarget" width="210" height="90" style="border: none; margin: 0px;"></canvas>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-4">
                    <!-- <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 121px; top: 6px"></i> -->
                    <?= $form->field($model, 'std_photo')->fileInput() ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'std_cast')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 84px; top: 6px"></i>
                    <?= $form->field($model, 'std_district')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            
            <div class="row">  
                <div class="col-md-4">
                    <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 85px; top: 6px"></i>
                    <?= $form->field($model, 'std_tehseel')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 100px; top: 6px"></i>
                    <?= $form->field($model, 'std_nationality')->textInput(['maxlength' => true]) ?>
                </div>  
                <div class="col-md-4">
                    <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 90px; top: 6px"></i>
                    <?= $form->field($model, 'std_religion')->textInput(['maxlength' => true]) ?>
                </div>   
            </div>
            <div class="row">
                <div class="col-md-6">
                    <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 155px; top: 6px"></i>
                    <?= $form->field($model, 'std_permanent_address')->textInput(['maxlength' => true, 'id' => 'std_permanent_address']) ?>
                </div>
                <div class="col-md-6">
                    <!-- <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 213px; top: 6px"></i> -->
                    <?= $form->field($model, 'std_temporary_address')->textInput(['maxlength' => true, 'id' => 'std_temporary_address']) ?>
                </div>
            </div>
            <!-- Personal info close -->
            <hr>
            <!-- Guardian Info start-->
            <h3 style="color: #337AB7; margin-top: -10px">
                <i class="fa fa-info-circle" aria-hidden="true" style="color: #001F3F;"></i>
                Guardian Information 
            </h3>
            <div class="row">
                <div class="col-md-4">
                    <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 110px; top: 6px"></i>
                    <?= $form->field($stdGuardianInfo, 'guardian_name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 70px; top: 6px"></i>
                    <?= $form->field($stdGuardianInfo, 'guardian_relation')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 60px; top: 6px"></i>
                    <?= $form->field($stdGuardianInfo, 'guardian_cnic')->widget(yii\widgets\MaskedInput::class, [ 'mask' => '99999-9999999-9', ]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 55px; top: 6px"></i>
                    <?= $form->field($stdGuardianInfo, 'guardian_email')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 100px; top: 6px"></i>
                    <?= $form->field($stdGuardianInfo, 'guardian_contact_no_1')->widget(yii\widgets\MaskedInput::class, [ 'mask' => '+99-999-9999999']) ?>
                </div>
                <div class="col-md-4">
                    <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 100px; top: 6px"></i>
                    <?= $form->field($stdGuardianInfo, 'guardian_contact_no_2')->widget(yii\widgets\MaskedInput::class, [ 'mask' => '+99-999-9999999']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 110px; top: 6px"></i>
                    <?= $form->field($stdGuardianInfo, 'guardian_monthly_income')->textInput() ?>
                </div>
                <div class="col-md-4">
                    <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 85px; top: 6px"></i>
                    <?= $form->field($stdGuardianInfo, 'guardian_occupation')->textInput(['maxlength' => true]) ?>
                </div>        
                <div class="col-md-4">
                    <?= $form->field($stdGuardianInfo, 'guardian_designation')->textInput(['maxlength' => true]) ?>
                </div>
            </div><hr>   
            <!-- ICE Info Start -->
            <h3 style="color: #337AB7; margin-top: -10px">
                <i class="fa fa-info-circle" aria-hidden="true" style="color: #001F3F;"></i>
                Incase of Emergency (ICE) Information
            </h3>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($stdIceInfo, 'std_ice_name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($stdIceInfo, 'std_ice_relation')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                        <?= $form->field($stdIceInfo, 'std_ice_contact_no')->widget(yii\widgets\MaskedInput::class, [ 'mask' => '+99-999-9999999']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($stdIceInfo, 'std_ice_address')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <!-- Guardian Info end -->
            <hr>
            
            <!-- Academic Info -->
            <h3 style="color: #337AB7; margin-top: -10px">
                <i class="fa fa-info-circle" aria-hidden="true" style="color: #001F3F;"></i>
                Academic Information
            </h3>
                <div class="row">
                    <div class="col-md-4">
                        <!-- <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 172px; top: 6px"></i> -->
                            <?= $form->field($stdAcademicInfo, 'class_name_id')->dropDownList(
                            ArrayHelper::map(StdClassName::find()->where(['delete_status'=>1 , 'status'=>'Active','branch_id'=> $branch_id])->all(),'class_name_id','class_name'),
                            ['prompt'=>'Select Class', 'id'=>'classId']
                        )?>
                    </div>
                    <div class="col-md-8">
                        <!-- <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 158px; top: 6px"></i> -->
                            <?= $form->field($stdAcademicInfo, 'subject_combination')->dropDownList(
                                ArrayHelper::map(StdSubjects::find()->all(),'std_subject_id','std_subject_name'),
                                ['prompt'=>'Select Subject combination', 'id'=>'subjectId']
                            )?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <!-- <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 118px; top: 6px"></i> -->
                            <?= $form->field($stdAcademicInfo, 'previous_class')->textInput(['maxlength' => true, 'id' => 'previous_class']) ?>
                    </div>
                    <div class="col-md-4">
                        <!-- <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 166px; top: 6px"></i> -->
                            <?= $form->field($stdAcademicInfo, 'previous_class_rollno')->textInput(['id' => 'previous_class_rollno']) ?>
                    </div>
                    <div class="col-md-4">
                        <!-- <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 106px; top: 6px"></i> -->
                            <?= $form->field($stdAcademicInfo, 'passing_year')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <!-- <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 122px; top: 6px"></i> -->
                            <?= $form->field($stdAcademicInfo, 'obtained_marks')->textInput(['id'=>'obtainedMarks']) ?>
                    </div>
                    <div class="col-md-4">
                        <!-- <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 95px; top: 6px"></i> -->
                            <?= $form->field($stdAcademicInfo, 'total_marks')->textInput(['id'=>'totalMarks']) ?>
                    </div>
                    <div class="col-md-4">
                        <!-- <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 94px; top: 6px"></i> -->
                            <?= $form->field($stdAcademicInfo, 'percentage')->textInput(['maxlength' => true, 'id'=>'percentage', 'readonly' => true]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <!-- <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 66px; top: 6px"></i> -->
                            <?= $form->field($stdAcademicInfo, 'grades')->textInput(['maxlength' => true, 'id'=>'grade', 'readonly' => true]) ?>
                    </div>
                    <div class="col-md-4">
                        <!-- <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 71px; top: 6px"></i> -->
                            <?= $form->field($stdAcademicInfo, 'Institute')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
            <hr>
            <!-- Academic Info end -->

            <!-- Fee detail start -->
            <h3 style="color: #337AB7; margin-top: -10px">
                <i class="fa fa-info-circle" aria-hidden="true" style="color: #001F3F;"></i>
                Fee Detail
            </h3>              
                <div class="row">
                    <div class="col-md-3">
                        <?= $form->field($stdFeeDetails, 'feeSession')->dropDownList(
                            ArrayHelper::map(StdSessions::find()->where(['status'=>'Active','session_branch_id'=> $branch_id])->all(),'session_id','session_name'),
                                ['prompt'=>'Select Session','id'=>'sessionId']
                        )?>
                    </div>
                    <div class="col-md-3">
                        <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 105px; top: 6px"></i>
                        <?= $form->field($stdFeeDetails, 'admission_fee')->textInput(['type' => 'number','id' => 'admissionFee']) ?>
                    </div>
                    <div class="col-md-3">
                        <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 160px; top: 6px"></i>
                        <?= $form->field($stdFeeDetails, 'addmission_fee_discount')->textInput(['type' => 'number','id' => 'admissionFeeDiscount','value'=> 0]) ?>
                    </div>
                    <div class="col-md-3">
                        <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 130px; top: 6px"></i>
                        <?= $form->field($stdFeeDetails, 'net_addmission_fee')->textInput(['type' => 'number', 'id' => 'netAdmissionFee', 'readonly'=> true, 'onfocus' => 'showNetAdmissionFee();' ]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 115px; top: 6px"></i>
                        <?= $form->field($stdFeeDetails, 'totalTuitionFee')->textInput(['type' => 'number','id' => 'totalTuitionFee', 'readonly'=> true]) ?>
                    </div>
                    <div class="col-md-3">
                        <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 135px; top: 6px"></i>
                        <?= $form->field($stdFeeDetails, 'concession_id')->textInput(['type' => 'number', 'id' => 'concession','value'=>0]) ?>
                    </div>
                    <div class="col-md-3">
                        <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 80px; top: 6px"></i>
                        <?= $form->field($stdFeeDetails, 'tuition_fee')->textInput(['type' => 'number','id' => 'tuitionFee']) ?>
                    </div>
                </div>
            <!-- Fee detail end -->
            <div class="form-group">
                <?= Html::submitButton(' Save', ['class' => 'btn btn-success btn-flat']) ?>
                <a href="std-personal-info" class="btn btn-danger btn-flat">Back</a>
            </div>
            </div>
            <!-- box body close -->
        </div>
        <!-- box close -->
        </div>
    </div>  
</div>
<!-- form body close -->
    
    <?php ActiveForm::end(); ?>

</div>
</body>
</html>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="jquery-barcode.js"></script>
<script type="text/javascript">
    // showNetMonthlyFee function...!
    function showNetAdmissionFee() {
        var value1 = document.getElementById('admissionFee').value;
        var value2 = document.getElementById('admissionFeeDiscount').value;
        document.getElementById('netAdmissionFee').value = value1 - value2 ;
    }

    function generateBarcode(){
        var value = $("#stdBform").val();
        var btype = 'codabar';
        var renderer = "canvas";
        
        var settings = {
          output:renderer,
          bgColor:'#FFFFFF',
          color:'#000000',
          barWidth:1,
          barHeight: 50,
          moduleSize:5 ,
          posX: 10,
          posY: 20,
          addQuietZone: 1,
          canvas:'canvas'
        };
        if ($("#rectangular").is(':checked') || $("#rectangular").attr('checked')){
          value = {code:value, rect: true};
        }
        if (renderer == 'canvas'){
          clearCanvas();
          $("#barcodeTarget").hide();
          $("#canvasTarget").show().barcode(value, btype, settings);
        } else {
          $("#canvasTarget").hide();
          $("#barcodeTarget").html("").show().barcode(value, btype, settings);
        }
      }
          
      function showConfig1D(){
        $('.config .barcode1D').show();
        $('.config .barcode2D').hide();
      }
      
      function showConfig2D(){
        $('.config .barcode1D').hide();
        $('.config .barcode2D').show();
      }
      
      function clearCanvas(){
        var canvas = $('#canvasTarget').get(0);
        var ctx = canvas.getContext('2d');
        ctx.lineWidth = 1;
        ctx.lineCap = 'butt';
        ctx.fillStyle = '#FFFFFF';
        ctx.strokeStyle  = '#000000';
        ctx.clearRect (0, 0, canvas.width, canvas.height);
        ctx.strokeRect (0, 0, canvas.width, canvas.height);
      }
      
      $(function(){
        $('input[name=btype]').click(function(){
          if ($(this).attr('id') == 'datamatrix') showConfig2D(); else showConfig1D();
        });
        $('input[name=renderer]').click(function(){
          if ($(this).attr('id') == 'canvas') $('#miscCanvas').show(); else $('#miscCanvas').hide();
        });
        generateBarcode();
      });

</script>
<?php
$url = \yii\helpers\Url::to("./std-registration/fetch-fee");

$script = <<< JS

$('form#{$model->formName()}').on('beforeSubmit',function(e){
    var canvas = document.getElementById("canvasTarget");
    var dataURL = canvas.toDataURL("image/png");
    var d = document.getElementById('barcode_ID').value = dataURL; 
}); 

// getting std-personal-info- by std inquiry no...
$('#inquiryNo').on('change',function(){
   var stdInquiryNo = $('#inquiryNo').val();
   
   $.ajax({
        type:'post',
        data:{stdInquiryNo:stdInquiryNo},
        url: "$url",
        success: function(result){
            var jsonResult = JSON.parse(result.substring(result.indexOf('['), result.indexOf(']')+2));
            var student = jsonResult[0];
            $('#std_name').val(student['std_name']);
            $('#std_father_name').val(student['std_father_name']);
            $('#std_contact_no').val(student['std_contact_no']);
            $('#std_father_contact_no').val(student['std_father_contact_no']);
            $('#previous_class').val(student['std_previous_class']);
            $('#previous_class_rollno').val(student['std_roll_no']);
            $('#obtainedMarks').val(student['std_obtained_marks']);
            $('#totalMarks').val(student['std_total_marks']);
            $('#percentage').val(student['std_percentage']);
            $('#std_permanent_address').val(student['std_address']);
            $('#std_temporary_address').val(student['std_address']);
        }         
    }); 
});

    // calculate totalMarks....
    $('#totalMarks').on('change',function(){
        var tMarks = $('#totalMarks').val();
        var obtMarks = $('#obtainedMarks').val();
        var percentage = ((parseInt(obtMarks) / parseInt(tMarks))*100);
        var per = Math.round(percentage)+'%';
        $('#percentage').val(per);
        
    });

    // calculate percentage....
    $('#percentage').on('focus',function(){
       var percent = $('#percentage').val();
       
       var percentage = parseInt(percent);
       if (percentage>=90){
            $('#grade').val('A+');
       }
       else if (percentage>=80){
            $('#grade').val('A'); 
       }
       else if (percentage>=70){
            $('#grade').val('B+');
       }
       else if (percentage>=60){
            $('#grade').val('B');
       }
       else if (percentage>=50){
            $('#grade').val('C');
       }
       else if (percentage>=40){
            $('#grade').val('D');
       }else{
            $('#grade').val('F');
       }
    });

var noOfInstallment;
    $('#noOfInstallment').on('change',function(){
        for (var i = 1 ; i<= 6; i++) {
            $('#amnt'+i).val('');
            $('#f'+i).hide();
        }
        noOfInstallment = $('#noOfInstallment').val();
        var tuitionFee = $('#tuitionFee').val();
        var amountPerInstallment = parseInt(tuitionFee / noOfInstallment);

        for (var i = 1 ; i<= noOfInstallment; i++) {
            $('#f'+i).show();
            $('#amnt'+i).val(amountPerInstallment);
        }

    });

    // calculate concession start....
    $('#tuitionFee').on('focus',function(){
        var concession = $('#concession').val();
        var totalTuitionFee = $('#totalTuitionFee').val();
        var fee = parseInt(totalTuitionFee - concession);
        $('#tuitionFee').val(fee);
    });

    // calculate concession end....

$('#sessionId').on('change',function(){
   var classId = $('#classId').val();
   var sessionId = $('#sessionId').val();
   $.ajax({
        type:'post',
        data:{class_Id:classId,session_Id:sessionId},
        url: "$url",
        success: function(result){
            var jsonResult = JSON.parse(result.substring(result.indexOf('['), result.indexOf(']')+2));
            var Result = jsonResult[0];
            var addmissionFee = Result['admission_fee'];
            var monthlyFee = Result['tutuion_fee'];
            $('#admissionFee').val(addmissionFee);
            $('#totalTuitionFee').val(monthlyFee);
        }         
    }); 
});


$('#classId').on('change',function(){
    var classId = $('#classId').val();
   
   $.ajax({
        type:'post',
        data:{class_Id:classId},
        url: "$url",
        success: function(result){ 
            console.log(result);
            var jsonResult = JSON.parse(result.substring(result.indexOf('['), result.indexOf(']')+1));
            var options = '';
            $('#subjectId').empty();
            $('#subjectId').append("<option>"+"Select Subject combination"+"</option>");
            for(var i=0; i<jsonResult.length; i++) { 
                options += '<option value="'+jsonResult[i].std_subject_id+'">'+jsonResult[i].std_subject_name+'</option>';
            }
            // Append to the html
            $('#subjectId').append(options);
        }         
    }); 
});

$('#date').on('change',function(){
    var date = $('#date').val();
    
    var now = new Date();
  var today = new Date(now.getYear(),now.getMonth(),now.getDate());

  var yearNow = now.getYear();
  var monthNow = now.getMonth();
  var dateNow = now.getDate();

  var dob = new Date(date);

  var yearDob = dob.getYear();
  var monthDob = dob.getMonth();
  var dateDob = dob.getDate();
  var age = {};
  var ageString = "";
  var yearString = "";
  var monthString = "";
  var dayString = "";


  yearAge = yearNow - yearDob;

  if (monthNow >= monthDob)
    var monthAge = monthNow - monthDob;
  else {
    yearAge--;
    var monthAge = 12 + monthNow -monthDob;
  }

  if (dateNow >= dateDob)
    var dateAge = dateNow - dateDob;
  else {
    monthAge--;
    var dateAge = 31 + dateNow - dateDob;

    if (monthAge < 0) {
      monthAge = 11;
      yearAge--;
    }
  }

  age = {
      years: yearAge,
      months: monthAge,
      days: dateAge
      };

  if ( age.years > 1 ) yearString = " years";
  else yearString = " year";
  if ( age.months> 1 ) monthString = " months";
  else monthString = " month";
  if ( age.days > 1 ) dayString = " days";
  else dayString = " day";


  if ( (age.years > 0) && (age.months > 0) && (age.days > 0) )
    ageString = age.years + yearString + ", " + age.months + monthString + ", and " + age.days + dayString + " old.";
  else if ( (age.years == 0) && (age.months == 0) && (age.days > 0) )
    ageString = "Only " + age.days + dayString + " old!";
  else if ( (age.years > 0) && (age.months == 0) && (age.days == 0) )
    ageString = age.years + yearString + " old. Happy Birthday!!";
  else if ( (age.years > 0) && (age.months > 0) && (age.days == 0) )
    ageString = age.years + yearString + " and " + age.months + monthString + " old.";
  else if ( (age.years == 0) && (age.months > 0) && (age.days > 0) )
    ageString = age.months + monthString + " and " + age.days + dayString + " old.";
  else if ( (age.years > 0) && (age.months == 0) && (age.days > 0) )
    ageString = age.years + yearString + " and " + age.days + dayString + " old.";
  else if ( (age.years == 0) && (age.months > 0) && (age.days == 0) )
    ageString = age.months + monthString + " old.";
  else ageString = "Oops! Could not calculate age!";
    
$('#setAge').val(ageString);
    //alert(ageString);

    });
JS;
$this->registerJs($script);
?>
</script>