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
		
			<form method="POST" action="manage-exams">
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
													SELECT emp.emp_id, emp.emp_name 
													FROM emp_info as emp 
													INNER JOIN emp_designation as empd 
													ON emp.emp_id = empd.emp_id 
													WHERE emp.emp_status = 'Active' 
													AND emp.emp_branch_id = '$branchSections' 
													AND empd.group_by ='Faculty' 
													AND  empd.status = 'Active'
													")->queryAll();
											var_dump($teacher);
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
?>