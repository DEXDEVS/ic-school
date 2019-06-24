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
	<h1 class="well well-sm bg-navy" align="center">Monthly Fee Collection</h1>
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
                    <input type="text" name="reg_no" class="form-control" placeholder="Enter Registration Number..." id="reg_no" required="">
                </div>    
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="month" class="form-control" name="monthYear" required="" placeholder="Select Month...">   
                </div>    
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-success btn-flat"><i class="fa fa-sign-in"></i><b> View Fee Details</b></button>
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
		$regNo = $_POST["reg_no"];
        $monthYear = $_POST["monthYear"];

        $stdId = Yii::$app->db->createCommand("SELECT std_id FROM std_personal_info WHERE std_reg_no= '$regNo'")->queryAll();
        if(empty($stdId)){
            Yii::$app->session->setFlash('warning', "This registration number not exist! Select valid registration no");
        } else {
        $std_id = $stdId[0]['std_id'];
    	$transactionHead = Yii::$app->db->createCommand("SELECT * FROM fee_transaction_head WHERE std_id = '$std_id' AND month = '$monthYear'")->queryAll();
        if(empty($transactionHead)){
            Yii::$app->session->setFlash('warning', "Please select the valid month");
        } else {
        $voucherNo = $transactionHead[0]['fee_trans_id'];
        $transactionDetail = Yii::$app->db->createCommand("SELECT fee_type_id,fee_amount,collected_fee_amount FROM fee_transaction_detail WHERE fee_trans_detail_head_id = '$voucherNo'")->queryAll();
        $count = count($transactionDetail);
        $status = $transactionHead[0]['status'];
        if ($status == "Unpaid") {

        $studentID = $transactionHead[0]['std_id'];
        $classID = $transactionHead[0]['class_name_id'];
        $month = $transactionHead[0]['month']; 

        $student = Yii::$app->db->createCommand("SELECT std_name FROM std_personal_info WHERE std_id = '$studentID'")->queryAll();        

        $class = Yii::$app->db->createCommand("SELECT class_name FROM std_class_name WHERE class_name_id = '$classID'")->queryAll();       
    ?>  


<!-- modified collect voucher start -->
<div class="row container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h3 class="well well-sm">
                <?php echo "Class - ".$class[0]['class_name']." : ".$student[0]['std_name']."<span style='float: right;'>".date('F, Y', strtotime($month))."</span>"; ?>
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
                        $collectedAmount = $transactionDetail[$i]['collected_fee_amount'];
                        $netFee = $feeAmount - $collectedAmount;
                        $feeTypeName = Yii::$app->db->createCommand("SELECT fee_type_name FROM fee_type WHERE fee_type_id = '$typeId'")->queryAll();
                    ?>
                        <tr>
                            <td width="150px"><?php echo $feeTypeName[0]['fee_type_name'];?></td>
                            <td width="80px">
                                <div class="form-group">
                                    <input type="number" name="amount<?php echo $i;?>" class="form-control" value="<?php echo $netFee;?>"  readonly="" style="width:80px">
                                </div>
                            </td>
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
                <tr>
                    <th>Total Amount</th>
                    <div class="form-group">
                        <td>
                            <input type="text" name="total_amount" class="form-control" id="total_amount" readonly="" value="<?php echo $transactionHead[0]['total_amount'] ?>" style="width: 70px;"/>
                        </td> 
                    </div>
                </tr>
                <tr>
                    <th>Total Discount</th>
                    <td>
                        <input type="number" class="form-control" name="total_discount" value="0" id="totalDiscount" style="width: 70px"/>
                    </td>
                </tr>
                <tr>
                    <th>Paid Amount</th>
                    <td>
                        <input type="number" class="form-control" id="paid_amount" name="paid_amount" onfocus="setAmount()" required="" style="width: 70px"/>
                    </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <input type="text" class="form-control" id="status" name="status" readonly="" style="width: 110px">
                    </td>
                </tr>
                <table class="table">
            <tbody>
                <tr>
                    <td>
                       <button formaction="monthly-voucher" type="submit" name="save" id="btn" class="btn btn-success btn-flat  btn-block" style="padding: 5px 27px;"><span class="fa fa-check-square" aria-hidden="true"></span><b> Collect Voucher</b></button>
                    </td>
                </tr>
            </tbody>
        </table>           
                <tr>
                    <td>
                        <div class="row">
                            <?php foreach ($typeIdArray as $value) {
                                echo '<input type="hidden" name="typeIdArray[]" value="'.$value.'">';
                            } ?>
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
    // end of reg_no else
    }
    // end of month else
    }
}
// isset close.... 
?>

<?php 
if(isset($_POST['save'])){
    $voucherNo        = $_POST["voucherNo"];
    $paidAmount       = $_POST["paid_amount"];
    $status           = $_POST["status"];
    $typeIdArray      = $_POST["typeIdArray"];
    $length = count($typeIdArray);
    for($i=0; $i<$length;$i++){ 
        $amount = "amount".$i;
        $feeAmount[$i] = $_POST["$amount"];
    }
    $transaction = \Yii::$app->db->beginTransaction();
    try {
        $updateTransactionHead = Yii::$app->db->createCommand()->update('fee_transaction_head', ['paid_amount'=> $paidAmount,  'status' => $status,'collection_date'=> new \yii\db\Expression('NOW()')], ['fee_trans_id' => $voucherNo])->execute();
        for ($i=0; $i <$length; $i++) { 
            $collectedAmount = Yii::$app->db->createCommand("SELECT collected_fee_amount FROM fee_transaction_detail WHERE fee_trans_detail_head_id = $voucherNo AND fee_type_id = $typeIdArray[$i]")->queryAll();

            $updateTransactionDetail = Yii::$app->db->createCommand()->update('fee_transaction_detail', ['collected_fee_amount'=> $feeAmount[$i]], ['fee_trans_detail_head_id' => $voucherNo, 'fee_type_id'=> $typeIdArray[$i]])->execute();
        }
        $account = Yii::$app->db->createCommand()->insert('account_transactions', [
            'account_nature'=> 'Income',  
            'account_register_id' => 5,
            'date' => new \yii\db\Expression('NOW()'),
            'description' => $status,
            'total_amount' => $paidAmount,
            'created_at' => new \yii\db\Expression('NOW()'),
            'created_by' => Yii::$app->user->identity->id,
        ])->execute();
        
        if ($updateTransactionHead) {
            $transaction->commit();
            // success alert message...
            Yii::$app->session->setFlash('success', "Voucher paid Successfully...!"); 
        } 
    } 
    // ending try....
    catch (Exception $e) {
        $transaction->rollBack();
        Yii::$app->session->setFlash('error', "Transaction Failed, Try Again...!");
    }
    // ending catch...
}
// ending isset
?>  
</div>
</body>
</html>

<script type="text/javascript">
   function setAmount(){
        var totalAmount = parseInt(document.getElementById('total_amount').value);
        var totalDiscount = parseInt(document.getElementById('totalDiscount').value);
        var remainingAmount = parseInt(totalAmount - totalDiscount);
        $('#paid_amount').val(remainingAmount); 
        paid = "Paid";
        //partialyPaid = "Partially Paid";
        $('#status').val(paid);
    }
</script>