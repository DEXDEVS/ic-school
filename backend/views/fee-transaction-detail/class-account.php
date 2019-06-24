<?php 
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\datetimepicker\DateTimePicker;
use kartik\select2\Select2;
use common\models\FeeTransactionHead;

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Fee Vocher</title>
    <link rel="stylesheet" href="select2/dist/css/select2.min.css">

</head>
<body>
<div class="container-fluid" style="margin-top: -30px;">
    <h1 class="well well-sm bg-navy" align="center" style="color:#001F3F; font-family: serif;">Manage Class Fee Accounts</h1>
    <!-- action="index.php?r=fee-transaction-detail/class-account-info" -->
    <form method="POST" action="fee-transaction-detail-class-account-info">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <input type="hidden" name="_csrf" class="form-control" value="<?=Yii::$app->request->getCsrfToken()?>">          
                </div>    
            </div>    
        </div>
    <?php $branch_id = Yii::$app->user->identity->branch_id; ?>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Select Class</label>
                    <select class="form-control" name="classid" id="classId" required="required">
                        <option>Select Class</option>
                            <?php 
                                $className = Yii::$app->db->createCommand("SELECT * FROM std_class_name where delete_status=1 AND branch_id = $branch_id")->queryAll();
                                
                                    foreach ($className as  $value) { ?>    
                                    <option value="<?php echo $value["class_name_id"]; ?>">
                                        <?php echo $value["class_name"]; ?> 
                                    </option>
                            <?php } ?>
                    </select>      
                </div>    
            </div>  
            <div class="col-md-4">
                <div class="form-group">
                    <label>Select Session</label>
                    <select class="form-control" name="sessionid" id="sessionId" required="">
                            <option value="">Select Session</option>
                            <?php 
                                $sessionName = Yii::$app->db->createCommand("SELECT * FROM std_sessions where delete_status=1 AND session_branch_id = $branch_id")->queryAll();
                                    foreach ($sessionName as  $value) { ?>  
                                    <option value="<?php echo $value["session_id"]; ?>">
                                        <?php echo $value["session_name"]; ?>   
                                    </option>
                            <?php } ?>
                    </select>      
                </div>    
            </div>  
            <div class="col-md-4">
                <div class="form-group">
                    <label>Select Section</label>
                    <select class="form-control" name="sectionid" id="section" required="">
                            <option value="">Select Section</option>
                    </select>      
                </div>    
            </div>    
        </div>
        <div class="row">              
            <div class="col-md-4"> 
                <label>Select Month</label>
                <?php 
                    $year = date('Y');  

                    $data = [
                        $year.'-01'=>'January '.$year, $year.'-02'=>'February '.$year, 
                        $year.'-03'=>'March '.$year, $year.'-04'=>'April '.$year, 
                        $year.'-05'=>'May '.$year, $year.'-06'=>'June '.$year, 
                        $year.'-07'=>'July '.$year, $year.'-08'=>'August '.$year, 
                        $year.'-09'=>'September '.$year, $year.'-10'=>'October '.$year, 
                        $year.'-11'=>'November '.$year, $year.'-12'=>'December '.$year,
                    ];
                    echo Select2::widget([
                        'name' => 'month',
                        //'value' => 2, // value to initialize
                        'data' => $data,
                        'options' => ['placeholder' => 'Select Month'],
                        'showToggleAll' => false,
                        'pluginOptions' => [
                            'allowClear' => true,
                            'multiple' => true,
                            'maximumSelectionLength'=> 2,
                        ],
                    ]);
                ?>
            </div>
            <div class="col-md-2">
                <div class="form-group" style="margin-top: 24px;">
                    <button type="submit" name="submit" class="btn btn-success btn-flat btn-block"><i class="fa fa-check-square-o" aria-hidden="true"></i><b> Get Class</b></button>
                </div>    
            </div>
        </div>
    </form>
    <!-- Header Form Close--> 
</body> 
</html>

