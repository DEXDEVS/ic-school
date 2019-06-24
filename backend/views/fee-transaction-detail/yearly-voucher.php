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
	<h1 class="well well-sm bg-navy" align="center" style="font-family: serif;">Student Account Detail</h1>
    <form method="POST">
    	<div class="row">
            <div class="col-md-8">
                <p class="text-green"><i><b>Enter <span class="text-red">Registration Number</span> or Select <span class="text-red">Class</span> and <span class="text-red">Student</span> to view Details</i></b></p>
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
                    <button type="submit" name="submit" class="btn btn-success btn-flat"><i class="fa fa-sign-in"></i><b> View Details</b></button>
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
            if(empty($stdId)){
            Yii::$app->session->setFlash('warning', "This registration number not exist! Select valid registration no.");
            } else {
                $std_id = $stdId[0]['std_id'];
                $headId = Yii::$app->db->createCommand("SELECT std_enroll_head_id FROM std_enrollment_head INNER JOIN std_enrollment_detail ON std_enroll_head_id = std_enroll_detail_head_id WHERE std_reg_no= '$regNo'")->queryAll();
                if(empty($headId)){
                    Yii::$app->session->setFlash('warning', "This student is not enrolled in class.");
                } else {
                $class_id = $headId[0]['std_enroll_head_id'];
                $sessionDetail = Yii::$app->db->createCommand("SELECT s.session_start_date, s.session_end_date FROM std_sessions as s INNER JOIN std_enrollment_head  as e ON s.session_id = e.session_id WHERE e.std_enroll_head_id = '$class_id'")->queryAll(); 
            
                $yearStart = date('Y-m', strtotime($sessionDetail[0]['session_start_date']));
                $yearEnd = date('Y-m', strtotime($sessionDetail[0]['session_end_date']));

                $transactionHead = Yii::$app->db->createCommand("SELECT DISTINCT fmd.voucher_no, fth.* FROM fee_transaction_head as fth INNER JOIN fee_month_detail as fmd ON fmd.voucher_no = fth.voucher_no WHERE fth.std_id = '$std_id' AND fmd.month >= '$yearStart' AND fmd.month <=  '$yearEnd'")->queryAll();
                

                if(empty($transactionHead)){
                     Yii::$app->session->setFlash('warning', "Please manage the account first, for further proceedings.");
                } else { 
                global $count;
                $count = count($transactionHead);

                $studentID = $transactionHead[0]['std_id'];
                $classID = $transactionHead[0]['class_name_id'];
                
                $student = Yii::$app->db->createCommand("SELECT std_name FROM std_personal_info WHERE std_id = '$studentID'")->queryAll();        

                $class = Yii::$app->db->createCommand("SELECT class_name FROM std_class_name WHERE class_name_id = '$classID'")->queryAll(); ?>
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
                <th>Voucher #</th>
                <th>Month</th>
                <th>Total Amount</th>
                <th>Paid Amount</th>
                <th>Remaining Amount</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                for ($i=0; $i < $count ; $i++) { 
                $collectionDate = $transactionHead[$i]['collection_date'];
                $voucher = $transactionHead[$i]['voucher_no'];

                    if($transactionHead[$i]['status'] == 'Paid' OR $transactionHead[$i]['status'] == 'Partially Paid' OR $transactionHead[$i]['status'] == 'Added to next month' ){ ?>
                    <tr>
                        <td> 
                            <?php echo $transactionHead[$i]['voucher_no']; ?> 
                        </td>
                        <td> 
                            <?php
                            $transactionMonth = Yii::$app->db->createCommand("SELECT fmd.month FROM fee_month_detail as fmd WHERE fmd.voucher_no = '$voucher'")->queryAll();
                                $countMonth = count($transactionMonth);
                                if($countMonth >1){
                                    echo date('F', strtotime($transactionMonth[0]['month'])).'/'.date('F-Y', strtotime($transactionMonth[1]['month']));
                                } else {
                                    echo date('F-Y', strtotime($transactionMonth[0]['month'])); 
                                } 
                            ?>    
                        </td>
                        <td>
                            <?php echo $transactionHead[$i]['total_amount']; ?>
                        </td>
                        <td>
                            <?php echo $transactionHead[$i]['paid_amount']; ?>
                        </td>

                        <td>
                            <?php echo $transactionHead[$i]['total_amount'] - $transactionHead[$i]['paid_amount']; ?>
                        </td>
                        <td>
                            <?php echo $transactionHead[$i]['status']; ?>
                        </td>
                        <td>
                            <?php echo date('d-M-Y h:i A', strtotime($collectionDate)); ?>
                        </td>
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
                        <td> 
                            <?php echo $voucher; ?> 
                        </td>
                        <td> 
                            <?php 
                                $transactionMonth = Yii::$app->db->createCommand("SELECT fmd.month FROM fee_month_detail as fmd WHERE fmd.voucher_no = '$voucher'")->queryAll();
                                $countMonth = count($transactionMonth);
                                if($countMonth >1){
                                    echo date('F', strtotime($transactionMonth[0]['month'])).'/'.date('F-Y', strtotime($transactionMonth[1]['month']));
                                } else {
                                    echo date('F-Y', strtotime($transactionMonth[0]['month'])); 
                                }
                            ?>
                        </td>
                        <td> 
                            <input type="number" name="totalAmount[]" value="<?php echo $transactionHead[$i]['total_amount']; ?>" id="totalAmount_<?php echo $i; ?>" readonly="" class="form-control" style="width: 100px">
                        </td>
                        <td>
                            <input type="number" name="paidAmount[]" value="0" id="paidAmount_<?php echo $i; ?>" onchange="setStatus(<?php echo $i; ?>)" class="form-control" style="width: 100px">
                        </td>
                        <td>
                            <input type="number" name="remaining[]" value="0" id="remaining_<?php echo $i; ?>" readonly="" class="form-control" style="width: 100px">
                        </td>
                        <td>
                            <input type="text" name="status[]" value="Unpaid" id="status_<?php echo $i; ?>" readonly="" class="form-control" style="width: 110px">
                        </td>
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
                }
                }
            } 
        }
        if($_POST["classid"] && $_POST["std"]) {
            $classId = $_POST["classid"];
            $stdId = $_POST["std"];
            $regsNo = Yii::$app->db->createCommand("SELECT std_reg_no FROM std_personal_info WHERE std_id = '$stdId'")->queryAll();
            $regNo = $regsNo[0]['std_reg_no'];
            $sessionDetail = Yii::$app->db->createCommand("SELECT s.session_start_date, s.session_end_date FROM std_sessions as s INNER JOIN std_enrollment_head  as e ON s.session_id = e.session_id WHERE e.std_enroll_head_id = '$classId'")->queryAll(); 
            
            $yearStart = date('Y-m', strtotime($sessionDetail[0]['session_start_date']));
            $yearEnd = date('Y-m', strtotime($sessionDetail[0]['session_end_date']));

            $transactionHead = Yii::$app->db->createCommand("SELECT DISTINCT fmd.voucher_no, fth.*  FROM fee_transaction_head as fth INNER JOIN fee_month_detail as fmd ON fmd.voucher_no = fth.voucher_no WHERE fth.std_id = '$stdId' AND fmd.month >= '$yearStart' AND fmd.month <=  '$yearEnd'")->queryAll();
        

            if(empty($transactionHead)){
                 Yii::$app->session->setFlash('warning', "Please manage the account first, for further proceedings.");
            } else { 
            global $count;
            $count = count($transactionHead);

            $studentID = $transactionHead[0]['std_id'];
            $classID = $transactionHead[0]['class_name_id'];
            
            $student = Yii::$app->db->createCommand("SELECT std_name FROM std_personal_info WHERE std_id = '$studentID'")->queryAll();        

            $class = Yii::$app->db->createCommand("SELECT class_name FROM std_class_name WHERE class_name_id = '$classID'")->queryAll(); ?>
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
                <th>Voucher #</th>
                <th>Month</th>
                <th>Total Amount</th>
                <th>Amount Paid</th>
                <th>Remaining Amount</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i=0; $i < $count ; $i++) { 
                $collectionDate = $transactionHead[$i]['collection_date'];
                $voucher = $transactionHead[$i]['voucher_no'];
                if($transactionHead[$i]['status'] == 'Paid' OR $transactionHead[$i]['status'] == 'Partially Paid' OR $transactionHead[$i]['status'] == 'Added to next month'){ ?>
                    <tr>
                        <td> 
                            <?php echo $transactionHead[$i]['voucher_no']; ?> 
                        </td>
                        <td> 
                            <?php 
                                $transactionMonth = Yii::$app->db->createCommand("SELECT fmd.month FROM fee_month_detail as fmd WHERE fmd.voucher_no = '$voucher'")->queryAll();
                                $countMonth = count($transactionMonth);
                                if($countMonth >1){
                                    echo date('F', strtotime($transactionMonth[0]['month'])).'/'.date('F-Y', strtotime($transactionMonth[1]['month']));
                                } else {
                                    echo date('F-Y', strtotime($transactionMonth[0]['month'])); 
                                }
                            ?> 
                        </td>
                        <td> 
                            <?php echo $transactionHead[$i]['total_amount']; ?> 
                        </td>
                        <td> 
                            <?php echo $transactionHead[$i]['paid_amount']; ?> 
                        </td>
                        <td> 
                            <?php echo $transactionHead[$i]['total_amount'] - $transactionHead[$i]['paid_amount']; ?> 
                        </td>
                        <td> 
                            <?php echo $transactionHead[$i]['status']; ?> 
                        </td>
                        <td>
                            <?php echo date('d-M-Y h:i A', strtotime($collectionDate)); ?>
                        </td>
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
                    <td> 
                        <?php echo $transactionHead[$i]['voucher_no']; ?> 
                    </td>
                    <td> 
                        <?php 
                            $transactionMonth = Yii::$app->db->createCommand("SELECT fmd.month FROM fee_month_detail as fmd WHERE fmd.voucher_no = '$voucher'")->queryAll();

                            $countMonth = count($transactionMonth);
                            if($countMonth > 1){
                                echo date('F', strtotime($transactionMonth[0]['month'])).'/'.date('F-Y', strtotime($transactionMonth[1]['month']));
                            } else {
                                echo date('F-Y', strtotime($transactionMonth[0]['month'])); 
                            }
                        ?> 
                    </td>
                    <td> 
                       <input type="number" name="totalAmount[]" value="<?php echo $transactionHead[$i]['total_amount']; ?>" id="totalAmount<?php echo $i; ?>" readonly="" class="form-control" style="width: 100px">
                    </td>
                    <td>
                        <input type="number" name="paidAmount[]" value="0" id="paidAmount<?php echo $i; ?>" class="form-control" onchange="setStatuss(<?php echo $i; ?>)" style="width: 100px">
                    </td>
                    <td>
                        <input type="number" name="remaining[]" value="0" id="remaining<?php echo $i; ?>" readonly="" class="form-control" style="width: 100px">
                    </td>
                    <td>
                        <input type="text" name="status[]" value="Unpaid" id="status<?php echo $i; ?>" readonly="" class="form-control" style="width: 110px">
                    </td>
                        <input type="hidden" name="voucherNo[]" value="<?php echo $transactionHead[$i]['fee_trans_id']; ?>">
                        
                </tr>
                <?php } } ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <button type="submit" name="save" class="btn btn-success btn-flat"><i class="fa fa-sign-in"></i><b> Save</b></button>
                    </div> 
                </div>
            </div>  
        </form>
</div>
<!-- modified collect voucher close --> 
<?php 
            }
        } 
}
// isset close.... 
?>

