<!DOCTYPE html>
<html>
<head>
	<title>Voucher</title>
	<style type="text/css">
		/*td p{
		font-size:16px;
	}*/
	</style>
</head>
<body class="text">
<?php 

    if(isset($_POST['submit'])){ 
        $classid   = $_POST["classid"];
        $sessionid = $_POST["sessionid"];
        $sectionid = $_POST["sectionid"];
        $month     = $_POST["month"];
        $issueDate = $_POST["issue_date"];
        $dueDate   = $_POST["due_date"];
        // change the format of dates....
        $issueDate  = date('d-m-Y', strtotime($issueDate));
        $dueDate    = date('d-m-Y', strtotime($dueDate));
        $todayDate  = date('d-m-Y'); 
        
        $months = Yii::$app->db->createCommand("SELECT fmd.month FROM fee_month_detail as fmd INNER JOIN fee_transaction_head as fth ON fmd.voucher_no = fth.voucher_no WHERE fmd.month = '$month' AND fth.class_name_id = '$classid' AND fth.session_id = '$sessionid' AND fth.section_id = '$sectionid'")->queryAll();
       
	if(!empty($months)){

        $institue = Yii::$app->db->createCommand("SELECT * FROM institute WHERE institute_id = 2")->queryAll();
		$branch = Yii::$app->db->createCommand("SELECT * FROM branches WHERE branch_code = 002 ")->queryAll();
        // Select CLass...
        $className = Yii::$app->db->createCommand("SELECT class_name FROM std_class_name WHERE class_name_id = '$classid'")->queryAll();
        // Select Session... 
        $sessionName = Yii::$app->db->createCommand("SELECT session_name FROM std_sessions WHERE session_id = '$sessionid'")->queryAll();
       // Select Section...
        $sectionName = Yii::$app->db->createCommand("SELECT section_name FROM std_sections WHERE section_id = '$sectionid'")->queryAll();
        // Select Students...
        $student = Yii::$app->db->createCommand("SELECT sed.std_enroll_detail_id ,sed.std_enroll_detail_std_id,sed.std_roll_no FROM std_enrollment_detail as sed INNER JOIN std_enrollment_head as seh ON seh.std_enroll_head_id = sed.std_enroll_detail_head_id WHERE seh.class_name_id = '$classid' AND seh.session_id = '$sessionid' AND seh.section_id = '$sectionid'")->queryAll();
        foreach ($student as $id =>$value) {
			$stdInfo = Yii::$app->db->createCommand("SELECT std_name, std_father_name  FROM std_personal_info WHERE std_id = '$value[std_enroll_detail_std_id]'")->queryAll();
			$stdId = $value['std_enroll_detail_std_id'];
			$feeDetail = Yii::$app->db->createCommand("SELECT * FROM ((fee_transaction_head as fth INNER JOIN fee_month_detail as fmd ON fmd.voucher_no = fth.voucher_no) INNER JOIN fee_transaction_detail as ftd ON fmd.month_detail_id = ftd.fee_trans_detail_head_id) WHERE fth.std_id = '$stdId' AND fmd.month = '$month'")->queryAll();
			$voucherNo = $feeDetail[0]['voucher_no'];
			$voucherMonth = Yii::$app->db->createCommand("SELECT month FROM fee_month_detail WHERE voucher_no = $voucherNo")->queryAll();
			$monthCount = count($voucherMonth);
			// if(!empty($feeDetail)){
	
			// 	$installmentId = $feeDetail[0]['installment_no'];
			// 	$installment = Yii::$app->db->createCommand("SELECT installment_name FROM installment WHERE installment_id = '$installmentId'")->queryAll();
			//$feeMonth = date('F, Y', strtotime($month));
		
			$feeType = Yii::$app->db->createCommand("SELECT fee_type_id,fee_type_name  FROM fee_type")->queryAll();
    	?>

			<div class="container-fluid">
				<div class="row">
					<?php 
					$j=3;
					$copyName = Array('Student Copy','Principal Copy','Account Copy','Bank Copy');
					for ($i=0;$i<4;$i++){ ?>
						<div class="col-md-<?php echo $j; ?>" style="border-right: black dashed 2px;">
							<div class="row">
								<div class="col-md-3">
									<img src="images/abc_logo.jpg" class="img-circle img-responsive" style="float: left;" width="100px" >
								</div>
								<div class="col-md-9">
									<h3 style="margin-left: 20px;">
										<?php echo $institue[0]['institute_name'] ?>
									</h3>
									<h4 style="margin-top: -5px; margin-left: 100px;">
										Rahim Yar Khan
									</h4>
									<p style="margin-top: -5px; margin-left: 100px;">
										<small><b>A/C:<?php echo $institue[0]['institute_account_no'] ?></b></small>
									</p>
								</div>
							</div>
							
							<div class="row">
								<di class="col-md-12">
									<p class="text-center" style="border: 1px groove;">
										<b><?php echo $copyName[$i]; ?></b>
									</p>
								</di>
							</div>
							<div class="row">
								<div class="col-md-12">
									<p>
										<b style="float: left;">Voucher # : </b>
										<?php echo $feeDetail[0]['voucher_no']; ?>
										<span style="float: right;"><b>Session: </b><?php echo $sessionName[0]['session_name'];?></span>
									</p>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<p>
										<b style="float: left;">Issue Date: &nbsp;</b><?php echo $issueDate; ?>
										<span style="float: right"><b>Due Date: </b><?php echo $dueDate; ?></span>
									</p>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<p>
										<?php 
											if($monthCount > 1){ ?>
												<b>Voucher Month: </b><?php echo date('F', strtotime($voucherMonth[0]["month"])).'/'.date('F, Y', strtotime($voucherMonth[1]["month"])); 
											} else { ?>
												<b>Voucher Month: </b><?php echo date('F, Y', strtotime($voucherMonth[0]["month"])); 
											} ?>
									</p>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<p class="text-center" style="border: 1px groove;">
										<b>FEE VOUCHER</b>
									</p>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<p style="float: left;">
										<b>Name: </b><?php echo $stdInfo[0]['std_name'] ?>
									</p>
									<p style="float: right;">
										<b>Roll No.: </b><?php echo $student[$id]['std_roll_no'] ?>
									</p>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<p class="mb-1">
										<b>Class: </b><?php echo $className[0]['class_name'];?>
										<span style="float: right;">
											<b>Section: </b><?php echo $sectionName[0]['section_name'];?>
										</span>
									</p>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered" width="100%">
										<tr>
											<th class="text-center"><i>Sr #</i></th>
											<th colspan="2"><i>Descrpition</i></th>
											<th style="text-align: center;"><i>Amount</i></th>
										</tr>
										<?php foreach ($feeType as $index => $value) { ?>
										<tr>
											<th class="text-center"><i><?php echo ($index +1);?></i></th>
											<td colspan="2"><i>
												<?php if ($feeType[$index]['fee_type_name'] == 'Tuition Fee') {
													echo $feeType[$index]['fee_type_name'];
												}
												else{
												echo $feeType[$index]['fee_type_name'];
												}?></i>		
											</td>
											<td align="center"><i><b>
												<?php
													foreach ($feeDetail as $key => $value) { 
														if($feeDetail[$key]['fee_type_id'] == $feeType[$index]['fee_type_id'] ){
															if($feeDetail[$key]['fee_type_id'] == 2){
																if($monthCount > 1){ 
																	echo ($feeDetail[$key]['fee_amount'] + $feeDetail[$key]['fee_amount']);
																} else { 
																	echo $feeDetail[$key]['fee_amount'];
																} 
															} else {
																echo $feeDetail[$key]['fee_amount'];
															}	
														}		
													} 
												?></i></b>
											</td>
										</tr>
										<?php } ?>	
									</table>
								</div>
							</div>
							<?php
							$currentTotal  = $feeDetail[0]['total_amount'];
							$feeMonth     = $feeDetail[0]['month'];
							$lastMonth = date('Y-m', strtotime('-1 months', strtotime($feeMonth))); 
							//$installmentNo = $feeMonth -1;
							$remaining = 0;
							$remainig= 0;
							$remain = Yii::$app->db->createCommand("SELECT status, remaining, total_amount, paid_amount FROM fee_transaction_head WHERE month = '$lastMonth' AND std_id = '$stdId'")->queryAll();
							if (empty($remain)) {
								$remainig = 0;
							} else if($remain[0]['status'] == 'Partially Paid') {
								$remainig = $remain[0]['remaining'];
							} else if($remain[0]['status'] == 'Unpaid'){
								$remainig = $remain[0]['total_amount'];
							}
							$paymentByDueDate = $currentTotal;
							$paymentAFterDueDate = $paymentByDueDate + 100;
							?>			
							<div class="row">
								<div class="col-md-12">
									<table width="100%" class="table table-condensed">
										<tr>
											<th><i>Total Voucher Payment till Due Date:</i></th>
											<th><i><?php echo $paymentByDueDate; ?></i></th>
										</tr>
										<tr>
											<th><i>Total Voucher Payment after Due Date:</i></th>
											<th><i><?php echo $paymentAFterDueDate; ?></i></th>
										</tr>
									</table>
								</div>
							</div>
							<?php 
								if($remainig > 0){
									$message = "Your remaining dues are pending by Rs:".$remainig;
								} else {
									$message = '';
								}
							?>
							<div class="row">
								<div class="col-md-12" style="margin-top: -25px;">
									<h6><b>MESSAGE:</b></h6>
									<textarea class="form-control border-dark" rows="3"><?php echo $message; ?></textarea>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<h5>PAYMENT TERMS:</h5>
									<ol class="text-justify" style="font-size: 13px">
										<li>Late payment surcharge @Rs.100/-</li>
										<li>Rs.50/- will be charged for each dublicate voucher.</li>
										<li>Any error in calculation of dues by the school will be adjusted in the next voucher.</li>
									</ol>
								</div>
							</div>
							<br><br>

							<div class="row">
								<div class="col-md-6">
									<p>____________________________</p>
									<p align="center">SIGNATURE</p>
								</div>
								<div class="col-md-6 float-right">
									<p>____________________________</p>
									<p align="center">STAMP</p>
								</div>
							</div>
							<br><hr>
							
							<div class="row">
								<div class="col-md-12 text-center">
									<p style="border: 1px"><i><?php echo "Printed on: "."<b>".$todayDate."</i></b>"; ?></p>
									<p style="border: 1px outset;">Devleoped By: <b><i>DEXTEROUS DEVELOPERS</b> (0315-6898993)</i><br>www.dexdevs.com</p>
								</div>
							</div>
							<br>
						</div>
					<?php } ?>
				</div>
			</div>
		<?php
			}
		//ending of foreach loop
		}
		// ending of if statement
	} else {
		echo 
			"<div class='row' style='margin:0px -10px 0px 15px;'>
				<div class='col-md-12 alert alert-warning' style='text-align: center'>
					<p>Please Select a valid month....!</p>
				</div>
			</div>";
	}
	//ending of isset if
// }
?>
</body>
</html>