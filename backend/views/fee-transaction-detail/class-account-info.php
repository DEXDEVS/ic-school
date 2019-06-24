<h1 class="well well-sm bg-navy" align="center" style="color: #3C8DBC; margin-top: -10px">Class Fee Account Information</h1>

<style>
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
      -webkit-appearance: none; 
      margin: 0; 
    }
</style>
<?php 
    if(isset($_POST['submit'])) { 
        $classid   = $_POST["classid"];
        $sessionid = $_POST["sessionid"];
        $sectionid = $_POST["sectionid"];
        $months    = $_POST["month"];
        $countMonth = count($months);
        $month     = $months[0];
        //$month1     = $months[1];     
        // previousMonth
        $previousMonth = date('Y-m', strtotime('-1 months', strtotime($month)));
        //$installment_no = $_POST["installment_no"];
        //$date           = $_POST["date"];
        // Select CLass...
        $class = Yii::$app->db->createCommand("SELECT class_name FROM std_class_name WHERE class_name_id = '$classid'")->queryAll();
        $className = $class[0]['class_name'];
        // Select Session... 
        $sessionName = Yii::$app->db->createCommand("SELECT session_name FROM std_sessions WHERE session_id = '$sessionid'")->queryAll();
        // Select Section...
        $sectionName = Yii::$app->db->createCommand("SELECT section_name FROM std_sections WHERE section_id = '$sectionid'")->queryAll();

        // Select Students...
        $student = Yii::$app->db->createCommand("SELECT sed.std_enroll_detail_id ,sed.std_enroll_detail_std_id FROM std_enrollment_detail as sed INNER JOIN std_enrollment_head as seh ON seh.std_enroll_head_id = sed.std_enroll_detail_head_id WHERE seh.class_name_id = '$classid' AND seh.session_id = '$sessionid' AND seh.section_id = '$sectionid'")->queryAll();

       
        $classAccount = Yii::$app->db->createCommand("SELECT fth.voucher_no ,fmd.monthly_amount FROM fee_transaction_head as fth INNER JOIN fee_month_detail as fmd ON fth.voucher_no = fmd.voucher_no WHERE fth.class_name_id = '$classid' AND fth.session_id = '$sessionid' AND fth.section_id = '$sectionid' AND fmd.month = '$month'")->queryAll();
       
    ?>

    <form method="POST" action="class-account">
        <div class="row">
            <div class="col-md-12 text-center" style="margin-top: -20px;">
                <?php echo "<h3> Class: ".$className." - Month: ";
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
                        <th style="text-align: center">Sr #</th>
                        <th style="text-align: center">Roll #</th>
                        <th style="text-align: center">Student Name</th>
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
                        $length = count($student);
                        foreach ($student as $id =>$value) {
                            $stdId = $student[$id]['std_enroll_detail_std_id'];
                            $studentId[$id] = $stdId;
                            $stdName = Yii::$app->db->createCommand("SELECT std_reg_no,std_name FROM std_personal_info  WHERE std_id = '$stdId'")->queryAll();
                            $studentName[$id] = $stdName[0]['std_name'];
                            // getting student roll no...
                            $stdRollNo = Yii::$app->db->createCommand("SELECT std_roll_no FROM  std_enrollment_detail WHERE std_enroll_detail_std_id = '$stdId'")->queryAll(); 
                            // getting student fee...
                            $feeDetails = Yii::$app->db->createCommand("SELECT net_addmission_fee, tuition_fee, fee_id FROM std_fee_details WHERE std_id = '$value[std_enroll_detail_std_id]'")->queryAll();
                            $feeTransaction = Yii::$app->db->createCommand("SELECT std_id FROM fee_transaction_head WHERE std_id = '$value[std_enroll_detail_std_id]'")->queryAll();
                            $arrears = Yii::$app->db->createCommand("SELECT total_amount, paid_amount, remaining FROM fee_transaction_head WHERE status = 'Unpaid' AND std_id = '$stdId' OR status = 'Partially Paid' AND std_id = '$stdId'")->queryAll();
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
                            $feeId = Yii::$app->db->createCommand("SELECT std_id FROM fee_transaction_head WHERE std_id = '$value[std_enroll_detail_std_id]'")->queryAll();
                            if(empty($feeId)){
                                $admissionFee = $feeDetails[0]['net_addmission_fee'];
                            } else {
                                $admissionFee = 0;
                            }
                            $tuitionFee = $feeDetails[0]['tuition_fee'];
                            $netTotal = $admissionFee + $tuitionFee + $remainingArrears;
                            $feeType     = Array('1','2','3','4','5','6','7','8');
                            if (!empty($classAccount)) {
                                $voucherNo = $classAccount[$id]['voucher_no'];
                                $detailId = Yii::$app->db->createCommand("SELECT month_detail_id FROM fee_month_detail WHERE voucher_no = '$voucherNo'")->queryAll(); 
                                $detailHeadId = $detailId[0]['month_detail_id'];

                                $classAccountDetail = Yii::$app->db->createCommand("SELECT fee_type_id, fee_amount FROM fee_transaction_detail WHERE fee_trans_detail_head_id = '$detailHeadId'")->queryAll(); 
                                
                                $updateCount = count($classAccountDetail);
                                // adjust feeType Array with index....
                                for ($x=0; $x < $updateCount ; $x++) {     
                                    $updatedFeeTypeId = $classAccountDetail[$x]['fee_type_id'];
                                    $updatedArray[$x] = $updatedFeeTypeId;
                                }
                                for ($y=$updateCount; $y < 8 ; $y++) { 
                                    $updatedArray[$y] = 0;
                                }
                                for ($x=0; $x < $updateCount ; $x++) {     
                                    $updatedTransId = $classAccountDetail[$x]['fee_amount'];
                                    $transArray[$x] = $updatedTransId;
                                }
                                for ($y=$updateCount; $y < 8 ; $y++) { 
                                    $transArray[$y] = 0;
                                }
                                $updateArray    = Array(0,0,0,0,0,0,0,0);
                                $feeAmount    = Array(0,0,0,0,0,0,0,0);
                                for ($z=0; $z<8; $z++) {  
                                    //use length here
                                    if ($updatedArray[$z] == $feeType[$z] ) {
                                        $updateArray[$z] = $feeType[$z];
                                        $feeAmount[$z] = $transArray[$z];
                                        continue;
                                    }
                                    else {
                                        for ($a=0; $a<8; $a++) {
                                            if($updatedArray[$z] == $feeType[$a]) {
                                                $updateArray[$a] = $feeType[$a];
                                                $feeAmount[$a] = $transArray[$z];
                                                break;
                                            }
                                        } 
                                    }
                                }
                            }
                            // ending of classAccount if.....
                    ?>
                    <tr>
                        <td>
                            <p style="margin-top: 8px"><b><?php echo $id+1; ?></b></p>
                        </td>
                        <td>
                            <p style="margin-top: 8px"><b><?php echo $stdRollNo[0]['std_roll_no'];?></b></p>
                        </td>
                        <td>
                            <p style="margin-top: 8px"><?php echo $stdName[0]['std_name'];?></p>
                        </td>
                        <?php 
                        for($m=0; $m < 8; $m++){
                            if($feeType[$m] == 1){
                            if(!empty($classAccountDetail)){ ?>
                                <td align="center">
                                    <input class="form-control text-center" type="number" name="admission_fee[]" value="<?php echo $feeAmount[$m]; ?>" readonly="" id="admissionFee_<?php echo $id; ?>" style="width: 70px; border: none;">
                                </td> 
                            <?php } else { ?>
                                <td align="center">
                                    <input class="form-control text-center" type="number" name="admission_fee[]" value="<?php echo $admissionFee; ?>" readonly="" id="admissionFee_<?php echo $id; ?>" style="width: 70px; border: none;">
                                </td>  
                            <?php } // ending of else... 
                                } // ending of if...
                            if($feeType[$m] == 2){
                                if(!empty($classAccountDetail)){ ?>
                                    <td align="center">
                                        <input class="form-control text-center" type="number" name="tuition_fee[]" value="<?php echo $feeAmount[$m]; ?>" readonly="" id="tuitionFee_<?php echo $id; ?>" style="width: 70px; border: none;">
                                    </td>
                            <?php } else { ?>
                                    <td align="center">
                                        <input class="form-control text-center" type="number" name="tuition_fee[]" value="<?php echo $tuitionFee; ?>" readonly="" id="tuitionFee_<?php echo $id; ?>" style="width: 70px; border: none;">
                                    </td>
                            <?php } // ending of else... 
                                } // ending of if...
                            if($feeType[$m] == 3){
                                if(!empty($classAccountDetail)){ ?>
                                    <td>
                                        <input class="form-control text-center" type="number" id="absentFine_<?php echo $id; ?>" value="<?php echo $feeAmount[$m]; ?>" name="absent_fine[]"  onChange="totalAmount(<?php echo $id; ?>)" style="width: 70px; border: none;">
                                    </td>
                            <?php } else { ?>
                                    <td>
                                        <input class="form-control text-center" type="number" id="absentFine_<?php echo $id; ?>" value="0" name="absent_fine[]"  onChange="totalAmount(<?php echo $id; ?>)" style="width: 70px; border: none;">
                                    </td>
                            <?php } // ending of else... 
                                } // ending of if...
                            if($feeType[$m] == 4){
                                if(!empty($classAccountDetail)){ ?>
                                   <td>
                                        <input class="form-control text-center" type="number" id="activityFee_<?php echo $id; ?>" value="<?php echo $feeAmount[$m]; ?>" name="activity_fee[]"  onChange="totalAmount(<?php echo $id; ?>)"  style="width: 70px; border: none;">
                                    </td> 
                            <?php } else { ?>
                                   <td>
                                        <input class="form-control text-center" type="number" id="activityFee_<?php echo $id; ?>" value="0" name="activity_fee[]"  onChange="totalAmount(<?php echo $id; ?>)"  style="width: 70px; border: none;">
                                    </td> 
                            <?php } // ending of else... 
                                } // ending of if...
                            if($feeType[$m] == 5){
                                if(!empty($classAccountDetail)){ ?>
                                   <td>
                                        <input class="form-control text-center" type="number" id="stationaryExpense_<?php echo $id; ?>" value="<?php echo $feeAmount[$m]; ?>" name="stationary_expense[]"  onChange="totalAmount(<?php echo $id; ?>)" style="width: 100px; border: none;">
                                    </td> 
                            <?php } else { ?>
                                   <td>
                                        <input class="form-control text-center" type="number" id="stationaryExpense_<?php echo $id; ?>" value="0" name="stationary_expense[]"  onChange="totalAmount(<?php echo $id; ?>)" style="width: 100px; border: none;">
                                    </td>
                            <?php } // ending of else... 
                                } // ending of if...
                            if($feeType[$m] == 6){
                                if(!empty($classAccountDetail)){ ?>
                                   <td>
                                        <input class="form-control text-center" type="number" id="boardUniFee_<?php echo $id; ?>" value="<?php echo $feeAmount[$m]; ?>" name="board_uni_fee[]"  onChange="totalAmount(<?php echo $id; ?>)" style="width: 130px; border: none;">
                                    </td> 
                            <?php } else { ?>
                                   <td>
                                        <input class="form-control text-center" type="number" id="boardUniFee_<?php echo $id; ?>" value="0" name="board_uni_fee[]"  onChange="totalAmount(<?php echo $id; ?>)" style="width: 130px; border: none;">
                                    </td>
                            <?php } // ending of else... 
                                } // ending of if...
                            if($feeType[$m] == 7){
                                if(!empty($classAccountDetail)){ ?>
                                   <td>
                                        <input class="form-control text-center" type="number" id="examFee_<?php echo $id; ?>" value="<?php echo $feeAmount[$m]; ?>" name="exam_fee[]"  onChange="totalAmount(<?php echo $id; ?>)" style="width: 130px; border: none;">
                                    </td> 
                            <?php } else { ?>
                                   <td>
                                        <input class="form-control text-center" type="number" id="examFee_<?php echo $id; ?>" value="0" name="exam_fee[]"  onChange="totalAmount(<?php echo $id; ?>)" style="width: 130px; border: none;">
                                    </td>
                            <?php } // ending of else... 
                                } // ending of if...
                            if($feeType[$m] == 8){
                                if(!empty($classAccountDetail)){ ?>
                                   <td>
                                        <input class="form-control text-center" type="number" id="arrears_<?php echo $id; ?>" value="<?php echo $feeAmount[$m]; ?>" name="arrears[]" readonly="" style="width: 70px; border: none;">
                                    </td> 
                            <?php } else { ?>
                                   <td>
                                        <input class="form-control text-center" type="number" id="arrears_<?php echo $id; ?>" name="arrears[]" value="<?php echo $remainingArrears; ?>" readonly="" style="width: 70px; border: none;">
                                    </td>
                            <?php } // ending of else... 
                                } // ending of if...
                            ?>
                    <?php } 
                        // ending of m loop...
                                if(!empty($classAccountDetail)){ ?>
                                   <td>
                                        <input class="form-control text-center" type="number" id="totalAmount_<?php echo $id; ?>" readonly="" name="total_amount[]" value="<?php echo $classAccount[$id]['monthly_amount'] ; ?>"  style="width: 80px; border: none;">
                                    </td> 
                            <?php } else { ?>
                                    <td>
                                        <input class="form-control text-center" type="number" id="totalAmount_<?php echo $id; ?>" readonly="" name="total_amount[]" value="<?php echo $netTotal ; ?>"  style="width: 80px; border: none;">
                                    </td>
                            <?php } ?>
                    </tr>
                <?php } ?>
                </table>
            </div>
        </div>
		<div class="row">
			<div class="col-md-4">
                <div class="form-group">
                    <?php 
                        foreach ($studentId as $value) {
                            echo '<input type="hidden" name="studentId[]" value="'.$value.'">';
                        }
                        foreach ($studentName as $value) {
                            echo '<input type="hidden" name="studentName[]" value="'.$value.'">';
                        }
                        foreach ($months as $value) {
                            echo '<input type="hidden" name="month[]" value="'.$value.'">';
                        }
                    ?>
                    <input type="hidden" name="length" value="<?php echo $length; ?>">
                    <input type="hidden" name="classid" value="<?php echo $classid; ?>">
                    <input type="hidden" name="sessionid" value="<?php echo $sessionid; ?>">
                    <input type="hidden" name="sectionid" value="<?php echo $sectionid; ?>">
                    <button type="submit" name="save" class="btn btn-success btn-flat"><i class="fa fa fa-sign-in" aria-hidden="true"></i><b> Submit</b></button>
                </div>    
            </div>
		</div>
    </form>
    <!-- Fee Transaction Form Close -->
<?php
    }
