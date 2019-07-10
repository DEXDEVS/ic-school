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
print_r($subjectArray);
	$countSubjectArray = count($subjectArray);

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
				<thead>
					<tr>
						<th style="width:20px;">Periods</th>
						<?php 

						for ($i=0; $i <$countSubjectArray; $i++) {
							if ($subjectArray[$i] == 'Break') {
								//$break = $subjectArray[$i];
								//echo $break;
							
						 ?>
						<td><?php //echo $subjectArray[$i];; ?></td>
						<?php }  // close of if
							else{?>
								<td><?php echo $i+1; ?></td>
						<?php	}
						}  // close of for loop

						?>
					</tr>
					<?php 

					
						$mondayDetails = Yii::$app->db->createCommand("SELECT th.class_id,th.days,th.status,td.subject_id,td.start_time,td.end_time,td.room,td.status
						FROM time_table_head as th
						INNER JOIN time_table_detail as td
						ON th.time_table_h_id = td.time_table_h_id
						WHERE th.class_id = '$classHeadID'
						AND th.status = 'Active'
						AND td.status = '1'
						AND th.days LIKE '%monday%'
						ORDER BY td.start_time ASC")->queryAll();
						//print_r($mondayDetails);
						
					// Monday details query close

					
						$tuesdayDetails = Yii::$app->db->createCommand("SELECT th.class_id,th.days,th.status,td.subject_id,td.start_time,td.end_time,td.room,td.status
						FROM time_table_head as th
						INNER JOIN time_table_detail as td
						ON th.time_table_h_id = td.time_table_h_id
						WHERE th.class_id = '$classHeadID'
						AND th.status = 'Active'
						AND td.status = '1'
						AND th.days LIKE '%tuesday%'
						ORDER BY td.start_time ASC")->queryAll();
						//print_r($mondayDetails);
						$countTuesdayDetails = count($tuesdayDetails);
					// Tuesday details query close

						$wednesdayDetails = Yii::$app->db->createCommand("SELECT th.class_id,th.days,th.status,td.subject_id,td.start_time,td.end_time,td.room,td.status
						FROM time_table_head as th
						INNER JOIN time_table_detail as td
						ON th.time_table_h_id = td.time_table_h_id
						WHERE th.class_id = '$classHeadID'
						AND th.status = 'Active'
						AND td.status = '1'
						AND th.days LIKE '%wednesday%'
						ORDER BY td.start_time ASC")->queryAll();
						//print_r($mondayDetails);
						$countTuesdayDetails = count($tuesdayDetails);
					// Wednesday details query close

						$thursdayDetails = Yii::$app->db->createCommand("SELECT th.class_id,th.days,th.status,td.subject_id,td.start_time,td.end_time,td.room,td.status
						FROM time_table_head as th
						INNER JOIN time_table_detail as td
						ON th.time_table_h_id = td.time_table_h_id
						WHERE th.class_id = '$classHeadID'
						AND th.status = 'Active'
						AND td.status = '1'
						AND th.days LIKE '%thursday%'
						ORDER BY td.start_time ASC")->queryAll();
						//print_r($mondayDetails);
						$countThursdayDetails = count($thursdayDetails);
					// Thursday details query close

						$fridayDetails = Yii::$app->db->createCommand("SELECT th.class_id,th.days,th.status,td.subject_id,td.start_time,td.end_time,td.room,td.status
						FROM time_table_head as th
						INNER JOIN time_table_detail as td
						ON th.time_table_h_id = td.time_table_h_id
						WHERE th.class_id = '$classHeadID'
						AND th.status = 'Active'
						AND td.status = '1'
						AND th.days LIKE '%friday%'
						ORDER BY td.start_time ASC")->queryAll();
						//print_r($mondayDetails);
						$countFridayDetails = count($fridayDetails);
					// Friday details query close

						$saturdayDetails = Yii::$app->db->createCommand("SELECT th.class_id,th.days,th.status,td.subject_id,td.start_time,td.end_time,td.room,td.status
						FROM time_table_head as th
						INNER JOIN time_table_detail as td
						ON th.time_table_h_id = td.time_table_h_id
						WHERE th.class_id = '$classHeadID'
						AND th.status = 'Active'
						AND td.status = '1'
						AND th.days LIKE '%saturday%'
						ORDER BY td.start_time ASC")->queryAll();
						//print_r($mondayDetails);
						$countSaturdayDetails = count($saturdayDetails);
					// Saturday details query close
					 ?>
					
					<!-- Monday detail start -->
					<tr>
						<td  style="background-color:#587899;color:white;line-height:7;">Monday</td>
						<?php 
						if (empty($mondayDetails)) {
							for ($m=0; $m <$countSubjectArray ; $m++) { ?>
							<td><?php echo "---"; ?></td>
						<?php
							}
						}
						else{
							$countMondayDetails = count($mondayDetails);
						for ($j=0; $j <$countMondayDetails ; $j++) { 
							$subjectId = $mondayDetails[$j]['subject_id'];
							$subjectName = Yii::$app->db->createCommand("SELECT subject_name
							FROM subjects
							WHERE subject_id = '$subjectId'")->queryAll();
							$startTime = $mondayDetails[$j]['start_time'];
							$endTime = $mondayDetails[$j]['end_time'];

							$classId = $mondayDetails[$j]['class_id'];
							//echo $subjectId;
							$teacherDetail = Yii::$app->db->createCommand("SELECT tsah.teacher_subject_assign_head_name
							FROM teacher_subject_assign_head as tsah
							INNER JOIN teacher_subject_assign_detail as tsad
							ON tsah.teacher_subject_assign_head_id = tsad.teacher_subject_assign_detail_head_id
							WHERE tsad.subject_id = '$subjectId'
							AND tsad.class_id = '$classId'")->queryAll();
						 ?>
						<td>
							<u><?php echo $subjectName[0]['subject_name']; ?></u><br>
							<?php echo $startTime; ?>
							<b>TO</b>
							<?php echo $endTime; ?><br>
							<u>
								<?php //echo $teacherDetail[0]['teacher_subject_assign_head_name']; ?>
							</u>
						</td>
						<?php } // closing of for loop 
							} // closing of else for monday
						 ?>
					</tr>
					<!-- Monday detail close -->

					<!-- tuesday detail start -->
					<tr>
						<td rowspan="2" style="background-color:#587899;color:white;line-height:7;">Tuesday</td>
						<?php 
						if (empty($tuesdayDetails)) {
							
						for ($m=0; $m <$countSubjectArray ; $m++) { ?>
							<td><?php echo "---"; ?></td>
						<?php
							}
						}
						else{
							$countTuesdayDetails = count($tuesdayDetails);
						for ($j=0; $j <$countTuesdayDetails ; $j++) { 
							$subjectId = $tuesdayDetails[$j]['subject_id'];
							$subjectName = Yii::$app->db->createCommand("SELECT subject_name
							FROM subjects
							WHERE subject_id = '$subjectId'")->queryAll();
							$startTime = $tuesdayDetails[$j]['start_time'];
							$endTime = $tuesdayDetails[$j]['end_time'];

							$classId = $tuesdayDetails[$j]['class_id'];
							//echo $subjectId;
							$teacherDetail = Yii::$app->db->createCommand("SELECT tsah.teacher_subject_assign_head_name
							FROM teacher_subject_assign_head as tsah
							INNER JOIN teacher_subject_assign_detail as tsad
							ON tsah.teacher_subject_assign_head_id = tsad.teacher_subject_assign_detail_head_id
							WHERE tsad.subject_id = '$subjectId'
							AND tsad.class_id = '$classId'")->queryAll();
							if ($subjectName[0]['subject_name'] == 'Break') {?>
								<td class="info">
							<u><?php echo $subjectName[0]['subject_name']; ?></u><br>
							<?php echo $startTime; ?>
							<b>TO</b>
							<?php echo $endTime; ?><br>
							<u>
								<?php //echo $teacherDetail[0]['teacher_subject_assign_head_name']; ?>
							</u>
						</td>
						<?php
							}
							else{


						 ?>
						<td>
							<u><?php echo $subjectName[0]['subject_name']; ?></u><br>
							<?php echo $startTime; ?>
							<b>TO</b>
							<?php echo $endTime; ?><br>
							<u>
								<?php //echo $teacherDetail[0]['teacher_subject_assign_head_name']; ?>
							</u>
						</td>
						<?php 
							}
						} // closing of for loop 
							} // closing of else for monday
						 ?>
					</tr>
					<!-- Tuesday detail close -->
				</thead>
			</table>
		</div>
	</div>
</div>
</body>
</html>