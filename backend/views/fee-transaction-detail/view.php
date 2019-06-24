<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\FeeTransactionDetail */
?>
<div class="fee-transaction-detail-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fee_trans_detail_id',
            'fee_trans_detail_head_id',
            'fee_type_id',
            'fee_amount',
            'collected_fee_amount',
            'remaining',
            'status',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Collect Voucher</title>
    <style>
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
          -webkit-appearance: none; 
          margin: 0; 
        }
    }
    </style>
</head>
<body>

<div class="container-fluid" style="margin-top: -30px;">
    <h1 class="well well-sm bg-navy" align="center">Yearly Voucher Collection</h1>
    <form method="POST">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <input type="hidden" name="_csrf" class="form-control" value="<?=Yii::$app->request->getCsrfToken()?>">          
                </div>    
            </div>    
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" name="reg_no" class="form-control" placeholder="Enter Registration Number..." id="reg_no">
                </div>    
            </div>
        </div>
        <?php $branch_id = Yii::$app->user->identity->branch_id; ?>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <select class="form-control" name="classid" id="classId" >
                        <option >Select Class</option>
                            <?php 
                                $className = Yii::$app->db->createCommand("SELECT * FROM std_enrollment_head where delete_status=1 AND branch_id = $branch_id")->queryAll();
                                
                                    foreach ($className as  $value) { ?>    
                                    <option value="<?php echo $value["std_enroll_head_id"]; ?>">
                                        <?php echo $value["std_enroll_head_name"]; ?> 
                                    </option>
                            <?php } ?>
                    </select>      
                </div>     
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <select class="form-control" name="std" id="std">
                            <option value="">Select Student</option>
                    </select>      
                </div>    
            </div>    
            <div class="col-md-4">
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-success btn-flat"><i class="fa fa-sign-in"></i><b> Show Voucher Details</b></button>
                </div>    
            </div>   
        </div>
    </form>

    <div class="row">
        <div class="col-md-12 x_content"></div>
    </div>

<?php

    if(isset($_POST["submit"])){
        global $voucherNo;
        if($_POST["reg_no"]){
            $regNo = $_POST["reg_no"];
            $stdId = Yii::$app->db->createCommand("SELECT std_id FROM std_personal_info WHERE std_reg_no= '$regNo'")->queryAll();
            if(empty($std_id)){
            Yii::$app->session->setFlash('warning', "This registration number not exist! Select valid registration no");
            } else {
            $std_id = $stdId[0]['std_id'];
            $headId = Yii::$app->db->createCommand("SELECT std_enroll_head_id FROM std_enrollment_head INNER JOIN std_enrollment_detail ON std_enroll_head_id = std_enroll_detail_head_id WHERE std_reg_no= '$regNo'")->queryAll();
            $classId = $headId[0]['std_enroll_head_id'];
            
        } elseif($_POST["classid"] && $_POST["std"]) {
            $classId = $_POST["classid"];
            $std_id = $_POST["std"];
            $regsNo = Yii::$app->db->createCommand("SELECT std_reg_no FROM std_personal_info WHERE std_id = '$std_id'")->queryAll();
            $regNo = $regsNo[0]['std_reg_no'];
        }
        
        
        $sessionDetail = Yii::$app->db->createCommand("SELECT s.session_start_date, s.session_end_date FROM std_sessions as s INNER JOIN std_enrollment_head  as e ON s.session_id = e.session_id WHERE e.std_enroll_head_id = '$classId'")->queryAll(); 
        
        $yearStart = date('Y-m', strtotime($sessionDetail[0]['session_start_date']));
        $yearEnd = date('Y-m', strtotime($sessionDetail[0]['session_end_date']));

        $transactionHead = Yii::$app->db->createCommand("SELECT * FROM fee_transaction_head WHERE std_id = '$std_id' AND month >= '$yearStart' AND month <=  '$yearEnd'")->queryAll();
        if(empty($transactionHead)){
             Yii::$app->session->setFlash('warning', "Plese manage the account first, for further proceedings.");
        } else { 
        global $count;
        $count = count($transactionHead);

        $studentID = $transactionHead[0]['std_id'];
        $classID = $transactionHead[0]['class_name_id'];
        
        $student = Yii::$app->db->createCommand("SELECT std_name FROM std_personal_info WHERE std_id = '$studentID'")->queryAll();        

        $class = Yii::$app->db->createCommand("SELECT class_name FROM std_class_name WHERE class_name_id = '$classID'")->queryAll();     
    ?>  


<!-- modified collect voucher start -->
<div class="row container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h3 class="well well-sm">
                <?php echo $regNo."   ".$student[0]['std_name']." - ".$class[0]['class_name']."<span style='float: right;'>"."Year - ".date('Y')."</span>"; ?>
            </h3>
        </div>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Month</th>
                <th>Total Amount</th>
                <th>Amount Paid</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i=0; $i < $count ; $i++) { 
                if($transactionHead[$i]['status'] == 'Paid'){ ?>
                    <tr>
                        <td> <?php echo date('Y-F', strtotime($transactionHead[$i]['month'])); ?> </td>
                        <td> <?php echo $transactionHead[$i]['total_amount']; ?> </td>
                        <td> <?php echo $transactionHead[$i]['paid_amount']; ?> </td>
                        <td> <?php echo $transactionHead[$i]['status']; ?> </td>
                    </tr>
            <?php } else {?>
    <form method= "POST" action="">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="hidden" name="_csrf" class="form-control" value="<?=Yii::$app->request->getCsrfToken()?>">          
                            </div>    
                        </div>    
                    </div>
                    <tr>
                        <td> <?php echo date('Y-F', strtotime($transactionHead[$i]['month']));?> </td>
                        <td> <?php echo $transactionHead[$i]['total_amount']; ?> </td>
                        <td><input type="number" name="paidAmount[]" value="0" id="paidAmount" onchange="setStatus()"></td>
                        <td><input type="text" name="status[]" value="Unpaid" id="status" readonly=""></td>
                        <input type="hidden" name="voucherNo[]" value="<?php echo $transactionHead[$i]['fee_trans_id']; ?>">
                            
                    </tr>
                    <?php } } ?>
        </tbody>
    </table>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <button type="submit" name="save" class="btn btn-success">Save</button>
                </div> 
            </div>
            </div>  
    </form>

</div>
<!-- modified collect voucher close -->
<?php 
    // end of std_id else
    }
    // end of head else
    }
}
// isset close.... 
?>

