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
<?php 
use yii\helpers\ArrayHelper;
	if(isset($_GET['teacherHeadId'])) { 

		$teacherHeadId = $_GET['teacherHeadId'];

		$teacherName = Yii::$app->db->createCommand("SELECT * FROM teacher_subject_assign_head as tsah WHERE tsah.teacher_subject_assign_head_id = '$teacherHeadId'")->queryAll();

		$teacherDetails = Yii::$app->db->createCommand("SELECT * FROM teacher_subject_assign_detail as tsad WHERE teacher_subject_assign_detail_head_id = '$teacherHeadId'")->queryAll();
		//print_r($teacherDetails);
		$countTeacherDetails = count($teacherDetails);

	?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<!-- back button start -->
				 <ol class="breadcrumb">
			      <li><a class="btn btn-primary btn-xs" href="time-table-view"><i class="fa fa-backward"></i> Back</a></li>
			    </ol>
				<!-- back button close -->
			</div>
		</div>
		<div class="row">
		<div class="col-md-3">
			<button onclick="printContent('teacher-schedule')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-print"></i> Print Report
			</button>
		</div>
		</div><br>
		<div class="row" id="teacher-schedule">
			<div class="col-md-12">
				<div class="row" style="border:1px solid;border-radius:20px;padding:2px;">
					<div class="col-md-12 text-center">
						<img src="images/abc_logo.jpg" class="img-circle" height="120" width="120">
						<h2 style="line-height:2.5">ABC High Learning School Rahim Yar Khan</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h3 class="well well-sm" style="text-align: center;">
							<?php echo $teacherName[0]['teacher_subject_assign_head_name']; ?>
						</h3>
					</div>
				</div>
				<table class="table table-bordered">
					<thead>
						<tr>
							<td style="background-color:gray !important;border-radius:10px;text-align: center;color: white!important;line-height:2;font-size:25px;">Days</td>

							<td style="background-color:black !important;text-align: center;font-size:25px;color:white !important;line-height:2;" colspan="<?php echo $countTeacherDetails; ?>">
								
									Lecture Details
								
							</td>
						</tr>

						<?php 
						$mondayarray = array();
						for ($s=0; $s <$countTeacherDetails ; $s++) { 

							$classID   = $teacherDetails[$s]['class_id'];
							
							$subjectID = $teacherDetails[$s]['subject_id'];

							$mondaySchedule = Yii::$app->db->createCommand("SELECT th.days,th.class_id,td.subject_id,td.start_time,td.end_time,td.room,td.status,td.priority,th.time_table_h_id,th.class_id
							FROM time_table_detail as td
							INNER JOIN time_table_head as th
							ON th.time_table_h_id = td.time_table_h_id
							WHERE th.class_id = '$classID'
							AND th.status = 'Active'
							AND th.days LIKE '%monday%'
							AND td.subject_id = '$subjectID'")->queryAll();
							if (!empty($mondaySchedule)) {
								$mondayarray[] = $mondaySchedule[0];
							}
							$countmondayarray = count($mondayarray);
						}
						?>
						<tr>
						<td class="v" style="background-color:lightgray !important;border-radius:20px; line-height:23;text-align: center;font-weight: bolder;">
							Monday
						</td>
						<?php
						ArrayHelper::multisort($mondayarray, ['priority'], SORT_ASC);

						for ($m=0; $m <$countTeacherDetails ; $m++) {
						if (!empty($mondayarray[$m])) {
						 	
							$status 	= $mondayarray[$m]['status'];
							$classID 	= $mondayarray[$m]['class_id'];
							$classHeadName = Yii::$app->db->createCommand("SELECT std_enroll_head_name FROM std_enrollment_head WHERE std_enroll_head_id = '$classID ' ")->queryAll();
							$subjectID 	= $mondayarray[$m]['subject_id'];
							$subjectName = Yii::$app->db->createCommand("SELECT subject_name FROM subjects WHERE subject_id = '$subjectID ' ")->queryAll();

							if ($status == 1) {
						?>
						<td style="font-family:Arial;">
							<table>
								<thead>
									<tr>
										<th style="padding:5px;">
											Lecture #:
										</th>
										<td style="text-align: center;">
											<?php echo "<span style='background-color:lightgray  !important;padding:10px;font-size:20px;'>".$mondayarray[$m]['priority']."</span>"; ?>
										</td>
									</tr>
									<tr>
										<th style="padding:5px;">
											Class:
										</th>
										<td style="text-align: center;">
											<?php echo $classHeadName[0]['std_enroll_head_name']; ?>
										</td>
									</tr>
									<tr>
										<th style="padding:5px;">
											Subject:
										</th>
										<td style="text-align: center;">
											<?php echo $subjectName[0]['subject_name']; ?>
										</td>
									</tr>
									<tr>
										<th style="padding:5px;">
											Start Time:
										</th>
										<td style="text-align: center;">
											<?php echo $mondayarray[$m]['start_time']; ?>
										</td>
									</tr>
									<tr>
										<th style="padding:5px;">
											End Time:
										</th>
										<td style="text-align: center;">
											<?php echo $mondayarray[$m]['end_time']; ?>
										</td>
									</tr>
									<tr>
										<th style="padding:5px;">
											Room:
										</th>
										<td style="text-align: center;">
											<?php echo $mondayarray[$m]['room']; ?>
										</td>
									</tr>
								</thead>
							</table>
						</td>
						<?php 
								} // closing of if status
								if ($status == 0) { ?>
								<td style="font-family:Arial;">
							<table>
								<thead>
									<tr>
										<th style="padding:5px;">
											Lecture #:
										</th>
										<td style="text-align: center;">
											<?php echo $mondayarray[$m]['priority']; ?>
										</td>
									</tr>
									<tr>
										<th style="padding:5px;">
											Class:
										</th>
										<td style="text-align: center;">
											<?php echo $classHeadName[0]['std_enroll_head_name']; ?>
										</td>
									</tr>
									<tr>
										<th style="padding:5px;">
											Subject:
										</th>
										<td style="text-align: center;">
											<?php echo $subjectName[0]['subject_name']; ?>
										</td>
									</tr>
									<tr>
										<td class="success" colspan="2" style="text-align: center;font-size:30px;">
											<p style="background-color:lightgray !important;">Free</p>
										</td>
									</tr>
								</thead>
							</table>
						</td>	
							<?php	}
						}// closing of empty array
						else{ ?>
						<td style="line-height:15;text-align: center;">
							Not Assigned
						</td>
						<?php
							} // closing of $m for loop
						}
						?>
						</tr>
						<!-- monday Details end -->

						<?php 
						$tuesdayarray = array();
						for ($s=0; $s <$countTeacherDetails ; $s++) { 

							$classID   = $teacherDetails[$s]['class_id'];
							
							$subjectID = $teacherDetails[$s]['subject_id'];

							$tuesdaySchedule = Yii::$app->db->createCommand("SELECT th.days,th.class_id,td.subject_id,td.start_time,td.end_time,td.room,td.status,td.priority,th.time_table_h_id,th.class_id
							FROM time_table_detail as td
							INNER JOIN time_table_head as th
							ON th.time_table_h_id = td.time_table_h_id
							WHERE th.class_id = '$classID'
							AND th.status = 'Active'
							AND th.days LIKE '%tuesday%'
							AND td.subject_id = '$subjectID'")->queryAll();
							if (!empty($tuesdaySchedule)) {
								$tuesdayarray[] = $tuesdaySchedule[0];
							}
							$counttuesdayarray = count($tuesdayarray);
						}
						?>
						<tr>
						<td style="background-color:lightgray !important;border-radius:20px; line-height:23;text-align: center;font-weight: bolder;">Tuesday</td>
						<?php
						ArrayHelper::multisort($tuesdayarray, ['priority'], SORT_ASC);
						for ($m=0; $m <$countTeacherDetails ; $m++) {
						if (!empty($tuesdayarray[$m])) {
						 	
							$status 	= $tuesdayarray[$m]['status'];
							$classID 	= $tuesdayarray[$m]['class_id'];
							$classHeadName = Yii::$app->db->createCommand("SELECT std_enroll_head_name FROM std_enrollment_head WHERE std_enroll_head_id = '$classID ' ")->queryAll();
							$subjectID 	= $tuesdayarray[$m]['subject_id'];
							$subjectName = Yii::$app->db->createCommand("SELECT subject_name FROM subjects WHERE subject_id = '$subjectID ' ")->queryAll();

							if ($status == 1) {
						?>
						<td style="font-family:Arial;">
							<table>
								<thead>
									<tr>
										<th style="padding:5px;">
											Lecture #:
										</th>
										<td style="text-align: center;">
											<?php echo "<span style='background-color:lightgray  !important;padding:10px;font-size:20px;'>".$tuesdayarray[$m]['priority']."</span>"; ?>
										</td>
									</tr>
									<tr>
										<th style="padding:5px;">
											Class:
										</th>
										<td style="text-align: center;">
											<?php echo $classHeadName[0]['std_enroll_head_name']; ?>
										</td>
									</tr>
									<tr>
										<th style="padding:5px;">
											Subject:
										</th>
										<td style="text-align: center;">
											<?php echo $subjectName[0]['subject_name']; ?>
										</td>
									</tr>
									<tr>
										<th style="padding:5px;">
											Start Time:
										</th>
										<td style="text-align: center;">
											<?php echo $tuesdayarray[$m]['start_time']; ?>
										</td>
									</tr>
									<tr>
										<th style="padding:5px;">
											End Time:
										</th>
										<td style="text-align: center;">
											<?php echo $tuesdayarray[$m]['end_time']; ?>
										</td>
									</tr>
									<tr>
										<th style="padding:5px;">
											Room:
										</th>
										<td style="text-align: center;">
											<?php echo $tuesdayarray[$m]['room']; ?>
										</td>
									</tr>
								</thead>
							</table>
						</td>
						<?php 
								} // closing of if status
								if ($status == 0) { ?>
								<td style="font-family:Arial;">
							<table>
								<thead>
									<tr>
										<th style="padding:5px;">
											Lecture #:
										</th>
										<td style="text-align: center;">
											<?php echo $tuesdayarray[$m]['priority']; ?>
										</td>
									</tr>
									<tr>
										<th style="padding:5px;">
											Class:
										</th>
										<td style="text-align: center;">
											<?php echo $classHeadName[0]['std_enroll_head_name']; ?>
										</td>
									</tr>
									<tr>
										<th style="padding:5px;">
											Subject:
										</th>
										<td style="text-align: center;">
											<?php echo $subjectName[0]['subject_name']; ?>
										</td>
									</tr>
									<tr>
										<td class="success" colspan="2" style="text-align: center;font-size:30px;">
											<p style="background-color:lightgray !important;">Free</p>
										</td>
									</tr>
								</thead>
							</table>
						</td>	
							<?php	}
						}// closing of empty array
						else{ ?>
						<td style="line-height:15;text-align: center;">
							Not Assigned
						</td>
						<?php
							} // closing of $m for loop
						}
						?>
						</tr>
						<!-- tuesday Details end -->

						<?php 
						$wednesdayarray = array();
						for ($s=0; $s <$countTeacherDetails ; $s++) { 

							$classID   = $teacherDetails[$s]['class_id'];
							
							$subjectID = $teacherDetails[$s]['subject_id'];

							$wednesdaySchedule = Yii::$app->db->createCommand("SELECT th.days,th.class_id,td.subject_id,td.start_time,td.end_time,td.room,td.status,td.priority,th.time_table_h_id,th.class_id
							FROM time_table_detail as td
							INNER JOIN time_table_head as th
							ON th.time_table_h_id = td.time_table_h_id
							WHERE th.class_id = '$classID'
							AND th.status = 'Active'
							AND th.days LIKE '%wednesday%'
							AND td.subject_id = '$subjectID'")->queryAll();
							if (!empty($wednesdaySchedule)) {
								$wednesdayarray[] = $wednesdaySchedule[0];
							}
							$countwednesdayarray = count($wednesdayarray);
						}
						?>
						<tr>
						<td style="background-color:lightgray !important;border-radius:20px; line-height:23;text-align: center;font-weight: bolder;">Wednesday</td>
						<?php
						ArrayHelper::multisort($wednesdayarray, ['priority'], SORT_ASC);
						for ($m=0; $m <$countTeacherDetails ; $m++) {
						if (!empty($wednesdayarray[$m])) {
						 	
							$status 	= $wednesdayarray[$m]['status'];
							$classID 	= $wednesdayarray[$m]['class_id'];
							$classHeadName = Yii::$app->db->createCommand("SELECT std_enroll_head_name FROM std_enrollment_head WHERE std_enroll_head_id = '$classID ' ")->queryAll();
							$subjectID 	= $wednesdayarray[$m]['subject_id'];
							$subjectName = Yii::$app->db->createCommand("SELECT subject_name FROM subjects WHERE subject_id = '$subjectID ' ")->queryAll();

							if ($status == 1) {
						?>
						<td style="font-family:Arial;">
							<table>
								<thead>
									<tr>
										<th style="text-align: center;">
											Lecture #:
										</th>
										<td style="text-align: center;">
											<?php echo "<span style='background-color:lightgray  !important;padding:10px;font-size:20px;'>".$wednesdayarray[$m]['priority']."</span>"; ?>
										</td>
									</tr>
									<tr>
										<th style="text-align: center;">
											Class:
										</th>
										<td style="text-align: center;">
											<?php echo $classHeadName[0]['std_enroll_head_name']; ?>
										</td>
									</tr>
									<tr>
										<th style="text-align: center;">
											Subject:
										</th>
										<td style="text-align: center;">
											<?php echo $subjectName[0]['subject_name']; ?>
										</td>
									</tr>
									<tr>
										<th style="text-align: center;">
											Start Time:
										</th>
										<td style="text-align: center;">
											<?php echo $wednesdayarray[$m]['start_time']; ?>
										</td>
									</tr>
									<tr>
										<th style="text-align: center;">
											End Time:
										</th>
										<td style="text-align: center;">
											<?php echo $wednesdayarray[$m]['end_time']; ?>
										</td>
									</tr>
									<tr>
										<th style="text-align: center;">
											Room:
										</th>
										<td style="text-align: center;">
											<?php echo $wednesdayarray[$m]['room']; ?>
										</td>
									</tr>
								</thead>
							</table>
						</td>
						<?php 
								} // closing of if status
								if ($status == 0) { ?>
								<td style="font-family:Arial;">
							<table>
								<thead>
									<tr>
										<th style="text-align: center;">
											Lecture #:
										</th>
										<td style="text-align: center;">
											<?php echo $wednesdayarray[$m]['priority']; ?>
										</td>
									</tr>
									<tr>
										<th style="text-align: center;">
											Class:
										</th>
										<td style="text-align: center;">
											<?php echo $classHeadName[0]['std_enroll_head_name']; ?>
										</td>
									</tr>
									<tr>
										<th style="text-align: center;">
											Subject:
										</th>
										<td style="text-align: center;">
											<?php echo $subjectName[0]['subject_name']; ?>
										</td>
									</tr>
									<tr>
										<td class="success" colspan="2" style="text-align: center;font-size:30px;">
											<p style="background-color:lightgray !important;">Free</p>
										</td>
									</tr>
								</thead>
							</table>
						</td>	
							<?php	}
						}// closing of empty array
						else{ ?>
						<td style="line-height:15;text-align: center;">
							Not Assigned
						</td>
						<?php
							} // closing of $m for loop
						}
						?>
						</tr>
						<!-- wednesday Details end -->

						<?php 
						$thursdayarray = array();
						for ($s=0; $s <$countTeacherDetails ; $s++) { 

							$classID   = $teacherDetails[$s]['class_id'];
							
							$subjectID = $teacherDetails[$s]['subject_id'];

							$thursdaySchedule = Yii::$app->db->createCommand("SELECT th.days,th.class_id,td.subject_id,td.start_time,td.end_time,td.room,td.status,td.priority,th.time_table_h_id,th.class_id
							FROM time_table_detail as td
							INNER JOIN time_table_head as th
							ON th.time_table_h_id = td.time_table_h_id
							WHERE th.class_id = '$classID'
							AND th.status = 'Active'
							AND th.days LIKE '%thursday%'
							AND td.subject_id = '$subjectID'")->queryAll();
							//$priority = $tuesdaySchedule[0]['priority'];
							
							//print_r($tuesdaySchedule);
							if (!empty($thursdaySchedule)) {
								$thursdayarray[] = $thursdaySchedule[0];
							}
							$countthursdayarray = count($thursdayarray);
						}
						?>
						<tr>
						<td style="background-color:lightgray !important;border-radius:20px; line-height:23;text-align: center;font-weight: bolder;">Thursday</td>
						<?php
						ArrayHelper::multisort($thursdayarray, ['priority'], SORT_ASC);
						for ($m=0; $m <$countTeacherDetails ; $m++) {
						if (!empty($thursdayarray[$m])) {
						 	
							$status 	= $thursdayarray[$m]['status'];
							$classID 	= $thursdayarray[$m]['class_id'];
							$classHeadName = Yii::$app->db->createCommand("SELECT std_enroll_head_name FROM std_enrollment_head WHERE std_enroll_head_id = '$classID ' ")->queryAll();
							$subjectID 	= $thursdayarray[$m]['subject_id'];
							$subjectName = Yii::$app->db->createCommand("SELECT subject_name FROM subjects WHERE subject_id = '$subjectID ' ")->queryAll();

							if ($status == 1) {
						?>
						<td style="font-family:Arial;">
							<table>
								<thead>
									<tr>
										<th style="text-align: center;">
											Lecture #:
										</th>
										<td style="text-align: center;">
											<?php echo "<span style='background-color:lightgray  !important;padding:10px;font-size:20px;'>".$thursdayarray[$m]['priority']."</span>"; ?>
										</td>
									</tr>
									<tr>
										<th style="text-align: center;">
											Class:
										</th>
										<td style="text-align: center;">
											<?php echo $classHeadName[0]['std_enroll_head_name']; ?>
										</td>
									</tr>
									<tr>
										<th style="text-align: center;">
											Subject:
										</th>
										<td style="text-align: center;">
											<?php echo $subjectName[0]['subject_name']; ?>
										</td>
									</tr>
									<tr>
										<th style="text-align: center;">
											Start Time:
										</th>
										<td style="text-align: center;">
											<?php echo $thursdayarray[$m]['start_time']; ?>
										</td>
									</tr>
									<tr>
										<th style="text-align: center;">
											End Time:
										</th>
										<td style="text-align: center;">
											<?php echo $thursdayarray[$m]['end_time']; ?>
										</td>
									</tr>
									<tr>
										<th style="text-align: center;">
											Room:
										</th>
										<td style="text-align: center;">
											<?php echo $thursdayarray[$m]['room']; ?>
										</td>
									</tr>
								</thead>
							</table>
						</td>
						<?php 
								} // closing of if status
								if ($status == 0) { ?>
								<td style="font-family:Arial;">
							<table>
								<thead>
									<tr>
										<th style="text-align: center;">
											Lecture #:
										</th>
										<td style="text-align: center;">
											<?php echo $thursdayarray[$m]['priority']; ?>
										</td>
									</tr>
									<tr>
										<th style="text-align: center;">
											Class:
										</th>
										<td style="text-align: center;">
											<?php echo $classHeadName[0]['std_enroll_head_name']; ?>
										</td>
									</tr>
									<tr>
										<th style="text-align: center;">
											Subject:
										</th>
										<td style="text-align: center;">
											<?php echo $subjectName[0]['subject_name']; ?>
										</td>
									</tr>
									<tr>
										<td class="success" colspan="2" style="text-align: center;font-size:30px;">
											<p style="background-color:lightgray !important;">Free</p>
										</td>
									</tr>
								</thead>
							</table>
						</td>	
							<?php	}
						}// closing of empty array
						else{ ?>
						<td style="line-height:15;text-align: center;">
							Not Assigned
						</td>
						<?php
							} // closing of $m for loop
						}
						?>
						</tr>
						<!-- thursday Details end -->

						<?php 
						$fridayarray = array();
						for ($s=0; $s <$countTeacherDetails ; $s++) { 

							$classID   = $teacherDetails[$s]['class_id'];
							
							$subjectID = $teacherDetails[$s]['subject_id'];

							$fridaySchedule = Yii::$app->db->createCommand("SELECT th.days,th.class_id,td.subject_id,td.start_time,td.end_time,td.room,td.status,td.priority,th.time_table_h_id,th.class_id
							FROM time_table_detail as td
							INNER JOIN time_table_head as th
							ON th.time_table_h_id = td.time_table_h_id
							WHERE th.class_id = '$classID'
							AND th.status = 'Active'
							AND th.days LIKE '%friday%'
							AND td.subject_id = '$subjectID'")->queryAll();
							//$priority = $tuesdaySchedule[0]['priority'];
							
							//print_r($tuesdaySchedule);
							if (!empty($fridaySchedule)) {
								$fridayarray[] = $fridaySchedule[0];
							}
							$countfridayarray = count($fridayarray);
						}
						?>
						<tr>
						<td style="background-color:lightgray !important;border-radius:20px; line-height:23;text-align: center;font-weight: bolder;">Friday</td>
						<?php
						ArrayHelper::multisort($fridayarray, ['priority'], SORT_ASC);
						for ($m=0; $m <$countTeacherDetails ; $m++) {
						if (!empty($fridayarray[$m])) {
						 	
							$status 	= $fridayarray[$m]['status'];
							$classID 	= $fridayarray[$m]['class_id'];
							$classHeadName = Yii::$app->db->createCommand("SELECT std_enroll_head_name FROM std_enrollment_head WHERE std_enroll_head_id = '$classID ' ")->queryAll();
							$subjectID 	= $fridayarray[$m]['subject_id'];
							$subjectName = Yii::$app->db->createCommand("SELECT subject_name FROM subjects WHERE subject_id = '$subjectID ' ")->queryAll();

							if ($status == 1) {
						?>
						<td style="font-family:Arial;">
							<table>
								<thead>
									<tr>
										<th style="text-align: center;">
											Lecture #:
										</th>
										<td style="text-align: center;">
											<?php echo "<span style='background-color:lightgray  !important;padding:10px;font-size:20px;'>".$fridayarray[$m]['priority']."</span>"; ?>
										</td>
									</tr>
									<tr>
										<th style="text-align: center;">
											Class:
										</th>
										<td style="text-align: center;">
											<?php echo $classHeadName[0]['std_enroll_head_name']; ?>
										</td>
									</tr>
									<tr>
										<th style="text-align: center;">
											Subject:
										</th>
										<td style="text-align: center;">
											<?php echo $subjectName[0]['subject_name']; ?>
										</td>
									</tr>
									<tr>
										<th style="text-align: center;">
											Start Time:
										</th>
										<td style="text-align: center;">
											<?php echo $fridayarray[$m]['start_time']; ?>
										</td>
									</tr>
									<tr>
										<th style="text-align: center;">
											End Time:
										</th>
										<td style="text-align: center;">
											<?php echo $fridayarray[$m]['end_time']; ?>
										</td>
									</tr>
									<tr>
										<th style="text-align: center;">
											Room:
										</th>
										<td style="text-align: center;">
											<?php echo $fridayarray[$m]['room']; ?>
										</td>
									</tr>
								</thead>
							</table>
						</td>
						<?php 
								} // closing of if status
								if ($status == 0) { ?>
								<td style="font-family:Arial;">
							<table>
								<thead>
									<tr>
										<th style="text-align: center;">
											Lecture #:
										</th>
										<td style="text-align: center;">
											<?php echo $fridayarray[$m]['priority']; ?>
										</td>
									</tr>
									<tr>
										<th style="text-align: center;">
											Class:
										</th>
										<td style="text-align: center;">
											<?php echo $classHeadName[0]['std_enroll_head_name']; ?>
										</td>
									</tr>
									<tr>
										<th style="text-align: center;">
											Subject:
										</th>
										<td style="text-align: center;">
											<?php echo $subjectName[0]['subject_name']; ?>
										</td>
									</tr>
									<tr>
										<td class="success" colspan="2" style="text-align: center;font-size:30px;">
											<p style="background-color:lightgray !important;">Free</p>
										</td>
									</tr>
								</thead>
							</table>
						</td>	
							<?php	}
						}// closing of empty array
						else{ ?>
						<td style="line-height:15;text-align: center;">
							Not Assigned
						</td>
						<?php
							} // closing of $m for loop
						}
						?>
						</tr>
						<!-- friday Details end -->	

						<?php 
						$saturdayarray = array();
						for ($s=0; $s <$countTeacherDetails ; $s++) { 

							$classID   = $teacherDetails[$s]['class_id'];
							
							$subjectID = $teacherDetails[$s]['subject_id'];

							$saturdaySchedule = Yii::$app->db->createCommand("SELECT th.days,th.class_id,td.subject_id,td.start_time,td.end_time,td.room,td.status,td.priority,th.time_table_h_id,th.class_id
							FROM time_table_detail as td
							INNER JOIN time_table_head as th
							ON th.time_table_h_id = td.time_table_h_id
							WHERE th.class_id = '$classID'
							AND th.status = 'Active'
							AND th.days LIKE '%saturday%'
							AND td.subject_id = '$subjectID'")->queryAll();
							//$priority = $tuesdaySchedule[0]['priority'];
							
							//print_r($tuesdaySchedule);
							if (!empty($saturdaySchedule)) {
								$saturdayarray[] = $saturdaySchedule[0];
							}
							$countsaturdayarray = count($saturdayarray);
						}
						?>
						<tr>
						<td style="background-color:lightgray !important;border-radius:20px; line-height:23;text-align: center;font-weight: bolder;">Saturday</td>
						<?php
						ArrayHelper::multisort($saturdayarray, ['priority'], SORT_ASC);
						for ($m=0; $m <$countTeacherDetails ; $m++) {
						if (!empty($saturdayarray[$m])) {
						 	
							$status 	= $saturdayarray[$m]['status'];
							$classID 	= $saturdayarray[$m]['class_id'];
							$classHeadName = Yii::$app->db->createCommand("SELECT std_enroll_head_name FROM std_enrollment_head WHERE std_enroll_head_id = '$classID ' ")->queryAll();
							$subjectID 	= $saturdayarray[$m]['subject_id'];
							$subjectName = Yii::$app->db->createCommand("SELECT subject_name FROM subjects WHERE subject_id = '$subjectID ' ")->queryAll();

							if ($status == 1) {
						?>
						<td style="font-family:Arial;">
							<table>
								<thead>
									<tr>
										<th style="text-align: center;">
											Lecture #:
										</th>
										<td style="text-align: center;">
											<?php echo "<span style='background-color:lightgray  !important;padding:10px;font-size:20px;'>".$saturdayarray[$m]['priority']."</span>"; ?>
										</td>
									</tr>
									<tr>
										<th style="text-align: center;">
											Class:
										</th>
										<td style="text-align: center;">
											<?php echo $classHeadName[0]['std_enroll_head_name']; ?>
										</td>
									</tr>
									<tr>
										<th style="text-align: center;">
											Subject:
										</th>
										<td style="text-align: center;">
											<?php echo $subjectName[0]['subject_name']; ?>
										</td>
									</tr>
									<tr>
										<th style="text-align: center;">
											Start Time:
										</th>
										<td style="text-align: center;">
											<?php echo $saturdayarray[$m]['start_time']; ?>
										</td>
									</tr>
									<tr>
										<th style="text-align: center;">
											End Time:
										</th>
										<td style="text-align: center;">
											<?php echo $saturdayarray[$m]['end_time']; ?>
										</td>
									</tr>
									<tr>
										<th style="text-align: center;">
											Room:
										</th>
										<td style="text-align: center;">
											<?php echo $saturdayarray[$m]['room']; ?>
										</td>
									</tr>
								</thead>
							</table>
						</td>
						<?php 
								} // closing of if status
								if ($status == 0) { ?>
								<td style="font-family:Arial;">
							<table>
								<thead>
									<tr>
										<th style="text-align: center;">
											Lecture #:
										</th>
										<td style="text-align: center;">
											<?php echo $saturdayarray[$m]['priority']; ?>
										</td>
									</tr>
									<tr>
										<th style="text-align: center;">
											Class:
										</th>
										<td style="text-align: center;">
											<?php echo $classHeadName[0]['std_enroll_head_name']; ?>
										</td>
									</tr>
									<tr>
										<th style="text-align: center;">
											Subject:
										</th>
										<td style="text-align: center;">
											<?php echo $subjectName[0]['subject_name']; ?>
										</td>
									</tr>
									<tr>
										<td class="success" colspan="2" style="text-align: center;font-size:30px;">
											<p style="background-color:lightgray !important;">Free</p>
										</td>
									</tr>
								</thead>
							</table>
						</td>	
							<?php	}
						}// closing of empty array
						else{ ?>
						<td style="line-height:15;text-align: center;">
							Not Assigned
						</td>
						<?php
							} // closing of $m for loop
						}
						?>
						</tr>
						<!-- saturday Details end -->	
					</thead>
				</table>
			</div>
		</div>
	</div>
<?php } // closing of teacher if isset ?>
<?php 
if(isset($_GET['classHeadID'])){
	// getting class Head id
	$classHeadID = $_GET['classHeadID'];

	$classHeadName = Yii::$app->db->createCommand("SELECT std_enroll_head_name FROM std_enrollment_head WHERE std_enroll_head_id = '$classHeadID ' ")->queryAll();

	$classNameId = Yii::$app->db->createCommand("SELECT class_name_id
		FROM std_enrollment_head
		WHERE std_enroll_head_id = '$classHeadID'")->queryAll();
	$classNameID = $classNameId[0]['class_name_id'];
	//print_r($classNameId);
	$classSubjects = Yii::$app->db->createCommand("SELECT std_subject_name
		FROM std_subjects
		WHERE class_id = '$classNameID'")->queryAll();

	$subjects = $classSubjects[0]['std_subject_name'];
	$subjectArray = explode(',', $subjects);

	$countSubjects = count($subjectArray);

 ?>

<div class="container-fluid">
	<!-- back button start -->
	 <ol class="breadcrumb">
      <li><a class="btn btn-primary btn-xs" href="time-table-view"><i class="fa fa-backward"></i> Back</a></li>
    </ol>
	<!-- back button close -->
	<div class="row">
		<div class="col-md-12">
			<h3 class="well well-sm">
				<?php echo $classHeadName[0]['std_enroll_head_name']; ?>
			</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered">
				<thead >
					<tr>
						<th style="width:20px;background-color:#849db7;color:white;text-align: center;border-radius:10px;">Periods</th>
						<?php 
						for ($s=0; $s <=$countSubjects; $s++) {

						 ?>

							<td style="background-color:#849db7;color:white;text-align: center;border-radius:5px;"><?php echo $s+1; ?></td>
						<?php
						}  // close of for loop ?>
						<td class="info">Action</td>
					</tr>
					<!-- Monday detail start -->
					<?php 

						$mondayDetails = Yii::$app->db->createCommand("SELECT td.subject_id,td.start_time,td.end_time,td.room,td.status,td.priority,th.time_table_h_id
						FROM time_table_detail as td
						INNER JOIN time_table_head as th
						ON th.time_table_h_id = td.time_table_h_id
						WHERE th.class_id = '$classHeadID'
						AND th.status = 'Active' 
						AND th.days LIKE '%monday%'
						ORDER BY td.priority ASC")->queryAll();
						//print_r($mondayId);

					?>
					<tr>
						<td  style="background-color:#587899;color:white;line-height:6;text-align: center;border-radius:20px;">Monday</td>
						<?php 
						if (!empty($mondayDetails)) {
								$mondayId = $mondayDetails[0]['time_table_h_id'];
								$countMondayDetails = count($mondayDetails);

							for ($i=0; $i <$countMondayDetails ; $i++) { 
								$subjectId = $mondayDetails[$i]['subject_id'];
								$room = $mondayDetails[$i]['room'];
								$status = $mondayDetails[$i]['status'];
								$priority = $mondayDetails[$i]['priority'];
								//echo $priority;
								$subjectName = Yii::$app->db->createCommand("SELECT subject_name
								FROM subjects
								WHERE subject_id = '$subjectId'")->queryAll();
								
								$startTime = $mondayDetails[$i]['start_time'];
								$endTime = $mondayDetails[$i]['end_time'];
								$room = $mondayDetails[$i]['room'];
								
								$teacherDetail = Yii::$app->db->createCommand("SELECT tsah.teacher_subject_assign_head_name
								FROM teacher_subject_assign_head as tsah
								INNER JOIN teacher_subject_assign_detail as tsad
								ON tsah.teacher_subject_assign_head_id = tsad.teacher_subject_assign_detail_head_id
								WHERE tsad.subject_id = '$subjectId'
								AND tsad.class_id = '$classHeadID'")->queryAll();
									
							 ?>
							 <!-- break info start -->
							 <?php 
							 $index = $i+1;
							 //echo $index;
							 if ($status == 2 && $priority == $index) { ?>

							<td class="info text-center" style="border-radius:30px; line-height:2.5;">
								<u><?php
									echo "<span>break</span>";
								 ?></u><br>
							 	<?php 
							 		echo $startTime;
							 	 ?>
							 	 <span>TO</span>
							 	 <?php 
							 		echo $endTime;
							 	 ?><br>
							</td>  <!-- break info close -->
							<?php }
							 if ($status == 1 && $priority == $index) { ?>
							<td class="text-center">
								<u>
								<?php
									if (empty($subjectName[0]['subject_name'])) {
							 			echo "Not set";
							 		}else{
							 			echo $subjectName[0]['subject_name'];
							 		}
								 ?></u><br>
							 	<?php 
							 		if (empty($startTime)) {
							 			echo "Not set";
							 		}else{
							 			echo $startTime;
							 		}
							 	 ?>
							 	 <span>TO</span>
							 	 <?php 
							 		if (empty($endTime)) {
							 			echo "Not set";
							 		}else{
							 			echo $endTime;
							 		}
							 	 ?><br>
							 	 <u>
							 	 <?php
							 		if (empty($room)) {
							 			echo "Not set";
							 		}else{
							 			echo "Room #:".$room;
							 		}
							 	?>
							 	 </u><br>
							 	 <?php 
							 	 if (empty($teacherDetail[$i]['teacher_subject_assign_head_name'])) {
							 	 	echo "Not assigned";
							 	 }
							 	 else{
							 	 	echo "<b>".$teacherDetail[$i]['teacher_subject_assign_head_name']."</b>";
							 	 }
							 	 
							 	  ?>
							</td>
						<?php

						} // closing of if
						 if ($status == 0 && $priority == $index) { ?>
							<td class="text-center">
								<?php
									echo "<span style='line-height:6;'>----</span>";
								?>	
							</td>
						<?php

						} // closing of if
							} // closing of for loop		
						//} // closing of else for monday
						?>
						<td style="text-align: center;line-height:6;">
							<a href="./time-table-update?dayId=<?php echo $mondayId; ?>&classHeadID=<?php echo $classHeadID; ?>"><i class="glyphicon glyphicon-edit"></i> Edit</a>
						</td>
					</tr>
					<?php } // closing of if
					else { ?>
						
						<?php for ($s=0; $s <=$countSubjects; $s++) { ?>

							<td class="warning" style="text-align:center;line-height:6;"><?php echo "No Schedule"; ?></td>
						<?php  
						}  // close of for loop ?>
					<?php } // closing of else ?>
					<!-- Monday detail close -->

					<!-- Tuesday detail start -->
					<?php 

						$tuesdayDetails = Yii::$app->db->createCommand("SELECT td.subject_id,td.start_time,td.end_time,td.room,td.status,td.priority,th.time_table_h_id
						FROM time_table_detail as td
						INNER JOIN time_table_head as th
						ON th.time_table_h_id = td.time_table_h_id
						WHERE th.class_id = '$classHeadID'
						AND th.status = 'Active' 
						AND th.days LIKE '%tuesday%'
						ORDER BY td.priority ASC")->queryAll();
						
						//print_r($thursdayDetails);

					?>
					<tr>
						<td  style="background-color:#587899;color:white;line-height:6;text-align: center;border-radius:20px;">Tuesday</td>
						<?php 
						if (!empty($tuesdayDetails)) {
								$tuesdayId = $tuesdayDetails[0]['time_table_h_id'];
								$countTuesdayDetails = count($tuesdayDetails);

							for ($i=0; $i <$countTuesdayDetails ; $i++) { 
								$subjectId = $tuesdayDetails[$i]['subject_id'];
								$room = $tuesdayDetails[$i]['room'];
								$status = $tuesdayDetails[$i]['status'];
								$priority = $tuesdayDetails[$i]['priority'];
								//echo $priority;
								$subjectName = Yii::$app->db->createCommand("SELECT subject_name
								FROM subjects
								WHERE subject_id = '$subjectId'")->queryAll();
								
								$startTime = $tuesdayDetails[$i]['start_time'];
								$endTime = $tuesdayDetails[$i]['end_time'];
								$room = $tuesdayDetails[$i]['room'];
								
								$teacherDetail = Yii::$app->db->createCommand("SELECT tsah.teacher_subject_assign_head_name
								FROM teacher_subject_assign_head as tsah
								INNER JOIN teacher_subject_assign_detail as tsad
								ON tsah.teacher_subject_assign_head_id = tsad.teacher_subject_assign_detail_head_id
								WHERE tsad.subject_id = '$subjectId'
								AND tsad.class_id = '$classHeadID'")->queryAll();
									
							 ?>
							 <!-- break info start -->
							 <?php 
							 $index = $i+1;
							 //echo $index;
							 if ($status == 2 && $priority == $index) { ?>

							<td class="info text-center" style="border-radius:30px; line-height:2.5;">
								<u><?php
									echo "<span>break</span>";
								 ?></u><br>
							 	<?php 
							 		echo $startTime;
							 	 ?>
							 	 <span>TO</span>
							 	 <?php 
							 		echo $endTime;
							 	 ?><br>
							</td>  <!-- break info close -->
							<?php }
							 if ($status == 1 && $priority == $index) { ?>
							<td class="text-center">
								<u>
								<?php
									if (empty($subjectName[0]['subject_name'])) {
							 			echo "Not set";
							 		}else{
							 			echo $subjectName[0]['subject_name'];
							 		}
								 ?></u><br>
							 	<?php 
							 		if (empty($startTime)) {
							 			echo "Not set";
							 		}else{
							 			echo $startTime;
							 		}
							 	 ?>
							 	 <span>TO</span>
							 	 <?php 
							 		if (empty($endTime)) {
							 			echo "Not set";
							 		}else{
							 			echo $endTime;
							 		}
							 	 ?><br>
							 	 <u>
							 	 <?php
							 		if (empty($room)) {
							 			echo "Not set";
							 		}else{
							 			echo "Room #:".$room;
							 		}
							 	?>
							 	 </u><br>
							 	 <?php 
							 	 if (empty($teacherDetail[$i]['teacher_subject_assign_head_name'])) {
							 	 	echo "Not assigned";
							 	 }
							 	 else{
							 	 	echo "<b>".$teacherDetail[$i]['teacher_subject_assign_head_name']."</b>";
							 	 }
							 	 
							 	  ?>
							</td>
						<?php

						} // closing of if
						 if ($status == 0 && $priority == $index) { ?>
							<td class="text-center">
								<?php
									echo "<span style='line-height:6;'>----</span>";
								?>	
							</td>
						<?php

						} // closing of if
							} // closing of for loop		
						//} // closing of else for monday
						?>
						<td style="text-align: center;line-height:6;">
							<a href="./time-table-update?dayId=<?php echo $tuesdayId; ?>&classHeadID=<?php echo $classHeadID; ?>"><i class="glyphicon glyphicon-edit"></i> Edit</a>
						</td>
					</tr>
					<?php } else { ?>
						
						<?php for ($s=0; $s <=$countSubjects; $s++) { ?>

							<td class="warning" style="text-align:center;line-height:6;"><?php echo "No Schedule"; ?></td>
						<?php  
						}  // close of for loop ?>
					<?php } ?>
					<!-- Tuesday detail close -->

					<!-- Wednesday detail start -->
					<?php 

						$wenesdayDetails = Yii::$app->db->createCommand("SELECT td.subject_id,td.start_time,td.end_time,td.room,td.status,td.priority,th.time_table_h_id
						FROM time_table_detail as td
						INNER JOIN time_table_head as th
						ON th.time_table_h_id = td.time_table_h_id
						WHERE th.class_id = '$classHeadID'
						AND th.status = 'Active' 
						AND th.days LIKE '%wednesday%'
						ORDER BY td.priority ASC")->queryAll();
						
						//print_r($thursdayDetails);

					?>
					<tr>
						<td  style="background-color:#587899;color:white;line-height:6;text-align: center;border-radius:20px;">Wednesday</td>
						<?php 
						if (!empty($wenesdayDetails)) {
								$wednesdayId = $wenesdayDetails[0]['time_table_h_id'];
								$countWednesdayDetails = count($wenesdayDetails);

							for ($i=0; $i <$countWednesdayDetails ; $i++) { 
								$subjectId = $wenesdayDetails[$i]['subject_id'];
								$room = $wenesdayDetails[$i]['room'];
								$status = $wenesdayDetails[$i]['status'];
								$priority = $wenesdayDetails[$i]['priority'];
								//echo $priority;
								$subjectName = Yii::$app->db->createCommand("SELECT subject_name
								FROM subjects
								WHERE subject_id = '$subjectId'")->queryAll();
								
								$startTime = $wenesdayDetails[$i]['start_time'];
								$endTime = $wenesdayDetails[$i]['end_time'];
								$room = $wenesdayDetails[$i]['room'];
								
								$teacherDetail = Yii::$app->db->createCommand("SELECT tsah.teacher_subject_assign_head_name
								FROM teacher_subject_assign_head as tsah
								INNER JOIN teacher_subject_assign_detail as tsad
								ON tsah.teacher_subject_assign_head_id = tsad.teacher_subject_assign_detail_head_id
								WHERE tsad.subject_id = '$subjectId'
								AND tsad.class_id = '$classHeadID'")->queryAll();
									
							 ?>
							 <!-- break info start -->
							 <?php 
							 $index = $i+1;
							 //echo $index;
							 if ($status == 2 && $priority == $index) { ?>

							<td class="info text-center" style="border-radius:30px; line-height:2.5;">
								<u><?php
									echo "<span>break</span>";
								 ?></u><br>
							 	<?php 
							 		echo $startTime;
							 	 ?>
							 	 <span>TO</span>
							 	 <?php 
							 		echo $endTime;
							 	 ?><br>
							</td>  <!-- break info close -->
							<?php }
							 if ($status == 1 && $priority == $index) { ?>
							<td class="text-center">
								<u>
								<?php
									if (empty($subjectName[0]['subject_name'])) {
							 			echo "Not set";
							 		}else{
							 			echo $subjectName[0]['subject_name'];
							 		}
								 ?></u><br>
							 	<?php 
							 		if (empty($startTime)) {
							 			echo "Not set";
							 		}else{
							 			echo $startTime;
							 		}
							 	 ?>
							 	 <span>TO</span>
							 	 <?php 
							 		if (empty($endTime)) {
							 			echo "Not set";
							 		}else{
							 			echo $endTime;
							 		}
							 	 ?><br>
							 	 <u>
							 	 <?php
							 		if (empty($room)) {
							 			echo "Not set";
							 		}else{
							 			echo "Room #:".$room;
							 		}
							 	?>
							 	 </u><br>
							 	 <?php 
							 	 if (empty($teacherDetail[$i]['teacher_subject_assign_head_name'])) {
							 	 	echo "Not assigned";
							 	 }
							 	 else{
							 	 	echo "<b>".$teacherDetail[$i]['teacher_subject_assign_head_name']."</b>";
							 	 }
							 	 
							 	  ?>
							</td>
						<?php

						} // closing of if
						 if ($status == 0 && $priority == $index) { ?>
							<td class="text-center">
								<?php
									echo "<span style='line-height:6;'>----</span>";
								?>	
							</td>
						<?php

						} // closing of if
							} // closing of for loop		
						//} // closing of else for monday
						?>
						<td style="text-align: center;line-height:6;">
							<a href="./time-table-update?dayId=<?php echo $wednesdayId; ?>&classHeadID=<?php echo $classHeadID; ?>"><i class="glyphicon glyphicon-edit"></i> Edit</a>
						</td>
					</tr>
					<?php } else { ?>
						
						<?php for ($s=0; $s <=$countSubjects; $s++) { ?>

							<td class="warning" style="text-align:center;line-height:6;"><?php echo "No Schedule"; ?></td>
						<?php  
						}  // close of for loop ?>
					<?php } ?>
					<!-- Wednesday detail close -->

					<!-- Thursday detail start -->
					<?php 

						$thursdayDetails = Yii::$app->db->createCommand("SELECT td.subject_id,td.start_time,td.end_time,td.room,td.status,td.priority,th.time_table_h_id
						FROM time_table_detail as td
						INNER JOIN time_table_head as th
						ON th.time_table_h_id = td.time_table_h_id
						WHERE th.class_id = '$classHeadID'
						AND th.status = 'Active' 
						AND th.days LIKE '%thursday%'
						ORDER BY td.priority ASC")->queryAll();
						
						//print_r($thursdayDetails);

					?>
					<tr>
						<td  style="background-color:#587899;color:white;line-height:6;text-align: center;border-radius:20px;">Thursday</td>
						<?php 
						if (!empty($thursdayDetails)) {
								$thursdayId = $thursdayDetails[0]['time_table_h_id'];
								$countThursdayDetails = count($thursdayDetails);

							for ($i=0; $i <$countThursdayDetails ; $i++) { 
								$subjectId = $thursdayDetails[$i]['subject_id'];
								$room = $thursdayDetails[$i]['room'];
								$status = $thursdayDetails[$i]['status'];
								$priority = $thursdayDetails[$i]['priority'];
								//echo $priority;
								$subjectName = Yii::$app->db->createCommand("SELECT subject_name
								FROM subjects
								WHERE subject_id = '$subjectId'")->queryAll();
								
								$startTime = $thursdayDetails[$i]['start_time'];
								$endTime = $thursdayDetails[$i]['end_time'];
								$room = $thursdayDetails[$i]['room'];
								
								$teacherDetail = Yii::$app->db->createCommand("SELECT tsah.teacher_subject_assign_head_name
								FROM teacher_subject_assign_head as tsah
								INNER JOIN teacher_subject_assign_detail as tsad
								ON tsah.teacher_subject_assign_head_id = tsad.teacher_subject_assign_detail_head_id
								WHERE tsad.subject_id = '$subjectId'
								AND tsad.class_id = '$classHeadID'")->queryAll();
									
							 ?>
							 <!-- break info start -->
							 <?php 
							 $index = $i+1;
							 //echo $index;
							 if ($status == 2 && $priority == $index) { ?>

							<td class="info text-center" style="border-radius:30px; line-height:2.5;">
								<u><?php
									echo "<span>break</span>";
								 ?></u><br>
							 	<?php 
							 		echo $startTime;
							 	 ?>
							 	 <span>TO</span>
							 	 <?php 
							 		echo $endTime;
							 	 ?><br>
							</td>  <!-- break info close -->
							<?php }
							 if ($status == 1 && $priority == $index) { ?>
							<td class="text-center">
								<u>
								<?php
									if (empty($subjectName[0]['subject_name'])) {
							 			echo "Not set";
							 		}else{
							 			echo $subjectName[0]['subject_name'];
							 		}
								 ?></u><br>
							 	<?php 
							 		if (empty($startTime)) {
							 			echo "Not set";
							 		}else{
							 			echo $startTime;
							 		}
							 	 ?>
							 	 <span>TO</span>
							 	 <?php 
							 		if (empty($endTime)) {
							 			echo "Not set";
							 		}else{
							 			echo $endTime;
							 		}
							 	 ?><br>
							 	 <u>
							 	 <?php
							 		if (empty($room)) {
							 			echo "Not set";
							 		}else{
							 			echo "Room #:".$room;
							 		}
							 	?>
							 	 </u><br>
							 	 <?php 
							 	 if (empty($teacherDetail[$i]['teacher_subject_assign_head_name'])) {
							 	 	echo "Not assigned";
							 	 }
							 	 else{
							 	 	echo "<b>".$teacherDetail[$i]['teacher_subject_assign_head_name']."</b>";
							 	 }
							 	 
							 	  ?>
							</td>
						<?php

						} // closing of if
						 if ($status == 0 && $priority == $index) { ?>
							<td class="text-center">
								<?php
									echo "<span style='line-height:6;'>----</span>";
								?>	
							</td>
						<?php

						} // closing of if
							} // closing of for loop		
						//} // closing of else for monday
						?>
						<td style="text-align: center;line-height:6;">
							<a href="./time-table-update?dayId=<?php echo $thursdayId; ?>&classHeadID=<?php echo $classHeadID; ?>"><i class="glyphicon glyphicon-edit"></i> Edit</a>
						</td>
					</tr>
					<?php } else { ?>
						
						<?php for ($s=0; $s <=$countSubjects; $s++) { ?>

							<td class="warning" style="text-align:center;line-height:6;"><?php echo "No Schedule"; ?></td>
						<?php  
						}  // close of for loop ?>
					<?php } ?>
					<!-- Thursday detail close -->


					<!-- Friday detail start -->
					<?php 

						$fridayDetails = Yii::$app->db->createCommand("SELECT td.subject_id,td.start_time,td.end_time,td.room,td.status,td.priority,th.time_table_h_id
						FROM time_table_detail as td
						INNER JOIN time_table_head as th
						ON th.time_table_h_id = td.time_table_h_id
						WHERE th.class_id = '$classHeadID'
						AND th.status = 'Active' 
						AND th.days LIKE '%thursday%'
						ORDER BY td.priority ASC")->queryAll();
						
						//print_r($thursdayDetails);

					?>
					<tr>
						<td  style="background-color:#587899;color:white;line-height:6;text-align: center;border-radius:20px;">Friday</td>
						<?php 
						if (!empty($fridayDetails)) {
								$fridayId = $fridayDetails[0]['time_table_h_id'];
								$countFridayDetails = count($fridayDetails);

							for ($i=0; $i <$countFridayDetails ; $i++) { 
								$subjectId = $fridayDetails[$i]['subject_id'];
								$room = $fridayDetails[$i]['room'];
								$status = $fridayDetails[$i]['status'];
								$priority = $fridayDetails[$i]['priority'];
								//echo $priority;
								$subjectName = Yii::$app->db->createCommand("SELECT subject_name
								FROM subjects
								WHERE subject_id = '$subjectId'")->queryAll();
								
								$startTime = $fridayDetails[$i]['start_time'];
								$endTime = $fridayDetails[$i]['end_time'];
								$room = $fridayDetails[$i]['room'];
								
								$teacherDetail = Yii::$app->db->createCommand("SELECT tsah.teacher_subject_assign_head_name
								FROM teacher_subject_assign_head as tsah
								INNER JOIN teacher_subject_assign_detail as tsad
								ON tsah.teacher_subject_assign_head_id = tsad.teacher_subject_assign_detail_head_id
								WHERE tsad.subject_id = '$subjectId'
								AND tsad.class_id = '$classHeadID'")->queryAll();
									
							 ?>
							 <!-- break info start -->
							 <?php 
							 $index = $i+1;
							 //echo $index;
							 if ($status == 2 && $priority == $index) { ?>

							<td class="info text-center" style="border-radius:30px; line-height:2.5;">
								<u><?php
									echo "<span>break</span>";
								 ?></u><br>
							 	<?php 
							 		echo $startTime;
							 	 ?>
							 	 <span>TO</span>
							 	 <?php 
							 		echo $endTime;
							 	 ?><br>
							</td>  <!-- break info close -->
							<?php }
							 if ($status == 1 && $priority == $index) { ?>
							<td class="text-center">
								<u>
								<?php
									if (empty($subjectName[0]['subject_name'])) {
							 			echo "Not set";
							 		}else{
							 			echo $subjectName[0]['subject_name'];
							 		}
								 ?></u><br>
							 	<?php 
							 		if (empty($startTime)) {
							 			echo "Not set";
							 		}else{
							 			echo $startTime;
							 		}
							 	 ?>
							 	 <span>TO</span>
							 	 <?php 
							 		if (empty($endTime)) {
							 			echo "Not set";
							 		}else{
							 			echo $endTime;
							 		}
							 	 ?><br>
							 	 <u>
							 	 <?php
							 		if (empty($room)) {
							 			echo "Not set";
							 		}else{
							 			echo "Room #:".$room;
							 		}
							 	?>
							 	 </u><br>
							 	 <?php 
							 	 if (empty($teacherDetail[$i]['teacher_subject_assign_head_name'])) {
							 	 	echo "Not assigned";
							 	 }
							 	 else{
							 	 	echo "<b>".$teacherDetail[$i]['teacher_subject_assign_head_name']."</b>";
							 	 }
							 	 
							 	  ?>
							</td>
						<?php

						} // closing of if
						 if ($status == 0 && $priority == $index) { ?>
							<td class="text-center">
								<?php
									echo "<span style='line-height:6;'>----</span>";
								?>	
							</td>
						<?php

						} // closing of if
							} // closing of for loop		
						//} // closing of else for monday
						?>
						<td style="text-align: center;line-height:6;">
							<a href="./time-table-update?dayId=<?php echo $fridayId; ?>&classHeadID=<?php echo $classHeadID; ?>"><i class="glyphicon glyphicon-edit"></i> Edit</a>
						</td>
					</tr>
					<?php } else { ?>
						
						<?php for ($s=0; $s <=$countSubjects; $s++) { ?>

							<td class="warning" style="text-align:center;line-height:6;"><?php echo "No Schedule"; ?></td>
						<?php  
						}  // close of for loop ?>
					<?php } ?>
					<!-- Friday detail close -->

					<!-- Saturday detail start -->
					<?php 

						$saturdayDetails = Yii::$app->db->createCommand("SELECT td.subject_id,td.start_time,td.end_time,td.room,td.status,td.priority,th.time_table_h_id
						FROM time_table_detail as td
						INNER JOIN time_table_head as th
						ON th.time_table_h_id = td.time_table_h_id
						WHERE th.class_id = '$classHeadID'
						AND th.status = 'Active' 
						AND th.days LIKE '%saturday%'
						ORDER BY td.priority ASC")->queryAll();
						
						//print_r($thursdayDetails);

					?>
					<tr>
						<td  style="background-color:#587899;color:white;line-height:6;text-align: center;border-radius:20px;">Saturday</td>
						<?php 
						if (!empty($saturdayDetails)) {
								$saturdayId = $saturdayDetails[0]['time_table_h_id'];
								$countsaturdayDetails = count($saturdayDetails);

							for ($i=0; $i <$countsaturdayDetails ; $i++) { 
								$subjectId = $saturdayDetails[$i]['subject_id'];
								$room = $saturdayDetails[$i]['room'];
								$status = $saturdayDetails[$i]['status'];
								$priority = $saturdayDetails[$i]['priority'];
								//echo $priority;
								$subjectName = Yii::$app->db->createCommand("SELECT subject_name
								FROM subjects
								WHERE subject_id = '$subjectId'")->queryAll();
								
								$startTime = $saturdayDetails[$i]['start_time'];
								$endTime = $saturdayDetails[$i]['end_time'];
								$room = $saturdayDetails[$i]['room'];
								
								$teacherDetail = Yii::$app->db->createCommand("SELECT tsah.teacher_subject_assign_head_name
								FROM teacher_subject_assign_head as tsah
								INNER JOIN teacher_subject_assign_detail as tsad
								ON tsah.teacher_subject_assign_head_id = tsad.teacher_subject_assign_detail_head_id
								WHERE tsad.subject_id = '$subjectId'
								AND tsad.class_id = '$classHeadID'")->queryAll();
									
							 ?>
							 <!-- break info start -->
							 <?php 
							 $index = $i+1;
							 //echo $index;
							 if ($status == 2 && $priority == $index) { ?>

							<td class="info text-center" style="border-radius:30px; line-height:2.5;">
								<u><?php
									echo "<span>break</span>";
								 ?></u><br>
							 	<?php 
							 		echo $startTime;
							 	 ?>
							 	 <span>TO</span>
							 	 <?php 
							 		echo $endTime;
							 	 ?><br>
							</td>  <!-- break info close -->
							<?php }
							 if ($status == 1 && $priority == $index) { ?>
							<td class="text-center">
								<u>
								<?php
									if (empty($subjectName[0]['subject_name'])) {
							 			echo "Not set";
							 		}else{
							 			echo $subjectName[0]['subject_name'];
							 		}
								 ?></u><br>
							 	<?php 
							 		if (empty($startTime)) {
							 			echo "Not set";
							 		}else{
							 			echo $startTime;
							 		}
							 	 ?>
							 	 <span>TO</span>
							 	 <?php 
							 		if (empty($endTime)) {
							 			echo "Not set";
							 		}else{
							 			echo $endTime;
							 		}
							 	 ?><br>
							 	 <u>
							 	 <?php
							 		if (empty($room)) {
							 			echo "Not set";
							 		}else{
							 			echo "Room #:".$room;
							 		}
							 	?>
							 	 </u><br>
							 	 <?php 
							 	 if (empty($teacherDetail[$i]['teacher_subject_assign_head_name'])) {
							 	 	echo "Not assigned";
							 	 }
							 	 else{
							 	 	echo "<b>".$teacherDetail[$i]['teacher_subject_assign_head_name']."</b>";
							 	 }
							 	 
							 	  ?>
							</td>
						<?php

						} // closing of if
						 if ($status == 0 && $priority == $index) { ?>
							<td class="text-center">
								<?php
									echo "<span style='line-height:6;'>----</span>";
								?>	
							</td>
						<?php

						} // closing of if
							} // closing of for loop		
						//} // closing of else for monday
						?>
						<td style="text-align: center;line-height:6;">
							<a href="./time-table-update?dayId=<?php echo $saturdayId; ?>&classHeadID=<?php echo $classHeadID; ?>"><i class="glyphicon glyphicon-edit"></i> Edit</a>
						</td>
					</tr>
					<?php } else { ?>
						
						<?php for ($s=0; $s <=$countSubjects; $s++) { ?>

							<td class="warning" style="text-align:center;line-height:6;"><?php echo "No Schedule"; ?></td>
						<?php  
						}  // close of for loop ?>
					<?php } ?>
					<!-- Saturday detail close -->
					
				</thead>
			</table>
		</div>
	</div>
</div>
</body>
</html>

<?php } ?>
<script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>