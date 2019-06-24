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
</head>
<body>
<div class="container-fluid" style="margin-top: -30px;">
    <h1 class="well well-sm bg-navy" align="center" style="color:#001F3F;">Manage Student Fee Account</h1>
    <!-- action="index.php?r=fee-transaction-detail/class-account-info" -->
    <form method="POST">
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
                    <label>Select Student</label>
                    <select class="form-control" name="studentid" id="std">
                            <option value="">Select Student</option>
                    </select>      
                </div>    
            </div>    
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
                            'maximumSelectionLength'=> 6,
                        ],
                    ]);
                ?>
            </div>
        </div>
        <div class="row">              
            <div class="col-md-2">
                <div class="form-group" style="margin-top: 24px;">
                    <button type="submit" name="submit" class="btn btn-success btn-flat btn-block"><i class="fa fa-check-square-o" aria-hidden="true"></i><b> Get Details</b></button>
                </div>    
            </div>
        </div>
    </form>
    <!-- Header Form Close--> 
</body> 
</html>

<?php 
if(isset($_POST['submit'])) { 
    $classid   = $_POST["classid"];
    $studentid = $_POST["studentid"];
    $months    = $_POST["month"];
    $countMonth = count($months);
    $month     = $months[0];

    $classDetail = Yii::$app->db->createCommand("SELECT class_name_id,session_id,section_id FROM std_enrollment_head WHERE std_enroll_head_id = '$classid'")->queryAll();
    $classID = $classDetail[0]['class_name_id'];
    $sessionid = $classDetail[0]['session_id'];
    $sectionid = $classDetail[0]['section_id'];

    echo $classID." ".$sessionid." ".$sectionid; 

    if($countMonth >1){
        $studentAccount = Yii::$app->db->createCommand("SELECT fth.voucher_no FROM fee_transaction_head as fth INNER JOIN fee_month_detail as fmd ON fth.voucher_no = fmd.voucher_no WHERE fth.class_name_id = '$classID' AND fth.std_id = '$studentid' AND fmd.month = '$months[0]' OR fmd.month = '$months[1]'")->queryAll();
    } else {
        $studentAccount = Yii::$app->db->createCommand("SELECT fth.voucher_no FROM fee_transaction_head as fth INNER JOIN fee_month_detail as fmd ON fth.voucher_no = fmd.voucher_no WHERE fth.class_name_id = '$classID' AND fth.std_id = '$studentid' AND fmd.month = '$months[0]'")->queryAll();
    }
    if(!empty($studentAccount)){
            Yii::$app->session->setFlash('warning', "try again...!");
    } else {
        // previousMonth
        $previousMonth = date('Y-m', strtotime('-1 months', strtotime($month)));
        
        // Select CLass...
        $class = Yii::$app->db->createCommand("SELECT std_enroll_head_name FROM std_enrollment_head WHERE std_enroll_head_id = '$classid'")->queryAll();
        
        // Select Student Name
        $studentName = Yii::$app->db->createCommand("SELECT std_name FROM std_personal_info WHERE std_id = '$studentid'")->queryAll();
        // Select Student RollNo
        $stdRollNo = Yii::$app->db->createCommand("SELECT std_roll_no FROM std_enrollment_detail WHERE std_enroll_detail_std_id = '$studentid'")->queryAll();
    ?>
<h1 class="well well-sm bg-navy" align="center" style="color: #3C8DBC; margin-top: -10px">Class Fee Account Information</h1>

<style>
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
      -webkit-appearance: none; 
      margin: 0; 
    }
</style>
    <form method="POST">
        <div class="row">
            <div class="col-md-12 text-center" style="margin-top: -20px;">
                <?php echo "<h3> Class: ".$class[0]['std_enroll_head_name']." - Month: ";
                if($countMonth >1){
                    echo date('F', strtotime($months[0])).'/'.date('F-Y', strtotime($months[1]))."</h3>";
                } else {
                    echo date('F-Y', strtotime($months[0]))."</h3>"; 
                } 
                ?>
                <ol class="breadcrumb" style="float: right; margin-top: -40px;">
                    <li><a href="./home" style="color: #3C8DBC;"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="./class-account" style="color: #3C8DBC;">Back</a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3 class="well well-sm">
                    <?php echo $stdRollNo[0]['std_roll_no']." - ".$studentName[0]['std_name']; ?>
                    </span>
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <input type="hidden" name="_csrf" class="form-control" value="<?=Yii::$app->request->getCsrfToken()?>">          
                </div>    
            </div>    
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-responsive table-condensed" border="1" style="text-align: center; font-family: serif;">
                    <tr class="bg-navy">
                        <th style="text-align: center">Admission Fee</th>
                        <th style="text-align: center">Tuition Fee</th>
                        <th style="text-align: center">Absent Fine</th>
                        <th style="text-align: center">Activity Fee</th>
                        <th style="text-align: center">Examination Fee</th>
                        <th style="text-align: center">Board/University Fee</th>
                        <th style="text-align: center">Book/Stationery Dues</th>
                        <th style="text-align: center">Arrears</th>
                        <th style="text-align: center">Total Amount</th>
                    </tr>
                    <?php 
                        // getting student fee...
                        $feeDetails = Yii::$app->db->createCommand("SELECT net_addmission_fee, tuition_fee, fee_id FROM std_fee_details WHERE std_id = '$studentid'")->queryAll();
                        // getting student arrears
                        $arrears = Yii::$app->db->createCommand("SELECT total_amount, paid_amount, remaining FROM fee_transaction_head WHERE status = 'Unpaid' AND std_id = '$studentid' OR status = 'Partially Paid' AND std_id = '$studentid'")->queryAll();
                        $totalArrears = $paidAmount = 0;
                        if(!empty($arrears)){
                            $arrearsCount = count($arrears);
                            for ($i=0; $i < $arrearsCount ; $i++) { 
                                $totalArrears += $arrears[$i]['total_amount'];
                                $paidAmount += $arrears[$i]['paid_amount'];  
                            }
                            if($totalArrears == $paidAmount){
                                $remainingArrears = 0;
                            }else if ($totalArrears != $paidAmount) {
                                $remainingArrears = $totalArrears - $paidAmount;
                            } else {
                                $remainingArrears = 0;
                            }
                        }else{
                            $remainingArrears = 0;
                        }
                        $feeId = Yii::$app->db->createCommand("SELECT std_id FROM fee_transaction_head WHERE std_id = '$studentid'")->queryAll();
                        if(empty($feeId)){
                            $admissionFee = $feeDetails[0]['net_addmission_fee'];
                        } else {
                            $admissionFee = 0;
                        }
                        $tuitionFee = $feeDetails[0]['tuition_fee'];
                        $netTotal = $admissionFee + $tuitionFee + $remainingArrears;
                        $feeType     = Array('1','2','3','4','5','6','7','8');
                        //     if (!empty($classAccount)) {
                        //         $voucherNo = $classAccount[$id]['voucher_no'];
                        //         $detailId = Yii::$app->db->createCommand("SELECT month_detail_id FROM fee_month_detail WHERE voucher_no = '$voucherNo'")->queryAll(); 
                        //         $detailHeadId = $detailId[0]['month_detail_id'];

                        //         $classAccountDetail = Yii::$app->db->createCommand("SELECT fee_type_id, fee_amount FROM fee_transaction_detail WHERE fee_trans_detail_head_id = '$detailHeadId'")->queryAll(); 
                                
                        //         $updateCount = count($classAccountDetail);
                        //         // adjust feeType Array with index....
                        //         for ($x=0; $x < $updateCount ; $x++) {     
                        //             $updatedFeeTypeId = $classAccountDetail[$x]['fee_type_id'];
                        //             $updatedArray[$x] = $updatedFeeTypeId;
                        //         }
                        //         for ($y=$updateCount; $y < 8 ; $y++) { 
                        //             $updatedArray[$y] = 0;
                        //         }
                        //         for ($x=0; $x < $updateCount ; $x++) {     
                        //             $updatedTransId = $classAccountDetail[$x]['fee_amount'];
                        //             $transArray[$x] = $updatedTransId;
                        //         }
                        //         for ($y=$updateCount; $y < 8 ; $y++) { 
                        //             $transArray[$y] = 0;
                        //         }
                        //         $updateArray    = Array(0,0,0,0,0,0,0,0);
                        //         $feeAmount    = Array(0,0,0,0,0,0,0,0);
                        //         for ($z=0; $z<8; $z++) {  
                        //             //use length here
                        //             if ($updatedArray[$z] == $feeType[$z] ) {
                        //                 $updateArray[$z] = $feeType[$z];
                        //                 $feeAmount[$z] = $transArray[$z];
                        //                 continue;
                        //             }
                        //             else {
                        //                 for ($a=0; $a<8; $a++) {
                        //                     if($updatedArray[$z] == $feeType[$a]) {
                        //                         $updateArray[$a] = $feeType[$a];
                        //                         $feeAmount[$a] = $transArray[$z];
                        //                         break;
                        //                     }
                        //                 } 
                        //             }
                        //         }
                        //     }
                        //     // ending of classAccount if.....
                    ?>
                    <tr>
                        <?php 
                        for($m=0; $m < 8; $m++){
                            if($feeType[$m] == 1){
                            if(!empty($classAccountDetail)){ ?>
                                <td align="center">
                                    <input class="form-control text-center" type="number" name="admission_fee" value="<?php echo $feeAmount[$m]; ?>" readonly="" id="admissionFee" style="width: 70px; border: none;">
                                </td> 
                            <?php } else { ?>
                                <td align="center">
                                    <input class="form-control text-center" type="number" name="admission_fee" value="<?php echo $admissionFee; ?>" readonly="" id="admissionFee" style="width: 70px; border: none;">
                                </td>  
                            <?php } // ending of else... 
                                } // ending of if...
                            if($feeType[$m] == 2){
                                if(!empty($classAccountDetail)){ ?>
                                    <td align="center">
                                        <input class="form-control text-center" type="number" name="tuition_fee" value="<?php echo $feeAmount[$m]; ?>" readonly="" id="tuitionFee" style="width: 70px; border: none;">
                                    </td>
                            <?php } else { ?>
                                    <td align="center">
                                        <input class="form-control text-center" type="number" name="tuition_fee" value="<?php echo $tuitionFee; ?>" readonly="" id="tuitionFee" style="width: 70px; border: none;">
                                    </td>
                            <?php } // ending of else... 
                                } // ending of if...
                            if($feeType[$m] == 3){
                                if(!empty($classAccountDetail)){ ?>
                                    <td>
                                        <input class="form-control text-center" type="number" id="absentFine" value="<?php echo $feeAmount[$m]; ?>" name="absent_fine"  onChange="absentFine()" style="width: 70px; border: none;">
                                    </td>
                            <?php } else { ?>
                                    <td>
                                        <input class="form-control text-center" type="number" id="absentFine" value="0" name="absent_fine"  onChange="absentFine()" style="width: 70px; border: none;">
                                    </td>
                            <?php } // ending of else... 
                                } // ending of if...
                            if($feeType[$m] == 4){
                                if(!empty($classAccountDetail)){ ?>
                                   <td>
                                        <input class="form-control text-center" type="number" id="activityFee" value="<?php echo $feeAmount[$m]; ?>" name="activity_fee"  onChange="activityFee()"  style="width: 70px; border: none;">
                                    </td> 
                            <?php } else { ?>
                                   <td>
                                        <input class="form-control text-center" type="number" id="activityFee" value="0" name="activity_fee"  onChange="activityFee()"  style="width: 70px; border: none;">
                                    </td> 
                            <?php } // ending of else... 
                                } // ending of if...
                            if($feeType[$m] == 5){
                                if(!empty($classAccountDetail)){ ?>
                                   <td>
                                        <input class="form-control text-center" type="number" id="stationaryExpense" value="<?php echo $feeAmount[$m]; ?>" name="stationary_expense"  onChange="stationaryExpense()" style="width: 100px; border: none;">
                                    </td> 
                            <?php } else { ?>
                                   <td>
                                        <input class="form-control text-center" type="number" id="stationaryExpense" value="0" name="stationary_expense"  onChange="stationaryExpense()" style="width: 100px; border: none;">
                                    </td>
                            <?php } // ending of else... 
                                } // ending of if...
                            if($feeType[$m] == 6){
                                if(!empty($classAccountDetail)){ ?>
                                   <td>
                                        <input class="form-control text-center" type="number" id="boardUniFee" value="<?php echo $feeAmount[$m]; ?>" name="board_uni_fee"  onChange="boardUniFee()" style="width: 130px; border: none;">
                                    </td> 
                            <?php } else { ?>
                                   <td>
                                        <input class="form-control text-center" type="number" id="boardUniFee" value="0" name="board_uni_fee"  onChange="boardUniFee()" style="width: 130px; border: none;">
                                    </td>
                            <?php } // ending of else... 
                                } // ending of if...
                            if($feeType[$m] == 7){
                                if(!empty($classAccountDetail)){ ?>
                                   <td>
                                        <input class="form-control text-center" type="number" id="examFee" value="<?php echo $feeAmount[$m]; ?>" name="exam_fee"  onChange="examinationFee()" style="width: 130px; border: none;">
                                    </td> 
                            <?php } else { ?>
                                   <td>
                                        <input class="form-control text-center" type="number" id="examFee" value="0" name="exam_fee"  onChange="examinationFee()" style="width: 130px; border: none;">
                                    </td>
                            <?php } // ending of else... 
                                } // ending of if...
                            if($feeType[$m] == 8){
                                if(!empty($classAccountDetail)){ ?>
                                   <td>
                                        <input class="form-control text-center" type="number" id="arrears" value="<?php echo $feeAmount[$m]; ?>" name="arrears" readonly="" style="width: 70px; border: none;">
                                    </td> 
                            <?php } else { ?>
                                   <td>
                                        <input class="form-control text-center" type="number" id="arrears" name="arrears" value="<?php echo $remainingArrears; ?>" readonly="" style="width: 70px; border: none;">
                                    </td>
                            <?php } // ending of else... 
                                } // ending of if...
                            ?>
                    <?php } 
                        // ending of m loop...
                                if(!empty($classAccountDetail)){ ?>
                                   <td>
                                        <input class="form-control text-center" type="number" id="totalAmount" readonly="" name="total_amount" value="<?php echo $classAccount[$id]['monthly_amount'] ; ?>"  style="width: 80px; border: none;">
                                    </td> 
                            <?php } else { ?>
                                    <td>
                                        <input class="form-control text-center" type="number" id="totalAmount" readonly="" name="total_amount" value="<?php echo $netTotal ; ?>"  style="width: 80px; border: none;">
                                    </td>
                            <?php } ?>
                    </tr>
                <?php //} ?>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php 
                        foreach ($months as $value) {
                            echo '<input type="hidden" name="month[]" value="'.$value.'">';
                        }
                    ?>
                    <input type="hidden" name="studentId" value="<?php echo $studentid; ?>">
                    <input type="hidden" name="studentName" value="<?php echo $studentName[0]['std_name']; ?>">
                    <input type="hidden" name="classid" value="<?php echo $classID; ?>">
                    <input type="hidden" name="sessionid" value="<?php echo $sessionid; ?>">
                    <input type="hidden" name="sectionid" value="<?php echo $sectionid; ?>">
                    <button type="submit" name="save" class="btn btn-success btn-flat"><i class="fa fa fa-sign-in" aria-hidden="true"></i><b> Submit</b></button>
                </div>    
            </div>
        </div>
    </form>
    <!-- Fee Transaction Form Close -->
<?php
        // end of else 
        }
    // end of isset    
    }
