<?php 

	$empData = Yii::$app->db->createCommand("SELECT DISTINCT(emp_id) FROM emp_leave")->queryAll();
	$countEmpData = count($empData);
 ?>
<div class="container-fluid">
	<form method="post" action="leave-report">
		<input type="hidden" name="_csrf" class="form-control" value="<?=Yii::$app->request->getCsrfToken()?>"> 
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label>Select Employee</label>
					<select name="empID" class="form-control">
						<option value="">Select Employee</option>
						<?php 
						for ($e=0; $e <$countEmpData ; $e++) { 
						$empID = $empData[$e]['emp_id'];
						$empName = Yii::$app->db->createCommand("SELECT emp_id,emp_name FROM emp_info WHERE emp_id = '$empID'")->queryAll();
						?>
						<option value="<?php echo $empName[0]['emp_id']; ?>">
							<?php echo $empName[0]['emp_name']; ?>
						</option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="col-md-4" style="margin-top:25px;">
				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-success">
						Get Leave Report
					</button>
				</div>
			</div>
		</div>
	</form>
</div>
<?php 

	if(isset($_POST['submit'])){

		$emp_id = $_POST['empID'];
		//echo $emp_id;
		$empYears = Yii::$app->db->createCommand("SELECT DISTINCT YEAR(applying_date) FROM emp_leave WHERE emp_id = '$emp_id'")->queryAll();
		//print_r($empYears);
		$countEmpYears = count($empYears);

 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css" media="print">
		ol{
			display: none;
		}

		
	</style>
</head>
<body>
<div class="container-fluid">
	<?php 

	for ($y=0; $y <$countEmpYears ; $y++) { 
		$year = $empYears[$y]['YEAR(applying_date)'];

	?>
	<div class="row">
		<div class="col-md-12">
			<div class="box box-default collapsed-box">
                    <div class="box-header" style="background-color:#829bb5;padding: 15px;">
                        <h3 class="box-title">
                            <b>
                            <?php echo $year; ?>
                            </b>
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">  <br><i class="fa fa-plus" style="font-size:15px;color:white;"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
						<?php 

	$empAllowedLeaves = Yii::$app->db->createCommand("SELECT emp_allowed_leaves FROM emp_info WHERE emp_id = '$emp_id' ")->queryAll();

	$totalAllowed = $empAllowedLeaves[0]['emp_allowed_leaves'];
	//echo $$emp_id;
	$empData = Yii::$app->db->createCommand("SELECT * FROM emp_leave WHERE emp_id = '$emp_id' AND YEAR(applying_date) = '$year'")->queryAll();
	// Total accepted leaves
	$empAcceptedLeaves = Yii::$app->db->createCommand("SELECT status FROM emp_leave WHERE emp_id = '$emp_id' AND status = 'Accepted' AND YEAR(applying_date) = '$year'")->queryAll();
	$countEmpAcceptedLeaves = count($empAcceptedLeaves);

	// Total rejected leaves
	$empRejectedLeaves = Yii::$app->db->createCommand("SELECT status FROM emp_leave WHERE emp_id = '$emp_id' AND status = 'Rejected' AND YEAR(applying_date) = '$year'")->queryAll();
	$countEmpRejectedLeaves = count($empRejectedLeaves);

	// Total pending leaves
	$empPendingLeaves = Yii::$app->db->createCommand("SELECT status FROM emp_leave WHERE emp_id = '$emp_id' AND status = 'Pending' AND YEAR(applying_date) = '$year'")->queryAll();
	$countEmpPendingLeaves = count($empPendingLeaves);

	$branchID = $empData[0]['branch_id'];
	$branchName = Yii::$app->db->createCommand("SELECT * FROM branches WHERE branch_id = '$branchID'")->queryAll(); 
	$countEmpData = count($empData);
	//echo $countEmpData;

 ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<!-- back button start -->
			<!-- <ol class="breadcrumb">
		      <li><a class="btn btn-primary btn-xs" href="./leave-index?$emp_id=<?php //echo $emp_id;?>"><i class="fa fa-backward"></i> Back</a></li>
		    </ol> -->
			<!-- back button close -->
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<button onclick="printContent('leave-report<?php echo $y;?>')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-print"></i> Print Report
			</button>
		</div>
	</div>
	<div class="box box-default" style="border:none;" id="leave-report<?php echo $y;?>">
		<div class="box-body" style="padding:40px;">
			<div class="row" style="border:1px solid;border-radius:20px;padding:2px;">
				<div class="col-md-12 text-center">
					<img src="images/abc_logo.jpg" class="img-circle" height="120" width="120">
					<h2 style="line-height:2.5">ABC High Learning School Rahim Yar Khan</h2>
				</div>
			</div>
			<br>
			<div class="row">
			  <div class="col-sm-6" style="text-align: center;">
			  	<b style="">Branch : <span style="font-weight: lighter;background-color: lightgray !important;padding:5px;border-radius:10px;font-family: Arial;"><?php echo $branchName[0]['branch_name']; ?></span>
			  	</b>
			  </div>
			  <div class="col-sm-6" style="text-align: center;">
			  	<b style="">Year : <span style="font-weight: lighter;background-color: lightgray !important;padding:5px;border-radius:10px;font-family: Arial;"><?php echo $year; ?></span>
			  	</b>
			  </div>
			</div>
			<div class="row">
				<div class="col-md-12" style="text-align: center;">
					<h3>Leave History :
						<span style="font-weight:bold;font-family:georgia;">
							<?php echo $empData[0]['emp_name']; ?>
						</span>
					</h3>
				</div>
			</div><br>
			<div class="row">
				<div class="col-sm-4" style="text-align: center;">
					<?php 

						$Remaining = $totalAllowed - $countEmpAcceptedLeaves;

					 ?>
					 <table class="table table-bordered">
					 	<thead>
					 		<tr>
					 			<td>
					 				<b>Total Allowed Leaves</b>
					 			</td>
					 			<td>
					 				<span style="background-color:lightgray !important;padding:5px;border-radius:5px;font-weight:bolder;font-family:Arial;">
					 				<?php echo $totalAllowed; ?>
					 				</span>
					 			</td>
					 		</tr>
					 		<tr>
					 			<td>
					 				<b>Total Accepted Leaves</b>
					 			</td>
					 			<td>
					 				<span style="background-color:lightgray !important;padding:5px;border-radius:5px;font-weight:bolder;font-family:Arial;">
					 				<?php echo $countEmpAcceptedLeaves; ?>
					 				</span>
					 			</td>
					 		</tr>
					 	</thead>
					 </table>
				</div>
				<div class="col-sm-4" style="text-align: center;">
					<table class="table table-bordered">
					 	<thead>
					 		<tr>
					 			<td>
					 				<b>Total Leaves Taken</b>
					 			</td>
					 			<td>
					 				<span style="background-color:lightgray !important;padding:5px;border-radius:5px;font-weight:bolder;font-family:Arial;">
					 				<?php echo $countEmpData; ?>
					 				</span>
					 			</td>
					 		</tr>
					 		<tr>
					 			<td>
					 				<b>Total Rejected Leaves</b>
					 			</td>
					 			<td>
					 				<span style="background-color:lightgray !important;padding:5px;border-radius:5px;font-weight:bolder;font-family:Arial;">
					 				<?php echo $countEmpRejectedLeaves; ?>
					 				</span>
					 			</td>
					 		</tr>
					 	</thead>
					 </table>
				</div>
				<div class="col-sm-4" style="text-align: center;">
					 <table class="table table-bordered">
					 	<thead>
					 		<tr>
					 			<td>
					 				<b><b>Remaining Leaves</b></b>
					 			</td>
					 			<td>
					 				<span style="background-color:lightgray !important;padding:5px;border-radius:5px;font-weight:bolder;font-family:Arial;">
					 				<?php echo $Remaining; ?>
					 				</span>
					 			</td>
					 		</tr>
					 		<tr>
					 			<td>
					 				<b>Total Pending leaves</b>
					 			</td>
					 			<td>
					 				<span style="background-color:lightgray !important;padding:5px;border-radius:5px;font-weight:bolder;font-family:Arial;">
					 				<?php echo $countEmpPendingLeaves; ?>
					 				</span>
					 			</td>
					 		</tr>
					 	</thead>
					 </table>
				</div>
			</div><hr>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-hover">
						<thead>
							<tr>
								<th class="text-center" style="color: white !important;background-color: black !important">Sr. #</th>
								<th class="text-center"style="color: white !important;background-color: black !important">Leave Type</th>
								<th class="text-center" style="color: white !important;background-color: black !important">Applying Date</th>
								<th class="text-center"style="color: white !important;background-color: black !important">Starting Date</th>
								<th class="text-center"style="color: white !important;background-color: black !important">Ending Date</th>
								<th class="text-center"style="color: white !important;background-color: black !important">No of days</th>
								<th class="text-center"style="color: white !important;background-color: black !important">Leave Purpose</th>
								<th class="text-center"style="color: white !important;background-color: black !important">Status</th>
								<th class="text-center"style="color: white !important;background-color: black !important">Remarks</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							for ($i=0; $i <$countEmpData ; $i++) { 
							
							 ?>
							<tr class="text-center">
								<td><?php echo $i+1; ?></td>
								<td><?php echo $empData[$i]['leave_type']; ?></td>
								<td>
									<?php

									$applyingDate = date('d-M-y',strtotime($empData[$i]['applying_date']));
									echo $applyingDate;


									 ?>	
								</td>
								<td>
									<?php //echo $empData[0]['starting_date']; 

									$startingDate = date('d-M-y',strtotime($empData[$i]['starting_date']));
									echo $startingDate;


									?>
									
								</td>
								<td>
									<?php 
									$endingDate = date('d-M-y',strtotime($empData[$i]['ending_date']));
									echo $endingDate;
									?>
								</td>
								<td><?php echo $empData[$i]['no_of_days']; ?></td>
								<td><?php echo $empData[$i]['leave_purpose']; ?></td>
								<td><?php echo $empData[$i]['status']; ?></td>
								<td><?php echo $empData[$i]['remarks']; ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="row well well-sm" style="margin-top:900px;text-align:center;background-color:lightgray !important;">
			<div class="col-sm-6">
				<p>
					Copyright © 2019 DEXDEVS / All Rights Reserved. 
				</p>
			</div>
			<div class="col-sm-6" style="border-left:1px solid;">
				<p>
					For Technical Support Feel Free to Contact Us 24/7 on (0300-6999824) 
				</p>
			</div>
		</div>
	</div>
</div>
<!-- container-fluid close -->
                    </div>
                    <!-- /.box-body -->
                </div>
		</div>
	</div>
	<?php } ?>
</div>
</body>
</html>
<script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>
<?php 

	} // isset close

 ?>