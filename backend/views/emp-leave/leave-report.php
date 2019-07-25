<?php 

	$empID = $_GET['empID'];

	//echo $empID;
	$empData = Yii::$app->db->createCommand("SELECT * FROM emp_leave WHERE emp_id = '$empID'")->queryAll();
	// Total accepted leaves
	$empAcceptedLeaves = Yii::$app->db->createCommand("SELECT status FROM emp_leave WHERE emp_id = '$empID' AND status = 'Accepted'")->queryAll();
	$countEmpAcceptedLeaves = count($empAcceptedLeaves);

	// Total rejected leaves
	$empRejectedLeaves = Yii::$app->db->createCommand("SELECT status FROM emp_leave WHERE emp_id = '$empID' AND status = 'Rejected'")->queryAll();
	$countEmpRejectedLeaves = count($empRejectedLeaves);

	// Total pending leaves
	$empPendingLeaves = Yii::$app->db->createCommand("SELECT status FROM emp_leave WHERE emp_id = '$empID' AND status = 'Pending'")->queryAll();
	$countEmpPendingLeaves = count($empPendingLeaves);

	$branchID = $empData[0]['branch_id'];
	$branchName = Yii::$app->db->createCommand("SELECT * FROM branches WHERE branch_id = '$branchID'")->queryAll(); 
	$countEmpData = count($empData);
	//echo $countEmpData;

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
	<div class="row">
		<div class="col-md-12">
			<!-- back button start -->
			<ol class="breadcrumb">
		      <li><a class="btn btn-primary btn-xs" href="./leave-index?empID=<?php echo $empID;?>"><i class="fa fa-backward"></i> Back</a></li>
		    </ol>
			<!-- back button close -->
		</div>
	</div>
	<div class="box box-default" style="border:none;">
		<div class="box-body" style="padding:50px;">
			<div class="row" style="border:1px solid;border-radius:20px;padding:10px;">
				<div class="col-md-4 text-center">
					<img src="images/abc_logo.jpg" class="img-circle" height="120" width="120">
				</div>
				<div class="col-md-8">
					<h2 style="line-height:2.5">ABC High Learning School Rahim Yar Khan</h2>
				</div>
			</div><br>
			<center>
			<b>Branch : <span style="font-weight: lighter;"><?php echo $branchName[0]['branch_name']; ?></span></b>
			</center>
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
				<div class="col-md-6" style="text-align: center;">
					<?php 

						$totalAllowed = 20;
						$Remaining = $totalAllowed - $countEmpAcceptedLeaves;

					 ?>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Total Allowed Leaves</th>
								<td style="background-color:lightgray;"><?php echo $totalAllowed; ?></td>
							</tr>
							<tr>
								<th>Total Leaves Taken</th>
								<td style="background-color:lightgray;"><?php echo $countEmpData; ?></td>
							</tr>
							<tr>
								<th>Remaining Leaves</th>
								<td style="background-color:lightgray;"><?php echo $Remaining; ?></td>
							</tr>
						</thead>
					</table>
					<!-- <p><u>Total Annual Leaves</u><br>
						<span class="badge" style="font-weight:bold;font-family:Arial;">
							20
						</span>
					</p>
					<p><u>Total Leaves taken till now</u><br>
						<span class="badge" style="font-weight:bold;font-family:Arial;">
							5
						</span>
					</p>
					<p><u>Remaining Leaves are</u><br>
						<span class="badge" style="font-weight:bold;font-family:Arial;">
							15
						</span>
					</p> -->
				</div>
				<div class="col-md-6" style="text-align: center;">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Total Accepted Leaves</th>
								<td style="background-color:lightgray;"><?php echo $countEmpAcceptedLeaves; ?></td>
							</tr>
							<tr>
								<th>Total Rejected Leaves</th>
								<td style="background-color:lightgray;"><?php echo $countEmpRejectedLeaves; ?></td>
							</tr>
							<tr>
								<th>Total Pending leaves</th>
								<td style="background-color:lightgray;"><?php echo $countEmpPendingLeaves; ?></td>
							</tr>
						</thead>
					</table>
					<!-- <p><u>Total Annual Leaves</u><br>
						<span class="badge" style="font-weight:bold;font-family:Arial;">
							20
						</span>
					</p>
					<p><u>Total Leaves taken till now</u><br>
						<span class="badge" style="font-weight:bold;font-family:Arial;">
							5
						</span>
					</p>
					<p><u>Remaining Leaves are</u><br>
						<span class="badge" style="font-weight:bold;font-family:Arial;">
							15
						</span>
					</p> -->
				</div>
			</div><hr>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th class="text-center">Sr. #</th>
								<th class="text-center">Leave Type</th>
								<th class="text-center">Applying Date</th>
								<th class="text-center">Starting Date</th>
								<th class="text-center">Ending Date</th>
								<th class="text-center">No of days</th>
								<th class="text-center">Leave Purpose</th>
								<th class="text-center">Status</th>
								<th class="text-center">Remarks</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							for ($i=0; $i <$countEmpData ; $i++) { 
							
							 ?>
							<tr class="text-center">
								<td><?php echo $i+1; ?></td>
								<td><?php echo $empData[$i]['leave_type']; ?></td>
								<td><?php echo $empData[$i]['applying_date']; ?></td>
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
	</div>
</div>
<!-- container-fluid close -->
</body>
</html>