?>


<?php  
    if (isset($_POST["save"])) {
        $classid            = $_POST["classid"];
        $sessionid          = $_POST["sessionid"];
        $sectionid          = $_POST["sectionid"];
        $months            = $_POST["month"];
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
                $statusUpdate = Yii::$app->db->createCommand("UPDATE fee_transaction_head SET status = 'Added to next month' WHERE std_id = '$studentId' AND status = 'Unpaid' OR status = 'Partially Paid'")->execute();
                $voucher = FeeTransactionHead::find()->orderBy(['voucher_no'=> SORT_DESC])->one();
                if($voucher == NULL){
                    $voucherNo = '1001';
                } else {
                    $voucherNo = $voucher['voucher_no']+1;
                }
                $amounts =0; 
                for($z=0; $z<$countMonth; $z++){
                    if($z == 0){
                        $totalAmount = $total_amount;
                        $amounts += $totalAmount;
                    } else {
                        $amount = ($admission_fee + $absent_fine + $activity_fee + $stationary_expense + $board_uni_fee + $exam_fee + $arrears);
                        $total = ($total_amount - $amount);
                        $amounts += $total;
                    }  
                }
                $feeHead = Yii::$app->db->createCommand()->insert('fee_transaction_head',[
                    'class_name_id' => $classid,
                    'voucher_no' => $voucherNo,
                    'branch_id' => Yii::$app->user->identity->branch_id,
                    'session_id'=> $sessionid,
                    'section_id'=> $sectionid,
                    'std_id' => $studentId,
                    'std_name' => $studentName,
                    'transaction_date' =>  new \yii\db\Expression('NOW()'),
                    'total_amount'=>  $amounts, 
                    'status'=>'unpaid',
                    'created_by' => Yii::$app->user->identity->id,
                ])->execute();
                for($z=0; $z<$countMonth; $z++){
                    if($z == 0){
                        $totalAmount = $total_amount;
                    } else {
                        $amount = ($admission_fee + $absent_fine + $activity_fee + $stationary_expense + $board_uni_fee + $exam_fee + $arrears);
                        $totalAmount = ($total_amount - $amount);
                    }
                    $feeMonth = Yii::$app->db->createCommand()->insert('fee_month_detail',[
                    'voucher_no' => $voucherNo,
                    'month' => $months[$z],
                    'monthly_amount'=>  $totalAmount, 
                    ])->execute();

                $headID = Yii::$app->db->createCommand("SELECT month_detail_id FROM fee_month_detail WHERE voucher_no = '$voucherNo' AND month = '$months[$z]'")->queryAll();

                $headId = $headID[0]['month_detail_id'];
                for($j=0;$j<8;$j++){
                    if($feeType[$j] == 1 && $admission_fee > 0 && $z == 0){
                        $feeDetails = Yii::$app->db->createCommand()->insert('fee_transaction_detail',[
                        'fee_trans_detail_head_id' => $headId,
                        'fee_type_id'=> $feeType[$j],
                        'fee_amount'=> $admission_fee
                        ])->execute();
                    }
                    if($feeType[$j] == 2 && $tuition_fee > 0){
                        $feeDetails = Yii::$app->db->createCommand()->insert('fee_transaction_detail',[
                        'fee_trans_detail_head_id' => $headId,
                        'fee_type_id'=> $feeType[$j],
                        'fee_amount'=> $tuition_fee, 
                        ])->execute();
                    }
                    if($feeType[$j] == 3 && $absent_fine > 0 && $z == 0){
                        $feeDetails = Yii::$app->db->createCommand()->insert('fee_transaction_detail',[
                        'fee_trans_detail_head_id' => $headId,
                        'fee_type_id'=> $feeType[$j],
                        'fee_amount'=> $absent_fine,
                        ])->execute();
                    }
                    if($feeType[$j] == 4 && $activity_fee > 0 && $z == 0){
                        $feeDetails = Yii::$app->db->createCommand()->insert('fee_transaction_detail',[
                        'fee_trans_detail_head_id' => $headId,
                        'fee_type_id'=> $feeType[$j],
                        'fee_amount'=> $activity_fee, 
                        ])->execute();
                    }
                    if($feeType[$j] == 5 && $stationary_expense > 0 && $z == 0){
                        $feeDetails = Yii::$app->db->createCommand()->insert('fee_transaction_detail',[
                        'fee_trans_detail_head_id' => $headId,
                        'fee_type_id'=> $feeType[$j],
                        'fee_amount'=> $stationary_expense,
                        ])->execute();
                    }
                    if($feeType[$j] == 6 && $board_uni_fee > 0 && $z == 0){
                        $feeDetails = Yii::$app->db->createCommand()->insert('fee_transaction_detail',[
                        'fee_trans_detail_head_id' => $headId, 
                        'fee_type_id'=> $feeType[$j],
                        'fee_amount'=> $board_uni_fee, 
                        ])->execute();
                    }
                    if($feeType[$j] == 7 && $exam_fee > 0 && $z == 0){
                        $feeDetails = Yii::$app->db->createCommand()->insert('fee_transaction_detail',[
                        'fee_trans_detail_head_id' => $headId, 
                        'fee_type_id'=> $feeType[$j],
                        'fee_amount'=> $exam_fee, 
                        ])->execute();
                    }
                    if($feeType[$j] == 8 && $arrears > 0 && $z == 0){
                        $feeDetails = Yii::$app->db->createCommand()->insert('fee_transaction_detail',[
                        'fee_trans_detail_head_id' => $headId, 
                        'fee_type_id'=> $feeType[$j],
                        'fee_amount'=> $arrears, 
                        ])->execute();
                    }
                }
                //end of j for loop
            }
            //end of z for loop  
                // success alert message...
                Yii::$app->session->setFlash('success', "You have successfully maintained this class account...!"); 
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