<?php 
if(isset($_POST['save'])){
    $paidAmount = $_POST["paidAmount"];
    $remaining  = $_POST["remaining"];
    $status     = $_POST["status"];
    $voucherNo  = $_POST["voucherNo"];
    $counts     =count($paidAmount);
    $totalAmount = 0;
    $branch_id = Yii::$app->user->identity->branch_id;

    $transaction = \Yii::$app->db->beginTransaction();
    try {
        for($i=0;$i<$counts;$i++){
            $updateTransactionHead = Yii::$app->db->createCommand()->update('fee_transaction_head', ['paid_amount'=> $paidAmount[$i], 'remaining' => $remaining[$i],  'status' => $status[$i], 'collection_date'=> new \yii\db\Expression('NOW()')], ['fee_trans_id' => $voucherNo[$i]])->execute();
            $totalAmount += $paidAmount[$i]; 
        }
        $account = Yii::$app->db->createCommand()->insert('account_transactions', [
            'branch_id'=> $branch_id,
            'account_nature'=> 'Income',  
            'account_register_id' => 5,
            'date' => new \yii\db\Expression('NOW()'),
            'description' => "Amount ".$status[0]." By Voucher #: ".$voucherNo[0],
            'total_amount' => $totalAmount,
            'created_at' => new \yii\db\Expression('NOW()'),
            'created_by' => Yii::$app->user->identity->id,
        ])->execute();
        if ($account) {
            $transaction->commit();
            // success alert message...
            Yii::$app->session->setFlash('success', "Voucher paid Successfully...!"); 
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
   function setStatus(i){
        var totalAmount = parseInt($('#totalAmount_'+i).val());
        var paidAmount = parseInt($('#paidAmount_'+i).val());
        var remaining = totalAmount - paidAmount;
        $('#remaining_'+i).val(remaining);
        if( remaining == 0 ) {
            paid = "Paid";
            $('#status_'+i).val(paid);
        } else {
            paid = "Partially Paid";
            $('#status_'+i).val(paid);
        }
    }
    function setStatuss(i){
        var totalAmount = parseInt($('#totalAmount'+i).val());
        var paidAmount = parseInt($('#paidAmount'+i).val());
        var remaining = totalAmount - paidAmount;

        $('#remaining'+i).val(remaining);
        if( remaining == 0 ) {
            paid = "Paid";
            $('#status'+i).val(paid);
        } else {
            paid = "Partially Paid";
            $('#status'+i).val(paid);
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