<?php 
if(isset($_POST['save'])){
    $paidAmount        = $_POST["paidAmount"];
    $status           = $_POST["status"];
    $voucherNo           = $_POST["voucherNo"];
    $counts =count($paidAmount);

    $transaction = \Yii::$app->db->beginTransaction();
    try {
        for($i=0;$i<$counts;$i++){

            $updateTransactionHead = Yii::$app->db->createCommand()->update('fee_transaction_head', ['paid_amount'=> $paidAmount[$i],  'status' => $status[$i]], ['fee_trans_id' => $voucherNo[$i]])->execute();
            if ($updateTransactionHead) {
                $transaction->commit();
                // success alert message...
            Yii::$app->session->setFlash('success', "Voucher paid Successfully...!"); 
            }
        }
         
    } catch (Exception $e) {
            $transaction->rollBack();
            Yii::$app->session->setFlash('error', "Transaction Failed, Tray Again...!");
    }
}
?>  

</div>
</body>
</html>

<script type="text/javascript">
   function setStatus(){
        var paidAmount = parseInt(document.getElementById('paidAmount').value);
        if( paidAmount > 0 ) {
            paid = "Paid";
            $('#status').val(paid);
        }
    }
</script>
<?php
$url = \yii\helpers\Url::to("fee-transaction-detail/fetch-students");

$script = <<< JS
$('#classId').on('change',function(){
   var classId = $('#classId').val();
   
   $.ajax({
        type:'post',
        data:{class_Id:classId},
        url: "$url",

        success: function(result){
            var jsonResult = JSON.parse(result.substring(result.indexOf('['), result.indexOf(']')+1));
            var options = '';
            $('#std').empty();
            $('#std').append("<option>"+"Select Student"+"</option>");
            for(var i=0; i<jsonResult.length; i++) { 
                options += '<option value="'+jsonResult[i].std_enroll_detail_std_id+'">'+jsonResult[i].std_enroll_detail_std_name+'</option>';
            }
            // Append to the html
            $('#std').append(options);

        }         
    });       
});
JS;
$this->registerJs($script);
?>
</script>