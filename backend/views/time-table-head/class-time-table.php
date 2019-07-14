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
						<th style="width:20px;background-color:#849db7;color:white;text-align: center;border-radius:10px;">Periods</th>
						<?php 
						for ($s=0; $s <=$countSubjects; $s++) {

						 ?>

							<td style="background-color:#849db7;color:white;text-align: center;border-radius:5px;"><?php echo $s+1; ?></td>
						<?php
						}  // close of for loop ?>
					</tr>

					<!-- Monday detail start -->
					<?php 

						$mondayDetails = Yii::$app->db->createCommand("SELECT td.subject_id,td.start_time,td.end_time,td.room,td.status,td.priority
						FROM time_table_detail as td
						INNER JOIN time_table_head as th
						ON th.time_table_h_id = td.time_table_h_id
						WHERE th.class_id = '$classHeadID'
						AND th.status = 'Active' 
						AND th.days LIKE '%monday%'
						ORDER BY td.priority ASC")->queryAll();
						//print_r($thursdayDetails);

					?>
					<tr>
						<td  style="background-color:#587899;color:white;line-height:6;text-align: center;border-radius:20px;">Monday</td>
						<?php 
						if (!empty($mondayDetails)) {
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
					</tr>
					<?php } else { ?>
						
						<?php for ($s=0; $s <=$countSubjects; $s++) { ?>

							<td class="warning" style="text-align:center;line-height:6;"><?php echo "No Schedule"; ?></td>
						<?php  
						}  // close of for loop ?>
					<?php } ?>
					<!-- Monday detail close -->

					<!-- Tuesday detail start -->
					<?php 

						$tuesdayDetails = Yii::$app->db->createCommand("SELECT td.subject_id,td.start_time,td.end_time,td.room,td.status,td.priority
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

						$wenesdayDetails = Yii::$app->db->createCommand("SELECT td.subject_id,td.start_time,td.end_time,td.room,td.status,td.priority
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

						$thursdayDetails = Yii::$app->db->createCommand("SELECT td.subject_id,td.start_time,td.end_time,td.room,td.status,td.priority
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

						$fridayDetails = Yii::$app->db->createCommand("SELECT td.subject_id,td.start_time,td.end_time,td.room,td.status,td.priority
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

						$saturdayDetails = Yii::$app->db->createCommand("SELECT td.subject_id,td.start_time,td.end_time,td.room,td.status,td.priority
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