<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\EmpInfo;
use common\models\Designation;
use common\models\EmpType;
use common\models\Branches;
use common\models\Departments;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\EmpInfo */
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

<?php 
    $EmpInfo = EmpInfo::find()->orderBy(['emp_id'=> SORT_DESC])->one();
    $id = $EmpInfo['emp_id']+1;
    $year = date('y');
?>
<div class="emp-info-form">

    <?php $form = ActiveForm::begin(['id'=>$model->formName()]); ?>
    <h3 style="color: #337AB7; margin-top: -10px"> Employee Info <small> ( Fields with <span style="color: red;">red stars </span>are required )</small> </h3>
    <div class="row">
        <div class="col-md-4">
            <!-- <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 120px; top: 6px"></i> -->
            <?= $form->field($model, 'emp_reg_no')->textInput(['maxlength' => true,'value'=> 'EMP-Y'.$year.'-'.$id, 'readonly'=> true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 135px; top: 6px"></i>
            <?= $form->field($model, 'emp_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 113px; top: 6px"></i>
            <?= $form->field($model, 'emp_father_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 140px; top: 6px"></i>
            <?= $form->field($model, 'emp_contact_no')->widget(yii\widgets\MaskedInput::class, [ 'mask' => '+99-999-9999999', ]) ?>
        </div>
    </div>    
    <div class="row">
        <div class="col-md-4">
            <label>DOB</label>
            <?= DateTimePicker::widget([
                'model' => $model,
                'attribute' => 'emp_date_of_birth',
                'language' => 'en',
                'size' => 'ms',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'startDate' => date('2000-01-01'),
                    'endDate' => date(''),
                    'todayBtn' => true
                ]
            ]);?>
        </div>
        <div class="col-md-4">
            <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 172px; top: 6px"></i>
            <?= $form->field($model, 'emp_email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
             <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 60px; top: 6px"></i> 
              <?= $form->field($model, 'emp_gender')->dropDownList([ 'M' => 'Male', 'F' => 'Female', ], ['prompt' => 'Select Gender']) ?>
        </div>
    </div> 
    <div class="row">
        <div class="col-md-4">
            <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 72px; top: 6px"></i>
            <?= $form->field($model, 'emp_cnic')->widget(yii\widgets\MaskedInput::class, ['options' => ['id' => 'empCnic', 'onchange' => 'generateBarcode();'],  'mask' => '99999-9999999-9']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'barcode')->hiddenInput(['id' => 'barcode_ID']) ?>
            <div id="barcodeTarget" class="barcodeTarget"></div>
            <canvas id="canvasTarget" width="210" height="90" style="border: none; margin: 0px;"></canvas>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'emp_photo')->fileInput() ?>
        </div>
    </div>
    <div class="row">        
        <div class="col-md-4">
            <?= $form->field($model, 'emp_fb_ID')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 160px; top: 6px"></i>
            <?= $form->field($model, 'emp_perm_address')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'emp_temp_address')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 120px; top: 6px"></i>
            <?= $form->field($model, 'emp_marital_status')->dropDownList([ 'Single' => 'Single', 'Married' => 'Married', ], ['prompt' => 'Select Merital Status']) ?>
        </div>
        <div class="col-md-4">
            <!-- <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 102px; top: 6px"></i> -->
            <?= $form->field($model, 'emp_religion')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <!-- <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 104px; top: 6px"></i> -->
            <?= $form->field($model, 'emp_domicile')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <!-- <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 102px; top: 6px"></i> -->
            <?= $form->field($model, 'emp_qualification')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <!-- <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 104px; top: 6px"></i> -->
            <?= $form->field($model, 'emp_passing_year')->textInput() ?>
        </div>
        <div class="col-md-4">
            <!-- <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 113px; top: 6px"></i> -->
            <?= $form->field($model, 'emp_institute_name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <!-- <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 173px; top: 6px"></i> -->
            <?= $form->field($model, 'degree_scan_copy')->fileInput() ?>
        </div>
        <div class="col-md-4">
            <!-- <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 173px; top: 6px"></i> -->
            <?= $form->field($model, 'emp_cv')->fileInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 105px; top: 6px"></i>
            <?= $form->field($model, 'emp_dept_id')->dropDownList(
                ArrayHelper::map(Departments::find()->all(),'department_id','department_name'), ['prompt'=>'Select Department']
            )?>
        </div>
        <div class="col-md-4">
            <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 117px; top: 6px"></i>
            <?= $form->field($empDesignation, 'designation_id')->dropDownList(
                    ArrayHelper::map(Designation::find()->where(['delete_status'=>1])->all(),'designation_id','designation'), ['prompt'=>'Select Designation']
                )?>
        </div>
        <div class="col-md-4">
            <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 85px; top: 6px"></i>
            <?= $form->field($empDesignation, 'group_by')->dropDownList([ 'Faculty' => 'Faculty', 'Non-Faculty' => 'Non-Faculty', ], ['prompt' => 'Select Group']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 105px; top: 6px"></i>
            <?= $form->field($empDesignation, 'emp_type_id')->dropDownList(
                    ArrayHelper::map(EmpType::find()->where(['delete_status'=>1])->all(),'emp_type_id','emp_type'), ['prompt'=>'Select Type']
              )?>
        </div>
        <div class="col-md-4">
            <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 52px; top: 6px"></i>
            <?= $form->field($model, 'emp_salary_type')->dropDownList([ 'Salaried' => 'Salaried', 'Per Lecture' => 'Per Lecture', ], ['prompt' => '']) ?>
        </div> 
        <div class="col-md-4">
            <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 64px; top: 6px"></i>
            <?= $form->field($empDesignation, 'emp_salary')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
          <?= $form->field($model,'emp_allowed_leaves')->textInput() ?> 
        </div>
        <div class="col-md-4">
           <?= $form->field($model,'reference')->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], 
           ['prompt' => 'Select (if any)', 'id' => 'reference']) ?> 
        </div>
    </div>

    <!-- Form of Employee Reference -->
    <div id="referenceshow" style="display: none;">
        <h3 style="color: #337AB7; margin-top: -10px"><hr> Employee Refrence <small> ( Fields with <span style="color: red;">red stars </span>are required )</small> </h3>
        <div class="row">
            <div class="col-md-4">
                <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 81px; top: 6px"></i>
                <?= $form->field($empRefModel, 'ref_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
                <i class="fa fa-star" style="font-size: 8px; color: red; position: absolute; left: 118px; top: 6px"></i>
                <?= $form->field($empRefModel, 'ref_contact_no')->widget(yii\widgets\MaskedInput::class, [ 'mask' => '+99-999-9999999', ]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($empRefModel, 'ref_cnic')->widget(yii\widgets\MaskedInput::class, [ 'mask' => '99999-9999999-9', ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($empRefModel, 'ref_designation')->textInput(['maxlength' => true]) ?>
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

</body>
</html>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="jquery-barcode.js"></script>
<script type="text/javascript">
    
    function generateBarcode(){
        var value = $("#empCnic").val();
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
$script = <<< JS

$('form#{$model->formName()}').on('beforeSubmit',function(e){
    var canvas = document.getElementById("canvasTarget");
    var dataURL = canvas.toDataURL("image/png");
    var d = document.getElementById('barcode_ID').value = dataURL;   
    
}); 

$('#reference').on('change',function(){
        
    if($("#reference").val() == 'Yes'){
        $("#referenceshow").show()
    } else {
        $("#referenceshow").hide()
    }
    });

JS;
$this->registerJs($script);
?>
