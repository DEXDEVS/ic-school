<?php 

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
						<th style="width:20px;background-color:#849db7;color:white;text-align: center;">Periods</th>
						<?php 
						for ($s=0; $s <$countSubjects; $s++) { ?>
							<td style="background-color:#849db7;color:white;text-align: center;"><?php echo $s+1; ?></td>
						<?php  
						}  // close of for loop ?>
					</tr>
					<!-- Monday detail start -->
					<?php 
						$mondayHeadId = Yii::$app->db->createCommand("SELECT th.time_table_h_id,th.class_id
						FROM time_table_head as th
						WHERE th.class_id = '$classHeadID'
						AND th.status = 'Active'
						AND th.days LIKE '%monday%'")->queryAll();
						
						$monHeadId = $mondayHeadId[0]['time_table_h_id'];
						$mondayDetails = Yii::$app->db->createCommand("SELECT td.subject_id,td.start_time,td.end_time,td.room
						FROM time_table_detail as td
						WHERE td.time_table_h_id = '$monHeadId'
						AND td.status = '1'
						ORDER BY td.start_time ASC")->queryAll();	
					?>
					<tr>
						<td  style="background-color:#587899;color:white;line-height:6;">Monday</td>
						<?php 
						if (empty($mondayDetails)) {
							for ($s=0; $s <$countSubjects ; $s++) { ?>
							<td><?php echo "---"; ?></td>
							<?php
								} // closing of for $countSubjects
						} else {
								$countMondayDetails = count($mondayDetails);
							for ($i=0; $i <$countMondayDetails ; $i++) { 
								$subjectId = $mondayDetails[$i]['subject_id'];
								$subjectName = Yii::$app->db->createCommand("SELECT subject_name
								FROM subjects
								WHERE subject_id = '$subjectId'")->queryAll();
								$classId = $mondayHeadId[0]['class_id'];
								
								$teacherDetail = Yii::$app->db->createCommand("SELECT tsah.teacher_subject_assign_head_name
								FROM teacher_subject_assign_head as tsah
								INNER JOIN teacher_subject_assign_detail as tsad
								ON tsah.teacher_subject_assign_head_id = tsad.teacher_subject_assign_detail_head_id
								WHERE tsad.subject_id = '$subjectId'
								AND tsad.class_id = '$classId'")->queryAll();
								$room_id = $mondayDetails[$i]['room'];
								$roomName = Yii::$app->db->createCommand("SELECT room_name
								FROM rooms
								WHERE room_id = '$room_id'")->queryAll();
								if ($subjectName[0]['subject_name'] == 'Break') {
							 ?>
							<td class="info">
								<u><?php echo $subjectName[0]['subject_name']; ?></u><br>
								<?php echo $mondayDetails[$i]['start_time']; ?>
								<b>TO</b>
								<?php echo $mondayDetails[$i]['end_time']; ?><br>
								<u>
									<?php //echo $teacherDetail[0]['teacher_subject_assign_head_name']; ?>
								</u><br>
								<u>
									<?php //echo $roomName[0]['room_name']; ?>
								</u>
							</td>
							 <?php 
								}// closing of if Break
								else { ?>
							<td>
								<u><?php echo $subjectName[0]['subject_name']; ?></u><br>
								<?php echo $mondayDetails[$i]['start_time']; ?>
								<b>TO</b>
								<?php echo $mondayDetails[$i]['end_time']; ?><br>
								<u>
									Kinza Mustafa
									<?php //echo $teacherDetail[0]['teacher_subject_assign_head_name']; ?>
								</u><br>
								<u>
									<?php echo $roomName[0]['room_name']; ?>
								</u>
							</td>
						<?php } 
							} // closing of for loop 
						} // closing of else for monday
						?>
					</tr>
					<!-- Monday detail close -->

					<!-- tuesday detail start -->
					<?php 
						$tuesdayHeadId = Yii::$app->db->createCommand("SELECT th.time_table_h_id,th.class_id
						FROM time_table_head as th
						WHERE th.class_id = '$classHeadID'
						AND th.status = 'Active'
						AND th.days LIKE '%tuesday%'")->queryAll();
						
						$tueHeadId = $tuesdayHeadId[0]['time_table_h_id'];
						$tuesdayDetails = Yii::$app->db->createCommand("SELECT td.subject_id,td.start_time,td.end_time,td.room
						FROM time_table_detail as td
						WHERE td.time_table_h_id = '$tueHeadId'
						AND td.status = '1'
						ORDER BY td.start_time ASC")->queryAll();
						//print_r($tuesdayDetails);	
					// tueday details query close	
					?>
					<tr>
						<td style="background-color:#587899;color:white;line-height:6;">Tuesday</td>
						<?php 
						if (empty($tuesdayDetails)) {
							for ($s=0; $s <$countSubjects ; $s++) { ?>
								<td><?php echo "---"; ?></td>
							<?php
							}
						} else {
							$countTuesdayDetails = count($tuesdayDetails);
							for ($i=0; $i <$countTuesdayDetails ; $i++) { 
								$subjectId = $tuesdayDetails[$i]['subject_id'];
								$subjectName = Yii::$app->db->createCommand("SELECT subject_name
								FROM subjects
								WHERE subject_id = '$subjectId'")->queryAll();
								$classId = $tuesdayHeadId[0]['class_id'];
								
								$teacherDetail = Yii::$app->db->createCommand("SELECT tsah.teacher_subject_assign_head_name
								FROM teacher_subject_assign_head as tsah
								INNER JOIN teacher_subject_assign_detail as tsad
								ON tsah.teacher_subject_assign_head_id = tsad.teacher_subject_assign_detail_head_id
								WHERE tsad.subject_id = '$subjectId'
								AND tsad.class_id = '$classId'")->queryAll();
								$room_id = $mondayDetails[$i]['room'];
								$roomName = Yii::$app->db->createCommand("SELECT room_name
								FROM rooms
								WHERE room_id = '$room_id'")->queryAll();
								if ($subjectName[0]['subject_name'] == 'Break') {
							?>
							<td class="info">
								<u><?php echo $subjectName[0]['subject_name']; ?></u><br>
								<?php echo $tuesdayDetails[$i]['start_time']; ?>
								<b>TO</b>
								<?php echo $tuesdayDetails[$i]['end_time']; ?><br>
								<u>
									<?php //echo $teacherDetail[0]['teacher_subject_assign_head_name']; ?>
								</u>
							</td>
							<?php
								} else {
							?>
							<td>
								<u><?php echo $subjectName[0]['subject_name']; ?></u><br>
								<?php echo $tuesdayDetails[$i]['start_time']; ?>
								<b>TO</b>
								<?php echo $tuesdayDetails[$i]['end_time']; ?><br>
								<u>
									Kinza Mustafa
									<?php //echo $teacherDetail[0]['teacher_subject_assign_head_name']; ?>
								</u><br>
								<u>
									<?php echo $roomName[0]['room_name']; ?>
								</u>
							</td>
							<?php 
								}
							} // closing of for loop 
						} // closing of else for tueday
						 ?>
					</tr>
					<!-- Tuesday detail close -->

					<!-- Wednesday detail start -->
					<?php 
						$wednesdayHeadId = Yii::$app->db->createCommand("SELECT th.time_table_h_id,th.class_id
						FROM time_table_head as th
						WHERE th.class_id = '$classHeadID'
						AND th.status = 'Active'
						AND th.days LIKE '%wednesday%'")->queryAll();
						
						$wedHeadId = $wednesdayHeadId[0]['time_table_h_id'];
						$wednesdayDetails = Yii::$app->db->createCommand("SELECT td.subject_id,td.start_time,td.end_time,td.room
						FROM time_table_detail as td
						WHERE td.time_table_h_id = '$wedHeadId'
						AND td.status = '1'
						ORDER BY td.start_time ASC")->queryAll();	
					?>
					<tr>
						<td  style="background-color:#587899;color:white;line-height:6;">Wednesday</td>
						<?php 
						if (empty($wednesdayDetails)) {
							for ($s=0; $s <$countSubjects ; $s++) { ?>
							<td><?php echo "---"; ?></td>
							<?php
							} // closing of for $countSubjects
						} else {
								$countwednesdayDetails = count($wednesdayDetails);
							for ($i=0; $i <$countwednesdayDetails ; $i++) { 
								$subjectId = $wednesdayDetails[$i]['subject_id'];
								$subjectName = Yii::$app->db->createCommand("SELECT subject_name
								FROM subjects
								WHERE subject_id = '$subjectId'")->queryAll();
								$classId = $wednesdayHeadId[0]['class_id'];
								
								$teacherDetail = Yii::$app->db->createCommand("SELECT tsah.teacher_subject_assign_head_name
								FROM teacher_subject_assign_head as tsah
								INNER JOIN teacher_subject_assign_detail as tsad
								ON tsah.teacher_subject_assign_head_id = tsad.teacher_subject_assign_detail_head_id
								WHERE tsad.subject_id = '$subjectId'
								AND tsad.class_id = '$classId'")->queryAll();
								$room_id = $wednesdayDetails[$i]['room'];
								$roomName = Yii::$app->db->createCommand("SELECT room_name
								FROM rooms
								WHERE room_id = '$room_id'")->queryAll();
								if ($subjectName[0]['subject_name'] == 'Break') {
							 ?>
							<td class="info">
								<u><?php echo $subjectName[0]['subject_name']; ?></u><br>
								<?php echo $wednesdayDetails[$i]['start_time']; ?>
								<b>TO</b>
								<?php echo $wednesdayDetails[$i]['end_time']; ?><br>
								<u>
									<?php //echo $teacherDetail[0]['teacher_subject_assign_head_name']; ?>
								</u><br>
								<u>
									<?php //echo $roomName[0]['room_name']; ?>
								</u>
							</td>
							 <?php 
								} else { ?>
							<td>
								<u><?php echo $subjectName[0]['subject_name']; ?></u><br>
								<?php echo $wednesdayDetails[$i]['start_time']; ?>
								<b>TO</b>
								<?php echo $wednesdayDetails[$i]['end_time']; ?><br>
								<u>
									Kinza Mustafa
									<?php //echo $teacherDetail[0]['teacher_subject_assign_head_name']; ?>
								</u><br>
								<u>
									<?php echo $roomName[0]['room_name']; ?>
								</u>
							</td>
						<?php 	} // closing of else Break
							} // closing of for loop 
						} // closing of else for wednesdayDetails
						?>
					</tr>
					<!-- Wednesday detail close -->

					<!-- Thursday detail start -->
					<?php 
						$thursdayHeadId = Yii::$app->db->createCommand("SELECT th.time_table_h_id,th.class_id
						FROM time_table_head as th
						WHERE th.class_id = '$classHeadID'
						AND th.status = 'Active'
						AND th.days LIKE '%thursday%'")->queryAll();
						
						$thrHeadId = $thursdayHeadId[0]['time_table_h_id'];
						$thursdayDetails = Yii::$app->db->createCommand("SELECT td.subject_id,td.start_time,td.end_time,td.room
						FROM time_table_detail as td
						WHERE td.time_table_h_id = '$thrHeadId'
						AND td.status = '1'
						ORDER BY td.start_time ASC")->queryAll();	
					?>
					<tr>
						<td  style="background-color:#587899;color:white;line-height:6;">Thursday</td>
						<?php 
						if (empty($thursdayDetails)) {
							for ($s=0; $s <$countSubjects ; $s++) { ?>
							<td><?php echo "---"; ?></td>
							<?php
							} // closing of for $countSubjects
						} else {
								$countthursdayDetails = count($thursdayDetails);
							for ($i=0; $i <$countthursdayDetails ; $i++) { 
								$subjectId = $thursdayDetails[$i]['subject_id'];
								$subjectName = Yii::$app->db->createCommand("SELECT subject_name
								FROM subjects
								WHERE subject_id = '$subjectId'")->queryAll();
								$classId = $thursdayHeadId[0]['class_id'];
								
								$teacherDetail = Yii::$app->db->createCommand("SELECT tsah.teacher_subject_assign_head_name
								FROM teacher_subject_assign_head as tsah
								INNER JOIN teacher_subject_assign_detail as tsad
								ON tsah.teacher_subject_assign_head_id = tsad.teacher_subject_assign_detail_head_id
								WHERE tsad.subject_id = '$subjectId'
								AND tsad.class_id = '$classId'")->queryAll();
								$room_id = $thursdayDetails[$i]['room'];
								$roomName = Yii::$app->db->createCommand("SELECT room_name
								FROM rooms
								WHERE room_id = '$room_id'")->queryAll();
								if ($subjectName[0]['subject_name'] == 'Break') {
							 ?>
							<td class="info">
								<u><?php echo $subjectName[0]['subject_name']; ?></u><br>
								<?php echo $thursdayDetails[$i]['start_time']; ?>
								<b>TO</b>
								<?php echo $thursdayDetails[$i]['end_time']; ?><br>
								<u>
									<?php //echo $teacherDetail[0]['teacher_subject_assign_head_name']; ?>
								</u><br>
								<u>
									<?php //echo $roomName[0]['room_name']; ?>
								</u>
							</td>
							 <?php 
								} else { ?>
							<td>
								<u><?php echo $subjectName[0]['subject_name']; ?></u><br>
								<?php echo $thursdayDetails[$i]['start_time']; ?>
								<b>TO</b>
								<?php echo $thursdayDetails[$i]['end_time']; ?><br>
								<u>
									Kinza Mustafa
									<?php //echo $teacherDetail[0]['teacher_subject_assign_head_name']; ?>
								</u><br>
								<u>
									<?php echo $roomName[0]['room_name']; ?>
								</u>
							</td>
						<?php 	} // closing of else Break
							} // closing of for loop 
						} // closing of else for wednesdayDetails
						?>
					</tr>
					<!-- Thursday detail close -->

					<!-- Saturday detail start -->
					<?php 
						$saturdayHeadId = Yii::$app->db->createCommand("SELECT th.time_table_h_id,th.class_id
						FROM time_table_head as th
						WHERE th.class_id = '$classHeadID'
						AND th.status = 'Active'
						AND th.days LIKE '%saturday%'")->queryAll();
						
						$satHeadId = $saturdayHeadId[0]['time_table_h_id'];
						$saturdayDetails = Yii::$app->db->createCommand("SELECT td.subject_id,td.start_time,td.end_time,td.room
						FROM time_table_detail as td
						WHERE td.time_table_h_id = '$satHeadId'
						AND td.status = '1'
						ORDER BY td.start_time ASC")->queryAll();	
					?>
					<tr>
						<td  style="background-color:#587899;color:white;line-height:6;">Friday</td>
						<?php 
						if (empty($saturdayDetails)) {
							for ($s=0; $s <$countSubjects ; $s++) { ?>
							<td><?php echo "---"; ?></td>
							<?php
							} // closing of for $countSubjects
						} else {
								$countsaturdayDetails = count($saturdayDetails);
							for ($i=0; $i <$countsaturdayDetails ; $i++) { 
								$subjectId = $saturdayDetails[$i]['subject_id'];
								$subjectName = Yii::$app->db->createCommand("SELECT subject_name
								FROM subjects
								WHERE subject_id = '$subjectId'")->queryAll();
								$classId = $saturdayHeadId[0]['class_id'];
								
								$teacherDetail = Yii::$app->db->createCommand("SELECT tsah.teacher_subject_assign_head_name
								FROM teacher_subject_assign_head as tsah
								INNER JOIN teacher_subject_assign_detail as tsad
								ON tsah.teacher_subject_assign_head_id = tsad.teacher_subject_assign_detail_head_id
								WHERE tsad.subject_id = '$subjectId'
								AND tsad.class_id = '$classId'")->queryAll();
								$room_id = $saturdayDetails[$i]['room'];
								$roomName = Yii::$app->db->createCommand("SELECT room_name
								FROM rooms
								WHERE room_id = '$room_id'")->queryAll();
								if ($subjectName[0]['subject_name'] == 'Break') {
							 ?>
							<td class="info">
								<u><?php echo $subjectName[0]['subject_name']; ?></u><br>
								<?php echo $saturdayDetails[$i]['start_time']; ?>
								<b>TO</b>
								<?php echo $saturdayDetails[$i]['end_time']; ?><br>
								<u>
									<?php //echo $teacherDetail[0]['teacher_subject_assign_head_name']; ?>
								</u><br>
								<u>
									<?php //echo $roomName[0]['room_name']; ?>
								</u>
							</td>
							 <?php 
								} else { ?>
							<td>
								<u><?php echo $subjectName[0]['subject_name']; ?></u><br>
								<?php echo $saturdayDetails[$i]['start_time']; ?>
								<b>TO</b>
								<?php echo $saturdayDetails[$i]['end_time']; ?><br>
								<u>
									Kinza Mustafa
									<?php //echo $teacherDetail[0]['teacher_subject_assign_head_name']; ?>
								</u><br>
								<u>
									<?php echo $roomName[0]['room_name']; ?>
								</u>
							</td>
						<?php 	} // closing of else Break
							} // closing of for loop 
						} // closing of else for saturdayDetails
						?>
					</tr>
					<!-- Saturday detail close -->
					

					<!-- Saturday detail start -->
					<?php 
						$saturdayHeadId = Yii::$app->db->createCommand("SELECT th.time_table_h_id,th.class_id
						FROM time_table_head as th
						WHERE th.class_id = '$classHeadID'
						AND th.status = 'Active'
						AND th.days LIKE '%saturday%'")->queryAll();
						
						$satHeadId = $saturdayHeadId[0]['time_table_h_id'];
						$saturdayDetails = Yii::$app->db->createCommand("SELECT td.subject_id,td.start_time,td.end_time,td.room
						FROM time_table_detail as td
						WHERE td.time_table_h_id = '$satHeadId'
						AND td.status = '1'
						ORDER BY td.start_time ASC")->queryAll();	
					?>
					<tr>
						<td  style="background-color:#587899;color:white;line-height:6;">Saturday</td>
						<?php 
						if (empty($saturdayDetails)) {
							for ($s=0; $s <$countSubjects ; $s++) { ?>
							<td><?php echo "---"; ?></td>
							<?php
							} // closing of for $countSubjects
						} else {
								$countsaturdayDetails = count($saturdayDetails);
							for ($i=0; $i <$countsaturdayDetails ; $i++) { 
								$subjectId = $saturdayDetails[$i]['subject_id'];
								$subjectName = Yii::$app->db->createCommand("SELECT subject_name
								FROM subjects
								WHERE subject_id = '$subjectId'")->queryAll();
								$classId = $saturdayHeadId[0]['class_id'];
								
								$teacherDetail = Yii::$app->db->createCommand("SELECT tsah.teacher_subject_assign_head_name
								FROM teacher_subject_assign_head as tsah
								INNER JOIN teacher_subject_assign_detail as tsad
								ON tsah.teacher_subject_assign_head_id = tsad.teacher_subject_assign_detail_head_id
								WHERE tsad.subject_id = '$subjectId'
								AND tsad.class_id = '$classId'")->queryAll();
								$room_id = $saturdayDetails[$i]['room'];
								$roomName = Yii::$app->db->createCommand("SELECT room_name
								FROM rooms
								WHERE room_id = '$room_id'")->queryAll();
								if ($subjectName[0]['subject_name'] == 'Break') {
							 ?>
							<td class="info">
								<u><?php echo $subjectName[0]['subject_name']; ?></u><br>
								<?php echo $saturdayDetails[$i]['start_time']; ?>
								<b>TO</b>
								<?php echo $saturdayDetails[$i]['end_time']; ?><br>
								<u>
									<?php //echo $teacherDetail[0]['teacher_subject_assign_head_name']; ?>
								</u><br>
								<u>
									<?php //echo $roomName[0]['room_name']; ?>
								</u>
							</td>
							 <?php 
								} else { ?>
							<td>
								<u><?php echo $subjectName[0]['subject_name']; ?></u><br>
								<?php echo $saturdayDetails[$i]['start_time']; ?>
								<b>TO</b>
								<?php echo $saturdayDetails[$i]['end_time']; ?><br>
								<u>
									Kinza Mustafa
									<?php //echo $teacherDetail[0]['teacher_subject_assign_head_name']; ?>
								</u><br>
								<u>
									<?php echo $roomName[0]['room_name']; ?>
								</u>
							</td>
						<?php 	} // closing of else Break
							} // closing of for loop 
						} // closing of else for saturdayDetails
						?>
					</tr>
					<!-- Saturday detail close -->
				</thead>
			</table>
		</div>
	</div>
</div>
</body>
</html>