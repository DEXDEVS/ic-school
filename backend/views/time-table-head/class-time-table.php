<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css" media="print">
		ol{
			display: none;
		}
		@media print{
			.colorful{
				color:blue !important;

			}
			.b-c-lg{
				background-color:lightgray !important;
			}
			#test{
				display: none;
			}
			{ id=""
				background-color:black !important;
			}
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
		//echo $countTeacherDetails;

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
			<div class="col-md-12">
				<button style="float: right;" onclick="printContent('teacher-schedule')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-print"></i> Print Report
				</button>
			</div>
		</div><br>
		<!-- Teacher Schedule start here -->
		<span class="" id="teacher-schedule">
			<!-- Report header start here -->
			<div class="row">
				<div class="col-md-12 text-center" style="border-top:1px solid;border-bottom:1px solid;border-radius:0px;padding:10px;">
					<img src="images/abc_logo.jpg" class="img-thumbnail" height="120" width="120">
					<h2 style="line-height:2.5;font-size:35px;">ABC Learning High School Rahim Yar Khan</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<h3 style="background-color:black !important;text-align: center;font-size:25px;color:white !important;line-height:2;">
						Lecture Details
					</h3>
				</div>
				<div class="col-md-6">
					<h3 class="well well-sm" style="text-align: center;background-color:lightgray !important;font-size:25px;font-family:georgia;">
						<?php echo $teacherName[0]['teacher_subject_assign_head_name']; ?>
					</h3>
				</div>
				<div class="col-md-3">
					<h3 class="well well-sm" style="text-align: center;background-color:black !important;color:white!important;">
						<?php echo "2019"; ?>
					</h3>
				</div>
			</div>
			<!-- Report header close here -->

			<!-- monday schedule start here -->
			<h3  style="background-color:#3b444b !important;text-align: center;font-size:25px;line-height:2;border-radius:10px;">
						<span style="color: white !important"> Monday</span>
			</h3>
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
			<div class="row">
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
					<div class="col-md-3">
						<div class="panel panel-default" style="padding:0px;">
							<div class="panel-body" style="background-color:#efeded !important;">
								<div class="">
								<table class="table table-striped" style="background-color:white;border-radius:30px;margin-bottom:0px;font-size:15px;font-family:Arial;">
									<tr style="background-color:;">
										<td colspan="2">
											<p style="font-size:20px;text-align: center;font-weight: bolder;">Lecture <span><?php echo "<span style='background-color:#efeded  !important;padding:5px;font-family:Arial;border-radius:5px;'>".$mondayarray[$m]['priority']."</span>"; ?></span>
											</p>
										</td>
									</tr>
									<tr style="font-weight: bolder;">
										<th style="background-color:lightgray!important;">Class</th>
										<td  style="background-color:lightgray!important;" class="text-center"><?php echo $classHeadName[0]['std_enroll_head_name'];?></td>
									</tr>
									<tr style="font-weight: bolder;">
										<td style="background-color:#efeded !important;">subject</td>
										<td class="text-center" style="font-family: Arial;"><?php echo $subjectName[0]['subject_name']; ?>  </td>
									</tr>
									<tr style="font-weight: bolder;">
										<td style="background-color:#efeded !important;">Start Time</td>
										<td style="font-family: Arial;" class="text-center"><?php echo $mondayarray[$m]['start_time']; ?></td>
									</tr>
									<tr style="font-weight: bolder;">
										<td style="background-color:#efeded !important;">End time</td>
										<td class="text-center"><?php echo $mondayarray[$m]['end_time']; ?></td>
									</tr>
									<tr style="font-weight: bolder;">
										<td style="background-color:#efeded !important;">Room</td>
										<td style="text-align:center;font-size:15px;font-family: Arial;"><?php echo $mondayarray[$m]['room']; ?></td>
									</tr>
								</table>
							</div>
							</div>
						</div>
					</div>
				<?php 

				} // closing of if status = 1
				if ($status == 0) { ?>

					<div class="col-md-3">
						<div class="panel panel-success">
							<div class="panel-body" style="background-color:#D6E9C6 !important;">
								<div class="">
									<table class="table table-bordered" style="background-color:white;border-radius:30px;margin-bottom:0px;">
										<tr style="background-color:;">
											<td colspan="2">
												<p style="font-size:20px;text-align: center;">Lecture <span><?php echo "<span style='background-color:#efeded  !important;padding:5px;font-family:Arial;border-radius:5px;'>".$mondayarray[$m]['priority']."</span>"; ?></span>
												</p>
											</td>
										</tr>
										<tr>
											<td>Class</td>
											<td class="text-center"><?php echo $classHeadName[0]['std_enroll_head_name'];?></td>
										</tr>
										<tr>
											<td>subject</td>
											<td class="text-center"><?php echo $subjectName[0]['subject_name']; ?>  </td>
										</tr>
										<tr>
											<td colspan="2" style="text-align: center;font-size:30px;">
												<p style="">Free</p>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
					<?php	}
						}// closing of empty array
						else { ?>
					<div class="col-md-3">
						<div class="panel panel-default">
							<div class="panel-body" style="background-color:lightgray;">
								<div class="">
									<h3>No Schedule</h3>
								</div>
							</div>
						</div>
					</div>
					<?php
							} // closing of $m for loop
						}
						?>
			</div>
			<!-- monday schedule close here -->

			<!-- tuesday schedule start here -->
			<h3  style="background-color:#3b444b !important;text-align: center;font-size:25px;color:white !important;line-height:2;border-radius:10px;">
						<span style="color:white !important;">Tuesday</span>
			</h3>
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
			<div class="row">
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
					<div class="col-md-3">
						<div class="panel panel-default" style="padding:0px;">
							<div class="panel-body" style="background-color:#efeded !important;">
								<div class="">
								<table class="table table-striped" style="background-color:white;border-radius:30px;margin-bottom:0px;font-size:15px;font-family:Arial;">
									<tr style="background-color:;">
										<td colspan="2">
											<p style="font-size:20px;text-align: center;font-weight: bolder;">Lecture <span><?php echo "<span style='background-color:#efeded  !important;padding:5px;font-family:Arial;border-radius:5px;'>".$tuesdayarray[$m]['priority']."</span>"; ?></span>
											</p>
										</td>
									</tr>
									<tr style="font-weight: bolder;">
										<th style="background-color:lightgray!important;">Class</th>
										<td  style="background-color:lightgray!important;" class="text-center"><?php echo $classHeadName[0]['std_enroll_head_name'];?></td>
									</tr>
									<tr style="font-weight: bolder;">
										<td style="background-color:#efeded !important;">subject</td>
										<td class="text-center" style="font-family: Arial;"><?php echo $subjectName[0]['subject_name']; ?>  </td>
									</tr>
									<tr style="font-weight: bolder;">
										<td style="background-color:#efeded !important;">Start Time</td>
										<td style="font-family: Arial;" class="text-center"><?php echo $tuesdayarray[$m]['start_time']; ?></td>
									</tr>
									<tr style="font-weight: bolder;">
										<td style="background-color:#efeded !important;">End time</td>
										<td class="text-center"><?php echo $tuesdayarray[$m]['end_time']; ?></td>
									</tr>
									<tr style="font-weight: bolder;">
										<td style="background-color:#efeded !important;">Room</td>
										<td style="text-align:center;font-size:15px;font-family: Arial;"><?php echo $tuesdayarray[$m]['room']; ?></td>
									</tr>
								</table>
							</div>
							</div>
						</div>
					</div>
				<?php 

				} // closing of if status = 1
				if ($status == 0) { ?>

					<div class="col-md-3">
						<div class="panel panel-success">
							<div class="panel-body" style="background-color:#D6E9C6 !important;">
								<div class="">
									<table class="table table-bordered" style="background-color:white;border-radius:30px;margin-bottom:0px;">
										<tr style="background-color:;">
											<td colspan="2">
												<p style="font-size:20px;text-align: center;">Lecture <span><?php echo "<span style='background-color:#efeded  !important;padding:5px;font-family:Arial;border-radius:5px;'>".$tuesdayarray[$m]['priority']."</span>"; ?></span>
												</p>
											</td>
										</tr>
										<tr>
											<td>Class</td>
											<td class="text-center"><?php echo $classHeadName[0]['std_enroll_head_name'];?></td>
										</tr>
										<tr>
											<td>subject</td>
											<td class="text-center"><?php echo $subjectName[0]['subject_name']; ?>  </td>
										</tr>
										<tr>
											<td colspan="2" style="text-align: center;font-size:30px;">
												<p style="">Free</p>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
					<?php	}
						}// closing of empty array
						else { ?>
					<div class="col-md-3">
						<div class="panel panel-default">
							<div class="panel-body" style="background-color:lightgray;">
								<div class="">
									<h3>No Schedule</h3>
								</div>
							</div>
						</div>
					</div>
					<?php
							} // closing of $m for loop
						}
						?>
			</div>
			<!-- tuesday schedule close here -->

			<!-- wednesday schedule start here -->
			<h3  style="background-color:#3b444b !important;text-align: center;font-size:25px;color:white !important;line-height:2;border-radius:10px;">
						<span style="color:white !important;">Wednesday</span>
			</h3>
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
			<div class="row">
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
					<div class="col-md-3">
						<div class="panel panel-default" style="padding:0px;">
							<div class="panel-body" style="background-color:#efeded !important;">
								<div class="">
								<table class="table table-striped" style="background-color:white;border-radius:30px;margin-bottom:0px;font-size:15px;font-family:Arial;">
									<tr style="background-color:;">
										<td colspan="2">
											<p style="font-size:20px;text-align: center;font-weight: bolder;">Lecture <span><?php echo "<span style='background-color:#efeded  !important;padding:5px;font-family:Arial;border-radius:5px;'>".$wednesdayarray[$m]['priority']."</span>"; ?></span>
											</p>
										</td>
									</tr>
									<tr style="font-weight: bolder;">
										<th style="background-color:lightgray!important;">Class</th>
										<td  style="background-color:lightgray!important;" class="text-center"><?php echo $classHeadName[0]['std_enroll_head_name'];?></td>
									</tr>
									<tr style="font-weight: bolder;">
										<td style="background-color:#efeded !important;">subject</td>
										<td class="text-center" style="font-family: Arial;"><?php echo $subjectName[0]['subject_name']; ?>  </td>
									</tr>
									<tr style="font-weight: bolder;">
										<td style="background-color:#efeded !important;">Start Time</td>
										<td style="font-family: Arial;" class="text-center"><?php echo $wednesdayarray[$m]['start_time']; ?></td>
									</tr>
									<tr style="font-weight: bolder;">
										<td style="background-color:#efeded !important;">End time</td>
										<td class="text-center"><?php echo $wednesdayarray[$m]['end_time']; ?></td>
									</tr>
									<tr style="font-weight: bolder;">
										<td style="background-color:#efeded !important;">Room</td>
										<td style="text-align:center;font-size:15px;font-family: Arial;"><?php echo $wednesdayarray[$m]['room']; ?></td>
									</tr>
								</table>
							</div>
							</div>
						</div>
					</div>
				<?php 

				} // closing of if status = 1
				if ($status == 0) { ?>

					<div class="col-md-3">
						<div class="panel panel-success">
							<div class="panel-body" style="background-color:#D6E9C6 !important;;">
								<div class="">
									<table class="table table-bordered" style="background-color:white;border-radius:30px;margin-bottom:0px;">
										<tr style="background-color:;">
											<td colspan="2">
												<p style="font-size:20px;text-align: center;">Lecture <span><?php echo "<span style='background-color:#efeded  !important;padding:5px;font-family:Arial;border-radius:5px;'>".$wednesdayarray[$m]['priority']."</span>"; ?></span>
												</p>
											</td>
										</tr>
										<tr>
											<td>Class</td>
											<td class="text-center"><?php echo $classHeadName[0]['std_enroll_head_name'];?></td>
										</tr>
										<tr>
											<td>subject</td>
											<td class="text-center"><?php echo $subjectName[0]['subject_name']; ?>  </td>
										</tr>
										<tr>
											<td colspan="2" style="text-align: center;font-size:30px;">
												<p style="">Free</p>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
					<?php	}
						}// closing of empty array
						else { ?>
					<div class="col-md-3">
						<div class="panel panel-default">
							<div class="panel-body" style="background-color:lightgray;">
								<div class="">
									<h3>No Schedule</h3>
								</div>
							</div>
						</div>
					</div>
					<?php
							} // closing of $m for loop
						}
						?>
			</div>
			<!-- wednesday schedule close here -->

			<!-- thursday schedule start here -->
			<h3  style="background-color:#3b444b !important;text-align: center;font-size:25px;color:white !important;line-height:2;border-radius:10px;">
					<span style="color:white !important;">Thursday</span>
			</h3>
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
							if (!empty($thursdaySchedule)) {
								$thursdayarray[] = $thursdaySchedule[0];
							}
							$countthursdayarray = count($thursdayarray);
						}
					?>
			<div class="row">
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
					<div class="col-md-3">
						<div class="panel panel-default" style="padding:0px;">
							<div class="panel-body" style="background-color:#efeded !important;">
								<div class="">
								<table class="table table-striped" style="background-color:white;border-radius:30px;margin-bottom:0px;font-size:15px;font-family:Arial;">
									<tr style="background-color:;">
										<td colspan="2">
											<p style="font-size:20px;text-align: center;font-weight: bolder;">Lecture <span><?php echo "<span style='background-color:#efeded  !important;padding:5px;font-family:Arial;border-radius:5px;'>".$thursdayarray[$m]['priority']."</span>"; ?></span>
											</p>
										</td>
									</tr>
									<tr style="font-weight: bolder;">
										<th style="background-color:lightgray!important;">Class</th>
										<td  style="background-color:lightgray!important;" class="text-center"><?php echo $classHeadName[0]['std_enroll_head_name'];?></td>
									</tr>
									<tr style="font-weight: bolder;">
										<td style="background-color:#efeded !important;">subject</td>
										<td class="text-center" style="font-family: Arial;"><?php echo $subjectName[0]['subject_name']; ?>  </td>
									</tr>
									<tr style="font-weight: bolder;">
										<td style="background-color:#efeded !important;">Start Time</td>
										<td style="font-family: Arial;" class="text-center"><?php echo $thursdayarray[$m]['start_time']; ?></td>
									</tr>
									<tr style="font-weight: bolder;">
										<td style="background-color:#efeded !important;">End time</td>
										<td class="text-center"><?php echo $thursdayarray[$m]['end_time']; ?></td>
									</tr>
									<tr style="font-weight: bolder;">
										<td style="background-color:#efeded !important;">Room</td>
										<td style="text-align:center;font-size:15px;font-family: Arial;"><?php echo $thursdayarray[$m]['room']; ?></td>
									</tr>
								</table>
							</div>
							</div>
						</div>
					</div>
				<?php 

				} // closing of if status = 1
				if ($status == 0) { ?>

					<div class="col-md-3">
						<div class="panel panel-success">
							<div class="panel-body" style="background-color:#D6E9C6 !important;;">
								<div class="">
									<table class="table table-bordered" style="background-color:white;border-radius:30px;margin-bottom:0px;">
										<tr style="background-color:;">
											<td colspan="2">
												<p style="font-size:20px;text-align: center;">Lecture <span><?php echo "<span style='background-color:#efeded  !important;padding:5px;font-family:Arial;border-radius:5px;'>".$thursdayarray[$m]['priority']."</span>"; ?></span>
												</p>
											</td>
										</tr>
										<tr>
											<td>Class</td>
											<td class="text-center"><?php echo $classHeadName[0]['std_enroll_head_name'];?></td>
										</tr>
										<tr>
											<td>subject</td>
											<td class="text-center"><?php echo $subjectName[0]['subject_name']; ?>  </td>
										</tr>
										<tr>
											<td colspan="2" style="text-align: center;font-size:30px;">
												<p style="">Free</p>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
					<?php	}
						}// closing of empty array
						else { ?>
					<div class="col-md-3">
						<div class="panel panel-default">
							<div class="panel-body" style="background-color:lightgray;">
								<div class="">
									<h3>No Schedule</h3>
								</div>
							</div>
						</div>
					</div>
					<?php
							} // closing of $m for loop
						}
						?>
			</div>
			<!-- thursday schedule close here -->

			<!-- friday schedule start here -->
			<h3  style="background-color:#3b444b !important;text-align: center;font-size:25px;color:white !important;line-height:2;border-radius:10px;">
					<span style="color:white !important;">Friday</span>
			</h3>
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
							if (!empty($fridaySchedule)) {
								$fridayarray[] = $fridaySchedule[0];
							}
							$countfridayarray = count($fridayarray);
						}
					?>
			<div class="row">
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
					<div class="col-md-3">
						<div class="panel panel-default" style="padding:0px;">
							<div class="panel-body" style="background-color:#efeded !important;">
								<div class="">
								<table class="table table-striped" style="background-color:white;border-radius:30px;margin-bottom:0px;font-size:15px;font-family:Arial;">
									<tr style="background-color:;">
										<td colspan="2">
											<p style="font-size:20px;text-align: center;font-weight: bolder;">Lecture <span><?php echo "<span style='background-color:#efeded  !important;padding:5px;font-family:Arial;border-radius:5px;'>".$fridayarray[$m]['priority']."</span>"; ?></span>
											</p>
										</td>
									</tr>
									<tr style="font-weight: bolder;">
										<th style="background-color:lightgray!important;">Class</th>
										<td  style="background-color:lightgray!important;" class="text-center"><?php echo $classHeadName[0]['std_enroll_head_name'];?></td>
									</tr>
									<tr style="font-weight: bolder;">
										<td style="background-color:#efeded !important;">subject</td>
										<td class="text-center" style="font-family: Arial;"><?php echo $subjectName[0]['subject_name']; ?>  </td>
									</tr>
									<tr style="font-weight: bolder;">
										<td style="background-color:#efeded !important;">Start Time</td>
										<td style="font-family: Arial;" class="text-center"><?php echo $fridayarray[$m]['start_time']; ?></td>
									</tr>
									<tr style="font-weight: bolder;">
										<td style="background-color:#efeded !important;">End time</td>
										<td class="text-center"><?php echo $fridayarray[$m]['end_time']; ?></td>
									</tr>
									<tr style="font-weight: bolder;">
										<td style="background-color:#efeded !important;">Room</td>
										<td style="text-align:center;font-size:15px;font-family: Arial;"><?php echo $fridayarray[$m]['room']; ?></td>
									</tr>
								</table>
							</div>
							</div>
						</div>
					</div>
				<?php 

				} // closing of if status = 1
				if ($status == 0) { ?>

					<div class="col-md-3">
						<div class="panel panel-success">
							<div class="panel-body" style="background-color:#D6E9C6 !important;;">
								<div class="">
									<table class="table table-bordered" style="background-color:white;border-radius:30px;margin-bottom:0px;">
										<tr style="background-color:;">
											<td colspan="2">
												<p style="font-size:20px;text-align: center;">Lecture <span><?php echo "<span style='background-color:#efeded  !important;padding:5px;font-family:Arial;border-radius:5px;'>".$fridayarray[$m]['priority']."</span>"; ?></span>
												</p>
											</td>
										</tr>
										<tr>
											<td>Class</td>
											<td class="text-center"><?php echo $classHeadName[0]['std_enroll_head_name'];?></td>
										</tr>
										<tr>
											<td>subject</td>
											<td class="text-center"><?php echo $subjectName[0]['subject_name']; ?>  </td>
										</tr>
										<tr>
											<td colspan="2" style="text-align: center;font-size:30px;">
												<p style="">Free</p>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
					<?php	}
						}// closing of empty array
						else { ?>
					<div class="col-md-3">
						<div class="panel panel-default">
							<div class="panel-body" style="background-color:lightgray;">
								<div class="">
									<h3>No Schedule</h3>
								</div>
							</div>
						</div>
					</div>
					<?php
							} // closing of $m for loop
						}
						?>
			</div>
			<!-- friday schedule close here -->

			<!-- saturday schedule start here -->
			<h3  style="background-color:#3b444b !important;text-align: center;font-size:25px;color:white !important;line-height:2;border-radius:10px;">
				<span style="color:white !important;">Saturday</span>
						
			</h3>
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
							if (!empty($saturdaySchedule)) {
								$saturdayarray[] = $saturdaySchedule[0];
							}
							$countsaturdayarray = count($saturdayarray);
						}
					?>
			<div class="row">
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
					<div class="col-md-3">
						<div class="panel panel-default" style="padding:0px;">
							<div class="panel-body" style="background-color:#efeded !important;">
								<div class="">
								<table class="table table-striped" style="background-color:white;border-radius:30px;margin-bottom:0px;font-size:15px;font-family:Arial;">
									<tr style="background-color:;">
										<td colspan="2">
											<p style="font-size:20px;text-align: center;font-weight: bolder;">Lecture <span><?php echo "<span style='background-color:#efeded  !important;padding:5px;font-family:Arial;border-radius:5px;'>".$saturdayarray[$m]['priority']."</span>"; ?></span>
											</p>
										</td>
									</tr>
									<tr style="font-weight: bolder;">
										<th style="background-color:lightgray!important;">Class</th>
										<td  style="background-color:lightgray!important;" class="text-center"><?php echo $classHeadName[0]['std_enroll_head_name'];?></td>
									</tr>
									<tr style="font-weight: bolder;">
										<td style="background-color:#efeded !important;">subject</td>
										<td class="text-center" style="font-family: Arial;"><?php echo $subjectName[0]['subject_name']; ?>  </td>
									</tr>
									<tr style="font-weight: bolder;">
										<td style="background-color:#efeded !important;">Start Time</td>
										<td style="font-family: Arial;" class="text-center"><?php echo $saturdayarray[$m]['start_time']; ?></td>
									</tr>
									<tr style="font-weight: bolder;">
										<td style="background-color:#efeded !important;">End time</td>
										<td class="text-center"><?php echo $saturdayarray[$m]['end_time']; ?></td>
									</tr>
									<tr style="font-weight: bolder;">
										<td style="background-color:#efeded !important;">Room</td>
										<td style="text-align:center;font-size:15px;font-family: Arial;"><?php echo $saturdayarray[$m]['room']; ?></td>
									</tr>
								</table>
							</div>
							</div>
						</div>
					</div>
				<?php 

				} // closing of if status = 1
				if ($status == 0) { ?>

					<div class="col-md-3">
						<div class="panel panel-success">
							<div class="panel-body" style="background-color:#D6E9C6 !important;;">
								<div class="">
									<table class="table table-bordered" style="background-color:white;border-radius:30px;margin-bottom:0px;">
										<tr style="background-color:;">
											<td colspan="2">
												<p style="font-size:20px;text-align: center;">Lecture <span><?php echo "<span style='background-color:#efeded  !important;padding:5px;font-family:Arial;border-radius:5px;'>".$saturdayarray[$m]['priority']."</span>"; ?></span>
												</p>
											</td>
										</tr>
										<tr>
											<td>Class</td>
											<td class="text-center"><?php echo $classHeadName[0]['std_enroll_head_name'];?></td>
										</tr>
										<tr>
											<td>subject</td>
											<td class="text-center"><?php echo $subjectName[0]['subject_name']; ?>  </td>
										</tr>
										<tr>
											<td colspan="2" style="text-align: center;font-size:30px;">
												<p style="">Free</p>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
					<?php	}
						}// closing of empty array
						else { ?>
					<div class="col-md-3">
						<div class="panel panel-default">
							<div class="panel-heading b-c-lg" style="text-align: center;background-color: lightgray !important;">
								<h3 style="font-family: georgia;">No Schedule</h3>
							</div>
							<div class="panel-body" style="text-align: center;font-size:35px;color:#8ec0f2;">
								<i class="glyphicon glyphicon-time colorful"></i>
							</div>
						</div>
					</div>
					<?php
							} // closing of $m for loop
						}
						?>
			</div>
			<!-- saturday schedule close here -->
		</span>
		<!-- Teacher Schedule close here -->
	</div>
