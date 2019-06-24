<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style type="text/css">
    @media print{
        .table th{
            background-color: #001F3F !important;
            color: #fff !important;
        }
        .table .tdcolor{
            color: #FFF;
            background-color: #ccc !important;
        }
        .table .a{
            background-color: gray !important;
             color: #FFF;
        }
    }
</style>
</head>
<body>
<div class="row container-fluid"> 
    <div class="container-fluid" style="margin-top: -30px;">
    <?php 
    if(isset($_POST['submit']))
    { 
        $classid    = $_POST["classid"];
        $sessionid  = $_POST["sessionid"];
        $sectionid  = $_POST["sectionid"];
        $month = $_POST["month"];
        // Select CLass...
        $class = Yii::$app->db->createCommand("SELECT class_name FROM std_class_name WHERE class_name_id = '$classid'")->queryAll();
        // Select Session... 
        $sessionName = Yii::$app->db->createCommand("SELECT session_name FROM std_sessions WHERE session_id = '$sessionid'")->queryAll();
       // Select Section...
        $sectionName = Yii::$app->db->createCommand("SELECT section_name FROM std_sections WHERE section_id = '$sectionid'")->queryAll();
        // Select Students...
        $students = Yii::$app->db->createCommand("SELECT sed.std_enroll_detail_std_id,sed.std_roll_no FROM std_enrollment_detail as sed 
            INNER JOIN std_enrollment_head as seh
            ON seh.std_enroll_head_id = sed.std_enroll_detail_head_id
            WHERE seh.class_name_id  = '$classid' AND seh.session_id = '$sessionid' AND seh.section_id = '$sectionid'")->queryAll();
        $countStudents = count($students);
    ?>
    <div class="row">
        <div class="col-md-12">
            <img src="images/abc_logo.jpg" width="90px" class="img-circle" style="float:left;margin-top: 10px;">
            <h2 align="center">ABC Learning High School<small> (Rahim Yar Khan)</small></h2>
        </div>
        <div class="col-md-12">
            <table width="100%" style="margin-top: -45px;">
                <tr>
                    <td align="center">
                        <b style="margin-left: 80px"><u>Class Fee Account Details</u></b>
                        <h3 style="margin-top: -1px; margin-left: 80px;">
                            <?php echo $class[0]['class_name']." - ".$sectionName[0]['section_name']." - Session (".$sessionName[0]['session_name'].")"; ?>
                        </h3>
                    </td>
                </tr>
            </table>
        </div>
    </div>  
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                <thead>
                    <tr class="bg-navy">
                        <th class="text-center">Sr.#</th>
                        <th>Roll No.</th>
                        <th>Student Name</th>
                        <th class="text-center">Monthly Fee</th>
                        <th class="text-center">Paid</th>
                        <th class="text-center">Remaining</th>
                        <th class="text-center">Fee Status</th>
                        <th class="text-center">Monthly Fee</th>
                        <th class="text-center">Paid</th>
                        <th class="text-center">Remaining</th>
                        <th class="text-center">Fee Status</th>
                        <th class="text-center">Student Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $totalFee = $totalPaid = $totalRemaining = $badTotalFee = $badTotalPaid = $badTotalRemaining = $totalFee1 = $totalPaid1 = $totalRemaining1 = 0;
                        foreach ($students as $id => $value) {
                        // students `id`
                        $stdID = $students[$id]['std_enroll_detail_std_id'];
                        // get students `std_name`
                        $stdName = Yii::$app->db->createCommand("SELECT std_name,academic_status FROM std_personal_info  WHERE std_id = '$stdID'")->queryAll();
                        // get student monthly fee 
                        $stdFeeDetails = Yii::$app->db->createCommand("SELECT total_amount,paid_amount,remaining,status FROM fee_transaction_head as fth INNER JOIN fee_month_detail as fmd ON fth.voucher_no = fmd.voucher_no WHERE fth.std_id = '$stdID' AND fmd.month >='2019-03' OR fmd.month <='2019-06' AND fth.std_id = '$stdID' ")->queryAll();
                        var_dump($stdFeeDetails);
                        $tuitionFee = $stdFeeDetails[0]['total_amount'];
                        $paidAmount = $stdFeeDetails[0]['paid_amount'];
                        $remaining  = $stdFeeDetails[0]['remaining'];
                        //$status     = $stdFeeDetails[0]['status'];
                    ?>
                    <tr>
                        <td><?php echo $id+1; ?></td>
                        <td><?php echo  $students[$id]['std_roll_no']; ?></td>
                        <td><?php echo $stdName[0]['std_name']; ?></td>
                        <?php for ($i=0; $i <2 ; $i++) { ?>
                            <td align="center"><?php echo $stdFeeDetails[$i]['total_amount'];  ?></td>
                            <td class="tdcolor" align="center" style="background-color: #ccc;">
                                <?php echo $stdFeeDetails[$i]['paid_amount']; ?>
                            </td>
                            <td align="center"><?php echo $stdFeeDetails[$i]['remaining'] ; ?></td>
                            <th style="background-color: #ccc;" class="tdcolor text-center">
                                <?php echo $stdFeeDetails[$i]['status'];?>
                            </th>
                         <?php } ?>
                        <td style="background-color: gray; color: #FFF;" class="a text-center">
                            <?php 
                                if ($stdName[0]['academic_status'] == 'Left') {
                                    echo $stdName[0]['academic_status'];
                                }
                                else{
                                    echo $stdName[0]['academic_status'];
                                }
                             ?>
                        </td>
                    </tr>
                    <?php 
                        $totalFee += $stdFeeDetails[0]['total_amount'];
                        $totalPaid += $stdFeeDetails[0]['paid_amount'];
                        $totalRemaining += $stdFeeDetails[0]['remaining'];

                        $totalFee1 += $stdFeeDetails[1]['total_amount'];
                        $totalPaid1 += $stdFeeDetails[1]['paid_amount'];
                        $totalRemaining1 += $stdFeeDetails[1]['remaining'];
                    //end of for each
                    }
                    ?>
                    <tr align="center" style="background-color: #ccc;">
                        <th colspan="3" align="center" class="bg-navy text-center tdcolor" >
                            <?php echo "<b>".$sectionName[0]['section_name']." Session ".$sessionName[0]['session_name']."</b>";?>
                        </th>
                        <td class="tdcolor"><b><?php echo $totalFee; ?></b></td>
                        <td class="tdcolor"><b><?php echo $totalPaid; ?></b></td>
                        <td class="tdcolor"><b><?php echo $totalRemaining; ?></b></td>
                        <td></td>
                        <td class="tdcolor"><b><?php echo $totalFee1; ?></b></td>
                        <td class="tdcolor"><b><?php echo $totalPaid1; ?></b></td>
                        <td class="tdcolor"><b><?php echo $totalRemaining1; ?></b></td>
                        <td></td>
                        <<td></td>
                    </tr>
                   
                    <tr align="center">
                        <td colspan="18" style="font-size: 20px;">
                            <b>Bad debts
                                <?php echo $sectionName[0]['section_name']." ".$sessionName[0]['session_name']?>
                            </b>
                        </td>
                    </tr>

                    <?php
                    // bad debts start....
                        foreach ($students as $id => $value) {
                        // students `id`
                        $stdID = $students[$id]['std_enroll_detail_std_id'];
                        // get students `std_name`
                        $stdName = Yii::$app->db->createCommand("SELECT std_name,academic_status FROM std_personal_info  WHERE std_id = '$stdID'")->queryAll();
                        if ($stdName[0]['academic_status'] == 'Left') { 
                        // get student fee pakg
                            $stdFeeDetails= Yii::$app->db->createCommand("SELECT total_amount,paid_amount,remaining,status FROM fee_transaction_head as fth INNER JOIN fee_month_detail as fmd ON fth.voucher_no = fmd.voucher_no WHERE fth.std_id = '$stdID' AND fmd.month ='$month'")->queryAll();
                        
                            $tuitionFee = $stdFeeDetails[0]['total_amount'];
                            $paidAmount = $stdFeeDetails[0]['paid_amount'];
                            $remaining  = $stdFeeDetails[0]['remaining'];
                            $status     = $stdFeeDetails[0]['status'];
                    ?>   
                    <tr>
                        <td><?php echo $id+1; ?></td>
                        <td><?php echo  $students[$id]['std_roll_no']; ?></td>
                        <td><?php echo $stdName[0]['std_name']; ?></td>
                        <td align="center"><?php echo $tuitionFee;  ?></td>
                        <td class="tdcolor" align="center" style="background-color: #ccc;">
                            <?php echo $paidAmount; ?>
                        </td>
                        <td align="center"><?php echo $remaining; ?></td>
                        <th style="background-color: #ccc;" class="tdcolor text-center">
                            <?php echo $status;?>
                        </th>
                        
                        <td style="width: 60px">
                            <?php 
                                if ($stdName[0]['academic_status'] == 'Left') {
                                    echo $stdName[0]['academic_status'];
                                }
                                else{
                                    echo '';
                                }
                             ?>
                        </td>
                    </tr>
                    <?php
                        $badTotalFee += $stdFeeDetails[0]['total_amount'];
                        $badTotalPaid += $stdFeeDetails[0]['paid_amount'];
                        $badTotalRemaining += $stdFeeDetails[0]['remaining']; 
                    ?>
                    <tr align="center" style="background-color: #ccc;">
                        <td colspan="3" style="text-align: center"><b>Total Left</b></td>
                        <td class="tdcolor"><b><?php echo $badTotalFee; ?></b></td>
                        <td class="tdcolor"><b><?php echo $badTotalPaid; ?></b></td>
                        <td class="tdcolor"><b><?php echo $badTotalRemaining; ?></b></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php
                    }   
                    // end of if
                    ?>
                <?php }   
                // end of foreach loop...
                ?>
                <tr>
                    <td colspan="3" align="center" style="background-color: lightgray;">
                        <b>Actual After Bad Debts</b>
                    </td>
                    <td class="tdcolor" style="background-color: #ccc;" align="center"><b>
                        <?php echo ($totalFee-$badTotalFee); ?></b></td>
                    <td class="tdcolor" style="background-color: #ccc;" align="center"><b>
                        <?php echo ($totalPaid - $badTotalPaid); ?></b></td>
                    <th style="background-color: gray; color: #FFF;" class="a text-center">
                        <?php echo ($totalRemaining - $badTotalRemaining); ?></th>
                    <td class="tdcolor" style="background-color: #ccc;" align="center"></td>
                    <td class="tdcolor" style="background-color: #ccc;" align="center"></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    
</div>
 <?php  } ?>
<!-- class fee account report end-->
</body>
</html>

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
            var jsonResult = JSON.parse(result.substring(result.indexOf('['), result.indexOf(']')+1));
            var options = '';
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