<?php  
    global $length; 
    if (isset($_POST["save"])) {
        $classid            = $_POST["classid"];
        $sessionid          = $_POST["sessionid"];
        $sectionid          = $_POST["sectionid"];
        $months            = $_POST["month"];
        $length             = $_POST["length"];
        $studentId          = $_POST["studentId"];
        $studentName        = $_POST["studentName"];
        $total_amount       = $_POST["total_amount"];
        // detail values....
        $admission_fee      = $_POST["admission_fee"];
        $tuition_fee        = $_POST["tuition_fee"];
        $absent_fine        = $_POST["absent_fine"];
        $activity_fee       = $_POST["activity_fee"];
        $stationary_expense = $_POST["stationary_expense"];
        $board_uni_fee      = $_POST["board_uni_fee"];
        $exam_fee           = $_POST["exam_fee"];
        $arrears            = $_POST["arrears"];
        $feeType            = Array('1','2','3','4','5','6','7','8');
        $updateStatus       = -1;
        $countMonth = count($months);
        $month = $months[0];

        if ($countMonth > 1) {
           $headTransId = Yii::$app->db->createCommand("SELECT DISTINCT fth.voucher_no FROM fee_transaction_head as fth INNER JOIN fee_month_detail as fmd ON fth.voucher_no = fmd.voucher_no WHERE fth.class_name_id = '$classid' AND fth.session_id = '$sessionid' AND fth.section_id = '$sectionid' AND fmd.month >= '$months[0]' AND fmd.month <= '$months[1]'")->queryAll();
        } else {
            $headTransId = Yii::$app->db->createCommand("SELECT fth.voucher_no FROM fee_transaction_head as fth INNER JOIN fee_month_detail as fmd ON fth.voucher_no = fmd.voucher_no WHERE fth.class_name_id = '$classid' AND fth.session_id = '$sessionid' AND fth.section_id = '$sectionid' AND fmd.month = '$month'")->queryAll();
        }

        $transaction = \Yii::$app->db->beginTransaction();
        try {
            if(empty($headTransId)){
                for($i=0; $i<$length; $i++){
                    $statusUpdate = Yii::$app->db->createCommand("UPDATE fee_transaction_head SET status = 'Added to next month' WHERE std_id = '$studentId[$i]' AND status = 'Unpaid' OR status = 'Partially Paid'")->execute();
                    $voucher = FeeTransactionHead::find()->orderBy(['voucher_no'=> SORT_DESC])->one();
                    if($voucher == NULL){
                        $voucherNo = '1001';
                    } else {
                        $voucherNo = $voucher['voucher_no']+1;
                    }
                    $amounts =0; 
                    for($z=0; $z<$countMonth; $z++){
                        if($z == 0){
                            $totalAmount = $total_amount[$i];
                            $amounts += $totalAmount;
                        } else {
                            $amount = ($admission_fee[$i] + $absent_fine[$i] + $activity_fee[$i] + $stationary_expense[$i] + $board_uni_fee[$i] + $exam_fee[$i] + $arrears[$i]);
                            $total = ($total_amount[$i] - $amount);
                            $amounts += $total;
                        }
                        
                    }
                    $feeHead = Yii::$app->db->createCommand()->insert('fee_transaction_head',[
                        'class_name_id' => $classid,
                        'voucher_no' => $voucherNo,
                        'branch_id' => Yii::$app->user->identity->branch_id,
                        'session_id'=> $sessionid,
                        'section_id'=> $sectionid,
                        'std_id' => $studentId[$i],
                        'std_name' => $studentName[$i],
                        'transaction_date' =>  new \yii\db\Expression('NOW()'),
                        'total_amount'=>  $amounts, 
                        'status'=>'unpaid',
                        'created_by' => Yii::$app->user->identity->id,
                    ])->execute();
                    for($z=0; $z<$countMonth; $z++){
                        if($z == 0){
                            $totalAmount = $total_amount[$i];
                        } else {
                            $amount = ($admission_fee[$i] + $absent_fine[$i] + $activity_fee[$i] + $stationary_expense[$i] + $board_uni_fee[$i] + $exam_fee[$i] + $arrears[$i]);
                            $totalAmount = ($total_amount[$i] - $amount);
                        }
                        $feeMonth = Yii::$app->db->createCommand()->insert('fee_month_detail',[
                        'voucher_no' => $voucherNo,
                        'month' => $months[$z],
                        'monthly_amount'=>  $totalAmount, 
                        ])->execute();

                    $headID = Yii::$app->db->createCommand("SELECT month_detail_id FROM fee_month_detail WHERE voucher_no = '$voucherNo' AND month = '$months[$z]'")->queryAll();

                    $headId = $headID[0]['month_detail_id'];
                    for($j=0;$j<8;$j++){
                        if($feeType[$j] == 1 && $admission_fee[$i] > 0 && $z == 0){
                            $feeDetails = Yii::$app->db->createCommand()->insert('fee_transaction_detail',[
                            'fee_trans_detail_head_id' => $headId,
                            'fee_type_id'=> $feeType[$j],
                            'fee_amount'=> $admission_fee[$i]
                            ])->execute();
                        }
                        if($feeType[$j] == 2 && $tuition_fee[$i] > 0){
                            $feeDetails = Yii::$app->db->createCommand()->insert('fee_transaction_detail',[
                            'fee_trans_detail_head_id' => $headId,
                            'fee_type_id'=> $feeType[$j],
                            'fee_amount'=> $tuition_fee[$i], 
                            ])->execute();
                        }
                        if($feeType[$j] == 3 && $absent_fine[$i] > 0 && $z == 0){
                            $feeDetails = Yii::$app->db->createCommand()->insert('fee_transaction_detail',[
                            'fee_trans_detail_head_id' => $headId,
                            'fee_type_id'=> $feeType[$j],
                            'fee_amount'=> $absent_fine[$i],
                            ])->execute();
                        }
                        if($feeType[$j] == 4 && $activity_fee[$i] > 0 && $z == 0){
                            $feeDetails = Yii::$app->db->createCommand()->insert('fee_transaction_detail',[
                            'fee_trans_detail_head_id' => $headId,
                            'fee_type_id'=> $feeType[$j],
                            'fee_amount'=> $activity_fee[$i], 
                            ])->execute();
                        }
                        if($feeType[$j] == 5 && $stationary_expense[$i] > 0 && $z == 0){
                            $feeDetails = Yii::$app->db->createCommand()->insert('fee_transaction_detail',[
                            'fee_trans_detail_head_id' => $headId,
                            'fee_type_id'=> $feeType[$j],
                            'fee_amount'=> $stationary_expense[$i],
                            ])->execute();
                        }
                        if($feeType[$j] == 6 && $board_uni_fee[$i] > 0 && $z == 0){
                            $feeDetails = Yii::$app->db->createCommand()->insert('fee_transaction_detail',[
                            'fee_trans_detail_head_id' => $headId, 
                            'fee_type_id'=> $feeType[$j],
                            'fee_amount'=> $board_uni_fee[$i], 
                            ])->execute();
                        }
                        if($feeType[$j] == 7 && $exam_fee[$i] > 0 && $z == 0){
                            $feeDetails = Yii::$app->db->createCommand()->insert('fee_transaction_detail',[
                            'fee_trans_detail_head_id' => $headId, 
                            'fee_type_id'=> $feeType[$j],
                            'fee_amount'=> $exam_fee[$i], 
                            ])->execute();
                        }
                        if($feeType[$j] == 8 && $arrears[$i] > 0 && $z == 0){
                            $feeDetails = Yii::$app->db->createCommand()->insert('fee_transaction_detail',[
                            'fee_trans_detail_head_id' => $headId, 
                            'fee_type_id'=> $feeType[$j],
                            'fee_amount'=> $arrears[$i], 
                            ])->execute();
                        }
                    }
                    //end of j for loop
                    
                    }
                    //end of z for loop  
                }
                //end of i for loop
                // success alert message...
                Yii::$app->session->setFlash('success', "You have successfully maintain this class account...!"); 
            // end of if
            } else {
                $voucherNo = $headTransId[0]['voucher_no'];
                for($i=0; $i<$length; $i++){
                    $amounts =0; 
                    for($z=0; $z<$countMonth; $z++){
                        if($z == 0){
                            $totalAmount = $total_amount[$i];
                            $amounts += $totalAmount;
                        } else {
                            $amount = ($admission_fee[$i] + $absent_fine[$i] + $activity_fee[$i] + $stationary_expense[$i] + $board_uni_fee[$i] + $exam_fee[$i] + $arrears[$i]);
                            $total = ($total_amount[$i] - $amount);
                            $amounts += $total;
                        }   
                    }

                    $feeHead = Yii::$app->db->createCommand()->update('fee_transaction_head', [
                        'class_name_id' => $classid,
                        'branch_id' => Yii::$app->user->identity->branch_id,
                        'session_id'=> $sessionid,
                        'section_id'=> $sectionid,
                        'std_id' => $studentId[$i],
                        'std_name' => $studentName[$i],
                        'transaction_date' => new \yii\db\Expression('NOW()'),
                        'total_amount'=> $amounts,
                        'status'=>'unpaid',
                        'updated_by' => Yii::$app->user->identity->id],
                        ['voucher_no' => $voucherNo+$i]
                    )->execute();
                
                    for($k=0; $k<$countMonth; $k++){
                            if($k == 0){
                                $totalAmount = $total_amount[$i];
                            } else {
                                $amount = ($admission_fee[$i] + $absent_fine[$i] + $activity_fee[$i] + $stationary_expense[$i] + $board_uni_fee[$i] + $exam_fee[$i] + $arrears[$i]);
                                $totalAmount = ($total_amount[$i] - $amount);
                            }

                            $newVoucher = $voucherNo+$i;
                            $headID = Yii::$app->db->createCommand("SELECT month_detail_id FROM fee_month_detail WHERE voucher_no = '$newVoucher' AND month = '$months[$k]'")->queryAll();

                            $headId = $headID[0]['month_detail_id'];

                            $feeMonth = Yii::$app->db->createCommand()->update('fee_month_detail',[
                                'month' => $months[$k],
                                'monthly_amount'=>  $totalAmount],
                                ['month_detail_id' => $headId]
                            )->execute();

                            $id = $headId;
                            $detailID = Yii::$app->db->createCommand("SELECT fee_trans_detail_id, fee_type_id FROM fee_transaction_detail WHERE fee_trans_detail_head_id = '$id'")->queryAll();
                            $updateCount = count($detailID);
                            // adjust feeType Array with index....
                            for ($x=0; $x < $updateCount ; $x++) {     
                                $updatedFeeTypeId = $detailID[$x]['fee_type_id'];
                                $updatedArray[$x] = $updatedFeeTypeId;
                            }
                            for ($y=$updateCount; $y < 8 ; $y++) { 
                                $updatedArray[$y] = 0;
                            }
                            for ($x=0; $x < $updateCount ; $x++) {     
                                $updatedTransId = $detailID[$x]['fee_trans_detail_id'];
                                $transArray[$x] = $updatedTransId;
                            }
                            for ($y=$updateCount; $y < 8 ; $y++) { 
                                $transArray[$y] = 0;
                            }
                            $updateArray    = Array(0,0,0,0,0,0,0,0);
                            $detailId    = Array(0,0,0,0,0,0,0,0);
                            for ($z=0; $z<8; $z++) {  
                                //use length here
                                if ($updatedArray[$z] == $feeType[$z] ) {
                                    $updateArray[$z] = $feeType[$z];
                                    $detailId[$z] = $transArray[$z];
                                    continue;
                                }
                                else {
                                    for ($a=0; $a<8; $a++) {
                                        if($updatedArray[$z] == $feeType[$a]) {
                                            $updateArray[$a] = $feeType[$a];
                                            $detailId[$a] = $transArray[$z];
                                            break;
                                        }
                                    } 
                                }
                            }

                            for($m=0; $m < 8; $m++){
                                //admission_fee ..... 
                                if($feeType[$m] == 1 && $k == 0){
                                    if($updateArray[$m] == $feeType[$m] && $admission_fee[$i] >= 0){
                                        $feeDetails = Yii::$app->db->createCommand()->update('fee_transaction_detail',[
                                        'fee_trans_detail_head_id' => $id,
                                        'fee_type_id'=> 1,
                                        'fee_amount'=> $admission_fee[$i]],
                                        ['fee_trans_detail_id' => $detailId[$m]] 
                                        )->execute();
                                    }
                                    else {
                                        if ($admission_fee[$i] > 0){
                                            $feeDetails = Yii::$app->db->createCommand()->insert('fee_transaction_detail',[
                                            'fee_trans_detail_head_id' => $id,
                                            'fee_type_id'=> 1,
                                            'fee_amount'=> $admission_fee[$i], 
                                            ])->execute();
                                        }
                                    }
                                }
                                // tuition_fee ....
                                if($feeType[$m] == 2 && $k == 0){
                                    if( $updateArray[$m] == $feeType[$m] && $tuition_fee[$i] >= 0){
                                        $feeDetails = Yii::$app->db->createCommand()->update('fee_transaction_detail',[
                                        'fee_trans_detail_head_id' => $id,
                                        'fee_type_id'=> 2,
                                        'fee_amount'=> $tuition_fee[$i]],
                                        ['fee_trans_detail_id' => $detailId[$m]] 
                                        )->execute();
                                    }
                                    else {
                                        if($tuition_fee[$i] > 0){
                                            $feeDetails = Yii::$app->db->createCommand()->insert('fee_transaction_detail',[
                                            'fee_trans_detail_head_id' => $id,
                                            'fee_type_id'=> 2,
                                            'fee_amount'=> $tuition_fee[$i], 
                                            ])->execute();
                                        }
                                    }
                                }
                                // late fee fine ....
                                if($feeType[$m] == 3 && $k == 0){ 
                                    if($updateArray[$m] == $feeType[$m] && $absent_fine[$i] >= 0){
                                        $feeDetails = Yii::$app->db->createCommand()->update('fee_transaction_detail',[
                                        'fee_trans_detail_head_id' => $id,
                                        'fee_type_id'=> 3,
                                        'fee_amount'=> $absent_fine[$i]],
                                        ['fee_trans_detail_id' => $detailId[$m]] 
                                        )->execute();
                                    }       
                                    else {
                                        if($absent_fine[$i] > 0){
                                            $feeDetails = Yii::$app->db->createCommand()->insert('fee_transaction_detail',[
                                            'fee_trans_detail_head_id' => $id,
                                            'fee_type_id'=> 3,
                                            'fee_amount'=> $absent_fine[$i],
                                            ])->execute();
                                        }
                                    }
                                }
                                // activity_fee ....
                                if($feeType[$m] == 4 && $k == 0){
                                    if( $updateArray[$m] == $feeType[$m] && $activity_fee[$i] >= 0){
                                        $feeDetails = Yii::$app->db->createCommand()->update('fee_transaction_detail',[
                                        'fee_trans_detail_head_id' => $id,
                                        'fee_type_id'=> 4,
                                        'fee_amount'=> $activity_fee[$i]],
                                        ['fee_trans_detail_id' => $detailId[$m]] 
                                        )->execute();
                                    }      
                                    else {
                                        if($activity_fee[$i] > 0){
                                            $feeDetails = Yii::$app->db->createCommand()->insert('fee_transaction_detail',[
                                            'fee_trans_detail_head_id' => $id,
                                            'fee_type_id'=> 4,
                                            'fee_amount'=> $activity_fee[$i], 
                                            ])->execute();
                                        }
                                    }
                                }
                                // stationary_expense ....
                                if($feeType[$m] == 5 && $k == 0){
                                    if($updateArray[$m] == $feeType[$m] && $stationary_expense[$i] >= 0){
                                        $feeDetails = Yii::$app->db->createCommand()->update('fee_transaction_detail',[
                                        'fee_trans_detail_head_id' => $id,
                                        'fee_type_id'=> 5,
                                        'fee_amount'=> $stationary_expense[$i]],
                                        ['fee_trans_detail_id' => $detailId[$m]] 
                                        )->execute();
                                    }
                                    else {
                                        if($stationary_expense[$i] > 0){
                                            $feeDetails = Yii::$app->db->createCommand()->insert('fee_transaction_detail',[
                                            'fee_trans_detail_head_id' => $id,
                                            'fee_type_id'=> 5,
                                            'fee_amount'=> $stationary_expense[$i],
                                            ])->execute();
                                        }
                                    }
                                }
                                // board_uni_fee ....
                                if($feeType[$m] == 6 && $k == 0){
                                    if($updateArray[$m] == $feeType[$m] && $board_uni_fee[$i] >= 0){
                                        $feeDetails = Yii::$app->db->createCommand()->update('fee_transaction_detail',[
                                        'fee_trans_detail_head_id' => $id,
                                        'fee_type_id'=> 6,
                                        'fee_amount'=> $board_uni_fee[$i]],
                                        ['fee_trans_detail_id' => $detailId[$m]] 
                                        )->execute();
                                    }      
                                    else {
                                        if($board_uni_fee[$i] > 0){
                                            $feeDetails = Yii::$app->db->createCommand()->insert('fee_transaction_detail',[
                                            'fee_trans_detail_head_id' => $id, 
                                            'fee_type_id'=> 6,
                                            'fee_amount'=> $board_uni_fee[$i], 
                                            ])->execute();
                                        }
                                    }   
                                }
                                // exam_fee ....
                                if($feeType[$m] == 7 && $k == 0){
                                    if($updateArray[$m] == $feeType[$m] && $exam_fee[$i] >= 0){
                                        $feeDetails = Yii::$app->db->createCommand()->update('fee_transaction_detail',[
                                        'fee_trans_detail_head_id' => $id,
                                        'fee_type_id'=> 7,
                                        'fee_amount'=> $exam_fee[$i]],
                                        ['fee_trans_detail_id' => $detailId[$m]] 
                                        )->execute();
                                    }      
                                    else {
                                        if($exam_fee[$i] > 0){
                                            $feeDetails = Yii::$app->db->createCommand()->insert('fee_transaction_detail',[
                                            'fee_trans_detail_head_id' => $id, 
                                            'fee_type_id'=> 7,
                                            'fee_amount'=> $exam_fee[$i], 
                                            ])->execute();
                                        }
                                    }   
                                } 
                                // arrears ....
                                if($feeType[$m] == 8 && $k == 0){
                                    if($updateArray[$m] == $feeType[$m] && $arrears[$i] >= 0){
                                        $feeDetails = Yii::$app->db->createCommand()->update('fee_transaction_detail',[
                                        'fee_trans_detail_head_id' => $id,
                                        'fee_type_id'=> 8,
                                        'fee_amount'=> $arrears[$i]],
                                        ['fee_trans_detail_id' => $detailId[$m]] 
                                        )->execute();
                                    }      
                                    else {
                                        if($arrears[$i] > 0){
                                            $feeDetails = Yii::$app->db->createCommand()->insert('fee_transaction_detail',[
                                            'fee_trans_detail_head_id' => $id, 
                                            'fee_type_id'=> 8,
                                            'fee_amount'=> $arrears[$i], 
                                            ])->execute();
                                        }
                                    }   
                                }              
                            //end of  m for loop
                            }

                    //end of k loop    
                    }
                // end of i for loop    
                }
                     
                //return $this->render('./fee-transaction-detail-class-account');  
            // end of else 
            Yii::$app->session->setFlash('warning', "You have successfully update this class account...!");
            }
            $transaction->commit();
             
            //return $this->redirect(['./class-account']);
        } catch (Exception $e) {
            //$transaction->rollBack();
            Yii::$app->session->setFlash('error', "Transaction Failed, Tray Again...!");
            echo $e."<br>"; 
        }
    //end of isset
    }
?>

<?php
$url = \yii\helpers\Url::to("fee-transaction-detail/fetch-students");

$script = <<< JS
$('#sessionId').on('change',function(){
   var session_Id = $('#sessionId').val();
  
   $.ajax({
        type:'post',
        data:{session_Id:session_Id},
        url: "$url",

        success: function(result){
            console.log(result);
            var jsonResult = JSON.parse(result.substring(result.indexOf('['), result.indexOf(']')+1));
            var options = '';
            $('#section').empty();
            $('#section').append("<option>"+"Select Section"+"</option>");
            for(var i=0; i<jsonResult.length; i++) { 
                options += '<option value="'+jsonResult[i].section_id+'">'+jsonResult[i].section_name+'</option>';
            }
            // Append to the html
            $('#section').append(options);
        }         
    });       
});
JS;
$this->registerJs($script);
?>
</script>
