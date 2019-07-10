 <?php 
	if(isset($_POST['save']))
	{
		// getting exam criteria fields
		$exam_category 		= $_POST["exam_category"];
		$classId 			= $_POST["classId"];
		$exam_start_date 	= $_POST["exam_start_date"];
		$exam_end_date 		= $_POST["exam_end_date"];
		$exam_type			= $_POST["exam_type"];
		// getting exam schedule fields
		$subarray 			= $_POST["subarray"];
		$date 				= $_POST["date"];
		// $Invagilator 		= $_POST["Invagilator"];
		$fullmarks 			= $_POST["fullmarks"];
		$passingmarks 		= $_POST["passingmarks"];
		$subjCount 			= $_POST["subjCount"];
		$exam_start_time 	= $_POST["exam_start_time"];
		$exam_end_time 		= $_POST["exam_end_time"];
		?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		
			<form method="POST" action="">
	<?php 
		//fetch sections against class_name_id
		$class_sections = Yii::$app->db->createCommand("SELECT std_enroll_head_id, std_enroll_head_name,branch_id
		FROM  std_enrollment_head
		WHERE class_name_id = '$classId'")->queryAll();
		$countSection = count($class_sections);

		for ($i=0; $i <$countSection ; $i++) { 
			$classSectionID[$i] = $class_sections[$i]['std_enroll_head_id'];
			$classSections = $class_sections[$i]['std_enroll_head_name'];
			$branchSections = $class_sections[$i]['branch_id'];

			$branchName = Yii::$app->db->createCommand("SELECT branch_name
			FROM  branches
			WHERE branch_id = '$branchSections'")->queryAll();
			?>
				<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-header">
						<div class="well well-sm" style="text-align:center;border-left:2px solid;border-right:2px solid;margin-top:10px;background-color:#001F3F;color:white;">
						<h5 style="font-size:20px;font-family:georgia;font-weight:bolder;">
							<?php echo $classSections; ?>
							<p>
								<?php echo "( ".$branchName[0]['branch_name']." )"; ?>
							</p>
						</h5>
						</div>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-12">
								
									<?php 

									for ($j=0; $j <$subjCount ; $j++) { 
									$subjectName = Yii::$app->db->createCommand("SELECT subject_name
									FROM  subjects
									WHERE subject_id = '$subarray[$j]'")->queryAll();
									 ?>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Subject</label>
												<input type="text" name="" value="<?php echo $subjectName[0]['subject_name'] ;?>" readonly="" class="form-control" >
											</div>
											<div class="form-group">
												<label>Date</label>
												<input type="text" name="" value="<?php echo $date[$j] ;?>" readonly="" class="form-control" >
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Select Room</label>
												<select name="room[<?php echo $i; ?>][<?php echo $j; ?>]" class="form-control">
												<option value="">Select Room</option>
												<?php 
												$rooms = Yii::$app->db->createCommand("SELECT room_id,room_name
												FROM rooms")->queryAll();
												$roomCount = count($rooms);
												for ($k=0; $k <$roomCount; $k++) { 
												
												 ?>
												<option value="<?php echo $rooms[$k]['room_id'];?>">
													<?php echo $rooms[$k]['room_name'];?>
												</option>
												<?php } ?>
												</select>
											</div>
											<div class="form-group">
												<label>Select Invigilator</label>
												<select name="Invagilator[<?php echo $i; ?>][<?php echo $j; ?>]" class="form-control" >
											<?php 	$teacher = Yii::$app->db->createCommand("
													SELECT emp_id,emp_name
													FROM emp_info WHERE group_by ='Faculty' AND emp_branch_id = '$branchSections'
													")->queryAll();
													$countteacher = count($teacher); ?>

													<option value="">Select invagilator</option>
													<?php 
													for ($l=0; $l <$countteacher ; $l++) { ?>
													<option value="<?php
															echo $teacher[$l]['emp_id'];
													?>">
													<?php
															echo $teacher[$l]['emp_name'];
													?>
													</option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<hr style="border:1px solid #F39C12;">
									<?php } ?>
							</div>
						</div>
					</div>
				</div>
				</div>
	<?php }
	//closing of for loop
	?>
	<input type="hidden" name="exam_category" value="<?php echo $exam_category ;?>">
	<input type="hidden" name="classId" value="<?php echo $classId ;?>">
	<input type="hidden" name="exam_start_date" value="<?php echo $exam_start_date ;?>">
	<input type="hidden" name="exam_end_date" value="<?php echo $exam_end_date ;?>">
	<input type="hidden" name="exam_type" value="<?php echo $exam_type ;?>">
	<input type="hidden" name="subjCount" value="<?php echo $subjCount ;?>">
	<input type="hidden" name="countSection" value="<?php echo $countSection ;?>">
	<?php foreach ($subarray as $key => $value) { ?>
		<input type="hidden" name="subarray[]" value="<?php echo $value; ?>">
	<?php } ?>
	<?php foreach ($date as $key => $value) { ?>
		<input type="hidden" name="date[]" value="<?php echo $value; ?>">
	<?php } ?>
	<?php foreach ($fullmarks as $key => $value) { ?>
		<input type="hidden" name="fullmarks[]" value="<?php echo $value; ?>">
	<?php } ?>
	<?php foreach ($passingmarks as $key => $value) { ?>
		<input type="hidden" name="passingmarks[]" value="<?php echo $value; ?>">
	<?php } ?>
	<?php foreach ($exam_start_time as $key => $value) { ?>
		<input type="hidden" name="exam_start_time[]" value="<?php echo $value; ?>">
	<?php } ?>
	<?php foreach ($exam_end_time as $key => $value) { ?>
		<input type="hidden" name="exam_end_time[]" value="<?php echo $value; ?>">
	<?php } ?>
	<?php foreach ($classSectionID as $key => $value) { ?>
		<input type="hidden" name="classSectionID[]" value="<?php echo $value; ?>">
	<?php } ?>
	
	<button class="btn btn-success btn-md pull-right" name="save_datesheet">Save</button>
	</form>
			
	</div>
</div>
</body>
</html>
<?php
}//closing of save isset

if(isset($_POST['save_datesheet']))
{
		// exams criteria data
		$exam_category 		= $_POST["exam_category"];
		$classId 			= $_POST["classId"];
		$exam_start_date 	= $_POST["exam_start_date"];
		$exam_end_date 		= $_POST["exam_end_date"];
		$exam_type			= $_POST["exam_type"];
		// getting exam schedule fields
		$subarray 			= $_POST["subarray"];
		$date 				= $_POST["date"];
		$fullmarks 			= $_POST["fullmarks"];
		$passingmarks 		= $_POST["passingmarks"];
		$subjCount 			= $_POST["subjCount"];
		$exam_start_time 	= $_POST["exam_start_time"];
		$exam_end_time 		= $_POST["exam_end_time"]; 
		// exam room data
		$countSection 		= $_POST["countSection"];
		$room 				= $_POST["room"];
		$Invagilator 		= $_POST["Invagilator"];
		$classSectionID 	= $_POST["classSectionID"];
	
	$transection = Yii::$app->db->beginTransaction();
	try{
		$inactive = "Inactive";
		$examCriteria = Yii::$app->db->createCommand()->insert('exams_criteria',[
    			'exam_category_id' 		=> $exam_category,
				'class_id' 				=> $classId ,
				'exam_start_date' 		=> $exam_start_date,
				'exam_end_date'			=> $exam_end_date ,
				'exam_status'			=> $inactive,
				'exam_type'				=> $exam_type,
				'created_at'			=> new \yii\db\Expression('NOW()'),
				'created_by'			=> Yii::$app->user->identity->id, 
			])->execute();
		if ($examCriteria) {
			$examCriteriaId = Yii::$app->db->createCommand("SELECT exam_criteria_id
			FROM  exams_criteria
			WHERE exam_category_id 		= '$exam_category' AND
				  class_id 				= '$classId' AND
				  exam_start_date 		= '$exam_start_date' AND
				  exam_end_date 		= '$exam_end_date' AND
				  exam_status			= '$inactive' AND
				  exam_type				= '$exam_type'
			")->queryAll();

			$criteriaId = $examCriteriaId[0]['exam_criteria_id'];
			
			for ($i=0; $i <$subjCount ; $i++) { 
				$examSchedule = Yii::$app->db->createCommand()->insert('exams_schedule',[
	            			'exam_criteria_id' 	=> $criteriaId,
							'subject_id' 		=> $subarray[$i],
							'date'				=> $date[$i],
							'exam_start_time'	=> $exam_start_time[$i],
							'exam_end_time'		=> $exam_end_time[$i],
							'full_marks'		=> $fullmarks[$i],
							'passing_marks'		=> $passingmarks[$i],
							'status'			=> "not",
							'created_at'		=> new \yii\db\Expression('NOW()'),
							'created_by'		=> Yii::$app->user->identity->id, 
						])->execute();

				if ($examSchedule) {
					$examScheduleId = Yii::$app->db->createCommand("SELECT exam_schedule_id
					FROM  exams_schedule as s
					WHERE s.exam_criteria_id 		= '$criteriaId' AND
						  s.subject_id 				= '$subarray[$i]' AND
						  s.date 					= '$date[$i]' AND
						  s.exam_start_time 		= '$exam_start_time[$i]' AND
						  s.exam_end_time			= '$exam_end_time[$i]' AND
						  s.full_marks				= '$fullmarks[$i]' AND
						  s.passing_marks			= '$passingmarks[$i]' AND
						  s.status					= 'not'
					")->queryAll();


					$scheduleId = $examScheduleId[0]['exam_schedule_id'];
					
					for ($j=0; $j <$countSection ; $j++) { 
						$examRoom = Yii::$app->db->createCommand()->insert('exams_room',[
	            			'exam_schedule_id' 	=> $scheduleId,
							'class_head_id' 	=> $classSectionID[$j],
							'exam_room'			=> $room[$j][$i],
							'emp_id'			=> $Invagilator[$j][$i],
							'created_at'		=> new \yii\db\Expression('NOW()'),
							'created_by'		=> Yii::$app->user->identity->id, 
						])->execute();
					}// closing of for loop j
				}//closing of exam schedule
			} // closing of for loop i
			if($examRoom){
				$transection->commit();
				Yii::$app->session->setFlash('success', "Exams Schedule managed successfully...!");
			}
		} // closing of exam criteria
	//closing of try block
	} catch(Exception $e){
		$transection->rollback();
		echo $e;
		Yii::$app->session->setFlash('warning', "Exam Schedule not managed. Try again!");
	}
}
// closing of isset
?>

