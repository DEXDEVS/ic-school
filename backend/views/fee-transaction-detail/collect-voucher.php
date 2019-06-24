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
	<h1 class="well well-sm bg-navy" align="center" style="font-family: serif;">Collect Voucher</h1>
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
                    <input type="text" name="voucher_no" class="form-control" placeholder="Enter Voucher Number..." id="voucher_no" required="">
                </div>    
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-success btn-flat"><i class="fa fa-sign-in"></i><b> View Voucher's Detail</b></button>
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
	$voucherNo = $_POST["voucher_no"];

	$transactionHead = Yii::$app->db->createCommand("SELECT * FROM fee_transaction_head WHERE voucher_no = '$voucherNo'")->queryAll();
	if(empty($transactionHead)){
        Yii::$app->session->setFlash('error', "Voucher number not exist! Please select valid voucher no...!");
    } else {
    	$transactionDetail = Yii::$app->db->createCommand("SELECT ftd.fee_type_id, ftd.fee_amount FROM ((fee_transaction_detail as ftd INNER JOIN fee_month_detail as fmd ON fmd.month_detail_id = ftd.fee_trans_detail_head_id) INNER JOIN fee_transaction_head as fth ON fmd.voucher_no = fth.voucher_no) WHERE fth.voucher_no = '$voucherNo'")->queryAll();
        $count = count($transactionDetail);
        $status = $transactionHead[0]['status'];
        $remainingAmount = $transactionHead[0]['remaining'];

        if ($status == "Partially Paid" OR $status == "Unpaid") {

        $studentID = $transactionHead[0]['std_id'];
        $classID = $transactionHead[0]['class_name_id'];
        
        $voucherMonth = Yii::$app->db->createCommand("SELECT month FROM fee_month_detail WHERE voucher_no = '$voucherNo'")->queryAll();
        $monthCount = count($voucherMonth);    

        $student = Yii::$app->db->createCommand("SELECT std_name FROM std_personal_info WHERE std_id = '$studentID'")->queryAll();        

        $class = Yii::$app->db->createCommand("SELECT class_name FROM std_class_name WHERE class_name_id = '$classID'")->queryAll();  

?>  

<!-- modified collect voucher start -->
<div class="row container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h3 class="well well-sm">
                <?php echo $student[0]['std_name']." - ".$class[0]['class_name'];
                if($monthCount > 1){ ?>
                    <span style='float: right;'><?php echo date('F', strtotime($voucherMonth[0]["month"])).'/'.date('F, Y', strtotime($voucherMonth[1]["month"])); 
                } else { ?> </span>
                <span style='float: right;'>
                    <?php echo date('F, Y', strtotime($voucherMonth[0]["month"])); 
                } ?>
                </span>
            </h3>
        </div>
    </div>
    <div class="col-md-4 col-md-offset-2">
        <table class="table table-bordered">
            <tbody>
                <tr class="bg-navy">
                    <th colspan="3" class=" text-center"><b>Voucher #: <?php echo $voucherNo; ?></b></th>
                </tr>
                <tr class="bg-info">
                    <th><b>Fee Types</b></th>
                    <th colspan="2" class="text-center">Amount</th>
                </tr>
                <form data-ajax="false" method="post">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="hidden" name="_csrf" class="form-control" value="<?=Yii::$app->request->getCsrfToken()?>">          
                            </div>    
                        </div>    
                    </div>
                    <?php for ($i=0; $i <$count; $i++) { 
                        $typeId = $transactionDetail[$i]['fee_type_id'];
                        $typeIdArray[$i] = $typeId;
                        $feeAmount = $transactionDetail[$i]['fee_amount'];
                        $feeTypeName = Yii::$app->db->createCommand("SELECT fee_type_name FROM fee_type WHERE fee_type_id = '$typeId'")->queryAll();
                    ?>
                        <tr>
                            <td width="150px"><?php echo $feeTypeName[0]['fee_type_name'];?></td>
                            <th style="width: 80px" class="text-center">
                                <?php echo $feeAmount;?>
                            </th>
                        </tr>
                    <?php } ?>
            </tbody>
        </table>        
    </div>
    <div class="col-md-4">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th colspan="2" class="text-center bg-navy">Payment</th>
                </tr>
                <tr class="bg-info">
                    <th colspan="2" class="text-center">Fee Transaction</th>
                </tr>
                <tr>
                    <td>Total Amount</td>
                    <div class="form-group">
                        <?php
                        if ($remainingAmount==0) { ?>
                            <td>
                                <input type="text" name="total_amount" class="form-control text-center" id="total_amount" value="<?php echo $transactionHead[0]['total_amount'] ?>" readonly="" style="width: 120px;"/>
                            </td>
                        <?php } else{ ?>
                        <td>
                            <input type="text" name="total_amount" class="form-control text-center" id="total_amount" value="<?php echo $transactionHead[0]['remaining'] ?>" readonly="" style="width: 120px"/>
                        </td>
                        <?php } ?>
                    </div>
                </tr>
                <tr>
                    <td>Paid Amount</td>
                    <td>
                        <input type="number" class="form-control text-center" id="paid_amount" name="paid_amount" onchange="setAmount()" required="" style="width: 120px"/>
                    </td>
                </tr>
                <tr>
                    <td>Remaining Amount</td>
                    <td>
                        <input type="text" class="form-control text-center" id="remaining_amount" name="remaining_amount" style="width: 120px" readonly="">
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <input type="text" class="form-control text-center" id="status" name="status" readonly="" style="width: 120px">
                    </td>
                </tr>
                <table class="table">
            <tbody>
                <tr>
                    <td>
                       <button formaction="fee-transaction-detail-collect-voucher" type="submit" name="save" id="btn" class="btn btn-success btn-flat  btn-block" style="padding: 5px 27px;"><span class="fa fa-check-square" aria-hidden="true"></span><b> Collect Voucher</b></button>
                    </td>
                </tr>
            </tbody>
        </table>           
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-md-2 invisible">
                                <input type="number" name="voucherNo"  class="form-control" value="<?php echo $voucherNo; ?>">
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>        
        </form>
    </table>
</div>
<!-- modified collect voucher close -->


<?php 
        }
        // if close...
        else{
            // alert message...
            Yii::$app->session->setFlash('warning', "This voucher has already paid...!");
        }
        // else close....
    }
    // top else close....
}
// isset close.... 
?>