?>
</div> 

<script>
    var sum;
    function totalAmount(i){
        var absentFine = activityFee = boardUniFee = examFee = stationaryExpense = 0;
        var admissionFee = parseInt($('#admissionFee_'+i).val());
        var tuitionFee = parseInt($('#tuitionFee_'+i).val());

        if($('#absentFine_'+i).val() != '') {
            absentFine = parseInt($('#absentFine_'+i).val());
        }
        else {
            $('#absentFine_'+i).val(0);
        }

        if($('#activityFee_'+i).val() != '') {
            activityFee = parseInt($('#activityFee_'+i).val());
        }
        else {
            $('#activityFee_'+i).val(0);
        }

        if($('#boardUniFee_'+i).val() != '') {
            boardUniFee = parseInt($('#boardUniFee_'+i).val());
        }
        else {
            $('#boardUniFee_'+i).val(0);
        }

        if($('#examFee_'+i).val() != '') {
            examFee = parseInt($('#examFee_'+i).val());
        }
        else {
            $('#examFee_'+i).val(0);
        }

        if($('#stationaryExpense_'+i).val() != '') {
            stationaryExpense = parseInt($('#stationaryExpense_'+i).val());
        }
        else {
            $('#stationaryExpense_'+i).val(0);
        }
        
        var arrears = parseInt($('#arrears_'+i).val());
        sum = admissionFee + tuitionFee + absentFine + activityFee + boardUniFee + examFee + stationaryExpense + arrears;
        $('#totalAmount_'+i).val(sum);
    }
</script>