<?php } // closing of teacher if isset ?>
<?php 
if(isset($_GET['classHeadID'])){
	// getting class Head id
	$classHeadID = $_GET['classHeadID'];

	$classHeadName = Yii::$app->db->createCommand("SELECT class_name_id,std_enroll_head_name FROM std_enrollment_head WHERE std_enroll_head_id = '$classHeadID ' ")->queryAll();

	$classNameID = $classHeadName[0]['class_name_id'];
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
				<button style="float: right;" onclick="printContent('class-schedule')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-print"></i> Print Report
				</button>
			</div>
	</div><br>
	<span id="class-schedule">
		<div class="row">
				<div class="col-md-12 text-center" style="border-top:1px solid;border-bottom:1px solid;border-radius:0px;padding:10px;">
					<img src="images/abc_logo.jpg" class="img-thumbnail" height="120" width="120">
					<h2 style="line-height:2.5;font-size:35px;">ABC Learning High School Rahim Yar Khan</h2>
				</div>
		</div>
		<div class="row">
			<div class="col-md-12" id="">
				<h2 style="padding:10px; text-align: center;background-color: black !important;color:white !important;">
					Class Time Table
				</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h3 class="well well-sm" style="text-align: center;">
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
							//print_r($mondayDetails);

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

								} // closing of for loop $i	
							?>
							<td style="text-align: center;line-height:6;">
								<a href="./time-table-update?dayId=<?php echo $mondayId; ?>&classHeadID=<?php echo $classHeadID; ?>"><i class="glyphicon glyphicon-edit"></i> Edit</a>
							</td>
						</tr>
						<?php } // closing of if (!empty($mondayDetails)) 
						else { ?>
							
							<?php for ($s=0; $s <=$countSubjects; $s++) { ?>

								<td class="warning" style="text-align:center;line-height:6;"><?php echo "No Schedule"; ?>
								</td>
							<?php  
							}  // close of for loop $s ?> 
							
				<?php 	} // closing of else ?>
						<!-- Monday detail close -->

						<!-- tuesday detail start -->
						<?php 

							$tuesdayDetails = Yii::$app->db->createCommand("SELECT td.subject_id,td.start_time,td.end_time,td.room,td.status,td.priority,th.time_table_h_id
							FROM time_table_detail as td
							INNER JOIN time_table_head as th
							ON th.time_table_h_id = td.time_table_h_id
							WHERE th.class_id = '$classHeadID'
							AND th.status = 'Active' 
							AND th.days LIKE '%tuesday%'
							ORDER BY td.priority ASC")->queryAll();
							//print_r($tuesdayDetails);

						?>
						<tr>
							<td  style="background-color:#587899;color:white;line-height:6;text-align: center;border-radius:20px;">Tuesday</td>
							<?php 
							if (!empty($tuesdayDetails)) {
									$mondayId = $tuesdayDetails[0]['time_table_h_id'];
									$counttuesdayDetails = count($tuesdayDetails);

								for ($i=0; $i <$counttuesdayDetails ; $i++) {

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

								} // closing of for loop $i	
							?>
							<td style="text-align: center;line-height:6;">
								<a href="./time-table-update?dayId=<?php echo $mondayId; ?>&classHeadID=<?php echo $classHeadID; ?>"><i class="glyphicon glyphicon-edit"></i> Edit</a>
							</td>
						</tr>
						<?php } // closing of if (!empty($tuesdayDetails)) 
						else { ?>
							
							<?php for ($s=0; $s <=$countSubjects; $s++) { ?>

								<td class="warning" style="text-align:center;line-height:6;"><?php echo "No Schedule"; ?>
								</td>
							<?php  
							}  // close of for loop $s ?> 
							
				<?php 	} // closing of else ?>
						<!-- tuesday detail close -->

						<!-- wednesday detail start -->
						<?php 

							$wednesdayDetails = Yii::$app->db->createCommand("SELECT td.subject_id,td.start_time,td.end_time,td.room,td.status,td.priority,th.time_table_h_id
							FROM time_table_detail as td
							INNER JOIN time_table_head as th
							ON th.time_table_h_id = td.time_table_h_id
							WHERE th.class_id = '$classHeadID'
							AND th.status = 'Active' 
							AND th.days LIKE '%wednesday%'
							ORDER BY td.priority ASC")->queryAll();
							//print_r($wednesdayDetails);

						?>
						<tr>
							<td  style="background-color:#587899;color:white;line-height:6;text-align: center;border-radius:20px;">Wednesday</td>
							<?php 
							if (!empty($wednesdayDetails)) {
									$mondayId = $wednesdayDetails[0]['time_table_h_id'];
									$countwednesdayDetails = count($wednesdayDetails);

								for ($i=0; $i <$countwednesdayDetails ; $i++) {

									$subjectId = $wednesdayDetails[$i]['subject_id'];
									$room = $wednesdayDetails[$i]['room'];
									$status = $wednesdayDetails[$i]['status'];
									$priority = $wednesdayDetails[$i]['priority'];
									//echo $priority;
									$subjectName = Yii::$app->db->createCommand("SELECT subject_name
									FROM subjects
									WHERE subject_id = '$subjectId'")->queryAll();
									
									$startTime = $wednesdayDetails[$i]['start_time'];
									$endTime = $wednesdayDetails[$i]['end_time'];
									$room = $wednesdayDetails[$i]['room'];
									
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

								} // closing of for loop $i	
							?>
							<td style="text-align: center;line-height:6;">
								<a href="./time-table-update?dayId=<?php echo $mondayId; ?>&classHeadID=<?php echo $classHeadID; ?>"><i class="glyphicon glyphicon-edit"></i> Edit</a>
							</td>
						</tr>
						<?php } // closing of if (!empty($wednesdayDetails)) 
						else { ?>
							
							<?php for ($s=0; $s <=$countSubjects; $s++) { ?>

								<td class="warning" style="text-align:center;line-height:6;"><?php echo "No Schedule"; ?>
								</td>
							<?php  
							}  // close of for loop $s ?> 
							
				<?php 	} // closing of else ?>
						<!-- wednesday detail close -->

						<!-- thursday detail start -->
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
									$mondayId = $thursdayDetails[0]['time_table_h_id'];
									$countthursdayDetails = count($thursdayDetails);

								for ($i=0; $i <$countthursdayDetails ; $i++) {

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

								} // closing of for loop $i	
							?>
							<td style="text-align: center;line-height:6;">
								<a href="./time-table-update?dayId=<?php echo $mondayId; ?>&classHeadID=<?php echo $classHeadID; ?>"><i class="glyphicon glyphicon-edit"></i> Edit</a>
							</td>
						</tr>
						<?php } // closing of if (!empty($thursdayDetails)) 
						else { ?>
							
							<?php for ($s=0; $s <=$countSubjects; $s++) { ?>

								<td class="warning" style="text-align:center;line-height:6;"><?php echo "No Schedule"; ?>
								</td>
							<?php  
							}  // close of for loop $s ?> 
							
				<?php 	} // closing of else ?>
						<!-- thursday detail close -->

						<!-- friday detail start -->
						<?php 

							$fridayDetails = Yii::$app->db->createCommand("SELECT td.subject_id,td.start_time,td.end_time,td.room,td.status,td.priority,th.time_table_h_id
							FROM time_table_detail as td
							INNER JOIN time_table_head as th
							ON th.time_table_h_id = td.time_table_h_id
							WHERE th.class_id = '$classHeadID'
							AND th.status = 'Active' 
							AND th.days LIKE '%friday%'
							ORDER BY td.priority ASC")->queryAll();
							//print_r($fridayDetails);

						?>
						<tr>
							<td  style="background-color:#587899;color:white;line-height:6;text-align: center;border-radius:20px;">Friday</td>
							<?php 
							if (!empty($fridayDetails)) {
									$mondayId = $fridayDetails[0]['time_table_h_id'];
									$countfridayDetails = count($fridayDetails);

								for ($i=0; $i <$countfridayDetails ; $i++) {

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

								} // closing of for loop $i	
							?>
							<td style="text-align: center;line-height:6;">
								<a href="./time-table-update?dayId=<?php echo $mondayId; ?>&classHeadID=<?php echo $classHeadID; ?>"><i class="glyphicon glyphicon-edit"></i> Edit</a>
							</td>
						</tr>
						<?php } // closing of if (!empty($fridayDetails)) 
						else { ?>
							
							<?php for ($s=0; $s <=$countSubjects; $s++) { ?>

								<td class="warning" style="text-align:center;line-height:6;"><?php echo "No Schedule"; ?>
								</td>
							<?php  
							}  // close of for loop $s ?> 
							
				<?php 	} // closing of else ?>
						<!-- friday detail close -->

						<!-- saturday detail start -->
						<?php 

							$saturdayDetails = Yii::$app->db->createCommand("SELECT td.subject_id,td.start_time,td.end_time,td.room,td.status,td.priority,th.time_table_h_id
							FROM time_table_detail as td
							INNER JOIN time_table_head as th
							ON th.time_table_h_id = td.time_table_h_id
							WHERE th.class_id = '$classHeadID'
							AND th.status = 'Active' 
							AND th.days LIKE '%saturday%'
							ORDER BY td.priority ASC")->queryAll();
							//print_r($saturdayDetails);

						?>
						<tr>
							<td  style="background-color:#587899;color:white;line-height:6;text-align: center;border-radius:20px;">Saturday</td>
							<?php 
							if (!empty($saturdayDetails)) {
									$mondayId = $saturdayDetails[0]['time_table_h_id'];
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

								} // closing of for loop $i	
							?>
							<td style="text-align: center;line-height:6;">
								<a href="./time-table-update?dayId=<?php echo $mondayId; ?>&classHeadID=<?php echo $classHeadID; ?>"><i class="glyphicon glyphicon-edit"></i> Edit</a>
							</td>
						</tr>
						<?php } // closing of if (!empty($saturdayDetails)) 
						else { ?>
							
							<?php for ($s=0; $s <=$countSubjects; $s++) { ?>

								<td class="warning" style="text-align:center;line-height:6;"><?php echo "No Schedule"; ?>
								</td>
							<?php  
							}  // close of for loop $s ?> 
							
				<?php 	} // closing of else ?>
						<!-- saturday detail close -->
					</thead>
				</table>
			</div>
		</div>
	</span>
</div>
</body>
</html>
<?php } ?>

<?php 
	if(isset($_POST["update_time_table"]))
	{
		$start_time 		= $_POST['start_time'];
		$end_time 			= $_POST['end_time'];
		$room 				= $_POST['room'];
		$countDayDetails	= $_POST['countDayDetails'];
		$subIdArray			= $_POST['subIdArray'];
		$priority = $_POST['priority'];
		$status = $_POST['on_off'];

		$dayId = $_POST['dayId'];
		$classHeadID = $_POST['classHeadID'];

		$break_start = $_POST['break_start'];
		$break_end = $_POST['break_end'];
		$break_priority = $_POST['break_priority'];

		
		print_r($start_time);
		echo "<br>";
		print_r($room);
		echo "<br>";
		print_r($end_time);
		echo "<br>";
		print_r($status);
		echo "<br>";
		die();
		 	$transection = Yii::$app->db->beginTransaction();
		try{
			for ($i=0; $i <$countDayDetails ; $i++) {
				if ($status[$i] == 1) { 
					$timeTableUpdate = Yii::$app->db->createCommand()->update('time_table_detail', [
							'start_time' 		=> $start_time[$i],
							'end_time' 			=> $end_time[$i],
							'room' 				=> $room[$i],
							'priority' 			=> $priority[$i],
							'status' 			=> $status[$i],
							'updated_at'		=> new \yii\db\Expression('NOW()'),
							'updated_by'		=> Yii::$app->user->identity->id,
	                        ],
	                        ['time_table_h_id' => $dayId, 'subject_id' => $subIdArray[$i]]
	                    )->execute();
				}
				if ($status[$i] == 0) { 
					$timeTableUpdate = Yii::$app->db->createCommand()->update('time_table_detail', [
							'start_time' 		=> '',
							'end_time' 			=> '',
							'room' 				=> '',
							'priority' 			=> $priority[$i],
							'status' 			=> $status[$i],
							'updated_at'		=> new \yii\db\Expression('NOW()'),
							'updated_by'		=> Yii::$app->user->identity->id,
	                        ],
	                        ['time_table_h_id' => $dayId, 'subject_id' => $subIdArray[$i]]
	                    )->execute();
				}
			} //ending of $i loooooooooooooop
			if($timeTableUpdate){
				$timeTablebreakUpdate = Yii::$app->db->createCommand()->update('time_table_detail', [
						'start_time' 		=> $break_start,
						'end_time' 			=> $break_end,
						'room' 				=> '',
						'priority' 			=> $break_priority,
						'status' 			=> 2,
						'updated_at'		=> new \yii\db\Expression('NOW()'),
						'updated_by'		=> Yii::$app->user->identity->id,
                        ],
                        ['time_table_h_id' => $dayId, 'subject_id' => NULL, 'room' => NULL]
                    )->execute();
			}
			if($timeTablebreakUpdate) {
				$transection->commit();
				Yii::$app->session->setFlash('success', "Time Table updated successfully...!");
				//return $this->redirect(['./class-time-table']);
				//header("location: ");
				?>
					<!-- <script>
						window.location='./class-time-table';
					</script> -->
				<?php
			}
			
		//closing of try block
		} catch(Exception $e){
			$transection->rollback();
			echo $e;
			Yii::$app->session->setFlash('warning', "Time Table not updated. Try again!");
		} // closing of transaction handling....
		

} //ending of if isset
?>
<script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>