<?php 
if(isset($_POST['save'])){
    $voucherNo        = $_POST["voucherNo"];
    $paidAmount       = $_POST["paid_amount"];
    $remainingAmount  = $_POST["remaining_amount"];
    $status           = $_POST["status"];
    $collectionDate   = new \yii\db\Expression('NOW()');
    $branch_id = Yii::$app->user->identity->branch_id;

    $transaction = \Yii::$app->db->beginTransaction();
    try {
        $paid_amount = Yii::$app->db->createCommand("SELECT paid_amount FROM fee_transaction_head WHERE voucher_no = '$voucherNo'")->queryAll();
        $amountPaid = $paidAmount  + $paid_amount[0]['paid_amount'];

        $updateTransactionHead = Yii::$app->db->createCommand()->update('fee_transaction_head', ['paid_amount'=> $amountPaid, 'remaining'=> $remainingAmount , 'status' => $status, 'collection_date' => $collectionDate], ['voucher_no' => $voucherNo])->execute();

        $account = Yii::$app->db->createCommand()->insert('account_transactions', [
                'branch_id'=> $branch_id,
                'account_nature'=> 'Income',  
                'account_register_id' => 5,
                'date' => new \yii\db\Expression('NOW()'),
                'description' => "Amount ".$status." By Voucher #: ".$voucherNo,
                'total_amount' => $paidAmount,
                'created_at' => new \yii\db\Expression('NOW()'),
                'created_by' => Yii::$app->user->identity->id,
            ])->execute();
     
        if ($updateTransactionHead) {
            $transaction->commit();
            // success alert message...
            if ($status == "Partially Paid") {
                // success partaill paid alert message...
                Yii::$app->session->setFlash('success', "Voucher Partially Paid Successfully...!"); 
            } else if ($status == "Paid") {
                // success alert message...
                Yii::$app->session->setFlash('success', "Voucher Paid Successfully...!"); 
            } else {
                // failure alert message
                Yii::$app->session->setFlash('danger', "Voucher not paid, Try again...!");      
            } 
        } 
    } 
    // ending try....
    catch (Exception $e) {
        $transaction->rollBack();
        Yii::$app->session->setFlash('error', "Transaction Failed, Try Again...!");
    }
    // ending catch...
}
// ending isset....!
?>  

</div>
</body>
</html>

<script type="text/javascript">
   function setAmount(){
        var totalAmount = parseInt(document.getElementById('total_amount').value);
        var paidAmount = parseInt(document.getElementById('paid_amount').value);
        $('#paid_amount2').val(paidAmount); 
        var remainingAmount = parseInt(totalAmount - paidAmount);
        paid = "Paid";
        partialyPaid = "Partially Paid";
        document.getElementById('remaining_amount').value = remainingAmount;
        $('#remaining_amount2').val(remainingAmount);
        if (remainingAmount==0) {
            $('#status').val(paid);
            $('#status2').val(paid); 
        }
        else{
            $('#status').val(partialyPaid);
            $('#status2').val(partialyPaid);
        }
        // var status = $('#status').val();
        // if (status == "Partially Paid") {
        //     $('#date').show();
        //     $('#partialButton').show();
        //     $('#btn').hide();
        // }else{
        //     $('#btn').show();
        //     $('#partialButton').hide();
        //     $('#date').hide();
        // }
    }
    

</script>