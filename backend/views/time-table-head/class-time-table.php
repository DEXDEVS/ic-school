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
			<div class="col-md-12">
				<h3 class="well well-sm">
					<?php echo $teacherName[0]['teacher_subject_assign_head_name']; ?>
				</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-bordered">
					<thead>
						<tr>
							<?php 
							$daysArray = array();
							for ($s=0; $s <$countTeacherDetails ; $s++) { 

								$classID   = $teacherDetails[$s]['class_id'];
								
								$subjectID = $teacherDetails[$s]['subject_id'];

								$daySchedule = Yii::$app->db->createCommand("SELECT th.days,th.class_id,td.subject_id,td.start_time,td.end_time,td.room,td.status,td.priority,th.time_table_h_id,th.class_id
								FROM time_table_detail as td
								INNER JOIN time_table_head as th
								ON th.time_table_h_id = td.time_table_h_id
								WHERE th.class_id = '$classID'
								AND th.status = 'Active'
								AND td.subject_id = '$subjectID'")->queryAll();

								
								if(!empty($daySchedule)){
									
									foreach ($daySchedule as $key => $value) {
										$daysArray[$s] = $value;
									}
								}
							} //closing of $s loop 
print_r($daySchedule);
							?>
							<tr>
							<!-- <th style="background-color:#849db7;color:white;text-align:center;">Days</th> -->
							<th colspan="<?php echo $countTeacherDetails; ?>" style="text-align: center;background-color:lightgray;"><b style="background-color:#849db7;color:white;padding:10px;">Days : </b><?php echo "&nbsp;".$daysArray[0]['days']; ?></th>
						</tr>
							<?php
							ArrayHelper::multisort($daysArray, ['priority'], [SORT_ASC]);
							foreach ($daysArray as $key => $value) {
								$subID = $value['subject_id'];
								$priority = $value['priority'];
								$classID = $value['class_id'];

								$className = Yii::$app->db->createCommand("SELECT * FROM std_enrollment_head WHERE std_enroll_head_id = '$classID ' ")->queryAll();
								$subName = Yii::$app->db->createCommand("SELECT subject_name FROM subjects WHERE subject_id = '$subID ' ")->queryAll();
								$status = $value['status'];
								if ($status == 1) {

							 ?>
							
							<td style="text-align:center;">
								<h4>
									<?php echo "Lecture #: ".$priority; ?>
								</h4>
								<p>
									<?php echo "<b><u>Class : </u></b>".$className[0]['std_enroll_head_name']; ?>
								</p>
								<p>
									<?php 
									if (empty($subName[0]['subject_name'])) {
										echo "---";
									}
									else{
										echo "<b>Subject:</b> ".$subName[0]['subject_name'];
									}

									 ?>	
								</p>
								<p><?php echo "<b>Time :</b> ".$value['start_time']." TO ".$value['end_time'];  ?></p>
								<p><?php echo "<b>Room.# </b>"."<span class='label label-success'>".$value['room']."</span>";  ?></p>
							</td>
							<?php } // closing of if to check subject status
							} // closing if foreach loop 
							
							 ?>
						</tr>
						<!-- Monday Details end -->
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
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
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